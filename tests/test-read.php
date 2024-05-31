<?php
require_once './Model/Product.php';

$product = Product::findAll();
if ($product) {
    print_r($product);
} else {
    echo "Product not found.";
}
?>
