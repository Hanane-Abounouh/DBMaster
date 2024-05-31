<?php
require_once './config/Database.php';
require_once './Model/user.php';

try {
    // Initially create the table
    User::createTable();
    echo "Initial table 'users' created successfully.\n";

    // Insert sample data
    $user1 = new User(['name' => 'John Doe', 'email' => 'john@example.com', 'password' => 'password123']);
    $user1->save();

    $user2 = new User(['name' => 'Jane Smith', 'email' => 'jane@example.com', 'password' => 'password456']);
    $user2->save();

    echo "Sample data inserted successfully.\n";

    // Display current table structure
    echo "Users before schema update:\n";
    $allUsers = User::findAll();
    print_r($allUsers);

    // Update schema (this will drop and recreate the table)
    User::updateSchema();
    echo "Schema updated successfully.\n";

    // Verify the table structure after schema update
    User::createTable();
    echo "Table 'users' structure verified after schema update.\n";

    // Re-insert sample data to verify table structure
    $user1 = new User(['name' => 'ferdaous ezzine', 'email' => 'ferdaous@gmail.com', 'password' => 'ferdaous#7272']);
    $user1->save();

    $user2 = new User(['name' => 'marwa benharda ', 'email' => 'marwa@gmail.com', 'password' => 'marwa#9827']);
    $user2->save();

    echo "Sample data re-inserted successfully.\n";

    // Display updated table structure
    echo "Users after schema update:\n";
    $allUsersAfterUpdate = User::findAll();
    print_r($allUsersAfterUpdate);

} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
?>
