
// Sedes Municipais

var sedesMun_options = {
  pointToLayer: function (geom, latlng) {
    if (geom.properties.nome == 'Boa Vista') {
      return L.marker(latlng, {icon: redIcon});
    }
    else {
      return L.marker(latlng, {icon: blueIcon});
    }
  }
};

var sedesMun_conteudo = `
  <p>
    <b>Geocódigo:</b> {geocodigo}<br>
    <b>Nome:</b> {nome}<br>
    <b>Tipo:</b> {tipocidade}
  </p>
`;


// var cap = '<div class="line-with-text" style="display: flex; align-items: center; gap: 10px; margin-left: 10px;"><img src="'+UrlFemarh+'View/Bibliotecas/leaflet/images/pin-de-localizacao-vermelho.png" style="max-width:22px;max-height:22px; margin-right: 10px;"><span class="text" style="white-space: nowrap; font-weight: bold;">Capital</span></div>';

// var mun1 = '<div class="line-with-text" style="display: flex; align-items: center; gap: 10px; margin-left: 10px;"><img src="'+UrlFemarh+'View/Bibliotecas/leaflet/images/pin-de-localizacao-azul.png" style="max-width:22px;max-height:22px; margin-right: 10px;"><span class="text" style="white-space: nowrap; font-weight: bold;">Municípios</span></div>';

// var sedesMun_leg = '<b>Sedes Municipais</b>'+cap+mun1;


// Localidades

var localidade_options ={
  pointToLayer: function (geom, latlng) {
      return L.marker(latlng, {icon: whiteIcon});
  }
};

var localidade_conteudo = `
  <p>
    <b>Nome:</b> {nome}<br>
    <b>Município:</b> {municipio}<br>
    <b>Fonte:</b> {fonte}<br>
    <b>Latitude:</b> {lat}<br>
    <b>Longitude:</b> {longit}
  </p>
`;

// var localidade_leg = '<img src="'+UrlFemarh+'View/Bibliotecas/leaflet/images/pin-de-localizacao.png" style="max-width:22px;max-height:22px; margin-right: 10px;"> <b>Localidades</b>';


// Limites Municipais

var limitesMun_options = {
  color: "black",
  opacity: "1.0",
  fillOpacity: "0",
  weight: 1
};

var limitesMun_conteudo = `
  <p>
    <b>Geocódigo:</b> {geocodigo}<br>
    <b>Nome:</b> {nome}<br>
    <b>Área:</b> {area_ha} ha.
  </p>
`;

// var limitesMun_leg = '<div class="color-box" style="min-width: 24px; height: 18px; border: 2px solid black; background-color: transparent; border-radius: 6px; margin-right: 10px;"></div><b> Limites Municipais</b>';


// Limites do Estado

var limitesEst_options = {
  color: "black",
  fill: false,
  weight: 3
};

var limitesEst_conteudo = `
  <p>
    <b>Geocódigo:</b> {geocodigo}<br>
    <b>Nome:</b> {nome}<br>
    <b>Sigla:</b> {sigla}
  </p>
`;

// var limitesEst_leg = '<div class="color-box" style="min-width: 24px; height: 18px; border: 2px solid black; background-color: transparent; border-radius: 6px; margin-right: 10px;"></div><b> Limites do Estado</b>';


// Rodovias

var rodovias_options = {
  style: function(feature) {
    switch (feature.properties.administra) {
        case 'Federal': return {color: "red", weight: 2};
        case 'Estadual': return {color: "#32CD32", weight: 2};
        case 'Municipal': return {color: "black", weight: 2};
    }
  },
  onEachFeature: function (geom, layer) {
    layer.bindTooltip(geom.properties.codtrechor, {sticky: true});
  }
};

var rodovias_conteudo = `
  <p>
    <b>Nome:</b> {codtrechor}<br>
    <b>Jurisdição:</b> {jurisdicao}<br>
    <b>Administração:</b> {administra}<br>
    <b>Revestimento:</b> {revestimen}<br>
    <b>Operacional:</b> {operaciona}<br>
    <b>Situação:</b> {situacaofi}<br>
    <b>Tráfego:</b> {trafego}
  </p>
`;



// var mun = '<div class="line-with-text" style="display: flex; align-items: center; gap: 10px; margin-left: 10px;"><div class="line" style="min-width: 20px; height: 2px; background-color: black;"></div><span class="text" style="white-space: nowrap;">Municipal</span></div>';

// var est = '<div class="line-with-text" style="display: flex; align-items: center; gap: 10px; margin-left: 10px;"><div class="line" style="min-width: 20px; height: 2px; background-color: #32CD32;"></div><span class="text" style="white-space: nowrap;">Estadual</span></div>';

// var fed = '<div class="line-with-text" style="display: flex; align-items: center; gap: 10px; margin-left: 10px;"><div class="line" style="min-width: 20px; height: 2px; background-color: red;"></div><span class="text" style="white-space: nowrap;">Federal</span></div>';

// var rodovias_leg = '<b>Rodovias</b>'+fed+est+mun;


// Trecho de Drenagem (1:100.000)

var trechoDrenag_options = {
  color: "#00BFFF",
  weight: 1
};

var trechoDrenag_conteudo = `
  <p>
    <b>Nome:</b> {nome}<br>
    <b>Nome Abreviado:</b> {nomeabrev}<br>
    <b>Navegabilidade:</b> {navegabili}
  </p>
`;

// var trechoDrenag1_options = {
//     layers: 'cite:hidrografia',
//     format: 'image/png',
//     transparent: true,
//     tiled: true,
//     redraw: true,
//     version: '1.1.0',
//     srs: 'EPSG:3857',
//     styles: 'hidrografia'
// };

var trechoDrenag1_options = {
    layers: 'cite:hidrografia',
    format: 'image/png',
    transparent: true,
    tiled: false,
    version: '1.1.0',
    srs: 'EPSG:4674',
    styles: 'hidrografia', // nome exato do estilo salvo
};

// var trechoDrenag_leg = '<div class="color-box" style="min-width: 24px; height: 18px; border: 2px solid #00BFFF; background-color: rgba(0, 191, 255, 0.3); border-radius: 6px; margin-right: 10px;"></div><b> Trecho de Drenagem (1:100.000)</b>';


// Trecho de Massa D'Água

var trechoMassa_options = {
  color: "#00BFFF",
  weight: 2
};

var trechoMassa_conteudo = `
  <p>
    <b>Nome:</b> {nome}<br>
    <b>Nome Abreviado:</b> {nomeabrev}<br>
    <b>Tipo:</b> {tipotrecho}<br>
    <b>Salinidade:</b> {salinidade}
  </p>
`;

// var trechoMassa_leg = `<div class="color-box" style="min-width: 24px; height: 18px; border: 2px solid #00BFFF; background-color: rgba(0, 191, 255, 0.3); border-radius: 6px; margin-right: 10px;"></div> <b>Trecho de Massa D'Água</b>`;


// Projeto de Assentamento

var projetoAss_options = {
  color: "#FFD700",
  weight: 2
};

var projetoAss_conteudo = `
  <p>
    <b>Nome:</b> {nome_area}<br>
    <b>Detentor:</b> {detentor_n}<br>
    <b>Tipo:</b> {natureza}<br>
    <b>Status:</b> {status}<br>
    <b>Área:</b> {area_ha} ha.
  </p>
`;

// var projetoAss_leg = `<div class="color-box" style="min-width: 24px; height: 18px; border: 2px solid #FFD700; background-color: rgba(255, 215, 0, 0.3); border-radius: 6px; margin-right: 10px;"></div> <b>Projetos de Assentamento</b>`;

// Glebas

var gleba_options = {
  color: "blue"
};

var gleba_conteudo = `
  <p>
    <b>Nome:</b> {text}<br>
    <b>Situação:</b> {situacao}<br>
    <b>Área:</b> {hectares} ha.
  </p>
`;

// var gleba_leg = `<div class="color-box" style="min-width: 24px; height: 18px; border: 2px solid blue; background-color: rgba(0, 0, 255, 0.3); border-radius: 6px; margin-right: 10px;"></div> <b>Glebas</b>`;


// Curva de Nível

var curvaNiv_options = {
    color: "SandyBrown",
    weight: 2
};

var curvaNiv_conteudo = `
  <p>
    <b>Cota: </b>{cota}<br>
    <b>Indice:</b> {indice}
  </p>
`;

var curvaNiv1_options = {
    layers: 'cite:curva_nivel',
    format: 'image/png',
    transparent: true,
    tiled: true,
    version: '1.1.0',
    srs: 'EPSG:4674',
    styles: 'curva_nivel', // nome exato do estilo salvo
};

// var curvaNiv_leg = '<div class="color-box" style="min-width: 24px; height: 18px; border: 2px solid SandyBrown; background-color: rgba(244, 164, 96, 0.3); border-radius: 6px; margin-right: 10px;"></div><b> Curva de Nível</b>';




    // Adicionar a camada inicial quando a página carregar
    // window.onload = function() {
    //   addRemoverLayer('estado_limites', limitesEst_options, map, 'limitesEst', limitesEst_conteudo, 'Limites do Estado');

    //   addRemoverLayer('municipios_limites', limitesMun_options, map, 'limitesMun', limitesMun_conteudo, 'Limites Municipais');
    // };
