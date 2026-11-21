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



$products = [
    'meat' => [
        new Product('Fish', 130.00, 'kg', 'fish.jpg', 'Fresh from the sea and delivered with care. Perfect for hearty soups, crispy fried favorites, or your family\'s beloved seafood recipes.'),
        new Product('Pork', 350.00, 'kg', 'pork.jpg', 'Quality cuts selected for tenderness and flavor. From adobo to sinigang, every meal starts with fresh pork from the market.'),
    ],

    'vegetables' => [
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

    'fruits' => [
        new Product('Banana', 95.00, 'kg', 'banana.jpg', 'Sweet, naturally energizing, and ready to enjoy. The perfect snack for busy days and growing families.'),
        new Product('Mango', 200.00, 'kg', 'mango.jpg', 'Juicy, fragrant, and bursting with tropical sweetness. Enjoy the fruit in every bite.'),
        new Product('Cucumber', 100.00, 'kg', 'cucumber.jpg', 'Cool, crisp, and refreshing. Ideal for salads, healthy snacks, and refreshing side dishes.'),
        new Product('Tomato', 66.00, 'kg', 'tomato.jpg', 'Fresh, juicy, and full of flavor. A kitchen essential that brings life to sauces, salads, and everyday meals.'),
    ],

    'poultry' => [
        new Product('Eggs', 270.00, 'kg', 'egg.jpg', 'Farm-fresh and packed with nutrition. A reliable staple for breakfast, baking, and countless family recipes.'),
        new Product('Chicken', 200.00, 'kg', 'chicken.jpg', 'Fresh, juicy, and ready for your next home-cooked feast. A versatile favorite for roasting, frying, stewing, and everything in between.'),
    ],

    'grains' => [
        new Product('Rice', 50.00, 'kg', 'rice.jpg', 'The heart of every Filipino meal. Carefully selected grains that cook fluffy, fragrant, and satisfying every time.'),
    ],
];