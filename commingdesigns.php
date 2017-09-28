<?php
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
                        <h1 class="white-text">Comming Designs</h1>
                        <!-- end page title -->
                        <!-- page title tagline -->
                        <span class="white-text">Let us know if you like these. Suggest us with your design ideas !</span>
                        <!-- end title tagline -->
                    </div>
                </div>
            </div>
        </section>
        <!-- end head section -->
<?php
//Fetching popular destinations
 $query = "SELECT * FROM `upcomingdesigns` order by `id` desc LIMIT 9 ";
			if($result = mysqli_query($dbconn,$query)){
				$upcomingdesigns;
				$count=0;
				while($row = mysqli_fetch_assoc($result)){
					$upcomingdesigns[] = array(
							
							'ID'			=>	$row['id'],
							'PATH' 			=> 	$row['imgpath'],
							'TITLE' 		=> 	$row['title'],
							'DESCRIPTION' 	=> 	$row['desc']
						);
						 $count=$count+1;
						
				}
				
			}
			else{
				echo mysqli_error($dbconn);
			}

?>
        <!-- content section -->
        <section class="wow fadeIn">
            <div class="container">
                <div class="row zoom-gallery">
				<?php for($i=0;$i<9;$i++){ ?>
                    <div class="col-md-4 col-sm-6 wow fadeIn">
                        <!-- photo item -->
                        <a href="<?php echo $upcomingdesigns[$i]['PATH']; ?>"><img src="<?php echo $upcomingdesigns[$i]['PATH']; ?>" alt="" class="project-img-gallery"></a>
                        <!-- end photo item -->
                    </div>
                 <?php } ?> 
                </div>
            </div>
        </section>


        <!-- end content section -->

   <?php
	include_once('home/common/footer.html');
   ?>