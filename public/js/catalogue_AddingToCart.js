function addToCart(id) {
    $.ajax({
        type: "POST",
        url: "?page=catalogue&func=addToCart&productId=" + id,
        success: function (data) { //callback func
            console.log(data);
            console.log('sth');
            $("#cartCount").html("(" + data + ")");
            // console.log(data);
        }
    }); // бэйсикалли он тупа переходит по указанному адресу и возвращается (обратно?) без перезагрузки всей страницы
};