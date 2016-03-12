// Create and return a new canvas tag with the specified id and size.
// Note that this method does not add the canvas to the document
function makeCanvas(cntid, id, _width, _height) {
    var canvas    = document.createElement("canvas");
    canvas.id     = id;
    canvas.width  = _width;
    canvas.height = _height;
    return canvas;
}

function scatter(canvas, xList, yList, mark, left, top, width, height, xMin, xMax, yMin, yMax) {
    // Get the canvas if specified by id
    if (typeof canvas == "string") canvas = document.getElementById(canvas);

    // We draw with the canvas' drawing context
    var g = canvas.getContext("2d");

    // All the lines we draw are 2 pixel wide black lines
    g.lineWidth = 2;
    g.strokeStyle = "black";
    g.fillStyle = "lightgreen";
    g.fillRect(left, top, width, height);
    g.strokeRect(left, top, width, height);

    g.beginPath();              // Start a new shape
    for (var i = 0; i < xList.length; ++i) {
        var lt = (xList[i]-xMin)*width/(xMax-xMin)+left,
            tp = -(yList[i]-yMin)*height/(yMax-yMin)+top+height;
        g.moveTo(lt-5, tp);
        g.lineTo(lt+5, tp);
        g.moveTo(lt,   tp-5);
        g.lineTo(lt,   tp+5);
    }
    g.closePath();              // End shape
    g.stroke();                 // Outline ("stroke")
}


//  scatter("canvas", json.x, json.y, "+", 10, 10, 500, 300, 0, 60, 0, 60);
//scatter("canvas", [0, 23, 34, 60], [12, 23, 34, 55], "+", 10, 10, 500, 300, 0, 60, 0, 60);

