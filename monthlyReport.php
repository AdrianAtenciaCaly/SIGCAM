<?php
$page_title = 'Reporte por mes y año';
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
        <h2>Seleccione un mes y año</h2>
      </div>
      <div class="panel-body">
        <form class="clearfix" method="post" action="generateReportMonth">
          <div class="form-group">
            <label class="form-label">Seleccione un mes</label>
            <div class="input-group">

              <select class="form-control" id="months" name="months" required>
                <option value="">Selecciona mes</option>
                <option value="01">ENERO</option>
                <option value="02">FEBRERO</option>
                <option value="03 ">MARZO</option>
                <option value="04">ABRIL</option>
                <option value="05">MAYO</option>
                <option value="06">JUNIO</option>
                <option value="07">JULIO</option>
                <option value="08">AGOSTO</option>
                <option value="09">SEPTIEMBRE</option>
                <option value="10">OCTUBRE</option>
                <option value="11">NOVIEMBRE</option>
                <option value="12">DICIEMBRE</option>

              </select>


              <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
              </span>
            </div>
          </div>

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