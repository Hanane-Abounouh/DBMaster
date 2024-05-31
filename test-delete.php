<?php
require_once 'Product.php';

if ($product->delete(3)) {
    echo "Product deleted successfully.";
} else {
    echo "Failed to delete product.";
}
?>
