<?php
namespace Repository;

use Entities\ProductEntity;
use GuzzleHttp\Client;

class ShopifyProductsRepository
{
    /**
     * @var Client Guzzle client
     */
    private $guzzle;
    private $productsEndpoint;
    private $imageEndpoint;

    /**
     * ShopifyProducts constructor.
     * @param Client $guzzle
     */
    public function __construct(Client $guzzle, $productsEndpoint, $imageEndpoint)
    {
        $this->guzzle = $guzzle;
        $this->productsEndpoint = $productsEndpoint;
        $this->imageEndpoint = $imageEndpoint;
    }

    /**
     * @param Product $product The product you'd like to add to the shopify account
     */
    public function addProduct(ProductEntity $product)
    {
        // https://help.shopify.com/api/reference/product#create
        // https://help.shopify.com/api/reference/product_image#create


        $jsonPayload = [
            'product' => [
                'title' => (string) $product->title(),
                'body_html' => (string) $product->body(),
                'vendor' => (string) $product->vendor(),
                'product_type' => (string) $product->productType(),
                'variants' => [
                    [
                        'price' => (string) $product->price(), // weirdly shopify expects this as a string
                        'sku' => (int) $product->sku()
                    ]
                ]
            ]
        ];
        $response = $this->guzzle->request('POST', $this->productsEndpoint, ['json' => $jsonPayload]);

        return $response;
        //https://94e8fb700830558c0ad0dc979dbbc30e:10f95e4ad4d7f7051433c6272e876459@test-urg.myshopify.com/admin/orders.json
    }

    public function addImage($imagePath, $productId)
    {

        $jsonPayload = [
            'image' => [
                'attachment' => base64_encode(file_get_contents($imagePath)),
                'filename' => 'image'
            ]
        ];

        $url = $this->imageEndpoint . $productId . '/images.json';

        $response = $this->guzzle->request('POST', $url, ['json' => $jsonPayload]);


        return $response;
    }
}
