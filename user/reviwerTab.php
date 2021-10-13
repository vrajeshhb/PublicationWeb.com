<?php
include( "connect.php" );
include( "php_Script.php" );
//session_start();
if ( isset( $_SESSION[ 'email' ] ) ) {

  ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>PUBLICATION WEB | Review Thesis | Permissions </title>
<link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css">
<link rel="stylesheet" href="vendors/base/vendor.bundle.base.css">
<link rel="stylesheet" href="vendors/datatables.net-bs4/dataTables.bootstrap4.css">
<link rel="stylesheet" href="css/style.css">
<link rel="shortcut icon" href="images/favicon2.png" />
</head>

<body <?php if(isset($_GET['edit']) && isset($_GET['tid'])) {echo 'class="sidebar-icon-only"';} ?>>
<div class="container-scroller">
<?php include ("header.php"); ?>

<!-- partial -->
<div class="container-fluid page-body-wrapper">
<?php include("leftsilder.php"); ?>

<!-- partial -->
<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">
		
		
		<?php
      if ( isset( $_GET[ 'tid' ] ) && isset( $_GET['edit'] ) ) {
       
		  $rthesisquery = "SELECT * FROM `thesis` JOIN user ON `thesis`.`user_id` = `user`.`user_id` where t_id = '" . $_GET[ 'tid' ] . "' ";

        $thesisresult = $mysqli->query( $rthesisquery );

        /* fetch object array */
        $thres = $thesisresult->fetch_row();
	$TCSQLQ = "SELECT `user`.`name` FROM `role` join user on `role`.`reviwer_user_id` = `user`.`user_id` WHERE `role`.`t_id` = '" . $_GET[ 'tid' ] . "'  ";

$sql_item_author = $mysqli->query( $TCSQLQ );
		if(isset($_POST['postComent'])){
			
			mysqli_query( $mysqli, "INSERT INTO `thesis_comments` (`tc_id`, `user_id`, `t_id`, `comment`) VALUES (NULL, '".$_SESSION['userid']."', '".$_GET[ 'tid' ]."', '".$_POST['tempCom']."');" );
		}
		?>
		
	
			  
     
		
		<div class="col-5 grid-margin" id="doc-intro">
          <div class="card">
            <div class="card-body" style="margin:4px, 4px;height: 600px;overflow-x: hidden;overflow-y: auto; text-align:justify;"> <a class="btn btn-dark btn-rounded btn-fw" href="reviwerTab.php"> <- Reviewer Tab  </a> <BR>
              
              <h3 class="mb-4 mt-4" style="font-family: 'Gill Sans', 'Gill Sans MT', 'Myriad Pro', 'DejaVu Sans Condensed', Helvetica, Arial, 'sans-serif'; "><?php echo strtoupper($thres[2]).'  | (ID : '.$thres[0].')'; ?></h3>
             
				<p><h3 class="mb-4 mt-4" style="font-family: 'Gill Sans', 'Gill Sans MT', 'Myriad Pro', 'DejaVu Sans Condensed', Helvetica, Arial, 'sans-serif'; font-size: 14px; ">ABSTRACT</h3><hr>
				
				<p><h3 class="mb-4 mt-4" style="font-family: 'Gill Sans', 'Gill Sans MT', 'Myriad Pro', 'DejaVu Sans Condensed', Helvetica, Arial, 'sans-serif'; font-size: 14px; "><?php echo $thres[3]; ?></p> </h3></p>
				
				<p><h3 class="mb-4 mt-4" style="font-family: 'Gill Sans', 'Gill Sans MT', 'Myriad Pro', 'DejaVu Sans Condensed', Helvetica, Arial, 'sans-serif'; font-size: 14px; color :brown; ">Author : <?php echo $thres[12]; ?></p> </h3></p>
			
				<p><h3 class="mb-4 mt-4" style="font-family: 'Gill Sans', 'Gill Sans MT', 'Myriad Pro', 'DejaVu Sans Condensed', Helvetica, Arial, 'sans-serif'; font-size: 14px; color :cadetblue; ">Revewer (s) : 
			<?php
              while ( $cc = $sql_item_author->fetch_row() ) {
                 echo $cc[0].'. | '; 
			  }
			?>
			</h3></p>
		  
		  
		  
		  
				
				
				
            </div>
          </div>
        </div>
			
	
	<div class="col-7 grid-margin" >
          <div class="card">
            
				<div class="card" >
          
              <iframe height="600px" class="card-body" src="<?php echo $thres[7]; ?>"  title="Iframe Example"></iframe>
			
            
          </div>
				
			
			
			
		 </div>
          </div>
        </div>	
	
	<br><br>
	
	
	<div class="col-12 grid-margin" >
          <div   align="center">
            
				
					
			  
			  <form action="completereview.php" method="post" >
				  <input type="hidden" name="tid" value="<?php echo $_GET[ 'tid' ]; ?>" />
				  <input type="hidden" name="edit" value="<?php  echo $_GET['edit']; ?>" />
				<button class="btn btn-info btn-fw"type="submit" align = "center">Complete Review</button> 
					</form>
			  <a href="<?php echo $thres[7]; ?>" download> DOWNLOAD PDF </a><br><br>
			
		 
          </div>
        </div>				
					
			
			<br><br>
			<div class="col-md-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Discussion </h4>
              <?php
		  
		   $review_tid = $_GET[ 'tid' ];
              $TCSQL = "SELECT user.name, thesis_comments.comment from thesis_comments JOIN user on thesis_comments.user_id = user.user_id WHERE t_id = '" . $review_tid . "'  ";
              $sql_item_coment = $mysqli->query( $TCSQL );
              while ( $cc = $sql_item_coment->fetch_row() ) {
                ?>
              <blockquote class="blockquote blockquote-primary">
                <p><?php echo $cc[1]; ?></p>
                <footer class="blockquote-footer"><?php echo $cc[0]; ?></footer>
              </blockquote>
              <?php
              }
              ?>
            </div>
          </div>
        </div>
			
			
			
			<div class="col-md-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Take Part in Discussion :</h4>
            
				<form action="reviwerTab.php?edit=1&tid= <?php echo $_GET[ 'tid' ]; ?>" method="post">
				<textarea name="tempCom" rows="4" class="col-md-12 grid-margin stretch-card"> </textarea>
				<button type="submit" name="postComent" class="btn btn-sm btn-primary" type="button">
                      POST COMMENT
                      </button>
				</form>
            </div>
          </div>
        </div>
		
		<?php } else { ?>
		
		
		
		
		
		
		
		
      <?php
      if ( isset( $_GET[ 'tid' ] ) ) {
        $rthesisquery = "SELECT * FROM  `thesis` where t_id = '" . $_GET[ 'tid' ] . "' ";

        $thesisresult = $mysqli->query( $rthesisquery );

        /* fetch object array */
        $thres = $thesisresult->fetch_row();
        ?>
      <div class="col-12 col-md-10 offset-md-1">
        <div class="col-12 grid-margin" id="doc-intro">
          <div class="card">
            <div class="card-body"> <a class="btn btn-dark btn-rounded btn-fw" href="reviewthesis.php"> <- My 'Thesis' </a> <BR>
              <hr>
              <h3 class="mb-4 mt-4"><?php echo strtoupper($thres[2]).'  | (ID : '.$thres[0].')'; ?></h3>
              <a href="<?php echo $thres[7]; ?>"  class="btn btn-inverse-secondary btn-fw" download> DOWNLOAD PDF </a> <br>
              <br>
              <p><?php echo $thres[3]; ?></p>
            </div>
          </div>
        </div>
       
        <?php
        if ( $_SESSION[ 'userid' ] == $thres[ 1 ] ) {
          ?>
        <div class="col-md-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Request Reviewer</h4>
              <blockquote class="blockquote">
                <p class="mb-0">
                <form action="reviewthesis.php?tid=<?php echo $_GET['tid']; ?>" method="post">
                  <div class="input-group">
                    <input type="text" name="r_email" class="form-control" placeholder="ENTER REVIEWER EMAIL ADDRESS " aria-label="ENTER REVIEWER EMAIL ADDRESS">
                    <div class="input-group-append">
                      <button type="submit" name="request" class="btn btn-sm btn-primary" type="button">
                      REQUEST
                      </button>
                    </div>
                  </div>
                </form>
                </p>
              </blockquote>
            </div>
          </div>
        </div>
        <?php
        }
        ?>
        <div class="col-md-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">REVIEWER'S COMMENT :</h4>
              <?php
		  $review_TCSQL = "SELECT user.name, thesis_comments.comment from thesis_comments JOIN user on thesis_comments.user_id = user.user_id WHERE t_id = '" . $_GET[ 'tid' ] . "'  ";
$sql_item_coment = $mysqli->query( $review_TCSQL );
             

              while ( $cc = $sql_item_coment->fetch_row() ) {
                ?>
              <blockquote class="blockquote blockquote-primary">
                <p><?php echo $cc[1]; ?></p>
                <footer class="blockquote-footer"><?php echo $cc[0]; ?></footer>
              </blockquote>
              <?php
              }
              ?>
            </div>
          </div>
        </div>
        <?php
        } else {

          ?>
        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title"> Thesis | Permissions </h4>
              <p class="card-description"> thesis/ Thesis & Permissions </p>
              <div class="table-responsive">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th> Uploader : </th>
                      <th> Title </th>
                      <th> Abstract </th>
                      <th> Estimation Amount </th>
                     
                      <th> </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
		  
                    while ( $res = $review_sql_item->fetch_row() ) {
                      ?>
                    <tr>
                      <td class="py-1" style="color:black;"><?php echo strtoupper($res[0]).'<br>('.$res[1].')';?></td>
                      <td style="color: blue;"><?php echo substr($res[3], 0, 30) . '...';?></td>
                      <td ><?php echo substr($res[4], 0, 40) . '...' ;?></td>
                      <td><?php echo $res[5].' INR';?></td>
                      
						<td><a href="reviwerTab.php?edit=1&tid= <?php echo $res[2]; ?>" class="btn btn-warning mdi mdi-pen"> Review </a>
                    </tr>
                    <?php
                    }
                    ?>
                    <tr >
                      <td colspan="5"><a href="newthesis.php?count=<?php echo $count; ?>" align="center" >load more.</a></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <?php }?>
      </div>
		  
		  <?php } ?>
      <!-- content-wrapper ends --> 
      <!-- partial:partials/_footer.html -->
      <?php //include ('footer.php');?>
      <!-- partial --> 
    </div>
    <!-- main-panel ends --> 
  </div>
  <!-- page-body-wrapper ends --> 
</div>
<!-- container-scroller --> 

<!-- plugins:js --> 
<script src="vendors/base/vendor.bundle.base.js"></script> 
<!-- endinject --> 
<!-- Plugin js for this page--> 
<script src="vendors/chart.js/Chart.min.js"></script> 
<script src="vendors/datatables.net/jquery.dataTables.js"></script> 
<script src="vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script> 
<!-- End plugin js for this page--> 
<!-- inject:js --> 
<script src="js/off-canvas.js"></script> 
<script src="js/hoverable-collapse.js"></script> 
<script src="js/template.js"></script> 
<!-- endinject --> 
<!-- Custom js for this page--> 
<script src="js/dashboard.js"></script> 
<script src="js/data-table.js"></script> 
<script src="js/jquery.dataTables.js"></script> 
<script src="js/dataTables.bootstrap4.js"></script> 
<!-- End custom js for this page--> 
<script src="js/jquery.cookie.js" type="text/javascript"></script>
</body>
</html>
<?php } ?>