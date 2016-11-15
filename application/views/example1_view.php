<h1>Задача №1</h1>

<form class="form-inline" id="example1" method="post" action="/?r=examples/testtask1">
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
    <a href='/?r=examples/reset' class="btn btn-default">Reset</a>
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

<script>   
    jQuery(function($){
        function getMousePos(canvas, evt) {
            var rect = canvas.getBoundingClientRect();
            var _x = evt.clientX - rect.left,
                _y = evt.clientX - rect.left;
            if(_x > rect.width || _y > rect.height) return false;
            return {
              x: evt.clientX - rect.left,
              y: evt.clientY - rect.top
            };
        }
        
        function drawLines(canvas, allCoords){
            if (!canvas.getContext && allCoords.length==0) return false;
            //console.log(allCoords);
            var ctx = canvas.getContext('2d');
            // begin paint
            ctx.beginPath();
            // from first point
            var firstPoint = allCoords[0];
            ctx.moveTo(firstPoint.x, firstPoint.y);
            $(allCoords).each(function(){               
                ctx.lineTo(this.x, this.y);
            });
            //ctx.fill();
            ctx.lineWidth = 3;
            ctx.strokeStyle = '#ff0000';
            ctx.stroke();        
        }
        
        function sendCoorinate(cord, callback){
            console.log(cord);
            var url = $("#example1").attr('action');
            $.post(url,{'Math_x':cord.x, 'Math_y':cord.y},function(){
                callback();
            });
        }
        
        var canvas = document.getElementById('lines');
        var allCoords = [];
        var scale = 1;
        $(".point").each(function () {            
            var $this = $(this),
            cords = {
                x : +$this.attr('data-x') * scale,
                y : +$this.attr('data-y') * scale
            };
            allCoords.push(cords);
        });
        
        if (canvas.getContext && allCoords.length > 0) {
            drawLines(canvas, allCoords);
        }
        
        document.onclick = function(e){
            var coordsInCanvas = getMousePos(canvas, e);
            if(!coordsInCanvas) return;
            
            $('#example1').find('[name=Math_x]').val(coordsInCanvas.x);
            $('#example1').find('[name=Math_y]').val(coordsInCanvas.y);
            allCoords.push(coordsInCanvas);
            sendCoorinate(coordsInCanvas, function(){
                drawLines(canvas, allCoords);
            });
        };
        
    });

           
          

      /*  if (canvas.getContext) {
            var ctx = canvas.getContext('2d');

            ctx.beginPath();
            ctx.moveTo(75, 50);
            ctx.lineTo(100, 75);
            ctx.lineTo(100, 25);

            ctx.fill();
        }*/
    
</script>


