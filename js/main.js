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
    var form_data = "";
    if (idForm !== "")
        form_data = $("#"+idForm).serialize();
    $.ajax({
        type: "POST",
        url: target,
        data: form_data,
        success: function(data){
            if(action !== "")
                action(data);
        },
        error: function(){}
    });
    return false;
}
let reloadCart = function (data) {
    data = JSON.parse(data);
    if (data !== "0"){
        $("#addQty"+data.id).html(data.val);
        $("#cartButtonQty").html(parseInt($("#cartButtonQty").html()) + 1);
        $("#cartInputQty"+data.id).val(data.val);
        let r = parseFloat($("#prize"+data.id).html());
        $(".result"+data.id).html(Math.round( (parseInt(data.val) * r) * 10) / 10);
        $("#totalResult").html(function () {
            let total = 0;
            let vals = $(".sum");
            for (x = 0; x < vals.length; x++){
                total += parseFloat(vals[x].innerHTML);
            }
            return Math.round( (total) * 10) / 10;
        });
    }
}
let errorCart = function (data) {
    if (data == 1){
        $("#orderMsg").show();
    }else{

    }
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