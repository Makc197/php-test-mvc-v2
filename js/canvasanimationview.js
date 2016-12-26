"use strict";

var COLOR_RED = "#F00";
var COLOR_GREEN = "#0F0";
var COLOR_BLUE = "#00F";
var COLOR_ORANGE = "#FF7F00";

jQuery(function ($) {

    var startButton = document.getElementById('startbutton');
    var stopButton = document.getElementById('stopbutton');
    var timerId;

    function drawLinesBySteps(canvas, allCoords) {

        if (!canvas.getContext && allCoords.length == 0)
            return false;

            var i = 0;
            var l = allCoords.length;
            var k = 2;

            var ctx = canvas.getContext('2d');
            ctx.beginPath();
            var firstPoint = allCoords[0];

            function go() {
                //console.log(i, coord);
                var c = allCoords.slice(0, i);
                //console.log(c);
                ctx.moveTo(k * firstPoint.x, k * firstPoint.y);
                $(c).each(function () {
                    ctx.lineTo(k * this.x, k * this.y);
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
    
    var allCoords = ALL_POINTS;

    startButton.onclick = function (event) {
        startButton.disabled = true;
        stopButton.disabled = false;

        var canvas = document.getElementById('bcanvas');
        drawLinesBySteps(canvas, allCoords);
    };

    stopButton.onclick = function () {
        startButton.disabled = false;
        stopButton.disabled = true;
        console.log('Stop');
        clearTimeout(timerId);
    };

}
);


