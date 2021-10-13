<?php

$query = "SELECT * FROM  `user` where email = '".$_SESSION['email']."' ";

$result = $mysqli->query($query);

/* fetch object array */
$res = $result->fetch_row();


?>
<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      
      <div class="navbar-brand-wrapper d-flex justify-content-center">
        <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">  
          <a class="" href="index.php"><img src="images/logo2.png" alt="logo"/></a>
          <a class="navbar-brand brand-logo-mini" href="index.php"><img src="images/logo-mini.png" alt="logo"/></a>
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-sort-variant"></span>
          </button>
        </div>  
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <ul class="navbar-nav mr-lg-4 w-100">
          <li class="nav-item nav-search d-none d-lg-block w-100">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text" id="search">
                  <i class="mdi mdi-magnify"></i>
                </span>
              </div>
              <input type="text" class="form-control" placeholder="Search now" aria-label="search" aria-describedby="search">
            </div>
          </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item dropdown mr-1">
            <a class="nav-link count-indicator dropdown-toggle d-flex justify-content-center align-items-center" id="messageDropdown" href="#" data-toggle="dropdown">
              <i class="mdi mdi-message-text mx-0"></i>
              <span class="count"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="messageDropdown">
              <p class="mb-0 font-weight-normal float-left dropdown-header">REVIEW REQUEST!</p>
            
            <?php 
                $request_list = "SELECT thesis.user_id,thesis.title,thesis.pdf,thesis.t_id,request.r_id FROM `request` join thesis on request.t_id = thesis.t_id where request.user_id_to = '".$_SESSION['userid']."' ";
                $sql_item_udeale = mysqli_query($mysqli, $request_list);
                
                while($ccr=$sql_item_udeale->fetch_row())
                {
                    $requestQuery = "SELECT * FROM  `user` where user_id = '".$ccr[0]."' ";
                    
                    $requestResult = $mysqli->query($requestQuery);
                    
                    /* fetch object array */
                    $rr_res = $requestResult->fetch_row();
                    
                    
                ?>
              
              <a class="dropdown-item">
              <div class="item-thumbnail">
                    <img src="<?php echo $rr_res[10]; ?>" alt="image" class="profile-pic">
                </div>
                <?php //echo '<script type="text/javascript"> alert(" '.$rr_res[10].' "); </script>'; ?>
                <div class="item-content flex-grow">
                  <h6 class="ellipsis font-weight-normal"><?php echo $rr_res[3]; ?>
                  </h6>
                  <p class="font-weight-light small-text text-muted mb-0">
                    <?php echo $ccr[1]; ?>
                  </p>
                </div>
              </a>
              <?php 
                }
              ?>
              
              
              
              
              
            </div>
          </li>
          
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <img src="<?php echo $res[10]; ?>" alt="profile"/>
              <span class="nav-profile-name"><?php echo strtoupper($res[3]); ?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item">
                <i class="mdi mdi-settings text-primary"></i>
                Settings
              </a>
              <a class="dropdown-item" href="login.php">
                <i class="mdi mdi-logout text-primary"></i>
                Logout
              </a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>