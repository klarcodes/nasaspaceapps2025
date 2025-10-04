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


    // Adicionar a camada inicial quando a página carregar
    window.onload = function() {
      addRemoverLayer('estado_limites', limitesEst_options, map, 'limitesEst', limitesEst_conteudo, 'Limites do Estado');

      addRemoverLayer('municipios_limites', limitesMun_options, map, 'limitesMun', limitesMun_conteudo, 'Limites Municipais');
    };
