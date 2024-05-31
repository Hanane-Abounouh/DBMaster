<?php
require_once './Config/Database.php';
require_once './Interface/ORMInterface.php';

class ORM implements ORMInterface {
    protected static $table;
    protected $attributes = [];
    protected static $columns = [];

    public function __construct($attributes = []) {
        $this->attributes = $attributes;
    }

    public function save() {
        $columns = implode(", ", array_keys($this->attributes));
        $placeholders = ":" . implode(", :", array_keys($this->attributes));
        $sql = "INSERT INTO " . static::$table . " ($columns) VALUES ($placeholders)";
        $stmt = Database::getConnection()->prepare($sql);
        return $stmt->execute($this->attributes);
    }
   

   
    public function update() {
        $setClause = [];
        $values = [];
    
        foreach ($this->attributes as $column => $value) {
            // Exclure l'ID du tableau des valeurs à mettre à jour
            if ($column !== 'id') {
                $setClause[] = "$column = :$column";
                $values[":$column"] = $value;
            }
        }
    
        $setClause = implode(", ", $setClause);
    
        // Construire la requête SQL avec le critère WHERE pour l'ID
        $sql = "UPDATE " . static::$table . " SET $setClause WHERE id = :id";
        $values[':id'] = $this->attributes['id'];
    
        $stmt = Database::getConnection()->prepare($sql);
        return $stmt->execute($values);
    }
    

    public function delete() {
        $sql = "DELETE FROM " . static::$table . " WHERE id = :id";
        $stmt = Database::getConnection()->prepare($sql);
        return $stmt->execute([':id' => $this->attributes['id']]);
    }

    public function deleteAll() {
        $sql = "DELETE FROM " . static::$table;
        $stmt = Database::getConnection()->prepare($sql);
        return $stmt->execute();
    }

    public static function find($id) {
        $sql = "SELECT * FROM " . static::$table . " WHERE id = :id";
        $stmt = Database::getConnection()->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function findAll() {
        $sql = "SELECT * FROM " . static::$table;
        $stmt = Database::getConnection()->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function createTable() {
        $columnsSql = [];
        foreach (static::$columns as $column => $type) {
            switch ($type) {
                case 'string':
                    $columnsSql[] = "$column VARCHAR(255)";
                    break;
                case 'integer':
                    $columnsSql[] = "$column INT";
                    break;
                case 'boolean':
                    $columnsSql[] = "$column TINYINT(1)";
                    break;
                case 'timestamp':
                    $columnsSql[] = "$column TIMESTAMP DEFAULT CURRENT_TIMESTAMP";
                    break;
                default:
                    throw new Exception("Type non supportÃ© : $type");
            }
        }
        $columnsSql = implode(", ", $columnsSql);
        $sql = "CREATE TABLE IF NOT EXISTS " . static::$table . " (
            id INT AUTO_INCREMENT PRIMARY KEY, $columnsSql
        )";
        $stmt = Database::getConnection()->prepare($sql);
        return $stmt->execute();
    }

    public static function findByAttribute($attribute, $value) {
        $sql = "SELECT * FROM " . static::$table . " WHERE $attribute = :value";
        $stmt = Database::getConnection()->prepare($sql);
        $stmt->execute([':value' => $value]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public static function addColumn($column, $type) {
        switch ($type) {
            case 'string':
                $columnType = 'VARCHAR(255)';
                break;
            case 'integer':
                $columnType = 'INT';
                break;
            case 'boolean':
                $columnType = 'TINYINT(1)';
                break;
            case 'timestamp':
                $columnType = 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP';
                break;
            default:
                throw new Exception("Unsupported type: $type");
        }

        $sql = "ALTER TABLE " . static::$table . " ADD COLUMN $column $columnType";
        $stmt = Database::getConnection()->prepare($sql);
        return $stmt->execute();
    }

    public static function dropColumn($column) {
        $sql = "ALTER TABLE " . static::$table . " DROP COLUMN $column";
        $stmt = Database::getConnection()->prepare($sql);
        return $stmt->execute();
    }

    public static function updateSchema() {
        $oldColumns = self::$columns; // Sauvegarde des anciennes colonnes
    
        // For simplicity, this method will drop and recreate the table
        $sql = "DROP TABLE IF EXISTS " . static::$table;
        $stmt = Database::getConnection()->prepare($sql);
    
        if ($stmt->execute()) {
            // Afficher les modifications de colonnes
            $addedColumns = array_diff_key(self::$columns, $oldColumns); // Colonnes ajoutées
            $removedColumns = array_diff_key($oldColumns, self::$columns); // Colonnes supprimées
            
            echo "Added columns: \n";
            print_r($addedColumns);
            echo "Removed columns: \n";
            print_r($removedColumns);
    
            // Recréer la table
            return static::createTable();
        }
        return false;
    }
    

    
}
?>