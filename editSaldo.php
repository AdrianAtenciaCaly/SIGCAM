<head>
  <meta charset="utf-8">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="boos"></script>
  <script src="libs/js/datepicker.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script type="text/javascript">
    $(function() {
      $("#miModal").modal();
    });
  </script>
</head>
<?php
$page_title = 'Editar Saldo';
require_once('includes/load.php');
if (!$session->isUserLoggedIn(true)) {
  redirect('index', false);
}
$initialBalance = initialBalance('initial_balance');

$id =  $initialBalance['idinitial_balance'];

?>
<?php include_once('layouts/header.php'); ?>
<?php

?>
<div class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">A tener el cuenta!</h4>
      </div>
      <div class="panel-body">
        <p>Para realizar el cambio del saldo en caja es necesario confimarcion de usuario y contraseña.</p>
        <button class="btn btn-default" data-dismiss="modal" type="button">Close</button>
      </div>

    </div>
  </div>
</div>
</div>
<div class="row">
  <div class="col-md-12">
    <?php echo displayMSG($msg); ?>
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
          <span class="glyphicon glyphicon-edit"></span>
          <span>Editar Saldo</span>
        </div>
        <div class="panel-body">
          <form method="post" action="authConfirmation.php" class="clearfix">
            <div class="form-group">
              <label for="saldo" class="control-label">Saldo en caja actual</label>
              <input type="number" disabled class="form-control" name="saldo" value="<?php echo $initialBalance['balance']; ?>">
            </div>
            <div class="form-group">
              <label for="text" class="control-label">Fecha de actualizacion</label>
              <input type="text" disabled class="form-control" name="saldo" value="<?php echo $initialBalance['lastUpdate']; ?>">
            </div>
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-heading clearfix">
                  <span class="glyphicon glyphicon-edit"></span>
                  <span>NUEVO SALDO</span>
                </div>
                <div class="panel-body">
                  <div class="form-group">
                    <label for="username" class="control-label">Nuevo saldo</label>
                    <input type="number" autocomplete="off" class="form-control" name="saldoNuevo" required>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-heading clearfix">
                  <span class="glyphicon glyphicon-edit"></span>
                  <span>CONFIRMACIÓN</span>
                </div>
                <div class="panel-body">
                  <div class="form-group">
                    <label for="username" class="control-label">Usuario</label>
                    <input type="text" class="form-control" name="usuario" required>
                  </div>
                  <div class="form-group">
                    <label for="username" class="control-label">Contraseña de la cuenta</label>
                    <input type="text" class="form-control" name="password" required>
                  </div>
                  <div class="form-group clearfix">
                    <button type="submit" name="update" class="btn btn-info">Actualizar</button>

                  </div>
                </div>
              </div>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>

  <?php include_once('layouts/footer.php'); ?>