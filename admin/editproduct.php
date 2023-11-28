<?php
session_start();
require_once '../config/connect.php';
if(!isset($_SESSION['email']) & empty($_SESSION['email'])){
    header('location: login.php');
}

if(isset($_POST) & !empty($_POST)){
    $name = mysqli_real_string($conneection, $_POST['productname']);
    $description = mysqli_real_escape_string($connection, $_POST['productdescription']);
    $category = mysqli_real_escape_string($connection, $_POST['productcategory']);
    $price = mysqli_real_escape_string($connection, $_POST['productprice']);

    $sql = "INSERT INTO products (name,description,catid,price) VALUES ('$name', '$description', '$category', '$price' )";
    $res = mysqli_query($connection, $sql);
    if($res){
        $smsg = "Product Created Successfully!";
    }else{
        $fmsg = "Failed to Create Product";
    }
}

?>
<?php include 'inc/header.php'?>
<?php include 'inc/nav.php'?>

<section id="content">
    <div class="content-blog">
        <div class="container">
            <form method="post">
                <div class="form-group">
                    <label for="Productname">Product Name </label>
                    <input type="text" class="form-control" name="productname" id="Productname" placeholder="Product Name">
                </div>
                <div class="form-group">
                    <label for="productdescription">Product Description</label>
                    <textarea class="form-control" name="productdescription" rows="3"></textarea>
    	        </div>
                <div class="form-group">
                    <label for="productcategory">Product Category </label>
                    <select class="form-control" name="productcategory" id="productcategory">
                        <option value="">---SELECT CATEGORY---</option>
                        <?php
                        $sql = "SELECT * FROM category";
                        $res = mysqli_query($connection, $sql);
                        while ($r = mysqli_fetch_assoc($res)) {

                ?>
                 <option value="<?php $r['id']; ?>"><?php $r['name']; ?></option>
                        
                <?php } ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="productprice">Product Price </label>
                    <input type="text" class="form-control" name="productprice" id="productprice" placeholder="Product Price">
                </div>
                <div class="form-group">
                    <label for="productimage">Product Image </label>
                    <input type="file" name="productimage" id="productimage" placeholder="Product Image">
                    <p class="help-block">Only jpg/png are allowed.</p>
                </div>

                <button type="submit" class="btn btn-default">Submit</button>
            </form>
        </div>
    </div>
</section>


<?php include 'inc/footer.php' ?>
