<html>
    <head>
        <title> RubyGarage Todo list</title>
        <link href="style/main.css" rel="stylesheet">
        <script src="script/login.js"></script>
        <script src="script/auth/signUp.js"></script>
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
    </head>

<body id="root" onload="preload()">

<div id="string"> </div>

    <div id="loginScreen">
        <input type="text" id="login" placeholder="Логин" class="input" on="">
        <br>
        <div class="alert" id = "alert1"></div>
        <input type="password" id="password" placeholder="Пароль" class="input" >
        <br>
        <div class="alert" id = "alert2"></div>
        <input type="button" id="loginBtn" value="ВОЙТИ" class="button" onclick="login()">
        <div id="signUp" onclick="loadSignInScreen()"> У меня нет аккаунта </div>

    </div>


</body>
</html>