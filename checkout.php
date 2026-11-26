<?php
require_once './core/script-init.php';

$_SESSION['last-page'] = 'checkout';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Out | Starman Palengke</title>
    <link rel="stylesheet" href="./styles/theme.css">
    <style>

        * {
            box-sizing: border-box;
               }

        #checkout-container {
            border: 1px solid black;
            width: 80%;
            margin: auto;
            display: flex;
            justify-content: space-around;
            background-image: url("./assets/texture-wood.jpg");
        }

        #customer-info {
            background-color: rgb(255, 255, 255, 0.9);
            /* var(--theme-color-primary); */
            width: 45%;
        }

        #order-summary {
            background-color: rgb(255, 255, 255, 0.9);
            width: 45%;
        }

        #summary-items {
            display: flex;
            flex-direction: column;
            border-top: 3px solid black;
            max-height: 50vh;
            overflow: auto;
        }

        #summary-details {
            /* display: flex;
            justify-content: space-around; */
            border-top: 3px solid black;
        }

        #summary-details p#label-total {
            display: inline-block;
            width: 49%;
            text-align: left;
        }

        #summary-details p#total {
            display: inline-block;
            width: 49%;
            text-align: right;
        }

        #summary-items .item {
            display: flex;
            flex-direction: row;
            align-items: center;
        }



        #summary-items .item .name {
            max-width: 6rem;
            word-wrap: break-word;
        }

        #summary-items .item * {
            flex: 1 2 auto;
        }

        #summary-items .item .name {
            flex: 1 1 auto;
        }

        #summary-items .item p {
            height: fit-content;
        }

        #summary-items .item .image-container {
            width: 100px;
            height: 100px;
        }

        #summary-items .item .image-container img {
            width: 100px;
            height: 100px;
            aspect-ratio: 1 /1;
        }

        #customer-info-form-container form {
            width: 85%;
            padding: 2rem;
            margin: auto;
        }

        #customer-info-form-container label,
        #customer-info-form-container input {
            display: block;
            width: 100%;
            padding: 0px;
            box-sizing: border-box;
            margin-top: 0.8rem;
        }

        #customer-info-form-container label[for="payment-method"],
        #customer-info-form-container select {
            display: inline-block;
            width: fit-content;
            margin-bottom: 1rem;
        }

        #customer-info-form-container select {
            padding: 0.5rem;
        }

        #customer-info-form-container label {
            margin-top: 1rem;
        }

        #customer-info-form-container input {
            border: 1px solid black;
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
            padding-left: 0.5rem;
            padding-right: 0.5rem;
        }

        #customer-info-form-container button {
            width: 100%;
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
            background-color: var(--theme-color-primary);
            border: 1px solid black;
        }

        #trust-details {
            text-align: center;
            font-size: smaller;
        }

        /* #subtotal-fees {
            display: flex;
            flex-direction: column;
        }

        #subtotal-fees .fee-item {
            display: flex;
            flex-direction: row;
            justify-content: space-evenly;
        }

        #subtotal-fees .fee-item .fee-amount,
        #subtotal-fees .fee-item .fee-name {
            display: inline-block;
        } */

        .fee-item p.fee-name,
        .fee-item p.fee-amount {
            margin-bottom: 0px;
            display: inline-block;
            text-align: right;
        }

        #label-total,
        #label-subtotal,
        .fee-item p.fee-name {
            width: 74%;
        }

        #subtotal {
            text-align: right;
        }

        #total,
        #subtotal,
        .fee-item p.fee-amount {
            width: 25%;
        }

        #subtotal,
        #label-subtotal {
            display: inline-block;
        }

        #order-total {
            border-top: 1px solid black;
        }

         @media screen and (max-width: 768px) {
            #checkout-container {
                flex-direction: column;
                 border: 1px solid black;
                width: 95%;
                margin: auto;
                display: flex;
                justify-content: space-around;
                gap: 1rem;
            }

            #customer-info, #order-summary {
                width: 100%;
                border: none;
                border-radius: 20px;
            }
        

            #customer-info,
        #order-summary {
            width: 100%;
        }

        #summary-items .item {
            flex-wrap: wrap;
            justify-content: center;
        }

        #summary-items .item .image-container, 
        #summary-items .item .image-container img {
            width: 80px;
            height: 80px;
        }

        #summary-items .item .p {
            max-width: 80px;
            margin: 0.25rem 0;
        }

        #customer-info-form-container form {
            width: 100%;
            padding: 1rem;
            box-sizing: border-box;
           }
        }

    </style>
</head>

<body>
    <?php generateHeader(); ?>
    <main>
        <h1>Checkout Your Order</h1>
        <div id="checkout-container">
            <div id="customer-info">
                <h2>Customer Info</h2>
                <div id="customer-info-form-container">
                    <form method="POST" action="./core/action-checkout.php">
                        <label>Name: </label>
                        <input type="text" name="customer-name" required>
                        <label>Contact Number (Optional): </label>
                        <input type="tel" pattern="[0-9]{3}-[0-9]{8}" name="customer-contact-number">
                        <label>Contact Email (Optional): </label>
                        <input type="email" name="customer-contact-email">
                        <label>Delivery Address: </label>
                        <input type="text" name="delivery-address" required>
                        <!-- <label>Delivery Method: </label>
                        <input type="text" name="delivery-address" disabled> -->
                        <label for="payment-method">Payment Method: </label>
                        <select name="payment-method" required>
                            <option value="null" selected>Select Payment Method</option>
                            <option value="cash">Cash on Delivery (COD)</option>
                            <option value="credit">Credit Card</option>
                        </select>
                        <button type="submit">
                            PLACE ORDER
                        </button>
                    </form>
                </div>
            </div>
            <div id="order-summary">
                <h2>Order Summary</h2>
                <div id="summary-items">
                    <?php
                        $total = 0.0;
                        $itemSubtotal = 0.0;
                        $subtotal = 0.0;
                        $shippingFee = 30.0;

                        foreach ($_SESSION['cart'] as $i => $item)  {
                            $product = DB::getProductByID($item->productID);
                            $itemSubtotal = $product['price'] * $item->quantity;
                            $subtotal += $itemSubtotal;
                        ?>
                        <div class="item">
                            <div class="image-container">
                                <img src="./assets/<?= $product['image'] ?>" />
                            </div>
                            <p class="name"><?= $product['name'] ?></p>
                            <p class="price"><?= number_format($product['price'], 2) ?></p>
                            <p class="quantity">X <?= $item->quantity ?></p>
                            <p class="subtotal">PHP <?= number_format($itemSubtotal, 2) ?></p>
                        </div>
                    <?php } 

                    $total = $subtotal + $shippingFee;
                    ?>
                </div>
                <div id="summary-details">
                    <div id="order-subtotal">
                        <p id="label-subtotal">SUBTOTAL:</p>
                        <p id="subtotal">PHP <?= number_format($subtotal, 2) ?></p>
                    </div>
                    <div class="fee-item">
                        <p class="fee-name">SHIPPING FEE</p>
                        <p class="fee-amount">PHP <?= number_format($shippingFee, 2) ?></p>
                    </div>
                    <div id="order-total">
                        <p id="label-total">TOTAL:</p>
                        <p id="total">PHP <?= number_format($total, 2) ?></p>
                    </div>
                </div>
                <p id="trust-details">
                    Secure Payment &#0149; Fresh Quality Products &#0149; Return Policy
                </p>
            </div>
        </div>
    </main>
    <?php generateFooter(); ?>
</body>

</html>
