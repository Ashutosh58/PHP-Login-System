
<?php
session_start();
//Initializing variables
$name = " ";
$email = " ";
$mobile = " ";
$photo =" ";
$password =" ";
$dob= " ";
//$con_password = " ";
$errors = array();
//Connect to database
 $db = mysqli_connect('localhost','root','','register') or die("could not connect to database");
//Register user
if (isset($_POST['submit']))
{
     $name = mysqli_real_escape_string($db, $_POST['name']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $dob = mysqli_real_escape_string($db, $_POST['dob']);
    $mobile = mysqli_real_escape_string($db, $_POST['mobile']);
    //$gender = mysqli_real_escape_string($db, $_POST['gender']);
    $photo = mysqli_real_escape_string($db, $_POST['photo']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
   // $con_password = mysqli_real_escape_string($db, $_POST['con_password']);

    //Validation form

if (empty($name))
    { 
        array_push($errors, "<font color='red'>Full Name is required </font>");
    }
    if (empty($email))
    { 
        array_push($errors, "<font color='red'><font color='red'>Email is required </font>");
    }
    if (empty($mobile))
    { 
        array_push($errors, "<font color='red'>Mobile Number is required </font>");
    }
    if (empty($password)) 
    {   
        array_push($errors, "<font color='red'>Password is required</font>");
    }
    /*if ($password != $con_password) 
    { 
        array_push($errors, "<font color='red'>Password do not match</font>");
    }*/

    //check database for existing user with same username
   $user_check_query = "SELECT * FROM tb_register WHERE password = '$password' OR email = '$email' LIMIT 1";

    $results = mysqli_query($db, $user_check_query);
     $user = mysqli_fetch_assoc($results);

    if ($user) 
    {
        if ($user['password'] === $password)
        {
            array_push($errors, "<font color='red'>Password already exists</font>");
        }
        if ($user['email'] === $email)
        {
            array_push($errors, "<font color='red'>This email id has a registered</font>");
        }
    }


    //Register user if no error
    if (count($errors) == 0) 
    {
        //$password = md5($password);
        $query = "INSERT INTO tb_register (name, email, dob, mobile, photo, password) VALUES ('$name', '$email', '$dob', '$mobile', '$photo', '$password')";

        mysqli_query($db, $query);
        $_SESSION['name'] = $name;
        $_SESSION['email'] = $email;
        $_SESSION['success'] = "you are now logged in";
        header("location: login.php");
        array_push($errors, "<h1><font color='green'>Register successful.</font></h1>");    
    }
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
  <body>
      
<div class="container mt-4">
<body style="background-color:orange">
<h3>Please Register Here:</h3><hr>
<div class="row g-3">
 <form action="" method="post" >
  <?php include "error.php";?>
<div class="form-group col-md-5">
  <label for="inputEmail4" class="form-label">Name</label>
    <input type="text" style="background-color:#00BFFF;" name="name" class="form-control" placeholder="Enter your  Name" aria-label="Name"  required>
        
  <label for="inputEmail4" class="form-label">Email</label>
  <input type="email"  style="background-color: #00BFFF;" class="form-control" placeholder="Enter your  eMail-ID" id="inputEmail4" name="email"  required>
 
    <label for="inputPassword4" class="form-label">Password</label>
    <h6 style="color:Red">Note:-Set your password atleast 5 character...</h6>
    <input type="password"  style="background-color:#00BFFF;" class="form-control"  placeholder="Enter your  Password" id="inputPassword4" name="password"  required>
    
    
    <label for="inputAddress" class="form-label">Date Of Birth</label>
    <input type="date"  style="background-color: #00BFFF;" class="form-control" id="inputAddress" placeholder="Date of birth" name="dob"  min="1970-01-01" max="2003-12-31" required>
          
    <label for="inputmobile" class="form-label">Mobile Number</label>
    <input type="text"  style="background-color:#00BFFF;" class="form-control" id="inputAddress" placeholder="91+ Mobile Number" name="mobile"  pattern="[7-9]\d{9}" title="Enter a valid Number"  required>   
      
  <label for="formFile" class="form-label"> Choose a profile photo</label>
  <input  type="file" name="photo" class="form-control" style="background-color:#00BFFF;"  id="file"  accept="image/*" required ></br>
  
  <h6 style="color:Red">Note:- If you have already register then form will reset...</h6>
   
   <button type="submit" class="btn btn-primary col-md-12" name="submit">Submit</button>
   <br><h5>Have an account ? <a href="login.php" >LogIn</a></h6>

  </div>
  
</form>
 
</div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->
  </body>
</html>