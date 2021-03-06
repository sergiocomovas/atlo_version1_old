var canvas, context;
var paint, drawingAreaX, drawingAreaY, drawingAreaWidth, drawingAreaHeight;
var clickX = [],
    clickY = [],
    clickDrag = [];
var curSize = "normal";
var radius;

$(document).ready(function() {
    canvas = document.createElement("canvas");
    //canvas.width = $(window).width();
    canvas.width = 280;
    //canvas.height = $(window).height();
    canvas.height = 280;
    canvas.id = "canvas";
    context = canvas.getContext('2d');
    $('#divCanvas').append(canvas);
    createEvents();
    //alert(canvas.width);
    drawingAreaWidth = canvas.width;
    drawingAreaHeight = canvas.height;
    drawBorder();
});

var drawBorder = function() {
    context.beginPath();
    context.rect(0, 0, canvas.width, canvas.height);
    context.closePath();
    context.fillStyle = '#333333';
    context.fill();
    context.beginPath();
    context.rect(2, 2, canvas.width - 4, canvas.height - 4);
    context.closePath();
    context.fillStyle = 'white';
    context.fill();
};

var redraw = function() {
    clearCanvas();
    // Keep the drawing in the drawing area
    context.save();
    context.beginPath();
    context.rect(0, 0, drawingAreaWidth, drawingAreaHeight);
    context.clip();

    // For each point drawn
    for (i = 0; i < clickX.length; i += 1) {

        // Set the drawing radius
        /*switch (clickSize[i]) {
        case "small":
            radius = 2;
            break;
        case "normal":
            radius = 5;
            break;
        case "large":
            radius = 10;
            break;
        case "huge":
            radius = 20;
            break;
        default:
            break;
        }*/
        radius = 2;

        // Set the drawing path
        context.beginPath();
        // If dragging then draw a line between the two points
        if (clickDrag[i] && i) {
            context.moveTo(clickX[i - 1], clickY[i - 1]);
        } else {
            // The x position is moved over one pixel so a circle even if not dragging
            context.moveTo(clickX[i] - 1, clickY[i]);
        }
        context.lineTo(clickX[i], clickY[i]);

        // Set the drawing color
        /*if (clickTool[i] === "eraser") {
            //context.globalCompositeOperation = "destination-out"; // To erase instead of draw over with white
            context.strokeStyle = 'white';
        } else {
            //context.globalCompositeOperation = "source-over";	// To erase instead of draw over with white
            context.strokeStyle = clickColor[i];
        }*/
        context.strokeStyle = "black";
        context.lineCap = "round";
        context.lineJoin = "round";
        context.lineWidth = radius;
        context.stroke();
    }
    context.closePath();
    //context.globalCompositeOperation = "source-over";// To erase instead of draw over with white
    context.restore();


    context.globalAlpha = 1; // No IE support

    // Draw the outline image
    //context.drawImage(outlineImage, drawingAreaX, drawingAreaY, drawingAreaWidth, drawingAreaHeight);

};

var clearCanvas = function() {
    context.clearRect(0, 0, canvas.width, canvas.height);
    drawBorder();

};
var resetSignature = function() {
    clearCanvas();
    clearArray(clickDrag);
    clearArray(clickX);
    clearArray(clickY);
    $("#divSignature").empty();
};

var clearArray = function(arr) {
    while (arr.length > 0) {
        arr.pop();
    }
};

var addClick = function(x, y, dragging) {

    clickX.push(x);
    clickY.push(y);
    //clickTool.push(curTool);
    //clickColor.push(curColor);
    //clickSize.push(curSize);
    clickDrag.push(dragging);
};

var createEvents = function() {
    var press = function(e) {
           
            mouseX = e.pageX; //- this.offsetLeft,
            mouseY = e.pageY; // - this.offsetTop;
            paint = true;
            addClick(mouseX, mouseY, false);
            redraw();
        },

        drag = function(e) {
            if (paint) {
                addClick(e.pageX, e.pageY, true);
                redraw();
            }
            // Prevent the whole page from dragging if on mobile
            //e.preventDefault();
            //alert("dragged");
        },

        release = function() {
            paint = false;
            redraw();
        },

        cancel = function() {
            paint = false;
        },
        touchPress = function(e) {
            press(e.targetTouches[0]);
        },
        touchDrag = function(e) {
            drag(e.targetTouches[0]);
        };

    // Add mouse event listeners to canvas element
    canvas.addEventListener("mousedown", press, false);
    canvas.addEventListener("mousemove", drag, false);
    canvas.addEventListener("mouseup", release);
    canvas.addEventListener("mouseout", cancel, false);

    // Add touch event listeners to canvas element
    canvas.addEventListener("touchstart", touchPress, false);
    canvas.addEventListener("touchmove", touchDrag, false);
    canvas.addEventListener("touchend", release, false);
    canvas.addEventListener("touchcancel", cancel, false);
};
var printLocData = function() {
    console.log("ClickX     clickY      clickDrag");
    var printData = "ClickX     clickY      clickDrag\n"
    for (i = 0; i < clickX.length; i++) {
        console.log(clickX[i] + "       " + clickY[i] + "       " + clickDrag[i]);
        printData = printData + clickX[i] + "       " + clickY[i] + "       " + clickDrag[i] + "\n"
    }
    $("#divLog").text(printData);
};


var captureData = function() {
    
    var img = document.createElement("img");
    img.src = canvas.toDataURL();
    document.getElementById("casilla").value = canvas.toDataURL();
    //$("#divSignature").empty();
    //$("#divSignature").append(img);
    
    

};

