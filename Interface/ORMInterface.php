<?php
interface ORMInterface {
    public function save();
    public function update();
    public function delete();
    public function deleteAll();
    public static function find($id);
    public static function findAll();
    public static function updateSchema();
    public static function addColumn($column, $type);
    public static function dropColumn($column);

}
?>
