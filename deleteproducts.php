<?php
	include_once('home/common/header.html');
	require_once(COMPONENTS.CONNECT);
	
	
	include_once('home/components/authorize.khan');
	
	
	//adding admin menu
	include_once('home/components/adminmenu.khan');
?>


<!-- form option #1 -->  
        <section class="wow fadeIn">
            <div class="container">
                <div >
                    <div class="text-center ">
                        <h6 class=""><strong class="black-text">Delete Product</strong></h6>
						<?php
							//deleting product
							if(isset($_POST['del'])){
								$product_id=mysqli_real_escape_string($dbconn,trim(strip_tags(stripslashes($_POST['product_id']))));
								$product_path=mysqli_real_escape_string($dbconn,trim(strip_tags(stripslashes($_POST['product_path']))));
								$product_path2=mysqli_real_escape_string($dbconn,trim(strip_tags(stripslashes($_POST['product_path2']))));
								$product_path3=mysqli_real_escape_string($dbconn,trim(strip_tags(stripslashes($_POST['product_path3']))));
								$query="DELETE FROM `products` WHERE  `id` = '$product_id'";
								if(mysqli_query($dbconn,$query)){
									unlink($product_path);
									unlink($product_path2);
									unlink($product_path3);
									echo "Deleted Sucessfully.";
								}else{
									echo "Failed. Contact Administrator";
								}
							
							
							}
						
						//searching
							if(isset($_POST['delete'])){
								$token=mysqli_real_escape_string($dbconn,trim(strip_tags(stripslashes($_POST['delname']))));
							    $query="SELECT * FROM `products` WHERE `id` = '$token' OR `name` like '%$token%'";
								$result=mysqli_query($dbconn,$query) or die("Db error");
								$count=0;
										if($result){ 
										$count=0;
											while($row = mysqli_fetch_assoc($result)){
														$product_details[] = array(
															'NAME'				=>	$row['name'],
															'DESC'				=>	$row['desc'],
															'ID'				=>	$row['id'],
															'PRICE'				=>  $row['price'],
															'PATH'				=>	$row['img1'],
															'PATH2'				=>	$row['img2'],
															'PATH3'				=>	$row['img3']	
														);	
														
														 $count=$count+1;
														
												}
											}
											
									$flag=0;
									if(isset($product_details[0]['ID'])){
											$flag=1;
									}
									?>
									 <div class="product-listing margin-three">
						<div id="tees">
						<?php 
							for($i=0; $i<$count; $i++){
						?>
						
                            <!-- shop item -->
                            <div class="col-md-6 col-sm-6">
                                <div class="home-product text-center position-relative overflow-hidden margin-ten no-margin-top">
                                    <a ><img src="images/products/<?php echo $product_details[$i]['PATH']; ?>" alt=""/></a>
                                    <span class="product-name text-uppercase"><a ><?php echo $product_details[$i]['NAME']; ?></a></span>
                                    <span class="price black-text"><?php echo $product_details[$i]['PRICE']; ?></span>
                                   
                                    <div class="quick-buy">
                                        <div class="product-share">
                                            <form action="" method="POST">
												<input type="hidden" name="product_id" value="<?php echo $product_details[$i]['ID'];?>" /> 
												<input type="hidden" name="product_path" value="images/products/<?php echo $product_details[$i]['PATH'];?>" /> 
												<input type="hidden" name="product_path2" value="images/products/<?php echo $product_details[$i]['PATH2'];?>" /> 
												<input type="hidden" name="product_path3" value="images/products/<?php echo $product_details[$i]['PATH3'];?>" /> 
											<input type="submit" value="Delete" name="del"/>
											</form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end shop item -->
                           <?php } ?> 
                        </div>
                       
                       </div> 
						<?php
							}
						?>
						
                    </div>
                </div>
				
				
                <div class="row">
                    <div class="col-md-7 col-sm-10 text-center center-col">
                        <form action="" method="post" >
                            <!-- input -->
                            <input type="text" placeholder="Enter Name or Id to Search" required name="delname">
                            <!-- end input -->
							
                            <!-- required  -->
                            <span class="required">*Please fill above fields correctly</span>
                            <!-- end required  -->
                            <!-- button  -->
                            <button class="btn btn-black no-margin-bottom btn-small" name="delete" type="submit">Search</button>
                            <!-- end button  -->
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- end form option #1 --> 

<?php
	include_once('home/common/footer.html');
?>