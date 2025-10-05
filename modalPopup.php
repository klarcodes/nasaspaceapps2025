<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
  Launch static backdrop modal
</button> -->


<style>
  /* Ajusta o tamanho do modal */
  #tutorialModal .modal-dialog {
    width: 70vw; /* 70% da largura da tela */
    max-width: 70vw; /* impede o aumento automático */
    height: 70vh; /* 70% da altura da tela */
    max-height: 70vh;
  }

  #tutorialModal .modal-content {
    height: 100%; /* faz o conteúdo ocupar toda a altura */
  }

  #tutorialModal .modal-body {
    overflow-y: auto; /* rolagem vertical se necessário */
  }

  /* Justifica o texto e adiciona recuo na primeira linha */
  #tutorialModal p {
    text-align: justify;
    text-indent: 1.25em; /* recuo da primeira linha */
    margin-bottom: 1em; /* espaçamento entre parágrafos */
  }

    /* Justifica o texto e adiciona recuo na primeira linha */
  #tutorialModal img {
    width: 90%; /* 70% da largura da tela */
      display: block;
  margin-left: auto;
  margin-right: auto;
  }
</style>


<!-- Modal Geral -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" style="z-index: 1000000000;">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel"></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="modalBody"></div>
    </div>
  </div>
</div>


<div class="modal fade" id="geoModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="geoModalLabel" aria-hidden="true" style="z-index: 1000000000;">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="geoModalLabel">Geometria da Camada</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="geoModalBody">
        <!-- O campo de texto será adicionado dinamicamente aqui -->
      </div>
    </div>
  </div>
</div>



<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="loginModalLabel">Login</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="loginForm">

         <!-- Mensagem de erro -->
          <div id="loginMessage" class="mb-3" style="display:none;">
            <!-- Aqui vai aparecer a mensagem -->
          </div>

          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control" id="email" name="email" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
          </div>
          <button type="button" id="loginBtn" class="btn btn-success">Login</button>
        </form>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="tutorialModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="tutorialModalLabel" aria-hidden="true" style="z-index: 1000000000;">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="tutorialModalLabel">Tutorial</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="tutorialModalBody">
          <!-- Nav tabs -->
          <ul class="nav nav-tabs nav-tabs-bordered d-flex" id="sidebarTab" role="tablist">
            <li class="nav-item flex-fill" role="presentation">
              <button class="nav-link w-100 active" id="sidebar-tab-0" data-bs-toggle="tab" data-bs-target="#sidebar-tabpanel-0" type="button" role="tab" aria-controls="sidebar-tabpanel-0" aria-selected="true">
                About the System
              </button>
            </li>
            <li class="nav-item flex-fill" role="presentation">
              <button class="nav-link w-100" id="sidebar-tab-1" data-bs-toggle="tab" data-bs-target="#sidebar-tabpanel-1" type="button" role="tab" aria-controls="sidebar-tabpanel-1" aria-selected="false">
                Data Query
              </button>
            </li>
            <li class="nav-item flex-fill" role="presentation">
              <button class="nav-link w-100" id="sidebar-tab-2" data-bs-toggle="tab" data-bs-target="#sidebar-tabpanel-2" type="button" role="tab" aria-controls="sidebar-tabpanel-2" aria-selected="false">
                Login
              </button>
            </li>
            <li class="nav-item flex-fill" role="presentation">
              <button class="nav-link w-100" id="sidebar-tab-3" data-bs-toggle="tab" data-bs-target="#sidebar-tabpanel-3" type="button" role="tab" aria-controls="sidebar-tabpanel-3" aria-selected="false">
                Polygon Addition
              </button>
            </li>
            <li class="nav-item flex-fill" role="presentation">
              <button class="nav-link w-100" id="sidebar-tab-4" data-bs-toggle="tab" data-bs-target="#sidebar-tabpanel-4" type="button" role="tab" aria-controls="sidebar-tabpanel-4" aria-selected="false">
                Polygon Edit
              </button>
            </li>
          </ul>

          <!-- Tab panes -->
          <div class="tab-content pt-3" id="sidebarTabContent">

            <div class="tab-pane fade show active" id="sidebar-tabpanel-0" role="tabpanel" aria-labelledby="sidebar-tab-0">
              <ul class="sidebar-nav" id="sidebar-nav-0">
                <p>The environmental mapping system developed in Leaflet was designed to enable the visualization, analysis, and editing of geospatial information directly within an interactive web environment. It combines conventional map layers, scientific data from NASA GIBS, and an advanced module for the registration and management of vector geometries, allowing the creation and storage of polygons, lines, or points in a PostGIS spatial database.</p>
              </ul>
            </div>

            <div class="tab-pane fade" id="sidebar-tabpanel-1" role="tabpanel" aria-labelledby="sidebar-tab-1">
              <ul class="sidebar-nav" id="sidebar-nav-1">
                <p>The main interface of the system consists of an interactive map and a sidebar panel that organizes different groups of layers. The user can switch between base maps, such as OpenStreetMap, Google Satellite, or Google Terrain, and activate specialized layer sets, such as environmental monitoring layers provided by NASA. These layers allow the visualization of vegetation, urban areas, water bodies, and environmental indices, updated through the GIBS (Global Imagery Browse Services) platform.</p>

                <img src="./imagens/mapa1.png" alt="">
              </ul>
            </div>

            <div class="tab-pane fade" id="sidebar-tabpanel-2" role="tabpanel" aria-labelledby="sidebar-tab-2">
              <ul class="sidebar-nav" id="sidebar-nav-2">
                <p>To access the functionalities related to polygon manipulation and drawing, the user must log in with an email and password. This authentication is performed in a simple way through the sidebar menu, in the user tab, where there is a button that opens a login modal.</p>
                <img src="./imagens/mapa4.png" alt="">
                <p>After login, the interface automatically adapts: the user tab starts displaying the logged-in account information and a logout button, in addition to unlocking new tabs in the sidebar menu, such as the polygon registration and editing options.</p>
                <img src="./imagens/mapa5.png" alt="">
              </ul>
            </div>

            <div class="tab-pane fade" id="sidebar-tabpanel-3" role="tabpanel" aria-labelledby="sidebar-tab-3">
              <ul class="sidebar-nav" id="sidebar-nav-3">
                <p>Once a vector is drawn, the system automatically creates a visual reference in the sidebar panel. Each geometry is listed with individual control options, allowing the user to change the border color, adjust fill opacity, zoom directly to the layer, toggle visibility on the map, or delete the vector. This interface ensures that users can manage each element easily and efficiently, without the need to navigate through complex menus.</p>
                <img src="./imagens/mapa2.png" alt="">
                <p>When clicking the save icon, the system opens a form in a modal where the user can fill in descriptive information about the geometry — such as the title, content, category, and featured image. These data are then associated with the drawn geometry, forming a complete set of spatial and descriptive information. When pressing the save button, this record is saved in the PostGIS database, and the record is displayed in the system.</p>
                <img src="./imagens/mapa3.png" alt="">
              </ul>
            </div>

            <div class="tab-pane fade" id="sidebar-tabpanel-4" role="tabpanel" aria-labelledby="sidebar-tab-4">
              <ul class="sidebar-nav" id="sidebar-nav-4">
                <p>With authenticated access, the user can fully edit the registered polygons. The button with the pencil icon allows changing the size or shape of the polygon directly on the map, and the modification is applied when the button is clicked again.</p>
                <img src="./imagens/mapa6.png" alt="">
                <p>There is another button that opens a specific modal for editing the information associated with the vector, ensuring full control over both the data and the geometry.</p>
                <img src="./imagens/mapa7.png" alt="">
              </ul>
            </div>
            
          </div>


 
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function () {
    $('#tutorialModal').modal('show');
  });
</script>