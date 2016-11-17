<h1>Задача №1. Расчет длины цепи по координатам точек </h1>

<form class="form-inline" id="example1" method="post" action="/example1/calculate">
    <div class="form-group">
        <label for="x">X:</label>
        <input required class="form-control" type="text" name="Math_x"
               value="">
    </div>
    <div class="form-group">
        <label for="y">Y:</label>
        <input required class="form-control" type="text" name="Math_y"
               value="">
    </div>
    <button type="submit" name="submit" class="btn btn-default">Submit</button>
    <a href='/example1/reset' class="btn btn-default">Reset</a>
</form>
<br>
<canvas id="lines" width="400" height="400"></canvas>
<br>
<?= !empty($data) ? 'Точки:' : '' ?>
<div class="row">
    <div class="col-md-3">
        <?php if (!empty($data)): ?>
            <ul>
                <?php foreach ($data as $i => $point): ?>
                    <li class="point" data-id="<?php echo $i; ?>" data-x="<?php echo $point->x; ?>"
                        data-y="<?php echo $point->y; ?>"><?= sprintf('Point %s : %s', $i, $point); ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
    <div class="col-md-6">
        <?php
        if (!empty($str)):
            echo $str;
        endif;
        ?>
    </div>
</div>

<div class="row">
    <div class="col-md-8">

        <?php if (!empty($errors)): ?>
            <?php echo 'Ошибки:'; ?>
            <ul>
                <?php foreach ($errors as $err): ?>
                    <li><?= $err; ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
</div>

<style type="text/css">
    canvas {
        border: 1px solid black;
    }
</style>

<!--Асинхронным запросом получаем массив точек из json, который сформировали в ControllerExample1 в function action_calculate()-->
<script defer> var ALL_POINTS = <?=json_encode($data)?> </script> 
<!--На основании массива точек рисуем линию в function drawLines() в js/Example1.js -->
<script src="../../js/Example1.js" defer></script>
