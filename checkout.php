  
  <?php
include_once('home/common/header.html');
  
  
// Merchant key here as provided by Payu
$MERCHANT_KEY = "rjQUPktU";
//$MERCHANT_KEY = "q31XOExG";

// Merchant Salt as provided by Payu
$SALT = "e5iIg1jwi8";
//$SALT = "Orcg6yoKtG";



$PAYU_BASE_URL = "https://test.payu.in";

//$PAYU_BASE_URL = "https://secure.payu.in/_payment ";

$action = '';

$posted = array();
if(!empty($_POST)) {
   
  foreach($_POST as $key => $value) {    
    $posted[$key] = $value; 
	
  }
}

$formError = 0;

if(empty($posted['txnid'])) {
  // Generate random transaction id
  $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
} else {
  $txnid = $posted['txnid'];
}
$hash = '';
// Hash Sequence
$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
if(empty($posted['hash']) && sizeof($posted) > 0) {
  if(
          empty($posted['key'])
          || empty($posted['txnid'])
          || empty($posted['amount'])
          || empty($posted['firstname'])
          || empty($posted['email'])
          || empty($posted['phone'])
          || empty($posted['productinfo'])
          || empty($posted['surl'])
          || empty($posted['furl'])
		  || empty($posted['service_provider'])
  ) {
    $formError = 1; 
	
  } else {
  
  	$_SESSION['pay_phone']=$posted['phone'];
	$_SESSION['pay_address']=$posted['address1'].$posted['city'].$posted['zipcode'];
   
	$hashVarsSeq = explode('|', $hashSequence);
    $hash_string = '';	
	foreach($hashVarsSeq as $hash_var) {
      $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
      $hash_string .= '|';
    }

    $hash_string .= $SALT;


    $hash = strtolower(hash('sha512', $hash_string));
    $action = $PAYU_BASE_URL . '/_payment';
  }
} elseif(!empty($posted['hash'])) {
  $hash = $posted['hash'];
  $action = $PAYU_BASE_URL . '/_payment';
}
?>
  
  
  <?php
	
	if(!isset($_SESSION['totalprice']) OR $_SESSION['totalprice']=="" OR $_SESSION['totalprice']<1)
		header('location:cart');
?>
<script>
    var hash = '<?php echo $hash ?>';
    function submitPayuForm() {
      if(hash == '') {
        return;
      }
      var payuForm = document.forms.payuForm;
      payuForm.submit();
    }
  </script>
  
  
<body onLoad="submitPayuForm()">
<!-- head section -->
        <section class="content-top-margin page-title page-title-small bg-gray">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-7 col-sm-12 wow fadeInUp" data-wow-duration="300ms">
                        <!-- page title -->
                        <h1 class="black-text">Checkout</h1>
                        <!-- end page title -->
                    </div>
                    <div class="col-lg-4 col-md-5 col-sm-12 breadcrumb text-uppercase wow fadeInUp xs-display-none" data-wow-duration="600ms">
                        <!-- breadcrumb -->
                        <ul>
                            <li><a href="index">Home</a></li>
                            <li><a href="cart">Shopping Cart</a></li>
                            <li>Checkout</li>
                        </ul>
                        <!-- end breadcrumb -->
                    </div>
                </div>
            </div>
        </section>
        <!-- end head section -->

        <section>
            <div class="container clearfix">

                <div class="row margin-five no-margin-top">
                    <div class="col-md-5 col-sm-12 pull-left sm-margin-bottom-seven">
                        <p class="black-text font-weight-600 text-uppercase text-large">Give us your address so we can serve you</p>
                        <form id="billing-form" method="post" action="<?php echo $action; ?>" name="payuForm">
                            <div class="col-md-12 no-padding">
                                <label>* Name:</label>
                               <input required name="firstname" id="firstname" value="<?php echo (empty($posted['firstname'])) ? '' : $posted['firstname']; ?>" />
                            </div>
                            
                           
                            <div class="col-md-12 no-padding">
                                <label>* Address:</label>
                                <input required type="text" id="address1" name="address1" value="<?php echo (empty($posted['address1'])) ? '' : $posted['address1']; ?>"/>
                                
                            </div>
                            <div class="col-md-6 no-padding-left sm-no-padding">
                                <label>* City / Town:</label>
                                <input required type="text" id="city" name="city" value="<?php echo (empty($posted['city'])) ? '' : $posted['city']; ?>" />
                            </div>
                            <div class="col-md-6 no-padding-right sm-no-padding">
                                <label>* Postcode:</label>
                                <input required type="text" name="zipcode" value="<?php echo (empty($posted['zipcode'])) ? '' : $posted['zipcode']; ?>" />
                            </div>
                            
                            <div class="col-md-6 no-padding-left sm-no-padding">
                                <label>* Email Address:</label>
                                <input required type="text" id="email" name="email" value="<?php echo (empty($posted['email'])) ? '' : $posted['email']; ?>" />
                            </div>
                            <div class="col-md-6 no-padding-right sm-no-padding">
                                <label>* Phone:</label>
                                <input required type="text" id="phone" name="phone" value="<?php echo (empty($posted['phone'])) ? '' : $posted['phone']; ?>" />
                            </div>
							
					   <input type="hidden" name="hash" value="<?php echo $hash ?>"/>
                       <input type="hidden" name="key" value="<?php echo $MERCHANT_KEY ?>" />
					   <input type="hidden" name="txnid" value="<?php echo $txnid ?>" />
                       <input type="hidden" name="amount" value="<?php echo $_SESSION['totalprice']; ?> " />
					   <input type="hidden" name="productinfo" value="<?php echo $_SESSION['product_name']; ?>" />
					   <input type="hidden" name="surl" value="http://duroeruvido.com/ordersuccess" />
					   <input type="hidden" name="furl" value="http://duroeruvido.com/orderfailure" />
					   <input type="hidden" name="service_provider" value="payu_paisa" size="64" />
					 
                    </div>
                     
					 
					 
					 
					 <div class="col-md-5 col-sm-12 col-xs-12 pull-right"style="padding:40px !important;">
								<div class="row">
                    
                   
                        <table class="table cart-total">
                            <tbody>
                                <tr>
                                    <th class="padding-two text-right no-padding-right text-uppercase font-weight-600 letter-spacing-2 text-small xs-no-padding">Cart Subtotal</th>
                                    <td class="padding-two text-uppercase text-right no-padding-right font-weight-600 black-text xs-no-padding"><?php echo $_SESSION['totalprice']; ?> Rs</td>
                                </tr>
                                <tr>
                                    <th class="padding-two text-right no-padding-right text-uppercase font-weight-600 letter-spacing-2 text-small xs-no-padding">Shipping and Handling</th>
                                    <td class="padding-two text-uppercase text-right no-padding-right font-weight-600 black-text text-small xs-no-padding">Free</td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="padding-one no-padding-right xs-no-padding">
                                        <hr>
                                    </td>
                                </tr>
                                <tr class="total">
                                    <th class="padding-two text-uppercase text-right no-padding-right font-weight-600 text-large xs-no-padding">Order Total</th>
                                    <td class="padding-two text-uppercase text-right no-padding-right font-weight-600 black-text text-large no-letter-spacing xs-no-padding"><?php echo $_SESSION['totalprice']; ?> Rs</td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="padding-one no-padding-right xs-no-padding">
                                        <hr class="no-margin-bottom">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                      
                   		  <button class="highlight-button-black-background btn no-margin pull-right checkout-btn xs-width-100 xs-text-center"  type="submit">Place Order</button>
                </div>
	
				
                 </form>
                
            </div>
        </section>


<?php
	include_once('home/common/footer.html');
?>