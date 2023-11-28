<?php
session_start();
require_once '../config/connect.php';
if(!isset($_SESSION['email']) & empty($_SESSION['email'])){
    header('location: login.php');
}

if(isset($_GET) & !empty($_GET)){
    $id = $_GET['id'];
}else{
    header('location: categories.php');
}
?>
<?php include 'inc/header.php'?>
<?php include 'inc/nav.php'?>






<section id="content">
    <div class="content-blog">
        <div class="container">
        <?php
                    $sql = "SELECT * FROM products WHERE id=$id";
                    $res = mysqli_query($connection, $sql);
                    $r = mysqli_fetch_assoc($res);
                    ?>
            <form method="post" entype="multipart/form-data">
                <div class="form-group">
                    <label for="Productname">Product Name </label>
                    <input type="text" class="form-control" name="productname" id="Productname" placeholder="Product Name" value="<?php echo $r['name']; ?>">
                </div>
                <div class="form-group">
                    <label for="productdescription">Product Description</label>
                    <textarea class="form-control" name="productdescription" rows="3" value="<?php echo $r['description']; ?>"></textarea>
    	        </div>
                <div class="form-group">
                    <label for="productcategory">Product Category </label>
                    <select class="form-control" name="productcategory" id="productcategory">
                    <?php
                        $catsql = "SELECT * FROM category";
                        $catres = mysqli_query($connection, $catsql);
                        while ($catr = mysqli_fetch_assoc($catres)) {

                ?>
                <option value="<?php echo $catr['id']; ?>"><?php if($catr['id'] == $r['catid']){echo "selected";}?><?php echo $catr['name']; ?></option>
                <?php } ?>
                        
                    </select>
                </div>

                <div class="form-group">
                    <label for="productprice">Product Price </label>
                    <input type="text" class="form-control" name="productprice" id="productprice" placeholder="Product Price" value="<?php echo $r['price']; ?>">
                </div>
                <div class="form-group">
                    <label for="productimage">Product Image </label>
                    <?php if(isset($r['thumb']) & !empty($r['thumb'])){ ?>
                        <br>
                        <img src="<?php echo $r['thumb'] ?>" width="100px" height="100px">
                        <a href="delproding.php?id=<?php $r['id']; ?>">Delete Image</a>
                    <?php }else{ ?>
                    <input type="file" name="productimage" id="productimage" placeholder="Product Image">
                    <p class="help-block">Only jpg/png are allowed.</p>
                    <?php } ?>
                </div>

                <button type="submit" class="btn btn-default">Submit</button>
</form>
        </div>
    </div>
</section>


<?php include 'inc/footer.php' ?>
