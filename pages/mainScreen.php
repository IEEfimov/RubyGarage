<div id="root">
<?php
include_once("../script/DBparams.php");

if (isset($_COOKIE['login_save'])){
    $query = "SELECT * FROM `Users` WHERE `Login`= '".$_COOKIE['login_save']."'";
}else{
    $query = "SELECT * FROM `Users` WHERE `Login`= '".$_POST['login']."'";
}

$user = mysqli_fetch_assoc( mysqli_query($connect, $query));
if ($user['Password'] != $_COOKIE["Password"]){
    setcookie("Password","");
    $message = "Wrong password!";
    echo $message;
    die("wrong pass");
}


echo "<div class=\"owner\">
    <div class=\"name\">
    $user[Name] $user[Surname]
    </div>
    <i class=\"material-icons logout\">settings</i>
    <i class=\"material-icons logout\" onclick='loadLoginScreen()' >exit_to_app</i>

</div>";
    include_once("../pages/templates/Project.php");

    $query = "SELECT * FROM `Projects` WHERE `Owner`= '$user[ID]'";
    $result = mysqli_fetch_all( mysqli_query($connect, $query),MYSQLI_ASSOC);


$index = 0;

    echo "<div id='projects'>";

    foreach ($result as $item){
        $projects[$index] = new Project($item['ID'],$item['Name'],$item['Owner']);
        $projects[$index]->write();
        $index++;
    }
    echo "</div>"
?>

<div class="addProjectBtn" onclick="addProject()">
    Add TODO list
</div>

