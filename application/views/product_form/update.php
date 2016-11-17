<h1>
    <?php if ($product->getID()) : ?>
        <?php echo 'Update ' . $product->getType() . " " . $product->getTitle() . " (ID: " . $product->getID() . ")"; ?>
    <?php else : ?>
        <?php echo 'Create ' . $product->getType(); ?>
    <?php endif ?>
</h1>

<div>    
    <div class="col-md-6">

        <?php if (!empty($errors)): ?>
            <ul>
                <?php foreach ($errors as $err): ?>
                    <li><?php $err; ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <form id="form_1" method="post" action="/product/update?id=<?= $product->getID(); ?>">


            <input type="hidden" name="id" value="<?= $product->getID(); ?>">
            <input type="hidden" name="act" value="update">

            <div class="form-group">
                <label for="title">Title:</label>
                <input required class="form-control" type="text" name="title" value="<?= $product->getTitle(); ?>">
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <input required class="form-control" type="text" name="description" value="<?= $product->getDescription(); ?>">
            </div>

            <div class="form-group">
                <label for="price">Price:</label>
                <input required class="form-control" type="text" name="price"value="<?= $product->getPrice(); ?>">
            </div>

            <button name="submit" type="submit" class="btn btn-primary">Save</button>
            <button 
                name="clear"
                class="btn btn-default"
                type="reset"
                onclick="var form = $('#form_1');

                        $('#form_1').find('input[type=text]').each(function (k, el) {
                            var empty = !isNaN(+$(el).val()) ? 0 : null;
                            $(el).attr('value', empty);
                        });
                " 
                class="btn btn-default">Clear</button>
    </div>
</div>
