var basemap = L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {});

var satelite = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {});


var NatGeo = L.tileLayer('http://services.arcgisonline.com/ArcGIS/rest/services/NatGeo_World_Map/MapServer/tile/{z}/{y}/{x}', {});


var googleSat = L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}',{
  subdomains:['mt0','mt1','mt2','mt3']
});


var googleStreets = L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',{
    subdomains:['mt0','mt1','mt2','mt3']
});



var googleHybrid = L.tileLayer('http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}',{
    subdomains:['mt0','mt1','mt2','mt3']
});



var googleTerrain = L.tileLayer('http://{s}.google.com/vt/lyrs=p&x={x}&y={y}&z={z}',{
    subdomains:['mt0','mt1','mt2','mt3']
});



if(window.screen.width > "500"){

var latit = -10.3333;
var long = -53.2;
var zm = 4;
  var map = L.map(document.getElementById('map'), {
    center: [latit, long],
    zoom: zm,
    zoomControl: false,
    layers: [basemap]
  });

  L.control.zoom({
    position: 'topright'
  }).addTo(map);

  // Latitude e Longitude

  var coordDIV = document.createElement('div');
  coordDIV.id = 'mapCoordDIV';
  coordDIV.style.position = 'absolute';
  coordDIV.style.bottom = '2%';
  coordDIV.style.left = '45%';
  coordDIV.style.zIndex = '900';
  coordDIV.style.backgroundColor = '#fff';
  coordDIV.style.fontSize = '15px';
  coordDIV.style.width = '310px';
  coordDIV.style.textAlign = 'center';
  coordDIV.style.borderRadius = '7px';

  document.getElementById('map').appendChild(coordDIV);


  map.on('mousemove', function(e){
    var lat = e.latlng.lat.toFixed(6);
    var lon = e.latlng.lng.toFixed(6);
    document.getElementById('mapCoordDIV').innerHTML ='Latitude: ' + lat + ' / Longitude: ' + lon;
  });

  // Controlador do zoom


}else{

  var latit = -0.50;
  var long = -61.4714;
  var zm = 6;
  var map = L.map(document.getElementById('map'), {
    center: [latit, long],
    zoom: zm,
    zoomControl: false,
    layers: [basemap]
  });

  L.control.zoom({
    position: 'topright'
  }).addTo(map);

    // Latitude e Longitude

    var coordDIV = document.createElement('div');
    coordDIV.id = 'mapCoordDIV';
    coordDIV.style.position = 'absolute';
    coordDIV.style.bottom = '2%';
    coordDIV.style.left = '25%';
    coordDIV.style.zIndex = '900';
    coordDIV.style.backgroundColor = '#fff';
    coordDIV.style.fontSize = '10px';
    coordDIV.style.width = '210px';
    coordDIV.style.textAlign = 'center';
    coordDIV.style.borderRadius = '7px';
  
    document.getElementById('map').appendChild(coordDIV);
  
  
    map.on('mousemove', function(e){
      var lat = e.latlng.lat.toFixed(6);
      var lon = e.latlng.lng.toFixed(6);
      document.getElementById('mapCoordDIV').innerHTML ='Latitude: ' + lat + ' / Longitude: ' + lon;
    });

}

// Barra de escala

L.control.scale({
    metric: true, // Mostra unidades métricas (km, m)
    imperial: false, // Oculta unidades imperiais (milhas, pés)
    maxWidth: 100, // Largura máxima da barra de escala em pixels
    position: 'bottomright' // Posição da barra de escala no mapa
}).addTo(map);



// create the sidebar instance and add it to the map
var sidebar = L.control.sidebar({ container: 'sidebar' })
    .addTo(map)
    .open('home');

// add panels dynamically to the sidebar
sidebar
    .addPanel({
        id:   'js-api',
        tab:  '<i class="fa fa-gear"></i>',
        title: 'JS API',
        pane: '<p>The Javascript API allows to dynamically create or modify the panel state.<p/><p><button onclick="sidebar.enablePanel(\'mail\')">enable mails panel</button><button onclick="sidebar.disablePanel(\'mail\')">disable mails panel</button></p><p><button onclick="addUser()">add user</button></b>',
    })
    // add a tab with a click callback, initially disabled
    .addPanel({
        id:   'mail',
        tab:  '<i class="fa fa-envelope"></i>',
        title: 'Messages',
        button: function() { alert('opened via JS callback') },
        disabled: true,
    })

// be notified when a panel is opened
sidebar.on('content', function (ev) {
    switch (ev.id) {
        case 'autopan':
        sidebar.options.autopan = true;
        break;
        default:
        sidebar.options.autopan = false;
    }
});

var userid = 0
function addUser() {
    sidebar.addPanel({
        id:   'user' + userid++,
        tab:  '<i class="fa fa-user"></i>',
        title: 'User Profile ' + userid,
        pane: '<p>user ipsum dolor sit amet</p>',
    });
}

// Barra de opções

var drawnItems = new L.FeatureGroup();
map.addLayer(drawnItems);

var drawControl = new L.Control.Draw({
  position: 'topright',
  draw: {
    polygon: {
      shapeOptions: {
        weight: 2
      }
    },
    polyline: {
      shapeOptions: {
        weight: 2
      },
    },
    rectangle: false,      // Desabilitar retângulos
    circle: false,         // Desabilitar círculos
    circlemarker: {
      radius: 6,           // Tamanho do círculo
      color: "#3388ff",    // Cor da borda
      weight: 2,           // Espessura da borda
      fillColor: "#3388ff",// Cor de preenchimento
    },   // Desabilitar marcadores de círculo
    marker: false,
  },
  edit: false
});
map.addControl(drawControl);


map.pm.addControls({
  position: 'topright',
  drawMarker: false,
  drawCircleMarker: false,
  drawPolyline: false,
  drawRectangle: false,
  drawCircle: false,
  drawPolygon: false,
  dragMode: false,
  cutPolygon: false,
  editMode: false,
  removalMode: false
});