$('#ProductModal').on('show.bs.modal', function (event) {
    var modalData = $(event.relatedTarget);
    $("input[name='idProduct']").val(modalData.data("id"));
    $("input[name='nameProduct']").val(modalData.data("name"));
    $("input[name='prizeProduct']").val(modalData.data("prize"));
    $("input[name='imgProduct']").val(modalData.data("img"));

    $("#ProductModalLabel").html(modalData.data("name"));
    $("#pImg img").attr("src", "img/productImg/"+modalData.data("img"));
    $("#pDesc").html(modalData.data("desc"));
    $("#pPrize").html("Precio de racion: <b>"+modalData.data("prize") + "€</b>");
});