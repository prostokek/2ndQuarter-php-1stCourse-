function addToCart(id) {
    $.ajax({
        type: "POST",
        url: "?page=catalogue&func=addToCart&productId=" + id,
        success: function (data) { //callback func
            $("#cartCount").html("(" + data + ")");
            // console.log(data);
        }
    }); // бэйсикалли он тупа переходит по указанному адресу и возвращается (обратно?) без обновления страницы
};
