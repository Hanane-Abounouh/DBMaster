<?php
require_once 'Product.php';

$product = Product::findAll();
if ($product) {
    print_r($product);
} else {
    echo "Product not found.";
}
?>
