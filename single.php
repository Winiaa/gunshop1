<?php
session_start();
require_once 'config/connect.php';
include 'inc/header.php'; 
include 'inc/nav.php';

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $prodsql = "SELECT * FROM products WHERE id=$id";
    $prodres = mysqli_query($connection, $prodsql);
    $prodr = mysqli_fetch_assoc($prodres);
} else {
    header('location: index.php');
}

?>


    <!-- SHOP CONTENT -->
    <section id="content">
        <div class="content-blog">
            <div class="container">
                <div class="row">
                    <div class="page_header text-center">
                        <h2>Shop</h2>
                        <p>Get the best kit for smooth shave</p>
                    </div>


                    <div class="col-md-10 col-md-offset-1">

                        <div class="row">
                            <div class="col-md-5">
                                <div class="gal-wrap">
                                    <div id="gal-slider" class="flexslider">
                                        <ul class="slides">
                                            <li><img src="admin/<?php echo $prodr['thumb']; ?>" class="img-responsive" alt=""/></li>   
                                        </ul>
                                    </div>
                                    <ul class="gal-nav">
                                        <li>
                                            <div>
                                                <img src="admin/<?php echo $prodr['thumb']; ?>" class="img-responsive" alt=""/>
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>

                                </div>
                            </div>
                            <div class="col-md-7 product-single">
                                <h2 class="product-single-title no-margin"><?php echo $prodr['name']; ?></h2>
                                <div class="space10"></div>
                                <div class="p-price">$<?php echo $prodr['price']; ?>.00/-</div>
                                <p><?php echo $prodr['description']; ?></p>
                                    <form method="get" action="addtocart.php">
                                        <div class="product-quantity">
                                        <span>Quantity:</span>
                                        <input type="hidden" name="id" value="<?php echo $prodr['id']; ?>">
                                        <input type="text" name="quant" placeholder="1">  
                                </div>
                                <div class="shop-btn-wrap">
                                    <input type="submit" class="button btn-small" value = "Add to Cart">
                                </div>
                                </form>
                                <div class="product-meta">
                                    <span>Categories: 
                                        <?php
                                        // In this logic it is showing whic category name in each product when the customer has selected that product
                                         $prodcatsql = "SELECT * FROM category WHERE id={$prodr['catid']}";
                                        $prodcatres = mysqli_query($connection, $prodcatsql);
                                        $prodcatr = mysqli_fetch_assoc($prodcatres);
                                        ?>
                                        <a href="#"><?php echo $prodcatr['name'] ?></a></span><br>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="clearfix space30"></div>
                        <div class="tab-style3">
                            <!-- Nav Tabs -->
                            <div class="align-center mb-40 mb-xs-30">
                                <ul class="nav nav-tabs tpl-minimal-tabs animate">
                                    <li class="active col-md-6">
                                        <a aria-expanded="true" href="#mini-one" data-toggle="tab">Overview</a>
                                    </li>
                                    <!-- <li class="col-md-4">
                                        <a aria-expanded="false" href="#mini-two" data-toggle="tab">Product Info</a>
                                    </li> -->
                                    <li class="col-md-6">
                                        <a aria-expanded="false" href="#mini-three" data-toggle="tab">Reviews</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- End Nav Tabs -->
                            <!-- Tab panes -->
                            <div style="height: auto;" class="tab-content tpl-minimal-tabs-cont align-center section-text">
                                <div style="" class="tab-pane fade active in" id="mini-one">
                                    <p><?php echo $prodr['description']; ?></p> 
                                </div>

                              <!--  <div style="" class="tab-pane fade" id="mini-two">
                                    <table class="table tba2">
                                        <tbody>
                                        <tr>
                                            <td>Sizes</td>
                                            <td>M, L, XL, XXL</td>
                                        </tr>
                                        <tr>
                                            <td>Prodused in</td>
                                            <td>USA</td>
                                        </tr>
                                        <tr>
                                            <td>Material</td>
                                            <td>plastic, textile</td>
                                        </tr>
                                        <tr>
                                            <td>Colors</td>
                                            <td>red, black, grey</td>
                                        </tr>
                                        <tr>
                                            <td>Dimension</td>
                                            <td>20x40x33</td>
                                        </tr>
                                        <tr>
                                            <td>Type</td>
                                            <td>bag</td>
                                        </tr>
                                        <tr>
                                            <td>Weight</td>
                                            <td>0.35kg</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                        -->
                                <div style="" class="tab-pane fade" id="mini-three">
                                    <div class="col-md-12">
                                        <h4 class="uppercase space35">3 Reviews for Shaving Knives</h4>
                                        <ul class="comment-list">
                                            <li>
                                                <a class="pull-left" href="#"><img class="comment-avatar" src="images/quote/1.jpg" alt="" height="50" width="50"></a>
                                                <div class="comment-meta">
                                                    <a href="#">John Doe</a>
                                                    <span>
												<em>Feb 17, 2015, at 11:34</em>
												</span>
                                                </div>
                                                <div class="rating2">
                                                    <span>&#9733;</span><span>&#9733;</span><span>&#9733;</span><span>&#9733;</span><span>&#9733;</span>
                                                </div>
                                                <p>
                                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed auctor sit amet urna nec tempor. Nullam pellentesque in orci in luctus. Sed convallis tempor tellus a faucibus. Suspendisse et quam eu velit commodo tempus.
                                                </p>
                                            </li>
                                            <li>
                                                <a class="pull-left" href="#"><img class="comment-avatar" src="images/quote/2.jpg" alt="" height="50" width="50"></a>
                                                <div class="comment-meta">
                                                    <a href="#">Rebecca</a>
                                                    <span>
												<em>March 08, 2015, at 03:34</em>
												</span>
                                                </div>
                                                <div class="rating2">
                                                    <span>&#9733;</span><span>&#9733;</span><span>&#9733;</span><span>&#9733;</span><span>&#9734;</span>
                                                </div>
                                                <p>
                                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed auctor sit amet urna nec tempor. Nullam pellentesque in orci in luctus. Sed convallis tempor tellus a faucibus. Suspendisse et quam eu velit commodo tempus.
                                                </p>
                                            </li>
                                            <li>
                                                <a class="pull-left" href="#"><img class="comment-avatar" src="images/quote/1.jpg" alt="" height="50" width="50"></a>
                                                <div class="comment-meta">
                                                    <a href="#">Antony Doe</a>
                                                    <span>
												<em>June 11, 2015, at 07:34</em>
												</span>
                                                </div>
                                                <div class="rating2">
                                                    <span>&#9733;</span><span>&#9733;</span><span>&#9733;</span><span>&#9733;</span><span>&#9734;</span>
                                                </div>
                                                <p>
                                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed auctor sit amet urna nec tempor. Nullam pellentesque in orci in luctus. Sed convallis tempor tellus a faucibus. Suspendisse et quam eu velit commodo tempus.
                                                </p>
                                            </li>
                                        </ul>
                                        <h4 class="uppercase space20">Add a review</h4>
                                        <form id="form" class="review-form">
                                            <div class="row">
                                                <div class="col-md-6 space20">
                                                    <input name="name" class="input-md form-control" placeholder="Name *" maxlength="100" required="" type="text">
                                                </div>
                                                <div class="col-md-6 space20">
                                                    <input name="email" class="input-md form-control" placeholder="Email *" maxlength="100" required="" type="email">
                                                </div>
                                            </div>
                                            <div class="space20">
                                                <span>Your Ratings</span>
                                                <div class="clearfix"></div>
                                                <div class="rating3">
                                                    <span>&#9734;</span><span>&#9734;</span><span>&#9734;</span><span>&#9734;</span><span>&#9734;</span>
                                                </div>
                                                <div class="clearfix space20"></div>
                                            </div>
                                            <div class="space20">
                                                <textarea name="text" id="text" class="input-md form-control" rows="6" placeholder="Add review.." maxlength="400"></textarea>
                                            </div>
                                            <button type="submit" class="button btn-small">
                                                Submit Review
                                            </button>
                                        </form>
                                    </div>
                                    <div class="clearfix space30"></div>
                                </div>
                            </div>
                        </div>
                        <div class="space30"></div>
                        <div class="related-products">
                            <h4 class="heading">Related Products</h4>
                            <hr>
                            <div class="row">
                                <div id="shop-mason" class="shop-mason-3col">

                                <?php 
                                    // The code below to get and show the related product that the customer has selected

                                    // This below query to help the custer to get different related products whenever user refresh the page
                                    $relsql = "SELECT * FROM products WHERE id != $id  ORDER BY rand() LIMIT 3";
                                    $relres = mysqli_query($connection, $relsql);
                                    while($relr = mysqli_fetch_assoc($relres)){

                                    
                                ?>
                                    <div class="sm-item isotope-item">
                                        <div class="product">
                                            <div class="product-thumb">
                                                <img src="admin/<?php echo $relr['thumb']; ?>" class="img-responsive" alt="">
                                                <div class="product-overlay">
												<span>
												<a href="single.php?id=<?php echo $relr['id']; ?>" class="fa fa-link"></a>
												<a href="#" class="fa fa-shopping-cart"></a>
												</span>
                                                </div>
                                            </div>
                                            <div class="rating">
                                                <span class="fa fa-star act"></span>
                                                <span class="fa fa-star act"></span>
                                                <span class="fa fa-star act"></span>
                                                <span class="fa fa-star act"></span>
                                                <span class="fa fa-star act"></span>
                                            </div>
                                            <h2 class="product-title"><a href="#"><?php echo $relr['name']; ?></a></h2>
                                            <div class="product-price">$ <?php echo $relr['price']; ?>.00/-<span></span></div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                  
                                   
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="clearfix space70"></div>
<?php include 'inc/footer.php' ?>
