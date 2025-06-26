<?php /* Smarty version Smarty-3.1.16, created on 2024-02-01 05:26:45
         compiled from "D:\xampp\htdocs\htdocsbentre\application\views\footer.php" */ ?>
<?php /*%%SmartyHeaderCode:197703109165bb1d85869a74-31818868%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1f22443b5e55a433672092f9fa3e30429634117f' => 
    array (
      0 => 'D:\\xampp\\htdocs\\htdocsbentre\\application\\views\\footer.php',
      1 => 1617864600,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '197703109165bb1d85869a74-31818868',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'current_year' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_65bb1d8586e7c0_58969344',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_65bb1d8586e7c0_58969344')) {function content_65bb1d8586e7c0_58969344($_smarty_tpl) {?><footer class="main-footer text-sm">
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
