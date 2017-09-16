<?php
	include_once('home/common/header.html');
	
?>


 <section id="slider" class="no-padding content-top-margin"> 
            <!-- slider -->
            <div id="owl-demo" class="owl-carousel owl-theme owl-half-slider dark-pagination dark-pagination-without-next-prev-arrow">
                <!-- slider item -->
                <div class="item owl-bg-img" style="background-image:url('images/slider-img38.jpg');">
                    <div class="container position-relative">
                        <div class="slider-typography slider-typography-shop text-left">
                            <div class="slider-text-middle-main">
                                <div class="slider-text-middle padding-left-right-px animated fadeInUp">
                                    <span class="owl-subtitle black-text">Season 2017</span>
                                    <span class="owl-title black-text xs-margin-bottom-seven">Shopping With Style</span>
                                    <a href="tshirts" class="highlight-button-dark btn margin-four">Check Collection</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end slider item -->
                <!-- slider item -->
                <div class="item owl-bg-img" style="background-image:url('images/slider-img39.jpg');">
                    <div class="container position-relative">
                        <div class="slider-typography slider-typography-shop text-left">
                            <div class="slider-text-middle-main">
                                <div class="slider-text-middle padding-left-right-px">
                                    <span class="owl-subtitle black-text">Summer Collection</span>
                                    <span class="owl-title black-text xs-margin-bottom-seven">Incredible Spring Style</span>
                                    <a href="tshirts" class="highlight-button-dark btn margin-four">Check Collection</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end slider item -->
                <!-- slider item -->
                <div class="item owl-bg-img" style="background-image:url('images/slider-img40.jpg');">
                    <div class="container position-relative">
                        <div class="slider-typography slider-typography-shop text-left">
                            <div class="slider-text-middle-main">
                                <div class="slider-text-middle padding-left-right-px">
                                    <span class="owl-subtitle black-text">Best Products</span>
                                    <span class="owl-title black-text xs-margin-bottom-seven">Top Notch Products</span>
                                    <a href="tshirts" class="highlight-button-dark btn margin-four">Check Collection</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end slider item -->
            </div>
            <!-- end slider -->
        </section>

		

		
		  <section>
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h3 class="section-title">Featured Products</h3>
                    </div>
                </div>
                <div class="row">
                    <!-- featured products slider -->
                    <div id="shop-products" class="owl-carousel owl-theme dark-pagination owl-no-pagination owl-prev-next-simple">
					<?php 
					$query="SELECT * FROM `products` order by `price` ASC limit 9 ;";
		
					$products=mysqli_query($dbconn,$query) or die("db error");
					$results="";
					if($products){
							$count=0;
							while($row = mysqli_fetch_assoc($products)){
									$results[] = array(
										
										'ID'			=>	$row['id'],
										'NAME'			=>	$row['name'],
										'PRICE'			=>	$row['price'],
										'IMG1'			=>	$row['img1'],
										
										
									);
								$count=	$count+1;
							}
						
						}
						else{
							echo "No results Found";
						}
					
					for($i=0; $i<$count; $i++){
					?>
                        <!-- shop item -->
                        <div class="item">
                            <div class="home-product text-center position-relative overflow-hidden">
                                <a href="productrdr.php?product_id=<?php echo $results[$i]['ID'];?>"><img src="images/products/<?php echo $results[$i]['IMG1'];?>" alt=""/></a>
                                <span class="product-name text-uppercase"><a href="productrdr.php?product_id=<?php echo $results[$i]['ID'];?>"><?php echo $results[$i]['NAME'];?></a></span>
                                <span class="price black-text"><?php echo $results[$i]['PRICE'];?> Rs</span>
                                <div class="quick-buy">
                                    <div class="quick-buy">
										<div class="product-share">
											<form action="product" method="POST">
												<input type="hidden" name="product_id" value="<?php echo $results[$i]['ID'];?>" /> 
											<input type="submit" value="View" name="view"/>
											</form>
										</div>
                            </div>
                                </div>
                            </div>
                        </div>
                        <!-- end shop item -->
                        <?php } ?>
                       
                    </div>
                    <!-- end featured products slider -->
                </div>
            </div>
        </section>
		
		
		
		
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h3 class="section-title">New arrivals this month</h3>
                    </div>
                </div>
                <div class="row">
                    <!-- shop item -->
					<?php 
					$query="SELECT * FROM `products` order by `id` DESC limit 9 ;";
		
					$products=mysqli_query($dbconn,$query) or die("db error");
					$results="";
					if($products){
							$count=0;
							while($row = mysqli_fetch_assoc($products)){
									$results[] = array(
										
										'ID'			=>	$row['id'],
										'NAME'			=>	$row['name'],
										'PRICE'			=>	$row['price'],
										'IMG1'			=>	$row['img1'],
										
										
									);
								$count=	$count+1;
							}
						
						}
						else{
							echo "No results Found";
						}
					
					for($i=0; $i<$count; $i++){
					?>
					
					
                    <div class="col-md-4 col-sm-4">
                        <div class="home-product text-center position-relative overflow-hidden margin-ten no-margin-top">
                            <a href="productrdr.php?product_id=<?php echo $results[$i]['ID'];?>"><img src="images/products/<?php echo $results[$i]['IMG1'];?>" alt=""/></a>
                            <span class="product-name text-uppercase"><a href="productrdr.php?product_id=<?php echo $results[$i]['ID'];?>"><?php echo $results[$i]['NAME'];?></a></span>
                            <span class="price black-text"><?php echo $results[$i]['PRICE'];?></span>
                           
                            <div class="quick-buy">
                                <div class="product-share">
                                    <form action="product" method="POST">
										<input type="hidden" name="product_id" value="<?php echo $results[$i]['ID'];?>" />
									<input type="submit" value="View" name="view"/>
									</form>
                                </div>
                            </div>
                        </div>
                    </div>
					
					<?php }?>
                    <!-- end shop item -->
                    
                </div>
            </div>
        </section>

        

      
       

       

        <section class="bg-dark-gray">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-6 text-center sm-margin-bottom-ten"><i class="icon-global medium-icon white-text"></i><h6 class="white-text margin-two no-margin-bottom">Free Shipping in Srinagar</h6></div>
                    <div class="col-md-3 col-sm-6 text-center sm-margin-bottom-ten"><i class="icon-heart medium-icon white-text"></i><h6 class="white-text margin-two no-margin-bottom">24/7 Customer Service</h6></div>
                    <div class="col-md-3 col-sm-6 text-center xs-margin-bottom-ten"><i class="icon-happy medium-icon white-text"></i><h6 class="white-text margin-two no-margin-bottom">100% Customer Satisfaction</h6></div>
                    <div class="col-md-3 col-sm-6 text-center"><i class="icon-gift medium-icon white-text"></i><h6 class="white-text margin-two no-margin-bottom">Next Day Delivery</h6></div>
                </div>
            </div>
        </section>




<?php
	include_once('home/common/footer.html');
?>