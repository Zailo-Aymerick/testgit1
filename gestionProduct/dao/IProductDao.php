<?php

interface IProductDao
{

    function saveProduct($name, $numProduit, $price, $description): bool;

    function getAllProducts(): array;

    function updateProduct(
        $name,
        $numProduit,
        $price,
        $description,
        $id
    ): bool;

    function deleteProduct($id) :  bool;

    function getProductById($id) : array;
    function getProductsByName($name) : array;
    function getProductsByPriceIN($minPrice, $maxPrice) : array;

}
