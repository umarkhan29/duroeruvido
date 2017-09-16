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
                        <h6 class=""><strong class="black-text">Product Upload</strong></h6>
						
						<?php
				
			if(isset($_POST['upload'])){
				$count=0;
							$name=mysqli_real_escape_string($dbconn,trim(strip_tags(stripslashes($_POST['name']))));
							$type=mysqli_real_escape_string($dbconn,trim(strip_tags(stripslashes($_POST['type']))));
							$name=mysqli_real_escape_string($dbconn,trim(strip_tags(stripslashes($_POST['name']))));
							$type=mysqli_real_escape_string($dbconn,trim(strip_tags(stripslashes($_POST['type']))));
							$price=mysqli_real_escape_string($dbconn,trim(strip_tags(stripslashes($_POST['price']))));
							$desc=mysqli_real_escape_string($dbconn,trim(strip_tags(stripslashes($_POST['desc']))));
							$material=mysqli_real_escape_string($dbconn,trim(strip_tags(stripslashes($_POST['material']))));
							$quantity=mysqli_real_escape_string($dbconn,trim(strip_tags(stripslashes($_POST['quantity']))));
							$design=mysqli_real_escape_string($dbconn,trim(strip_tags(stripslashes($_POST['design']))));
							$size=mysqli_real_escape_string($dbconn,trim(strip_tags(stripslashes($_POST['size']))));
							$img1=mysqli_real_escape_string($dbconn,trim(strip_tags(stripslashes($_FILES['img1']['name']))));
							$img2=mysqli_real_escape_string($dbconn,trim(strip_tags(stripslashes($_FILES['img2']['name']))));
							$img3=mysqli_real_escape_string($dbconn,trim(strip_tags(stripslashes($_FILES['img3']['name']))));
							$oname=$name;
							$name=$type."-".$design."-".$material."-".$name;
							
							$img1=explode('.',$img1);
						    $last=count($img1);
							$img1=$img1[$last-1];
							$img1=$name."1.".$img1;
							
							
							$img2=explode('.',$img2);
						    $last=count($img2);
							$img2=$img2[$last-1];
							$img2=$name."2.".$img2;
							
							
							$img3=explode('.',$img3);
						    $last=count($img3);
							$img3=$img3[$last-1];
							 $img3=$name."3.".$img3;
							
							$user=$_SESSION['current_loggedin_user'];
							
							 
							
						if(file_exists("images/products/".$img1)){
							$count=1;	
							echo '<div>Product aleady exists !</div>';
						}
						
						
				
				if($count==0){
							$filepath="images/products/".$img1;
							move_uploaded_file($_FILES['img1']['tmp_name'],$filepath);
							
							
							$filepath="images/products/".$img2;
							move_uploaded_file($_FILES['img2']['tmp_name'],$filepath);
							
							
							$filepath="images/products/".$img3;
							move_uploaded_file($_FILES['img3']['tmp_name'],$filepath);
				
						
							if(mysqli_query($dbconn,"INSERT INTO `products`(`name`, `type`, `material`, `design`, `img1`, `img2`, `img3`, `addedby`, `price`, `quantity`, `desc`,`size`) VALUES ('$oname','$type','$material','$design','$img1','$img2','$img3','$user','$price','$quantity','$desc','$size')")){
								echo '<div style="font-family:Arial, Helvetica, sans-serif; padding:5px;"> Product Uploaded Sucessfully !</div>';
							}
							else{
								echo mysqli_error($dbconn);
								die('<div style="font-family:Arial, Helvetica, sans-serif; padding:5px; color:red"> Could Not Upload!</div>');
								
							}
						}
				
						
				}
		
		
		
	
	?>
	
	
	
	
	
	
                    </div>
                </div>
				
				
                <div class="row">
                    <div class="col-md-7 col-sm-10 text-center center-col">
                        <form action="" method="post" enctype="multipart/form-data">
                            <!-- input -->
                            <input type="text" placeholder="Product Name" required name="name">
                            <!-- end input -->
							
							<select required name="type"  >
								<option value="" disabled selected>--Select Product-- </option>
								<option value="T-Shirt">T-Shirt </option>
								<option value="Jeans">Jeans</option>
								<option value="Jackets">Jackets</option>
							</select>
							
							
							<select required name="material">
								<option value="" disabled selected>--Select Material-- </option>
								<option value="Cotton">Cotton</option>
								<option value="Jeans">Jeans</option>
								<option value="Wool">Wool</option>
								<option>Leather </option>
							</select>
							
							
							<select required name="design">
								<option value="" disabled selected>--Select Design-- </option>
								<option value="Round">Round </option>
								<option value="Collar">Collar </option>
								<option value="Full Sleves">Full-Sleves </option>
								<option value="Half Sleves">Half-Sleves </option>
							</select>
							
							
							<select required name="size">
								<option value="" disabled selected>--Select Size-- </option>
								<option value="S">S</option>
								<option value="M">M</option>
								<option value="L">L</option>
								<option value="XL">XL</option>
								<option value="XXL">XXL</option>
							</select>
							
							
							
							<input type="number" placeholder="Price" required name="price">
							
							
							<input type="number" placeholder="Quantity" required name="quantity">
							
							
							
							
							<input type="file" required name="img1"  />
							<input type="file" name="img2"  />
							<input type="file" name="img3"  />
                            <!-- textarea  -->
                            <textarea placeholder="Description" name="desc"></textarea>
                            <!-- end textarea  -->
							
							
                            <!-- required  -->
                            <span class="required">*Please complete all fields correctly</span>
                            <!-- end required  -->
                            <!-- button  -->
                            <button class="btn btn-black no-margin-bottom btn-small" name="upload" type="submit">Upload</button>
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