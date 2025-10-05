<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
  Launch static backdrop modal
</button> -->

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
              <button class="nav-link w-100 active" id="sidebar-tab-0" data-bs-toggle="tab" data-bs-target="#sidebar-tabpanel-0" type="button" role="tab" aria-controls="sidebar-tabpanel-0" aria-selected="true" onclick="mudarPagina('mapaMain')">
                Informação
              </button>
            </li>
            <li class="nav-item flex-fill" role="presentation">
              <button class="nav-link w-100" id="sidebar-tab-1" data-bs-toggle="tab" data-bs-target="#sidebar-tabpanel-1" type="button" role="tab" aria-controls="sidebar-tabpanel-1" aria-selected="false">
                Tutorial
              </button>
            </li>
            <li class="nav-item flex-fill" role="presentation">
              <button class="nav-link w-100" id="sidebar-tab-2" data-bs-toggle="tab" data-bs-target="#sidebar-tabpanel-2" type="button" role="tab" aria-controls="sidebar-tabpanel-2" aria-selected="false">
                Tutorial
              </button>
            </li>
            <li class="nav-item flex-fill" role="presentation">
              <button class="nav-link w-100" id="sidebar-tab-3" data-bs-toggle="tab" data-bs-target="#sidebar-tabpanel-3" type="button" role="tab" aria-controls="sidebar-tabpanel-3" aria-selected="false" onclick="mudarPagina('legenda')">
                Tutorial
              </button>
            </li>
            <!-- <li class="nav-item flex-fill" role="presentation">
              <button class="nav-link w-100" id="sidebar-tab-4" data-bs-toggle="tab" data-bs-target="#sidebar-tabpanel-4" type="button" role="tab" aria-controls="sidebar-tabpanel-4" aria-selected="false" onclick="mudarPagina('legenda')">
                Vídeo Aulas
              </button>
            </li> -->
          </ul>

          <!-- Tab panes -->
          <div class="tab-content pt-3" id="sidebarTabContent">

            <div class="tab-pane fade show active" id="sidebar-tabpanel-0" role="tabpanel" aria-labelledby="sidebar-tab-0">
              <ul class="sidebar-nav" id="sidebar-nav-0">

              </ul>
            </div>

            <div class="tab-pane fade" id="sidebar-tabpanel-1" role="tabpanel" aria-labelledby="sidebar-tab-1">

              <ul class="sidebar-nav" id="sidebar-nav-1">

              </ul>

            </div>

            <div class="tab-pane fade" id="sidebar-tabpanel-2" role="tabpanel" aria-labelledby="sidebar-tab-2">

            </div>

            <div class="tab-pane fade" id="sidebar-tabpanel-3" role="tabpanel" aria-labelledby="sidebar-tab-3">
              <ul class="sidebar-nav" id="sidebar-nav-3">

              </ul>
            </div>

            <div class="tab-pane fade" id="sidebar-tabpanel-4" role="tabpanel" aria-labelledby="sidebar-tab-4">
              <ul class="sidebar-nav" id="sidebar-nav-4">

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