function modal(id) {
    $.get("index.php?controller=Product&action=modal&idProduct="+id, function (data) {
        let modalData = JSON.parse(data);
        $("#ProductModalLabel").html(modalData.name);
        $("#ProductModal .modal-body").html(modalData.description);

        $("input[name='idProduct']").val(modalData.id);
        $("input[name='nameProduct']").val(modalData.name);
        $("input[name='prizeProduct']").val(modalData.prize);
        $("input[name='imgProduct']").val(modalData.img);
    });
}
function ajax_listen(idForm, target, action){
    var form_data = $("#"+idForm).serialize();
    $.ajax({
        type: "POST",
        url: target,
        data: form_data,
        success: function(data){
            action(data);
        },
        error: function(){}
    });
    return false;
}
let errorLogin = function (data) {
    if(data == "1") {
        $("#msg span").html(" Log in con exito");
        $("#msg").addClass("alert-success");
        $("#msg i").addClass("fa-check-circle");
        $("#msg").show();
        setTimeout(function () {
            window.location.href = "index.php";
        }, 1000);
    }else{
        $("#msg span").html(" Usuario o contraseña incorrectos");
        $("#msg").addClass("alert-danger");
        $("#msg i").addClass("fa-times-circle");
        $("#msg").show();
    }
}

let addCart = function (data) {
    location.reload();
}