<h3>Задача №3. Анимация Canvas. Рисование линий и просмотр</h3>

<form class="form-inline" id="canvasanimation" method="post" action="/canvasanimation/animation1">
    <a href='/canvasanimation/clear' class="btn btn-default">Clear</a>
    <button name="start" id="startbutton" class="btn btn-default">Start animation</button>
    <button name="stop" id="stopbutton" class="btn btn-default" disabled>Stop animation</button>

    <a href='/canvasanimation/animation2' class="btn btn-default">Next Animation --> </a>
</form>

<br>
<canvas id="lines" width="250" height="250"></canvas>
<canvas id="lines2" width="250" height="250"></canvas>
<br>

<style type="text/css">
    canvas {
        border: 1px solid black;
    }
</style>

<!--Асинхронным запросом получаем массив точек из json, который сформировали в ControllerCanvasAnimation в function action_calculate()-->
<script defer> var ALL_POINTS = <?=json_encode($data)?> 
</script> 

<!--По запросу запускаем скрипт js/canvasanimation1.js - анимация в Canvas-->
<script src="/js/canvasanimation1.js?<?=time();?>" defer></script>
<!--time() - Для того чтобы не кешировался js - простой способ -->
