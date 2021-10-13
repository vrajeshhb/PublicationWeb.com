<?php
include ("connect.php");
session_start();
//Author : Vrajesh Bhimajiani
/*
* lets Go!
*/
//reviewTab.php
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







  $review_query11 = "select user.name,user.email,thesis.t_id, thesis.title, thesis.abstract, thesis.estimatedAmount from `thesis` 
join role ON role.t_id = thesis.t_id
join user on thesis.user_id = user.user_id

where role.reviwer_user_id = '".$_SESSION['userid']."' ";
		  //$query11 = "SELECT `request`.`user_id_to`,`request`.`t_id`,`thesis`.`title`,`thesis`.`abstract`,`thesis`.`estimatedAmount`,`user`.`name` FROM `thesis` JOIN `request` ON `request`.`t_id` = `thesis`.`t_id` JOIN `user` ON `user`.`user_id` = `thesis`.`user_id`";
                    //echo $count;
                    //echo $query11;
$review_sql_item = $mysqli->query( $review_query11 );




$query11 = "select * from thesis where user_id = '" . $_SESSION[ 'userid' ] . "' order by t_id desc limit $set,$count ";
                 

//reviewTab_End Here
/*
* lets Go!
*/
//login.php
if(isset($_POST['login'])){
        $sql="SELECT * FROM  `user` where email='".$_POST['email']."' and pass ='".$_POST['pass']."' ";
        $result = $mysqli->query($sql);
        /* fetch object array */
        $res = $result->fetch_row();
        $no=mysqli_num_rows($result);
        
        if($no >0 )
        {
            $_SESSION['email']= $_POST['email'];
            $_SESSION['userid']= $res[0];
            header("location:index.php");
        }
        else
        {
            echo '<script language="JavaScript"> alert("Incorrect Username Or Password. | User Does Not Exist.") </script>';
        }
    }

?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
</head>

<body>
</body>
</html>