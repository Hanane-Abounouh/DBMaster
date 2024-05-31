<?php
require_once './Model/user.php';

$password = '1234';
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);
$user = new User([
    'name' => 'bassma',
    'email' => 'bassma@example.com',
    'password' =>  $hashedPassword,
    'address' =>'1234'
]);

if ($user->update()) {
    echo "User updated successfully.";
} else {
    echo "Failed to update user.";
}
?>