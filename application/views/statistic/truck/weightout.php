<div class="row">
    <div class="col-md-3">
        <div class="card card-info" id="card_filter">
            <div class="card-header">
                <h3 class="card-title">Lựa chọn</h3>
            </div>
            <form action="{$base_url}truck/weightout" method="post">
                <div class="card-body">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Ngày</span>
                            </div>
                            <input type="date" class="form-control" id="date" name="date" value="{$date}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">KH</span>
                            </div>
                            <select class="form-control" name="customer_id" id="customer_id">
                                <option value="">Tất cả</option>
                                {foreach $customer as $cus}
                                <option value="{$cus->customer_id}" {if $customer_id eq $cus->customer_id}selected{/if}>{$cus->customer_name}
                                </option>
                                {/foreach}
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="btn-group btn-block">
                        <button type="submit" class="btn btn-info btn-sm" name="statistic">Thống kê</button>
                        <!-- <button type="submit" class="btn btn-success btn-sm" name="export">Xuất file</button> -->
                    </div>
                </div>
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
                            <td>Ngày</td>
                            <td >Số phiếu</td>
                            <td>Biển số</td>
                            <td>Khách hàng</td>
                            <td>Sản phẩm</td>
                            <td>Khối lượng vào</td>
                            <td>Khối lượng ra</td>
                            <!-- <td>Khối lượng hàng</td> -->
                            <td>Thời gian vào</td>
                            <td>Thời gian ra</td> 
                            <td>Chú thích</td>
                        </tr>
                    </thead>
                    <tbody>
                        {$i=1}
                        {$khoi_luong=0}
                        {foreach $result as $rs}
                        <!-- {if $rs.weight_out neq 0} -->
                            {$khoi_luong = $khoi_luong + ($rs.weight_in - $rs.weight_out)}
                        <!-- {/if} -->
                        <tr>
                            <td align="center">{$i++}</td>
                            <td>{$rs.date|date_format:"d/m/Y"}</td>
                            <td align="center">{$rs.so_phieu}</td>
                            <td align="center">{$rs.xe_id}</td>
                            <td>{$rs.customer_name}</td>
                            <td>{$rs.product_name}</td>
                            <td align="right">{$rs.weight_in|number_format:3:",":"."}</td>
                            <td align="right">{$rs.weight_out|number_format:3:",":"."}</td>
                            <!-- <td align="right">{if $rs.weight_out eq 0}{($rs.weight_in - $rs.weight_in)|number_format:3:",":"."}{else}{($rs.weight_in - $rs.weight_out)|number_format:3:",":"."}{/if}</td> -->
                            <td>{$rs.time_in}</td>
                            <td>{$rs.time_out}</td> 
                            <td>{$rs.note}</td>
                        </tr>
                        {/foreach}
                    </tbody>
                    <tfoot>
                        <!-- <tr align="right" style="font-weight: bold;">
                            <td align="right" colspan="8">Tổng: </td>
                            <td align="right">{$khoi_luong|number_format:3:",":"."}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr> -->
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
    $('#customer_id').select2();
    $('#dataTable').dataTable();
});
</script>