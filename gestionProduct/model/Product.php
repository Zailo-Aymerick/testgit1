<?php
class Product
{
    private $id;
    private $name;
    private $productNumber;
    private $price;
    private $description;
 
    public function __construct($id, $name, $productNumber, $price, $description)
    {
        $this->id = $id;
        $this->name = $name;
        $this->productNumber = $productNumber;
        $this->price = $price;
        $this->description = $description;
    }
    public function getId()
    {
        return $this->id;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getProductNumber()
    {
        return $this->productNumber;
    }
    public function getPrice()
    {
        return $this->price;
    }
    public function getDescription()
    {
        return $this->description;
    }
 
    public function getProductDescription()
    {
        return $this->name . " " . $this->description;
    }
 
}