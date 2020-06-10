<?php
require_once('includes/load.php');
if (!$session->isUserLoggedIn(true)) {
  redirect('index', false);
}
?>
<?php
$id = find_by_id_box('box', (int) $_GET['idbox']);
if (!$id) {
  $session->msg("d", "ID vacío");
  redirect('adminCaja');
}
?>
<?php
$delete_id = delete_by_id('box', (int) $id['idbox']);
if ($delete_id) {
  $session->msg("s", "Moviento eliminado");
  redirect('adminCaja');
} else {
  $session->msg("d", "Eliminación falló");
  redirect('adminCaja');
}
?>
