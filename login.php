


</html>
<!DOCTYPE html>
<html lang="en">
<head>
    
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
    <link rel="stylesheet" href="login_style.css">
</head>
<body>
<?php
require('connectdb.php');

if (isset($_POST['username'])){
        // removes backslashes
	$username = stripslashes($_REQUEST['username']);
        //escapes special characters in a string
	$username = mysqli_real_escape_string($con,$username);
	$password = stripslashes($_REQUEST['password']);
	$password = mysqli_real_escape_string($con,$password);
	//Checking is user existing in the database or not
        $query = "SELECT * FROM `Users` WHERE username='$username' and password='".md5($password)."'";
	$result = mysqli_query($con,$query) or die(mysql_error());
	$rows = mysqli_num_rows($result);
        $session_user = $username;
        if($rows==1){
                session_start();
                $_SESSION["username"] = mysqli_fetch_assoc($result);
                header("Location: index.php");
            
         }else{
		echo "<h3>Username/password is incorrect.</h3>";
	}
    }else{
?>
<div class="form"> 
    <form action="" method="post" name="login">
            <h3 class="h3">Вход</h3>
            <label for="username">Логин</label>
            <input type="text" name="username" placeholder="Введите логин" required />
            <label for="password">Пароль</label>
            <input type="password" id="password "name="password" placeholder="Введите пароль" required />
            <input name="submit" type="submit" value="Войти" />
            <a href="auth.php" class="link">Нет аккаунта? Зарегистрироваться</a>
            <a href="index.html" class="link">Вернуться на главную </a>
    </form>  
        
</div>
    
<?php } ?>
</body>
</html>



