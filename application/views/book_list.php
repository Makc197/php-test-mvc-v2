<div class="btn-group">
    <a id="create_book_button" class="btn btn-create-new btn-primary btn-md" role="button" href="?r=book/create">Добавить книгу в базу</a>
</div>

<div class="table-block-400">
<table class="table">
    <thead>
        <tr><th>Id</th>
            <th>Type</th>
            <th>Title</th>
            <th>Description</th>
            <th>Price</th>
            <th>Author</th>
            <th>NumberOfPages</th> 
            <th>Actions</th>
        </tr>
    </thead>
    <?php foreach ($data as $shopProduct) : ?>
        <?php $id = $shopProduct->getId(); ?>
        <tr class="book" data-id="<?php echo $id; ?>">
            <td><?php echo $id; ?></td>
            <td><?php echo $shopProduct->getType(); ?></td>
            <td><a href='?r=book/view&id=<?php echo $id; ?>'>
                    <?php echo $shopProduct->getTitle() ?></a>
            </td>
            <td><?php echo $shopProduct->getDescription(); ?></td>
            <td><?php echo $shopProduct->getPrice(); ?></td>
            <td><?php echo $shopProduct->getAuthor(); ?></td>
            <td><?php echo $shopProduct->getNumberOfPages(); ?></td>
            <td>
                <a href="?r=book/view&id=<?php echo $id; ?>">
                    <span class="glyphicon glyphicon-search"></span>
                </a>
                <a href="?r=book/update&id=<?php echo $id; ?>">
                    <span class="glyphicon glyphicon-pencil"></span>
                </a>
                <a class="delete-book-link" href="?r=book/delete&id=<?php echo $id; ?>">
                    <span class="glyphicon glyphicon-trash"></span>
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
</div>
<?php echo $paginator->html();?>

<script>
    $(function(){
        $(".delete-book-link").click(function(event){

            if(!confirm("Вы уверены, что хотите удалить?"))
                return false;
            event.preventDefault();
            var url = $(this).attr('href');
            //var book_id = $(this).parents('tr').attr('data-id');
            //console.log(book_id);

            var that_tr = $(this).parents('tr');

            $.ajax({
                type: "POST",
                url: url,
                success: function(data){
                    console.log(data);
                    //$(".book[data-id]") - выбрать все
                    //$(".book[data-id=22]") - выбрать по классу book где атрибут data-id=22
                    //$(".book[data-id=" + book_id + "]").remove();
                    that_tr.remove();
                },
                error: function( jqXHR, textStatus, errorThrown ) {
                    //console.log(jqXHR, textStatus, errorThrown);
                    alert('Ошибка сервера');
                }
            });

        });
    });
</script>


