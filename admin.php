<?php
$page_title = 'Admin';
require_once('includes/load.php');
if (!$session->isUserLoggedIn(true)) {
  redirect('index', false);
}
confZonaHoraria();
?>
<?php
$date =  date("m/d/Y");
$totalEgresos = getTotalEgresos('box', $date);
$totalIngresos = getTotalIngresos('box', $date);
$totalEgresosall = getTotalEgresosAll('box');
$totalIngresosall = getTotalIngresoAll('box');
$initialBalance = initialBalance('initial_balance');
$MovementsIngresos       = lastMovementsIngresos('box');
$MovementsEgresos       = lastMovementsEgresos('box');

?>
<?php include_once('layouts/header.php'); ?>



<div class="row">
  <div class="col-md-6">
    <?php echo displayMSG($msg); ?>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
    <div class="panel panel-box clearfix">
      <div class="panel-icon pull-left bg-primary">
        <i class="glyphicon glyphicon-credit-card"></i>
      </div>
      <div class="panel-value pull-right">
        <h2 class="margin-top"> <?php

                                echo number_format($initialBalance['balance']);
                                // echo $initialBalance['balance']; 
                                ?> </h2>
        <p class="text-muted">Saldo inicial caja</p>
      </div>
    </div>
  </div>

  <div class="col-md-6">
    <div class="panel panel-box clearfix">
      <div class="panel-icon pull-left bg-blue">
        <i class="glyphicon glyphicon-usd"></i>
      </div>
      <div class="panel-value pull-right">
        <h2 class="margin-top"> <?php
                                $total3 =   $totalEgresosall['total'];
                                $total1 =   $initialBalance['balance'];
                                $total2 =  $totalIngresosall['total'];
                                $total = ($total1 + $total2 - $total3);
                                echo number_format(checkCashBalance());

                                ?></h2>
        <p class="text-muted">Saldo en caja</p>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="panel panel-box clearfix">
      <div class="panel-icon pull-left bg-green">
        <i class="glyphicon glyphicon-usd"></i>
      </div>
      <div class="panel-value pull-right">
        <h2 class="margin-top"> <?php
                                if ($totalIngresos['total'] == 0) {
                                  echo "0";
                                } else {
                                  echo  number_format($totalIngresos['total']);
                                }
                                ?> </h2>
        <p class="text-muted">Total Ingresos <?php echo date("m/d/Y"); ?></p>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="panel panel-box clearfix">
      <div class="panel-icon pull-left bg-red">
        <i class="glyphicon glyphicon-usd"></i>
      </div>
      <div class="panel-value pull-right">
        <h2 class="margin-top"> <?php
                                if ($totalEgresos['total'] == 0) {
                                  echo "0";
                                } else {
                                  echo  number_format($totalEgresos['total']);
                                } ?> </h2>
        <p class="text-muted">Total Egresos <?php echo date("m/d/Y"); ?></p>
      </div>
    </div>
  </div>

</div>

<div class="row">
  <div class="col-md-6">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Ultimos moviento de ingreso en caja hoy <?php echo date("m/d/Y"); ?></span>
        </strong>
      </div>
      <div class="panel-body">
        <table class="table table-striped table-bordered table-condensed">
          <thead>
            <tr>
              <th class="text-center" style="width: 50px;">#</th>
              <th>Fecha</th>
              <th>Concepto</th>
              <th>Valor</th>
              <th>Detalles</th>
            <tr>
          </thead>
          <tbody>
            <?php foreach ($MovementsIngresos as  $lastMovement) : ?>
              <tr>
                <td class="text-center"><?php echo countId();
                                        ?></td>
                <td class="text-center"> <?php echo removeJunk($lastMovement['fecha']); ?></td>
                <td class="text-center"> <?php echo removeJunk($lastMovement['concepto']); ?></td>
                <td class="text-center"> <?php echo removeJunk(number_format($lastMovement['valor'])); ?></td>
                <td class="text-center"> <?php echo removeJunk($lastMovement['detalles']); ?></td>
              </tr>
            <?php endforeach; ?>
          <tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Ultimos moviento de egresos en caja hoy <?php echo date("m/d/Y"); ?></span>
        </strong>
      </div>
      <div class="panel-body">
        <table class="table table-striped table-bordered table-condensed">
          <thead>
            <tr>
              <th class="text-center" style="width: 50px;">#</th>
              <th>Fecha</th>
              <th>Concepto</th>
              <th>Valor</th>
              <th>Detalles</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($MovementsEgresos as  $lastMovement) : ?>
              <tr>
                <td class="text-center"><?php echo countId(); ?></td>
                <td class="text-center"> <?php echo removeJunk($lastMovement['fecha']); ?></td>
                <td class="text-center"> <?php echo removeJunk($lastMovement['concepto']); ?></td>
                <td class="text-center"> <?php echo removeJunk(number_format($lastMovement['valor'])); ?></td>
                <td class="text-center"> <?php echo removeJunk($lastMovement['detalles']); ?></td>
              </tr>

            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <!--<div class="col-md-4">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Productos recientemente añadidos</span>
        </strong>
      </div>
      <div class="panel-body">

        <div class="list-group">-->
  <?php /*foreach ($recent_products as  $recent_product): ?>
            <a class="list-group-item clearfix" href="edit_product.php?id=<?php echo    (int)$recent_product['id'];?>">
                <h4 class="list-group-item-heading">
                 <?php if($recent_product['media_id'] === '0'): ?>
                    <img class="img-avatar img-circle" src="uploads/products/no_image.jpg" alt="">
                  <?php else: ?>
                  <img class="img-avatar img-circle" src="uploads/products/<?php echo $recent_product['image'];?>" alt="" />
                <?php endif;?>
                <?php echo remove_junk(first_character($recent_product['name']));?>
                  <span class="label label-warning pull-right">
                 $<?php echo (int)$recent_product['sale_price']; ?>
                  </span>
                </h4>
                <span class="list-group-item-text pull-right">
                <?php echo remove_junk(first_character($recent_product['categorie'])); */ ?>
  </span>
  </a>
  <?php /*endforeach;*/ ?>
</div>
</div>
</div>
</div>-->
</div>
<div class="row">

</div>



<?php include_once('layouts/footer.php'); ?>