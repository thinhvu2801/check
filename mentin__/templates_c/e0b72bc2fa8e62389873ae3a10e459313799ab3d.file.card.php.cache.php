<?php /* Smarty version Smarty-3.1.16, created on 2023-02-15 09:00:39
         compiled from "C:\xampp\htdocs\demo\application\views\worker\card.php" */ ?>
<?php /*%%SmartyHeaderCode:104165818163ec9127567ac8-96187944%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e0b72bc2fa8e62389873ae3a10e459313799ab3d' => 
    array (
      0 => 'C:\\xampp\\htdocs\\demo\\application\\views\\worker\\card.php',
      1 => 1669258836,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '104165818163ec9127567ac8-96187944',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'worker' => 0,
    'wk' => 0,
    'worker_id' => 0,
    'product' => 0,
    'pr' => 0,
    'base_url' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_63ec9127640179_66862354',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_63ec9127640179_66862354')) {function content_63ec9127640179_66862354($_smarty_tpl) {?><div class="row">
  <div class="col-md-4">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">Danh sách công nhân</h3>
      </div><!--card-header-->
      <div class="card-body">
        <input class="form-control" id="btnSearch" type="text" placeholder="Tìm kiếm...">
        <select size="20" class="form-control" name="worker_id" id="worker_id" style="font-size: 1.3em">
          <?php  $_smarty_tpl->tpl_vars['wk'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['wk']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['worker']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['wk']->key => $_smarty_tpl->tpl_vars['wk']->value) {
$_smarty_tpl->tpl_vars['wk']->_loop = true;
?>
            <option value="<?php echo $_smarty_tpl->tpl_vars['wk']->value->worker_id;?>
" <?php if ($_smarty_tpl->tpl_vars['wk']->value->worker_id==$_smarty_tpl->tpl_vars['worker_id']->value) {?> selected <?php }?>>(<?php echo $_smarty_tpl->tpl_vars['wk']->value->factory_id;?>
) <?php echo $_smarty_tpl->tpl_vars['wk']->value->worker_name;?>
</option>
          <?php } ?>
        </select>
      </div><!--card-body-->
    </div><!--card-info-->
  </div><!--col-md5-->
  <div class="col-md-3">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">Danh sách sản phẩm được liên kết</h3>
      </div><!--card-header-->
      <div class="card-body">

        <select size="20" class="form-control" name="product_id" id="product_id" style="font-size: 1.3em">
          <option value="0" selected>Không liên kết</option>
          <?php  $_smarty_tpl->tpl_vars['pr'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['pr']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['product']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['pr']->key => $_smarty_tpl->tpl_vars['pr']->value) {
$_smarty_tpl->tpl_vars['pr']->_loop = true;
?>
            <option value="<?php echo $_smarty_tpl->tpl_vars['pr']->value->product_id;?>
">(<?php echo $_smarty_tpl->tpl_vars['pr']->value->product_id;?>
) <?php echo $_smarty_tpl->tpl_vars['pr']->value->product_name;?>
</option>
          <?php } ?>
        </select>
      </div><!--card-body-->
    </div><!--card-info-->
  </div>
  <div class="col-md-5" style="border-left: 1px solid #ccc;">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">Thông tin thẻ từ</h3>
      </div><!--card-header-->
      <div class="card-body">
        <div>
          <input type="password" id="card_id" name="card_id" class="form-control" maxlength="10" required>
          <input type="checkbox" id="autonext" name="autonext"><label for="autonext">&nbsp;Tự động chuyển</label>
        </div>
        <div id ="info">
        </div>
        <div id ="listcard">
        </div>
      </div><!--card-body-->
    </div><!--card-info-->
  </div><!--col-md-7-->
</div>

<script>
  function _delete(card_id){
      var x = confirm('Bạn có chắc chắn xóa không?');
      if (x){
          $.post("<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
worker/card_delete",{
              card_id: card_id
          },function(data,status){
              loadlistcard();
          });
          $( "#info" ).html("");
      }
      $( "#card_id" ).focus();
  }
  function loadlistcard(){
    $( "#listcard" ).html("Đang tải...");
    
    $.post("<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
worker/card_read",
        {
          object_id: $( "#worker_id" ).val()//.replace(/[&\/\\#, +()$~%.'":*?<>{}]/g, '')
        },
        function(data,status){
          $( "#listcard" ).html(data);
        }
    );
  }
 
  $( document ).ready(function() {
    $("#btnSearch").on("keyup", function() {
    var value = $(this).val().toLowerCase();
      $("#worker_id option").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
    $( "#card_id" ).focus();
    loadlistcard();
    $( "#card_id" ).keyup(function(event){
      if(event.keyCode == 13){
        var next = true;
        if (($.isNumeric($("#card_id" ).val()))&&($("#card_id" ).val().length==10)){
          $.post("<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
worker/card_create",
          {
            card_id: $( "#card_id" ).val(),
            worker_id: $( "#worker_id" ).val(),
            product_id: $( "#product_id" ).val()
          },
          function(data,status){
            $( "#info" ).html(data);
            if (data =='<p style="color:red">Thẻ đã tồn tại!</p>') next = false;
            loadlistcard();
            $( "#card_id" ).val("");
          }).done(function() {
            if ($( "#autonext" ).is(":checked")&&next){
              var select_obj = $('#worker_id option:selected');
              if (select_obj.next().val()!=null)
                select_obj.prop("selected", false).next().prop("selected", true);
              $( "#card_id" ).focus();
            }
          });
        }else{
          $( "#info" ).html('<p style="color:red">Thẻ không hợp lệ!</p>');
          $( "#card_id" ).val("");
        }
      }
      if (event.keyCode == 40){
        var select_obj = $('#worker_id option:selected');
        if (select_obj.next().val()!=null){
          $( "#mes" ).html("");
          select_obj.prop("selected", false).next().prop("selected", true);
          loadlistcard();
        }
      }
      if (event.keyCode == 38){
        var select_obj = $('#worker_id option:selected');
        if (select_obj.prev().val()!=null){
          $( "#mes" ).html("");
          select_obj.prop("selected", false).prev().prop("selected", true);
          loadlistcard();
        }
      }
    });
    $( "#worker_id option").click(function(){
        $( "#card_id" ).focus();
        $( "#info" ).html("");
        loadlistcard();
    });
    $( "#product_id option" ).click(function(){
        $( "#card_id" ).focus();
    });
    $( "#autonext" ).click(function(){
        $( "#card_id" ).focus();
    });
  });
</script><?php }} ?>
