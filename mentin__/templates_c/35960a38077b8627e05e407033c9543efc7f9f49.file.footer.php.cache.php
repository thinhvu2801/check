<?php /* Smarty version Smarty-3.1.16, created on 2023-02-13 07:56:49
         compiled from "C:\xampp\htdocs\demo\application\views\footer.php" */ ?>
<?php /*%%SmartyHeaderCode:166857315963e9df31392867-95802374%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '35960a38077b8627e05e407033c9543efc7f9f49' => 
    array (
      0 => 'C:\\xampp\\htdocs\\demo\\application\\views\\footer.php',
      1 => 1617864600,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '166857315963e9df31392867-95802374',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'current_year' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_63e9df313dc178_95466757',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_63e9df313dc178_95466757')) {function content_63e9df313dc178_95466757($_smarty_tpl) {?><footer class="main-footer text-sm">
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
