<?php
require_once "config.php";

$name = " ";
$password   = " ";
$photo=" ";

session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true)
{
  header("location:login.php");
}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <title>php Login System</title>
  </head>
  <body style="background-color:#48D1CC">
    
    
<div class="container mt-4">

  <div class="form-group  col-md-8">
  <div class="shadow-none p-3 mb-5 bg-light rounded">
 <hr>
 <h1 ><span style="color:green;text-align:center;">Welcome Registered User:-</span></h1><hr>
  <!-- <h1 ><span style="color:green;text-align:center;">Welcome</span> <?php echo  $_SESSION['email'];?><h1> <hr> -->
  </div>
 </div>
</div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->
    <span style="color:red;text-align:center;"><h2> Details...</h2>
  
  <table class="table table-dark table-hover;border border-danger">
  <tr>
    <th>Name</th>
    <th>E-mail</th>
    <th>Date of Birth</th>
    <th>Mobile Number</th>
    <th>Photo</th>
  </tr>

</span>
<?php

$name = "";
//Connect to database

$db = mysqli_connect('localhost','root','','register') or die("could not connect to database");

$records = mysqli_query($db,"select * from tb_register where email = '$_SESSION[email]';"); // fetch data from database

while($data = mysqli_fetch_array($records))
{

?>
  <tr>
    <td><?php echo $data['name']; ?></td>
    <td><?php echo $data['email']; ?></td>
    <td><?php echo $data['dob']; ?></td>
    <td><?php echo $data['mobile']; ?></td>
   <td><img src="photo/<?php echo $data['photo']; ?>" width="100" height="100"></td>
   
  </tr>	

<?php
}

?>
</table>
<?php mysqli_close($db); // Close connection ?>
<br><br>
<div class="d-grid gap-2 d-md-flex justify-content-md-end ">
   <a class="btn btn-dark me-md-2 col-2 mx-auto " href="logout.php" >Logout</a> 
  </div> 

  </body>
</html>