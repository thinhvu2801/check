<div class="row">
    <div class="col-md-3">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Lựa chọn</h3>
            </div>
            <form action="{$base_url}fillet/worker" method="post" id="form">
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
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">LÔ</span>
                            </div>
                            <select class="form-control" name="lo_id" id="lo_id">
                                <option value="">Tất cả</option>
                                {foreach $lohang as $lo}
                                <option value="{$lo->lo_id}" {if $lo_id eq $lo->lo_id}selected{/if}>{$lo->lo_id}</option>
                                {/foreach}
                            </select>
                        </div>
                        <span>Cài đặt <a href="{$base_url}threshold">Định mức chuẩn </a> để phân loại đậu, rớt định mức</span>
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
        <div class="card card-info">
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
                            <td width="3%">TT</td>
                            <td width="7%">Ngày</td>
                            <td width="7%">Lô</td>
                            <td>Công nhân</td>
                            <td>Sản phẩm</td>
                            <td width="7%">&sum;SL</td>
                            <td width="7%">&sum;vào</td>
                            <td width="7%">&sum;ra</td>
                            <td width="7%">&sum;SL đạt</td>
                            <td width="7%">&sum;vào đạt</td>
                            <td width="7%">&sum;ra đạt</td>
                            <td width="7%">&sum;SL rớt</td>
                            <td width="7%">&sum;vào rớt</td>
                            <td width="7%">&sum;ra rớt</td>
                            <td width="7%">&sum;SL vượt</td>
                            <td width="7%">&sum;vào vượt</td>
                            <td width="7%">&sum;ra vượt</td>
                        </tr>
                    </thead>
                    <tbody>
                        {$i=1}
                        {$so_luong=0}
                        {$khoi_luong_vao=0}
                        {$khoi_luong_ra=0}
                        {foreach $result as $rs}
                         {$so_luong = $so_luong + $rs.so_luong}
                        {$khoi_luong_vao = $khoi_luong_vao + $rs.tong_kl_vao}
                        {$khoi_luong_ra = $khoi_luong_ra + $rs.tong_kl_ra}
                        <tr>
                            <td align="center">{$i++}</td>
                            <td align="center">{$rs.date|date_format:"d/m/Y"}</td>
                            <td align="center">{$rs.lo_id}</td>
                            <td>({$rs.worker_id}) {$rs.worker_name}</td>
                            <td>{$rs.product_name}</td>
                            <td align="right">{$rs.so_luong}</td>
                            <td align="right">{$rs.tong_kl_vao|number_format:3:",":"."}</td>
                            <td align="right">{$rs.tong_kl_ra|number_format:3:",":"."}</td>
                            <td align="right">{$rs.so_luong_dat}</td>
                            <td align="right">{$rs.kl_vao_dat_dm|number_format:3:",":"."}</td>
                            <td align="right">{$rs.kl_ra_dat_dm|number_format:3:",":"."}</td>
                            <td align="right">{$rs.so_luong_rot}</td>
                            <td align="right">{$rs.kl_vao_rot_dm|number_format:3:",":"."}</td>
                            <td align="right">{$rs.kl_ra_rot_dm|number_format:3:",":"."}</td>
                            <td align="right">{$rs.so_luong_vuot}</td>
                            <td align="right">{$rs.kl_vao_vuot_dm|number_format:3:",":"."}</td>
                            <td align="right">{$rs.kl_ra_vuot_dm|number_format:3:",":"."}</td>
                        </tr>
                        {/foreach}
                    </tbody>
                    <tfoot>
                        <tr align="right" style="font-weight: bold;">
                            <td align="right" colspan="5">Tổng: </td>
                             <td align="right">{$so_luong|number_format:0:",":"."}</td>
                            <td align="right">{$khoi_luong_vao|number_format:3:",":"."}</td>
                            <td align="right">{$khoi_luong_ra|number_format:3:",":"."}</td>
                            <td align="right"></td>
                            <td align="right"></td>
                            <td align="right"></td>
                            <td align="right"></td>
                            <td align="right"></td>
                            <td align="right"></td>
                            <td align="right"></td>
                            <td align="right"></td>
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
<script>
    $(document).ready(function() {
        $('#lo_id').select2();
        $('#dataTable').dataTable({ "scrollX": true});
        $('#reservationtime').daterangepicker({
            timePicker: true,
            startDate: '{$startDate}',
            endDate: '{$endDate}',
            timePickerIncrement: 1,
            timePicker24Hour:true,
            locale: {
                format: 'DD/MM/YYYY HH:mm A'
            }
        })
    });
</script>