<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Redirect</title>
</head>

<body>

<?php
	
	if(isset($_GET['product_id'])){
?>
		<form action="product" method="POST" name="ff">
		
			<input type="hidden" name="product_id" value="<?php echo $_GET['product_id']; ?>" />
			
		</form>
	
	
<script type="text/javascript">
	var x = document.getElementsByName("ff");
	x[0].submit();
</script>

	
<?php
	}else{
		header('location:index');
	}
?>


</body>
</html>
