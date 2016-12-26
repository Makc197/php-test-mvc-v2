<h3>Задача №3. Анимация Canvas. Режим просмотра</h3>

<form class="form-inline" id="canvasanimationview">
    <button name="start" id="startbutton" class="btn btn-default">Start animation</button>
    <button name="stop" id="stopbutton" class="btn btn-default" disabled>Stop animation</button>
    <a href='/canvasanimation/clearanimationview' class="btn btn-default">Clear</a>
    <a href='/canvasanimation/animationdraw' class="btn btn-default">ToDrawAnimation</a>
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
<script defer> var ALL_POINTS = <?=json_encode($data)?> 
</script>

<!--По запросу запускаем скрипт js/canvasanimationview.js - анимация в Canvas-->
<script src="/js/canvasanimationview.js" defer></script>
