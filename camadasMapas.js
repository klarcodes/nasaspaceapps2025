var baseTree = {
  label: '<b>MAPAS</b>',
  collapsed: false,
  children: [
      { label: 'OSM Standard', layer: basemap },
  ]
}


var overlaysTree = {
  label: '<b>CAMADAS</b>',
  children: [
      {
        label: '<b>ÁREAS LICENCIADAS</b>',
        collapsed: true,
        children: [
            { label: '<input type="checkbox" onclick="porLink(\'Mapa/Geojson/areasLicenciadas/areaProjeto.php\', 7, groupLay_ap)"> Área do Projeto'},
            { label: '<input type="checkbox" onclick="porLink(\'Mapa/Geojson/areasLicenciadas/areaImovel.php\', 6, groupLay_ati)"> Área do Imóvel'},
      ]
      }, {
        label: '<b>ÁREAS LICENCIADAS ATÉ 4 MÓDULOS FISCAIS</b>',
        collapsed: true,
        children: [
          { label: '<input type="checkbox" onclick="porLink(\'Mapa/Geojson/Monitoramento_4mf1/areaProjeto_4mf.php\', 25, groupLay_ap4mf)"> Área do Projeto'},
          { label: '<input type="checkbox" onclick="porLink(\'Mapa/Geojson/Monitoramento_4mf1/areaImovel_4mf.php\', 26, groupLay_ati4mf)"> Área do Imóvel'},
      ]
      }, {
        label: '<b>ÁREAS INSTITUCIONAIS</b>',
        collapsed: true,
        children: [
            { label: '<input type="checkbox" onclick="porLink(\'Mapa/Geojson/areasInstitucionais/areaInalienaveis.php\', 20, groupLay_areaInal)"> Áreas Inalienáveis'},
            { label: '<input type="checkbox" onclick="porLink(\'Mapa/Geojson/areasInstitucionais/arMil.php\', 21, groupLay_areaMil)"> Áreas Militares'},
            { label: '<input type="checkbox" onclick="porLink(\'Mapa/Geojson/areasInstitucionais/limiteTerraIndigena.php\', 22, groupLay_terraInd)"> Terras Indígenas'},
            { label: '<input type="checkbox" onclick="porLink(\'Mapa/Geojson/areasInstitucionais/ucs_estaduais.php\', 23, groupLay_ucEst)"> Unidade de Conservação Estadual'},
            { label: '<input type="checkbox" onclick="porLink(\'Mapa/Geojson/areasInstitucionais/undConserFed.php\', 24, groupLay_ucFed)"> Unidade de Conservação Federal'},
      ]
      }, {
        label: '<b>BASE CARTOGRÁFICA</b>',
        collapsed: false,
        children: [
            { label: '<input type="checkbox" onclick="porLink(\'Mapa/Geojson/baseCartografica/sedesMunicipais.php\', 11, groupLay_sedesMun)"> Sedes Municipais'},
            { label: '<input type="checkbox" onclick="porLink(\'Mapa/Geojson/baseCartografica/localidades.php\', 12, groupLay_loc)"> Localidades'},
            { label: '<input type="checkbox" onclick="addRemoverLayer(\'municipios_limites\', limitesMun_options, map, \'limitesMun\', limitesMun_conteudo, \'Limites Municipais\')" id="limitesMun" checked> Limites Municipais'},
            { label: '<input type="checkbox" onclick="porLink(\'Mapa/Geojson/baseCartografica/estadosLimites.php\', 14, groupLay_limEst)"> Limites do Estado'},
            { label: '<input type="checkbox" onclick="porLink(\'Mapa/Geojson/baseCartografica/rodovias.php\', 15, groupLay_rod)"> Rodovias'},
            { label: '<input type="checkbox" onclick="porLink(\'Mapa/Geojson/baseCartografica/hidrografia2.geojson\', 16, groupLay_hidrog)"> Trecho de Drenagem (1:100.000)'},
            { label: "<input type='checkbox' onclick='porLink(\"Mapa/Geojson/baseCartografica/hidroMassaDagua.php\", 17, groupLay_hidMas)'> Trecho de Massa D'Água"},
            { label: '<input type="checkbox" onclick="porLink(\'Mapa/Geojson/baseCartografica/projAssent.php\', 18, groupLay_projAssen)"> Projeto de Assentamento'},
            { label: '<input type="checkbox" onclick="porLink(\'Mapa/Geojson/baseCartografica/glebas.php\', 19, groupLay_gleba)"> Glebas'},
        ]
      },{
          label: '<b>CAR</b>',
          collapsed: true,
          children: [
              { label: '<input type="checkbox" onclick="porLink(\'Mapa/Geojson/CAR/car.php\', 5, groupLay_car)"> CAR-RR'},
        ]
      }, {
        label: '<b>ITERAIMA</b>',
        collapsed: true,
        children: [
            { label: '<input type="checkbox" onclick="porLink(\'Mapa/Geojson/propostasAmpliacao/iteraima_td.geojson\', 2, groupLay_iterTd)"> Iteraima - Títulos Definitivos'},
      ]
      },{
        label: '<b>INCRA</b>',
        collapsed: true,
        children: [
            { label: '<input type="checkbox" onclick="porLink(\'Mapa/Geojson/propostasAmpliacao/sigef_certificados.php\', 1, groupLay_sigefCert)"> Sigef Certificados'},
      ]
      },{
          label: '<b>OUTORGA DE RECURSOS HÍDRICOS</b>',
          collapsed: true,
          children: [
              { label: '<input type="checkbox" onclick="porLink(\'Mapa/Geojson/ANA/outorgas_superficiais.geojson\', 3, groupLay_outSup)"> Outorgas Superficiais'},
              { label: '<input type="checkbox" onclick="porLink(\'Mapa/Geojson/ANA/outorgas_subterraneas.geojson\', 4, groupLay_outSub)"> Outorgas Subterrâneas'},
      ]
      }, {
          label: '<b>IBAMA</b>',
          collapsed: true,
          children: [
              { label: '<input type="checkbox" onclick="porLink(\'Mapa/Geojson/IBAMA/Ibama_embargo.json\', 10, groupLay_embargos)"> Embargos'},
      ]
      },
  ]
}

if(window.screen.width > "500"){
  var contr = L.control.layers.tree(baseTree, overlaysTree, {position: "topleft", collapsed: false}).addTo(map);
}else{
  var contr = L.control.layers.tree(baseTree, overlaysTree, {position: "topleft", collapsed: true}).addTo(map);
}