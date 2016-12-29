"use strict";

var COLOR_RED = "#F00";
var COLOR_GREEN = "#0F0";
var COLOR_BLUE = "#00F";
var COLOR_ORANGE = "#FF7F00";

jQuery(function ($) {

        var startButton = document.getElementById('startbutton');
        var stopButton = document.getElementById('stopbutton');
        var timerId;

        function getMousePos(canvas, evt) {
            var rect = canvas.getBoundingClientRect();
            var _x = evt.clientX - rect.left,
                _y = evt.clientX - rect.left;
            return {
                x: evt.clientX - rect.left,
                y: evt.clientY - rect.top
            };
        }

        function drawLines(canvas, allCoords) {
            if (!canvas.getContext && allCoords.length == 0)
                return false;
            var ctx = canvas.getContext('2d');
            ctx.beginPath();
            var firstPoint = allCoords[0];
            ctx.moveTo(firstPoint.x, firstPoint.y);
            $(allCoords).each(function () {
                ctx.lineTo(this.x, this.y);
            });
            ctx.lineWidth = 2;
            ctx.strokeStyle = COLOR_GREEN;
            ctx.stroke();
        }

        function drawLinesBySteps(canvas, allCoords) {

            if (!canvas.getContext && allCoords.length == 0)
                return false;

            var i = 0;
            var l = allCoords.length;

            var ctx = canvas.getContext('2d');
            ctx.beginPath();
            var firstPoint = allCoords[0];

            function go() {
                //console.log(i, coord);
                var c = allCoords.slice(0, i);
                //console.log(c);
                ctx.moveTo(firstPoint.x, firstPoint.y);
                $(c).each(function () {
                    ctx.lineTo(this.x, this.y);
                });
                ctx.lineWidth = 4;
                ctx.strokeStyle = COLOR_BLUE;
                ctx.stroke();

                if (i < l)
                    timerId = setTimeout(go, 1000);
                i++;
            };
            go();
        }


        function sendCoorinate(coord, callback) {
            //console.log(coord);
            //Асинхронный запрос - передаем координаты точки методом POST в ControllerExample1 action_calculate
            //url="/example3/animation"
            //<form .... id="example3" method="post" action="/example3/animation">
            var url = $("#example3").attr('action');

            $.post(url, {'Math_x': coord.x, 'Math_y': coord.y}, function () {
                callback();
            });
        }

        var canvas = document.getElementById('lines');

        var allCoords = [];

        var allCoords = ALL_POINTS;

        if (canvas.getContext && allCoords.length > 0) {
            drawLines(canvas, allCoords);
        }

        canvas.onclick = function (e) {
            var coordsInCanvas = getMousePos(canvas, e);
            if (!coordsInCanvas)
                return;

            allCoords.push(coordsInCanvas);
            sendCoorinate(coordsInCanvas, function () {
                drawLines(canvas, allCoords);
            });
        };

        startButton.onclick = function (event) {
            startButton.disabled = true;
            stopButton.disabled = false;
            //event.preventDefault();
            //console.log(event);
            console.log('Start');

            var canvas2 = document.getElementById('lines2');

            //Просмотр анимации - рисование линий
            drawLinesBySteps(canvas2, allCoords);

        };

        stopButton.onclick = function () {
            startButton.disabled = false;
            stopButton.disabled = true;
            console.log('Stop');
            clearTimeout(timerId);
        }

    }
);


