<?php
/**
 * Created by PhpStorm.
 * User: IEEfimov
 * Date: 25.08.2017
 * Time: 19:43
 */

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

// 


$taskID = -1;
if (isset($_POST['taskID'])) $taskID = $_POST['taskID'];
if ($taskID == -1) die("Unset id error");

if (isset($_POST['projectID'])) $projectID = $_POST['projectID'];


$query = "SELECT * FROM `tasks` WHERE (Project=$projectID AND ID>$taskID) ORDER BY ID ASC";

$result = mysqli_fetch_assoc( mysqli_query($connect, $query));

include_once("../../pages/templates/Task.php");
if (isset($result['ID'])){
	$old = new Task($result['ID'],$result['Status'],$result['Name'],$result['Project']);

	$query = "SELECT * FROM `tasks` WHERE (ID=$taskID)";
	$result = mysqli_fetch_assoc(mysqli_query($connect, $query));

	$new = new Task($result['ID'],$result['Status'],$result['Name'],$result['Project']);
	
	$query = "UPDATE `tasks` SET `Name`='$old->name',`Status`=$old->status WHERE ID=$new->id";
	$res1 =  (mysqli_query($connect, $query));

	$query = "UPDATE `tasks` SET `Name`='$new->name',`Status`=$new->status WHERE ID=$old->id";
	$res2 = (mysqli_query($connect, $query));

	if ($res1 == true && $res2 == true) echo "$old->id";

} 
else die("none");



