function Ajaxlogin () {
    console.log('wywolano ajaxlogin');
    $.ajax({
        type: 'POST',
        url: 'accounts/handler.php',
        data: $("#login-form").serialize(),
        //or your custom data either as object {foo: "bar", ...} or foo=bar&...
        success: function (response) {
            if (getCookie("loginResult") == 'false') {
                console.log(getCookie("loginResult"));
                $('#loginform-info').css({
                    display: "block"
                });
                $('#loginform-info').html('Wystąpił błąd podczas logowania - proszę spróbować ponownie');
            }
            if (getCookie("loginResult") == 'true') {
                console.log(getCookie("loginResult"));
                $('#loginform-info').css({
                    display: "block",
                    "background-color" : "#5cb85c"
                });
                $('#loginform-info').html('Zalogowano Pomyślnie - zaraz nastąpi przekierowanie');
                setTimeout("location.href='./user_panel/userpanel.php';",1000);
            }
        }
    });

}
$('#login-form-submit').on('click', Ajaxlogin);


function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

$('#registerform-submit').on('click', function () {
    
    $.ajax({
        type: 'POST',
        url: 'accounts/handlerregister.php',
        data: $("#registerform-form").serialize(),
        success: function (response) {
            console.log(response.length + response);
            $('#registerform-info').css({
                display: "block"
            });
            if(response.length == 32) {
                $('#registerform-info').css({"background-color" : "#5cb85c"});
                $('#loginform-login').val($('#registerform-login').val());
                $('#loginform-password').val($('#registerform-password1').val());
                setTimeout(function(){Ajaxlogin()},1000);
            } 
            $('#registerform-info').html(response);
            
        }
    });

});