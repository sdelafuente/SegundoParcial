function Enunciado() {

    var pagina = "./enunciado.php";

    $.ajax({
        type: 'POST',
        url: pagina,
        dataType: "html",
        async: true
    })
    .done(function (grilla) {

        $("#divGrilla").html(grilla);

        var pagina = "./puntaje.php";

        $.ajax({
            type: 'POST',
            url: pagina,
            dataType: "html",
            async: true
        })
        .done(function (grilla) {

            $("#divAbm").html(grilla);

        })
        .fail(function (jqXHR, textStatus, errorThrown) {
            alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
        });

    })
    .fail(function (jqXHR, textStatus, errorThrown) {
        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    });
}

function MostrarGrilla() {

    var pagina = "./administracion.php";

    $.ajax({
            type:"POST",
            url:pagina,
            dataType: "html",
            data: {
                queMuestro:"MOSTRAR_GRILLA"
            }
    }).then(function ok(arrJson){

        $("#divGrilla").html(arrJson);

    }, function fail(jqXHR, textStatus, errorThrown){
         alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    });

}
function CargarFormUsuario() {

    var pagina = "./administracion.php";

    $.ajax({
        type: 'POST',
        url: pagina,
        dataType: "html",
        data: {
            queMuestro: "FORM"
        },
        async: true
    })
    .done(function (html) {

        $("#divAbm").html(html);
        $('#cboPerfiles > option[value="usuario"]').attr('selected', 'selected');
    })
    .fail(function (jqXHR, textStatus, errorThrown) {
        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    });

}

function AgregarUsuario() {

    var pagina      = "./administracion.php";
    var nombre      = $("#txtNombre").val();
    var email       = $("#txtEmail").val();
    var password    = $("#txtPassword").val();
    var perfil      = $("#cboPerfiles").val();
    var user        = { "nombre":nombre, "email":email, "pass":password, "perfil":perfil };

    $.ajax({
        type: 'POST',
        url: pagina,
        dataType: "json",
        data: {
            queMuestro: "ALTA_USUARIO",
            usuario: user
        },
        async: true
    }).then(function ok(objJson){

            if (!objJson.Exito) {
                alert(objJson.Mensaje);
                return;
            }
            alert(objJson.Mensaje);
            MostrarGrilla();
    }, function fail(jqXHR, textStatus, errorThrown){
        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    });

}

function EditarUsuario(obj) {//#sin case

    var pagina = "./administracion.php";

    $.ajax({
        type: 'POST',
        url: pagina,
        dataType: "html",
        data: {
            queMuestro: "FORM",
            usuario: obj
        },
        async: true
    })
    .done(function (html) {

        $("#divAbm").html(html);

    })
    .fail(function (jqXHR, textStatus, errorThrown) {
        
    });
}

function ModificarUsuario() {//#3a

    var pagina      = "./administracion.php";
    
    var id          = $("#hdnIdUsuario").val();
    var nombre      = $("#txtNombre").val();
    var email       = $("#txtEmail").val();
    var password    = $("#txtPassword").val();
    var perfil      = $("#cboPerfiles").val();
    var user        = { "id":id,"nombre":nombre, "email":email, "pass":password, "perfil":perfil };
    
    if (!confirm("Modificar USUARIO?")) {
        return;
    }

    $.ajax({
        type:'POST',
        url:pagina,
        dataType:'json',
        data:{
            queMuestro:'MODIFICAR_USUARIO',
            usuario:user
        },
        async:true
        }).then(function success(objJson){
            if (!objJson.Exito) {
                alert(objJson.Mensaje);
                return;
            }
            alert(objJson.Mensaje);
            CargarFormUsuario();
            MostrarGrilla();
        },function error(jqXHR, textStatus, errorThrown){
            alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
        });


}

function EliminarUsuario() {//#3b

    if (!confirm("Eliminar USUARIO?")) {
        return;
    }

    var pagina = "./administracion.php";

    var id = $("#hdnIdUsuario").val();
    //var foto = $("#hdnFotoSubir").val();

    var usuario = {};
    usuario.id = id;

    $.ajax({
        type: 'POST',
        url: pagina,
        dataType: "json",
        data: {
            queMuestro: "ELIMINAR_USUARIO",
            usuario: usuario
        },
        async: true
    })
    .done(function (objJson) {

        if (!objJson.Exito) {
            alert(objJson.Mensaje);
            return;
        }

        alert(objJson.Mensaje);

        $("#divAbm").html("");
        MostrarGrilla();

    })
    .fail(function (jqXHR, textStatus, errorThrown) {
        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    });

}
function Logout() {//#5

    var pagina = "./administracion.php";

    $.ajax({
        type: 'POST',
        url: pagina,
        dataType: "html",
        data: {
            queMuestro: "LOGOUT"
        },
        async: true
    })
    .done(function (html) {

        window.location.href = "login.php?uss=1";

    })
    .fail(function (jqXHR, textStatus, errorThrown) {
        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    });

}
function traerCdsConWS(){
    
//implementar...

}
