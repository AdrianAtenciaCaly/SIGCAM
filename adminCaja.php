<?php
$page_title = 'Movimientos en caja';
require_once('includes/load.php');
$user = current_user();
$tipo = page_require_tipo($user['tipo']);
if (!$session->isUserLoggedIn(true)) {
  redirect('index', false);
}
$box = findAllBox();
?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-12">
    <?php echo displayMSG($msg); ?>
  </div>
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <div class="pull-right">
          <a href="addCaja.php" class="btn btn-primary">Agregar a caja</a>
        </div>
      </div>
      <div class="panel-body">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th class="text-center" style="width: 50px;">#</th>
              <th class="text-center" style="width: 50px;"> Fecha</th>
              <th class="text-center" style="width: 10%;"> Concepto </th>
              <th class="text-center" style="width: 10%;"> Doc Identidad </th>
              <th class="text-center" style="width: 10%;"> N° Recibo</th>
              <th class="text-center" style="width: 100px;"> Tipo de movimiento </th>
              <th class="text-center" style="width: 100px;"> Valor </th>
              <th class="text-center" style="width: 100px;"> Detalles </th>
              <th class="text-center" style="width: 100px;"> Accion </th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($box as $allbox) : ?>
              <tr>
                <td class="text-center"><?php echo countId(); //echo countId(); 
                                        ?></td>
                <td> <?php echo removeJunk($allbox['fecha']); ?></td>
                <td class="text-center"> <?php echo removeJunk($allbox['concepto']); ?></td>
                <td class="text-center"> <?php echo removeJunk($allbox['doc_identidad']); ?></td>
                <td class="text-center"> <?php echo removeJunk($allbox['recibo_caja']); ?></td>
                <td class="text-center"> <?php echo removeJunk($allbox['opcion']); ?></td>
                <td class="text-center"> <?php echo removeJunk(number_format($allbox['valor'])); ?></td>
                <td class="text-center"> <?php echo removeJunk($allbox['detalles']); ?></td>
                <td class="text-center">
                  <div class="btn-group">
                    <?php
                    if ($tipo['tipo'] === 'ADMINISTRADOR') {
                    ?>
                      <a href="removeMovingBox.php?idbox=<?php echo (int) $allbox['idbox']; ?>" class="btn btn-danger btn-xs" title="Eliminar" data-toggle="tooltip">
                        <span class="glyphicon glyphicon-trash"></span>
                      </a>

                    <?php
                    }
                    ?>

                    <a href="individualPrint.php?idbox=<?php echo (int) $allbox['idbox']; ?>" class="btn btn-success btn-xs" title="Imprimir" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-print"></span>
                    </a>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<?php include_once('layouts/footer.php'); ?>