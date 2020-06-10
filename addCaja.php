<?php
$page_title = 'Agregar Caja';

require_once('includes/load.php');
if (!$session->isUserLoggedIn(true)) {
  redirect('index', false);
}

?>


<?php

if (isset($_POST['addCaja'])) {
  $req_fields = array('date', 'concept', 'identity', 'receive_box', 'tipo',  'value', 'detail');
  validate_fields($req_fields);
  $totalCaja = checkCashBalance();

  if (empty($errors)) {
    $id = null;
    $p_date  = removeJunk($db->escape($_POST['date']));
    $p_concept   = removeJunk($db->escape($_POST['concept']));
    $p_identity   = removeJunk($db->escape($_POST['identity']));
    $p_receive_box   = removeJunk($db->escape($_POST['receive_box']));
    $p_tipo = removeJunk($db->escape($_POST['tipo']));
    $p_value  = removeJunk($db->escape($_POST['value']));
    $p_detail  = removeJunk($db->escape($_POST['detail']));
    $cadena = $p_date;
    $array = explode("/", $cadena);
    $p_mes = $array[0];
    $p_dia = $array[1];
    $p_año = $array[2];
    if ($p_tipo === 'EGRESO' && $p_value > $totalCaja) {

      $session->msg('d', ' Lo siento, El valor del ingresado (' . number_format($p_value) . ') es mayor al saldo en  caja. ' .  number_format($totalCaja));
      redirect('addCaja.php', false);
    }
    $query  = "INSERT INTO box  VALUES (";
    $query .= "'{$id}','{$p_date}', '{$p_concept}', '{$p_identity}', '{$p_receive_box}', '{$p_tipo}', '{$p_value}', '{$p_detail}', '{$p_dia}', '{$p_mes}', '{$p_año}'";
    $query .= ")";
    if ($db->query($query)) {
      $session->msg('s', "Informacion agregado exitosamente. ");
      redirect('addCaja.php', false);
    } else {
      $session->msg('d', ' Lo siento, registro falló.');
      redirect('adminCaja.php', false);
    }
  } else {
    $session->msg("d", $errors);
    redirect('addCaja.php', false);
  }
}

?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-12">
    <?php echo displayMSG($msg); ?>
  </div>
</div>
<div class="row">
  <div class="col-md-9">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Agregar Caja</span>
        </strong>
      </div>
      <div class="panel-body">
        <div class="col-md-12">
          <form method="post" action="addCaja" class="clearfix">
            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                  <select class="form-control" required name="tipo" id="categorie">
                    <option value="">Selecciona tipo de manejo</option>

                    <option value="INGRESO">INGRESO</option>
                    <option value="EGRESO">EGRESO</option>
                  </select>

                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <div class='input-group date' id='datetimepicker'>
                          <input type='text' class="form-control" name="date" id="datepicker" value="<?php echo date("m/d/Y"); ?>" required autocomplete="off" />
                          <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="glyphicon glyphicon-th-large"></i>
                    </span>
                    <input type="text" class="form-control" name="concept" required placeholder="Concepto">
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="glyphicon glyphicon-th-large"></i>
                    </span>
                    <input type="text" class="form-control" name="identity" required placeholder="Doc Identidad">
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="glyphicon glyphicon-barcode"></i>
                    </span>
                    <input type="number" class="form-control" name="receive_box" required placeholder="Recibo de caja">
                  </div>
                </div>
              </div>
            </div>




            <div class="form-group">
              <div class="row">
                <div class="col-md-4">
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="glyphicon glyphicon-usd"></i>
                    </span>

                    <input type="number" class="form-control" name="value" required placeholder="Valor">
                    <!--<span class="input-group-addon">.00</span>-->
                  </div>
                </div>


                <div class="col-md-8">
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="glyphicon glyphicon-paperclip"></i>
                    </span>

                    <textarea class="form-control" id="detail" name="detail" rows="5" cols="10" required placeholder="Detalles"></textarea>

                  </div>
                </div>
              </div>
            </div>
            <button type="submit" name="addCaja" class="btn btn-danger">Agregar a caja</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include_once('layouts/footer.php'); ?>