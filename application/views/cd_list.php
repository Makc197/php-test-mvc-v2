<div class="btn-group">
    <a id="create_cd_button" class="btn btn-create-new btn-primary btn-md" role="button" href="/cd/create">Добавить CD в базу</a>
</div>

<div class="table-block-400">

    <?php
    //2й Вариант реализации GRID view
    //Массив полей которые надо вывести
    $fields = [
        'id',
        'type',
        'title',
        'description',
        'price',
        'author',
        'playlenght'
    ];
    //$data - массив объектов CD
    //$config - конфигурация для GRID
    $config = [
        //Массив анонимных функций, в которых генерим ссылки
        'actions' => [
            'view' => function ($model) {
                return '<a href="' . \classes\UrlManager::createUrl('/cd/view', ['id' => $model->getId()]) . '"><span class="glyphicon glyphicon-search"></span></a>';
            },
            'update' => function ($model) {
                return '<a href="' . \classes\UrlManager::createUrl('/cd/update', ['id' => $model->getId()]) . '"><span class="glyphicon glyphicon-pencil"></span></a>';
            },
            'delete' => function ($model) {
                return '<a href="' . \classes\UrlManager::createUrl('/cd/delete', ['id' => $model->getId()]) . '"><span class="glyphicon glyphicon-trash"></span></a>';
            },
        ],
        'actionsLabel' => 'Управление'
    ];

    //var_dump($fields);
    //var_dump($data);
    //var_dump($config);
    //die();

    echo classes\Grid::widget($fields, $data, $config);
    ?>

</div>

<?php echo $paginator->html(); ?>