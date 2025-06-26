<?php /* Smarty version Smarty-3.1.16, created on 2023-02-15 09:27:15
         compiled from "C:\xampp\htdocs\demo\application\views\statistic\errorlog\detail.php" */ ?>
<?php /*%%SmartyHeaderCode:149245104763ec97631641e2-56157504%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8faf7a77c6551bf35f49fe687e395e91e5bdef38' => 
    array (
      0 => 'C:\\xampp\\htdocs\\demo\\application\\views\\statistic\\errorlog\\detail.php',
      1 => 1668505673,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '149245104763ec97631641e2-56157504',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'base_url' => 0,
    'startDate' => 0,
    'endDate' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_63ec97631ae9b2_69045661',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_63ec97631ae9b2_69045661')) {function content_63ec97631ae9b2_69045661($_smarty_tpl) {?><div class="row">
    <div class="col-md-3">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Lựa chọn</h3>
            </div>
            <form action="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
errorlog/detail" method="post" id="form">
                <div class="card-body">
                    <!-- Date and time range -->
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-clock"></i></span>
                            </div>
                            <input type="text" class="form-control float-right" name="datetime" id="reservationtime">
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
                <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr style="font-weight: bold;" align="center">
                            <td width="10%" align="left">Thiết bị</td>
                            <td width="10%">Mã thẻ</td>
                            <td  width="10%">Mã lỗi</td>
                            <td>Diễn giải</td>
                            <td  width="10%">Thời gian</td>
                        </tr>
                    </thead>
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
        $('#dataTable').DataTable({
            "ordering": false,
            "processing": true,
            "serverSide": true,
            "searching":false,
            "ajax": {
                "url": "<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
errorlog/detail_read",
                "data": function(d) {
                    d.start_date = "<?php echo $_smarty_tpl->tpl_vars['startDate']->value;?>
";
                    d.end_date = "<?php echo $_smarty_tpl->tpl_vars['endDate']->value;?>
";
                }
            }
        });
    });
</script><?php }} ?>
