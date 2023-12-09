
<div class="menu-wrap">
    <div id="mobnav-btn">Menu <i class="fa fa-bars"></i></div>
    <ul class="sf-menu">
        <li>
            <a href="#">Home</a>
        </li>
        <li>
            <a href="#">Shop</a>
            <div class="mobnav-subarrow"><i class="fa fa-plus"></i></div>
            <ul>
              
                <?php
                  // The code below to fetch the category
                    $catsql = "SELECT * FROM category";
                    $catres = mysqli_query($connection, $catsql);
                    while($catr = mysqli_fetch_assoc($catres)){
                ?>
                <li><a href="index.php?id=<?php echo $catr['id']; ?>"><?php echo $catr['name']; ?></a></li>
              
                <?php } ?>
            </ul>
        </li>
        <li>
            <a href="#">My Account</a>
            <div class="mobnav-subarrow"><i class="fa fa-plus"></i></div>
            <ul>
                <li><a href="#">My Orders</a></li>
                <li><a href="#">Logout</a></li>
            </ul>
        </li>
        <li>
            <a href="#">Contact</a>
        </li>
    </ul>
    <div class="header-xtra">
    <?php 
    // Check if $_SESSION['cart'] is set before using it
    $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
    ?>
    <div class="s-cart">
        <div class="sc-ico"><i class="fa fa-shopping-cart"></i><em>
            <?php echo count($cart); ?>
        </em></div>

            <div class="cart-info">
                <small>You have <em class="highlight"><?php
                    echo count($cart); ?> item(s)</em> in your shopping bag</small>
                <br>
                <br>
                <?php
$total = 0;

foreach ($cart as $key => $value) {
    $navcartsql = "SELECT * FROM products WHERE id=$key";
    $navcartres = mysqli_query($connection, $navcartsql);
    
    // Check if the query was successful and data exists
    if ($navcartres && mysqli_num_rows($navcartres) > 0) {
        $navcartr = mysqli_fetch_assoc($navcartres);

        ?>
        <div class="ci-item">
            <img src="admin/<?php echo $navcartr['thumb']; ?>" width="70" alt=""/>
            <div class="ci-item-info">
                <h5><a href="single.php?id=<?php echo $navcartr['id']; ?>"><?php echo substr($navcartr['name'], 0, 20); ?></a></h5>
                <?php
                // Check if 'price' and 'quantity' keys exist in the arrays before accessing them
                if (isset($navcartr['price'], $value['quantity'])) {
                    ?>
                    <p><?php echo $value['quantity']; ?> x $<?php echo $navcartr['price']; ?>.00/-</p>
                    <?php
                    $total = $total + ($navcartr['price'] * $value['quantity']);
                }
                ?>
                <div class="ci-edit">
                    <a href="#" class="edit fa fa-edit"></a>
                    <a href="#" class="edit fa fa-trash"></a>
                </div>
            </div>
        </div>
        <?php
    }
}

?>
<div class="ci-total">Subtotal: $<?php echo $total;?>.00/-</div>

                <div class="cart-btn">
                    <a href="cart.php">View Bag</a>
                    <a href="#">Checkout</a>
                </div>
            </div>
        </div>
        <div class="s-search">
            <div class="ss-ico"><i class="fa fa-search"></i></div>
            <div class="search-block">
                <div class="ssc-inner">
                    <form>
                        <input type="text" placeholder="Type Search text here...">
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</header>