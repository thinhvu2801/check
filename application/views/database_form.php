<section class="content">
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
                    <form action="{$base_url}changedb/changedatabase" method="post" id="form">
                        <div class="card-body">
                            <div class="form-group">
                                <input type="text" class="form-control" name="database_name" id="database_name" value="MenTPS"  required>
                                <p id="db-error" class="mb-0" style="color: red; display: none;"></p>
                                {if isset($error) && $error neq ''}
                                    <p class="mb-0" style="color: red;">{$error}</p>
                                {/if}   
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                        </div>
                    </form>
                </div>
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Reset dữ liệu thẻ</h3>
                    </div>
                    <div class="card-body">
                        <div class="pr-2 pt-2">
                            <button type="button" class="btn btn-danger btn-sm" id="reset-btn" onclick="resetData()">
                            Reset dữ liệu
                            </button>
                        </div>
                        <div id="reset-message" class="mt-2"></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<script>
    var base_url = "{$base_url}";
</script>

{literal}
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
        var dbUrl = base_url + "changedb/get_databases";
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
        console.log("Pick: ", dbName);
        $('#database_name').val(dbName);
        $('#db-error').hide();
    }

    function resetData() {
        if (!confirm('Bạn có chắc chắn muốn reset dữ liệu?')) {
            console.log("Reset đã bị hủy bởi người dùng.");
            return;
        }

        $.post(base_url + "changedb/reset_data", function (response) {
            console.log("Reset response:", response);
            $('#reset-message').html(`
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Reset dữ liệu thành công! Đang chuyển hướng...
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>
            `);
            // Chờ 2 giây rồi redirect
            setTimeout(function () {
                window.location.href = base_url + "card/index";
            }, 2000);
        }).fail(function (xhr) {
            console.error("Reset failed:", xhr.responseText);
            $('#reset-message').html(`
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Reset thất bại. Vui lòng thử lại!
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>
            `);
        });
    }
</script>
{/literal}