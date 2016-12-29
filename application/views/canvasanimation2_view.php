<h3>Задача №3. Анимация Canvas. Объекты</h3>

<form class="form-inline" id="canvasanimation2">
    <a href='/canvasanimation/animation1' class="btn btn-default"> <-- Prev Animation</a>

    <button name="start" id="startbutton" class="btn btn-default">Start animation</button>
    <button name="stop" id="stopbutton" class="btn btn-default" disabled>Stop animation</button>
    <a href='/canvasanimation/clearanimation2' class="btn btn-default">Clear</a>
    </br></br>
    <button name="drawcircle" id="drawcircle" class="btn btn-default">Circle</button>
    <button name="drawrectangle" id="drawrectangle" class="btn btn-default">Rectangle</button>
    <button name="drawline" id="drawline" class="btn btn-default">Line</button>
</form>

<br>
<canvas id="bcanvas" width="500" height="500"></canvas>
<br>

<style type="text/css">
    canvas {
        border: 1px solid black;
    }
</style>

<!--Асинхронным запросом получаем массив точек из json, который сформировали в ControllerCanvasAnimation в function action_calculate()-->
<script defer> var ALL_POINTS = <?= json_encode($data) ?>
</script>

<!--По запросу запускаем скрипт js/canvasanimationview.js - анимация в Canvas-->
<script src="/js/canvasanimation2.js?<?= time(); ?>" defer></script>
