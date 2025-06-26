<div class="row" style="overflow: visible;">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header ui-sortable-handle" style="cursor: move;">
                <h3 class="card-title">
                    <i class="fas fa-chart-pie mr-1"></i>
                    Đang cân
                </h3>
                <div class="card-tools">
                    <ul class="nav nav-pills ml-auto">
                        <li class="nav-item">
                            <a class="nav-link active" href="#tab_suaca_working" data-toggle="tab">Sửa cá</a>
                        </li>
                    </ul>
                </div>
            </div><!-- /.card-header -->
            <div class="card-body">
                <div class="tab-content p-0">
                    <!-- Morris chart - Sales -->
                    <div class="chart tab-pane active"  id="tab_suaca_working" style="position: relative;">
                        <div id="suaca_working">
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
        $.post("{$base_url}suaca/workingcontent", {
                
            },
            function(data, status) {
                $("#suaca_working").html(data);
            });
    }
</script>