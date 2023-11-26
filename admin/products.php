<?php
session_start();
require_once '../config/connect.php';
if(!isset($_SESSION['email']) & empty($_SESSION['email'])){
    header('location: login.php');
}

?>
<?php include 'inc/header.php'?>
<?php include 'inc/nav.php'?>


<div class="close-btn fa fa-times"></div>


<section id="content">
    <div class="content-blog">
        <div class="container">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Product Name</th>
                        <th>Category Name</th>
                        <th>Thumbnail</th>
                        <th>Operations</th>
</tr>
</thead>
<tbody>
    <tr>
        <th scope="row">S.NO</th>
        <td>Product Name</td>
        <td>Category Name</td>
        <td>Yes/No</td>
        <td><a href="#">Edit</a> | <a href="#">Delete</a></td>
</tr>
</tbody>
</table>
</div>
</div>
</section>

<?php include 'inc/footer.php' ?>
