<div class="row">
    <div class="col-md-3">
        <div class="card card-info" id="card_filter">
            <div class="card-header">
                <h3 class="card-title">Lựa chọn</h3>
            </div>
            <form action="{$base_url}tambot/overview" method="post" id="form">
                <div class="card-body">
                    <div class="form-group">
                        <label>Ngày giờ:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-clock"></i></span>
                            </div>
                            <input type="text" class="form-control float-right" name="date" id="reservationtime">
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <div class="btn-group btn-block">
                        <button type="submit" class="btn btn-info btn-sm" name="statistic">Thống kê</button>
                        <button type="submit" class="btn btn-success btn-sm" name="export">Xuất file</button>
                    </div>
                </div>
                <!-- /.card-footer -->
            </form>
        </div>
    </div><!-- ./col-md-3-->
    <div class="col-md-9">
        <div class="card card-info" id="card_result">
            <div class="card-header">
                <h3 class="card-title">
                    Kết quả
                </h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr style="font-weight: bold;" align="center">
                            <td width="3%">STT</td>
                            <td>Nội dung</td>
                            <td>Khối lượng</td>
                            <td>Định mức</td>
                        </tr>
                    </thead>
                    <tbody>
                        {$i=1}
                        {foreach $result as $rs}
                        <tr>
                            <td align="center">{$i++}</td>
                            <td align="center">{$rs.product_name}</td>
                            <td align="right">{$rs.total|number_format:3:",":"."}</td>
                            <td align="center">1</td>
                        </tr>
                        {/foreach}
                    </tbody>
                    <tfoot>
                        <tr align="right" style="font-weight: bold;">
                            <td align="right" colspan="3">Tổng</td>
                            <td align="right"></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">

            </div>
            <!-- /.card-footer -->
        </div>
    </div><!-- ./col-md-8-->
</div>
<script type="text/javascript">
$(document).ready(function() {
    $('#lo_id').select2();
    $('#dataTable').DataTable({
        "stateSave": true,
        "pageLength":25
    });
    $('#reservationtime').daterangepicker({
        timePicker: true,
        singleDatePicker: true,
        startDate: '{$date}',
        timePickerIncrement: 1,
        timePicker24Hour:true,
        locale: {
            format: 'DD/MM/YYYY'
        }
    })
  } );
</script>