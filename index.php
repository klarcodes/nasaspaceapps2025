<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Leaflet CSS e JS -->

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <!-- Leaflet Layer Tree -->

    <link rel="stylesheet" href="./leaflet/controlLayer.css" />
    <script src="./leaflet/controlLayer.js"></script>

    <!-- Bootstrap CSS e JS -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <!-- <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet"> -->


    <link rel="stylesheet" href="./leaflet/leaflet-sidebar.css" />

    <script src="./leaflet/leaflet-sidebar.js"></script>

      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Leaflet Draw -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css"/>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>

    <!-- Turf -->

    <script src="https://cdn.jsdelivr.net/npm/@turf/turf@6/turf.min.js"></script>

    <!-- Leaflet PM -->

    <link rel="stylesheet" href="https://unpkg.com/leaflet.pm@latest/dist/leaflet.pm.css" />

    <script src="https://unpkg.com/leaflet.pm@latest/dist/leaflet.pm.min.js"></script>
  
  <!-- Quill CSS -->
  <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
  <style>
    #editor {
      height: 400px;
      background-color: #fff;
    }
    .ql-editor img {
      max-width: 100%;
    }

        .lorem {
            font-style: italic;
            text-align: justify;
            color: #AAA;
        }
    </style>


</head>
<body>
    

    <div id="map" style="width: 100%; height: 100vh;"></div>

    <?php include 'sideBar.php'; ?>

    <?php include 'modalPopup.php'; ?>

    <script src="mapa.js"></script>

    <script src="icones.js"></script>

    <script src="desenhoVetores.js"></script>

    <script src="legendaLayerVetor.js"></script>

    <script src="addRemoveMapa.js"></script>

    <script src="nasaCamadas.js"></script>

    <script src="baseCartografica.js"></script>

    <script src="areasInstitucionais.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

    
<!-- Quill Scripts -->
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/quill-image-resize-module@3.0.0/image-resize.min.js"></script>

<script>

  // // Configuração da barra de ferramentas
  // const toolbarOptions = [
  //   [{ 'header': [1, 2, 3, 4, 5, 6, false] }],

  //   ['blockquote', 'code-block'],

  //       // Alinhamento e direção
  //   [{ 'direction': 'rtl' }],
  //   [{ 'align': [] }],
  //   ['bold', 'italic', 'underline', 'strike'],

  //   [{ 'color': [] }, { 'background': [] }],
  //   [{ 'list': 'ordered'}, { 'list': 'bullet' }],
  //   ['link', 'image', 'video'],
  //   ['clean']
  // ];

  // // Inicialização do Quill com módulo de redimensionamento
  // const quill = new Quill('#editor', {
  //   theme: 'snow',
  //   placeholder: 'Escreva o conteúdo da postagem...',
  //   modules: {
  //     toolbar: {
  //       container: toolbarOptions,
  //       handlers: {
  //         image: imageHandler
  //       }
  //     },
  //     imageResize: {
  //       displaySize: true
  //     }
  //   }
  // });

  // // Função para upload de imagens
  // async function imageHandler() {
  //   const input = document.createElement('input');
  //   input.setAttribute('type', 'file');
  //   input.setAttribute('accept', 'image/*');
  //   input.click();

  //   input.onchange = async () => {
  //     const file = input.files[0];
  //     if (!file) return;

  //     // Verificação básica do arquivo
  //     if (file.size > 5 * 1024 * 1024) {
  //       alert('O arquivo é muito grande. Tamanho máximo: 5MB');
  //       return;
  //     }

  //     const validTypes = ['image/jpeg', 'image/png', 'image/gif'];
  //     if (!validTypes.includes(file.type)) {
  //       alert('Formato de arquivo inválido. Use JPG, PNG ou GIF');
  //       return;
  //     }

  //     try {
  //       const formData = new FormData();
  //       formData.append('image', file);

  //       const res = await fetch('upload_image.php', {
  //         method: 'POST',
  //         body: formData
  //       });

  //       if (!res.ok) throw new Error('Falha no upload');

  //       const data = await res.json();

  //       if (data.success && data.url) {
  //         const range = quill.getSelection(true);
  //         quill.insertEmbed(range.index, 'image', data.url);
  //         quill.setSelection(range.index + 1);
  //       } else {
  //         alert(data.error || 'Erro desconhecido ao enviar imagem');
  //       }
  //     } catch (error) {
  //       console.error('Erro no upload:', error);
  //       alert('Erro ao enviar imagem. Por favor, tente novamente.');
  //     }
  //   };
  // }

  // // Preparação do formulário antes do envio
  // function prepareForm() {
  //   const title = document.getElementById('title').value.trim();
  //   const content = document.getElementById('content');
  //   const category = document.getElementById('category').value;
    
  //   // Salva o conteúdo HTML do editor
  //   content.value = quill.root.innerHTML.trim();

  //   // Validações
  //   if (!title) {
  //     alert('O título não pode estar vazio.');
  //     return false;
  //   }

  //   if (content.value === '' || content.value === '<p><br></p>') {
  //     alert('O conteúdo da postagem não pode estar vazio.');
  //     return false;
  //   }

  //   if (!category) {
  //     alert('Selecione uma categoria.');
  //     return false;
  //   }

  //   return true;
  // }

  
</script>




<script>
document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("loginForm");
  const btn = document.getElementById("loginBtn");
  const msgDiv = document.getElementById("loginMessage");

  btn.addEventListener("click", async () => {
    const data = {
      email: form.email.value,
      password: form.password.value
    };

    try {
      const response = await fetch("./login.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(data)
      });

      const result = await response.json();

      msgDiv.style.display = "block";
      msgDiv.className = "mb-3 alert " + (result.success ? "alert-success" : "alert-danger");
      msgDiv.textContent = result.success
        ? "✅ " + result.message
        : "❌ " + result.message;

      if (result.success) {
        setTimeout(() => {
          const modal = bootstrap.Modal.getInstance(document.getElementById("loginModal"));
          modal.hide();

          //Recarrega a página
          location.reload();

            // Redireciona para outra página
            // window.location.href = "dashboard.php"; // coloque a página desejada aqui
        }, 1000);
      }

    } catch (error) {
      msgDiv.style.display = "block";
      msgDiv.className = "mb-3 alert alert-warning";
      msgDiv.textContent = "⚠️ Erro na requisição de login";
      console.error(error);
    }
  });
});

</script>



</body>
</html>