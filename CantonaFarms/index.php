<?php
session_start();
include ("./connection/connection.php");

if(isset($_POST['login_data'])){
		$username = $_POST['username'];
		$password = $_POST['password'];
    $_SERVER['variable'];
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
   $result = mysqli_query($conn,$sql);
   $number = mysqli_num_rows($result);
    if($number > 0){
       
         $row = mysqli_fetch_assoc($result);
        $_SESSION['id'] = $row['id'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['role'] = $row['role'];

        if($row['role']== 1){
          $_SESSION['username'].' has loggged in successfull with role superAdministrator';
         
            header("location: ./superAdmin/dashboard.php");
        }else if($row['role']==  2){

          header("location:./admin/dashboard.php");
           
        } else  if($row['role']== 3){

             header("location:./manager/dashboard.php");
             }else  if($row['role']== 4){

              header("location:./agent/create.php");
              }else  if($row['role']== 5){

             header("location:./builder/create.php");
             
              }
 
            }
            
    else
        ?>
        <script language="JavaScript">
            alert('Wrong username or password please try again');
            document.location='index.php';
        </script>
        <?php
    
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa; /* Set light background color */
            font-family: Arial, sans-serif;
        }
        .modal-header {
            background-color: #28a745; /* Set green background color for modal header */
            color: #fff; /* Set white text color for modal header */
            border-bottom: none; /* Remove bottom border from modal header */
        }
        .modal-title {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
        }
        .modal-content {
            border-radius: 10px;
        }
        .form-control {
            border-color: #28a745; /* Set green border color for form controls */
        }
        .btn-success {
            background-color: #28a745; /* Set green background color for login button */
            border-color: #28a745; /* Set green border color for login button */
            width: 100%;
        }
        .btn-success:hover {
            background-color: #218838; /* Darker green color on hover */
            border-color: #1e7e34; /* Darker green border color on hover */
        }
    </style>
</head>
<body>

<!-- Button trigger modal -->
<div class="card">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-4">a</div>
    <div class="col-md-4"><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa; /* Set light background color */
            font-family: Arial, sans-serif;
        }
        .modal-header {
            background-color: #28a745; /* Set green background color for modal header */
            color: #fff; /* Set white text color for modal header */
            border-bottom: none; /* Remove bottom border from modal header */
        }
        .modal-title {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
        }
        .modal-content {
            border-radius: 10px;
        }
        .form-control {
            border-color: #28a745; /* Set green border color for form controls */
        }
        .btn-success {
            background-color: #28a745; /* Set green background color for login button */
            border-color: #28a745; /* Set green border color for login button */
            width: 100%;
        }
        .btn-success:hover {
            background-color: #218838; /* Darker green color on hover */
            border-color: #1e7e34; /* Darker green border color on hover */
        }
    </style>
</head>
<body>

<!-- Button trigger modal -->
<div class="card">
  <div class="card-body"><button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#loginModal">
    Admin Login
</button></div>
</div>

<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Admin Login</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" name="login_data" class="btn btn-success">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
</div>
    </div>
  </div>

<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Admin Login</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" name="login_data" class="btn btn-success">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
