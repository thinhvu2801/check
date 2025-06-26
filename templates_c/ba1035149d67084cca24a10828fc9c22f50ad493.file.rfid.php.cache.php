<?php /* Smarty version Smarty-3.1.16, created on 2025-02-27 03:17:40
         compiled from "C:\xampp\htdocs\check\application\views\card\rfid.php" */ ?>
<?php /*%%SmartyHeaderCode:204651140267bfcb44047d67-83599087%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ba1035149d67084cca24a10828fc9c22f50ad493' => 
    array (
      0 => 'C:\\xampp\\htdocs\\check\\application\\views\\card\\rfid.php',
      1 => 1589726992,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '204651140267bfcb44047d67-83599087',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'base_url' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_67bfcb4412c1f5_46083967',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_67bfcb4412c1f5_46083967')) {function content_67bfcb4412c1f5_46083967($_smarty_tpl) {?><div id="status">
	
</div>
<script type="text/javascript">
$( document ).ready(function() {
  	 viewData();
  });
  var myVar = setInterval(viewData, 500);
  function viewData() {

    $.post("<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
card/viewDongbo",
      {
      },
      function(data,status){
      	if (data=="")
      		$( "#status" ).html("Đang chờ đồng bộ...");
      	else
      		$( "#status" ).html(data);
    });
  }
</script><?php }} ?>
