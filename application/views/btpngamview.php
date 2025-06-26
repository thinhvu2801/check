<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link href="../dist/img/ment.ico" type="image/x-icon" rel="shortcut icon" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MenT Automation</title>
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/v4-shims.min.css">
    <link rel="stylesheet" href="../plugins/select2/css/select2.min.css">
    <link href="../dist/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <link rel="stylesheet" href="../plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
    <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="../dist/css/scroller.dataTables.min.css">
    <style>
        ::-ms-reveal {
        display: none;
    }
    </style>
</head>
<body>
    <div class="row" style="overflow: visible;">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header ui-sortable-handle" style="cursor: move;">
                    <h3 class="card-title">
                        <i class="fas fa-chart-pie mr-1"></i>
                        Đang cân
                    </h3>
                </div>
                <div class="card-body">
                    <div class="tab-content p-0">
                        <div class="chart tab-pane active"  id="tab_suaca_working" style="position: relative;">
                            <div id="suaca_working">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../plugins/jquery/jquery.min.js"></script>
    <script src="../plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="../plugins/select2/js/select2.full.min.js"></script>
    <script src="../dist/js/jquery.dataTables.js"></script>
    <script src="../dist/js/dataTables.bootstrap4.min.js"></script>
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
    <script src="../plugins/chart.js/Chart.min.js"></script>
    <script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <script src="../plugins/moment/moment.min.js"></script>
    <script src="../plugins/daterangepicker/daterangepicker.js"></script>
    <script src="../dist/js/adminlte.js"></script>
    <script src="../dist/js/dataTables.scroller.min.js"></script>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
<script type="text/javascript">
    $(document).ready(function() {
        viewData();
    });
    var myVar = setInterval(viewData, 2000);

    function viewData() {
        $.post("../tambot/chitiet", {
                
            },
            function(data, status) {
                $("#suaca_working").html(data);
            });
    }
</script>
</script>
</body>
</html>