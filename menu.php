    <header id="header" class="">
      <div class="img-topo"></div>

      <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top" id="menu-principal">
        <div class="container">
          <!-- <a class="navbar-brand" href="#">Navbar</a> -->
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#conteudoNavbarSuportado" aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="col-md-3 text-center" id="logo-menu">
            <a href="index.php">
              <figure>
                <img src="./assets/img/logo.png" class="img-fluid" width="213" alt="Logo" title="Logo Grécia Burger">

              </figure>
            </a>
          </div>
          <div class="collapse navbar-collapse col-md-9 offset-3 menu-principal" id="conteudoNavbarSuportado">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item active">
                <a class="nav-link " href="index.php#titulo-cardapio">CARDÁPIO <span class="sr-only">(página atual)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="sobre.php">SOBRE</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="entregas.php">ENTREGAS</a>
              </li>
              <li class="nav-item">
                <a class="nav-link scroll" href="#contato">CONTATO</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#" id="menu-meu-pedido" data-toggle="modal" data-target="#modalFinaliza">MEU PEDIDO</a>
              </li>
              <li class="nav-item">
                <a class="nav-link bag-pedido" href="#" data-toggle="modal" data-target="#modalFinaliza">
                  <i class="fas fa-shopping-bag"></i>
                  <span class="badge badge-pill badge-danger num-pedidos">
                    <?= isset($_SESSION['compras']) ? count($_SESSION['compras']) : 0 ?>
                  </span>
                </a>
              </li>
              <?php
              if (isset($_SESSION['perfil'])) {
              ?>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span data-toggle="tooltip" title="<?= $_SESSION['nome'];  ?>"><?= substr(strtoupper($_SESSION['nome']), 0, 7); ?>...</span>
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="perfil.php">MEU PERFIL</a>
                    <a class="dropdown-item" href="acompanhar.php">ACOMPANHAR</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="logout.php">SAIR</a>
                  </div>
                </li>
              <?php } else { ?>
                <li class="nav-item menu-login">
                  <a class="nav-link" href="login.php">LOGIN</a>
                </li>
              <?php } ?>
            </ul>
          </div>
        </div>
      </nav>
    </header><!-- /header -->