<html>
    <head>
        <title> RubyGarage Todo list</title>
        <meta charset="UTF-8">
        <link href="style/main.css" rel="stylesheet">
        <script src="script/login.js"></script>
        <script type="text/javascript" src="script/jquery-3.2.1.min.js"></script>
    </head>

<body onload="preload()">

<div id="root" >

    <?php
        if (isset($_COOKIE['login_save'])){
            include_once("script/DBparams.php");

            $query = "SELECT * FROM `users` WHERE `Login`= '".$_COOKIE['login_save']."'";
            $user = mysqli_fetch_assoc( mysqli_query($connect, $query));
            if ($user['Password'] != $_COOKIE["Password"]){
                setcookie("Password",null,time()+8600,"/");
                $message = "Wrong password!";
                echo $message;
                include_once("pages/templates/auth/loginScreen.php");
            }
            else {
                echo "<script type=\"text/javascript\">
    loadMainScreen();
</script>";
            }

        }
        else{
            include_once("pages/templates/auth/loginScreen.php");
        }

    ?>


</div>



</body>
</html>