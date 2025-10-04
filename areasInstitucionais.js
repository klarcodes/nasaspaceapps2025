// Áreas Inalienáveis

var areaInalienavel_options = {
  color: "#808080",
  weight: 1
};

var areaInalienavel_conteudo = `
  <p>
    <b>Nome:</b> Área Inalienável<br>
    <b>Método:</b> {metodo}<br>
    <b>Imagem:</b> {imagem}<br>
    <b>Data:</b> {data}<br>
    <b>Rio:</b> {rio}<br>
    <b>Município:</b> {municipio}<br>
    <b>Gleba:</b> {gleba}<br>
    <b>Categoria:</b> {categoria}<br>
    <b>Nup:</b> {nup}
  </p>
`;

var areaInalienavel_leg = '<div class="color-box" style="min-width: 24px; height: 18px; border: 2px solid #808080; background-color: rgba(128,128,128,0.3); border-radius: 6px; margin-right: 10px;"></div><b> Áreas Inalienáveis</b>';


// Áreas Militares

var areaMilitar_options = {
  color: "#FF8C00",
  weight: 2
};

var areaMilitar_conteudo = `
  <p>
    <b>Nome:</b> Área Militar<br>
    <b>Área:</b> {area_ha} ha.
  </p>
`;

var areaMilitar_leg = '<div class="color-box" style="min-width: 24px; height: 18px; border: 2px solid #FF8C00; background-color: rgba(255,140,0,0.3); border-radius: 6px; margin-right: 10px;"></div><b> Áreas Militares</b>';


// Terras Indígenas

var terraIndigena_options = {
  color: "red",
  weight: 2
};

var terraIndigena_conteudo = `
  <p>
    <b>Nome:</b> {nomeabrev}<br>
    <b>Etnia:</b> {etnia_nome}<br>
    <b>Municípios:</b> {municipio_}<br>
    <b>Estados:</b> {uf_sigla}<br>
    <b>Fase:</b> {fase_ti}<br>
    <b>Modalidade:</b> {modalidade}<br>
    <b>Unidade Administrativa:</b> {undadm_nom}<br>
    <b>Sigla Unid. Administrativa:</b> {undadm_sig}<br>
    <b>Faixa de Fronteira:</b> {faixa_fron}<br>
    <b>Área:</b> {area_ha} ha.<br>
    <b>Data Atualização:</b> {data_atual}
  </p>
`;

var terraIndigena_leg = '<div class="color-box" style="min-width: 24px; height: 18px; border: 2px solid red; background-color: rgba(255,0,0,0.3); border-radius: 6px; margin-right: 10px;"></div><b> Terras Indígenas</b>';


// Unidade de Conservação Estadual

var ucsEst_options = {
  color: "#32CD32",
  weight: 2
};

var ucsEst_conteudo = `
  <p>
    <b>Nome:</b> {nomeabrev}<br>
    <b>Sigla:</b> {sigla}<br>
    <b>Administração:</b> {administra}<br>
    <b>Situação:</b> {situacao}<br>
    <b>Decreto:</b> {decreto}<br>
    <b>Ano:</b> {ano}<br>
    <b>Lei:</b> {lei}<br>
    <b>Lei Alteração:</b> {lei_altera}<br>
    <b>Área:</b> {area_ha} ha.
  </p>
`;

var ucsEst_leg = '<div class="color-box" style="min-width: 24px; height: 18px; border: 2px solid #32CD32; background-color: rgba(50,205,50,0.3); border-radius: 6px; margin-right: 10px;"></div><b> Unidade de Conservação Estadual</b>';


// Unidade de Conservação Federal

var ucsFed_options = {
  color: "#006400",
  weight: 2
};

var ucsFed_conteudo = `
  <p>
    <b>Nome:</b> {nome_area}<br>
    <b>Tipo:</b> {natureza}<br>
    <b>Detentor:</b> {detentor_n}<br>
    <b>Transcrição:</b> {transcrica}<br>
    <b>Área Hectares:</b> {area_hecta} ha.
  </p>
`;

var ucsFed_leg = '<div class="color-box" style="min-width: 24px; height: 18px; border: 2px solid #006400; background-color: rgba(0,100,0,0.3); border-radius: 6px; margin-right: 10px;"></div><b> Unidade de Conservação Federal</b>';

