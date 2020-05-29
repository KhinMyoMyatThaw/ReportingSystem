<?php
session_start();

$errors=array();

$db =mysqli_connect('localhost', 'root', '', 'login_form');

if (isset($_POST['user_login'])) { //လော့အင် button ကို နှိပ်လိုက်ရင်
    $email= mysqli_real_escape_string($db, $_POST['email']);
    $password= mysqli_real_escape_string($db, $_POST['password']);

    if (empty($email)) {
        array_push($errors, "Email is required");
    }

    if (empty($password)) {
        array_push($errors, "Password is required");
        
    }

    if (count($errors==0)) {
        $password = md5($password);
        $query = "SELECT * FROM user WHERE email= '$email' And password='$password'";

        $results =mysqli_query($db, $query);
        if (mysqli_num_rows($results)==0) {
            $_SESSION['email'] =$email;
            $_SESSION['success'] = "You are now logged in";
            header('location: homeview.php');
        }else{
            array_push($errors, "Worng username/password combination");
        }
    }
    
    
}



?>
<!DOCTYPE html>
<html>
<head>
    <title>Login Form</title>
</head>
<style>
    * { margin: 0px; padding: 0px; }
body {
    font-size: 120%;
    background: #F8F8FF;
}
.header {
    width: 40%;
    margin: 50px auto 0px;
    color: white;
    background: #5F9EA0;
    text-align: center;
    border: 1px solid #B0C4DE;
    border-bottom: none;
    border-radius: 10px 10px 0px 0px;
    padding: 20px;
}
form, .content {
    width: 40%;
    margin: 0px auto;
    padding: 20px;
    border: 1px solid #B0C4DE;
    background: white;
    border-radius: 0px 0px 10px 10px;
}
.input-group {
    margin: 10px 0px 10px 0px;
}
.input-group label {
    display: block;
    text-align: left;
    margin: 3px;
}
.input-group input {
    height: 30px;
    width: 93%;
    padding: 5px 10px;
    font-size: 16px;
    border-radius: 5px;
    border: 1px solid gray;
}
#user_type {
    height: 40px;
    width: 98%;
    padding: 5px 10px;
    background: white;
    font-size: 16px;
    border-radius: 5px;
    border: 1px solid gray;
}
.btn {
    padding: 10px;
    font-size: 15px;
    color: white;
    background: #5F9EA0;
    border: none;
    border-radius: 5px;
}
.error {
    width: 92%; 
    margin: 0px auto; 
    padding: 10px; 
    border: 1px solid #a94442; 
    color: #a94442; 
    background: #f2dede; 
    border-radius: 5px; 
    text-align: left;
}
.success {
    color: #3c763d; 
    background: #dff0d8; 
    border: 1px solid #3c763d;
    margin-bottom: 20px;
}
.profile_info img {
    display: inline-block; 
    width: 50px; 
    height: 50px; 
    margin: 5px;
    float: left;
}
.profile_info div {
    display: inline-block; 
    margin: 5px;
}
.profile_info:after {
    content: "";
    display: block;
    clear: both;
}
    </style>
<body>
<div class="header">
    <h2>Member Login</h2>
</div>
<form method="post" action="login.php">
    <?php  if (count($errors) > 0) : ?>
                    <div class="error-kmmt" style="color: red;">
                      <?php foreach ($errors as $error) : ?>
                        <p><?php echo $error ?></p>
                      <?php endforeach ?>
                    </div>
                 <?php  endif ?>
    <div class="input-group">
        <label>Email</label>
        <input type="email" name="email" value="">
    </div>
    <div class="input-group">
        <label>Password</label>
        <input type="password" name="password">
    </div>
    
    <div class="input-group">
        <button type="submit" class="btn" name="user_login">Login
        </button>
    </div>
    <p>
        Already a member? <a href="login.php">Sign in</a>
    </p>
</form>
</body>
</html>

