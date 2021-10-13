<?php
include ("connect.php");
session_start();
if(isset($_SESSION['email'])){

    if(isset($_POST['query'])){
        echo '<script language="JavaScript"> alert("query") </script>';
    }
    
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
  
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>PUBLICATION WEB | Support Assistance </title>
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
          
        
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">POST A QUERY TO GET SUPPORT ASISTANCE :</h4>
                  <form class="form-sample" action="supportAssistance.php" method="post">
                    <p class="card-description">
                      FILL YOUR QUERY
                    </p>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">WRITE YOUR QUERY :</label>
                          <div class="col-sm-9">
                            <textarea name="querytxt" class="form-control" id="exampleTextarea1" rows="6" ></textarea>
                          </div>
                        </div>
                      </div>
                      </div>
                      
                    <button type="submit" name="query" class="btn btn-danger">POST</button>
                    <button class="btn btn-primary mr-2">Cancel</button>
                  </form>
                </div>
              </div>
            </div>
            
            
            
          </div>
          
          <div class="row">
            <div class="col-md-12 stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">POST QUERY'S | STATUS</p>
                  <div class="table-responsive">
                    <table id="recent-purchases-listing" class="table">
                      <thead>
                        <tr>
                            <th>YOUR QUERY</th>
                            <th>ADMIN REPLY</th>
                            <th>ACTION</th>
                            
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                           
                        </tr>
                        
                        
                        
                      </tbody>
                    </table>
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