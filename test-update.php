<?php
require_once 'Product.php';

// ID du produit à mettre à jour
$id = 5;

if (Product::exists($id)) {
    $product = new Product([
        'name' => 'Updated Product',
        'price' => 150.00,
        'created_at' => date('Y-m-d H:i:s')
    ]);

    if ($product->update($id)) {
        echo "Product updated successfully.";
    } else {
        echo "Failed to update product.";
    }
} else {
    echo "No product found with ID $id.";
}
?>
