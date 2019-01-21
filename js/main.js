function modal(id) {
    $.get("index.php?controller=Product&action=modal&idProduct="+id, function (data) {
        let modalData = JSON.parse(data);
        $("#ProductModal .modal-footer #buy").click(function(){
            $.get("index.php?controller=Product&action=addCart&nameProduct="+modalData.name, function (data) {
                        alert(data.toString());

                        $("#quantity").html();
                        $("#listProduct").html('<li>'+
                          '<span class="item">'+
                            '<span class="item-left">'+
                            '<img src="http://www.prepbootstrap.com/Content/images/template/menucartdropdown/item_1.jpg" alt="" />'+
                            '<span class="item-info">'+
                            '<span>Item name</span>'+
                            '<span>price: 27$</span>'+
                            '</span>'+
                            '</span>'+
                            '<span class="item-right">'+
                            '    <button class="btn btn-danger  fa fa-close"></button>'+
                            '</span>'+
                            '</span>'+
                        '</li> ');
            });
    });
        $("#ProductModalLabel").html(modalData.name);
        $("#ProductModal .modal-body").html(modalData.description);
    });
}
function ajax_listen(idForm, target, action, admin){
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