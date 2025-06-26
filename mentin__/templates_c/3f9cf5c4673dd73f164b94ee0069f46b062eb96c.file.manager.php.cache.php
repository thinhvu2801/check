<?php /* Smarty version Smarty-3.1.16, created on 2023-03-06 07:41:36
         compiled from "C:\xampp\htdocs\mentin\application\views\statistic\machine\manager.php" */ ?>
<?php /*%%SmartyHeaderCode:196763489564058b2011b779-39767701%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3f9cf5c4673dd73f164b94ee0069f46b062eb96c' => 
    array (
      0 => 'C:\\xampp\\htdocs\\mentin\\application\\views\\statistic\\machine\\manager.php',
      1 => 1677487087,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '196763489564058b2011b779-39767701',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'base_url' => 0,
    'machine' => 0,
    'i' => 0,
    'mc' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_64058b201b2b73_08726271',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_64058b201b2b73_08726271')) {function content_64058b201b2b73_08726271($_smarty_tpl) {?><div class="row">
    <div class="col-md-3">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Thêm thủ công</h3>
            </div>
            <form action="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
machine/manager" method="post">
                <div class="card-body">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Server</span>
                            </div>
                            <input type="text" class="form-control" name="server" id="server"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">User</span>
                            </div>
                            <input type="text" class="form-control" name="user" id="user"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Password</span>
                            </div>
                            <input type="text" class="form-control" name="password" id="password"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Database</span>
                            </div>
                            <input type="text" class="form-control" name="db_name" id="db_name"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Machine code</span>
                            </div>
                            <input type="text" class="form-control" name="machine_code" id="machine_code"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Machine serial</span>
                            </div>
                            <input type="text" class="form-control" name="machine_serial" id="machine_serial"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Machine name</span>
                            </div>
                            <input type="text" class="form-control" name="machine_name" id="machine_name"/>
                        </div>
                    </div>
                    <!-- /input-group -->
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <div class="btn-group btn-block">
                        <button type="submit" class="btn btn-info btn-sm" name="insert">Thêm</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- card-info-->
    </div><!-- ./col-md-3-->
    <div class="col-md-9">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Danh sách thiết bị</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr style="font-weight: bold;" align="center">
                                <td width="3%">STT</td>
                                <td width="15%">Server</td>
                                <td width="15%">User</td>
                                <td width="15%">Password</td>
                                <td width="15%">Database</td>
                                <td width="15%">Code</td>
                                <td width="15%">Serial</td>
                                <td width="15%">Name</td>
                                <td width="15%">Chức năng</td>
                            </tr>
                        </thead>
                        <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable(1, null, 0);?>
                        <?php  $_smarty_tpl->tpl_vars['mc'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['mc']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['machine']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['mc']->key => $_smarty_tpl->tpl_vars['mc']->value) {
$_smarty_tpl->tpl_vars['mc']->_loop = true;
?>
                        <tr align="center">
                            <td><?php echo $_smarty_tpl->tpl_vars['i']->value++;?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['mc']->value->server;?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['mc']->value->_user;?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['mc']->value->password;?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['mc']->value->db_name;?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['mc']->value->machine_code;?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['mc']->value->machine_serial;?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['mc']->value->machine_name;?>
</td>
                            <td>
                                <a style="color: #17a2b8" href="#" data-toggle="modal" data-target="#update<?php echo $_smarty_tpl->tpl_vars['mc']->value->id;?>
" style="cursor: pointer;" alt="Điều chỉnh">
                                    <i class="fas fa-pencil-alt">
                                    </i>
                                </a>
                                <a style="color: #da251d" href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
machine/delete/<?php echo $_smarty_tpl->tpl_vars['mc']->value->id;?>
" onclick="return confirm('Bạn có chắc chắn xóa không?');">
                                    <i class="fas fa-trash">
                                    </i>
                                </a>
                            </td>
                        </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
            </div>
            <!-- /.card-footer -->
        </div>
        <!-- card-info-->
    </div><!-- ./col-md-9-->
</div>
<?php  $_smarty_tpl->tpl_vars['mc'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['mc']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['machine']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['mc']->key => $_smarty_tpl->tpl_vars['mc']->value) {
$_smarty_tpl->tpl_vars['mc']->_loop = true;
?>
<div class="modal fade" id="update<?php echo $_smarty_tpl->tpl_vars['mc']->value->id;?>
">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Điều chỉnh</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-horizontal" method="post" name="updatemachine" action="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
machine/manager">
                <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['mc']->value->id;?>
">
                <div class="modal-body">
                <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Server</span>
                            </div>
                            <input type="text" class="form-control" name="server" id="server" value="<?php echo $_smarty_tpl->tpl_vars['mc']->value->server;?>
"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">User</span>
                            </div>
                            <input type="text" class="form-control" name="user" id="user" value="<?php echo $_smarty_tpl->tpl_vars['mc']->value->_user;?>
"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Password</span>
                            </div>
                            <input type="text" class="form-control" name="password" id="password"  value="<?php echo $_smarty_tpl->tpl_vars['mc']->value->password;?>
"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Database</span>
                            </div>
                            <input type="text" class="form-control" name="db_name" id="db_name"  value="<?php echo $_smarty_tpl->tpl_vars['mc']->value->db_name;?>
"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Machine code</span>
                            </div>
                            <input type="text" class="form-control" name="machine_code" id="machine_code"  value="<?php echo $_smarty_tpl->tpl_vars['mc']->value->machine_code;?>
"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Machine serial</span>
                            </div>
                            <input type="text" class="form-control" name="machine_serial" id="machine_serial" value="<?php echo $_smarty_tpl->tpl_vars['mc']->value->machine_serial;?>
"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Machine name</span>
                            </div>
                            <input type="text" class="form-control" name="machine_name" id="machine_name" value="<?php echo $_smarty_tpl->tpl_vars['mc']->value->machine_name;?>
"/>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary btn-sm" id="update" name="update">Cập nhật</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<?php } ?>
<script>
    $(document).ready(function() {
        $("#server").focus();
        $('#dataTable').DataTable({
            stateSave: true
        });
    });
</script><?php }} ?>
