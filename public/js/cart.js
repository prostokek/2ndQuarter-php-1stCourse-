function appendProductCount(id) {
    $.ajax({
        type: "POST",
        url: "?page=cart&func=appendProductCount&productId=" + id,
        success: function (data) { //callback func
            console.log(data);
        }
    }); // бэйсикалли он тупа переходит по указанному адресу и возвращается (обратно?) без обновления страницы
};
console.log('?');