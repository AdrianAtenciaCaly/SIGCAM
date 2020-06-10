<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="icon" href="img/assets/favicon.ico">
  <link href="css/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="css/bootstrap-3.3.7-dist/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />

  <title>SIGCMA</title>
</head>
<?php
ob_start();
require_once('includes/load.php');
if ($session->isUserLoggedIn(true)) {
  redirect('home', false);
}
?>

<div class="container">
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <div class="page-header text-center">

        <img src="img/logo.jpeg">
      </div>
      <div class="alert alert-info text-center">
        Bienvenidos al sistema de caja (SIGCAM)
      </div>
      <div class="panel panel-default">
        <div class="panel-heading text-center">
          Ingrese sus credenciales para acceder
        </div>
        <div class="panel-body">
          <?php echo displayMSG($msg); ?>
          <form method="post" action="auth.php" role="form" id="formLogin" class="form-horizontal">
            <div class="form-group">
              <label for="usuario" class="col-md-2 control-label">Usuario</label>
              <div class="input-group">
                <span class="input-group-addon">
                  <span class="glyphicon  glyphicon-user"></span>
                </span>
                <input type="text" id="usuario" name="username" class="form-control" required>
              </div>
            </div>
            <div class="form-group">
              <label for="clave" class="col-md-2 control-label">Clave</label>
              <div class="input-group">
                <span class="input-group-addon">
                  <span class="glyphicon  glyphicon-lock"></span>
                </span>
                <input type="password" id="password" name="password" id="clave" class="form-control" required>

              </div>
              <div class="input-group-addon">
                <label>
                  <input id="show_password" type="checkbox" /> Mostrar contraseña </label>
              </div>

            </div>
            <div class="form-group">
              <div class="col-md-offset-2 col-md-10 text-right">
                <button type="submit" id="btn_submit" class="btn btn-info">Acceder</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include_once('layouts/footer.php'); ?>

<script>
  $('#show_password').on('change', function(event) {
    // Si el checkbox esta "checkeado"
    if ($('#show_password').is(':checked')) {
      // Convertimos el input de contraseña a texto.
      $('#password').get(0).type = 'text';
      // En caso contrario..
    } else {
      // Lo convertimos a contraseña.
      $('#password').get(0).type = 'password';
    }
  });
</script>