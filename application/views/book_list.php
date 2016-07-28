<div class="btn-group">
    <a id="create_book_button" class="btn btn-create-new btn-primary btn-md" role="button" href="?r=book/create">Добавить книгу в базу</a>
</div>

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
        <tr>
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
                <a href="?r=book/delete&id=<?php echo $id; ?>">
                    <span class="glyphicon glyphicon-trash"></span>
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>



