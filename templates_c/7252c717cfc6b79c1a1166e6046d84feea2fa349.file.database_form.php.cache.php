<?php /* Smarty version Smarty-3.1.16, created on 2025-06-26 03:39:32
         compiled from "D:\App\Wampp\www\check\application\views\user\database_form.php" */ ?>
<?php /*%%SmartyHeaderCode:4264597956858f0c8ef5276-42034513%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7252c717cfc6b79c1a1166e6046d84feea2fa349' => 
    array (
      0 => 'D:\\App\\Wampp\\www\\check\\application\\views\\user\\database_form.php',
      1 => 1750907724,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4264597956858f0c8ef5276-42034513',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_6858f0c8f16bf2_15577221',
  'variables' => 
  array (
    'base_url' => 0,
    'error' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_6858f0c8f16bf2_15577221')) {function content_6858f0c8f16bf2_15577221($_smarty_tpl) {?><section class="content">
    <div class="container-fluid pt-10">
        <div class="row pt-5">
            <div class="col-md-3">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Danh sách cơ sở dữ liệu hiện có</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover">
                            <tbody id="db-list">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Thay đổi cơ sở dữ liệu</h3>
                    </div>
                    <form action="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
user/changedatabase" method="post" id="form">
                        <div class="card-body">
                            <div class="form-group">
                                <input type="text" class="form-control" name="database_name" id="database_name" value="MenTPS" readonly required>
                                <p id="db-error" class="mb-0" style="color: red; display: none;"></p>
                                <?php if (isset($_smarty_tpl->tpl_vars['error']->value)&&$_smarty_tpl->tpl_vars['error']->value!='') {?>
                                    <p class="mb-0" style="color: red;"><?php echo $_smarty_tpl->tpl_vars['error']->value;?>
</p>
                                <?php }?>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    var base_url = "<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
";
</script>



<script>
    $(document).ready(function () {
        console.log("URL: ", base_url);
        fetchDatabases();
        $('#form').on('submit', function (e) {
            e.preventDefault();
            var dbName = $('#database_name').val().trim();
            if (databases.includes(dbName)) {
                $('#db-error').hide();
                this.submit(); 
            } else {
                $('#db-error').text('DB không tồn tại. Vui lòng kiểm tra lại.').show();
            }
        });
    });

    var databases = []; 

    function fetchDatabases() {
        var dbUrl = base_url + "user/get_databases";
        console.log(dbUrl);
        $.get(dbUrl, function (response) {
            console.log(response);
            if (response.status === 'success') {
                databases = response.data; 
                var html = '';
                response.data.forEach(function (db) {
                    html += '<tr onclick="selectDatabase(\'' + db + '\')" style="cursor:pointer;"><td>' + db + '</td></tr>';
                });
                $('#db-list').html(html);
            } else {
                $('#db-list').html('<tr><td>Không có cơ sở dữ liệu nào</td></tr>');
            }
        }, 'json').fail(function (xhr, status, error) {
            console.error(error);
            console.error(xhr.responseText);
            $('#db-list').html('<tr><td>Lỗi tải dữ liệu</td></tr>');
        });
    }

    function selectDatabase(dbName) {
        console.log("Pick:", dbName);
        $('#database_name').val(dbName);
        $('#db-error').hide();
    }
</script>
<?php }} ?>
