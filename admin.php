<?php


@include 'config.php';

$message = [];

// Here need to add a Product
if (isset($_POST['add_product'])) {
    $productName = $_POST['p_name'];
    $productPrice = $_POST['p_price'];
    $productImage = $_FILES['p_image']['name'];
    $tempImage = $_FILES['p_image']['tmp_name'];
    $imageFolder = 'uploaded_img/' . $productImage;

    $insertQuery = mysqli_query($conn, "INSERT INTO `products` (name, price, image) VALUES ('$productName', '$productPrice', '$productImage')");

    if ($insertQuery) {
        move_uploaded_file($tempImage, $imageFolder);
        $message[] = 'Product added successfully';
    } else {
        $message[] = 'Could not add the product';
    }
}

// Delete a Product
if (isset($_GET['delete'])) {
    $deleteId = $_GET['delete'];
    $deleteQuery = mysqli_query($conn, "DELETE FROM `products` WHERE id = $deleteId ");

    if ($deleteQuery) {
        header('location: admin.php');
        $message[] = 'Product has been deleted';
    } else {
        header('location: admin.php');
        $message[] = 'Product could not be deleted';
    }
}

// Below here need to update a Product
if (isset($_POST['update_product'])) {
    $updateId = $_POST['update_p_id'];
    $updateName = $_POST['update_p_name'];
    $updatePrice = $_POST['update_p_price'];
    $updateImage = $_FILES['update_p_image']['name'];
    $tempUpdateImage = $_FILES['update_p_image']['tmp_name'];
    $updateImageFolder = 'uploaded_img/' . $updateImage;

    $updateQuery = mysqli_query($conn, "UPDATE `products` SET name = '$updateName', price = '$updatePrice', image = '$updateImage' WHERE id = '$updateId'");

    if ($updateQuery) {
        move_uploaded_file($tempUpdateImage, $updateImageFolder);
        $message[] = 'Product updated successfully';
        header('location: admin.php');
    } else {
        $message[] = 'Product could not be updated';
        header('location: admin.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin panel</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php

if(isset($message)){
    foreach($message as $message){
        echo '<div class="message"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
    };
};

?>

<header class="header">

    <div class="flex">

        <a href="admin.php" class="logo">Admin Page</a>

        <nav class="navbar">

        </nav>



        <div id="menu-btn" class="fas fa-bars"></div>

    </div>

</header>

<div class="container">

    <section>

        <form action="" method="post" class="add-product-form" enctype="multipart/form-data">
            <h3>add a new product</h3>
            <input type="text" name="p_name" placeholder="enter the product name" class="box" required>
            <input type="number" name="p_price" min="0" placeholder="enter the product price" class="box" required>
            <input type="file" name="p_image" accept="image/png, image/jpg, image/jpeg" class="box" required>
            <input type="submit" value="add the product" name="add_product" class="btn">
        </form>

    </section>

    <section class="display-product-table">

        <table>

            <thead>
            <th>product image</th>
            <th>product name</th>
            <th>product price</th>
            <th>action</th>
            </thead>

            <tbody>
            <?php

            $select_products = mysqli_query($conn, "SELECT * FROM `products`");
            if(mysqli_num_rows($select_products) > 0){
                while($row = mysqli_fetch_assoc($select_products)){
                    ?>

                    <tr>
                        <td><img src="uploaded_img/<?php echo $row['image']; ?>" height="100" alt=""></td>
                        <td><?php echo $row['name']; ?></td>
                        <td>$<?php echo $row['price']; ?>/-</td>
                        <td>
                            <a href="admin.php?delete=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('are your sure you want to delete this?');"> <i class="fas fa-trash"></i> delete </a>
                            <a href="admin.php?edit=<?php echo $row['id']; ?>" class="option-btn"> <i class="fas fa-edit"></i> update </a>
                        </td>
                    </tr>

                    <?php
                };
            }else{
                echo "<div class='empty'>no product added</div>";
            };
            ?>
            </tbody>
        </table>

    </section>

    <section class="edit-form-container">

        <?php

        if(isset($_GET['edit'])){
            $edit_id = $_GET['edit'];
            $edit_query = mysqli_query($conn, "SELECT * FROM `products` WHERE id = $edit_id");
            if(mysqli_num_rows($edit_query) > 0){
                while($fetch_edit = mysqli_fetch_assoc($edit_query)){
                    ?>

                    <form action="" method="post" enctype="multipart/form-data">
                        <img src="uploaded_img/<?php echo $fetch_edit['image']; ?>" height="200" alt="">
                        <input type="hidden" name="update_p_id" value="<?php echo $fetch_edit['id']; ?>">
                        <input type="text" class="box" required name="update_p_name" value="<?php echo $fetch_edit['name']; ?>">
                        <input type="number" min="0" class="box" required name="update_p_price" value="<?php echo $fetch_edit['price']; ?>">
                        <input type="file" class="box" required name="update_p_image" accept="image/png, image/jpg, image/jpeg">
                        <input type="submit" value="update the prodcut" name="update_product" class="btn">
                        <input type="reset" value="cancel" id="close-edit" class="option-btn">
                    </form>

                    <?php
                };
            };
            echo "<script>document.querySelector('.edit-form-container').style.display = 'flex';</script>";
        };
        ?>

    </section>

</div>



<!-- Here need to custom js file link  -->
<script src="js/script.js"></script>


</body>
</html>