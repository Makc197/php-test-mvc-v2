<div class="btn-group">
    <a id="create_book_button" class="btn btn-create-new btn-primary btn-md" role="button" href="/book/create">Добавить книгу в базу</a>
</div>

<div class="table-block-400">
    <table class="table">

        <?php
        //1й Вариант реализации GRID view
        //Рисуем шапку таблицы используя HtmlHelper::createTableHeader
        $tableheader = array('Id', 'Type', 'Title', 'Description', 'Price', 'Author', 'NumberOfPages', 'Actions');
        echo \classes\HtmlHelper::createTableHeader($tableheader);
        
        //Рисуем строки таблицы для каждого объекта - строка
        $controller = 'book';
        foreach ($data as $shopProduct) {
            //Формируем массив столбцов для таблицы
            $row = [
                'Id' => $shopProduct->getId(),
                'Type' => $shopProduct->getType(),
                'Title' => $shopProduct->getTitle(),
                'Description' => $shopProduct->getDescription(),
                'Price' => $shopProduct->getPrice(),
                'Author' => $shopProduct->getAuthor(),
                'NumberOfPages' => $shopProduct->getNumberOfPages()
            ];
            
            //Рисуем строку таблицы c Actions используя HtmlHelper::createTableRowWithActions
            echo \classes\HtmlHelper::createTableRowWithActions($row, $controller);
            //Обнуляем массив
            unset($row);
        }
        ?>
        
    </table>
</div>
<?php echo $paginator->html(); ?>

<script>
    //Тест асинхронное удаление записи
    $(function () {
        $(".delete-book-link").click(function (event) {

            if (!confirm("Вы уверены, что хотите удалить?"))
                return false;
            event.preventDefault();
            var url = $(this).attr('href');
            //var book_id = $(this).parents('tr').attr('data-id');
            //console.log(book_id);

            var that_tr = $(this).parents('tr');

            $.ajax({
                type: "POST",
                url: url,
                success: function (data) {
                    console.log(data);
                    //$(".book[data-id]") - выбрать все
                    //$(".book[data-id=22]") - выбрать по классу book где атрибут data-id=22
                    //$(".book[data-id=" + book_id + "]").remove();
                    that_tr.remove();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    //console.log(jqXHR, textStatus, errorThrown);
                    alert('Ошибка сервера');
                }
            });

        });
    });
</script>


