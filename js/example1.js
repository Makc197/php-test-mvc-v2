 "use strict";
 
var COLOR_RED = "#F00";
var COLOR_GREEN = "#0F0";
var COLOR_BLUE = "#00F";
var COLOR_ORANGE = "#FF7F00";
var SCALE = 1;

 jQuery(function($){
        function getMousePos(canvas, evt) {
            var rect = canvas.getBoundingClientRect();
            var _x = evt.clientX - rect.left,
                _y = evt.clientX - rect.left;
            //if(_x <0 || _x > rect.width || _y<0 || _y > rect.height) return false;
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
            ctx.strokeStyle = COLOR_GREEN;
            ctx.stroke();        
        }
        
        function sendCoorinate(cord, callback){
            console.log(cord);
            //Асинхронный запрос - передаем координаты точки методом POST в ControllerExample1 action_calculate
            //url="/example1/calculate"
            //<form .... id="example1" method="post" action="/example1/calculate">               
            var url = $("#example1").attr('action');
            $.post(url,{'Math_x':cord.x, 'Math_y':cord.y},function(){
                callback();
            });
        }
        
        var canvas = document.getElementById('lines');
        var allCoords = [];

        /*$(".point").each(function(){            
            var $this = $(this),
            cords = {
                x : +$this.attr('data-x') * SCALE,
                y : +$this.attr('data-y') * SCALE
            };
            allCoords.push(cords);
        });*/
        
        allCoords = ALL_POINTS;
        
        if (canvas.getContext && allCoords.length > 0) {
            drawLines(canvas, allCoords);
        }
        
        canvas.onclick = function(e){
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
    

