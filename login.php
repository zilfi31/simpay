<?php
	@ob_start();
	session_start();
  include 'config.php';
	if(!isset($_SESSION['log'])){
    } else {
        header('location:index.php');
    };

    if(isset($_POST['login'])){
      $user = mysqli_real_escape_string($conn,$_POST['username']);
      $pass = mysqli_real_escape_string($conn,$_POST['password']);
      $queryuser = mysqli_query($conn,"SELECT * FROM login WHERE username='$user'");
      $cariuser = mysqli_fetch_assoc($queryuser);
      
      if(mysqli_num_rows($queryuser) > 0){
        if( $pass == $cariuser['password'])  {
            $_SESSION['userid'] = $cariuser['userid'];
            $_SESSION['username'] = $cariuser['username'];
            $_SESSION['role'] = $cariuser['role'];
            $_SESSION['log'] = "login";

   
            if($cariuser['role'] == 'admin'){ 
                echo '<script>alert("Data yang anda masukan benar");window.location="admin.php"</script>';
            }else if($cariuser['role'] == 'kasir'){
              echo '<script>alert("Data yang anda masukan benar");window.location="index.php"</script>';
            }
            echo '<script>alert("Anda Berhasil Login");window.location="index.php"</script>';
        } else {
            echo '<script>alert("Username atau password salah");history.go(-1);</script>';
        }	
      } 
          
      };
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Login SimPay </title>
    <link rel="icon" href="favicon.ico">
    <link rel="icon" href="favicon.ico" type="image/ico">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <style>
        html,
        body {
          height: 100%;
        }

      body {
        display: -ms-flexbox;
        display: flex;
        background: #fff;   
        height:100%;     
      }
      .form-block{
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-height:100vh;
      }

      .card-login {
        height:300px;
        width: 350px;
        padding: 1.9rem 1.2rem;
        text-align: center;
        border-radius:15px;
        display:flex;
        flex-direction: column;
        justify-content: center;
      }

      .form-signin {
        width: 100%;
        max-width: 330px;
        padding: 15px;
      }
      .sign{
        display: flex;
        justify-content:center;      
      }
    
      .card_header svg {
        margin-right: 9px;
      }

      .card_header p{
        font-size:12px;
        color:#464646;
      }

      .form_heading {
        padding-bottom: 20px;
        font-size: 30px;
        color: black;
        font-weight: bold;
      }

      .input-group {
      position: relative;
      }

      .input {
      border: none;
      border-radius: 1rem;
      background: #f0f0f0;
      padding: 17px;
      font-size: 1rem;
      color: black;
      transition: border 150ms cubic-bezier(0.4,0,0.2,1);
      display:block;
      width:100%;
      font-weight:500;
      }

      .user-label {
      position: absolute;
      left: 15px;
      color: #333;
      pointer-events: none;
      transform: translateY(1rem);
      transition: 150ms cubic-bezier(0.4,0,0.2,1);
      font-weight:500;

      }

      .input:focus, input:valid {
      outline: none;
      border: none;
      }

      .form-signin input[type="password"] {
        margin-bottom: 10px;
      }

      .input:focus ~ label, input:valid ~ label {
      transform: translateY(-50%) scale(0.8);
      background-color: #fff;
      padding: 0 .2em;
      color: black;
      }
      .overlay{
        background:url(assets/images/login1.png) center no-repeat;
        background-size:cover;
        height:100vh;
      }
      .tombol{
        width:150px;
        height:49px;
        border-radius:49px;
        margin-left:25%;
      }
    </style>
</head>

<body class="align-items-center">
  <div class="container-fluid">
    <div class="row content">
    <div class="col-lg-6 d-none d-lg-block overlay">
      </div>
      <div class="col-lg-6 form-block px-4">
        <div class="col-lg-8 col-md-6 col-sm-8 col-xs-12 card-login  ">
          <div class="text-center mt-5">
          <div class="card_header">
                <div class="sign">
                  <svg height="35" width="35" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M4 15h2v5h12V4H6v5H4V3a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v18a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-6zm6-4V8l5 4-5 4v-3H2v-2h8z" fill="currentColor"></path>
                  </svg>
                  <h1 class="form_heading">Sign in</h1>
                </div>
                <p>Welcome to SimPay! please enter your details!</p>
              </div>
          </div>
          <form class="form-signin" method="POST">
              
              
            <div class="input-group mb-3">
              <input required="" type="text" id="inputuser" name="username" autocomplete="off" class="input" required>
              <label class="user-label">Username</label>
            </div>
            <div class="input-group mb-4">
              <input required="" type="password" id="inputPassword" name="password" autocomplete="off" class="input" required>
              <label class="user-label">Password</label>
            </div>
            <button class="btn tombol btn-warning btn-block mb-3" name="login" style="font-weight:700;" type="submit">LOGIN</button>
          </form>
        </div>
      </div>
      
    </div>
  </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>