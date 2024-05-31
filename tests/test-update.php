<?php
require_once './Model/Product.php';

try {
    // Créez un nouvel objet Product avec les valeurs à mettre à jour
    $product = new Product([
        'id' => 1, // ID de l'enregistrement à mettre à jour
        'name' => 'Updated Product Name',
        'price' => 29.99,
        'quantity' => 50,
        'description' => 'This product has been updated.'
    ]);

    // Appelez la méthode update() pour mettre à jour l'enregistrement
    if ($product->update()) {
        echo "Product updated successfully.\n";
    } else {
        echo "Failed to update product.\n";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
