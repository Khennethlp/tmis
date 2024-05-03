<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <link rel="stylesheet" href="../dist/css/others/all.css">
  <link rel="stylesheet" href="../dist/css/others/bootstrap.min.css">
  <link rel="stylesheet" href="../dist/css/others/maxcdn-bootstrap.min.css">
  <link rel="stylesheet" href="../dist/css/custom-style.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.5.0/css/all.css' integrity='sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU' crossorigin='anonymous'>
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
 

  <style>

    body {
        background-color: #f8f9fa;
    }
    .registration-form {
        max-width: 400px;
        margin: 50px auto;
        padding: 30px;
        border: 1px solid #dee2e6;
        border-radius: 5px;
        background-color: #fff;
    }

    .login-form {
        max-width: 400px;
        margin: 100px auto;
        padding: 30px;
        border: 1px solid #dee2e6;
        border-radius: 5px;
        background-color: #fff;
    }

    .container{
		margin-top: 5%;
	}

	.card-header {
        padding: 5px 15px;
	}

    .profile-img {
        width: 96px;
		height: 96px;
        margin: 0 auto 10px;
        display: block;
        -moz-border-radius: 50%;
        -webkit-border-radius: 50%;
        border-radius: 50%;
    }
  
  </style>
</head>
<body>
<?php
                session_start();
                  // if(isset($_SESSION['msg']) && isset($_SESSION['status'])){
                  //   $status = $_SESSION['status'];
                  //   $msg = $_SESSION['msg'];
                  // }

                  if(isset($_SESSION['status']) == 'success'){
                    echo '<div class="alert alert-primary alert-dismissible fade show" role="alert">
                            <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
                            '.$_SESSION['msg'].'
                          </div>';
                } elseif (isset($_SESSION['status']) == 'error'){
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
                            '.$_SESSION['msg'].'
                          </div>';
                }
                ?>