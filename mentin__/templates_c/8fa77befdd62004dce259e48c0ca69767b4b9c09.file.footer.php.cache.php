<?php /* Smarty version Smarty-3.1.16, created on 2023-03-03 03:28:18
         compiled from "C:\xampp\htdocs\mentin\application\views\footer.php" */ ?>
<?php /*%%SmartyHeaderCode:86032578464015b42da8d44-73516646%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8fa77befdd62004dce259e48c0ca69767b4b9c09' => 
    array (
      0 => 'C:\\xampp\\htdocs\\mentin\\application\\views\\footer.php',
      1 => 1617864600,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '86032578464015b42da8d44-73516646',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'current_year' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_64015b42dae8d1_26269010',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_64015b42dae8d1_26269010')) {function content_64015b42dae8d1_26269010($_smarty_tpl) {?><footer class="main-footer text-sm">
    &nbsp;
    <div class="float-right d-none d-sm-inline-block">
        <strong>Copyright &copy; 2014-<?php echo $_smarty_tpl->tpl_vars['current_year']->value;?>
 <a href="http://mentautomation.com">MenT Automation</a>.</strong>
        All rights reserved.
    </div>
</footer>
<script>
var elem = document.documentElement;
$("#exitfullscreen").hide();
function openFullscreen() {
    if (elem.requestFullscreen) {
        elem.requestFullscreen();
    } else if (elem.mozRequestFullScreen) {
        /* Firefox */
        elem.mozRequestFullScreen();
    } else if (elem.webkitRequestFullscreen) {
        /* Chrome, Safari & Opera */
        elem.webkitRequestFullscreen();
    } else if (elem.msRequestFullscreen) {
        /* IE/Edge */
        elem.msRequestFullscreen();
    }
    $("#exitfullscreen").show();
    $("#fullscreen").hide();
}

function closeFullscreen() {
    if (document.exitFullscreen) {
        document.exitFullscreen();
    } else if (document.mozCancelFullScreen) {
        document.mozCancelFullScreen();
    } else if (document.webkitExitFullscreen) {
        document.webkitExitFullscreen();
    } else if (document.msExitFullscreen) {
        document.msExitFullscreen();
    }
    $("#fullscreen").show();
    $("#exitfullscreen").hide();
}
</script><?php }} ?>
