<?php
	include_once('home/common/header.html');
	if(!isset($_GET['search']))
		header('location:index');
?>


<?php

	$count=0;
	
	if(isset($_GET['search'])){
		
		$keywords = mysqli_real_escape_string($dbconn,trim(strip_tags(stripslashes($_GET['search']))));
	
		if($keywords){
			
			$searching = new Search($keywords);
			$result = $searching->result; 
			$resultCount = $searching->resultCount;
			
			if($result){
				$searchResults;
				while($row = mysqli_fetch_assoc($result)){
					$searchResults[] = array(
							
							'ID'			=>	$row['id'],
							'NAME'			=>	$row['name'],
							'PRICE'			=>	$row['price'],
							'IMG1'			=>	$row['img1'],
						);
						 $count=$count+1;
						
				}
				
			}
			else{
				
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
														<h1 class="white-text">No Results Found !</h1>
														<!-- end page title -->
														<!-- page title tagline -->
														<span class="white-text">Please try a different Keyword</span>
														
														<!-- end title tagline -->
													</div>
												</div>
											</div>
										</section>
										<!-- end head section -->
									<?php
			}
		}
		else{
				echo ('<div style="font-family:Arial, Helvetica, sans-serif; padding:5px; font-size:40px; color:#602D8D; background-color:#414045; width:60%; height:100px; margin:auto; 	margin-top:40px; margin-bottom:40px; padding-left:120px; padding-top:30px; border-radius:7px;">Enter atleast one keyword to search anything !</div>');
				
		}

	}
		

	class Search{
		private $search_keywords = "";
		public $result;
		public $resultCount;
		function __construct($keywords){
			$this->resultCount = 0;
			$this->search_keywords = $this->splitKeywords($keywords);
			
			$this->result = $this->searchNow();
		}
		private function searchNow(){
			if(count($this->search_keywords) == 0){
				return FALSE;
			}
			$dbconn=mysqli_connect('localhost','duroeruvido','duroeruvido') or die('could not connect');
			mysqli_select_db($dbconn,'duroeruvido') or die('database error');
			 $query = $this->getQuery();
			if($result = mysqli_query($dbconn,$query)){
				
				if(mysqli_num_rows($result)!=0){
					$this->resultCount = mysqli_num_rows($result);
					
					return $result;
				}
				return FALSE;
			}
			else{
				echo mysqli_error($dbconn);
				echo "bihbb";
			}
			return FALSE;


		}
		private function splitKeywords($keywords){
			$words = preg_split('/\s+/', $keywords);
			return $words;
		}
		private function getQuery(){
			$count = count($this->search_keywords);
			$words = $this->search_keywords;
			$query = "SELECT * FROM `products` WHERE ";
			
			$where = "";
			for($i = 0; $i < $count; $i++){
				$where .= "`id` like '%$words[$i]%'";
				if($i != $count-1){
					$where .= ' OR ';
				}
			}
			
			$where .= ' OR ';
			for($i = 0; $i < $count; $i++){
				$where .= "`name` like '%$words[$i]%'";
				if($i != $count-1){
					$where .= ' OR ';
					}
					}
					
					
			$where .= ' OR ';
			for($i = 0; $i < $count; $i++){
				$where .= "`type` like '%$words[$i]%'";
				if($i != $count-1){
					$where .= ' OR ';
				}
			}
			
			$where .= ' OR ';
			for($i = 0; $i < $count; $i++){
				$where .= "`price` like '%$words[$i]%'";
				if($i != $count-1){
					$where .= ' OR ';
				}
			}
			
			$where .= ' OR ';
			for($i = 0; $i < $count; $i++){
				$where .= "`material` like '%$words[$i]%'";
				if($i != $count-1){
					$where .= ' OR ';
				}
			}
			
			$where .= ' OR ';
			for($i = 0; $i < $count; $i++){
				$where .= "`design` like '%$words[$i]%'";
				if($i != $count-1){
					$where .= ' OR ';
				}
			}
			
			$query .= $where;
			
			return $query;
		}
	}
?>

<section class="content-top-margin page-title page-title-small bg-gray">
            <div class="container">
               
                    <div class="col-lg-8 col-md-7 col-sm-12 wow fadeInUp" data-wow-duration="300ms">
                        <!-- page title -->
                        <h1 class="black-text">Search Results</h1>
                        <!-- end page title -->
						<div class="breadcrumb"?
						<ul>
                           
                        </ul>
						</div>
                    </div>
                    
                
            </div>
 </section>
   <div class="col-md-2 col-sm-4 sidebar">
   </div>
 
        <!-- content section -->
        <section>
            <div class="container">
                <div class="row">
					
					
                    <div class="col-md-9 col-sm-8 col-md-offset-1">
                        
                        <div class="product-listing margin-three">
						<div id="tees">
						<?php 
							
							
							
							for($i=0; $i<$count; $i++){
					?>
						
                            <!-- shop item -->
                            <div class="col-md-6 col-sm-6">
                                <div class="home-product text-center position-relative overflow-hidden margin-ten no-margin-top">
                                    <a href="productrdr?product_id=<?php echo $searchResults[$i]['ID']; ?>"><img src="images/products/<?php echo $searchResults[$i]['IMG1']; ?>" alt=""/></a>
                                    <span class="product-name text-uppercase"><a href="productrdr?product_id=<?php echo $searchResults[$i]['ID']; ?>"><?php echo $searchResults[$i]['NAME']; ?></a></span>
                                    <span class="price black-text"><?php echo $searchResults[$i]['PRICE']; ?></span>
                                   
                                    <div class="quick-buy">
                                        <div class="product-share">
                                            <form action="product" method="POST">
												<input type="hidden" name="product_id" value="<?php echo $searchResults[$i]['ID'];?>" /> 
											<input type="submit" value="View" name="view"/>
											</form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end shop item -->
                           <?php } ?> 
                        </div>
                       
                       </div> 
					   
					   
						 <!-- pagination -->
                        <!-- end pagination -->
                    </div>
                </div>
            </div>
        </section>
        <!-- end content section -->

<?php
	include_once('home/common/footer.html');
?>