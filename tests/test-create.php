<?php
require_once './Model/Product.php';
require_once './Model/user.php';

try {
    // Ajouter un nouveau produit
    $product = new Product([
        'name' => 'Example Product 2',
        'price' => 20.99,
        'quantity' => 100,
        'description' => 'This is an example product.',
        'is_available' => false
    ]);

    $result = $product->save();

    if ($result) {
        echo "Product created successfully.";
    } else {
        echo "Failed to create product.";
    }
    $password = '1234';
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    // Ajouter un nouvel utilisateur
    $user = new User([
        'name' => 'hanane',
        'email' => 'hanane@example.com',
        'password' =>  $hashedPassword
    ]);

    $result = $user->save();

    if ($result) {
        echo "User created successfully.";
    } else {
        echo "Failed to create user.";
    }

   

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
