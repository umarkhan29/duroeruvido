<?php
	include_once('home/common/header.html');
	require_once(COMPONENTS.CONNECT);
?>

 <!-- head section -->
        <section class="content-top-margin page-title page-title-small bg-gray">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-7 col-sm-12 wow fadeInUp" data-wow-duration="300ms">
                        <!-- page title -->
                        <h1 class="black-text">Shopping Cart</h1>

                        <!-- end page title -->
                    </div>
                    <div class="col-lg-4 col-md-5 col-sm-12 breadcrumb text-uppercase wow fadeInUp xs-display-none" data-wow-duration="600ms">
                        <!-- breadcrumb -->
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li>Shopping Cart</li>
                        </ul>
                        <!-- end breadcrumb -->
                    </div>
                </div>
            </div>
        </section>
        <!-- end head section -->
			<?php 
			$_SESSION['products_name']=""; 
			//checkout
			if(isset($_POST['checkout'])){
				
				 $_SESSION['products_name']=""; 

				$_SESSION['totalprice']=mysqli_real_escape_string($dbconn,trim(strip_tags(stripslashes($_POST['totalprice']))));;//cart total
				foreach($_POST as $key => $val){
					if(preg_match("%^['sel_']{4,4}[0-9]{1,2}$%",$key)){
					
						
							 $_SESSION[$key]=$val;
							
						}
					}
					
					
					
					
					
				foreach($_SESSION as $key => $val){
				
					if(preg_match("%^['cart_product_']{13,13}[0-9]{1,2}$%",$key)){
					
						foreach($_POST as $pkey => $pval){
							if(preg_match("%^['sel_']{4,4}[0-9]{1,2}$%",$pkey)){
							
							$pitem=explode('_',$pkey);
							 $pitem=$pitem[1];
							
							if($pitem==$val){
								 $_SESSION['products_name'].="  ( ID : ".$val.", Quantity : ".$pval." ) ---";
								 break;
								}
							}
						
						}
							
					}
				}
				
				header('location:checkout');
			}
				
				
			
		
		?>
			
			
			<?php
				//adding to cart
	if(isset($_GET['tocart'])){
		$flag=0;
		$product=mysqli_real_escape_string($dbconn,trim(strip_tags(stripslashes($_GET['tocart']))));
		if(!isset($_SESSION['id'])){
			$_SESSION['id']=1;
		}
		foreach($_SESSION as $key => $val){
			if(preg_match("%^['cart_product_']{13,13}[0-9]{1,2}$%",$key)){
				if($val==$product){
					echo '<div style="width:35%; color:green; margin:auto; font-size:18px;">Product already added to Cart </div>';
					$flag=1;
				}
			}
			
			}
			
					//checking stock
		
		$quantity=mysqli_query($dbconn,"SELECT `quantity` FROM `products` WHERE `id`='$product'");
												while($row=mysqli_fetch_assoc($quantity)){
												$stock[]=array(
													$stock['QUANTITY']=$row['quantity']);
												}
		if(isset($stock['QUANTITY'])){					
				if($stock['QUANTITY']<1){
					echo '<div style="width:35%; color:red; margin:auto; font-size:18px;">Product Out of Stock </div>';
					$flag=1;
				}
			
			
				if($flag==0){
					$key="cart_product_".$_SESSION['id'];
					$_SESSION[$key]=$product;
					$_SESSION['id']=$_SESSION['id']+1;
					header('location:cart');
				}
				}
		}
			
			?>
			
			
			
			
			
			<?php
//getting cart products from DB					
			
			$count=0;
				if(isset($_SESSION['id'])){
					if($_SESSION['id']>1){
						$count=0;
						$query="SELECT * FROM `products` WHERE `id`= ";
						$flag=0; //for checking first element of cart item in session array
						foreach($_SESSION as $key => $val){
							if(preg_match("%^['cart_product_']{13,13}[0-9]{1,2}$%",$key)){
									if($flag!=0){
										$query.=" or `id` = ";
									}
									$query.=$val;
									$flag=1;
								
							}
						}
							
						if($cart_items=mysqli_query($dbconn,$query)){
								while($row = mysqli_fetch_assoc($cart_items)){
										$cart_products[] = array(
											'NAME'				=>	$row['name'],
											'PATH'				=>	$row['img1'],
											'ID'				=>	$row['id'],
											'QUANTITY'			=>	$row['quantity'],
											'PRICE'			=>	$row['price'],
											
										);
												
										$count=$count+1;	
										
								}			
						}
								
				}
			}
			
			
			
			
			
			
			//removing from cart
	if(isset($_POST['removeitembtn'])){
	
	 $id=mysqli_real_escape_string($dbconn,trim(strip_tags(stripslashes($_POST['remove_cart_id']))));
			foreach($_SESSION as $key => $val){
				if($val == $id){
					
					unset($_SESSION[$key]);
					
					
					
				 }
			}
			
			foreach($_SESSION as $key => $val){
			echo	$eee="sel".$id;
					if($key==$eee){
							unset($_SESSION[$key]);
							
					}
					
				}
			header('location:cart');
	}
	
	 
?>

								
 <form action="" method="POST">

        <!-- content section -->
        <section class="content-section">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 shop-cart-table">
                        <table class="table shop-cart text-center">
                            <thead>
                                <tr>
                                    <th class="first"></th>
                                    <th class="text-left text-uppercase font-weight-600 letter-spacing-2 text-small black-text">Product</th>
                                    <th class="text-left text-uppercase font-weight-600 letter-spacing-2 text-small black-text">Price</th>
                                    <th class="text-left text-uppercase font-weight-600 letter-spacing-2 text-small black-text">Quantity</th>
                                    <th class="text-left text-uppercase font-weight-600 letter-spacing-2 text-small black-text">Sub Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
							
							<?php for($i=0; $i<$count; $i++){ ?>
                                <tr>
                                    <td class="product-thumbnail text-left">
                                        <a href="productrdr?product_id=<?php echo $cart_products[$i]['ID'];?>"><img src="images/products/<?php echo $cart_products[$i]['PATH'];?>"    alt="" style="height:130px !important; width:130px !important;"></a>
                                    </td>
                                    <td class="text-left">
                                        <a href="productrdr?product_id=<?php echo $cart_products[$i]['ID'];?>"><?php echo $cart_products[$i]['NAME']; ?> </a>
                                        <span class="text-uppercase display-block text-small margin-two">SKU: <?php echo $cart_products[$i]['ID']; ?></span>
                                        
                                    </td>
                                    <td class="text-left">
                                        <?php echo $cart_products[$i]['PRICE']; ?>Rs
                                    </td>
                                   
								   
								    <td class="product-quantity">
                                        <div class="select-style med-input shop-shorting shop-shorting-cart no-border-round">
                                            <select name="sel_<?php echo $cart_products[$i]['ID'] ?>" id="quantity<?php echo $i; ?>" onChange="updatetotal('<?php echo $i; ?>','<?php echo $cart_products[$i]['PRICE']?>')">
                                                <?php for($j=1; $j<=$cart_products[$i]['QUANTITY'] ;$j++){ ?>
                                   					 <option value="<?php echo $j; ?>"><?php echo $j; ?></option>
												<?php }?>
                                            </select>
                                        </div>
                                    </td>
									
									
									
                                    <td id="product_total<?php echo $i; ?>" class="product-subtotal text-left"><?php echo $cart_products[$i]['PRICE']; ?> </td>
                                    <td class="product-remove text-center">
										<form action="" method="POST">
											<input type="hidden" name="remove_cart_id" value="<?php echo $cart_products[$i]['ID']; ?>" />
											<button name="removeitembtn" type="submit">X</button>
                                       	    
										</form>
                                    </td>
                                </tr>
                               <?php } ?>
							   
							   
                            </tbody>
                        </table>
                    </div>
                   
                    <div class="col-sm-12 padding-five no-padding-bottom">
                        <div class="col-md-5 col-sm-5 calculate no-padding-left xs-margin-bottom-ten xs-no-padding">
                            
                            <div class="panel panel-default border">
                                <div class="panel-heading no-padding" id="headingTwo" role="tablist">
                                    <a href="#collapse-two-link2" data-parent="#collapse-two" data-toggle="collapse" class="collapsed">
                                        <h4 class="panel-title no-border black-text font-weight-600 letter-spacing-2">Calculate Shipping <span class="pull-right"><i class="fa fa-plus"></i></span></h4>
                                    </a>
                                </div>
                                <div class="panel-collapse collapse" id="collapse-two-link2" style="height: 0px;">
                                    <div class="panel-body">
                                       
                                            <div class="form-wrap">
                                                <div class="form-group">
                                                    <input type="text" placeholder="Postcode">
                                                    <button class="highlight-button btn btn-very-small no-margin pull-left">Update Totals</button>
                                                </div>
                                            </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-7 col-md-offset-1 no-padding-right xs-no-padding">
                            <table class="table cart-total">
                                <tbody>
                                    <tr>
                                        <th class="padding-two text-right no-padding-right text-uppercase font-weight-600 letter-spacing-2 text-small xs-no-padding">Cart Subtotal</th>									
										<input id="tp" type="hidden" name="totalprice" value="" />
                                        <td id="carttotal" class="padding-two text-uppercase text-right no-padding-right font-weight-600 black-text xs-no-padding">Error</td>
                                    </tr>
                                   
                                       
                                   
                                    
                                </tbody>
                            </table>
                           
							
								
								 <button class="highlight-button-black-background btn no-margin pull-right checkout-btn" name="checkout" type="submit">Proceed to Checkout</button>
							
                        </div>
                    </div>
                </div>
            </div>
        </section>
		
		</form>
		 <!-- end content section -->
	
		
       
<script type="text/javascript">
	function updatetotal(span,price){
			var qty='quantity'+span;
			qty=document.getElementById(qty).value;
			var total=qty*price;
			var product_total='product_total'+span;
			document.getElementById(product_total).innerHTML=total;
			total=0;
			var i=0;
			var val=0;
			for(i=0;i<<?php echo $count; ?>; i++){
				qty='product_total'+i;
				val=parseFloat(document.getElementById(qty).innerHTML);
				
				total+=val;
				
			}
			document.getElementById('carttotal').innerHTML=total;
			document.getElementById('tp').value=total;
			
		}
		
		//for first time load
		
			var total=0;
			var i=0;
			var val=0;
			var qty="";
			for(i=0;i<<?php echo $count; ?>; i++){
				qty='product_total'+i;
				val=parseFloat(document.getElementById(qty).innerHTML);
				
				total+=val;
				
			}
			document.getElementById('carttotal').innerHTML=total;
			document.getElementById('tp').value=total;
		
		

</script>

<?php

	include_once('home/common/footer.html');
?>