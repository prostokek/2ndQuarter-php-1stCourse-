// console.log('sss');
// console.log(id);
function changeCountInCart(id) {
    // console.log(id);
    $.ajax({
        type: "POST",
        url: "?page=changeCountInCart&id=" + id,
        success: function (data) { //callback func
            console.log(data);
        }
    }); // этот ajax-запрос просто вообще весь html этой страницы (уже отрендеренный при помощи php) вернёт в data
};
