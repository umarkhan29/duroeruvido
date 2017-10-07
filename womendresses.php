<?php
	include_once('home/common/header.html');
?>


        <!-- head section -->
        <section class="page-title parallax3 parallax-fix page-title-large page-title-shop">
            <div class="opacity-light bg-dark-gray"></div>
            <img class="parallax-background-img" src="images/parallax-img16.jpg" alt="" />
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
                            <li class="white-text">Women</li>
                            <li class="white-text">Dresses</li>
                           
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
                    
					
					
                    <div class="class="col-md-12 text-center">
                        <div class="shorting clearfix xs-margin-top-three">
                            <div class="col-md-8 col-sm-7 grid-nav">
                                <a ><i class="fa fa-bars"></i></a>
								Dresses                               
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
						
						<?php 
							$query="SELECT * FROM `products` WHERE `type` = 'dress' and (`productfor` = 'Women' or `productfor` = 'All') order by `id` DESC ;";
				
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
                            <!-- end shop item -->
                           <?php } ?> 
                       
                       
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