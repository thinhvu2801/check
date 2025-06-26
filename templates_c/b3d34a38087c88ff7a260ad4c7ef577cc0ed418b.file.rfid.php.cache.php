<?php /* Smarty version Smarty-3.1.16, created on 2024-01-27 04:54:26
         compiled from "C:\xampp\htdocs\application\views\card\rfid.php" */ ?>
<?php /*%%SmartyHeaderCode:72398021865b47e72970ec1-62741873%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b3d34a38087c88ff7a260ad4c7ef577cc0ed418b' => 
    array (
      0 => 'C:\\xampp\\htdocs\\application\\views\\card\\rfid.php',
      1 => 1589726992,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '72398021865b47e72970ec1-62741873',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'base_url' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_65b47e729bf0c2_39696795',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_65b47e729bf0c2_39696795')) {function content_65b47e729bf0c2_39696795($_smarty_tpl) {?><div id="status">
	
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
