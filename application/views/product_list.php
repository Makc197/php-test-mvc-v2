<div class="btn-group">
    <a id="create_product_button" class="btn btn-create-new btn-primary btn-md" role="button" href="?r=product/create">Добавить товар в базу</a>
</div>

<table class="table">
    <thead>
        <tr><th>Id</th>
            <th>Type</th>
            <th>Title</th>
            <th>Description</th>
            <th>Price</th>
            <th>Actions</th>
        </tr>
    </thead>
    <?php foreach ($data as $shopProduct) : ?>
        <?php $id = $shopProduct->getId(); ?>
        <tr>
            <td><?php echo $shopProduct->getId(); ?></td>
            <td><?php echo $shopProduct->getType(); ?></td>
            <td><a href='?r=product/view&id=<?php echo $id; ?>'>
                    <?php echo $shopProduct->getTitle() ?></a>
            </td>
            <td><?php echo $shopProduct->getDescription(); ?></td>
            <td><?php echo $shopProduct->getPrice(); ?></td>

            <td>
                <a href="?r=product/view&id=<?php echo $id; ?>">
                    <span class="glyphicon glyphicon-search"></span>
                </a>
                <a href="?r=product/update&id=<?php echo $id; ?>">
                    <span class="glyphicon glyphicon-pencil"></span>
                </a>
                <a href="?r=product/delete&id=<?php echo $id; ?>">
                    <span class="glyphicon glyphicon-trash"></span>
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<?php echo $paginator->html();?>