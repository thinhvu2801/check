<?php /* Smarty version Smarty-3.1.16, created on 2024-02-19 07:09:37
         compiled from "D:\xampp\htdocs\htdocsbentre\application\views\statistic\fillet\working_index.php" */ ?>
<?php /*%%SmartyHeaderCode:139226840765d2f0a1b79555-01378431%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e6f7c3e265dd7e99fb78d459715701dfcd4a36ac' => 
    array (
      0 => 'D:\\xampp\\htdocs\\htdocsbentre\\application\\views\\statistic\\fillet\\working_index.php',
      1 => 1676258628,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '139226840765d2f0a1b79555-01378431',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'base_url' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_65d2f0a20741f0_95686735',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_65d2f0a20741f0_95686735')) {function content_65d2f0a20741f0_95686735($_smarty_tpl) {?><div class="row" style="overflow: visible;">
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
                            <a class="nav-link active" href="#tab_suaca_working" data-toggle="tab">Phi lê</a>
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
fillet/workingcontent", {
                
            },
            function(data, status) {
                $("#suaca_working").html(data);
            });
    }
</script><?php }} ?>
