<div class="btn-group">
    <a id="create_cd_button" class="btn btn-create-new btn-primary btn-md" role="button" href="/cd/create">Добавить CD в базу</a>
</div>
<div class="table-block-400">
    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Type</th>
                <th>Title</th>
                <th>Description</th>
                <th>Price</th>
                <th>Author</th>
                <th>PlayLenght</th>
                <th>Actions</th>
            </tr>
        </thead>
        <?php foreach ($data as $shopProduct) : ?>
            <?php $id = $shopProduct->getId(); ?>
            <tr>
                <td><?php echo $id; ?></td>
                <td><?php echo $shopProduct->getType(); ?></td>
                <td>
                    <a href="/cd/view?id=<?php echo $id; ?>">
                        <?php echo $shopProduct->getTitle(); ?>
                    </a>
                </td>
                <td><?php echo $shopProduct->getDescription(); ?></td>
                <td><?php echo $shopProduct->getPrice(); ?></td>
                <td><?php echo $shopProduct->getAuthor(); ?></td>
                <td><?php echo $shopProduct->getPlayLenght(); ?></td>
                <td>                
                    <a href="<?php echo \classes\UrlManager::createUrl('/cd/view', ['id' => $id]); ?>">
                        <span class="glyphicon glyphicon-search"></span>
                    </a>
                    <a href="<?php echo \classes\UrlManager::createUrl('/cd/update', ['id' => $id]); ?>">
                        <span class="glyphicon glyphicon-pencil"></span>
                    </a>
                    <a href="<?php echo \classes\UrlManager::createUrl('/cd/delete', ['id' => $id]); ?>">
                        <span class="glyphicon glyphicon-trash"></span>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
<?php echo $paginator->html(); ?>