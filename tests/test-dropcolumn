<?php
require_once './Config/Database.php';
require_once './Model/user.php';

try {
    // Drop the column
    if (User::dropColumn('address')) {
        echo "Column 'address' dropped successfully.\n";
    } else {
        echo "Failed to drop column 'address'.\n";
    }
    // Verify the column is dropped by checking table structure
    echo "Users after dropping 'address' column:\n";
    $allUsers = User::findAll();
    print_r($allUsers);

} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
?>