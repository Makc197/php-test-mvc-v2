"use strict";

var COLOR_RED = "#F00";
var COLOR_GREEN = "#0F0";
var COLOR_BLUE = "#00F";
var COLOR_ORANGE = "#FF7F00";

jQuery(function ($) {

    var startButton = document.getElementById('startbutton');
    var stopButton = document.getElementById('stopbutton');
    var circleButton = document.getElementById('drawcircle');
    var rectButton = document.getElementById('drawrectangle');
    var lineButton = document.getElementById('drawline');

    var timerId;
    //Создание графических объектов
    //Определяем массив для хранения объектов
    var objects = [];
    //Тип объекта который собираемся создать
    var objtype;
    //var allCoords = ALL_POINTS;

    var canvas = document.getElementById('bcanvas');
    var ctx = canvas.getContext('2d');
    //Анимация - отрисовка массива объектов

    function drawObjectsBySteps(objects) {

        timerId = setTimeout(function go() {

            var obj = objects[0];
            objects = objects.slice(1);
            //console.log(obj.draw);
            obj.draw();
            if (objects.length)
                timerId = setTimeout(go, 1000);
        }, 0);
    }

    //Определяем объект - Фигура
    //Пока единственное известное свойство - _canvas
    function Shape(canvas) {
        this._canvas = canvas; //инициализация свойства _canvas
    }

    //Класс Circle - для определения параметров окружности
    function Circle(canvas, params) {
        params = params || {}; //Парсим массив params

        Shape.call(this, canvas); //this._canvas = canvas; //инициализация свойства _canvas

        this.coord_x = params.x || 0;
        this.coord_y = params.y || 0;
        this.radius = params.radius || 0;
        this.color = params.color || 0;
    }

    //Метод draw() класса Circle
    Circle.prototype.draw = function () {
        var ctx = this._canvas;
        ctx.fillStyle = this.color;
        ctx.beginPath();
        ctx.arc(this.coord_x, this.coord_y, this.radius, 0, 2 * Math.PI);
        ctx.fill();
    }

    //Класс Rectangle - для опрделения параметров прямоугольника
    function Rectangle(canvas, params) {

        params = params || {}; //Парсим массив params

        Shape.call(this, canvas); //this._canvas = canvas; //инициализация свойства _canvas

        this.coord_x = params.x || 0;
        this.coord_y = params.y || 0;
        this.width = params.width || 0;
        this.height = params.height || 0;
        this.color = params.color || 0;
    }

    //Метод draw() класса Rectangle
    Rectangle.prototype.draw = function () {
        var ctx = this._canvas;
        ctx.fillStyle = this.color;
        ctx.beginPath();
        ctx.rect(this.coord_x, this.coord_y, this.width, this.height);
        ctx.fill();
    };
    //Класс Line для определения параметров линий
    function Line(canvas, params) {
        params = params || {}; //Парсим массив params

        Shape.call(this, canvas); //this._canvas = canvas; //инициализация свойства _canvas

        this.coord_x1 = params.x1 || 0;
        this.coord_y1 = params.y1 || 0;
        this.coord_x2 = params.x2 || 0;
        this.coord_y2 = params.y2 || 0;
        this.color = params.color || 0;
    }

    //Метод draw() класса Line
    Line.prototype.draw = function () {
        var ctx = this._canvas;
        ctx.strokeStyle = this.color;
        ctx.beginPath();
        ctx.moveTo(this.coord_x1, this.coord_y1);
        ctx.lineTo(this.coord_x2, this.coord_y2);
        ctx.lineWidth = 2;
        ctx.stroke();
    }

    startButton.onclick = function (event) {
        startButton.disabled = true;
        stopButton.disabled = false;
        //event.preventDefault();
        //console.log(event);
        console.log('Start');
        //1 - Создаем объект Окружность
        var circle1 = new Circle(ctx, {
            'x': 30,
            'y': 30,
            'radius': 15,
            'color': COLOR_GREEN
        });
        //Добавляем созданную окружность в массив объектов
        objects.push(circle1);
        //Рисуем окружность - вызов метода draw() у объекта circle1
        //circle1.draw();

        //2 - Создаем объект Прямоугольник
        var rect1 = new Rectangle(ctx, {
            'x': 50,
            'y': 50,
            'width': 100,
            'height': 80,
            'color': COLOR_BLUE
        });
        //Добавляем созданный прямоугольник в массив объектов
        objects.push(rect1);
        //Рисуем квадрат - вызов метода draw()
        //rect1.draw();

        //ctx2.color(Rectangle)=COLOR_RED;
        //ctx2.fillRect(100, 100, 40, 80);

        //3 - Создаем объект Линия
        var line1 = new Line(ctx, {
            'x1': 180,
            'y1': 180,
            'x2': 210,
            'y2': 210,
            'color': COLOR_ORANGE
        });
        //Добавляем созданную линию в массив объектов
        objects.push(line1);
        //Рисуем линию - вызов метода draw()
        //line1.draw();

        console.log(objects);
        //Просмотр анимации - рисование объектов
        drawObjectsBySteps(objects);
    };

    stopButton.onclick = function () {
        startButton.disabled = false;
        stopButton.disabled = true;
        console.log('Stop');
        clearTimeout(timerId);
    };

    circleButton.onclick = function (event) {
        event.preventDefault();
        objtype = 'circle';
    }

    rectButton.onclick = function (event) {
        event.preventDefault();
        objtype = 'rectangle';
    }

    lineButton.onclick = function (event) {
        event.preventDefault();
        objtype = 'line';
    }

    var coordsInCanvas = [];
    canvas.onmousedown = function (e) {
        console.log('onmousedown');
        coordsInCanvas[0] = getMousePos(canvas, e);
        console.log(coordsInCanvas[0]);
    };

    canvas.onmouseup = function (e) {
        console.log('onmouseup');
        coordsInCanvas[1] = getMousePos(canvas, e);
        console.log(coordsInCanvas[1]);
        drawObj(objtype, coordsInCanvas);
    };

    function drawObj(objtype, coordsInCanvas) {
        console.log(objtype);
        console.log(coordsInCanvas);
        switch (objtype) {
            case 'circle':
                var x1 = coordsInCanvas[1]['x'];
                var y1 = coordsInCanvas[1]['y'];
                console.log(coordsInCanvas[1]);
                var x0 = coordsInCanvas[0]['x'];
                var y0 = coordsInCanvas[0]['y'];
                var r = Math.sqrt(Math.pow((x1 - x0), 2) + Math.pow((y1 - y0), 2));
                console.log('r=' + r);

                var circle = new Circle(ctx, {
                    'x': x0,
                    'y': y0,
                    'radius': r,
                    'color': COLOR_RED
                });

                circle.draw();

                break;
            case 'rectangle':
                var x1 = coordsInCanvas[1]['x'];
                var y1 = coordsInCanvas[1]['y'];
                console.log(coordsInCanvas[1]);
                var x0 = coordsInCanvas[0]['x'];
                var y0 = coordsInCanvas[0]['y'];
                var wth = x1 - x0;
                console.log('width=' + wth);
                var hgt = y1 - y0;
                console.log('height=' + hgt);

                var rect = new Rectangle(ctx, {
                    'x': x0,
                    'y': y0,
                    'width': wth,
                    'height': hgt,
                    'color': COLOR_BLUE
                });

                rect.draw();
                break;
                
            case 'line':
                var x1 = coordsInCanvas[1]['x'];
                var y1 = coordsInCanvas[1]['y'];
                console.log(coordsInCanvas[1]);
                var x0 = coordsInCanvas[0]['x'];
                var y0 = coordsInCanvas[0]['y']

                var line = new Line(ctx, {
                    'x1': x0,
                    'y1': y0,
                    'x2': x1,
                    'y2': y1,
                    'color': COLOR_GREEN
                });

                line.draw();
                break;
        }
    }
    ;

    function getMousePos(canvas, evt) {
        var rect = canvas.getBoundingClientRect();
        var _x = evt.clientX - rect.left,
                _y = evt.clientX - rect.left;
        return {
            x: evt.clientX - rect.left,
            y: evt.clientY - rect.top
        };
    }

}
);


