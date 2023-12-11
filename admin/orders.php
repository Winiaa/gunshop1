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
                        <th>Customer Name</th>
                        <th>Total Price</th>
                        <th>Order Status</th>
                        <th>Payment Mode</th>
                        <th>Order Placed On</th>
                        <th>Operations</th>
</tr>
</thead>
<tbody>
<?php
// The logic here is showing the order item in the admin part
$sql = "SELECT o.id, o.totalprice, o.orderstatus, o.paymentmode, o.timestamp, u.firstname, u.lastname 
        FROM orders o 
        JOIN usersmeta u ON o.uid = u.uid ORDER BY o.id DESC";
$res = mysqli_query($connection, $sql);

while ($r = mysqli_fetch_assoc($res)) {
    // Your logic for processing each row goes here

?>

    <tr>
        <th scope="row"><?php echo $r['id']; ?></th>
        <td><?php echo $r['firstname']. " " . $r['lastname']; ?></td>
        <td><?php echo $r['totalprice']; ?></td>
        <td><?php echo $r['orderstatus']; ?></td>
        <td><?php echo $r['paymentmode']; ?></td>
        <td><?php echo $r['timestamp']; ?></td>
        <td><a href="editproduct.php?id=<?php echo $r['id']; ?>">Edit</a> | <a href="delproduct.php?id=<?php echo $r['id']; ?>">Delete</a></td>
</tr>
<?php } ?>
</tbody>
</table>
</div>
</div>
</section>

<?php include 'inc/footer.php' ?>
