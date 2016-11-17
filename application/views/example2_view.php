<h1>Задача №2. Рисуем и сохраняем в BMP</h1>

<form class="form-inline" id="example2" method="post" action="/example2/drawchar">
<div class="form-inline">
    <div class="form-group">
        <label for="x">X: evt.clientX - rect.left:</label>
        <input required class="form-control" type="text" name="x"
               value="">
    </div>
    <div class="form-group">
        <label for="y">Y: evt.clientY - rect.top:</label>
        <input required class="form-control" type="text" name="y"
               value="">
    </div>
</div>
<br>
<div class="form-inline">
    <div class="form-group">
        <label for="evtx">evt.clientX</label>
        <input required class="form-control" type="text" name="evtx"
               value="">
    </div>
    <div class="form-group">
        <label for="evty">evt.clientY</label>
        <input required class="form-control" type="text" name="evty"
               value="">
    </div>
</div>
<br>
<div class="form-inline">
    <div class="form-group">
        <label for="rectl">rect.left</label>
        <input required class="form-control" type="text" name="rectl"
               value="">
    </div>  
    <div class="form-group">
        <label for="rectr">rect.right</label>
        <input required class="form-control" type="text" name="rectr"
               value="">
    </div>
    <div class="form-group">
        <label for="rectb">rect.bottom</label>
        <input required class="form-control" type="text" name="rectb"
               value="">
    </div>
    <div class="form-group">
        <label for="rectt">rect.top</label>
        <input required class="form-control" type="text" name="rectt"
               value="">
    </div>
</div>
<br>
<div>
    <button type="submit" name="submit" class="btn btn-default">Submit</button>
    <a href='/example2/reset' class="btn btn-default">Reset</a>
</div>
</form>
<br>
<canvas id="lines" width="150" height="150"></canvas>
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

<script>
"use strict";

var COLOR_RED = "#F00";
var COLOR_GREEN = "#0F0";
var COLOR_BLUE = "#00F";
var COLOR_ORANGE = "#FF7F00";
var SCALE = 1;
    
    jQuery(function ($) {
        function getMousePos(canvas, evt) {
            var rect = canvas.getBoundingClientRect();
            var _x = evt.clientX - rect.left,
                    _y = evt.clientX - rect.left;
            // //if(_x <0 || _x > rect.width || _y<0 || _y > rect.height) return false;
            return {
                x: evt.clientX - rect.left,
                y: evt.clientY - rect.top,
                evtx: evt.clientX,
                evty: evt.clientY,
                rectl: rect.left,
                rectr: rect.right,
                rectt: rect.top,
                rectb: rect.bottom
            };
        }

        function drawLines(canvas, allCoords) {
            if (!canvas.getContext && allCoords.length == 0)
                return false;
            //console.log(allCoords);
            var ctx = canvas.getContext('2d');
            // begin paint
            ctx.beginPath();
            // from first point
            var firstPoint = allCoords[0];
            ctx.moveTo(firstPoint.x, firstPoint.y);
            $(allCoords).each(function () {
                ctx.lineTo(this.x, this.y);
            });
            ctx.lineWidth = 3;
            ctx.strokeStyle = COLOR_BLUE;
            ctx.stroke();
        }

        function sendCoorinate(cord, callback) {
            console.log(cord);
            var url = $("#example2").attr('action');
            $.post(url, {'x': cord.x, 'y': cord.y}, function () {
                callback();
            });
        }

        var canvas = document.getElementById('lines');
        var allCoords = [];
        $(".point").each(function () {
            var $this = $(this),
                    cords = {
                        x: +$this.attr('data-x') * SCALE,
                        y: +$this.attr('data-y') * SCALE
                    };
            allCoords.push(cords);
        });

        if (canvas.getContext && allCoords.length > 0) {
            drawLines(canvas, allCoords);
        }

        canvas.onclick = function (e) {
            var coordsInCanvas = getMousePos(canvas, e);
            if (!coordsInCanvas)
                return;
               
            console.log($('#example2').find('[name=x]'));
            $('#example2').find('[name=x]').val(coordsInCanvas.x); //x: evt.clientX - rect.left
            $('#example2').find('[name=y]').val(coordsInCanvas.y); //evt.clientY - rect.top

            $('#example2').find('[name=evtx]').val(coordsInCanvas.evtx); //evt.clientX
            $('#example2').find('[name=evty]').val(coordsInCanvas.evty); //evt.clientY

            $('#example2').find('[name=rectl]').val(coordsInCanvas.rectl); //rect.left
            $('#example2').find('[name=rectr]').val(coordsInCanvas.rectr); //rect.right
            $('#example2').find('[name=rectt]').val(coordsInCanvas.rectt); //rect.top
            $('#example2').find('[name=rectb]').val(coordsInCanvas.rectb); //rect.bottom

            allCoords.push(coordsInCanvas);
            sendCoorinate(coordsInCanvas, function () {
                drawLines(canvas, allCoords);
            });
        };

    });

</script>


