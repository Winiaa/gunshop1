<?php
session_start();
require_once 'config/connect.php';
include 'inc/header.php';
include 'inc/nav.php';
$cart = $_SESSION['cart'];
?>


    <!-- SHOP CONTENT -->
    <section id="content">
        <div class="content-blog">
            <div class="container">
                <div class="row">
                    <div class="page_header text-center">
                        <h2>Shop Cart</h2>
                        <p>Get the best kit for smooth shave</p>
                    </div>
                    <div class="col-md-12">

                        <table class="cart-table table table-bordered">
                            <thead>
                            <tr>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php
// Initialize total variable
$total = 0;

foreach ($cart as $key => $value) {
    // Fetch product details from the database
    $cartsql = "SELECT * FROM products WHERE id=$key";
    $cartres = mysqli_query($connection, $cartsql);

    // Check if the query was successful and if the product exists
    if ($cartres && $cartres->num_rows > 0 && $cartr = mysqli_fetch_assoc($cartres)) {
        // Calculate total price for the current product
        $productTotal = $cartr['price'] * $value['quantity'];
        
        // Display row in the cart only if quantity is greater than 0
        if ($value['quantity'] > 0) {
            ?>
            <tr>
                <td>
                    <a class="remove" href="delcart.php?id=<?php echo $key; ?>"><i class="fa fa-times"></i></a>
                    <!-- <?php var_dump($key); ?> -->
                </td>
                <td>
                    <a href="#"><img src="admin/<?php echo $cartr['thumb']; ?>" alt="" height="90" width="90"></a>
                </td>
                <td>
                    <a href="single.php?id=<?php echo $cartr['id']; ?>"><?php echo substr($cartr['name'], 0, 30); ?></a>
                </td>
                <td>
                    <span class="amount">$<?php echo $cartr['price']; ?>.00/-</span>
                </td>
                <td>
                    <div class="quantity"><?php echo $value['quantity']; ?></div>
                </td>
                <td>
                    <span class="amount">$<?php echo $productTotal; ?>.00/-</span>
                </td>
            </tr>
            <?php

            // Update the total price
            $total += $productTotal;
        }
    } else {
        // Handle the case where the product is not found or query fails (optional)
        // You might want to display an error message or take appropriate action.
    }
}
?>


                    
                            <tr>
                                <td colspan="6" class="actions">
                                   <div class="col-md-6">
                                         <!-- <div class="coupon">
                                            <label>Coupon:</label><br>
                                            <input placeholder="Coupon code" type="text"> <button type="submit">Apply</button>
                                        </div> -->
                                    </div>
                                    <div class="col-md-6">
                                        <div class="cart-btn">
                                            <!-- <button class="button btn-md" type="submit">Update Cart</button> -->
                                            <a href="checkout.php" class="button btn-md" >Checkout</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>

                        <div class="cart_totals">
                            <div class="col-md-6 push-md-6 no-padding">
                                <h4 class="heading">Cart Totals</h4>
                                <table class="table table-bordered col-md-6">
                                    <tbody>
                                    <tr>
                                        <th>Cart Subtotal</th>
                                        <td><span class="amount">$<?php echo $total;?>.00/-</span></td>
                                    </tr>
                                    <tr>
                                        <th>Shipping and Handling</th>
                                        <td>
                                            Free Shipping
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Order Total</th>
                                        <td><strong><span class="amount">$<?php echo $total; ?>.00/-</span></strong> </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="clearfix space70"></div>
<?php include 'inc/footer.php' ?>
