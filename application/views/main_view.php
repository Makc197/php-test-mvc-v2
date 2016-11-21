<h1> 
    MainView
</h1>

<?php 
$id = 7;
$val1='значение1';
$val2='значение2';
$val3='значение3';        
?>

<a href="<?php echo \classes\UrlManager::createUrl('/cd/view', ['id' => $id]); ?>">
    <span class="glyphicon glyphicon-search"></span>
</a>

<a href="<?php echo \classes\UrlManager::createUrl('/cd/view', ['key1' => $val1, 'key2' => $val2, 'key3' => $val3]); ?>">
    <span class="glyphicon glyphicon-pencil"></span>
</a>

<a href="<?php echo \classes\UrlManager::createUrl('/cd/view', ['key1' => $val1, 'key2' => $val2]); ?>">
    <span class="glyphicon glyphicon-trash"></span>
</a>

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

