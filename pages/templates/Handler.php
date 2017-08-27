<?php
/**
 * Created by PhpStorm.
 * User: IEEfimov
 * Date: 22.08.2017
 * Time: 10:10
 */


$class = $_POST['classer'];
$id = $_POST['ider'];

include_once("../../script/DBparams.php");

if (isset($_COOKIE['current_login'])){
    $query = "SELECT * FROM `Users` WHERE `Login`= '".$_COOKIE['current_login']."'";
}
$user = mysqli_fetch_assoc( mysqli_query($connect, $query));

if ($user['Password'] != $_COOKIE["Password"]){
    setcookie("Password","");
    $message = "Wrong password!";
    echo $message;
    die("wrong pass");
}

if ($class == "Project"){
    include_once("Project.php");

    $query = "SELECT * FROM `Projects` WHERE `ID`= '$id'";
    $result = mysqli_fetch_assoc( mysqli_query($connect, $query));


    if ($result['Owner'] == $user['ID']){
        $project = new Project($result['ID'],$result['Name'],$result['Owner']);
        $project->write();
    }

}
if ($class == "Task"){
    include_once("Task.php");

    $query = "SELECT * FROM `Tasks` WHERE `ID`= '$id'";
    $item = mysqli_fetch_assoc( mysqli_query($connect, $query));

    $project = new Task($item['ID'],$item['Status'],$item['Name'],$item['Project']);
    $project->write();


}