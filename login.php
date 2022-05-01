<?php


session_start();

/*if(isset($_SESSION['email']))
{
    header("location: welcome.php");
    exit;
}*/
//Initializing variables

$email = " ";
$password =" ";
$errors = array();

//Connect to database

 $db = mysqli_connect('localhost','root','','register') or die("could not connect to database");

//LOGIN USER

if(isset($_POST['submit']))
{
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    if(empty($email))
    {
        array_push($errors, "<font color='red'><font color='red'>email is required</font>");
    }
    if(empty($password))
    {
        array_push($errors, "<font color='red'><font color='red'>password is required</font>");
    }
    if (count($errors) == 0)
    {
       // $password = md5($password);
        $query = "SELECT * FROM tb_register WHERE email = '$email' AND password = '$password' ";
        $results = mysqli_query($db, $query);

        if (mysqli_num_rows($results) == 1)
        { 
            $_SESSION['email'] = $email;
            //$_SESSION['name'] = $name;
            $_SESSION['success'] = "logged in successfully";
            $_SESSION["loggedin"] = true;
            header('location:welcome.php');
        }
        else
        {
            array_push($errors, "<font color='red'>wrong email/password combination. please try again</font>"); 
        }
    }
}




// if(isset($_POST['register']))
// {
//     $email = mysqli_real_escape_string($db, $_POST['email']);
//     $password = mysqli_real_escape_string($db, $_POST['password']);

//     // if(empty($email))
//     // {
//     //     array_push($errors, "<font color='red'><font color='red'>email is </font>");
//     // }
//     // if(empty($password))
//     // {
//     //     array_push($errors, "<font color='red'><font color='red'>password is</font>");
//     // }
//     // if (count($errors) == 0)
//     // {
//     //    // $password = md5($password);
//     //     $query = "SELECT * FROM tb_register WHERE email = '$email' AND password = '$password' ";
//     //     $results = mysqli_query($db, $query);

//         if (mysqli_num_rows($results) == 1)
//         { 
//             $_SESSION['email'] = $email;
//             //$_SESSION['name'] = $name;
//             $_SESSION['success'] = "logged in successfully";
//             $_SESSION["loggedin"] = true;
//             header('location:registration.php');
//         }
//         else
//         {
//             array_push($errors, "<font color='red'>wrong email/password combination. please try again</font>"); 
//         }
//     }
// }

?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>PHP login system!</title>
  </head>
  <body>
  <!--<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Php Login System</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  
</nav>-->

<div class="container mt-4">
<body style="background-color:orange">
<h3>Please Login Here:</h3>
<hr>

<form action="" method="post">
<?php include "error.php" ; ?>
  <div class="form-group  col-md-5">
    <label for="exampleInputEmail1">Email</label>
    <input type="text"  style="background-color: gold;" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter your e-Mail Id"required>
  
    <label for="exampleInputPassword1">Password</label>
    <input type="password" style="background-color: gold;" name="password" class="form-control" id="exampleInputPassword1" placeholder="Enter Password" required>
  </br>
  
  <button type="submit" class="btn btn-primary  col-md-12" name="submit">Submit</button>
  <h4>Don't have an account ? <a href="registration.php" style="text-decoration: none;">Registration</a></h4>
  </form>
  </div>
  
</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
