<?php
require_once 'Database.php';
require_once 'user.php';

try {
   
    // Add a new column
    // if (User::addColumn('address', 'integer')) {
    //     echo "Column 'address' added successfully.\n";
    // } else {
    //     echo "Failed to add column 'address'.\n";
    // }

    // Verify the new column exists by inserting data
    $password = '1234';
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    $user = new User([
        'name' => 'bassma',
        'email' => 'bassma@example.com',
        'password' =>  $hashedPassword,
        'address' =>'123'
    ]);
        
  

    if ($user->save()) {
        echo "User with new column 'address' created successfully.\n";
    } else {
        echo "Failed to create user with new column 'address'.\n";
    }

    // Display current table structure
    echo "Users:\n";
    $allUsers = User::findAll();
    print_r($allUsers);

} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
?>