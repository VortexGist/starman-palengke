<?php

include_once './core/script-env.php';

/* ================ Database API ================ */

class DB
{
    private static $instance = null;

    public static function getConnection()
    {
        if (self::$instance === null) {
            self::$instance = new mysqli($_ENV['DB_HOST'], $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD']);

            if (self::$instance->connect_error) {
                die("Database Error: " . $connection->connect_error);
            }
        }

        return self::$instance;
    }

    private static function createDatabaseIfNotExists($dbname)
    {
        $status = DB::getConnection()->query("CREATE DATABASE IF NOT EXISTS $dbname;");

        if (!$status) {
            error_log("SQL ERROR: " . DB::getConnection()->error);
        }

        return $status;
    }

    private static function createTableIfNotExists($tableName, $columns)
    {
        $tableColumns = "";
        foreach ($columns as $column => $properties) {
            $tableColumns .= $column . " " . $properties . ", ";
        }

        // remove last comma
        $tableColumns = rtrim($tableColumns, ", ");

        $status = DB::getConnection()->query("CREATE TABLE IF NOT EXISTS $tableName(" . $tableColumns . ');');

        return $status;
    }

    private static function selectDatabase($dbname)
    {
        $status = DB::getConnection()->query("USE $dbname;");

        return $status;
    }

    public static function init()
    {
        DB::getConnection();
        DB::createDatabaseIfNotExists($_ENV['DB_NAME']);
        DB::selectDatabase($_ENV['DB_NAME']);
        DB::createTableIfNotExists('products', [
            'id'          => 'INT PRIMARY KEY AUTO_INCREMENT',
            'name'        => 'VARCHAR(255) NOT NULL UNIQUE',
            'category'    => 'ENUM(\'vegetable\',\'fruit\',\'grain\',\'poultry\',\'meat\') NULL',
            'price'       => 'DECIMAL(10, 2) NULL',
            'price_unit'  => 'enum(\'kg\',\'tray\',\'pc\') NULL',
            'quantity'    => 'INTEGER',
            'image'       => 'VARCHAR(255) NOT NULL',
            'description' => 'TEXT DEFAULT NULL',
        ]);
    }

    /**
     * Inserts product table row
     *
     * @param name
     * @param category
     * @param price
     * @param priceUnit
     * @param quantity
     * @param image - file name of image including file extension
     * @param description
     */
    public static function addProduct(
        string $name,
        string $category,
        float $price,
        string $priceUnit,
        int $quantity,
        string $image,
        string $description) {
        $query     = "INSERT IGNORE INTO products (name, category, price, price_unit, quantity, image, description) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $statement = DB::getConnection()->prepare($query);
        $statement->bind_param("ssdsiss", $name, $category, $price, $price_unit, $quantity, $image, $description);
        $statement->execute();
    }

    /**
     * Retrieves products
     */
    public static function getProducts()
    {
        $query     = "SELECT * FROM products;";
        $statement = DB::getConnection()->prepare($query);
        // $statement->bind_param("i", $id);
        $statement->execute();
        return $statement->get_result();
    }

    /**
     * Get product by id
     */
    public static function getProductByID(int $id)
    {
        $query     = "SELECT * FROM products WHERE id=?;";
        $statement = DB::getConnection()->prepare($query);
        $statement->bind_param("i", $id);
        $statement->execute();
    }

    /**
     * @param column
     * @param string "s" for string, "i" for int, "d" for float
     */
    public static function updateProductByID(int $id, string $column, string $valueType, string | int | float $value)
    {
        $query     = "UPDATE $column SET price=? WHERE id=?;";
        $statement = DB::getConnection()->prepare($query);
        $statement->bind_param("i" . "$valueType", $id, $value);
        $statement->execute();
    }

    public static function removeProductByID(int $id)
    {
        $query     = "DELETE FROM products WHERE id=?;";
        $statement = DB::getConnection()->prepare($query);
        $statement->bind_param("i", $id);
        $statement->execute();
    }

    public static function getProductByName(string $name)
    {
        $query     = "SELECT * FROM products WHERE name=?;";
        $statement = DB::getConnection()->prepare($query);
        $statement->bind_param("s", $name);
        $statement->execute();
    }

    public static function removeProductByName(string $name)
    {
        $query     = "DELETE FROM products WHERE name=?;";
        $statement = DB::getConnection()->prepare($query);
        $statement->bind_param("s", $name);
        $statement->execute();
    }
}

DB::init();
