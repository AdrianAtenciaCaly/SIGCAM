<?php
$page_title = 'Home Page';
require_once('includes/load.php');
if (!$session->isUserLoggedIn(true)) {
  redirect('index.php', false);
}
?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-12">
    <?php echo displayMSG($msg); ?>
  </div>
  <div class="col-md-12">
    <div class="panel">
      <div class="jumbotron text-center">
        <h2>SISTEMA DE INFORMACIÓN PARA GESTIÓN DE CARTERA ABEL MENDOZAa

        </h2>
        <h1>SIGCAM</h1>

      </div>
    </div>
  </div>
</div>
<?php include_once('layouts/footer.php'); ?>