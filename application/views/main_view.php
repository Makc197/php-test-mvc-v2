<h1> 
    MainView
</h1>
    
    <?php // var_dump($errors); ?>

<div>    
    <div class="col-md-6">
        <?php if (isset($errors)): ?>
            <ul>
                <?php foreach ($errors as $err): ?>
                    <li><?= $err; ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
</div>

