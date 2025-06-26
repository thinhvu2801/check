<?php /* Smarty version Smarty-3.1.16, created on 2023-03-08 15:43:36
         compiled from "C:\xampp\htdocs\mentin\application\views\statistic\machine\grader\general.php" */ ?>
<?php /*%%SmartyHeaderCode:10960698064089bbc57c736-59535251%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9b39cdffb76e95788f79cfe7b42b25c4aabae3b2' => 
    array (
      0 => 'C:\\xampp\\htdocs\\mentin\\application\\views\\statistic\\machine\\grader\\general.php',
      1 => 1678286612,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10960698064089bbc57c736-59535251',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_64089bbc647b63_27327850',
  'variables' => 
  array (
    'base_url' => 0,
    'machine_code' => 0,
    'machine_serial' => 0,
    'result' => 0,
    'quantity' => 0,
    'rs' => 0,
    'total' => 0,
    'i' => 0,
    'date' => 0,
    'startDate' => 0,
    'endDate' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_64089bbc647b63_27327850')) {function content_64089bbc647b63_27327850($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'C:\\xampp\\htdocs\\mentin\\application\\third_party\\Smarty-3.1.16\\libs\\plugins\\modifier.date_format.php';
?><div class="row">
    <div class="col-md-3">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Lựa chọn</h3>
            </div>
            <form action="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
machine/index/<?php echo $_smarty_tpl->tpl_vars['machine_code']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['machine_serial']->value;?>
" method="post" id="form">
                <input type="hidden" name="machine_code" value="<?php echo $_smarty_tpl->tpl_vars['machine_code']->value;?>
"/>
                <input type="hidden" name="machine_serial" value="<?php echo $_smarty_tpl->tpl_vars['machine_serial']->value;?>
"/>
                <div class="card-body">
                    <!-- Date and time range -->
                    <div class="form-group">
                        <label>Ngày giờ:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-clock"></i></span>
                            </div>
                            <input type="text" class="form-control float-right" name="datetime" id="reservationtime">
                            <input type="hidden" name="option" value="1"/>
                        </div>
                        <!-- /.input group -->
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                   <div class="btn-group btn-block">
                    <button type="submit" class="btn btn-info btn-sm" name="statistic">Thống kê</button>
                    <button type="submit" class="btn btn-success btn-sm" name="export">Xuất file</button>
                    </div>
                </div>
                <!-- /.card-footer -->
            </form>
        </div>
    </div><!-- ./col-md-3-->
    <div class="col-md-9">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">
            Kết quả
        </h3>
      </div>
      <div class="card-body">
      <div class="table-responsive">
     
       <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
              <tr class="btn-success" style="font-weight: bold;" align="center">
                <td width="3%">TT</td>
                <td>Ngày</td>
                <td>Size</td>
                <td>Số lượng</td>
                <td>Khối lượng</td>
                <td>Trung bình</td>
                <td>Thời gian</td>
              </tr>
          </thead>
              <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable(1, null, 0);?>
              <?php $_smarty_tpl->tpl_vars['quantity'] = new Smarty_variable(0, null, 0);?>
              <?php $_smarty_tpl->tpl_vars['total'] = new Smarty_variable(0, null, 0);?>
              <?php $_smarty_tpl->tpl_vars['date'] = new Smarty_variable('', null, 0);?>
              <tbody>
              
              <?php  $_smarty_tpl->tpl_vars['rs'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rs']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['result']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rs']->key => $_smarty_tpl->tpl_vars['rs']->value) {
$_smarty_tpl->tpl_vars['rs']->_loop = true;
?>
              <?php $_smarty_tpl->tpl_vars['quantity'] = new Smarty_variable($_smarty_tpl->tpl_vars['quantity']->value+$_smarty_tpl->tpl_vars['rs']->value['quantity'], null, 0);?>
              <?php $_smarty_tpl->tpl_vars['total'] = new Smarty_variable($_smarty_tpl->tpl_vars['total']->value+$_smarty_tpl->tpl_vars['rs']->value['weight'], null, 0);?>
              
              <tr align="center">
                <td><?php echo $_smarty_tpl->tpl_vars['i']->value;?>
</td>
                <td>
                  <?php if (($_smarty_tpl->tpl_vars['rs']->value['date']).($_smarty_tpl->tpl_vars['rs']->value['lot'])!=$_smarty_tpl->tpl_vars['date']->value) {?>
                    <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['rs']->value['date'],"d/m/Y");?>
(Lô <?php echo $_smarty_tpl->tpl_vars['rs']->value['lot'];?>
)
                    <?php $_smarty_tpl->tpl_vars['date'] = new Smarty_variable(($_smarty_tpl->tpl_vars['rs']->value['date']).($_smarty_tpl->tpl_vars['rs']->value['lot']), null, 0);?>
                  <?php } else { ?>
                  -
                  <?php }?>
                </td>
                <td><?php echo $_smarty_tpl->tpl_vars['rs']->value['size'];?>
</td>
                <td align="right"><?php echo number_format($_smarty_tpl->tpl_vars['rs']->value['quantity'],0,",",".");?>
</td>
                <td align="right"><?php echo number_format($_smarty_tpl->tpl_vars['rs']->value['weight'],0,",",".");?>
</td>
                <td align="right"><?php if ($_smarty_tpl->tpl_vars['rs']->value['quantity']!=0) {?><?php echo number_format(($_smarty_tpl->tpl_vars['rs']->value['weight']/$_smarty_tpl->tpl_vars['rs']->value['quantity']),0,",",".");?>
<?php }?></td>
                <td><?php echo $_smarty_tpl->tpl_vars['rs']->value['min_time'];?>
-<?php echo $_smarty_tpl->tpl_vars['rs']->value['max_time'];?>
</td>
              </tr>
              <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable($_smarty_tpl->tpl_vars['i']->value+1, null, 0);?>
              <?php } ?>
            </tbody>
            <tfoot>
               <tr style="font-weight: bold;" align="right">
                <td colspan="3">Tổng cộng: </td>
                <td><?php echo number_format($_smarty_tpl->tpl_vars['quantity']->value,0,",",".");?>
</td>
                <td><?php echo number_format($_smarty_tpl->tpl_vars['total']->value,0,",",".");?>
</td>
                <td colspan="4"></td>
              </tr>
            </tfoot>
          </table>
      </div>
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
          
      </div>
        <!-- /.card-footer -->
    </div>

  </div>
  <!-- col-md-8-->
</div>
<script>
    $(document).ready(function() {
        //$('#dataTable').dataTable();
        $('#reservationtime').daterangepicker({
            timePicker: true,
            startDate: '<?php echo $_smarty_tpl->tpl_vars['startDate']->value;?>
',
            endDate: '<?php echo $_smarty_tpl->tpl_vars['endDate']->value;?>
',
            timePickerIncrement: 1,
            timePicker24Hour:true,
            locale: {
                format: 'DD/MM/YYYY HH:mm A'
            }
        })
    });
</script><?php }} ?>
