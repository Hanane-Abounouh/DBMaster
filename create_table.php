<?php
require_once 'Product.php';
require_once 'user.php';

// Call the createTable() method to create the 'products' table an 'User'
Product::createTable();
User::createTable();


echo "Table creation process completed.\n";
?>