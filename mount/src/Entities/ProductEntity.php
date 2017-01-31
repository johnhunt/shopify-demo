<?php
namespace Entities;

class ProductEntity implements ProductInterface
{
    /**
     * @var
     */
    private $title;
    /**
     * @var
     */
    private $body;
    /**
     * @var
     */
    private $vendor;
    /**
     * @var
     */
    private $productType;
    /**
     * @var
     */
    private $variants;
    /**
     * @var
     */
    private $sku;
    /**
     * @var
     */
    private $price;

    /**
     * Product constructor - loads data into the entity
     *
     * @param $title
     * @param $body
     * @param $vendor
     * @param $productType
     * @param $variants
     */
    public function __construct($sku, $price, $title, $body, $vendor, $productType)
    {
        $this->title = $title;
        $this->body = $body;
        $this->vendor = $vendor;
        $this->productType = $productType;
        $this->sku = $sku;
        $this->price = $price;
    }

    public function sku()
    {
        return $this->sku;
    }

    public function price()
    {
        return $this->price;
    }

    /**
     * @return string The product title
     */
    public function title()
    {
        return $this->title;
    }

    /**
     * @return string The product body
     */
    public function body()
    {
        return $this->body;
    }

    /**
     * @return string The product vendor
     */
    public function vendor()
    {
        return $this->vendor;
    }

    /**
     * @return string The product type
     */
    public function productType()
    {
        return $this->productType;
    }
}