<?php
include( "user/connect.php" );

if ( isset( $_POST[ 'postComent' ] ) ) {

    //mysqli_query( $mysqli, "INSERT INTO `thesis_comments` (`tc_id`, `user_id`, `t_id`, `comment`) VALUES (NULL, '".$_SESSION['userid']."', '".$_GET[ 'tid' ]."', '".$_POST['tempCom']."');" );

    mysqli_query( $mysqli, "INSERT INTO `blogs_comments` (`blogs_comment_id`, `blog_id`, `mail`, `body`) VALUES (NULL, '" . $_POST[ 'blog_id' ] . "', '" . $_POST[ 'mail' ] . "', '" . $_POST[ 'tempCom' ] . "'); " );

	//echo "INSERT INTO `blogs_comments` (`blogs_comment_id`, `blog_id`, `mail`, `body`) VALUES (NULL, '" . $_POST[ 'blog_id' ] . "', '" . $_POST[ 'mail' ] . "', '" . $_POST[ 'tempCom' ] . "'); " ;
  }
if ( isset( $_POST[ 'blog_view' ] ) ) {

  $sql = "SELECT * FROM `blogs` join user on user.user_id = blogs.user_id  where blogs.blog_id = '" . $_POST[ 'blog_id' ] . "' ";
  $result = $mysqli->query( $sql );
  /* fetch object array */
  $res = $result->fetch_row();
  $title = $res[ 2 ];
  $contain = $res[ 3 ];
	$view_count = $res[4];
  $img = $res[ 5 ];
  $author = $res[ 7 ];
  $author_img = $res[ 16 ];
//update nthe view for this page hit.
	echo $view_count++;
	
	$sqlcount = "UPDATE `blogs` SET `view_count` = '".$view_count."' WHERE `blogs`.`blog_id` = '" . $_POST[ 'blog_id' ] . "' ";
	 $mysqli->query( $sqlcount );
  

} else {
  header( "location:index.php" );
}


?>

<!DOCTYPE HTML>
<!--
	Verti by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
<head>
<title></title>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
<link rel="stylesheet" href="assets/css/main.css" />
<link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css">
<link rel="shortcut icon" href="user/images/favicon2.png" />
</head>
<body class="is-preload no-sidebar">
<div id="page-wrapper">
  <?php include("header.php"); ?>
  <!-- Main -->
  <div id="main-wrapper">
    <div class="container">
      <div id="content"> 
        
        <!-- Content -->
        <article>
          <p style="color: darkred">- <?php echo $author; ?> | Insight : <?php echo $view_count. ' visits.'; ?></p>
          <h2><?php echo $title; ?></h2>
          <div class="col-6"><a href="#" class="image fit"><img src="user/<?php echo $img;?>" height="350px" width="100%" alt="" /></a></div>
          <br>
          <p align="justify"> <?php echo $contain; ?> </p>
          <br>
          <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Take Part in Discussion :</h4>
                <form action="blog-view.php" method="post">
                  <input type="hidden" name="blog_id"  value="<?php echo $_POST['blog_id']; ?>" />
                  <input type="hidden" name="blog_view" value="blog_view" />
                  <input type="text" name="mail" placeholder="Mail@domain.com" value="" maxlength="45"/ required>
                  <textarea name="tempCom" rows="4" class="col-md-12 grid-margin stretch-card" maxlength="140" > </textarea>
                  <button type="submit" name="postComent" class="btn btn-sm btn-primary" type="button">
                  POST COMMENT
                  </button>
                </form>
              </div>
            </div>
          </div>
          <br>
          <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Discussion </h4>
                <?php

                 $TCSQL = "SELECT * FROM `blogs_comments` where `blog_id` = '".$_POST['blog_id']."' ORDER BY `blogs_comment_id` DESC limit 0,15 ";
                 $sql_item_coment = $mysqli->query( $TCSQL );
                while ( $cc = $sql_item_coment->fetch_row() ) {
                ?>
                <blockquote class="blockquote blockquote-primary">
                  <p>
                    <?php echo $cc[3]; ?>
                  </p>
                  <footer class="blockquote-footer">
                    <p style="color: cadetblue"><?php  echo '-'.$cc[2]; ?></p>
                  </footer>
                </blockquote>
                <?php
                 }
                ?>
              </div>
            </div>
          </div>
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