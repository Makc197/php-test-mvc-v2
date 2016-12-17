<div class="btn-group">
    <a id="create_cd_button" class="btn btn-create-new btn-primary btn-md" role="button" href="/cd/create">Добавить CD в базу</a>
</div>

<div class="table-block-400">

    <?php
    //2й Вариант реализации GRID view
    //Массив полей которые надо вывести
    $fields = [
        'title',
        'description',
        'price',
        'author',
        'playlenght'
    ];
    //$data - массив объектов CD
    //$config - конфигурация для GRID
    $config = [
        //'actions' - Массив анонимных функций, в которых генерим ссылки
        //т.е. определяем какие действия отображать
        //'actionsLabel' - Название столбца с действиями, если не указывать, то по умолч 'Actions' 
        'actions' => ['view', 'update', 'delete'],
        'actionsLabel' => 'Управление'
    ];

    echo classes\Grid::widget($fields, $data, $config);
    ?>

</div>

<?php echo $paginator->html(); ?>