<?php
session_start();

  $connection=mysqli_connect("localhost", "root", "","hrsdb") or die("Error connecting to database: ".mysqli_error($connection));

?>


<!DOCTYPE html>
<html>
<head>
  <title>HRS - admin page</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="assets/css/custom.css"/>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
       <!-- GOOGLE FONTS-->
   <link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css"/>
   <link href="assets/css/font-awesome.css" rel="stylesheet" />
   <style>
    .div-square{
      cursor: pointer;
    }
   </style>


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>
<!--NAVBAR  NAVBAR  NAVBAR  NAVBAR  NAVBAR  NAVBAR  NAVBAR  NAVBAR  NAVBAR  NAVBAR  NAVBAR  NAVBAR  -->
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php">HRS</a>
                </div>
                <ul class="nav navbar-nav">
                    <li><a href="index.php">Home</a></li>

                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <?php if (isset($_SESSION['usr_id'])) { ?>
                        <li><p class="navbar-text">Signed in as <?php echo $_SESSION['usr_email']; ?></p></li>
                        <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"> </span> Log Out</a></li>
                    <?php } else { ?>
                        <li><a href="register.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                        <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                    <?php } ?>
                </ul>
            </div>
        </nav>
<!--NAVBAR END NAVBAR END NAVBAR END NAVBAR END NAVBAR END NAVBAR END NAVBAR END NAVBAR END NAVBAR END -->







            <div id="page-inner">

                <div class="row">
                    <div class="col-lg-12">
                     <h2>ADMIN DASHBOARD</h2>
                    </div>
                </div>
                 <!-- /. ROW  -->
                  <hr />
                <div class="row">
                    <div class="col-lg-12 ">
                        <div class="alert alert-info">
                             <strong>Welcome <?php echo $_SESSION['usr_email']; ?> </strong>
                        </div>

                    </div>
                    </div>
                    <div class="row">
                    <div class="col-md-2">
                  <!-- /. ROW  -->

                      <div class="div-square">
                           <a href="register.php" >
                           <i class="fa fa-user fa-5x"></i>
                      <h4>Register User</h4> </a>
                      </div>


                      <div onclick="viewUsers()" class="div-square">
                           <i class="fa fa-users fa-5x"></i>
                      <h4>See Users</h4>
                      </div>


                      <div onclick="viewHotels()" class="div-square">
                           <i class="fa fa-clipboard fa-5x"></i>
                      <h4>See Hotels</h4>
                      </div>

                      <div onclick="viewReservations()" class="div-square">
                           <i class="fa fa-clipboard fa-5x"></i>
                      <h4>See Reservations</h4>


                </div>
              </div> <!-- ROW END!!! -->
 <div class="col-md-10">



<div id="changeable_page">


</div>




 </div>


                  <!-- /. ROW  -->
    </div>
             <!-- /. PAGE INNER  -->

         <!-- /. PAGE WRAPPER  -->
    <div class="footer">


            <div class="row">
                <div class="col-lg-12" >
                    SE301
                </div>
            </div>
        </div>


<script type="text/javascript">

 function viewReservations(){

      document.getElementById('changeable_page').innerHTML = '      <?php

    $raw_users = mysqli_query($connection,"SELECT * FROM reservations") or die(mysql_error());

    if(mysqli_num_rows($raw_users) > 0){

      echo "<div class='col-sm-10'>
      <table class='table table-hover' style='max-width: none'>
        <thead>
          <tr>
            <th>Person Count</th>
            <th>Room Amount</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Price</th>
            <th>UserID</th>
            <th>ReservationID</th>
          </tr>
        </thead>
        <tbody>";

      while($results = mysqli_fetch_array($raw_users)){

        echo "            <tr class='reservations_list'>
              <td>".$results['People']."</td>
              <td>".$results['RoomAmount']."</td>
              <td>".$results['StartDate']."</td>
              <td>".$results['EndDate']."</td>
              <td>&euro; ".$results['Price']."</td>
              <td>".$results['userId']."</td>
              <td>".$results['reservationId']."</td>
            </tr>";
      }
      echo "          </tbody>
        </table>
    </div>";

    }
    else{
      echo "No results";
    }

?>'
      ;
    }


  function viewUsers(){

      document.getElementById('changeable_page').innerHTML = '      <?php

    $raw_users = mysqli_query($connection,"SELECT * FROM users") or die(mysql_error());

    if(mysqli_num_rows($raw_users) > 0){

      echo "<div class='col-sm-10'>
      <table class='table table-hover' style='max-width: none'>
        <thead>
          <tr>
            <th>User ID</th>
            <th>E-Mail</th>
            <th>User Type</th>
          </tr>
        </thead>
        <tbody>";

      while($results = mysqli_fetch_array($raw_users)){

        echo "            <tr class='users_list'>
              <td id='user_id'>".$results['userId']."</td>
              <td id='user_mail'>".$results['email']."</td>
              <td id='user_type'>".$results['usertype']."</td>
            </tr>";
      }
      echo "          </tbody>
        </table>
    </div>";

    }
    else{
      echo "No results";
    }

?>'
      ;
    }

  function viewHotels(){

      document.getElementById('changeable_page').innerHTML = '      <?php

    $raw_users = mysqli_query($connection,"SELECT * FROM hotels") or die(mysql_error());

    if(mysqli_num_rows($raw_users) > 0){

      echo "<div class='col-sm-10'>
      <table class='table table-hover' style='max-width: none'>
        <thead>
          <tr>
            <th>Reg. ID</th>
            <th>Name</th>
            <th>District</th>
            <th>Stars</th>
          </tr>
        </thead>
        <tbody>";

      while($results = mysqli_fetch_array($raw_users)){

        echo "            <tr class='hotels_list'>
              <td id='reg_id'>".$results['RegistrationId']."</td>
              <td id='hotel_name'>".$results['HotelName']."</td>
              <td id='hotel_district'>".$results['District']."</td>
              <td id='hotel_stars'>".$results['Stars']."</td>
            </tr>";
      }
      echo "          </tbody>
        </table>
    </div>";

    }
    else{
      echo "No results";
    }

?>'
      ;
    }



</script>


</body>
</html>
