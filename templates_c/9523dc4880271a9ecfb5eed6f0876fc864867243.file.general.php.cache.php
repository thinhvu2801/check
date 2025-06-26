<?php /* Smarty version Smarty-3.1.16, created on 2024-03-08 14:23:45
         compiled from "D:\xampp\htdocs\htdocsbentre\application\views\statistic\truck\general.php" */ ?>
<?php /*%%SmartyHeaderCode:132491365965e736a501bc16-18707400%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9523dc4880271a9ecfb5eed6f0876fc864867243' => 
    array (
      0 => 'D:\\xampp\\htdocs\\htdocsbentre\\application\\views\\statistic\\truck\\general.php',
      1 => 1709903389,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '132491365965e736a501bc16-18707400',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_65e736a506f989_77995123',
  'variables' => 
  array (
    'base_url' => 0,
    'customer_id' => 0,
    'date' => 0,
    'result' => 0,
    'rs' => 0,
    'khoi_luong' => 0,
    'i' => 0,
    'admin' => 0,
    'extra_weight' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_65e736a506f989_77995123')) {function content_65e736a506f989_77995123($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'D:\\xampp\\htdocs\\htdocsbentre\\application\\third_party\\Smarty-3.1.16\\libs\\plugins\\modifier.date_format.php';
?><div class="card card-info" id="card_result">
    <div class="card-header">
        <h3 class="card-title">
            Chi tiết
        </h3>
        <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
truck/detail" class="btn btn-primary btn-sm float-right" style="margin-left:15px;">
            <i class="fa fa-arrow-left" aria-hidden="true"></i>
            Quay lại
        </a>
        <form action="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
truck/general/<?php echo $_smarty_tpl->tpl_vars['customer_id']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['date']->value;?>
" method="post">
            <button type="submit" class="btn btn-success btn-sm float-right" name="export">Xuất file</button>
        </form>
        
        
    </div>
    <div class="card-body">
        <form action="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
truck/extraweight" method="post" id="form">
        <div class="table-responsive">
        <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr style="font-weight: bold;" align="center">
                    <td>STT</td>
                    <td>Ngày</td>
                    <td>Số phiếu</td>
                    <td>Biển số</td>
                    <td>Khách hàng</td>
                    <td>Sản phẩm</td>
                    <td>Khối lượng vào</td>
                    <td>Khối lượng ra</td>
                    <td>Khối lượng hàng</td>
                    <td>Thời gian vào</td>
                    <td>Thời gian ra</td> 
                    <td>Chú thích</td>
                    <td></td>
                    <!-- <td>KL thêm</td> -->
                </tr>
            </thead>
            <tbody>
                <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable(1, null, 0);?>
                <?php $_smarty_tpl->tpl_vars['khoi_luong'] = new Smarty_variable(0, null, 0);?>
                <?php  $_smarty_tpl->tpl_vars['rs'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rs']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['result']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rs']->key => $_smarty_tpl->tpl_vars['rs']->value) {
$_smarty_tpl->tpl_vars['rs']->_loop = true;
?>
                <?php if ($_smarty_tpl->tpl_vars['rs']->value['weight_out']!=0) {?>
                    <?php $_smarty_tpl->tpl_vars['khoi_luong'] = new Smarty_variable($_smarty_tpl->tpl_vars['khoi_luong']->value+($_smarty_tpl->tpl_vars['rs']->value['weight_in']-$_smarty_tpl->tpl_vars['rs']->value['weight_out']), null, 0);?>
                <?php }?>
                <tr>
                    <input type="hidden" name="customer_id" value="<?php echo $_smarty_tpl->tpl_vars['customer_id']->value;?>
">
                    <input type="hidden" name="date" value="<?php echo $_smarty_tpl->tpl_vars['date']->value;?>
">
                    <td align="center"><?php echo $_smarty_tpl->tpl_vars['i']->value++;?>
</td>
                    <td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['rs']->value['date'],"d/m/Y");?>
</td>
                    <td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['so_phieu'];?>
</td>
                    <!-- <input type="hidden" name="so_phieu[]" value="<?php echo $_smarty_tpl->tpl_vars['rs']->value['so_phieu'];?>
"> -->
                    <td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['xe_id'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['rs']->value['customer_name'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['rs']->value['product_name'];?>
</td>
                    <td align="right"><?php echo number_format($_smarty_tpl->tpl_vars['rs']->value['weight_in'],3,",",".");?>
</td>
                    <td align="right"><?php echo number_format($_smarty_tpl->tpl_vars['rs']->value['weight_out'],3,",",".");?>
</td>
                    <td align="right"><?php if ($_smarty_tpl->tpl_vars['rs']->value['weight_out']==0) {?><?php echo number_format(($_smarty_tpl->tpl_vars['rs']->value['weight_in']-$_smarty_tpl->tpl_vars['rs']->value['weight_in']),3,",",".");?>
<?php } else { ?><?php echo number_format(($_smarty_tpl->tpl_vars['rs']->value['weight_in']-$_smarty_tpl->tpl_vars['rs']->value['weight_out']),3,",",".");?>
<?php }?></td>
                    <td><?php echo $_smarty_tpl->tpl_vars['rs']->value['time_in'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['rs']->value['time_out'];?>
</td> 
                    <td><?php echo $_smarty_tpl->tpl_vars['rs']->value['note'];?>
</td>
                    <td width="5%">
                        <input type="button" class="btn btn-block btn-primary btn-xs" style="margin-top:5px; padding:5px;" value="In" name="printvalue2" data-so-phieu="<?php echo $_smarty_tpl->tpl_vars['rs']->value['so_phieu'];?>
">
                        <?php if (($_smarty_tpl->tpl_vars['admin']->value==1)||($_smarty_tpl->tpl_vars['admin']->value==99)) {?>
                            <?php if ($_smarty_tpl->tpl_vars['rs']->value['weight_out']==0) {?>
                                <input type="button" name="editButton" style="margin-top:5px; padding:5px;" value="Sửa" data-toggle="modal" data-target="#update<?php echo $_smarty_tpl->tpl_vars['rs']->value['so_phieu'];?>
" style="cursor: pointer;" alt="Điều chỉnh">
                                </input>
                            <?php }?>
                        <?php }?>
                    </td>
                    <!-- <td width="8%">
                        <input type="number" class="form-control" name="weight_remain[]"
                            value="0" min="0" step="0.01"/>
                    </td> -->
                </tr>
                <?php } ?>
            </tbody>
            <tfoot>
                <tr align="right" style="font-weight: bold;">
                    <td align="right" colspan="8">Tổng khối lượng hàng khi cân: </td>
                    <td align="right"><?php echo number_format($_smarty_tpl->tpl_vars['khoi_luong']->value,3,",",".");?>
</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr align="right" style="font-weight: bold;">
                    <td align="right" colspan="8">Khối lượng hàng thêm: </td>
                    <td>
                        <input type="number" class="form-control" name="weight_remain"
                        value="<?php if (empty($_smarty_tpl->tpl_vars['extra_weight']->value)) {?>0<?php } else { ?><?php echo $_smarty_tpl->tpl_vars['extra_weight']->value;?>
<?php }?>" min="0" step="0.01"/>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr align="right" style="font-weight: bold;">
                    <td align="right" colspan="8">Tổng: </td>
                    <td align="right"><?php if (empty($_smarty_tpl->tpl_vars['extra_weight']->value)) {?><?php echo number_format($_smarty_tpl->tpl_vars['khoi_luong']->value,3,",",".");?>
<?php } else { ?><?php echo number_format(($_smarty_tpl->tpl_vars['extra_weight']->value+$_smarty_tpl->tpl_vars['khoi_luong']->value),3,",",".");?>
<?php }?></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
        </div>
        <div class="card-footer">
            <div class="btn-group btn-block">
                <button type="submit" class="btn btn-block btn-outline-dark btn-flat" style="margin-top:5px; padding:5px;font-size:15px;margin-right:35px;" name="kiemke">Thêm khối lượng</button>
                <input type="button" class="btn btn-block btn-outline-primary btn-flat" style="margin-top:5px; padding:5px;" value="In chi tiết" name="printvalue">
            </div>
        </div>
        </form>
    </div>
</div>
<?php  $_smarty_tpl->tpl_vars['rs'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rs']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['result']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rs']->key => $_smarty_tpl->tpl_vars['rs']->value) {
$_smarty_tpl->tpl_vars['rs']->_loop = true;
?>
<div class="modal fade" id="update<?php echo $_smarty_tpl->tpl_vars['rs']->value['so_phieu'];?>
">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Điều chỉnh</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal" method="post" name="updateproduct" action="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
truck/update">
        <input type="hidden" name="customer_id" value="<?php echo $_smarty_tpl->tpl_vars['customer_id']->value;?>
">
        <input type="hidden" name="date" value="<?php echo $_smarty_tpl->tpl_vars['date']->value;?>
">
        <input type="hidden" name="so_phieu" value="<?php echo $_smarty_tpl->tpl_vars['rs']->value['so_phieu'];?>
">
        <input type="hidden" name="xe_id" value="<?php echo $_smarty_tpl->tpl_vars['rs']->value['xe_id'];?>
">
        <div class="modal-body">
            <div class="form-group row">
            <label for="so_phieu" class="col-sm-2 col-form-label">Số phiếu:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="so_phieu<?php echo $_smarty_tpl->tpl_vars['rs']->value['so_phieu'];?>
" name="so_phieu" placeholder="Số phiếu" required value="<?php echo $_smarty_tpl->tpl_vars['rs']->value['so_phieu'];?>
" disabled>
                </div>
            </div>
          <div class="form-group row">
            <label for="xe_id" class="col-sm-2 col-form-label">Biển số:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="xe_id<?php echo $_smarty_tpl->tpl_vars['rs']->value['so_phieu'];?>
" name="xe_id" placeholder="Biển số" required value="<?php echo $_smarty_tpl->tpl_vars['rs']->value['xe_id'];?>
" disabled>
            </div>
          </div>
          <div class="form-group row">
            <label for="weight_out" class="col-sm-2 col-form-label">Khối lượng ra:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" placeholder="Khối lượng ra" id="weight_out<?php echo $_smarty_tpl->tpl_vars['rs']->value['so_phieu'];?>
" name="weight_out" placeholder="Khối lượng ra" required value="<?php echo $_smarty_tpl->tpl_vars['rs']->value['weight_out'];?>
">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Đóng</button>
          <button type="submit" class="btn btn-primary btn-sm" name="editcapnhat" data-so-phieu="<?php echo $_smarty_tpl->tpl_vars['rs']->value['so_phieu'];?>
">Cập nhật</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<?php } ?>
<script type="text/javascript">
$(document).ready(function() {
    $('#dataTable').dataTable();

    function printphieu() {
        // Tạo request mới và chuyển hướng đến trang in, truyền dữ liệu qua phương thức POST
        $.ajax({
            type: 'POST',
            url: '<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
truck/printvalue/<?php echo $_smarty_tpl->tpl_vars['customer_id']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['date']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['extra_weight']->value;?>
',
            success: function(response) {
                // Mở trang in trong cửa sổ mới
                var iframe = document.createElement('iframe');
                iframe.style.display = 'none';

                // Gán nội dung HTML cho iframe
                iframe.srcdoc = response;

                // Thêm iframe vào body của trang hiện tại
                document.body.appendChild(iframe);

                // Thêm sự kiện onload cho iframe để khi nó đã được load, thực hiện window.print()
                iframe.onload = function() {
                    var style = document.createElement('style');
                    style.textContent = `
                        @page {
                            size: auto;
                            margin: 1.5cm 0 0 0;
                        }
                    `;
                    iframe.contentDocument.head.appendChild(style);

                    iframe.contentWindow.print();
                };
            }
        });
    }

    $('input[name="printvalue"]').on('click', function() {
        printphieu();
    });

    $('button[name="editcapnhat"]').on('click', function() {
      $('input[name="editButton"]').attr('type', 'hidden');
    });

    function printphieu2(so_phieu) {
            $.ajax({
                type: 'POST',
                url: '<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
truck/printdetail/' + so_phieu,
                success: function(response) {
                    var iframe = document.createElement('iframe');
                    iframe.style.display = 'none';

                    iframe.srcdoc = response;

                    document.body.appendChild(iframe);

                    iframe.onload = function() {
                        var style = document.createElement('style');
                        style.textContent = `
                            @page {
                                size: auto;
                                margin: 1.5cm 0 0 0;
                            }
                        `;
                        iframe.contentDocument.head.appendChild(style);

                        iframe.contentWindow.print();
                    };
                }
            });
        }

    $('input[name="printvalue2"]').on('click', function() {
        var so_phieu = $(this).data('so-phieu');
        printphieu2(so_phieu);
    });
});
</script><?php }} ?>
