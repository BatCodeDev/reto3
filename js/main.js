function modal(id) {
    $.get("index.php?controller=Product&action=modal&idProduct="+id, function (data) {
        let modalData = JSON.parse(data);
        $("#ProductModalLabel").html(modalData.name);
        $("#ProductModal .modal-body").html(modalData.description);
    });
}