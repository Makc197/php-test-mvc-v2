<h3> 
    MainView
</h3>

<?php
$id = 7;
$val1 = 'значение1';
$val2 = 'значение2';
$val3 = 'значение3';
?>

<br>
<br>

<div class="row" >
    <div class="col-md-2">
        UrlManager test:
        <a href="<?php echo \classes\UrlManager::createUrl('/cd/view', ['id' => $id]); ?>">
            <span class="glyphicon glyphicon-search"></span>
        </a>

        <a href="<?php echo \classes\UrlManager::createUrl('/cd/view', ['key1' => $val1, 'key2' => $val2, 'key3' => $val3]); ?>">
            <span class="glyphicon glyphicon-pencil"></span>
        </a>

        <a href="<?php echo \classes\UrlManager::createUrl('/cd/view', ['key1' => $val1, 'key2' => $val2]); ?>">
            <span class="glyphicon glyphicon-trash"></span>
        </a>
    </div>
</div>

<br>
<br>

<div class="row" >
    <div class="col-md-6">
        <a href="/authentication/login">
            <button type="button" class="btn btn-default btn-lg"><span class="glyphicon glyphicon-user" style="font-size: 20px;"></span> Авторизация</button>                                  
        </a>
    </div>
</div>

<br>
<br>

<div class="row">
    <?php if (isset($errors)): ?>
        <ul>
            <?php foreach ($errors as $err): ?>
                <li><?= $err; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>



