<?php
include( "user/connect.php" );
session_start();


if ( isset( $_GET[ 'search' ] ) ) {
  $TCSQL_search = "select `cat`.`rootcatid`,`cat`.`cat_id`,`cat`.`name`,`cat`.`image`,`rootcat`.`name` from `cat` JOIN `rootcat` on `rootcat`.`rootcatid` = `cat`.`rootcatid` where `rootcat`.`name` = '" . $_GET[ 'search' ] . "' ";
} else {
  $TCSQL_search = "select `cat`.`rootcatid`,`cat`.`cat_id`,`cat`.`name`,`cat`.`image`,`rootcat`.`name` from `cat` JOIN `rootcat` on `rootcat`.`rootcatid` = `cat`.`rootcatid` ";
}


$count = 0;
$set = 0;
if ( isset( $_GET[ 'count' ] ) ) {
  $set = $count;
  $count = $count + 9;
} else {
  $count = 9;
  $set = 0;
}

if ( isset( $_GET[ 'search' ] ) ) {

} else {

}


?>
<!DOCTYPE HTML>

<html>
<head>
<title>Publication web | Journals</title>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
<link rel="stylesheet" href="assets/css/main.css" />
</head>
<body class="is-preload left-sidebar">
<div id="page-wrapper">
  <?php include("header.php"); ?>
  
  <!-- Header --> 
  
  <!-- Main -->
  <div id="main-wrapper">
    <div class="container">
      <div id="content"> 
        
        <!-- Content -->
        <article class="col-3 col-1-medium col-12-small">
          <section class="widget thumbnails">
            <h3>Categories</h3>
           
				  <?php
				  	$queryrootcatSEL = "SELECT * FROM `rootcat`";
				   $sql_item_queryrootcatSEL = $mysqli->query( $queryrootcatSEL );
        			while ( $qrcs = $sql_item_queryrootcatSEL->fetch_row() ) {
				  ?>
                <div style="border: 2px solid black; border-radius: 5px; margin-left: 10px;margin-right: 10px;" ><a href="#" class="image fit"><?php echo $qrcs[1]; ?></a></div>
                <?php
					}
				  ?>
             
          </section>
        </article>
		  
        <h3>Categoriestype></h3>
        <?php
        /*$TCSQL_search = "select `cat`.`rootcatid`,`cat`.`cat_id`,`cat`.`name`,`cat`.`image`,`rootcat`.`name` from `cat` JOIN `rootcat` on `rootcat`.`rootcatid` = `cat`.`rootcatid` where `rootcat`.`rootcatid` = 9";*/
        $sql_item_coment_search = $mysqli->query( $TCSQL_search );
        while ( $cc_search = $sql_item_coment_search->fetch_row() ) {
          ?>
        <div >
          <section class="class="widget thumbnails"" >
            <div class="class="grid"">
              
              <form class="row gtr-50" action="newthesis.php" method="post">
                <input type="hidden" name="rootcat" value="<?php echo $cc_search[0] ?>"/>
                <input type="hidden" name="cat" value="<?php echo $cc_search[1] ?>"/>
				  <h4 class="col-1-small"><?php echo $cc_search[2]; ?></h4>
              <br>
                <button class="col-1-small"  type="submit" name="selected" class="btn btn-success btn-rounded btn-fw">Publish Journal -></button>
              </form>
            </div>
          </section>
        </div>
        <?php } ?>
        </article>
      
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
          <section class="widget contact">
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
              <li>&copy; Untitled. All rights reserved</li>
              <li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
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