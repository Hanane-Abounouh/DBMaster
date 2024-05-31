<?php
require_once './Model/user.php';

$user = new User(); // Créez une nouvelle instance de la classe User

if ($user->deleteAll()) {
    echo "All users deleted successfully.";
} else {
    echo "Failed to delete users.";
}
?>
