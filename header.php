
    <header class="container">
<nav class="navbar navbar-expand-lg navbar-light navbar-fixed-top">
  <a class="navbar-brand" href="./index.php">WhereIsMyPet</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto justify-content-center">
      <li class="nav-item">
        <a class="nav-link" href="./index.php">Inicio</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./buscar.php">Busca a tu mascota</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./animales.php">Animales</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Sobre nosotros</a>
      </li>
      <?php if($_SESSION['rol']!='visitante'){?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="userpage.php" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?php
				$user = json_decode($_SESSION['usuario']);	
        echo $user->username;
 				?>
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown2">
            <a class="dropdown-item" href="#">Preferencias</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Cerrar Sesión</a>
          </div>
        </li><?php }else{?>
                          <a class="nav-link" href="session.php">Sign in/Login</a>
                            <?php }?>
    </ul>
  </div>
</nav>
</header>