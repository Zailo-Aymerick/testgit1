<?php

require_once('dao/imp/IProductDaoImp.php');
require_once('model/Product.php');
$productDao = new IProductDaoImp();

// $productDao->saveProduct("Iphone", 'AP001', 999.90, 'un telephone');

$prodcuts =  $productDao->getProductById(3);

print_r($prodcuts);


// $productDao->updateProduct("fait", 'AP001', 9, 'une voiture', 1);
// $productDao->deleteProduct(1);
