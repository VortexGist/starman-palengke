<?php

class Product
{
    public string $name;
    public float $price;
    public string $priceUnit;
    public string $image;
    public string $description;
    public function __construct(string $name, float $price, string $unit, string $image, string $description)
    {
        $this->name = $name;
        $this->price = $price;
        $this->image = $image;
        $this->priceUnit = $unit;
        $this->description = $description;
    }
}

class CartItem
{
    // public Product $product;
    public int $productID;
    public int $quantity;
    public function __construct(int $productID, int $quantity = 0) //Product $product, int $quantity = 0)
    {
        $this->productID = $productID;
        $this->quantity  = $quantity;
    }
}

class UserAcount {
    public int $userID;
}


class Security {
    public static function generateHash() {

    }
}


class DB
{
    private static $instance = null;

    public static function getConnection()
    {
        if (self::$instance === null) {
            self::$instance = new mysqli($_ENV['DB_HOST'], $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD']);

            if (self::$instance->connect_error) {
                die("Database Error: " . self::$instance->connect_error);
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
        DB::createTableIfNotExists('product_categories', [
            'id'       => 'INT PRIMARY KEY AUTO_INCREMENT',
            'category' => 'VARCHAR(255) NOT NULL UNIQUE',
        ]);
        DB::createTableIfNotExists('accounts', [
            'id'       => 'INT PRIMARY KEY AUTO_INCREMENT',
            'username' => 'VARCHAR(50) NOT NULL UNIQUE',
            'password' => 'VARCHAR(255) NOT NULL',
            'role'     => 'enum(\'customer\', \'admin\')',
        ]);
        DB::createTableIfNotExists('customers', [
            'id'               => 'INT PRIMARY KEY AUTO_INCREMENT',
            'name'             => 'VARCHAR(255) NOT NULL',
            'delivery_method'  => 'enum(\'cod\', \'credit\')',
            'delivery_address' => 'VARCHAR(255) NOT NULL',
            'contact_number'   => 'VARCHAR(255)',
            'contact_email'    => 'VARCHAR(255)',
        ]);
        DB::createTableIfNotExists('orders', [
            'id'               => 'INT PRIMARY KEY AUTO_INCREMENT',
            'customer_id'      => 'VARCHAR(255) NOT NULL',
            'total_amount'     => 'INT',
        ]);
        DB::createTableIfNotExists('order_items', [
            'id'         => 'INT PRIMARY KEY AUTO_INCREMENT',
            'order_id'   => 'VARCHAR(255) NOT NULL',
            'product_id' => 'INT',
            'quantity'   => 'INT',
        ]);


        DB::addCategory("meat");
        DB::addCategory("vegetable");
        DB::addCategory("poultry");
        DB::addCategory("grain");
        DB::addCategory("fruit");
        $productSeeds = [
            'meat'      => [
                new Product('Fish', 130.00, 'kg', 'fish.jpg', 'Fresh from the sea and delivered with care. Perfect for hearty soups, crispy fried favorites, or your family\'s beloved seafood recipes.'),
                new Product('Pork', 350.00, 'kg', 'pork.jpg', 'Quality cuts selected for tenderness and flavor. From adobo to sinigang, every meal starts with fresh pork from the market.'),
            ],

            'vegetable' => [
                new Product('Beets', 220.00, 'kg', 'beet.jpg', 'Bright, earthy, and naturally sweet. A colorful addition to salads, soups, and healthy home-cooked meals.'),
                new Product('Broccoli', 220.00, 'kg', 'broccoli.jpg', 'Fresh green florets packed with goodness. Perfect for stir-fries, steaming, or adding a healthy crunch to your plate.'),
                new Product('Carrots', 130.00, 'kg', 'carrots.jpg', 'Sweet, crisp, and full of flavor. Great for soups, stews, salads, and everyday cooking.'),
                new Product('Chayote', 60.00, 'kg', 'chayote.jpg', 'A Filipino kitchen staple with a mild, refreshing taste. Perfect for sautéed dishes, soups, and comforting family meals.'),
                new Product('Eggplant', 80.00, 'kg', 'eggplant.jpg', 'Fresh and versatile with a rich, satisfying texture. Ideal for tortang talong, grilling, or savory vegetable dishes.'),
                new Product('Garlic', 150.00, 'kg', 'garlic.jpg', 'The secret ingredient behind every delicious meal. Fresh garlic adds rich aroma and bold flavor to your favorite recipes.'),
                new Product('Mushroom', 180.00, 'kg', 'mushroom.jpg', 'Tender, earthy, and deliciously versatile. A perfect companion for soups, stir-fries, pasta, and meat dishes.'),
                new Product('Onion', 180.00, 'kg', 'onion.jpg', 'Fresh and flavorful, bringing natural sweetness and depth to every dish. A must-have for every kitchen.'),
                new Product('Zucchini', 200.00, 'kg', 'zucchini.jpg', 'Light, fresh, and easy to cook. Perfect for stir-fries, salads, pasta dishes, or healthy side meals.'),
            ],

            'fruit'     => [
                new Product('Banana', 95.00, 'kg', 'banana.jpg', 'Sweet, naturally energizing, and ready to enjoy. The perfect snack for busy days and growing families.'),
                new Product('Mango', 200.00, 'kg', 'mango.jpg', 'Juicy, fragrant, and bursting with tropical sweetness. Enjoy the fruit in every bite.'),
                new Product('Cucumber', 100.00, 'kg', 'cucumber.jpg', 'Cool, crisp, and refreshing. Ideal for salads, healthy snacks, and refreshing side dishes.'),
                new Product('Tomato', 66.00, 'kg', 'tomato.jpg', 'Fresh, juicy, and full of flavor. A kitchen essential that brings life to sauces, salads, and everyday meals.'),
            ],

            'poultry'   => [
                new Product('Eggs', 270.00, 'kg', 'egg.jpg', 'Farm-fresh and packed with nutrition. A reliable staple for breakfast, baking, and countless family recipes.'),
                new Product('Chicken', 200.00, 'kg', 'chicken.jpg', 'Fresh, juicy, and ready for your next home-cooked feast. A versatile favorite for roasting, frying, stewing, and everything in between.'),
            ],

            'grain'     => [
                new Product('Rice', 50.00, 'kg', 'rice.jpg', 'The heart of every Filipino meal. Carefully selected grains that cook fluffy, fragrant, and satisfying every time.'),
            ],
        ];

        $products = $productSeeds;
        // var_dump($products);
        foreach ($products as $category => $productList) {
            // echo "looping " . $category;
            foreach ($productList as $id => $product) {
                DB::addProduct(
                    $product->name,
                    $category,
                    // $product->category,
                    $product->price,
                    $product->priceUnit,
                    1,
                    $product->image,
                    $product->description,
                );
                // echo "added " . $product->name;
            }
        }
    }

    public static function getAccounts() {
        $query = "SELECT * FROM accounts;";
        $statement = DB::getConnection()->prepare($query);
        $statement->execute();
        $result = $statement->get_result();
        $rows   = [];
        while ($row = $result->fetch_assoc()) {
            array_push($rows, $row);
        }
        return $rows;
    }

    public static function getAccountByID() {

    }

    public static function addAccount(string $name, string $password) {

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
        string $description
    ) {
        $query     = "INSERT IGNORE INTO products (name, category, price, price_unit, quantity, image, description) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $statement = DB::getConnection()->prepare($query);
        $statement->bind_param("ssdsiss", $name, $category, $price, $priceUnit, $quantity, $image, $description);
        $statement->execute();
    }

    public static function addCategory(string $category)
    {
        $query     = "INSERT IGNORE INTO product_categories (category) VALUES (?)";
        $statement = DB::getConnection()->prepare($query);
        $statement->bind_param("s", $category);
        $statement->execute();
    }

    public static function getProductCategories()
    {
        $query     = "SELECT * FROM product_categories;";
        $statement = DB::getConnection()->prepare($query);
        $statement->execute();
        $result = $statement->get_result();
        $rows   = [];
        while ($row = $result->fetch_assoc()) {
            array_push($rows, $row);
        }

        return $rows;
    }

    /**
     * Retrieves products
     */
    public static function getProducts(string|null $category)
    {
        $query = "SELECT * FROM products;";
        if ($category !== null) {
            $query = "SELECT * FROM products WHERE category=?;";
        }

        $statement = DB::getConnection()->prepare($query);
        if ($category !== null) {
            $statement->bind_param("s", $category);
        }

        $statement->execute();
        $result = $statement->get_result();
        $rows   = [];
        while ($row = $result->fetch_assoc()) {
            array_push($rows, $row);
        }

        return $rows;
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
        $result = $statement->get_result();

        return $result->fetch_assoc();
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
        $result = $statement->get_result();

        return $result->fetch_assoc();
    }

    public static function removeProductByName(string $name)
    {
        $query     = "DELETE FROM products WHERE name=?;";
        $statement = DB::getConnection()->prepare($query);
        $statement->bind_param("s", $name);
        $statement->execute();
        $result = $statement->get_result();

        return $result->fetch_assoc();
    }
}
// Product::setupProductSeed();

// $products = [
//     'meat' => [
//         new Product('Fish', 130.00, 'kg', 'fish.jpg', 'Fresh from the sea and delivered with care. Perfect for hearty soups, crispy fried favorites, or your family\'s beloved seafood recipes.'),
//         new Product('Pork', 350.00, 'kg', 'pork.jpg', 'Quality cuts selected for tenderness and flavor. From adobo to sinigang, every meal starts with fresh pork from the market.'),
//     ],

//     'vegetables' => [
//         new Product('Beets', 220.00, 'kg', 'beet.jpg', 'Bright, earthy, and naturally sweet. A colorful addition to salads, soups, and healthy home-cooked meals.'),
//         new Product('Broccoli', 220.00, 'kg', 'broccoli.jpg', 'Fresh green florets packed with goodness. Perfect for stir-fries, steaming, or adding a healthy crunch to your plate.'),
//         new Product('Carrots', 130.00, 'kg', 'carrots.jpg', 'Sweet, crisp, and full of flavor. Great for soups, stews, salads, and everyday cooking.'),
//         new Product('Chayote', 60.00, 'kg', 'chayote.jpg', 'A Filipino kitchen staple with a mild, refreshing taste. Perfect for sautéed dishes, soups, and comforting family meals.'),
//         new Product('Eggplant', 80.00, 'kg', 'eggplant.jpg', 'Fresh and versatile with a rich, satisfying texture. Ideal for tortang talong, grilling, or savory vegetable dishes.'),
//         new Product('Garlic', 150.00, 'kg', 'garlic.jpg', 'The secret ingredient behind every delicious meal. Fresh garlic adds rich aroma and bold flavor to your favorite recipes.'),
//         new Product('Mushroom', 180.00, 'kg', 'mushroom.jpg', 'Tender, earthy, and deliciously versatile. A perfect companion for soups, stir-fries, pasta, and meat dishes.'),
//         new Product('Onion', 180.00, 'kg', 'onion.jpg', 'Fresh and flavorful, bringing natural sweetness and depth to every dish. A must-have for every kitchen.'),
//         new Product('Zucchini', 200.00, 'kg', 'zucchini.jpg', 'Light, fresh, and easy to cook. Perfect for stir-fries, salads, pasta dishes, or healthy side meals.'),
//     ],

//     'fruits' => [
//         new Product('Banana', 95.00, 'kg', 'banana.jpg', 'Sweet, naturally energizing, and ready to enjoy. The perfect snack for busy days and growing families.'),
//         new Product('Mango', 200.00, 'kg', 'mango.jpg', 'Juicy, fragrant, and bursting with tropical sweetness. Enjoy the fruit in every bite.'),
//         new Product('Cucumber', 100.00, 'kg', 'cucumber.jpg', 'Cool, crisp, and refreshing. Ideal for salads, healthy snacks, and refreshing side dishes.'),
//         new Product('Tomato', 66.00, 'kg', 'tomato.jpg', 'Fresh, juicy, and full of flavor. A kitchen essential that brings life to sauces, salads, and everyday meals.'),
//     ],

//     'poultry' => [
//         new Product('Eggs', 270.00, 'kg', 'egg.jpg', 'Farm-fresh and packed with nutrition. A reliable staple for breakfast, baking, and countless family recipes.'),
//         new Product('Chicken', 200.00, 'kg', 'chicken.jpg', 'Fresh, juicy, and ready for your next home-cooked feast. A versatile favorite for roasting, frying, stewing, and everything in between.'),
//     ],

//     'grains' => [
//         new Product('Rice', 50.00, 'kg', 'rice.jpg', 'The heart of every Filipino meal. Carefully selected grains that cook fluffy, fragrant, and satisfying every time.'),
//     ],
// ];