<?php /* Smarty version Smarty-3.1.16, created on 2024-03-08 16:46:12
         compiled from "D:\xampp\htdocs\htdocsbentre\application\views\statistic\truck\detail.php" */ ?>
<?php /*%%SmartyHeaderCode:66265409665e735160d62a8-25956332%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '367c9dd6d87ed4c149a269a3afe6196eb5eed914' => 
    array (
      0 => 'D:\\xampp\\htdocs\\htdocsbentre\\application\\views\\statistic\\truck\\detail.php',
      1 => 1709912769,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '66265409665e735160d62a8-25956332',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_65e73516137466_92118454',
  'variables' => 
  array (
    'base_url' => 0,
    'bienso' => 0,
    'bs' => 0,
    'number_plate_id' => 0,
    'customer' => 0,
    'cus' => 0,
    'customer_id' => 0,
    'product' => 0,
    'product_id' => 0,
    'result' => 0,
    'khoi_luong' => 0,
    'rs' => 0,
    'i' => 0,
    'startDate' => 0,
    'endDate' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_65e73516137466_92118454')) {function content_65e73516137466_92118454($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'D:\\xampp\\htdocs\\htdocsbentre\\application\\third_party\\Smarty-3.1.16\\libs\\plugins\\modifier.date_format.php';
?><div class="row">
    <div class="col-md-3">
        <div class="card card-info" id="card_filter">
            <div class="card-header">
                <h3 class="card-title">Lựa chọn</h3>
            </div>
            <form action="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
truck/detail" method="post">
                <div class="card-body">
                    <div class="form-group">
                        <label>Ngày giờ:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-clock"></i></span>
                            </div>
                            <input type="text" class="form-control float-right" name="datetime" id="reservationtime">
                        </div>
                    </div>
                    <!-- <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Biển số</span>
                            </div>
                            <select class="form-control" name="number_plate_id" id="number_plate_id">
                                <option value="">Tất cả</option>
                                <?php  $_smarty_tpl->tpl_vars['bs'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['bs']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['bienso']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['bs']->key => $_smarty_tpl->tpl_vars['bs']->value) {
$_smarty_tpl->tpl_vars['bs']->_loop = true;
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['bs']->value->number_plate_id;?>
" <?php if ($_smarty_tpl->tpl_vars['number_plate_id']->value==$_smarty_tpl->tpl_vars['bs']->value->number_plate_id) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['bs']->value->number_plate_id;?>

                                </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div> -->
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">KH</span>
                            </div>
                            <select class="form-control" name="customer_id" id="customer_id">
                                <option value="">Tất cả</option>
                                <?php  $_smarty_tpl->tpl_vars['cus'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['cus']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['customer']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['cus']->key => $_smarty_tpl->tpl_vars['cus']->value) {
$_smarty_tpl->tpl_vars['cus']->_loop = true;
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['cus']->value->customer_id;?>
" <?php if ($_smarty_tpl->tpl_vars['customer_id']->value==$_smarty_tpl->tpl_vars['cus']->value->customer_id) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['cus']->value->customer_name;?>

                                </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <!-- <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">SP</span>
                            </div>
                            <select class="form-control" name="product_id" id="product_id">
                                <option value="">Tất cả</option>
                                <?php  $_smarty_tpl->tpl_vars['cus'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['cus']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['product']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['cus']->key => $_smarty_tpl->tpl_vars['cus']->value) {
$_smarty_tpl->tpl_vars['cus']->_loop = true;
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['cus']->value->product_id;?>
" <?php if ($_smarty_tpl->tpl_vars['product_id']->value==$_smarty_tpl->tpl_vars['cus']->value->product_id) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['cus']->value->product_name;?>

                                </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div> -->
                </div>
                <div class="card-footer">
                    <div class="btn-group btn-block">
                        <button type="submit" class="btn btn-info btn-sm" name="statistic">Thống kê</button>
                        <button type="submit" class="btn btn-success btn-sm" name="export">Xuất file</button>
                    </div>
                    <!-- <div>
                        <input type="button" class="btn btn-block btn-primary btn-xs" style="margin-top:5px; padding:5px;" value="In tổng hợp" name="printvalue" onclick="printphieu()">
                    </div> -->
                </div>
            </form>
            <!-- <div class="card-footer">
                <input type="button" class="btn btn-block btn-primary btn-xs" style="margin-top:5px; padding:5px;" value="In phiếu" name="printvaluedetail" onclick="printphieu2()">
            </div> -->
        </div>
    </div><!-- ./col-md-3-->
    <div class="col-md-9">
        <div class="card card-info" id="card_result">
            <div class="card-header">
                <h3 class="card-title">
                    Kết quả
                </h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr style="font-weight: bold;" align="center">
                            <td width="3%">STT</td>
                            <td>Ngày</td>
                            <td>Biển số</td>
                            <td>Khách hàng</td>
                            <td>Sản phẩm</td>
                            <td>Khối lượng vào</td>
                            <td>Khối lượng ra</td>
                            <td>Khối lượng hàng</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable(1, null, 0);?>
                        <?php $_smarty_tpl->tpl_vars['khoi_luong'] = new Smarty_variable(0, null, 0);?>
                        <?php  $_smarty_tpl->tpl_vars['rs'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rs']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['result']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rs']->key => $_smarty_tpl->tpl_vars['rs']->value) {
$_smarty_tpl->tpl_vars['rs']->_loop = true;
?>
                        <?php $_smarty_tpl->tpl_vars['khoi_luong'] = new Smarty_variable($_smarty_tpl->tpl_vars['khoi_luong']->value+($_smarty_tpl->tpl_vars['rs']->value['weight_in']-$_smarty_tpl->tpl_vars['rs']->value['weight_out']), null, 0);?>
                        <tr>
                            <td align="center"><?php echo $_smarty_tpl->tpl_vars['i']->value++;?>
</td>
                            <td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['rs']->value['date'],"d/m/Y");?>
</td>
                            <td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['xe_id'];?>
</td>
                            <td><a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
truck/general/<?php echo $_smarty_tpl->tpl_vars['rs']->value['customer_id'];?>
/<?php echo $_smarty_tpl->tpl_vars['rs']->value['date'];?>
"><?php echo $_smarty_tpl->tpl_vars['rs']->value['customer_name'];?>
</a></td>
                            <td><?php echo $_smarty_tpl->tpl_vars['rs']->value['product_name'];?>
</td>
                            <td align="right"><?php echo number_format($_smarty_tpl->tpl_vars['rs']->value['weight_in'],3,",",".");?>
</td>
                            <td align="right"><?php echo number_format($_smarty_tpl->tpl_vars['rs']->value['weight_out'],3,",",".");?>
</td>
                            <!-- <td align="right"><?php echo number_format(($_smarty_tpl->tpl_vars['rs']->value['weight_in']-$_smarty_tpl->tpl_vars['rs']->value['weight_out']),3,",",".");?>
</td> -->
                            <td align="right"><?php if ($_smarty_tpl->tpl_vars['rs']->value['weight_out']==0) {?><?php echo number_format(($_smarty_tpl->tpl_vars['rs']->value['weight_in']-$_smarty_tpl->tpl_vars['rs']->value['weight_in']),3,",",".");?>
<?php } else { ?><?php echo number_format(($_smarty_tpl->tpl_vars['rs']->value['weight_in']-$_smarty_tpl->tpl_vars['rs']->value['weight_out']),3,",",".");?>
<?php }?></td>
                            
                        </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr align="right" style="font-weight: bold;">
                            <td align="right" colspan="7">Tổng: </td>
                            <td align="right"><?php echo number_format($_smarty_tpl->tpl_vars['khoi_luong']->value,3,",",".");?>
</td>
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
    </div><!-- ./col-md-8-->
</div>
<script>
$(document).ready(function() {
    $('#number_plate_id,#customer_id,#product_id').select2();
    $('#dataTable').dataTable();
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
    });
});
</script><?php }} ?>
