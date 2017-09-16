<?php
	include_once('home/common/header.html');
?>


 <!-- head section -->
        <section class="content-top-margin page-title page-title-small bg-gray">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-7 col-sm-12 wow fadeInUp" data-wow-duration="300ms">
                        <!-- page title -->
                        <h1 class="black-text">Login</h1>
                        <!-- end page title -->
                    </div>
                    
                </div>
            </div>
        </section>
        <!-- end head section -->
		
		
		
        <!-- content section -->
        <section class="bg-gray wow fadeIn">
            <div class="container">
                <div class="row">
                    <div class="col-md-5 col-sm-8 col-xs-11 center-col xs-no-padding">
					
					
					
					<?php
						//Authentication module
						include_once('home/components/authenticate.php');
					?>
					
				
                        <form action="" method="POST">
                            <div class="form-group no-margin-bottom">
                                <!-- label  -->
                                <label for="username" class="text-uppercase">Username</label>
                                <!-- end label  -->
                                <!-- input  -->
                                <input type="text" name="usernametxtbox" id="username" class="input-round big-input">
                                <!-- end input  -->
                            </div>
                            <div class="form-group no-margin-bottom">
                                <!-- label  -->
                                <label for="password" class="text-uppercase">Password</label>
                                <!-- end label  -->
                                <!-- input  -->
                                <input type="password" name="passwrdtxtbox" id="password" class="input-round big-input">
                                <!-- end input  -->
                            </div>
                            <button class="btn highlight-button-dark btn-small btn-round margin-five no-margin-right" name="btn" type="submit">Login</button>
                            
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- end content section -->

<?php
	include_once('home/common/footer.html');
?>