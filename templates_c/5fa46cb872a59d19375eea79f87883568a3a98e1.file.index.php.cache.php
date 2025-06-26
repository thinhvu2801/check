<?php /* Smarty version Smarty-3.1.16, created on 2025-02-27 02:48:16
         compiled from "C:\xampp\htdocs\check\application\views\statistic\overview\index.php" */ ?>
<?php /*%%SmartyHeaderCode:169698338167bfc46009cb38-11082943%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5fa46cb872a59d19375eea79f87883568a3a98e1' => 
    array (
      0 => 'C:\\xampp\\htdocs\\check\\application\\views\\statistic\\overview\\index.php',
      1 => 1738936129,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '169698338167bfc46009cb38-11082943',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'base_url' => 0,
    'start_date' => 0,
    'end_date' => 0,
    'lohang' => 0,
    'lo' => 0,
    'lo_id' => 0,
    'result' => 0,
    'tong_nl' => 0,
    'rs' => 0,
    'tong_tfl' => 0,
    'tong_sfl' => 0,
    'tong_ttp' => 0,
    'tong_stp' => 0,
    'i' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_67bfc46023e8e9_70526165',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_67bfc46023e8e9_70526165')) {function content_67bfc46023e8e9_70526165($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'C:\\xampp\\htdocs\\check\\application\\third_party\\Smarty-3.1.16\\libs\\plugins\\modifier.date_format.php';
?><div class="row">
    <div class="col-md-4">
        <div class="card card-info" id="card_filter">
            <div class="card-header">
                <h3 class="card-title">Điều kiện lọc</h3>
            </div>
            <div class="card-body">
                <form class="form-horizontal" method="post" action="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
chartreport/overview">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-clock"></i></span>
                            </div>
                            <input type="date" class="form-control" id="start_date" name="start_date"
                                placeholder="Từ ngày" required value="<?php echo $_smarty_tpl->tpl_vars['start_date']->value;?>
">
                        </div>
                        <!-- /.input group -->
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-clock"></i></span>
                            </div>
                            <input type="date" class="form-control" id="end_date" name="end_date" placeholder="Từ ngày"
                                required value="<?php echo $_smarty_tpl->tpl_vars['end_date']->value;?>
">
                        </div>
                        <!-- /.input group -->
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">LÔ</span>
                            </div>
                            <select class="form-control" name="lo_id" id="lo_id">
                                <option value="">Tất cả</option>
                                <?php  $_smarty_tpl->tpl_vars['lo'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['lo']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['lohang']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['lo']->key => $_smarty_tpl->tpl_vars['lo']->value) {
$_smarty_tpl->tpl_vars['lo']->_loop = true;
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['lo']->value->lo_id;?>
" <?php if ($_smarty_tpl->tpl_vars['lo_id']->value==$_smarty_tpl->tpl_vars['lo']->value->lo_id) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['lo']->value->lo_id;?>
</option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="btn-group btn-block">
                            <button type="submit" class="btn btn-sm btn-danger" name="thongke">Thống kê</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card card-info" id="card_chart">
            <div class="card-header">
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                    </button>
                </div>
                <h3 class="card-title">Biểu đồ</h3>
            </div>
            <div class="card-body" id="result">
                <!-- <div id="result" style="text-align: center;"></div> -->
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card card-info" id="card_result">
            <div class="card-header">
                <h3 class="card-title">Kết quả</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <!-- <div style="text-align: center;">
                        <h4 style="text-transform: uppercase">Thống kê tổng quan<br> Từ ngày
                            <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['start_date']->value,"d/m/Y");?>
 đến ngày <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['end_date']->value,"d/m/Y");?>

                        </h4>
                    </div>
 -->
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr class="btn-success" style="font-weight: bold;" align="center">
                                <td width="3%">TT</td>
                                <td width="20%">Ngày</td>
                                <td>Nguyên Liệu</td>
                                <td>Cắt Tiết</td>
                                <td>Phi Lê</td>
                                <td>Lạng Da</td>
                                <td>Sửa Cá</td>
                                <td>Biểu đồ</td>
                            </tr>
                        </thead>
                        <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable(1, null, 0);?>
                        <?php $_smarty_tpl->tpl_vars['tong_nl'] = new Smarty_variable(0, null, 0);?>
                        <?php $_smarty_tpl->tpl_vars['tong_tfl'] = new Smarty_variable(0, null, 0);?>
                        <?php $_smarty_tpl->tpl_vars['tong_sfl'] = new Smarty_variable(0, null, 0);?>
                        <?php $_smarty_tpl->tpl_vars['tong_ttp'] = new Smarty_variable(0, null, 0);?>
                        <?php $_smarty_tpl->tpl_vars['tong_stp'] = new Smarty_variable(0, null, 0);?>
                        <tbody>
                            <?php  $_smarty_tpl->tpl_vars['rs'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rs']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['result']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rs']->key => $_smarty_tpl->tpl_vars['rs']->value) {
$_smarty_tpl->tpl_vars['rs']->_loop = true;
?>
                            <?php $_smarty_tpl->tpl_vars['tong_nl'] = new Smarty_variable($_smarty_tpl->tpl_vars['tong_nl']->value+$_smarty_tpl->tpl_vars['rs']->value['nl_weight'], null, 0);?>
                            <?php $_smarty_tpl->tpl_vars['tong_tfl'] = new Smarty_variable($_smarty_tpl->tpl_vars['tong_tfl']->value+$_smarty_tpl->tpl_vars['rs']->value['fl_weight_in'], null, 0);?>
                            <?php $_smarty_tpl->tpl_vars['tong_sfl'] = new Smarty_variable($_smarty_tpl->tpl_vars['tong_sfl']->value+$_smarty_tpl->tpl_vars['rs']->value['fl_weight_out'], null, 0);?>
                            <?php $_smarty_tpl->tpl_vars['tong_ttp'] = new Smarty_variable($_smarty_tpl->tpl_vars['tong_ttp']->value+$_smarty_tpl->tpl_vars['rs']->value['sc_weight_in'], null, 0);?>
                            <?php $_smarty_tpl->tpl_vars['tong_stp'] = new Smarty_variable($_smarty_tpl->tpl_vars['tong_stp']->value+$_smarty_tpl->tpl_vars['rs']->value['sc_weight_out'], null, 0);?>
                            <tr align="right">
                                <td align="center"><?php echo $_smarty_tpl->tpl_vars['i']->value++;?>
</td>
                                <td align="center"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['rs']->value['date'],"d/m/Y");?>
</td>
                                <td><?php echo number_format($_smarty_tpl->tpl_vars['rs']->value['nl_weight'],3,",",".");?>
</td>
                                <td><?php echo number_format($_smarty_tpl->tpl_vars['rs']->value['fl_weight_in'],3,",",".");?>
</td>
                                <td><?php echo number_format($_smarty_tpl->tpl_vars['rs']->value['fl_weight_out'],3,",",".");?>
</td>
                                <td><?php echo number_format($_smarty_tpl->tpl_vars['rs']->value['sc_weight_in'],3,",",".");?>
</td>
                                <td><?php echo number_format($_smarty_tpl->tpl_vars['rs']->value['sc_weight_out'],3,",",".");?>
</td>
                                <td align="center">
                                    <a href="#" alt="Điều chỉnh" onclick="ViewChartReport('<?php echo $_smarty_tpl->tpl_vars['rs']->value['date'];?>
')" class="btn btn-sm btn-outline-success"><i class="fa fa-bar-chart" aria-hidden="true"></i></a>
                                    <!-- <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
chartreport/index/<?php echo $_smarty_tpl->tpl_vars['rs']->value['date'];?>
" target="_blank">Biểu đồ</a> -->
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr style="font-weight: bold;" align="right">
                                <td colspan="2">Tổng cộng: </td>
                                <td><?php echo number_format($_smarty_tpl->tpl_vars['tong_nl']->value,3,",",".");?>
</td>
                                <td><?php echo number_format($_smarty_tpl->tpl_vars['tong_tfl']->value,3,",",".");?>
</td>
                                <td><?php echo number_format($_smarty_tpl->tpl_vars['tong_sfl']->value,3,",",".");?>
</td>
                                <td><?php echo number_format($_smarty_tpl->tpl_vars['tong_ttp']->value,3,",",".");?>
</td>
                                <td><?php echo number_format($_smarty_tpl->tpl_vars['tong_stp']->value,3,",",".");?>
</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
function ViewChartReport(date) {
    // var height = 520;
    // var width = 800;
    // var left = screen.width/2 - width/2;
    // var top = screen.height/2 - height/2;
    // window.open("<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
chartreport/index/"+date,"Bieu do","menubar=no,left="+left+",top="+top+",height="+height+",width="+width);
    $("#result").html("Đang tải...");
    $.post("<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
chartreport", {
        date: date
    }, function(data) {
        $("#result").html(data);
        $('#card_result').css('min-height', $('#card_filter').height()+$('#card_chart').height()+15);
    });
    
}
$(document).ready(function() {
    $("#result").html("Đang tải...");
    $.post("<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
chartreport", {
        date: "<?php echo $_smarty_tpl->tpl_vars['end_date']->value;?>
"
    }, function(data) {
        $("#result").html(data);
        $('#card_result').css('min-height', $('#card_filter').height()+$('#card_chart').height()+15);
    });
    $('#dataTable').DataTable();
});
</script><?php }} ?>
