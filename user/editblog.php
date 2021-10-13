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
<title>PUBLICATION WEB |  Edit Blog <?php echo strtoupper($_SESSION['email']); ?> </title>
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
    
	  
	   <?php
        if ( isset( $_POST[ 'Epostblog' ] ) ) {
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
         
				
		$sql = "UPDATE `blogs` SET `title` = '".$_POST['title']."', `body` = '".$_POST['contain']."', `blog_img` = '$datafnametbl' WHERE `blogs`.`blog_id` = '".$_POST['bid']."' ";
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
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  <?php 
	  if(isset($_POST['editblog'])){
		  $sql="SELECT * FROM `blogs` where `blog_id` = '".$_POST['bid']."' ";
	  }else{
		  $sql="SELECT * FROM `blogs` where `blog_id` = '".$_POST['bid']."' ";
	  }
	
	 $result = $mysqli->query($sql);
        /* fetch object array */
        $res = $result->fetch_row();
        $title = $res[2];
		  $contain = $res[3];
		  $img =$res[5];
	
	  ?>
	  
    <!-- partial -->
    <div class="main-panel">
      <div class="content-wrapper">
  <form class="form-sample" action="editblog.php" method="post" enctype="multipart/form-data">
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
                        <input name="title" type="text" class="form-control" value="<?php echo $title; ?>" />
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Select Image For Blog : (Max:500Kb)<br>  </label>
						 
                      <div class="col-sm-9">
                        <input name="file" type="file" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username">
                      </div>
						<img class="col-sm-1" height="50px" width="50px" src="<?php echo $img;?>" alt="profile"/>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Blog Contain :</label>
                      <div class="col-sm-9">
                        <textarea name="contain" class="form-control" id="exampleTextarea1" rows="15" > <?php echo $contain; ?></textarea>
                      </div>
                    </div>
                  </div>
                </div>
				  
				  <input type="hidden" name="bid" value="<?php echo $_POST['bid']; ?>" />
                <button type="submit" name="Epostblog" class="btn btn-primary mr-2">Publise Change</button>
                <button class="btn btn-light">Cancel</button>
              </div>
            </div>
          </div>
        </form>
		  
		  
		  
		  
		  
		  	  
		  
		  
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