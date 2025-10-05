var layers = {};

function addRemoverLayer(urlLayer, layerOptions, map, id, conteudo = '', titulo = '', php = false, tabela = '') {

    var checkbox = document.getElementById(id);

    if (checkbox.checked) {
        // Se o checkbox estiver marcado, cria a camada e a adiciona
        layers[id] = createLayer(urlLayer, layerOptions, map, id, conteudo, titulo, php, tabela);

    } else {
        // Se o checkbox estiver desmarcado, remove a camada do mapa
        if (layers[id]) {
            map.removeLayer(layers[id]);  // Remove a camada correta (cluster ou não)
            delete layers[id];  // Remove a referência da camada
        }
    }



}



// Função genérica para criar camadas e adicionar dados com ou sem marker cluster
function createLayer(urlLayer, layerOptions, map, id, conteudo, titulo, php, tabela) {

    var layer;

    // Cria uma camada GeoJSON normal (sem cluster)
    layer = L.geoJSON(null, layerOptions);

    if(php == true){

        //var url = 'http://localhost/nasaspaceapps2025/'+tabela;
        var url = 'https://nasaspaceapps2025.klar.codes/'+tabela;

    }else{

    var url = 'https://geoserverintranet.femarh.rr.gov.br/geoserver/cite/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=cite:' + urlLayer + '&outputFormat=application/json';

    }

    console.log(url);
    $.getJSON(url, function (data) {
        layer.addData(data);


        layer.on('click', function (e) {

            const props = e.layer.feature.properties;


            let contentPerFeature = conteudo.replace(/\{([\w_]+)\}/g, function (_, key) {
                let value = props[key];
                if ((key === 'area' || key === 'area_ha' || key === 'area_hecta' || key === 'hectares' || key === 'area_est_ha' || key === 'qtd_area_d' || key === 'area_km' || key === 'ha') && typeof value === 'number') {
                    return value.toLocaleString('pt-BR', {
                        minimumFractionDigits: 4,
                        maximumFractionDigits: 4
                    });
                }

                return (value !== undefined && value !== null) ? value : '-';
            });

            // Atualiza título
            document.getElementById('staticBackdropLabel').innerText = titulo;

            // Atualiza body
            document.getElementById('modalBody').innerHTML = contentPerFeature;

            // Abre modal usando Bootstrap
            var myModal = new bootstrap.Modal(document.getElementById('staticBackdrop'));
            myModal.show();

        })

        map.addLayer(layer);  // Adiciona a camada normal ao mapa
        layers[id] = layer;  // Salva a camada para remoção futura


        return layer;  // Retorna a camada, caso seja necessário manipular depois

    })

}




var layers1 = {};

function addRemoverLayer2(prop, map, filtro, conteudo = '', titulo = '', editBtn, editModal, delModal) {

    var checkbox = document.getElementById(filtro);

    if (checkbox.checked) {
        // Se o checkbox estiver marcado, cria a camada e a adiciona
        layers1[filtro] = createLayer2(prop, map, filtro, conteudo, titulo);
        document.getElementById(editBtn).style.display = 'inline-block';
        document.getElementById(editModal).style.display = 'inline-block';
        document.getElementById(delModal).style.display = 'inline-block';

    } else {
        // Se o checkbox estiver desmarcado, remove a camada do mapa
        if (layers1[filtro]) {
            map.removeLayer(layers1[filtro]);  // Remove a camada correta (cluster ou não)
            delete layers1[filtro];  // Remove a referência da camada
            document.getElementById(editBtn).style.display = 'none';
            document.getElementById(editModal).style.display = 'none';
             document.getElementById(delModal).style.display = 'none';
        }
    }
}


let editing = false; // estado do botão
async function addRemoverLayerEdit2(layerOptions, map, id, conteudo = '', titulo = '', editBtnId, geom) {

    let editBtn = document.getElementById(editBtnId);
    let hiddenInput = document.getElementById(geom); // seu input hidden


    const current = layers1[id];

    //         console.log('Layer atual:', current);
    // console.log('No mapa?', map.hasLayer(current));

    if (!editing) {
        // Inicia edição
        if (current.pm) current.pm.enable();
        editing = true;
        editBtn.style.color = "green";
    } else {
        // Finaliza edição
        if (current.pm) current.pm.disable();
        editing = false;
        editBtn.style.color = "black";
        // JSON.stringify(layer.toGeoJSON().features[0].geometry)
        // Atualiza o input hidden com todo o GeoJSON da FeatureCollection
        if (current.toGeoJSON) {
            hiddenInput.value = JSON.stringify(current.toGeoJSON().features[0].geometry);
            console.log("GeoJSON salvo no input:", hiddenInput.value);

            try {
                const response = await fetch("./addEditOnlyPoly.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        geom: hiddenInput.value,
                        gid: id
                    })
                });

                const result = await response.json();
                console.log(result);
                // msgDiv.style.display = "block";
                // msgDiv.className = "mb-3 alert " + (result.success ? "alert-success" : "alert-danger");
                // msgDiv.textContent = result.success
                // ? "✅ " + result.message
                // : "❌ " + result.message;

                if (result.success) {
                    setTimeout(() => {
                        // bootstrapModal.hide();

                        // Recarrega a página
                        // location.reload();

                        // Redireciona para outra página (opcional)
                        // window.location.href = "dashboard.php";
                    }, 1000);
                }

            } catch (error) {
                // msgDiv.style.display = "block";
                // msgDiv.className = "mb-3 alert alert-warning";
                // msgDiv.textContent = "⚠️ Erro na requisição de salvar";
                console.error(error);
            }
        }
    }



}






// Função genérica para criar camadas e adicionar dados com ou sem marker cluster
function createLayer2(prop, map, filtro, conteudo, titulo) {

    var layer;

    // Cria uma camada GeoJSON normal (sem cluster)


    // var url = 'http://localhost/nasaspaceapps2025/';
    var url = 'https://nasaspaceapps2025.klar.codes/';

    $.getJSON(url + 'nasaTabela.php', function (data) {

        layer = L.geoJSON(data, {
            filter: function (features) {
                if (features.properties[prop] == filtro) {
                    return true
                }
            },
            style: function (feature) {
                switch (feature.properties.categoria) {
                    case 'desmatamento': return { color: "#2E7D32", weight: 2 };
                    case 'poluicao': return { color: "#455A64", weight: 2 };
                    case 'enchentes': return { color: "#0277BD", weight: 2 };
                    case 'ilhas_calor': return { color: "#F57C00", weight: 2 };
                    case 'erosao_assoreamento': return { color: "#8D6E63", weight: 2 };
                    case 'urbanizacao': return { color: "#6A1B9A", weight: 2 };
                    case 'riscos_geologicos': return { color: "#C62828", weight: 2 };
                    case 'escassez_hidrica': return { color: "#0097A7", weight: 2 };
                }
            }
        });

        layer.on('click', function (e) {

            const props = e.layer.feature.properties;


            let contentPerFeature = conteudo.replace(/\{([\w_]+)\}/g, function (_, key) {
                let value = props[key];
                if ((key === 'area' || key === 'area_ha' || key === 'area_hecta' || key === 'hectares' || key === 'area_est_ha' || key === 'qtd_area_d' || key === 'area_km' || key === 'ha') && typeof value === 'number') {
                    return value.toLocaleString('pt-BR', {
                        minimumFractionDigits: 4,
                        maximumFractionDigits: 4
                    });
                }

                return (value !== undefined && value !== null) ? value : '-';
            });

            // Atualiza título
            document.getElementById('staticBackdropLabel').innerText = titulo;

            // Atualiza body
            document.getElementById('modalBody').innerHTML = contentPerFeature;

            // Abre modal usando Bootstrap
            var myModal = new bootstrap.Modal(document.getElementById('staticBackdrop'));
            myModal.show();

        })

        map.addLayer(layer);  // Adiciona a camada normal ao mapa
        layers1[filtro] = layer;  // Salva a camada para remoção futura


        return layer;  // Retorna a camada, caso seja necessário manipular depois

    })

}









var layersWms = {};

function addRemoverLayerWms(layer, date, id, map) {

    var checkbox = document.getElementById(id);

    if (checkbox.checked) {
        // Se o checkbox estiver marcado, cria a camada e a adiciona
        layersWms[id] = createLayerWms(layer, date, id, map);

    } else {
        // Se o checkbox estiver desmarcado, remove a camada do mapa
        if (layersWms[id]) {
            map.removeLayer(layersWms[id]);  // Remove a camada correta (cluster ou não)
            delete layersWms[id];  // Remove a referência da camada
        }
    }



}



// Função genérica para criar camadas e adicionar dados com ou sem marker cluster
function createLayerWms(layer, date, id, map) {

    var layerWms;

    layerWms = L.tileLayer.wms("https://gibs.earthdata.nasa.gov/wms/epsg3857/best/wms.cgi", {
        layers: layer,
        format: "image/png",
        transparent: true,
        time: date, // ou dynamically set
        attribution: "NASA GIBS",
        maxZoom: 9
    });

    map.addLayer(layerWms);  // Adiciona a camada normal ao mapa
    layersWms[id] = layerWms;  // Salva a camada para remoção futura

    
    return layerWms;  // Retorna a camada, caso seja necessário manipular depois

}