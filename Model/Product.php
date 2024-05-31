<?php
require_once 'ORM.php';

class Product extends ORM {

    protected static $table = 'products';
    protected $name;
    protected $price;
    protected $quantity;
    protected $description;
    protected $is_available;

    protected static $columns = [
        'name' => 'string',
        'price' => 'integer',
        'quantity' => 'integer',
        'description' => 'string',
        'is_available' => 'boolean'
    ];

    public function __construct($attributes = []) {
        parent::__construct($attributes);
        $this->name = $attributes['name'] ?? null;
        $this->price = $attributes['price'] ?? null;
        $this->quantity = $attributes['quantity'] ?? null;
        $this->description = $attributes['description'] ?? null;
        $this->is_available = $attributes['is_available'] ?? null;
    }
}
?>
