<?php /* Smarty version Smarty-3.1.16, created on 2024-12-19 04:47:31
         compiled from "D:\xampp\htdocs\htdocsbentre\application\views\card\rfid.php" */ ?>
<?php /*%%SmartyHeaderCode:2001962629676397537d4793-56838971%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '223fa0059659009b017421ba7e1874e60e3e96b6' => 
    array (
      0 => 'D:\\xampp\\htdocs\\htdocsbentre\\application\\views\\card\\rfid.php',
      1 => 1589726992,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2001962629676397537d4793-56838971',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'base_url' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_67639753b74c23_73556999',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_67639753b74c23_73556999')) {function content_67639753b74c23_73556999($_smarty_tpl) {?><div id="status">
	
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
