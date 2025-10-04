// Função para ajustar a largura do campo de texto conforme o conteúdo
function adjustInputWidth(input) {
  const span = document.createElement("span");
  span.style.visibility = "hidden";
  span.style.position = "absolute";
  span.style.whiteSpace = "pre";
  span.style.font = window.getComputedStyle(input).font;
  span.textContent = input.value || input.placeholder || "";
  document.body.appendChild(span);

  input.style.width = (span.offsetWidth + 8) + "px"; // 8px de margem extra
  document.body.removeChild(span);
}

function addLayerControl(layer, layerName) {

  layerName += ' (' + layer.toGeoJSON().features.length + ')';


  var tipoGeometria = layer.toGeoJSON().features[0].geometry.type;


  var container = document.createElement('div');
  var targetDiv = document.getElementById('texto');
  container.className = 'flex-container';


  // Checkbox de visibilidade
  var checkbox = document.createElement("input");
  checkbox.type = "checkbox";
  checkbox.title = "Ativar e Desativar camada";
  checkbox.checked = true;
  checkbox.style.marginRight = "6px";
  checkbox.id = layerName;
  checkbox.addEventListener("change", function () {
    const current = layer;
    if (checkbox.checked) {
      map.addLayer(current);
    } else {
      map.removeLayer(current);
    }
  });


  // Botão de zoom
  const zoomBtn = document.createElement("button");
  zoomBtn.innerHTML = "🔍";
  zoomBtn.title = "Zoom na camada";
  zoomBtn.style.border = "none";
  zoomBtn.style.background = "transparent";
  zoomBtn.style.cursor = "pointer";
  zoomBtn.style.fontSize = "14px";
  zoomBtn.addEventListener("click", function () {
    const current = layer;
    if (current && current.getBounds) {
      map.fitBounds(current.getBounds());
    }
  });

  if (tipoGeometria === "Polygon" || tipoGeometria === "MultiPolygon") {


  }

  // Botão de exclusão
  var deleteButton = document.createElement("button");
  deleteButton.title = "Remover camada";
  deleteButton.innerHTML = "X";
  deleteButton.style.color = "red";
  deleteButton.style.border = "none";
  deleteButton.style.background = "transparent";
  deleteButton.style.cursor = "pointer";
  deleteButton.addEventListener("click", function () {
    map.removeLayer(layer);
    targetDiv.removeChild(container);
  });

  // Verifica se a layer contém linhas ou polígonos
  let hasVector = false;
  if (layer instanceof L.Polyline || layer instanceof L.Polygon) {
    hasVector = true;
  } else if (layer instanceof L.LayerGroup || layer instanceof L.FeatureGroup) {
    layer.eachLayer(function (l) {
      if (l instanceof L.Polyline || l instanceof L.Polygon) {
        hasVector = true;
      }
    });
  }

  let colorPicker;
  if (hasVector) {

    colorPicker = document.createElement("input");
    colorPicker.type = "color";
    colorPicker.value = "#3388ff";
    colorPicker.style.minWidth = "24px";
    colorPicker.style.maxWidth = "24px";
    colorPicker.style.height = "18px";
    colorPicker.style.borderRadius = "6px";
    colorPicker.style.marginRight = "10px";
    colorPicker.style.padding = "0";
    colorPicker.style.border = "none";
    colorPicker.style.background = "none";
    colorPicker.style.cursor = "pointer";
    colorPicker.style.verticalAlign = "middle";

    colorPicker.addEventListener("input", function () {
      if (layer.setStyle) {
        layer.setStyle({ color: colorPicker.value });
      } else if (layer instanceof L.FeatureGroup || layer instanceof L.LayerGroup) {
        layer.eachLayer(function (subLayer) {
          if (subLayer.setStyle) {
            subLayer.setStyle({ color: colorPicker.value });
          }
        });
      }
    });

  }


  // Campo de nome
  var nameInput = document.createElement("input");
  nameInput.type = "text";
  nameInput.value = layerName;
  nameInput.style.border = "none";
  nameInput.style.fontWeight = "bold";
  nameInput.style.outline = "none";
  nameInput.style.background = "transparent";
  nameInput.style.fontSize = "14px";
  nameInput.style.fontFamily = "inherit"; // importante!
  adjustInputWidth(nameInput);

  nameInput.addEventListener("input", function () {
    adjustInputWidth(nameInput);
  });

  // Seletor de ícones (se o layer tiver marcadores)

  let hasMarker = false;
  if (layer instanceof L.CircleMarker) {
    hasMarker = true;
  } else if (layer instanceof L.LayerGroup || layer instanceof L.FeatureGroup) {
    layer.eachLayer(function (l) {
      if (l instanceof L.CircleMarker) {
        hasMarker = true;
      }
    });
  }

  if (hasMarker) {
    const colorPicker = document.createElement("input");
    colorPicker.type = "color";
    colorPicker.value = "#3388ff";
    colorPicker.style.minWidth = "16px";                // largura e altura iguais
    colorPicker.style.maxWidth = "16px";
    colorPicker.style.height = "16px";
    colorPicker.style.borderRadius = "50%";           // borda completamente arredondada
    colorPicker.style.border = "none";      // borda leve para contraste
    colorPicker.style.padding = "0";
    colorPicker.style.marginRight = "14px";
    colorPicker.style.marginLeft = "4px";
    colorPicker.style.cursor = "pointer";
    colorPicker.style.background = "none";
    colorPicker.style.verticalAlign = "middle";

    colorPicker.addEventListener("input", function () {
      const novaCor = colorPicker.value;

      if (layer instanceof L.CircleMarker) {
        layer.setStyle({ color: novaCor, fillColor: novaCor });
      } else if (layer instanceof L.LayerGroup || layer instanceof L.FeatureGroup) {
        layer.eachLayer(function (l) {
          if (l instanceof L.CircleMarker) {
            l.setStyle({ color: novaCor, fillColor: novaCor });
          }
        });
      }
    });

    container.appendChild(colorPicker);
  }
  // Adiciona tudo

  //if (hasMarker) container.appendChild(iconSelect); // Adiciona seletor de ícone se necessário
  if (colorPicker) container.appendChild(colorPicker);
  container.appendChild(nameInput);
  //container.appendChild(totalLayer);
  container.appendChild(checkbox);



  container.appendChild(zoomBtn);


  if (tipoGeometria === "Polygon" || tipoGeometria === "MultiPolygon") {



    // Cria o slider de opacidade
    const opacityInput = document.createElement("input");
    opacityInput.type = "range";
    opacityInput.min = 0;
    opacityInput.max = 1;
    opacityInput.step = 0.1;
    opacityInput.style.width = "60px";
    opacityInput.style.display = "none"; // começa escondido
    opacityInput.title = "Opacidade do preenchimento";

    // Pega a opacidade inicial da camada
    let initialOpacity = 1;
    if (layer.options && layer.options.fillOpacity !== undefined) {
      initialOpacity = layer.options.fillOpacity;
    } else if (layer.eachLayer) {
      layer.eachLayer(function (l) {
        if (l.options && l.options.fillOpacity !== undefined) {
          initialOpacity = l.options.fillOpacity;
        }
      });
    }
    opacityInput.value = initialOpacity;

    // Alterar apenas o fillOpacity
    opacityInput.addEventListener("input", function () {
      const current = layer;
      const val = parseFloat(opacityInput.value);

      if (current.setStyle) {
        current.setStyle({ fillOpacity: val });
      } else if (current.eachLayer) {
        current.eachLayer(function (sub) {
          if (sub.setStyle) {
            sub.setStyle({ fillOpacity: val });
          }
        });
      }
    });

    // Botão para mostrar/ocultar o slider
    const opacityBtn = document.createElement("button");
    opacityBtn.innerHTML = "💧";
    opacityBtn.title = "Ajustar opacidade";
    opacityBtn.style.border = "none";
    opacityBtn.style.background = "transparent";
    opacityBtn.style.cursor = "pointer";
    opacityBtn.style.fontSize = "14px";

    opacityBtn.addEventListener("click", function () {
      opacityInput.style.display =
        opacityInput.style.display === "none" ? "inline-block" : "none";
    });


    container.appendChild(opacityBtn);
    container.appendChild(opacityInput);
  }


  targetDiv.appendChild(container);

  const editBtn = document.createElement("button");
  editBtn.innerHTML = "✏️"; // ícone de lápis
  editBtn.title = "Editar geometria";
  editBtn.style.border = "none";
  editBtn.style.background = "transparent";
  editBtn.style.cursor = "pointer";
  editBtn.style.fontSize = "14px";
  container.appendChild(editBtn);

  let editing = false; // estado do botão

  editBtn.addEventListener("click", function () {
    const current = layer;

    if (!editing) {
      // Inicia edição
      if (current.pm) current.pm.enable();
      editing = true;
      editBtn.style.color = "green"; // opcional: sinal visual
    } else {
      // Finaliza edição
      if (current.pm) current.pm.disable();
      editing = false;
      editBtn.style.color = "black"; // volta à cor original
    }
  });



  // Botão para abrir o modal com informações da geometria
  const geoInfoBtn = document.createElement("button");
  geoInfoBtn.innerHTML = "📍";
  geoInfoBtn.title = "Ver Geometria";
  geoInfoBtn.style.border = "none";
  geoInfoBtn.style.background = "transparent";
  geoInfoBtn.style.cursor = "pointer";
  geoInfoBtn.style.fontSize = "14px";

  geoInfoBtn.addEventListener("click", function () {
    // Atualiza o título do modal
    const modalTitle = document.getElementById("staticBackdropLabel");
    modalTitle.textContent = `Geometria da Camada: ${layerName}`;

    // Atualiza o corpo do modal
    const modalBody = document.getElementById("modalBody");
    // modalBody.innerHTML = ""; // Limpa o conteúdo anterior

    // // Cria o campo de texto com a geometria
    // const geoInput = document.createElement("input");
    // geoInput.readOnly = true;
    // geoInput.type = "text";
    // geoInput.className = "form-control";
    // geoInput.name = "geom";
    // // geoInput.style.fontFamily = "monospace";
    // // geoInput.style.fontSize = "12px";
    // // geoInput.style.resize = "none";
    // // geoInput.style.border = "1px solid #ccc";
    // // geoInput.style.borderRadius = "4px";
    // geoInput.value = JSON.stringify(layer.toGeoJSON().features[0].geometry);

    // modalBody.appendChild(geoInput);


    // HTML completo que inclui o input de geometria + formulário de login
    modalBody.innerHTML = `
  <!-- Formulário -->
  <form id="polygonForm">
    

    <div class="mb-3">
      <label for="title" class="form-label">Título</label>
      <input type="text" class="form-control" id="title" name="title" required maxlength="255">
    </div>
 
    <div class="mb-3">
      <label class="form-label">Conteúdo</label>
      <div id="editor"></div>
      <textarea name="content" id="content" hidden></textarea>
    </div>

    <div class="mb-3">
      <label for="categoria" class="form-label">Categoria</label>
     <select name="categoria" id="categoria" class="form-select">
  <option value="">-- Selecione a categoria --</option>
  <option value="desmatamento">Desmatamento e Perda de Cobertura Vegetal</option>
  <option value="poluicao">Poluição Atmosférica e Industrial</option>
  <option value="enchentes">Enchentes e Inundações</option>
  <option value="ilhas_calor">Ilhas de Calor e Falta de Áreas Verdes</option>
  <option value="erosao_assoreamento">Erosão, Assoreamento e Impacto em Rios</option>
  <option value="urbanizacao">Saneamento e Urbanização Desordenada</option>
  <option value="riscos_geologicos">Riscos Geológicos e Geotécnicos</option>
  <option value="escassez_hidrica">Escassez e Contaminação Hídrica</option>
</select>
 
<div class="mb-3">
      <label for="featured_image" class="form-label">Imagem em Destaque</label>
      <input type="file" class="form-control" id="featured_image" name="featured_image" accept="image/*">
      <div class="form-text">Tamanho máximo: 5MB. Formatos: JPG, PNG, GIF</div>
    </div>


    </div>

    
    <!-- Input de geometria -->
  <input 
    type="hidden" 
    class="form-control mb-3" 
    name="geom" 
    readonly 
    value='${JSON.stringify(layer.toGeoJSON().features[0].geometry)}'
  />
<!-- Mensagem de erro -->
    <div id="polygonMessage" class="mb-3" style="display:none;"></div>
    <button type="button" id="polygonBtn" class="btn btn-success">Salvar</button>
  </form>
`;


// --- Quill JS ---
const toolbarOptions = [
  [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
  ['blockquote', 'code-block'],
  [{ 'direction': 'rtl' }],
  [{ 'align': [] }],
  ['bold', 'italic', 'underline', 'strike'],
  [{ 'color': [] }, { 'background': [] }],
  [{ 'list': 'ordered'}, { 'list': 'bullet' }],
  ['link', 'image', 'video'],
  ['clean']
];

const quill = new Quill('#editor', {
  theme: 'snow',
  placeholder: 'Escreva o conteúdo da postagem...',
  modules: {
    toolbar: {
      container: toolbarOptions,
      handlers: { image: imageHandler }
    },
    imageResize: { displaySize: true }
  }
});

// Função de upload de imagens
async function imageHandler() {
  const input = document.createElement('input');
  input.setAttribute('type', 'file');
  input.setAttribute('accept', 'image/*');
  input.click();

  input.onchange = async () => {
    const file = input.files[0];
    if (!file) return;

    if (file.size > 5 * 1024 * 1024) { alert('Arquivo muito grande. Máx 5MB'); return; }
    if (!['image/jpeg','image/png','image/gif'].includes(file.type)) { alert('Formato inválido'); return; }

    try {
      const formData = new FormData();
      formData.append('image', file);

      const res = await fetch('upload_image.php', { method: 'POST', body: formData });
      if (!res.ok) throw new Error('Falha no upload');
      const data = await res.json();

      if (data.success && data.url) {
        const range = quill.getSelection(true);
        quill.insertEmbed(range.index, 'image', data.url);
        quill.setSelection(range.index + 1);
      } else {
        alert(data.error || 'Erro desconhecido ao enviar imagem');
      }
    } catch (error) {
      console.error('Erro no upload:', error);
      alert('Erro ao enviar imagem. Tente novamente.');
    }
  };
}

// Preparação do formulário antes do envio
function prepareForm() {
  const title = document.getElementById('title').value.trim();
  const content = document.getElementById('content');
  const category = document.getElementById('categoria').value;

  content.value = quill.root.innerHTML.trim();

  if (!title) { alert('O título não pode estar vazio.'); return false; }
  if (content.value === '' || content.value === '<p><br></p>') { alert('O conteúdo não pode estar vazio.'); return false; }
  if (!category) { alert('Selecione uma categoria.'); return false; }

  return true;
}




    // Abre o modal usando Bootstrap
    const modalElement = document.getElementById("staticBackdrop");
    const bootstrapModal = new bootstrap.Modal(modalElement);
    bootstrapModal.show();


    // Adiciona o JS do botão login (não precisa de DOMContentLoaded)
    const form = document.getElementById("polygonForm");
    const btn = document.getElementById("polygonBtn");
    const msgDiv = document.getElementById("polygonMessage");

    btn.addEventListener("click", async () => {
      prepareForm();
      // Cria FormData para enviar arquivos + campos
      const formData = new FormData(form);

      try {
        const response = await fetch("./addPoly.php", {
          method: "POST",
          body: formData // importante: NÃO usar JSON.stringify nem Content-Type
        });

        const result = await response.json();

        msgDiv.style.display = "block";
        msgDiv.className = "mb-3 alert " + (result.success ? "alert-success" : "alert-danger");
        msgDiv.textContent = result.success
          ? "✅ " + result.message
          : "❌ " + result.message;

        if (result.success) {
          setTimeout(() => {
            bootstrapModal.hide();

            // Recarrega a página
            // location.reload();

            // Redireciona para outra página (opcional)
            // window.location.href = "dashboard.php";
          }, 1000);
        }

      } catch (error) {
        msgDiv.style.display = "block";
        msgDiv.className = "mb-3 alert alert-warning";
        msgDiv.textContent = "⚠️ Erro na requisição de salvar";
        console.error(error);
      }
    });
  });


  

  // Botão para abrir o modal com informações da geometria
  const geoEditBtn = document.createElement("button");
  geoEditBtn.innerHTML = "E";
  geoEditBtn.title = "Editar Geometria";
  geoEditBtn.style.border = "none";
  geoEditBtn.style.background = "transparent";
  geoEditBtn.style.cursor = "pointer";
  geoEditBtn.style.fontSize = "14px";

  geoEditBtn.addEventListener("click", function () {
    // Atualiza o título do modal
    const modalTitle = document.getElementById("staticBackdropLabel");
    modalTitle.textContent = `Geometria da Camada: ${layerName}`;

    // Atualiza o corpo do modal
    const modalBody = document.getElementById("modalBody");
    // modalBody.innerHTML = ""; // Limpa o conteúdo anterior

    // // Cria o campo de texto com a geometria
    // const geoInput = document.createElement("input");
    // geoInput.readOnly = true;
    // geoInput.type = "text";
    // geoInput.className = "form-control";
    // geoInput.name = "geom";
    // // geoInput.style.fontFamily = "monospace";
    // // geoInput.style.fontSize = "12px";
    // // geoInput.style.resize = "none";
    // // geoInput.style.border = "1px solid #ccc";
    // // geoInput.style.borderRadius = "4px";
    // geoInput.value = JSON.stringify(layer.toGeoJSON().features[0].geometry);

    // modalBody.appendChild(geoInput);



    // HTML completo que inclui o input de geometria + formulário de login
    modalBody.innerHTML = `
  <!-- Formulário -->
  <form id="polygonEditForm">
    

    <div class="mb-3">
      <label for="title" class="form-label">Título</label>
      <input type="text" class="form-control" id="title" name="title" required maxlength="255">
    </div>
 
    <div class="mb-3">
      <label class="form-label">Conteúdo</label>
      <div id="editor"></div>
      <textarea name="content" id="content" hidden></textarea>
    </div>

    <div class="mb-3">
      <label for="categoria" class="form-label">Categoria</label>
     <select name="categoria" id="categoria" class="form-select">
  <option value="">-- Selecione a categoria --</option>
  <option value="desmatamento">Desmatamento e Perda de Cobertura Vegetal</option>
  <option value="poluicao">Poluição Atmosférica e Industrial</option>
  <option value="enchentes">Enchentes e Inundações</option>
  <option value="ilhas_calor">Ilhas de Calor e Falta de Áreas Verdes</option>
  <option value="erosao_assoreamento">Erosão, Assoreamento e Impacto em Rios</option>
  <option value="urbanizacao">Saneamento e Urbanização Desordenada</option>
  <option value="riscos_geologicos">Riscos Geológicos e Geotécnicos</option>
  <option value="escassez_hidrica">Escassez e Contaminação Hídrica</option>
</select>
 
<div class="mb-3">
      <label for="featured_image" class="form-label">Imagem em Destaque</label>
      <input type="file" class="form-control" id="featured_image" name="featured_image" accept="image/*">
      <div class="form-text">Tamanho máximo: 5MB. Formatos: JPG, PNG, GIF</div>
    </div>


    </div>

    
    <!-- Input de geometria -->
  <input 
    type="hidden" 
    class="form-control mb-3" 
    name="geom" 
    readonly 
    value='${JSON.stringify(layer.toGeoJSON().features[0].geometry)}'
  />
<!-- Mensagem de erro -->
    <div id="polygonEditMessage" class="mb-3" style="display:none;"></div>
    <button type="button" id="polygonEditBtn" class="btn btn-success">Salvar</button>
  </form>
`;


// --- Quill JS ---
const toolbarOptions = [
  [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
  ['blockquote', 'code-block'],
  [{ 'direction': 'rtl' }],
  [{ 'align': [] }],
  ['bold', 'italic', 'underline', 'strike'],
  [{ 'color': [] }, { 'background': [] }],
  [{ 'list': 'ordered'}, { 'list': 'bullet' }],
  ['link', 'image', 'video'],
  ['clean']
];

const quill = new Quill('#editor', {
  theme: 'snow',
  placeholder: 'Escreva o conteúdo da postagem...',
  modules: {
    toolbar: {
      container: toolbarOptions,
      handlers: { image: imageHandler }
    },
    imageResize: { displaySize: true }
  }
});

// Função de upload de imagens
async function imageHandler() {
  const input = document.createElement('input');
  input.setAttribute('type', 'file');
  input.setAttribute('accept', 'image/*');
  input.click();

  input.onchange = async () => {
    const file = input.files[0];
    if (!file) return;

    if (file.size > 5 * 1024 * 1024) { alert('Arquivo muito grande. Máx 5MB'); return; }
    if (!['image/jpeg','image/png','image/gif'].includes(file.type)) { alert('Formato inválido'); return; }

    try {
      const formData = new FormData();
      formData.append('image', file);

      const res = await fetch('upload_image.php', { method: 'POST', body: formData });
      if (!res.ok) throw new Error('Falha no upload');
      const data = await res.json();

      if (data.success && data.url) {
        const range = quill.getSelection(true);
        quill.insertEmbed(range.index, 'image', data.url);
        quill.setSelection(range.index + 1);
      } else {
        alert(data.error || 'Erro desconhecido ao enviar imagem');
      }
    } catch (error) {
      console.error('Erro no upload:', error);
      alert('Erro ao enviar imagem. Tente novamente.');
    }
  };
}

// Preparação do formulário antes do envio
function prepareForm() {
  const title = document.getElementById('title').value.trim();
  const content = document.getElementById('content');
  const category = document.getElementById('categoria').value;

  content.value = quill.root.innerHTML.trim();

  if (!title) { alert('O título não pode estar vazio.'); return false; }
  if (content.value === '' || content.value === '<p><br></p>') { alert('O conteúdo não pode estar vazio.'); return false; }
  if (!category) { alert('Selecione uma categoria.'); return false; }

  return true;
}




    // Abre o modal usando Bootstrap
    const modalElement = document.getElementById("staticBackdrop");
    const bootstrapModal = new bootstrap.Modal(modalElement);
    bootstrapModal.show();


    // Adiciona o JS do botão login (não precisa de DOMContentLoaded)
    const form = document.getElementById("polygonEditForm");
    const btn = document.getElementById("polygonEditBtn");
    const msgDiv = document.getElementById("polygonEditMessage");

    btn.addEventListener("click", async () => {
      prepareForm();
      // Cria FormData para enviar arquivos + campos
      const formData = new FormData(form);

      try {
        const response = await fetch("./addEditPoly.php", {
          method: "POST",
          body: formData // importante: NÃO usar JSON.stringify nem Content-Type
        });

        const result = await response.json();

        msgDiv.style.display = "block";
        msgDiv.className = "mb-3 alert " + (result.success ? "alert-success" : "alert-danger");
        msgDiv.textContent = result.success
          ? "✅ " + result.message
          : "❌ " + result.message;

        if (result.success) {
          setTimeout(() => {
            bootstrapModal.hide();

            // Recarrega a página
            // location.reload();

            // Redireciona para outra página (opcional)
            // window.location.href = "dashboard.php";
          }, 1000);
        }

      } catch (error) {
        msgDiv.style.display = "block";
        msgDiv.className = "mb-3 alert alert-warning";
        msgDiv.textContent = "⚠️ Erro na requisição de salvar";
        console.error(error);
      }
    });
  });

  
  container.appendChild(geoEditBtn);
  container.appendChild(geoInfoBtn);
  container.appendChild(deleteButton);

}
