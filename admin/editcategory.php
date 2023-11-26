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
if(isset($_POST) & !empty($_POST)){
    $name = mysqli_real_escape_string($connection, $_POST['categoryname']);
    $sql = "UPDATE category SET name = '$name' WHERE id=$id";
    $res = mysqli_query($connection, $sql);
    if($res){
        echo "Category Updated";
    }else{
        echo "Failed To Update";
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

                    <label for="Productname">Category Name:</label>
                    <?php
                    $sql = "SELECT * FROM category WHERE id=$id";
                    $res = mysqli_query($connection, $sql);
                    $r = mysqli_fetch_assoc($res);
                    ?>
                    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                    <input type="text" class="form-control" name="categoryname" id="Categoryname"
                           placeholder="Category Name" value="<?php echo $r['name']; ?>">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
        </div>
    </div>
</section>


<?php include 'inc/footer.php' ?>
