<?php
	include_once('home/common/header.html');
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

<?php
	include_once('home/common/footer.html');
?>
