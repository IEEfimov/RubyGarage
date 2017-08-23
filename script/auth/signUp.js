/**
 * Created by IEEfimov on 21.08.2017.
 */
var Name = "";
var Surname = "";

var errors = true;

function loadLoginScreen() {
    var root = document.querySelector('#root');
    root.style.opacity = "0";

    var ajx = new XMLHttpRequest();
    ajx.onreadystatechange = function () {
        if (ajx.readyState == 4){
            root.innerHTML = ajx.responseText;
            root.style.opacity = "1";
            preload();
        }
    };
    ajx.open('GET','script/auth/loginScreen.php');
    ajx.send();
}

function signInNext() {
    var wind = document.querySelector('#loginScreen');
    var root = document.querySelector('#root');
    var str = document.querySelector('#string');

    wind.style.transform = "rotateY(180deg)";
    str.style.opacity="0";
    str.style.transform = "translateY(-30px)";

    Name = document.querySelector("#firstName").value;
    Surname = document.querySelector("#surname").value;

    var ajx = new XMLHttpRequest();
    ajx.onreadystatechange = function () {
        if (ajx.readyState == 4){

            str.innerHTML="Добро пожаловать, "+Name
                +"! Теперь придумайте логин и пароль";
            str.style.opacity = "1";
            wind.innerHTML = ajx.responseText;
            wind.style.opacity = "1";
            wind.style.transform = "rotateY(360deg)";

            $("#newLogin").keyup(function(event){
                if(event.keyCode == 13){
                    signUp();
                }if (document.querySelector('#newLogin').value.length >= 1) loginAlertClose();
                else loginAlert("Введите логин");
            }).focusout(function() {
                if (document.querySelector('#newLogin').value.length < 1)
                    loginAlert("Введите логин");
                else loginAlertClose();
                isValidNewLogin();

            });
        }

    };
    ajx.open('GET','script/auth/signUpScreen2.php');
    ajx.send();




}

function isValidNewLogin(){
    var loginStr = document.querySelector('#newLogin').value;
    if (loginStr.length < 1) {
        loginAlert("Введите логин");
    }

    $.post(
        "script/auth/testALogin.php",
        {
            login: loginStr
        },
        onAjaxSuccess
    );

    function onAjaxSuccess(data)
    {
        if (data === "1"){

        }
        else loginAlert("Выбранный логин уже существует");
    }

}

function signUp() {

    var loginStr = document.querySelector("#newLogin").value;
    var passStr = document.querySelector("#newPass").value;

    $.post(
        "script/auth/signUp.php",
        {
            name: Name,
            surname : Surname,
            login: loginStr,
            password: passStr
        },
        onAjaxSuccess
    );

    function onAjaxSuccess(data)
    {
        if (data === "TRUE"){
            var login = document.querySelector('#loginScreen');
            login.style.transform = "scale(0.1)";
            login.style.opacity = "0";
            var str = document.querySelector('#string');
            str.style.opacity = "0";


            setTimeout(function () {
                login.innerHTML = "✓";
                login.style.color="white";
                login.style.textAlign="center";
                login.style.fontSize="100pt";
                login.style.fontWeight="600";
                login.style.transform = "scale(1)";
                login.style.opacity = "1";
                // login.style.backgroundColor = "rgba(35, 95, 64, 0.94)";

            }, 400); // время в мс

            setTimeout(function () {
                login.style.transform = "scale(0.1)";
                login.style.opacity = "0";
                loadLoginScreen();
                // login.style.backgroundColor = "rgba(35, 95, 64, 0.94)";

            }, 1500); // время в мс
        }
        else alert(data);
    }
}

function nameChanged() {
    var name = document.querySelector('#firstName');
    var surname = document.querySelector('#surname');
    var nextBtn = document.querySelector('#signUpNext');

    if (name.value.length < 1 || surname.value.length < 1) {
        nextBtn.disabled = "disabled";
    }
   else nextBtn.disabled = "";

}

function loginChanged() {
    var login = document.querySelector('#newLogin');
    var pass = document.querySelector('#newPass');
    var upBtn = document.querySelector('#up');

    if (login.value.length < 1 || pass.value.length < 1) {
        upBtn.disabled = "disabled";
    }
   else upBtn.disabled = "";

}
