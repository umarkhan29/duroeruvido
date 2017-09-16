<?php
	include_once('home/common/header.html');
?>


        <!-- head section -->
        <section class="page-title parallax3 parallax-fix page-title-large page-title-shop">
            <div class="opacity-light bg-dark-gray"></div>
            <img class="parallax-background-img" src="images/parallax-img47.jpg" alt="" />
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 wow fadeIn">
                        <!-- page title tagline -->
                       
                        <!-- end title tagline -->
                        <!-- page title -->
                        <h1 class="white-text">Collection</h1>
                        <!-- end page title -->
                    </div>
                    <div class="col-md-12 col-sm-12 breadcrumb text-uppercase margin-three no-margin-bottom wow fadeIn">
                        <!-- breadcrumb -->
                        <ul>
                            <li class="white-text">Men</li>
                            <li class="white-text">T-Shirts</li>
                           
                        </ul>
                        <!-- end breadcrumb -->
                    </div>
                </div>
            </div>
        </section>
        <!-- end head section -->

        <!-- content section -->
        <section>
            <div class="container">
                <div class="row">
                    <!-- sidebar  -->
                    <div class="col-md-2 col-sm-4 sidebar">
                       
                        <!-- widget  -->
                        <div class="widget">
                            <h5 class="widget-title font-alt">Shop By Size</h5>
                            <div class="thin-separator-line bg-dark-gray no-margin-lr margin-ten"></div>
                            <div class="widget-body">
                                <ul class="size clearfix">
                                    <li class="active"><a href="#">XS</a></li>
                                    <li><a href="#">S</a></li>
                                    <li><a href="#">M</a></li>
                                    <li><a href="#">L</a></li>
                                    <li><a href="#">XL</a></li>
                                    <li><a href="#">XXL</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- end widget  -->
                       
                    </div>
                    <!-- end sidebar  -->
					
					
                    <div class="col-md-9 col-sm-8 col-md-offset-1">
                        <div class="shorting clearfix xs-margin-top-three">
                            <div class="col-md-8 col-sm-7 grid-nav">
                                <a ><i class="fa fa-bars"></i></a>
                               T-Shirts
                               
                            </div>
                            <div class="col-md-3 col-sm-5 pull-right">
                                <div class="select-style input-round med-input shop-shorting no-border">
                                    <select>
                                        <option value="">Select sort by</option>
                                       
                                        <option value="">Price: low to high</option>
                                        <option value="">Price: high to low</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="product-listing margin-three">
						<div id="tees">
						<?php 
							$query="SELECT * FROM `products` WHERE `type` = 'T-Shirt' order by `id` DESC ;";
				
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
                            <div class="col-md-6 col-sm-6">
                                <div class="home-product text-center position-relative overflow-hidden margin-ten no-margin-top">
                                    <a href="productrdr?product_id=<?php echo $results[$i]['ID']; ?>"><img src="images/products/<?php echo $results[$i]['IMG1']; ?>" alt=""/></a>
                                    <span class="product-name text-uppercase"><a href="productrdr?product_id=<?php echo $searchResults[$i]['ID']; ?>"><?php echo $results[$i]['NAME']; ?></a></span>
                                    <span class="price black-text"><?php echo $results[$i]['PRICE']; ?></span>
                                   
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
                            <!-- end shop item -->
                           <?php } ?> 
                        </div>
                       
                       </div> 
					   
					   
						 <!-- pagination -->
                        <!-- end pagination -->
                    </div>
                </div>
            </div>
        </section>
        <!-- end content section -->

<?php
	include_once('home/common/footer.html');
?>