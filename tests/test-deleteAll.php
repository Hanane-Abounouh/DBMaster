<?php
require_once './Model/user.php';

if ($user->deleteAll()) {
    echo "User deleted successfully.";
} else {
    echo "Failed to delete user.";
}
?> 