<?php
	include_once('home/common/header.html');
	require_once(COMPONENTS.CONNECT);
?>

<?php

if(isset($_POST['product_id'])){
	$product=mysqli_real_escape_string($dbconn,trim(strip_tags(stripslashes($_POST['product_id'])))); 
	
	$_SESSION['retain_product']=$product;
}

$product=$_SESSION['retain_product'];
if(!isset($_SESSION['retain_product']))
	$product=17;
	
	
	$product_details;

if($item=mysqli_query($dbconn,"SELECT * FROM `products` WHERE `id` = '$product'") or die("Db error")){
$item=mysqli_fetch_assoc($item);
$product_details []=array(
							'NAME'					=>	$item['name'],
							'ID'					=>	$item['id'],
							'IMG1'					=>	$item['img1'],
							'IMG2'					=>	$item['img2'],
							'IMG3'					=>	$item['img3'],
							'DESC'					=>	$item['desc'],
							'SIZE'					=>	$item['size'],
							'PRICE'					=>	$item['price'],
							'TYPE'					=>	$item['type'],
							'MATERIAL'				=>	$item['material'],
							'DESIGN'				=>	$item['design'],
							'QUANTITY'				=>	$item['quantity']
							
						);
			
}
else{
	die("Query Error");
}


?>
 

        <!-- content section -->
		<form action="" method="POST">
        <section>
            <div class="container">
                <div class="row">
                    <!-- product images -->
                    <div class="col-md-6 col-sm-12 zoom-gallery sm-margin-bottom-ten">
                        <a href="images/products/<?php echo $product_details[0]['IMG1'];?>"><img src="images/products/<?php echo $product_details[0]['IMG1'];?>" alt=""/></a>
                        <div class="products-thumb text-center">
                            <a href="images/products/<?php echo $product_details[0]['IMG1'];?>"><img src="images/products/<?php echo $product_details[0]['IMG1'];?>" alt=""/></a>
                            <a href="images/products/<?php echo $product_details[0]['IMG2'];?>"><img src="images/products/<?php echo $product_details[0]['IMG2'];?>" alt=""/></a>
                            <a href="images/products/<?php echo $product_details[0]['IMG3'];?>"><img src="images/products/<?php echo $product_details[0]['IMG3'];?>" alt=""/></a>
                        </div>
                    </div>
                    <!-- end product images -->
                    <div class="col-md-5 col-sm-12 col-md-offset-1">
                       
                        <!-- product name -->
                        <span class="product-name-details text-uppercase font-weight-600 letter-spacing-2 black-text"><?php echo $product_details[0]['NAME'];?></span>
                        <!-- end product name -->
			
							
							
                        <!-- product stock -->
                        <p class="text-uppercase letter-spacing-2 margin-two"><?php if($product_details[0]['QUANTITY']>0) echo "In Stock"; else echo "Out Of Stock";?> </p>
                        <!-- end product stock -->
                        <div class="separator-line bg-black no-margin-lr margin-five"></div>
                        <!-- product short description -->
                        <p></p>
                        <!-- end product short description -->
                        <span class="price black-text title-small"><?php echo $product_details[0]['PRICE'];?> Rs</span>
                        
						
						
						 <p class="text-uppercase letter-spacing-2 margin-two">Type&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $product_details[0]['TYPE'];?> </p>
						 
						 
						 <p class="text-uppercase letter-spacing-2 margin-two">Material&nbsp;: <?php echo $product_details[0]['MATERIAL'];?> </p>
						
						
							
						 <p class="text-uppercase letter-spacing-2 margin-two">Design&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $product_details[0]['DESIGN'];?> </p>
						
						
						<!-- product size -->
                            <ul class="size clearfix size-details">
                                <li class="active"><a href="#"><?php echo $product_details[0]['SIZE'];?></a></li>
                                <li class="size-chart"><a href="size.html">Size Chart</a></li>
                            </ul>
                            <!-- end product size -->
							
							
							
                        <div class="col-md-3 col-sm-3 no-padding-left margin-five">
                            <div class="select-style med-input xs-med-input shop-shorting-details no-border-round">
                                <!-- product qty -->
                                <select>
                                    <option value="">QTY</option>
									<?php for($i=1; $i<=$product_details[0]['QUANTITY'] ;$i++){ ?>
                                   		 <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
									<?php }?>
                                </select>
                                <!-- end product qty -->
                            </div>
                        </div>
                        <div class="col-md-9 col-sm-9 no-padding margin-five">
                            <!-- add to bag button -->
							<?php 
								if($product_details[0]['QUANTITY']>0){
									echo ' <a class="highlight-button-dark btn btn-medium button" href="cart?tocart='.$product_details[0]['ID'].'"><i class="fa fa-shopping-cart"></i>Add To Cart</a>';
									
								 }
								 else{
								 	 echo '<a class="highlight-button-dark btn btn-medium button" href="#"><i class="icon-basket"></i> Out Of stock</a>';
								}
								
							?>
                           
                            <!-- end add to bag button -->
                        </div>
                        
                        <div class="col-md-8 col-sm-9 product-details-social no-padding">
                            <!-- social media sharing -->
                            <span class="black-text text-uppercase text-small vertical-align-middle margin-right-five">Share on</span>
                            <a href="https://www.facebook.com/sharer.php?u=http://duroeruvido.com/productrdr.php?product_id=<?php echo $product; ?>" target="_blank"><i class="fa fa-facebook"></i></a>
							<a href="whatsapp://send?text=http://duroeruvido.com/productrdr.php?product_id=<?php echo $product; ?>" target="_blank"><i class="fa fa-whatsapp"></i></a>
                            <a href=" http://twitter.com/share?url=http://duroeruvido.com/productrdr.php?product_id=<?php echo $product; ?>" target="_blank"><i class="fa fa-twitter"></i></a>
                            <a href="https://plus.google.com/share?url=http://duroeruvido.com/productrdr.php?product_id=<?php echo $product; ?>" target="_blank"><i class="fa fa-google-plus"></i></a>
                            <a href="https://www.linkedin.com/cws/share?url=http://duroeruvido.com/productrdr.php?product_id=<?php echo $product; ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
                            <!-- end social media sharing -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
	</form>
	
	
	
        <section class="border-top">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <!-- tab -->
                        <div class="tab-style1">
                            <div class="col-md-12 col-sm-12 no-padding">
                                <!-- tab navigation -->
                                <ul class="nav nav-tabs nav-tabs-light text-left">
                                    <li class="active"><a href="#tab_sec1" data-toggle="tab">Description</a></li>
                                    
                                </ul>
                                <!-- tab end navigation -->
                            </div>
                            <!-- tab content section -->
                            <div class="tab-content">
                                <!-- tab content -->
                                <div class="tab-pane med-text fade in active" id="tab_sec1">
                                    <div class="row">
                                       
                                            <p><?php echo $product_details[0]['DESC'];?></p>
                                            <p></p>
                                        
                                       
                                    </div>
                                </div>
                                <!-- end tab content -->
                               
                            </div>
                            <!-- end tab content section -->
                        </div>
                        <!-- end tab -->
                    </div>
                </div>
            </div>
        </section>


			 <!-- open related products -->
       <section>
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h3 class="section-title">Related Products</h3>
                    </div>
                </div>
                <div class="row">
                    <!-- featured products slider -->
                    <div id="shop-products" class="owl-carousel owl-theme dark-pagination owl-no-pagination owl-prev-next-simple">
					<?php 
					
					 $ptype=$product_details[0]['TYPE'];   
					$query="SELECT * FROM `products` WHERE `id` > $product AND `type` = '$ptype';";
		
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
        <!-- end content section -->



<?php
	include_once('home/common/footer.html');
?>