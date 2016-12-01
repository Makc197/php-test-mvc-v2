<h3> 
    Система шаблонов
</h3>

<br>

<div class="row" >
    <div class="col-md-6">
        <?php $viewpath='click/htmlform'; $formname='Click'; ?>
        <a href="<?php echo \classes\UrlManager::createUrl('/pdfgenerator/viewform', ['formpath' => $viewpath, 'formname'=>$formname ]); ?>">
            <button type="button" class="btn btn-default btn-lg menubtn">Заявление на Click депозит</button>                                  
        </a>
    </div>
</div>

<br>

<div class="row" >
    <div class="col-md-6">
        <?php $viewpath='something_form/htmlform'; $formname='Something'; ?>
        <a href="<?php echo \classes\UrlManager::createUrl('/pdfgenerator/viewform', ['formpath' => $viewpath, 'formname'=>$formname ]); ?>">
            <button type="button" class="btn btn-default btn-lg menubtn">Заявление на что - то </button>                                  
        </a>
    </div>
</div>
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