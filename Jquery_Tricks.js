//----------------- data-* ----------------------------
//Важно знать, что при изменении значения атрибута data-* 
//оно не поменяеться в разметке и следовательно не изменится при следующем считывании
// У нас есть <p data-id="432">Some text</p>
//что бы вернуть значение атрибута data-* есть 2 способа
$(this).attr("data-id") // will return the string "123"
$(this).data("id") // will return the number 123



//---------Отправка формы с ФАЙЛОМ(ми) через AJAX -----------
/* Пример формы для работы нижепреведенного кода
<form id="add-item">
	<input type="text" name="surname">
	<input type="file" name="headshot">
	<input type="submit">
</form>
*/
var ourForm = $('#add-item');
    ourForm.on("submit", function() {
    	//поиск fd для создания объекта FormData ОБЯЗАТЕЛЬНО делаем через чистый JS т.к. JQuery создает свой объект
    	//и JS с ним работать не будет и создаст пустой FormData
        var fd = new FormData(document.getElementById('add-item'));//передаем внутрь нашу форму
        $.ajax({
            url: 'add.php',
            type: "POST",
            data: fd,
            processData: false,//запрещаем JQuery обрабатывать передаваемые данные(они уже обработаны FormData)
            contentType: false,//запрещаем JQuery формировать http заголовки типа передаваемых данных
            success: function(data, textStatus, jqXHR) {
                alert('SUCCESS');
                }, 1000);
                ourForm.trigger('reset');   //вызывает указанное событие(в данном случае сброс формы)
            }
        });
        return false;
    });