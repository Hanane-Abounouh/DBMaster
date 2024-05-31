<?php
require_once 'ORM.php';

class User extends ORM {

    protected static $table = 'users';
    protected $name;
    protected $email;
    protected $password;

    protected static $columns = [
        'name' => 'string',
        'email' => 'string',
        'password' => 'string'
    ];

    public function __construct($attributes = []) {
        parent::__construct($attributes);
        $this->name = $attributes['name'] ?? null;
        $this->email = $attributes['email'] ?? null;
        $this->password = $attributes['password'] ?? null;
    }

    public function save() {
        // Check for unique email
        $existingUser = static::findByAttribute('email', $this->email);
        if ($existingUser) {
            throw new Exception("Email already exists");
        }
        return parent::save();
    }
}
?>
