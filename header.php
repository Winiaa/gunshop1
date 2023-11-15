<header class="header" style="background-color:var(--black)">

   <div class="flex">

      <a href="products.php" class="logo">GunShop</a>

      <nav class="navbar">

          <a href="#">Home</a>
         <a href="products.php">Shop</a>
          <a href="#">About Us</a>




      </nav>

      <?php
      
      $select_rows = mysqli_query($conn, "SELECT * FROM `cart`") or die('query failed');
      $row_count = mysqli_num_rows($select_rows);

      ?>

      <a href="cart.php" class="cart">cart <span><?php echo $row_count; ?></span> </a>


      <div id="menu-btn" class="fas fa-bars"></div>

       <div class="dropdown">
           <button class="dropbtn">
               Login
               <i class="fa fa-caret-down"></i>
           </button>
           <div class="dropdown-content">
               <a href="login_form.php" class="bt">login</a>
               <a href="register_form.php" class="bt">register</a>
               <a href="logout.php" class="bt">logout</a>
           </div>
       </div>

   </div>

</header>