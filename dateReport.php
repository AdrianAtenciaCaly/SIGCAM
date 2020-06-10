<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="libs/js/datepicker.js"></script>
</head>
<?php
$page_title = 'Reporte de caja por fecha';
require_once('includes/load.php');
if (!$session->isUserLoggedIn(true)) {
  redirect('index', false);
}
?>
<?php include_once('layouts/header.php');

?>
<div class="row">
  <div class="col-md-6">
    <?php echo displayMSG($msg); ?>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="panel">
      <div class="panel-heading">

      </div>
      <div class="panel-body">
        <form class="clearfix" method="post" action="generateReportDate">
          <div class="form-group">
            <label class="form-label">Seleccione una fecha</label>
            <div class="input-group">

              <input type='text' class="form-control" id="datepicker" required placeholder="MM/DD/YYYY" name="fecha" autocomplete="off" />
              <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
              </span>
            </div>
          </div>
          <div class="form-group">
            <button type="submit" name="submit" class="btn btn-primary">Generar Reporte PDF</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</div>

<?php include_once('layouts/footer.php'); ?>