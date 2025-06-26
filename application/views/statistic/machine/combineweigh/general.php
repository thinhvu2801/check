<div class="row">
    <div class="col-md-3">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Lựa chọn</h3>
            </div>
            <form action="{$base_url}machine/index/{$machine_code}/{$machine_serial}" method="post" id="form">
                <input type="hidden" name="machine_code" value="{$machine_code}" />
                <input type="hidden" name="machine_serial" value="{$machine_serial}" />
                <input type="hidden" name="option" value="{$option}" />
                <div class="card-body">
                    <!-- Date and time range -->
                    <div class="form-group">
                        <label>Ngày giờ:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-clock"></i></span>
                            </div>
                            <input type="text" class="form-control float-right" name="datetime" id="reservationtime">
                        </div>
                        <!-- /.input group -->
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <div class="btn-group btn-block">
                        <button type="submit" class="btn btn-info btn-sm" name="detail">Chi tiết</button>
                        <button type="submit" class="btn btn-info btn-sm" name="general">Tổng hợp</button>
                        <button type="submit" class="btn btn-success btn-sm" name="export">Xuất file</button>
                    </div>
                </div>
                <!-- /.card-footer -->
            </form>
        </div>
    </div><!-- ./col-md-3-->
    <div class="col-md-9">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">
                    Kết quả
                </h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    {if $option eq 1}
                    <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr style="font-weight: bold;" align="center">
                                <td width="3%">STT</td>
                                <td>Loại túi</td>
                                <td>Size</td>
                                <td>Số túi</td>
                                <td>Số miếng</td>
                                <td>Khối lượng</td>
                                <td>Trung bình</td>
                                <td>Ghi chú</td>
                            </tr>
                        </thead>
                        <tbody>
                            {$i=1}
                            {$khoiluong=0}
                            {$kl_combine=0}
                            {$kl_piece=0}
                            {foreach $result as $rs}
                            
                            {$kl_combine=$kl_combine+$rs.count_combine}

                            {$kl_piece=$kl_piece+$rs.num_pieces}

                            {$khoiluong=$khoiluong+$rs.total_weight}
                            <tr align="center">
                                <td>{$i++}</td>
                                <td>{$rs.batch}</td>
                                <td>{$rs.size}</td>
                                <td>{$rs.count_combine|number_format:0:",":"."}</td>
                                <td>{$rs.num_pieces|number_format:0:",":"."}</td>
                                <td align="right">{$rs.total_weight|number_format:0:",":"."}</td>
                                <td>{$rs.avg_combine|number_format:0:",":"."}</td>
                                <td>{$rs.note}</td>
                            </tr>
                            {/foreach}
                        </tbody>
                        <tfoot>
                            <tr align="right" style="font-weight: bold;" >
                                <td colspan="3">Tổng: </td>
                                <td align="center">{$kl_combine|number_format:0:",":"."}</td>
                                <td align="center">{$kl_piece|number_format:0:",":"."}</td>
                                <td>{$khoiluong|number_format:0:",":"."}</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                    {else}
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr class="btn-success" style="font-weight: bold;" align="center">
                                <td width="3%">TT</td>
                                <td>Số miếng</td>
                                <td>Size</td>
                                <td>Túi</td>
                                <td>KL túi</td>
                                <td>KL từng miếng</td>
                                <td>Ghi chú</td>
                                <td>Thời gian</td>
                            </tr>
                        </thead>
                        {$i=1}
                        {$tong = 0}
                        <tbody>
                            {foreach $result as $rs}
                            {$tong = $tong + $rs.total_weight}
                            <tr align="center">
                                <td>{$i++}</td>
                                <td>{$rs.num_pieces|number_format:0:",":"."}</td>
                                <td>{$rs.size}</td>
                                <td>{$rs.batch}</td>
                                <td>{$rs.total_weight|number_format:0:",":"."}</td>
                                <td>{$rs.weight_scale}</td>
                                <td>{$rs.note}</td>
                                <td>{$rs.time|date_format:"%H:%M"}</td>
                            </tr>
                            {/foreach}
                        </tbody>
                        <tfoot>
                            <tr style="font-weight: bold;" align="right">
                                <td colspan="4">Tổng cộng: </td>
                                <td align="center">{$tong|number_format:0:",":"."}</td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                    {/if}
                </div>
                <div class="table-responsive">
                <table class="table table-bordered" id="dataTableReject" width="100%" cellspacing="0">
                        <thead>
                            <tr class="btn-danger" style="font-weight: bold;" align="center">
                                <td width="3%">TT</td>
                                <td>Tổ hợp loại</td>
                                <td>Số lần loại</td>
                                <td>Số miếng</td>
                                <td>Khối lượng</td>
                                <td>Ghi chú</td>
                            </tr>
                        </thead>
                        {$i=1}
                        {$tong = 0}
                        <tbody>
                            {foreach $reject as $rs}
                            {$tong = $tong + $rs.total_weight}
                            <tr>
                                <td  align="center">{$i++}</td>
                                <td>{$rs.type_combine}</td>
                                <td align="center">{$rs.count_combine|number_format:0:",":"."}</td>
                                <td align="center">{$rs.num_pieces|number_format:0:",":"."}</td>
                                <td align="right">{$rs.total_weight|number_format:0:",":"."}</td>
                                <td align="center">{$rs.note}</td>
                            </tr>
                            {/foreach}
                        </tbody>
                        <tfoot>
                            <tr style="font-weight: bold;" align="right">
                                <td colspan="4">Tổng cộng: </td>
                                <td align="right">{$tong|number_format:0:",":"."}</td>
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
<script>
    $(document).ready(function() {
        $('#lo_id').select2();
        $('#dataTable').dataTable();
        $('#reservationtime').daterangepicker({
            timePicker: true,
            startDate: '{$startDate}',
            endDate: '{$endDate}',
            timePickerIncrement: 1,
            timePicker24Hour: true,
            locale: {
                format: 'DD/MM/YYYY HH:mm A'
            }
        })
    });
</script>