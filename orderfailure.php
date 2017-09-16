<?php
$status=$_POST["status"];
$firstname=$_POST["firstname"];
$amount=$_POST["amount"];
$txnid=$_POST["txnid"];
if(!isset($_POST["status"]))
	header('location:index');
include_once('home/common/header.html');
 
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
														<h1 class="white-text">You Payment is cancelled.</h1>
														<!-- end page title -->
														<!-- page title tagline -->
														<span class="white-text"> Your order status is <?php echo $status; ?></span><br />
														<span class="white-text">Your Transaction ID for this transaction is <?php echo $txnid; ?></span>
														<span class="white-text"><p><a href=http://duroeruvido.com/checkout> Try Again</a></p></span>
														<!-- end title tagline -->
													</div>
												</div>
											</div>
										</section>
										<!-- end head section -->
<!--Please enter your website homepagge URL -->

<?php
	include_once('home/common/footer.html');
?>