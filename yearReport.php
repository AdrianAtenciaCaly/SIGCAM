<?php
$page_title = 'Reporte por año';
require_once('includes/load.php');
if (!$session->isUserLoggedIn(true)) {
  redirect('index', false);
}
?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-6">
    <?php echo displayMSG($msg); ?>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="panel">
      <div class="panel-heading">
        <h2>Seleccione un año </h2>
      </div>
      <div class="panel-body">
        <form class="clearfix" method="post" action="generateReportYear.php">


          <div class="form-group">
            <label class="form-label">Seleccione un Año</label>
            <div class="input-group">
              <?php
              echo "<select class='form-control' id='years' name='years' required>";
              echo "<option value=''>Selecciona Año</option>";
              for ($i = 2010; $i <= date("Y"); $i++) {
                echo "<option value='" . $i . "'>" . $i . "</option>";
              }
              echo "</select>";
              ?>
              <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
              </span>
            </div>
          </div>

          <div class="form-group">
            <button type="submit" name="submit" class="btn btn-primary">Generar Reporte</button>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>
<?php include_once('layouts/footer.php'); ?>