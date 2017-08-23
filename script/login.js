/**
 * Created by IEEfimov on 20.08.2017.
 */

function preload() {
    $("#password").keyup(function(event){
        if(event.keyCode == 13){
            login();
            return;
        }if (document.querySelector('#password').value.length >= 1) passAlertClose();
        else passAlert("Введите пароль");
    }).focusout(function() {
        if (document.querySelector('#password').value.length < 1)
            passAlert("Введите пароль");
        else passAlertClose();
    });

    $("#login").keyup(function(event){
        if(event.keyCode == 13){
            login();
            return;
        }
        if (document.querySelector('#login').value.length >= 1) loginAlertClose();
        else loginAlert("Введите логин");
    }).focusout(function() {
        if (document.querySelector('#login').value.length < 1)
        loginAlert("Введите логин");
        else loginAlertClose();
    });

}

function loginAlert(text) {
    var alert = document.querySelector("#alert1");
    alert.innerHTML = "✘ "+ text;
    alert.style.color = "red";
    alert.style.height="15pt";
    alert.style.opacity="1";

    errors = true;
}

function loginAlertClose() {
    var alert = document.querySelector("#alert1");
    alert.innerHTML = "✓ ";
    alert.style.color = "green";
    alert.style.height="0px";
    alert.style.opacity="0";

    errors = false;
}

function passAlert(text) {
    var alert = document.querySelector("#alert2");
    alert.innerHTML = "✘ "+ text;
    alert.style.color = "red";
    alert.style.height="15pt";
    alert.style.opacity="1";

    errors = true;
}

function passAlertClose() {
    var alert = document.querySelector("#alert2");
    alert.innerHTML = "✓ ";
    alert.style.color = "green";
    alert.style.height="0px";
    alert.style.opacity="0";

    errors = false;
}

function loadSignInScreen() {
    var wind = document.querySelector('#loginScreen');
    var root = document.querySelector('#root');

    wind.style.transform = "translateX(-100%)";
    root.style.opacity = "0";

    var ajx = new XMLHttpRequest();
    ajx.onreadystatechange = function () {
        if (ajx.readyState == 4){
            root.innerHTML = ajx.responseText;
            root.style.opacity = "1";

            $("#firstName").keyup(function(event){
                if(event.keyCode == 13){
                    signUp();
                }if (document.querySelector('#firstName').value.length >= 1) loginAlertClose();
                else loginAlert("Введите имя");
            }).focusout(function() {
                if (document.querySelector('#firstName').value.length < 1)
                    loginAlert("Введите имя");
                else loginAlertClose();

            });

            $("#surname").keyup(function(event){
                if(event.keyCode == 13){
                    signUp();
                }if (document.querySelector('#surname').value.length >= 1) passAlertClose();
                else passAlert("Введите фамилию");
            }).focusout(function() {
                if (document.querySelector('#surname').value.length < 1)
                    passAlert("Введите фамилию");
                else passAlertClose();

            });
        }
    };
    ajx.open('GET','script/auth/signUpScreen.php');
    ajx.send();
}


function login() {
    var loginStr = document.querySelector('#login').value;
    var passStr = document.querySelector('#password').value;
    $.post(
        "script/auth/signIn.php",
        {
            login: loginStr,
            password: passStr
        },
        onAjaxSuccess
    );

    function onAjaxSuccess(data)
    {
        if (data === "YES"){
            var login = document.querySelector('#loginScreen');
            login.style.transform = "scale(0.1)";
            login.style.opacity = "0";


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

            }, 1200); // время в мс
        }

        else {
            //alert(data);
            var btn = document.querySelector('#loginScreen');
            btn.style.animationIterationCount = "1"
            btn.style.animation = "no 0.7s ease"

            setTimeout(function () {
                btn.style.animationIterationCount = ""
                btn.style.animation = ""
                document.querySelector("#password").value = "";
                document.querySelector("#password").placeholder = "Проверьте пароль";

            }, 700); // время в мс
        }
    }
}


