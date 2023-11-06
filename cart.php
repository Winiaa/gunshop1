<?php
@include 'config.php';

if (isset($_POST['update_update_btn'])) {
    $update_value = intval($_POST['update_quantity']); // Ensure it's an integer
    $update_id = intval($_POST['update_quantity_id']); // Ensure it's an integer

    // Here we have to create a prepared statement to update the quantity
    $update_quantity_query = $conn->prepare("UPDATE `cart` SET quantity = ? WHERE id = ?");
    $update_quantity_query->bind_param('ii', $update_value, $update_id);

    // Here to execute the prepared statement
    if ($update_quantity_query->execute()) {
        header('location: cart.php');
    }
}

if (isset($_GET['remove'])) {
    $remove_id = intval($_GET['remove']); // Ensure it's an integer

    // Here we need to create a prepared statement to delete an item
    $delete_item_query = $conn->prepare("DELETE FROM `cart` WHERE id = ?");
    $delete_item_query->bind_param('i', $remove_id);

    // Here we need to execute the prepared statement
    if ($delete_item_query->execute()) {
        header('location: cart.php');
    }
}

if (isset($_GET['delete_all'])) {
    // We need to create a prepared statement to delete all items
    $delete_all_query = $conn->prepare("DELETE FROM `cart`");

    // Here to execute the prepared statement
    if ($delete_all_query->execute()) {
        header('location: cart.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta tags and other head elements are below here -->
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include 'header.php'; ?>

<div class="container">
    <section class="shopping-cart">
        <h1 class="heading">Shopping Cart</h1>
        <table>
            <thead>
            <th>Image</th>
            <th>Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total Price</th>
            <th>Action</th>
            </thead>
            <tbody>
            <?php
            $select_cart = mysqli_query($conn, "SELECT * FROM `cart`");
            $grand_total = 0;

            if(mysqli_num_rows($select_cart) > 0) {
                while($fetch_cart = mysqli_fetch_assoc($select_cart)) {
                    // Here to display cart items
                    echo '<tr>';
                    echo '<td><img src="uploaded_img/' . $fetch_cart['image'] . '" height="100" alt=""></td>';
                    echo '<td>' . $fetch_cart['name'] . '</td>';
                    echo '<td>$' . number_format($fetch_cart['price']) . '/-</td>';
                    echo '<td>';
                    echo '<form action="" method="post">';
                    echo '<input type="hidden" name="update_quantity_id" value="' . $fetch_cart['id'] . '">';
                    echo '<input type="number" name="update_quantity" min="1" value="' . $fetch_cart['quantity'] . '">';
                    echo '<input type="submit" value="Update" name="update_update_btn">';
                    echo '</form>';
                    echo '</td>';
                    $sub_total = $fetch_cart['price'] * $fetch_cart['quantity'];
                    echo '<td>$' . number_format($sub_total) . '/-</td>';
                    echo '<td><a href="cart.php?remove=' . $fetch_cart['id'] . '" onclick="return confirm(\'Remove item from cart?\')" class="delete-btn"><i class="fas fa-trash"></i> Remove</a></td>';
                    echo '</tr>';
                    $grand_total += $sub_total;
                }
            }
            ?>
            <tr class="table-bottom">
                <td><a href="products.php" class="option-btn" style="margin-top: 0;">Continue Shopping</a></td>
                <td colspan="3">Grand Total</td>
                <td>$<?php echo number_format($grand_total); ?>/-</td>
                <td><a href="cart.php?delete_all" onclick="return confirm('Are you sure you want to delete all?');" class="delete-btn"><i class="fas fa-trash"></i> Delete All</a></td>
            </tr>
            </tbody>
        </table>
        <div class="checkout-btn">
            <a href="checkout.php" class="btn <?= ($grand_total > 1) ? '' : 'disabled'; ?>">Proceed to Checkout</a>
        </div>
    </section>
</div>

<!-- Here to include the JavaScript link  -->
<script src="js/script.js"></script>
</body>
</html>

