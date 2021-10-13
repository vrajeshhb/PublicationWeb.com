<?php include("user/connect.php"); ?> 
<!DOCTYPE HTML>
<html>
	<head>
		<title>Publication Web | Blogs</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body class="is-preload homepage">
		<div id="page-wrapper">

			<?php include("header.php"); ?>

			

			<!-- Features -->
				<div id="features-wrapper">
					<div class="container">
						<div class="row">
							
							<?php
								$query11 = "SELECT * FROM `blogs` join user on user.user_id = blogs.user_id order by `blog_id` desc limit 0,12 ";
								//echo $count;
								//echo $query11;
								$sql_item = $mysqli->query($query11);
								$n=0;
								while($res=$sql_item->fetch_row())
								{
						
							?>
								
							<div class="col-4 col-12-medium">

								<!-- Box -->
									<section class="box feature">
									<div class="col-6"><a href="#" class="image fit"><img src="user/<?php echo $res[5];?>" height="150px" width="100%" alt="" /></a></div>
										<?php //secho $res[5];?>
										<div class="inner">
											<header>
												<h2><?php echo substr($res[2], 0, 30) . '..';?></h2>
												
											</header>
											<p align="justify"><?php echo substr($res[3], 0, 100) . '...' ;?></p>
											
											<br><p style="color: darkred">- <?php echo $res[7];?></p>
											<p style="color: darkred">Insight : <?php echo $res[4].' visits.';?></p>
											
											<br>
											<form action="blog-view.php" method="post">
												<input type="hidden" name="blog_id" value="<?php  echo $res[0]; ?> " />
											<button type="submit" name="blog_view" class="button icon fa-file-alt">Read More</button>
											</form>
										</div>
										
									</section>

							</div>
							
							<?php } ?>
							
							
							
						</div>
					</div>
				</div>

		
			<!-- Footer -->
				<div id="footer-wrapper">
					<footer id="footer" class="container">
						<div class="row">
							<div class="col-3 col-6-medium col-12-small">

								<!-- Links -->
									<section class="widget links">
										<h3>Random Stuff</h3>
										<ul class="style2">
											<li><a href="#">Etiam feugiat condimentum</a></li>
											<li><a href="#">Aliquam imperdiet suscipit odio</a></li>
											<li><a href="#">Sed porttitor cras in erat nec</a></li>
											<li><a href="#">Felis varius pellentesque potenti</a></li>
											<li><a href="#">Nullam scelerisque blandit leo</a></li>
										</ul>
									</section>

							</div>
							<div class="col-3 col-6-medium col-12-small">

								<!-- Links -->
									<section class="widget links">
										<h3>Random Stuff</h3>
										<ul class="style2">
											<li><a href="#">Etiam feugiat condimentum</a></li>
											<li><a href="#">Aliquam imperdiet suscipit odio</a></li>
											<li><a href="#">Sed porttitor cras in erat nec</a></li>
											<li><a href="#">Felis varius pellentesque potenti</a></li>
											<li><a href="#">Nullam scelerisque blandit leo</a></li>
										</ul>
									</section>

							</div>
							<div class="col-3 col-6-medium col-12-small">

								<!-- Links -->
									<section class="widget links">
										<h3>Random Stuff</h3>
										<ul class="style2">
											<li><a href="#">Etiam feugiat condimentum</a></li>
											<li><a href="#">Aliquam imperdiet suscipit odio</a></li>
											<li><a href="#">Sed porttitor cras in erat nec</a></li>
											<li><a href="#">Felis varius pellentesque potenti</a></li>
											<li><a href="#">Nullam scelerisque blandit leo</a></li>
										</ul>
									</section>

							</div>
							<div class="col-3 col-6-medium col-12-small">

								<!-- Contact -->
									<section class="widget contact last">
										<h3>Contact Us</h3>
										<ul>
											<li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
											<li><a href="#" class="icon brands fa-facebook-f"><span class="label">Facebook</span></a></li>
											<li><a href="#" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
											<li><a href="#" class="icon brands fa-dribbble"><span class="label">Dribbble</span></a></li>
											<li><a href="#" class="icon brands fa-pinterest"><span class="label">Pinterest</span></a></li>
										</ul>
										<p>1234 Fictional Road<br />
										Nashville, TN 00000<br />
										(800) 555-0000</p>
									</section>

							</div>
						</div>
						<div class="row">
							<div class="col-12">
								<div id="copyright">
									<ul class="menu">
										<li>&copy; Untitled. All rights reserved</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
									</ul>
								</div>
							</div>
						</div>
					</footer>
				</div>

			</div>

		<!-- Scripts -->

			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.dropotron.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>