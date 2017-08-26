/**
 * Created by IEEfimov on 20.08.2017.
 */

var Name = "";
var Surname = "";

var errors = true;
var lastInsert = -1;



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
    ajx.open('GET','pages/templates/auth/signUpScreen.php');
    ajx.send();
}


function login() {
    var loginStr = document.querySelector('#login').value;
    var passStr = document.querySelector('#password').value;
    var saveMe = document.querySelector('#saveMe').checked;

    $.post(
        "script/auth/signIn.php",
        {
            save:saveMe,
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

            Name = loginStr;
            Surname = passStr;

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
                loadMainScreen();
                // login.style.backgroundColor = "rgba(35, 95, 64, 0.94)";

            }, 1200);
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

function loadMainScreen() {
    var root = document.querySelector('body');
    root.style.opacity = "0";


    $.post(
        "pages/mainScreen.php",
        {
            login: Name,
            password: Surname
        },
        onAjaxSuccess
    );

    function onAjaxSuccess(data)
    {
        var root = document.querySelector('body');
        root.style.opacity = "0";

        $('head').append( $('<link rel="stylesheet" type="text/css" />').attr('href', 'style/page.css') );
        root.style.opacity = "1";
        setTimeout(function () {
            root.innerHTML = data;
            root.style.opacity = "1";

        }, 400);

    }

}

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
    ajx.open('GET','pages/templates/auth/loginScreen.php');
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
    ajx.open('GET','pages/templates/auth/signUpScreen2.php');
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

function addProject() {
    $.post(
        "script/ProjectActions/addProject.php",
        {

        },
        onAjaxSuccess
    );

    function onAjaxSuccess(data)
    {
            addMyProject(data)
    }

}

function addMyProject(id) {
    lastInsert = id;
    $.post(
        "pages/templates/Handler.php",
        {
            classer: "Project",
            ider: id
        },
        onAjaxSuccess
    );

    function onAjaxSuccess(data)
    {
        $("#projects").append(data);
        var added = document.querySelector('#flex'+lastInsert);
        added.style.transform = "scale(0.1)";
        added.style.opacity = "0";
        $("html, body").animate({ scrollTop: $(document).height() }, 1000);
        //
        //
        setTimeout(function () {
            added.style.transform = "scale(1)";
            added.style.opacity = "1";
            // login.style.backgroundColor = "rgba(35, 95, 64, 0.94)";

        }, 400);
    }
}

function deleteProject(current){

    var id = "";
    for (var i=9;i<current.id.length; i++){
        id += current.id[i];
    }
    // alert(id);

    $.post(
        "script/ProjectActions/deleteProject.php",
        {
            deletedID: id
        },
        onAjaxSuccess
    );

    function onAjaxSuccess(data)
    {
        var deleted = document.querySelector('#flex'+id);
        deleted.style.transform = "scale(0.1)";
        deleted.style.opacity = "0";
        // $("html, body").animate({ scrollTop: $(document).height() }, 1000);
        //
        //
        setTimeout(function () {
            deleted.style.display = "none";

        }, 400);
    }
}

function keyup(current) {
    var id = "";
    for (var i=4;i<current.id.length; i++){
        id += current.id[i];
    }

    $.post(
        "script/ProjectActions/renameProject.php",
        {
            renamedID: id,
            renamedName: current.value
        },
        onAjaxSuccess
    );

    function onAjaxSuccess(data)
    {
        // alert(data);
        // var deleted = document.querySelector('#flex'+id);
        // deleted.style.transform = "scale(0.1)";
        // deleted.style.opacity = "0";
        // // $("html, body").animate({ scrollTop: $(document).height() }, 1000);
        // //
        // //
        // setTimeout(function () {
        //     deleted.style.display = "none";
        //
        // }, 400);
    }
}

function editProject(current) {
    var id = "";
    for (var i=7;i<current.id.length; i++){
        id += current.id[i];
    }
    var line = document.querySelector("#name"+id);
    line.select();
    line.focus();

}

function addTaskOnClick(current) {
    var id = "";
    for (var i=10;i<current.id.length; i++){
        id += current.id[i];
    }

    var text = document.querySelector("#addTaskInput"+id).value;

    $.post(
        "script/TaskActions/addTask.php",
        {
            taskText: text,
            projectID: id
        },
        onAjaxSuccess
    );

    function onAjaxSuccess(data)
    {
        addMyTask(data,id);
        // var deleted = document.querySelector('#flex'+id);
        // deleted.style.transform = "scale(0.1)";
        // deleted.style.opacity = "0";
        // // $("html, body").animate({ scrollTop: $(document).height() }, 1000);
        // //
        // //
        // setTimeout(function () {
        //     deleted.style.display = "none";
        //
        // }, 400);
    }
}

function addMyTask(id,flexID) {
    lastInsert = id;
    $.post(
        "pages/templates/Handler.php",
        {
            classer: "Task",
            ider: id
        },
        onAjaxSuccess
    );

    function onAjaxSuccess(data)
    {
        $("#TasksIn"+flexID).append(data);
        //alert('#task'+flexID+"_"+id);
        var added = document.querySelector('#task'+flexID+"_"+id);
        added.style.transform = "scale(0.1)";
        added.style.opacity = "0";
        // $("html, body").animate({ scrollTop: $(document).height() }, 1000);
        //
        //
        setTimeout(function () {
            added.style.transform = "scale(1)";
            added.style.opacity = "1";
            // login.style.backgroundColor = "rgba(35, 95, 64, 0.94)";

        }, 50);
    }
}

function taskStrOnChange(current) {
    if(event.keyCode == 13){
        var id = "";
        for (var i=12;i<current.id.length; i++){
            id += current.id[i];
        }
        addTaskOnClick(document.querySelector("#AddTaskBtn"+id));
        current.value="";
        return;
    }
}


function deleteTask(flex,id){


    $.post(
        "script/TaskActions/deleteTask.php",
        {
            deletedID: id
        },
        onAjaxSuccess
    );

    function onAjaxSuccess(data)
    {
        var deleted = document.querySelector('#task'+flex+"_"+id);
        deleted.style.transform = "scale(0.1)";
        deleted.style.opacity = "0";
        // $("html, body").animate({ scrollTop: $(document).height() }, 1000);
        //
        //
        setTimeout(function () {
            deleted.style.display = "none";

        }, 400);
    }
}


