<h3>Задача №3. Анимация Canvas</h3>

<form class="form-inline" id="example3" method="post" action="/example3/animation">
    <button type="submit" name="submit" class="btn btn-default">Start animation</button>
    <a href='/example3/stopanimation' class="btn btn-default">Stop animation</a>
</form>

<br>
<canvas id="lines" width="400" height="400"></canvas>
<canvas id="lines2" width="400" height="400"></canvas>
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
</div>

<div class="row">
    <div class="col-md3">

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

<!--Асинхронным запросом получаем массив точек из json, который сформировали в ControllerExample3 в function action_calculate()-->
<script defer> var ALL_POINTS = <?=json_encode($data)?> 
</script> 

<!--По запросу запускаем скрипт js/Example3.js - анимация в Canvas-->
<script src="/js/example3.js" defer></script>
