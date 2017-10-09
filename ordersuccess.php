<?php
	include_once('home/common/header.html');
	
	if(!isset($_POST["status"]))
			header('location:index');
?>





<?php

$status=$_POST["status"];
$name=$_POST["firstname"];
$price=$_POST["amount"];
$txnid=$_POST["txnid"];
$posted_hash=$_POST["hash"];
$key=$_POST["key"];
$product_name=$_SESSION['product_name']."Quatntities : ".$_SESSION['products_name'];
$email=$_POST["email"];
echo $phones=$_POST["phone"];
$shipping=$_POST["address1"]." ".$_POST["city"]." ".$_POST["zipcode"];


if(mysqli_query($dbconn,"INSERT INTO `user_details` (`trans_id`,`name`,`product_name`,`email`,`price`,`phone`,`shipping_address`) VALUES ('$txnid','$name','$product_name','$email','$price','$phones','$shipping')")){
		
									//notifying admin about product sold
									$message="The product: ".$product_name." is out sold to ".$name."\n  Ensure it's delivery on time.\n Address :".$shipping ;
												 
													mail('umee909@gmail.com',"Product Sold",$message,"From:Duro-E-Ruvido");
									
									//resetting cart
									foreach($_SESSION as $key => $val){
												
												if(preg_match("%^['cart_product_']{13,13}[0-9]{1,2}$%",$key)){
													unset($_SESSION[$key]);
												}
												
												//decrement quqntity
										if(preg_match("%^['sel_']{4,4}[0-9]{1,2}$%",$key)){ //$val is quantity to be decremented
													
													$dec=explode("_",$key);
													$dec= $dec[1];//id
													
													$quantity=mysqli_query($dbconn,"SELECT `quantity` FROM `products` WHERE `id`='$dec'");
													while($row=mysqli_fetch_assoc($quantity)){
													$stock[]=array(
														$stock['QUANTITY']=$row['quantity']);
													}
													$quantity=$stock['QUANTITY']-$val;
													
													
													
													$query="UPDATE `products` SET `quantity`='$quantity' WHERE`id`= '$dec';"; 
													 mysqli_query($dbconn,$query);										
													 
											}
										
										
										}
										//resetting payment variables
										
										unset($_SESSION['pay_phone']);
										unset($_SESSION['product_name']);
										unset($_SESSION['pay_address']);
										unset($_SESSION['totalprice']);
										
										foreach($_SESSION as $key => $val){
												
												if(preg_match("%^['sel_']{4,4}[0-9]{1,2}$%",$key)){
													unset($_SESSION[$key]);
												}
										}
										
									?>
									
									 <!-- head section -->
										<section class="page-title parallax3 parallax-fix page-title-large">
											<div class="opacity-medium bg-black"></div>
											<img class="parallax-background-img" src="images/parallax-img20.jpg" alt="" />
											<div class="container">
												<div class="row">
													<div class="col-md-12 col-sm-12 text-center animated fadeInUp">
														<div class="separator-line bg-yellow no-margin-top margin-four"></div>
														<!-- page title -->
														<h1 class="white-text">You order is Sucessfull !</h1>
														<!-- end page title -->
														<!-- page title tagline -->
														<span class="white-text">Thank You. Your order status is <?php echo $status; ?></span><br />
														<span class="white-text">Your Transaction ID for this transaction is <?php echo $txnid; ?></span>
														<span class="white-text">We have received a payment of Rs <?php echo $price; ?> Your order will soon be shipped.</span>
														<!-- end title tagline -->
													</div>
												</div>
											</div>
										</section>
										<!-- end head section -->
									<?php
										
								
									
								//header('Refresh:17;url=index');
							
		}
		else{
							
				echo '<div style="width:80%;padding-top:50px; padding-bottom:60px; padding-left:20%; overflow:hidden; color:red; font-size:22px; background:#999999;">Something went		 				 wrong.Please Contact Site Adminstrator</div>';
			echo mysqli_error($dbconn);	


			}

  
		        
?>	

<a href="index" > Back to Site </a>

<?php
	include_once('home/common/footer.html');
?>