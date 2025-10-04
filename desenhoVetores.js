map.on('draw:created', function (e) {

  var type = e.layerType,
      layer = e.layer;

  if (type === 'circlemarker') {
    // Garante que o marker tenha um feature GeoJSON
    if (!layer.feature) {
      layer.feature = {
        type: "Feature",
        properties: {},
        geometry: {
          type: "Point",
          coordinates: [layer.getLatLng().lng, layer.getLatLng().lat]
        }
      };
    }

    // Agrupa para garantir compatibilidade com addLayerControl
    let layerParaLegenda = L.featureGroup([layer]);

    // Adiciona ao mapa
    map.addLayer(layerParaLegenda);

    // Chama a função de legenda
    addLayerControl(layerParaLegenda, "Desenho", '', '', true, true);


  } else {

    // Agrupa para garantir compatibilidade com addLayerControl
    let layerParaLegenda = L.featureGroup([layer]);

    // Adiciona ao mapa
    map.addLayer(layerParaLegenda);

    // Chama a função de legenda
    addLayerControl(layerParaLegenda, "Desenho", '', '', true, true);


  }

});
