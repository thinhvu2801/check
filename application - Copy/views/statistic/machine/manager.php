<div class="row">
    <div class="col-md-3">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Thêm thủ công</h3>
            </div>
            <form action="{$base_url}machine/manager" method="post">
                <div class="card-body">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Server</span>
                            </div>
                            <input type="text" class="form-control" name="server" id="server"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">User</span>
                            </div>
                            <input type="text" class="form-control" name="user" id="user"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Password</span>
                            </div>
                            <input type="text" class="form-control" name="password" id="password"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Database</span>
                            </div>
                            <input type="text" class="form-control" name="db_name" id="db_name"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Machine code</span>
                            </div>
                            <input type="text" class="form-control" name="machine_code" id="machine_code"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Machine serial</span>
                            </div>
                            <input type="text" class="form-control" name="machine_serial" id="machine_serial"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Machine name</span>
                            </div>
                            <input type="text" class="form-control" name="machine_name" id="machine_name"/>
                        </div>
                    </div>
                    <!-- /input-group -->
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <div class="btn-group btn-block">
                        <button type="submit" class="btn btn-info btn-sm" name="insert">Thêm</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- card-info-->
    </div><!-- ./col-md-3-->
    <div class="col-md-9">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Danh sách thiết bị</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr style="font-weight: bold;" align="center">
                                <td width="3%">STT</td>
                                <td width="15%">Server</td>
                                <td width="15%">User</td>
                                <td width="15%">Password</td>
                                <td width="15%">Database</td>
                                <td width="15%">Code</td>
                                <td width="15%">Serial</td>
                                <td width="15%">Name</td>
                                <td width="15%">Chức năng</td>
                            </tr>
                        </thead>
                        {$i=1}
                        {foreach $machine as $mc}
                        <tr align="center">
                            <td>{$i++}</td>
                            <td>{$mc->server}</td>
                            <td>{$mc->_user}</td>
                            <td>{$mc->password}</td>
                            <td>{$mc->db_name}</td>
                            <td>{$mc->machine_code}</td>
                            <td>{$mc->machine_serial}</td>
                            <td>{$mc->machine_name}</td>
                            <td>
                                <a style="color: #17a2b8" href="#" data-toggle="modal" data-target="#update{$mc->id}" style="cursor: pointer;" alt="Điều chỉnh">
                                    <i class="fas fa-pencil-alt">
                                    </i>
                                </a>
                                <a style="color: #da251d" href="{$base_url}machine/delete/{$mc->id}" onclick="return confirm('Bạn có chắc chắn xóa không?');">
                                    <i class="fas fa-trash">
                                    </i>
                                </a>
                            </td>
                        </tr>
                        {/foreach}
                    </table>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
            </div>
            <!-- /.card-footer -->
        </div>
        <!-- card-info-->
    </div><!-- ./col-md-9-->
</div>
{foreach $machine as $mc}
<div class="modal fade" id="update{$mc->id}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Điều chỉnh</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-horizontal" method="post" name="updatemachine" action="{$base_url}machine/manager">
                <input type="hidden" name="id" value="{$mc->id}">
                <div class="modal-body">
                <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Server</span>
                            </div>
                            <input type="text" class="form-control" name="server" id="server" value="{$mc->server}"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">User</span>
                            </div>
                            <input type="text" class="form-control" name="user" id="user" value="{$mc->_user}"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Password</span>
                            </div>
                            <input type="text" class="form-control" name="password" id="password"  value="{$mc->password}"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Database</span>
                            </div>
                            <input type="text" class="form-control" name="db_name" id="db_name"  value="{$mc->db_name}"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Machine code</span>
                            </div>
                            <input type="text" class="form-control" name="machine_code" id="machine_code"  value="{$mc->machine_code}"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Machine serial</span>
                            </div>
                            <input type="text" class="form-control" name="machine_serial" id="machine_serial" value="{$mc->machine_serial}"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Machine name</span>
                            </div>
                            <input type="text" class="form-control" name="machine_name" id="machine_name" value="{$mc->machine_name}"/>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary btn-sm" id="update" name="update">Cập nhật</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
{/foreach}
<script>
    $(document).ready(function() {
        $("#server").focus();
        $('#dataTable').DataTable({
            stateSave: true
        });
    });
</script>