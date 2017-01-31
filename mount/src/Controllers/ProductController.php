<?php
namespace Controllers;

use Entities\Product;
use Entities\ProductEntity;
use Repository\ShopifyProductsRepository;
use Slim\Container;
use Slim\Http\Request;
use Slim\Http\Response;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7;

class ProductController
{
    const UPLOAD_PATH = __DIR__ . '/../../temp/image';

    /** @var \Valitron\Validator $validator */
    private $validator;

    /** @var \Slim\Flash\Messages $flash */
    private $flash;

    /** @var ShopifyProductsRepository $apiRepo */
    private $apiRepo;

    public function __construct(Container $container)
    {
        $this->validator = $container['validator'];
        $this->flash = $container['flash'];
        $this->apiRepo = $container['productsRepo'];
    }

    public function storeProductImage(Request $request, Response $response, $params)
    {
        $files = $request->getUploadedFiles();
        if (empty($files['file'])) {
            throw new \Exception('Expected file');
        }
        /** @var Psr7\UploadedFile $newfile */
        $newfile = $files['file'];

        $extension = substr(strrchr($newfile->getClientFilename(),'.'),1);

        // Note - I realise that more than one user of this site could potentially pick up someone else's image,
        // in real life I'd probably use unique paths based on user id/session id or something else.
        $newfile->moveTo(self::UPLOAD_PATH); // . $extension);

        //return $response->write(var_export($file, true));
    }

    public function addProduct(Request $request, Response $response, $params)
    {
        // Load the form data into the validator
        $formData = $request->getParsedBody();

        $this->validator->__construct($formData);
        $this->validator->rule('required', ['sku', 'price', 'title', 'body', 'vendor', 'productType']);
        $this->validator->rule('numeric', ['sku', 'price']);

        if ($this->validator->validate()) {

            // Input seems valid, create the Product entity and pass it off to the ShopProducts repo to post to API
            $entity = new ProductEntity(
                $formData['sku'],
                $formData['price'],
                $formData['title'],
                $formData['body'],
                $formData['vendor'],
                $formData['productType']
            );

            // The reason I use entities objects is because they can neatly represent things and can do programmatic
            // things that arrays can't. This is a fantastic coding pattern that's really useful especially for
            // ecommerce stuff
            try {
                $apiResponse = $this->apiRepo->addProduct($entity);
            } catch (ClientException $exception) {
                $this->flash->addMessage('warn',
                    "The Shopify API didn't want to add that product.<br>" .
                    Psr7\str($exception->getResponse())
                );
            } catch (RequestException $exception) {
                $this->flash->addMessage('warn',
                    "Something went wrong while trying to connect to Shopify - check your credentials.<br>" .
                    $exception->getMessage()
                );
            } catch (\Exception $exception) {
                $this->flash->addMessage('warn',
                    "Couldn't save the product, an unknown error occurred - see below.<br>" .
                    $exception->getMessage()
                );
            }

            $this->flash->addMessage('success', 'The product has been added to Shopify.');

            // Now see if there's an image, if so use it and then remove it from it's temporary location
            if (is_readable(self::UPLOAD_PATH)) {
                // Get the product ID
                $productId = json_decode($apiResponse->getBody())->product->id;
                $this->apiRepo->addImage(self::UPLOAD_PATH, $productId);

                // Again in real life I'd be more careful about just deleting stuff..
                unlink(self::UPLOAD_PATH);
            }

        } else {
            $message = '';
            foreach ($this->validator->errors() as $field => $errors) {
                $message .= implode('<br>', $errors) . '<br>';
            }

            $this->flash->addMessage('validation', 'There was a problem with your product submission:<br>' . $message);
        }

        return $response->withStatus(302)->withHeader('Location', '/shop-demo');}
}