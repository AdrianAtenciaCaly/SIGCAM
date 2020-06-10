<?php $user = current_user();
confZonaHoraria();
$tipo = page_require_tipo($user['tipo']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>SIGCAM
  </title>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" />
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
  <link rel="stylesheet" href="libs/css/main.css" />
  <link rel="icon" href="img/assets/favicon.ico">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="libs/js/datepicker.js"></script>

</head>

<body>
  <?php if ($session->isUserLoggedIn(true)) : ?>
    <header id="header">
      <div class="logo pull-left">
        SIGCAM
        <!--<img src="img/SIGCAM.PNG">-->
      </div>
      <div class="header-content">
        <div class="header-date pull-left">
          <strong> <?php echo fechaC(); ?></strong>
        </div>
        <div class="pull-right clearfix">
          <ul class="info-menu list-inline list-unstyled">
            <li class="profile">
              <a href="#" data-toggle="dropdown" class="toggle" aria-expanded="false">
                <img src="uploads/users/<?php echo $user['image']; ?>" alt="user-image" class="img-circle img-inline">
                <span><?php echo  "Usted es: " . removeJunk(ucfirst($user['name'])); ?> <i class="caret"></i></span>
              </a>
              <ul class="dropdown-menu">
                <li>
                  <a href="profile?id=<?php echo (int) $user['id'];
                                      ?>">
                    <i class="glyphicon glyphicon-user"></i>
                    Perfil
                  </a>
                </li>
                <li>
                  <a href="edit_account.php" title="edit account">
                    <i class="glyphicon glyphicon-cog"></i>
                    Configuración cuenta
                  </a>
                </li>
                <?php
                if ($tipo['tipo'] === 'ADMINISTRADOR') {
                ?>
                  <li>
                    <a href="editSaldo" title="edit account">
                      <i class="glyphicon glyphicon-cog"></i>
                      Configuración Saldo
                    </a>
                  </li>
                <?php
                }
                ?>

                <li class="last">
                  <a href="logout">
                    <i class="glyphicon glyphicon-off"></i>
                    Salir
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </header>
    <div class="sidebar">
      <?php //if ($user['user_level'] === '1') : 
      ?>
      <!-- admin menu -->
      <?php include_once('admin_menu.php'); ?>

      <?php //elseif ($user['user_level'] === '2') : 
      ?>
      <!-- Special user -->
      <?php //include_once('special_menu.php'); 
      ?>

      <?php //elseif ($user['user_level'] === '3') : 
      ?>
      <!-- User menu -->
      <?php // include_once('user_menu.php'); 
      ?>

      <?php //endif; 
      ?>

    </div>
  <?php endif; ?>

  <div class="page">
    <div class="container-fluid">