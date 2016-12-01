/** 
 * Функция для отправки формы средствами Ajax 
 **/
function AjaxFormRequest(result_id, form_id, url) {
    document.getElementById(result_id).innerHTML = 'Ожидайте... ';
    jQuery.ajax({
        url: url, //Адрес подгружаемой страницы 
        type: "POST", //Тип запроса 
        dataType: "html", //Тип данных 
        data: jQuery("#" + form_id).serialize(),
        success: function (response) { //Если все нормально 
            document.getElementById(result_id).innerHTML = response;
        },
        error: function (response) { //Если ошибка 
            document.getElementById(result_id).innerHTML = 'Ошибка при отправке формы';
        }
    });
}

