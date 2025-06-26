<?php /* Smarty version Smarty-3.1.16, created on 2023-02-28 09:21:51
         compiled from "C:\xampp\htdocs\demo\application\views\statistic\suaca\working_index.php" */ ?>
<?php /*%%SmartyHeaderCode:161088391963fdb99fe66390-86111218%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b03857952200e23138b79c4864aa4a607d33cc5d' => 
    array (
      0 => 'C:\\xampp\\htdocs\\demo\\application\\views\\statistic\\suaca\\working_index.php',
      1 => 1671765019,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '161088391963fdb99fe66390-86111218',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'base_url' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_63fdb99fead888_43271536',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_63fdb99fead888_43271536')) {function content_63fdb99fead888_43271536($_smarty_tpl) {?><div class="row" style="overflow: visible;">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header ui-sortable-handle" style="cursor: move;">
                <h3 class="card-title">
                    <i class="fas fa-chart-pie mr-1"></i>
                    Đang cân
                </h3>
                <div class="card-tools">
                    <ul class="nav nav-pills ml-auto">
                        <li class="nav-item">
                            <a class="nav-link active" href="#tab_suaca_working" data-toggle="tab">Sửa cá</a>
                        </li>
                    </ul>
                </div>
            </div><!-- /.card-header -->
            <div class="card-body">
                <div class="tab-content p-0">
                    <!-- Morris chart - Sales -->
                    <div class="chart tab-pane active"  id="tab_suaca_working" style="position: relative;">
                        <div id="suaca_working">
                        </div>
                    </div>
                </div>
            </div><!-- /.card-body -->
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        viewData();
    });
    var myVar = setInterval(viewData, 2000);

    function viewData() {
        $.post("<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
suaca/workingcontent", {
                
            },
            function(data, status) {
                $("#suaca_working").html(data);
            });
    }
</script><?php }} ?>
