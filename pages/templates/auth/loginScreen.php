<?php
/**
 * Created by PhpStorm.
 * User: IEEfimov
 * Date: 21.08.2017
 * Time: 3:37
 */
usleep(400000);

setcookie("login_save",null,-1,"/");
?>
<div id="string"> </div>
<div id="loginScreen">
    <input type="text" id="login" placeholder="Логин" class="input">
    <br>
    <div class="alert" id = "alert1"></div>
    <input type="password" id="password" placeholder="Пароль" class="input" >
    <br>
    <div class="alert" id = "alert2"></div>
    <input type="checkbox" id="saveMe" value="" onclick="">
    <span onclick="changeCheckedSaveMe()" id='saveMeStr' disabled="disabled"> Запомнить меня</span>
    <input type="button" id="loginBtn" value="ВОЙТИ" class="button" onclick="login()">
    <div id="signUp" onclick="loadSignInScreen()"> У меня нет аккаунта </div>


</div>