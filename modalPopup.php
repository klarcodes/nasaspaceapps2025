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
                <p>O sistema de mapeamento ambiental desenvolvido em Leaflet foi projetado para permitir a visualização, análise e edição de informações geoespaciais diretamente em um ambiente web interativo. Ele combina camadas de mapas convencionais, dados científicos provenientes da NASA GIBS, e um módulo avançado de cadastro e gerenciamento de geometrias vetoriais, que possibilita a criação e armazenamento de polígonos, linhas ou pontos em um banco de dados espacial PostGIS.</p>
              </ul>
            </div>

            <div class="tab-pane fade" id="sidebar-tabpanel-1" role="tabpanel" aria-labelledby="sidebar-tab-1">
              <ul class="sidebar-nav" id="sidebar-nav-1">
                <p>A interface principal do sistema é composta por um mapa interativo e um painel lateral (sidebar) que organiza os diferentes grupos de camadas. O usuário pode alternar entre mapas base, como OpenStreetMap, Google Satellite ou Google Terrain, e ativar conjuntos de camadas especializadas, como as de monitoramento ambiental fornecidas pela NASA. Essas camadas permitem visualizar informações de vegetação, ocupação urbana, corpos d’água e índices ambientais atualizados via serviço GIBS (Global Imagery Browse Services).</p>

                <img src="./imagens/mapa1.png" alt="">
              </ul>
            </div>

            <div class="tab-pane fade" id="sidebar-tabpanel-2" role="tabpanel" aria-labelledby="sidebar-tab-2">
              <ul class="sidebar-nav" id="sidebar-nav-2">
                <p>Para acessar as funcionalidades relacionadas à manipulação e ao desenho de polígonos, é necessário que o usuário realize login com e-mail e senha. Essa autenticação é feita de forma simples, por meio do menu lateral, na aba de usuário, onde há um botão que abre um modal de login.</p>
                <img src="./imagens/mapa4.png" alt="">
                <p>Após o login, a interface se adapta automaticamente: a aba de usuário passa a exibir as informações da conta logada e um botão de logout, além de liberar novas abas no menu lateral, como as opções de cadastro e edição de polígonos.</p>
                <img src="./imagens/mapa5.png" alt="">
              </ul>
            </div>

            <div class="tab-pane fade" id="sidebar-tabpanel-3" role="tabpanel" aria-labelledby="sidebar-tab-3">
              <ul class="sidebar-nav" id="sidebar-nav-3">
                <p>No módulo “Cadastrar Geometria” (que requer login de usuário), é voltado para a criação de vetores personalizados que representam áreas de interesse ambiental, zonas de risco ou qualquer outro tipo de informação espacial relevante. Esse módulo é responsável por adicionar desenho e edição de vetores diretamente sobre o mapa. Assim, o usuário pode desenhar polígonos, linhas ou marcadores e ajustar conforme necessário.</p>
                <p>Uma vez desenhado um vetor, o sistema cria automaticamente uma referência visual no painel lateral. Cada geometria aparece listada com opções individuais de controle, permitindo mudar a cor da borda, ajustar a opacidade do preenchimento, aplicar zoom diretamente na camada, alternar a visibilidade no mapa ou excluir o vetor. Essa interface garante que o usuário possa manipular cada elemento de forma prática e organizada, sem a necessidade de recorrer a menus complexos.</p>
                <img src="./imagens/mapa2.png" alt="">
                <p>Ao clicar no ícone de salvar, o sistema abre um formulário em um modal, no qual o usuário pode preencher informações descritivas sobre a geometria — como o título, conteúdo, categoria e imagem em destaque. Esses dados são então associados à geometria desenhada, formando um conjunto completo de informações espaciais e descritivas. Ao apertar no botão salvar, esse registro é salvo no banco de dados Postgis o registro é mostrado no sistema.</p>
                <img src="./imagens/mapa3.png" alt="">
              </ul>
            </div>

            <div class="tab-pane fade" id="sidebar-tabpanel-4" role="tabpanel" aria-labelledby="sidebar-tab-4">
              <ul class="sidebar-nav" id="sidebar-nav-4">
                <p>Com acesso autenticado, o usuário pode editar os polígonos cadastrados de forma completa. O botão com o ícone de lápis permite alterar o tamanho ou formato do polígono diretamente no mapa, que é efetivada a alteração quando clicado novamente.</p>
                <img src="./imagens/mapa6.png" alt="">
                <p>Existe outro botão que abre um modal específico para edição das informações associadas ao vetor, garantindo controle total sobre os dados e a geometria.</p>
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