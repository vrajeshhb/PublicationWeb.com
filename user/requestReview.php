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


  if ( isset( $_GET[ 'r_id' ] ) ) {

    if ( isset( $_GET[ 'web' ] ) == 'a' ) {
      $get_r_query = "select * from request where r_id = '" . $_GET[ 'r_id' ] . "' ";
      $result_r_query = $mysqli->query( $get_r_query );
      /* fetch object array */
      $res_r = $result_r_query->fetch_row();
      $no_rec = mysqli_num_rows( $result_r_query );

      $user_id_from = $res_r[ 1 ];
      $user_id_to = $res_r[ 2 ];
      $t_id = $res_r[ 3 ];


      //$reviwer_user_id = $user_id_to;
      $t_id;
      $done = 0;


      //checking if already role assiged or not.
      $sql_role_check = "SELECT * FROM `role` WHERE `reviwer_user_id`= '" . $user_id_to . "' and `t_id` = '" . $t_id . "' ";
      $result_role_check = $mysqli->query( $sql_role_check );
      $no_role_check = mysqli_num_rows( $result_role_check );


      if ( $no_role_check > 0 ) {
        //role is already assigned ..
        echo '<script language="JavaScript"> alert("Request Accepted Again!' . $sql_insert_role . '  "); </script>';

      } else {
        //if not assiged , then this will assign it to the the database.	  
        $sql_delrequest = "delete from request where r_id = '" . $_GET[ 'r_id' ] . "' ";
        mysqli_query( $mysqli, $sql_delrequest );
        echo $sql_insert_role = "INSERT INTO `role` (`role_id`, `reviwer_user_id`, `t_id`, `done`) VALUES (NULL, '" . $user_id_to . "', '" . $t_id . "', '" . $done . "');";
        mysqli_query( $mysqli, $sql_insert_role );
        echo '<script language="JavaScript"> alert("request Accepted.!' . $sql_insert_role . '  ");  </script>';

      }


    } else if ( isset( $_GET[ 'web' ] ) == 'd' ) {
      $sql_delrequest = "delete from request where r_id = '" . $_GET[ 'r_id' ] . "' ";
      mysqli_query( $mysqli, $sql_delrequest );
      echo '<script language="JavaScript"> alert("Request Rejected.!  ");  </script>';

    }
  }
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>PUBLICATION WEB | Review Request </title>
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
<div class="col-lg-9 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">PENDING REQUEST :</h4>
      <p class="card-description"> thesis/<code>Request</code> </p>
      <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>From</th>
              <th>Paper Title</th>
              <th>PDF</th>
              <th>Action </th>
            </tr>
          </thead>
          <tbody>
            <?php
            $request_list = "SELECT thesis.user_id,thesis.title,thesis.pdf,thesis.t_id,request.r_id FROM `request` join thesis on request.t_id = thesis.t_id where request.user_id_to = '" . $_SESSION[ 'userid' ] . "' ";
            $sql_item_udeale = mysqli_query( $mysqli, $request_list );

            while ( $ccr = $sql_item_udeale->fetch_row() ) {
              $requestQuery = "SELECT * FROM  `user` where user_id = '" . $ccr[ 0 ] . "' ";

              $requestResult = $mysqli->query( $requestQuery );

              /* fetch object array */
              $rr_res = $requestResult->fetch_row();

              ?>
            <tr>
              <td><?php echo $rr_res[3]; ?></td>
              <td><?php echo $ccr[1]; ?></td>
              <td><a href="<?php echo $ccr[2]; ?>" download> <i class="mdi mdi-arrow-down">Download</i> </a></td>
              <td align="center"><a href="requestReview.php?r_id=<?php echo $ccr[4].'&web=a'; ?>">
                <button type="button" class="btn btn-success">Accept</button>
                </a> </br>
                </br>
                <a href="requestReview.php?r_id=<?php echo $ccr[4].'&web=d'; ?>">
                <button type="button" class="btn btn-danger">Reject </button>
                </a></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

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