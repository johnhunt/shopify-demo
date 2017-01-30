<?php
namespace Entities;

interface ProductInterface
{
    public function title();

    public function body();

    public function vendor();

    public function productType();

    public function variants();
}