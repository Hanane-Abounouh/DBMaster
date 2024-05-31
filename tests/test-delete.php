<?php
require_once './Model/user.php';

$user = new User(['id' => 3]);

if ($user->delete()) {
    echo "User deleted successfully.";
} else {
    echo "Failed to delete user.";
}
?> 
