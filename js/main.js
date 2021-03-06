$(document).ready(function () {
    $('#dtMaterialDesignExample').DataTable();

    $('#dtMaterialDesignExample_wrapper > div').addClass("col-12");
    $('#dtMaterialDesignExample_wrapper > div').css("margin","0");
    $('#dtMaterialDesignExample_wrapper .dataTables_filter').find('input').each(function () {
        $('input').attr("placeholder", "Buscar");
        $('input').addClass("productSearch");

        $('input').css("margin-top", "1.2rem");
        $('input').removeClass('form-control-sm');
    });
    $('#dtMaterialDesignExample_wrapper .dataTables_length').addClass('d-flex flex-row');
    $('#dtMaterialDesignExample_wrapper .dataTables_filter').addClass('md-form');
    $('#dtMaterialDesignExample_wrapper select').removeClass(
        'custom-select custom-select-sm form-control form-control-sm');
    $('#dtMaterialDesignExample_wrapper select').addClass('custom-select');
    $('#dtMaterialDesignExample_wrapper .mdb-select').materialSelect();
    $('#dtMaterialDesignExample_wrapper .dataTables_filter').find('label').remove();

});
$( ".changeStatus" ).click(function() {
    var status = $(this).text();
    switch(status){
        case "CONFIRMADO": $(this).text("ENTREGADO");
            $(this).attr('class', 'btn btn-danger changeStatus');
            break;
    }
    var data = {
        status: $(this).text(),
        orderId: $(this).val()
    };
    ajax_listen("", "index.php?controller=Order&action=changeStatus", "", data);
});
$( ".searchStatus" ).click(function() {
    var status = $(this).text();
    $(".productSearch").val(status);
    $(".productSearch").focus();
    e = jQuery.Event("keyup");
    e.which = 13;
    jQuery('.productSearch').trigger(e);
});
var deleteCart = [];
function trashCart(id) {
    if(deleteCart.includes(id)){
        deleteCart.splice(deleteCart.indexOf(id), 1);
    }else{
        deleteCart.push(id);
    }
}
function deleteSelect() {
    let send_data = "";
    send_data = "ids="+JSON.stringify(deleteCart)+"&inputValue="+$("#productSearch").val();
    ajax_listen("", "index.php?controller=Product&action=multiDeleteProduct", multiDelete, send_data)
}
function switchOrders(sw) {
    if (sw.checked){
        $("#switchOn").hide();
        $("#switchOff").fadeIn(300);
        setTimeout(function () {
            $("#switchOff").fadeOut(300);
            setTimeout(function () {$("#switchInfo").fadeIn(300);},500);
        },1500);
        ajax_listen("", "index.php?controller=User&action=setNoOrders", "","mode=1");
    }else{
        $("#switchOff").hide();
        $("#switchInfo").hide();
        $("#switchOn").fadeIn(300);
        setTimeout(function () {$("#switchOn").fadeOut(300);},1500);
        ajax_listen("", "index.php?controller=User&action=setNoOrders", "","mode=0");
    }
}
function ajax_listen(idForm, target, action, send_data){
    var form_data = "";
    if (idForm !== "")
        form_data = $("#"+idForm).serialize();
    else
    if (send_data !== "" || send_data !== undefined){
        form_data = send_data;
    }
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


let multiDelete = function () {
    window.location.reload();
};

let infoMsg = function (data) {
    if (data === "0"){
        $("#switchInfo").hide();
    }else{
        if (data === "1"){
            $("#switchInfo").fadeIn(300);
            $(".switch input").attr("checked","checked");
        }
    }
};
ajax_listen("", "index.php?controller=User&action=getNoOrders", infoMsg, "");

let reloadCart = function (data) {
    data = JSON.parse(data);
    if (data.total+1 !== 1){
        $("#addQty"+data.id).html(data.val);
        $("#cartButtonQty").html(data.total);
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
};

let errorCart = function (data) {
    switch (data){
        case "0":
            $("#orderMsg span").html(" No hay ningun producto seleccionado");
            $("#orderMsg").addClass("alert alert-danger");
            $("#orderMsg i").addClass("fas fa-times-circle");
            $("#orderMsg").show();
            break;
        case "1":
            $("#orderMsg span").html(" Pedido realizado correctamente<br> En breves instantes recibira un mail de confirmacion");
            $("#orderMsg").addClass("alert alert-success");
            $("#orderMsg i").addClass("fas fa-check-circle");
            $("#orderMsg").show();
            setTimeout(function () {
                window.location.href = "index.php";
            },1000);
            break;
        case "2":
            $("#orderMsg span").html(" No se ha podido realizar el pedido");
            $("#orderMsg").addClass("alert alert-danger");
            $("#orderMsg i").addClass("fas fa-times-circle");
            $("#orderMsg").show();
            break;
        default:
            $("#orderMsg span").html(" No se ha podido enviar el mail de confirmacion");
            $("#orderMsg").addClass("alert alert-danger");
            $("#orderMsg i").addClass("fas fa-times-circle");
            $("#orderMsg").show();
            break;
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
};

let addCart = function (data) {
    location.reload();
};
let searchProducts=function (data) {
    $('#resultSearch').html(data);
};
let statisticsAction = function (data) {
    data = JSON.parse(data);
    let dataQty = [];
    let dataLvls = [];
    for (x = 0; x < data.length; x++){
        dataLvls.push(data[x].name);
        dataQty.push(data[x].pQuantity);
    }
    let ctxD = document.getElementById("doughnutChart").getContext('2d');
    let myLineChart = new Chart(ctxD, {
        type: 'doughnut',
        data: {
            labels: dataLvls,
            datasets: [{
                data: dataQty,
                backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360"],
                hoverBackgroundColor: ["#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5", "#616774"]
            }]
        },
        options: {
            responsive: true
        }
    });
};

$('#addCategory').click(function () {
    let send_data = "";
    send_data = "category="+JSON.stringify($('#category').val());
    ajax_listen("","index.php?controller=Category&action=insert",addCategory,send_data);

});
let addCategory = function (data) {
    //alert(data);
    $('#categoryPicker').add($('#category').val());
    $('#category').val("");
}