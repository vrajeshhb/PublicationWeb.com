<?php
include( "connect.php" );
session_start();
if ( isset( $_SESSION[ 'email' ] ) ) {

  
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>PUBLICATION WEB | <?php echo strtoupper($_SESSION['email']); ?> ACCOUNT </title>
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
        <?php
        if ( isset( $_POST[ 'postblog' ] ) ) {
          $filename = $_FILES[ "file" ][ "name" ];
          $file_basename = substr( $filename, 0, strripos( $filename, '.' ) ); // get file extention
          $file_ext = substr( $filename, strripos( $filename, '.' ) ); // get file name
          $filesize = $_FILES[ "file" ][ "size" ];
           $allowed_file_types = array('.jpg','.jpeg','.png','.gif');

          if ( in_array( $file_ext, $allowed_file_types ) && ( $filesize < 20000000 ) ) {
            // Rename file
            $newfilename = $file_basename . $_SESSION[ 'email' ] . '_' . $_POST[ 'title' ] . date( "Y-m-d h:i:sa" ) . $file_ext;
            if ( file_exists( "blogs/" . $newfilename ) ) {
              // file already exists error
              //echo "You have already uploaded this file.";
              echo '<script language="JavaScript"> alert("You have already uploaded this file."); </script>';
            } else {
              move_uploaded_file( $_FILES[ "file" ][ "tmp_name" ], "blogs/" . $newfilename );
              //echo "File uploaded successfully.";
              echo '<script language="JavaScript"> alert("Blog Published..."); </script>';
				
				$fname = basename( $_FILES[ "file" ][ "name" ] );
          $datafnametbl = 'blogs/' . str_replace( " ", "%20", $newfilename );
          // echo $datafnametbl.'<br><bR><br><br>';
          //ECHO $newfilename;
          //$sql = "INSERT INTO `thesis` (`t_id`, `user_id`, `title`, `abstract`, `uploadDate`, `estimatedAmount`, `state`, `pdf`, `doi`, `isbn`) VALUES (NULL, '1', 'q', 'q', '2020-09-21', '0', '0', '$datafnametbl', NULL, NULL);";
          //$sql = "INSERT INTO `thesis` (`t_id`, `user_id`, `title`, `abstract`, `uploadDate`, `estimatedAmount`, `state`, `pdf`, `doi`, `isbn`, `cat_id`) VALUES (NULL, '" . $_SESSION[ 'userid' ] . "', '" . $_POST[ 'title' ] . "', '" . $_POST[ 'abtxt' ] . "', '" . date( "Y-m-d" ) . "', '0', '0', '$datafnametbl', NULL, NULL, '" . $_POST[ 'cat' ] . "');";
$sql = "INSERT INTO `blogs` (`blog_id`, `user_id`, `title`, `body`, `view_count`, `blog_img`) VALUES (NULL,  '" . $_SESSION[ 'userid' ] . "', '".$_POST['title']."', '".$_POST['contain']."', '0', '$datafnametbl')";
          mysqli_query( $mysqli, $sql );
				
				
				
				
            }
          } elseif ( empty( $file_basename ) ) {
            // file selection error
            //echo "Please select a file to upload.";
            echo '<script language="JavaScript"> alert("Please select a .png or .jpeg or .gif to upload."); </script>';

          }

          else {
            // file type error
            echo '<script language="JavaScript"> alert("Only these file typs are allowed for upload: "); </script>';
            //echo "Only these file typs are allowed for upload: " . implode(', ',$allowed_file_types);
            unlink( $_FILES[ "file" ][ "tmp_name" ] );
          }


          


          //echo '<script language="JavaScript"> alert("thesis uploaded..") </script>';
        }
        ?>
        <form class="form-sample" action="postblog.php" method="post" enctype="multipart/form-data">
          <div class="col-12 grid-margin">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Publish Blog</h4>
                <p class="card-description">Fill Publication info </p>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label"> Blog Title :</label>
                      <div class="col-sm-9">
                        <input name="title" type="text" class="form-control" placeholder=" 'The New Era' " />
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Select Image For Blog : (Max:500Kb)</label>
                      <div class="col-sm-9">
                        <input name="file" type="file" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Blog Contain :</label>
                      <div class="col-sm-9">
                        <textarea name="contain" class="form-control" id="exampleTextarea1" rows="15" ></textarea>
                      </div>
                    </div>
                  </div>
                </div>
                <button type="submit" name="postblog" class="btn btn-primary mr-2">Publise</button>
                <button class="btn btn-light">Cancel</button>
              </div>
            </div>
          </div>
        </form>
		  
		  
		  
	<?php
	if(isset($_POST['delblog'])){
		$delblog_sql = "DELETE FROM `blogs` WHERE `blogs`.`blog_id` = '".$_POST['bid']."' ";
		$result = $mysqli->query($delblog_sql);
		echo '<script type="text/javascript"> alert("Blog Removed"); </script>';
	}
	
	?>
		  
		  
		  <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Published Blogs</h4>
                  <p class="card-description">
                    Blogs/
                  </p>
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>
                            
                          </th>
                          <th>
                            Title
                          </th>
                          <th>
                            Contain
                          </th>
                          <th>
                            Image
                          </th>
                          <th>
                            
                          </th>
                          <th>
                            Action
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                        $query11 = "SELECT * FROM `blogs` WHERE `user_id` = '".$_SESSION['userid']."' order by `blog_id` desc limit 0,10 ";
                        //echo $count;
                        //echo $query11;
                        $sql_item = $mysqli->query($query11);
						$n=0;
						while($res=$sql_item->fetch_row())
						{
							$n++;
						?>
                        <tr>
                          <td class="py-1" style="color:black;">
                            <?php echo $n;?>
                          </td>
                          <td style="color: blue;">
                            <?php echo substr($res[2], 0, 100) . '...';?>
                          </td>
                          <td >
                            <?php echo substr($res[3], 0, 40) . '...' ;?>
                          </td>
                          <td>
                           <img src="<?php echo $res[5];?>" alt="profile"/> 
                          </td>
                          <td >
                            
                          </td>
                          <td align="center">
							  
							  <form action="editblog.php" method="post">
							  <input type="hidden" name="bid" value="<?php echo $res[0]; ?>" />
							  <button type="submit" name="editblog"  class="btn btn-info">Edit</button>
                           </form>
                           
                            <br><br>
							<form action="postblog.php" method="post">
							  <input type="hidden" name="bid" value="<?php echo $res[0]; ?>" />
							  <button type="submit" name="delblog"  class="btn btn-warning">Delete</button>
                           </form>
                          </td>
                        </tr>
                        <?php 
						}
                        ?>
                        
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
      </div>
    </div>
  </div>
</div>
</div>
<!-- content-wrapper ends --> 
<!-- partial:partials/_footer.html -->
<?php include ('footer.php');?>
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