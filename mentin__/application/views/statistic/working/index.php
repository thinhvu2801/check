<div class="row" style="overflow: visible;">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header ui-sortable-handle" style="cursor: move;">
                <h3 class="card-title">
                    <i class="fas fa-chart-pie mr-1"></i>
                    Thống kê
                </h3>
                <div class="card-tools">
                    <ul class="nav nav-pills ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#tab_nguyenlieu" data-toggle="tab">Nguyên liệu</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="#tab_fillet_detail" data-toggle="tab">Chi tiết Fillet</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#tab_fillet_over_threshold" data-toggle="tab">Rớt định mức Fillet</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#tab_suaca_detail" data-toggle="tab">Chi tiết Sửa cá</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#tab_suaca_over_threshold" data-toggle="tab">Rớt định mức Sửa cá</a>
                        </li>
                    </ul>
                </div>
            </div><!-- /.card-header -->
            <div class="card-body">
                <div class="tab-content p-0">
                    <!-- Morris chart - Sales -->
                    <div class="chart tab-pane" id="tab_nguyenlieu" style="position: relative;">
                        <div id="nguyenlieu">abc
                        </div>
                    </div>
                    <div class="chart tab-pane active" id="tab_fillet_detail" style="position: relative;">
                        <div id="fillet_detail">
                        </div>
                    </div>
                    <div class="chart tab-pane" id="tab_fillet_over_threshold" style="position: relative;">
                        <div id="fillet_over_threshold">
                        </div>
                    </div>
                    <div class="chart tab-pane" id="tab_suaca_detail" style="position: relative;">
                        <div class="form-group" style="display:none">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">KL vào</span>
                                </div>
                                <input type="number" value="4" step="0.001" id="weight_in1" class="form-control">
                            </div>
                        </div>
                        <div id="suaca_detail">
                        </div>
                    </div>
                    <div class="chart tab-pane" id="tab_suaca_over_threshold" style="position: relative;">
                        <div class="form-group" style="display:none">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">KL vào</span>
                                </div>
                                <input type="number" value="4" step="0.001" id="weight_in2" class="form-control">
                            </div>
                        </div>
                        <div id="suaca_over_threshold">
                        </div>
                    </div>
                </div>
            </div><!-- /.card-body -->
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        viewData();
    });
    var myVar = setInterval(viewData, 2000);

    function viewData() {
        $.post("{$base_url}working/nguyenlieu", {},
            function(data, status) {
                $("#nguyenlieu").html(data);
            });
        $.post("{$base_url}working/fillet_detail", {},
            function(data, status) {
                $("#fillet_detail").html(data);
            });
        $.post("{$base_url}working/fillet_over_threshold", {},
            function(data, status) {
                $("#fillet_over_threshold").html(data);
            });
        $.post("{$base_url}working/suaca_detail", {
                weight_in: $("#weight_in1").val()
            },
            function(data, status) {
                $("#suaca_detail").html(data);
            });
        $.post("{$base_url}working/suaca_over_threshold", {
                weight_in: $("#weight_in2").val()
            },
            function(data, status) {
                $("#suaca_over_threshold").html(data);
            });
    }
</script>