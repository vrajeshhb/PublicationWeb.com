<?php
include( "connect.php" );
session_start();
if ( isset( $_SESSION[ 'email' ] ) ) {

  $count = 0;
  $set = 0;
  if ( isset( $_GET[ 'count' ] ) ) {
    $set = $count;
    $count = $count + 9;
  } else {
    $count = 9;
    $set = 0;
  }


  if ( isset( $_POST[ 'request' ] ) ) {
    //fetching entered email data.
    $sql_user_check_data = "SELECT * FROM  `user` where email = '" . $_POST[ 'r_email' ] . "'  ";
    $result_user_check_data = $mysqli->query( $sql_user_check_data );
    $res_user_check_data = $result_user_check_data->fetch_row();
    $no_user_check_data = mysqli_num_rows( $result_user_check_data );
    //possibility check regarding entered email in request field.
    if ( $_POST[ 'r_email' ] == $_SESSION[ 'email' ] ) {
      //if user enter his own email.
      echo '<script language="JavaScript"> alert("Sorry! You Can Not Send Request To Yourself."); </script>';
    } else if ( $no_user_check_data > 0 ) {
      //if user entered email does exist.
      $user_id_to = $res_user_check_data[ 0 ];
      $user_id_from = $_SESSION[ 'userid' ];
      $insert_request = "INSERT INTO `request` (`r_id`, `user_id_from`, `user_id_to`, `t_id`) VALUES (NULL, '" . $user_id_from . "', '" . $user_id_to . "', '" . $_GET[ 'tid' ] . "');";
      mysqli_query( $mysqli, $insert_request );

      echo '<script language="JavaScript"> alert("Request Sent..") </script>';
    } else {
      //if user entered email does not exist.
      echo '<script language="JavaScript"> alert("No such User Registered with us.") </script>';
    }


  }

  ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>PUBLICATION WEB | Review Your Thesis </title>
<link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css">
<link rel="stylesheet" href="vendors/base/vendor.bundle.base.css">
<link rel="stylesheet" href="vendors/datatables.net-bs4/dataTables.bootstrap4.css">
<link rel="stylesheet" href="css/style.css">
<link rel="shortcut icon" href="images/favicon.png" />
</head>

<body>
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
      if ( isset( $_GET[ 'tid' ] ) ) {
        //$rthesisquery = "SELECT * FROM  `thesis` where t_id = '" . $_GET[ 'tid' ] . "' ";
 $rthesisquery = "SELECT * FROM `thesis` JOIN user ON `thesis`.`user_id` = `user`.`user_id` where t_id = '" . $_GET[ 'tid' ] . "' ";
        $thesisresult = $mysqli->query( $rthesisquery );

        /* fetch object array */
        $thres = $thesisresult->fetch_row();
		  
		    
	$TCSQLQ = "SELECT `user`.`name` FROM `role` join user on `role`.`reviwer_user_id` = `user`.`user_id` WHERE `role`.`t_id` = '" . $_GET[ 'tid' ] . "'  ";

$sql_item_author = $mysqli->query( $TCSQLQ );
		  

		  
		  
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
              $TCSQL = "SELECT user.name, thesis_comments.comment from thesis_comments JOIN user on thesis_comments.user_id = user.user_id WHERE t_id = '" . $_GET[ 'tid' ] . "'  ";
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
        <?php
        } else {

          ?>
        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Your Thesis</h4>
              <p class="card-description"> thesis/ </p>
              <div class="table-responsive">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th> thesis ID </th>
                      <th> Title </th>
                      <th> Abstract </th>
                      <th> Estimation Amount </th>
                      <th> Active </th>
                      <th> </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                       //echo $count;
                    //echo $query11;
                    $sql_item = $mysqli->query( $query11 );
                    while ( $res = $sql_item->fetch_row() ) {
                      ?>
                    <tr>
                      <td class="py-1" style="color:black;"><?php echo $res[0];?></td>
                      <td style="color: blue;"><?php echo substr($res[2], 0, 30) . '...';?></td>
                      <td ><?php echo substr($res[3], 0, 40) . '...' ;?></td>
                      <td><?php echo $res[5].' INR';?></td>
                      <td ><?php  if($res[6]==1){echo '<font style="color: green;" >Public </font>';}else{ echo '<font style="color: red;" >No </font>'; }?></td>
                      <td><a href="newthesis.php?edit=<?php echo $res[0]; ?>" class="btn btn-warning">EDIT</a> <br>
                        <br>
                        <a href="reviewthesis.php?tid=<?php echo $res[0]; ?>" class="btn btn-info">REVIEWS</a></td>
                    </tr>
                    <?php
                    }
                    ?>
                    <tr >
                      <td colspan="6"><a href="newthesis.php?count=<?php echo $count; ?>" align="center" >load more.</a></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <?php }?>
      </div>
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