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
        'playLenght'
    ];
    //$data - массив объектов CD
    //$config - конфигурация для GRID
    $config = [
        //Массив анонимных функций, в которых генерим ссылки
        'actions' => ['view', 'update', 'delete'],
        'actionsLabel' => 'Управление'
    ];

    //var_dump($data);
    //die();

    echo classes\Grid::widget($fields, $data, $config);
    ?>

</div>

<?php echo $paginator->html(); ?>