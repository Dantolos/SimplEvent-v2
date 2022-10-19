let LB_EXHIBITOR = new se2_LB_Exhibitor();

const mapFrame = document.getElementById('mapframe');
const map = document.getElementById('map');
const mapSVG = map.querySelector('svg');
const Exhibitors = document.querySelector('#_booth');

const tooltipDOM = document.getElementById('booth-tooltip');


for (let i = 0; i < Exhibitors.children.length; i++) {
    const Exhibitor = Exhibitors.children[i];
    Exhibitor.classList.add('exhibitors-lb-trigger')
    Exhibitor.setAttribute('data-exhibitorid', Exhibitor.getAttribute('id'))
    Exhibitor.setAttribute('data-pageid', mapFrame.dataset.pageid)

    Exhibitor.addEventListener('mousemove', ()=>{
        tooltipDOM.classList.remove('hide-tooltip')
        boothTooltip( Exhibitor.getAttribute('id') );
    })

    Exhibitor.addEventListener('mouseleave', ()=>{
        tooltipDOM.classList.add('hide-tooltip')
    })
}

LB_EXHIBITOR.CALL_EXHIBITOR_LIGHTBOX(document.querySelectorAll('.exhibitors-lb-trigger'))


var element = map;
var hammertime = new Hammer(element, {});

gsap.to(element, .2, { x:  0, y: 0, scale: 1 })

hammertime.get('pinch').set({ enable: true });
hammertime.get('pan').set({ threshold: 0 });

var fixHammerjsDeltaIssue = undefined;
var pinchStart = { x: undefined, y: undefined }
var lastEvent = undefined;



var originalSize = {
    width: 200,
    height: 300
}

var current = {
    x: 0,
    y: 0,
    z: 1,
    zooming: false,
    width: originalSize.width * 1,
    height: originalSize.height * 1,
}

var last = {
    x: current.x,
    y: current.y,
    z: current.z
}

var limit = {
    x: element.offsetWidth / 100 * 80,
    y: element.offsetHeight / 100 * 70,
}

function getRelativePosition(element, point, originalSize, scale) {
    var domCoords = getCoords(element);

    var elementX = point.x - domCoords.x;
    var elementY = point.y - domCoords.y;

    var relativeX = elementX / (originalSize.width * scale / 2) - 1;
    var relativeY = elementY / (originalSize.height * scale / 2) - 1;
    return { x: relativeX, y: relativeY }
}

function getCoords(elem) { // crossbrowser version
    var box = elem.getBoundingClientRect();

    var body = document.body;
    var docEl = document.documentElement;

    var scrollTop = window.pageYOffset || docEl.scrollTop || body.scrollTop;
    var scrollLeft = window.pageXOffset || docEl.scrollLeft || body.scrollLeft;

    var clientTop = docEl.clientTop || body.clientTop || 0;
    var clientLeft = docEl.clientLeft || body.clientLeft || 0;

    var top  = box.top +  scrollTop - clientTop;
    var left = box.left + scrollLeft - clientLeft;

    return { x: Math.round(left), y: Math.round(top) };
}

function scaleFrom(zoomOrigin, currentScale, newScale) {
    var currentShift = getCoordinateShiftDueToScale(originalSize, currentScale);
    var newShift = getCoordinateShiftDueToScale(originalSize, newScale)

    var zoomDistance = newScale - currentScale
    
    var shift = {
        x: currentShift.x - newShift.x,
        y: currentShift.y - newShift.y,
    }

    var output = {
        x: zoomOrigin.x * shift.x,
        y: zoomOrigin.y * shift.y,
        z: zoomDistance
    }
    return output
}

function getCoordinateShiftDueToScale(size, scale){
    var newWidth = scale * size.width;
    var newHeight = scale * size.height;
    var dx = (newWidth - size.width) / 2
    var dy = (newHeight - size.height) / 2
    return {
        x: dx,
        y: dy
    }
}

hammertime.on('doubletap', function(e) {
    var scaleFactor = 1;
    if (current.zooming === false) {
        current.zooming = true;
    } else {
        current.zooming = false;
        scaleFactor = -scaleFactor;
    }

    element.style.transition = "0.3s";
    setTimeout(function() {
        element.style.transition = "none";
    }, 300)

    var zoomOrigin = getRelativePosition(element, { x: e.center.x, y: e.center.y }, originalSize, current.z);
    var d = scaleFrom(zoomOrigin, current.z, current.z + scaleFactor)
    current.x += d.x;
    current.y += d.y;
    current.z += d.z;

    last.x = current.x;
    last.y = current.y;
    last.z = current.z;

    update();
})

hammertime.on('pan', function(e) {
    if (lastEvent !== 'pan') {
        fixHammerjsDeltaIssue = {
            x: e.deltaX,
            y: e.deltaY
        }
    }

    current.x = last.x + e.deltaX - fixHammerjsDeltaIssue.x;
    current.y = last.y + e.deltaY - fixHammerjsDeltaIssue.y;
    lastEvent = 'pan';
    update();
})    

hammertime.on('pinch', function(e) {
    var d = scaleFrom(pinchZoomOrigin, last.z, last.z * e.scale)
    current.x = d.x + last.x + e.deltaX;
    current.y = d.y + last.y + e.deltaY;
    current.z = d.z + last.z;
    lastEvent = 'pinch';
    update();
})



var pinchZoomOrigin = undefined;
hammertime.on('pinchstart', function(e) {
    pinchStart.x = e.center.x;
    pinchStart.y = e.center.y;
    pinchZoomOrigin = getRelativePosition(element, { x: pinchStart.x, y: pinchStart.y }, originalSize, current.z);
    lastEvent = 'pinchstart';
})

hammertime.on('panend', function(e) {
    last.x = current.x;
    last.y = current.y;
    lastEvent = 'panend';
})

hammertime.on('pinchend', function(e) {
    last.x = current.x;
    last.y = current.y;
    last.z = current.z;
    lastEvent = 'pinchend';
})

document.getElementById('reset').addEventListener('click', ()=> {
    current.x = 0;
    current.y = 0;
    current.z = 1;
    update()
});

document.getElementById('zoomout').addEventListener('click', ()=> {
    if( current.z > .5 ){
        current.z = current.z - .25;
    }
    update()
});

document.getElementById('zoomin').addEventListener('click', ()=> {
    if( current.z < 2 ){
        current.z = current.z + .25;
    }
    update()
});

function update() {
    current.height = originalSize.height * current.z;
    current.width = originalSize.width * current.z;
    element.style.trasition = '2';

    zoomLimit =  current.z >= 1 ? current.z : current.z + 1
    var correctur = {
        x: limit.x / zoomLimit,
        y: limit.y / zoomLimit
    }

    if( current.x < -Math.abs( limit.x ) || current.x > limit.x ){  current.x = current.x > 0 ? correctur.x : -Math.abs( correctur.x ) }
    if( current.y < -Math.abs( limit.y ) || current.y > limit.y ){  current.y = current.y > 0 ? correctur.y: -Math.abs( correctur.y ) }

    gsap.to(element, .2, { x:  current.x, y: current.y, scale: current.z })

    
}



//List 
var listOpen = false;

const ExhibitorListElements = document.createElement('div');
for (let i = 0; i < Exhibitors.children.length; i++) {
    if(listData[i]){
        const ExhibitorElement = Exhibitors.children[i];
        const ExhibitorListDOM = document.createElement('div');

        let label = listData[i]['label'] ? listData[i]['label'] : listData[i]['name']
        ExhibitorListDOM.innerHTML = '<span>'+(i+1)+'</span><h5>'+label+'</h5>';
        ExhibitorListDOM.classList.add('exhibitors-lb-trigger', 'exhibitor-list-element')
        ExhibitorListDOM.setAttribute('data-exhibitorid', (i+1))
        ExhibitorListDOM.setAttribute('data-pageid', mapFrame.dataset.pageid)

        let BoothSearch = (i+1) < 10 ? '_0'+(i+1) : '_'+(i+1);
        
        let aliasBooth = document.querySelector('[data-exhibitorid="'+BoothSearch+'"]');
        ExhibitorListDOM.addEventListener('mouseenter', ()=> {     
            aliasBooth.classList.add( 'highlighted-booth' )
        })
        ExhibitorListDOM.addEventListener('mouseleave', ()=> {
            aliasBooth.classList.remove( 'highlighted-booth' )
        })
        
        ExhibitorListElements.appendChild(ExhibitorListDOM)
    }
}

document.getElementById('list').addEventListener('click', (e) => {
    listOpen?closeList(e.target):openList(e.target);
});

function openList( buttonElement ){
    const ExhibitorList = document.createElement('div');

    buttonElement.classList.add('map-active-button')

    ExhibitorList.classList.add('exhibitor-list')
    ExhibitorList.appendChild(ExhibitorListElements)
    mapFrame.appendChild(ExhibitorList);

    LB_EXHIBITOR.CALL_EXHIBITOR_LIGHTBOX(document.querySelectorAll('.exhibitors-lb-trigger'))
    listOpen = true;
}

function closeList( buttonElement ){
    listOpen = false;

    buttonElement.classList.remove('map-active-button')
    
    let ListDOM = document.querySelectorAll('.exhibitor-list');

    for( let ListElement of ListDOM ){
        ListElement.remove()
    }
}

var mousePosition = {
    x : 0,
    y : 0
}

function mouseTracking(event){
    mousePosition = {
        x : ( event.clientX + 10),
        y : (event.offsetY + 10)
    }
}

function boothTooltip( rawID ){
    let boothID = parseInt( rawID.replace('_', '') ) - 1
    
    gsap.to(tooltipDOM, .2, { top: mousePosition.y, left: mousePosition.x })
    let boothLogo = tooltipDOM.querySelector('img')

    boothLogo.src = listData[boothID]['logo']
    tooltipDOM.querySelector('h5').innerHTML = listData[boothID]['name']
}