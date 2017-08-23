<?php
/**
 * Created by PhpStorm.
 * User: IEEfimov
 * Date: 21.08.2017
 * Time: 21:26
 */

?>

<html>
<head>
    <title> RubyGarage Todo list</title>
    <link href="../style/main.css" rel="stylesheet">
    <link href="../style/page.css" rel="stylesheet">
    <script src="../script/login.js"></script>
    <script src="../script/auth/signUp.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
</head>

<body >
<div class="owner">
    <div class="name">
        Иван Ефимов
    </div>
    <i class="material-icons logout">settings</i>
    <i class="material-icons logout">exit_to_app</i>

</div>


<div id="root">
<?php
    for ($i=0; $i<1;$i++){
        include("../pages/templates/todoList.php");
    }
?>
</div>



</body>
</html>
