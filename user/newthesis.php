<?php
include ("connect.php");
session_start();
if (isset($_SESSION['email'])) {

	
	if( isset($_GET['search']) ){
		$TCSQL_search ="select `cat`.`rootcatid`,`cat`.`cat_id`,`cat`.`name`,`cat`.`image`,`rootcat`.`name` from `cat` JOIN `rootcat` on `rootcat`.`rootcatid` = `cat`.`rootcatid` where `rootcat`.`name` = '".$_GET['search']."' ";	
	}else{
		$TCSQL_search ="select `cat`.`rootcatid`,`cat`.`cat_id`,`cat`.`name`,`cat`.`image`,`rootcat`.`name` from `cat` JOIN `rootcat` on `rootcat`.`rootcatid` = `cat`.`rootcatid` ";
	}
	
	
	
    $count=0;$set=0;
    if(isset($_GET['count'])){
        $set=$count;
        $count = $count +9;
    }
    else{
        $count=9;$set=0;
    }
    
        
        
    
   
?>
<!DOCTYPE html>
<html lang="en">

<head>
  
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>PUBLICATION WEB | UPLOAD NEW PAPER </title>
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
$fname = "";
if (isset($_POST['submit']))
{
    $filename = $_FILES["file"]["name"];
    $file_basename = substr($filename, 0, strripos($filename, '.')); // get file extention
    $file_ext = substr($filename, strripos($filename, '.')); // get file name
    $filesize = $_FILES["file"]["size"];
    $allowed_file_types = array('.doc','.docx','.rtf','.pdf');
    
    if (in_array($file_ext,$allowed_file_types) && ($filesize < 20000000))
    {
        // Rename file
        $newfilename = $file_basename.$_SESSION['email'].'_'.$_POST['title'].date("Y-m-d h:i:sa"). $file_ext;
        if (file_exists("upload/" . $newfilename))
        {
            // file already exists error
            //echo "You have already uploaded this file.";
            echo '<script language="JavaScript"> alert("You have already uploaded this file."); </script>';
        }
        else
        {
            move_uploaded_file($_FILES["file"]["tmp_name"], "thesis/" . $newfilename);
            //echo "File uploaded successfully.";
            echo '<script language="JavaScript"> alert("thesis uploaded..."); </script>';
        }
    }
    elseif (empty($file_basename))
    {
        // file selection error
        //echo "Please select a file to upload.";
        echo '<script language="JavaScript"> alert("Please select a file to upload."); </script>';
        
    }
    
    else
    {
        // file type error
        echo '<script language="JavaScript"> alert("Only these file typs are allowed for upload: "); </script>';
        //echo "Only these file typs are allowed for upload: " . implode(', ',$allowed_file_types);
        unlink($_FILES["file"]["tmp_name"]);
    }


    $fname = basename($_FILES["file"]["name"]);
    $datafnametbl = 'thesis/'.str_replace(" ","%20",$newfilename);
   // echo $datafnametbl.'<br><bR><br><br>';
    //ECHO $newfilename;
    //$sql = "INSERT INTO `thesis` (`t_id`, `user_id`, `title`, `abstract`, `uploadDate`, `estimatedAmount`, `state`, `pdf`, `doi`, `isbn`) VALUES (NULL, '1', 'q', 'q', '2020-09-21', '0', '0', '$datafnametbl', NULL, NULL);";
    $sql = "INSERT INTO `thesis` (`t_id`, `user_id`, `title`, `abstract`, `uploadDate`, `estimatedAmount`, `state`, `pdf`, `doi`, `isbn`, `cat_id`) VALUES (NULL, '".$_SESSION['userid']."', '".$_POST['title']."', '".$_POST['abtxt']."', '".date("Y-m-d")."', '0', '0', '$datafnametbl', NULL, NULL, '".$_POST['cat']."');";
    
    mysqli_query($mysqli,$sql);
    
     
     //echo '<script language="JavaScript"> alert("thesis uploaded..") </script>';
}
    
  

   
    
?>

 <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          
			
			
			
			
			
			
			
          <div class="row">
			  
		<!-- this waht is im trying new or update 0.1 -->	  
			  
			<!-- <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
					<!--rectangle template 		
				 </div>
              </div>
            </div>
			-->
					 
			  
			<!--cat menw for uploading thesis --> 
			<div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
					  <h4 class="card-title"> New Journal</h4>
					<p class="card-description">
                    Author's Tab / Discipline Seclection Tab /
                  </p>
					
					<div class="template-demo">
						<button type="button" class="btn btn-outline-primary btn-fw"><a href="newthesis.php"> All</a></button>
						<?php
						 $TCSQL = "select * from `rootcat` ";
						$sql_item_coment = $mysqli->query( $TCSQL );
						 while ( $cc = $sql_item_coment->fetch_row() ) {
					?>
                        <button type="button" class="btn btn-outline-primary btn-fw"><a href="newthesis.php?search=<?php echo $cc[1]; ?>"><?php echo $cc[1]; ?></a></button>
                        
                    <?php } ?>	
					</div>
				</div>
              </div>
            </div>
					
			
			  
			  
			  
			  <!--SEARCH SHIT WILL APPEAR HERE ACCORDING TO THE SELECTED ROOTCAT OTHERWISE THE ALL CAT WILL BE PRINTED IF NOT ;) , AND ITS A MAIN CARD  WITH 12 AND ROWS OF SMALL CARD IN ROW FORMATS, --> 
			
                  <?php
						 /*$TCSQL_search = "select `cat`.`rootcatid`,`cat`.`cat_id`,`cat`.`name`,`cat`.`image`,`rootcat`.`name` from `cat` JOIN `rootcat` on `rootcat`.`rootcatid` = `cat`.`rootcatid` where `rootcat`.`rootcatid` = 9";*/
						$sql_item_coment_search = $mysqli->query( $TCSQL_search );
						 while ( $cc_search = $sql_item_coment_search->fetch_row() ) {
					?>
					
                 <div class="col-md-4 grid-margin stretch-card">
              <div class="card">
				  <p class="text-light bg-dark pl-1"><?php echo $cc_search[4]; ?></p>
                <div class="card-body">
					
                  
					<h4><?php echo $cc_search[2]; ?></h4>
					
					<br>
					<form action="newthesis.php" method="post">
						<input type="hidden" name="rootcat" value="<?php echo $cc_search[0] ?>"/>
						<input type="hidden" name="cat" value="<?php echo $cc_search[1] ?>"/>
                      <button  type="submit" name="selected" class="btn btn-success btn-rounded btn-fw">Publish Journal -></button>
                    </form>
                </div>
              </div>
            </div>
					<?php } ?>
                    
               
			  
			  
			  
			  
			  
			  
			  
		<!-- already existing code -->	  
        
         <?php
	
	
	
         if(isset($_GET['edit']))
         {
         ?>
			  <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <a class="btn btn-dark btn-rounded btn-fw" href="newthesis.php"> <- BACK To 'Thesis' </a>  <BR><hr>
                  <h4 class="card-title">UPDATE DETAILS FOR PAPAER :</h4>
                  
                  <form class="forms-sample" action="newthesis.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                    <div class="input-group">
                     
                      
                      <input type="file" name="file" id="fileToUpload" class="form-control" accept="application/pdf" required>
    
                      
                    </div>
                    
                    <br>
                    
                    <div class="form-group">
                      <label for="exampleTextarea1">THESIS TITLE  :</label>
                      <input name="title" type="text" class="form-control" placeholder="title" aria-label="title" required />
                    </div>
                    
                    <div class="form-group">
                      <label for="exampleTextarea1">WRITE ABSTRACT :</label>
                      <textarea name="abtxt" class="form-control" id="exampleTextarea1" rows="4" required></textarea>
                    </div>
                    
                  </div>
                   
                    
                  <input type="submit" value="Update Thesis" name="submit" class="btn btn-success">
                    
                    </form>
                    
                </div>
              </div>
            </div>
				  
				  <?php 
         } 
         
	if(isset($_POST['selected'])) {
         
         ?>
				  <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">FILL DETAILS FOR PAPAER :</h4>
                  
                  <form class="forms-sample" action="newthesis.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                    <div class="input-group">
                     
                      
                      <input type="file" name="file" id="fileToUpload" class="form-control" accept="application/pdf" required>
    
                      
                    </div>
                    
                    <br>
                    
                    <div class="form-group">
                      <label for="exampleTextarea1">THESIS TITLE  :</label>
                      <input name="title" type="text" class="form-control" placeholder="title" aria-label="title" required />
                    </div>
                    
                    <div class="form-group">
                      <label for="exampleTextarea1">WRITE ABSTRACT :</label>
                      <textarea name="abtxt" class="form-control" id="exampleTextarea1" rows="4" required></textarea>
                    </div>
                    
                  </div>
                   
						<input type="hidden" name="cat" value="<?php echo $_POST['cat']; ?>"/>
                  <input type="submit" value="Upload Thesis" name="submit" class="btn btn-success">
                    
                    </form>
                </div>
              </div>
            </div>



            
          
          
         
           
          
          <?php }?>
				  
				  
				  
         
         
         
         
         
         
         
         
    


            
          
          
         
         
          <?php ?>
				      <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Your Thesis</h4>
                  <p class="card-description">
                    thesis/
                  </p>
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>
                            thesis ID
                          </th>
                          <th>
                            Title
                          </th>
                          <th>
                            Abstract
                          </th>
                          <th>
                            Estimation Amount
                          </th>
                          <th>
                            Active
                          </th>
                          <th>
                            
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                        $query11 = "select * from thesis where user_id = '".$_SESSION['userid']."' order by t_id desc limit $set,$count ";
                        //echo $count;
                        //echo $query11;
                        $sql_item = $mysqli->query($query11);
						while($res=$sql_item->fetch_row())
						{
						?>
                        <tr>
                          <td class="py-1" style="color:black;">
                            <?php echo $res[0];?>
                          </td>
                          <td style="color: blue;">
                            <?php echo substr($res[2], 0, 30) . '...';?>
                          </td>
                          <td >
                            <?php echo substr($res[3], 0, 40) . '...' ;?>
                          </td>
                          <td>
                            <?php echo $res[5].' INR';?>
                          </td>
                          <td >
                            <?php  if($res[6]==1){echo '<font style="color: green;" >Public </font>';}else{ echo '<font style="color: red;" >No </font>'; }?>
                          </td>
                          <td>
                            <a href="newthesis.php?edit=<?php echo $res[0]; ?>" class="btn btn-warning">EDIT</a>
                            <br><br>
                            <a href="reviewthesis.php?tid=<?php echo $res[0]; ?>" class="btn btn-info">REVIEWS</a>
                          </td>
                        </tr>
                        <?php 
						}
                        ?>
                        <tr >
                        	<td colspan="5"> 
                        		<a href="newthesis.php?count=<?php echo $count; ?>" align="center" >load more.</a>
                        	</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          
          <!--How it works cardinfo tab nothing special --> 
			<div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
					 
                 
					<p class="card-description">
                    Author's Tab / Discipline Seclection Tab / How It Works?
                  </p>
					  <h1>How it Works ?</h1>
					<br>
					
						                  <h4>Step 1 :</h4>					
					<p class="text-muted">Tutorial is alomst decided , <a href="#">Click Here</a> to see the upload date. ;) </p>
					                  <h4>Step 2 :</h4>					
					<p class="text-muted">Tutorial is alomst decided , <a href="#">Click Here</a> to see the upload date. ;) </p>
					                  <h4>Step 3 :</h4>					
					<p class="text-muted">Tutorial is alomst decided , <a href="#">Click Here</a> to see the upload date. ;) </p>
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