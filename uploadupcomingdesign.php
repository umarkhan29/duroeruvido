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
								include_once('home/components/addupcomingdesign.khan');
								
								 //throwing success message
							  if(isset($_SESSION['resizedone'])){
								  if($_SESSION['resizedone']=="success"){
								  unset($_SESSION['resizedone']);
								  echo '<div style="font-family:Arial, Helvetica, sans-serif; padding:5px;">  Updated Sucessfully !</div>';
								  }
							  }
						?>
                    </div>
                </div>
				
				
                <div class="row">
                    <div class="col-md-7 col-sm-10 text-center center-col">
 					<form action="" method="POST"  enctype="multipart/form-data">
								
								<input type="text" name="title" placeholder="Title"/><br />
								<input type="text" name="description" placeholder="Description"/><br />
								<input type="file" name="fileupld" placeholder="Only JPG Image" /><br />
								
								
								<input type="submit" name="btn" value="Update"/><br />
					</form>
                    </div>
                </div>
            </div>
        </section>
        <!-- end form option #1 --> 

<?php
	include_once('home/common/footer.html');
?>