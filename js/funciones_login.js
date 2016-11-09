function Login() {

    var pagina = "./admin_login.php";

    var usuario = {Email: $("#email").val(), Password: $("#password").val()};

    $.ajax({
        type: 'POST',
        url: pagina,
        dataType: "json",
        data: {
            usuario: usuario
        },
        async: true
    })
    .done(function (objJson) {

        if (!objJson.Exito) {
            alert(objJson.Mensaje);
            return;
        }

        window.location.href = "index.php";

    })
    .fail(function (jqXHR, textStatus, errorThrown) {
        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    });

}