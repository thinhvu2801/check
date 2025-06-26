<?php /* Smarty version Smarty-3.1.16, created on 2024-03-08 15:07:49
         compiled from "D:\xampp\htdocs\htdocsbentre\application\views\statistic\truck\weightout.php" */ ?>
<?php /*%%SmartyHeaderCode:27902505465eaed43cefa70-38350175%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6f4a2384504fc08afca88bb1974c9a221b51971a' => 
    array (
      0 => 'D:\\xampp\\htdocs\\htdocsbentre\\application\\views\\statistic\\truck\\weightout.php',
      1 => 1709906867,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '27902505465eaed43cefa70-38350175',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_65eaed43d6faa6_64688764',
  'variables' => 
  array (
    'base_url' => 0,
    'date' => 0,
    'customer' => 0,
    'cus' => 0,
    'customer_id' => 0,
    'result' => 0,
    'rs' => 0,
    'khoi_luong' => 0,
    'i' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_65eaed43d6faa6_64688764')) {function content_65eaed43d6faa6_64688764($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'D:\\xampp\\htdocs\\htdocsbentre\\application\\third_party\\Smarty-3.1.16\\libs\\plugins\\modifier.date_format.php';
?><div class="row">
    <div class="col-md-3">
        <div class="card card-info" id="card_filter">
            <div class="card-header">
                <h3 class="card-title">Lựa chọn</h3>
            </div>
            <form action="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
truck/weightout" method="post">
                <div class="card-body">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Ngày</span>
                            </div>
                            <input type="date" class="form-control" id="date" name="date" value="<?php echo $_smarty_tpl->tpl_vars['date']->value;?>
" required>
                        </div>
                    </div>
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
                </div>
                <div class="card-footer">
                    <div class="btn-group btn-block">
                        <button type="submit" class="btn btn-info btn-sm" name="statistic">Thống kê</button>
                        <!-- <button type="submit" class="btn btn-success btn-sm" name="export">Xuất file</button> -->
                    </div>
                </div>
            </form>
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
                            <td >Số phiếu</td>
                            <td>Biển số</td>
                            <td>Khách hàng</td>
                            <td>Sản phẩm</td>
                            <td>Khối lượng vào</td>
                            <td>Khối lượng ra</td>
                            <!-- <td>Khối lượng hàng</td> -->
                            <td>Thời gian vào</td>
                            <td>Thời gian ra</td> 
                            <td>Chú thích</td>
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
                        <!-- <?php if ($_smarty_tpl->tpl_vars['rs']->value['weight_out']!=0) {?> -->
                            <?php $_smarty_tpl->tpl_vars['khoi_luong'] = new Smarty_variable($_smarty_tpl->tpl_vars['khoi_luong']->value+($_smarty_tpl->tpl_vars['rs']->value['weight_in']-$_smarty_tpl->tpl_vars['rs']->value['weight_out']), null, 0);?>
                        <!-- <?php }?> -->
                        <tr>
                            <td align="center"><?php echo $_smarty_tpl->tpl_vars['i']->value++;?>
</td>
                            <td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['rs']->value['date'],"d/m/Y");?>
</td>
                            <td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['so_phieu'];?>
</td>
                            <td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['xe_id'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['rs']->value['customer_name'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['rs']->value['product_name'];?>
</td>
                            <td align="right"><?php echo number_format($_smarty_tpl->tpl_vars['rs']->value['weight_in'],3,",",".");?>
</td>
                            <td align="right"><?php echo number_format($_smarty_tpl->tpl_vars['rs']->value['weight_out'],3,",",".");?>
</td>
                            <!-- <td align="right"><?php if ($_smarty_tpl->tpl_vars['rs']->value['weight_out']==0) {?><?php echo number_format(($_smarty_tpl->tpl_vars['rs']->value['weight_in']-$_smarty_tpl->tpl_vars['rs']->value['weight_in']),3,",",".");?>
<?php } else { ?><?php echo number_format(($_smarty_tpl->tpl_vars['rs']->value['weight_in']-$_smarty_tpl->tpl_vars['rs']->value['weight_out']),3,",",".");?>
<?php }?></td> -->
                            <td><?php echo $_smarty_tpl->tpl_vars['rs']->value['time_in'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['rs']->value['time_out'];?>
</td> 
                            <td><?php echo $_smarty_tpl->tpl_vars['rs']->value['note'];?>
</td>
                        </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <!-- <tr align="right" style="font-weight: bold;">
                            <td align="right" colspan="8">Tổng: </td>
                            <td align="right"><?php echo number_format($_smarty_tpl->tpl_vars['khoi_luong']->value,3,",",".");?>
</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr> -->
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
<script type="text/javascript">
$(document).ready(function() {
    $('#customer_id').select2();
    $('#dataTable').dataTable();
});
</script><?php }} ?>
