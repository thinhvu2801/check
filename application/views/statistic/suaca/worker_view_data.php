<div class="col-md-12">
    <div class="card card-info">
        <div class="card-header" style="text-align: center;">
            <h3 class="card-title">
                <h4>
                    {if $result_yesterday|count > 0}
                    ({$result_yesterday[0].worker_id}) {$result_yesterday[0].worker_name}
                    {else}
                    {if $result_today|count > 0}
                    ({$result_today[0].worker_id}) {$result_today[0].worker_name}
                    {/if}
                    {/if}
                </h4>
            </h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="table-responsive">
                        <div style="text-align:center">
                            <h5>
                                {if $result_yesterday|count > 0}
                                Ngày {$result_yesterday[0].date|date_format:"d/m/Y"}
                                {else}
                                #
                                {/if}
                            </h5>
                        </div>
                        <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr style="font-weight: bold;" align="center">
                                    <td width="3%">STT</td>
                                    <td>Lô</td>
                                    <td>Sản phẩm</td>
                                    <td>Số rổ</td>
                                    <td>&sum;KL vào</td>
                                    <td>&sum;KL ra</td>
                                    <td>Đ.mức</td>
                                </tr>
                            </thead>
                            <tbody>
                                {$i=1}
                                {$quantity=0}
                                {$weight_in=0}
                                {$weight_out=0}
                                {foreach $result_yesterday as $rs}
                                {$quantity = $quantity + $rs.quantity}
                                {$weight_in = $weight_in + $rs.weight_in}
                                {$weight_out = $weight_out + $rs.weight_out}
                                <tr>
                                    <td align="center">{$i++}</td>
                                    <td align="center">{$rs.lo_id}</td>
                                    <td>{$rs.product_name}</td>
                                    <td align="right">{$rs.quantity}</td>
                                    <td align="right">{$rs.weight_in|number_format:3:",":"."}</td>
                                    <td align="right">{$rs.weight_out|number_format:3:",":"."}</td>
                                    <td align="right">{$rs.dinh_muc|number_format:3:",":"."}</td>
                                    <!-- <td align="center">{$rs.min_time|date_format:"%H:%M"}-{$rs.max_time|date_format:"%H:%M"}</td> -->
                                </tr>
                                {/foreach}
                            </tbody>
                            <tfoot>
                                <tr style="font-weight:bold;">
                                    <td align="right" colspan="3">Tổng giờ: {if $result_yesterday|count > 0}
                                        {$result_yesterday[0].total_time}
                                        {/if}</td>
                                    <td align="right">{$quantity}</td>
                                    <td align="right">{$weight_in|number_format:3:",":"."}</td>
                                    <td align="right">{$weight_out|number_format:3:",":"."}</td>
                                    <td align="right">

                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="table-responsive">
                        <div style="text-align:center">
                            <h5>
                                {if $result_today|count > 0}
                                Ngày {$result_today[0].date|date_format:"d/m/Y"}
                                {else}
                                #
                                {/if}
                            </h5>
                        </div>
                        <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr style="font-weight: bold;" align="center">
                                    <td width="3%">STT</td>
                                    <td>Lô</td>
                                    <td>Sản phẩm</td>
                                    <td>Số rổ</td>
                                    <td>&sum;KL vào</td>
                                    <td>&sum;KL ra</td>
                                    <td>Đ.mức</td>
                                </tr>
                            </thead>
                            <tbody>
                                {$i=1}
                                {$quantity=0}
                                {$weight_in=0}
                                {$weight_out=0}
                                {foreach $result_today as $rs}
                                {$quantity = $quantity + $rs.quantity}
                                {$weight_in = $weight_in + $rs.weight_in}
                                {$weight_out = $weight_out + $rs.weight_out}
                                <tr>
                                    <td align="center">{$i++}</td>
                                    <td align="center">{$rs.lo_id}</td>
                                    <td>{$rs.product_name}</td>
                                    <td align="right">{$rs.quantity}</td>
                                    <td align="right">{$rs.weight_in|number_format:3:",":"."}</td>
                                    <td align="right">{$rs.weight_out|number_format:3:",":"."}</td>
                                    <td align="right">{$rs.dinh_muc|number_format:3:",":"."}</td>
                                    <!-- <td align="center">{$rs.min_time|date_format:"%H:%M"}-{$rs.max_time|date_format:"%H:%M"}</td> -->
                                </tr>
                                {/foreach}
                            </tbody>
                            <tfoot>
                                <tr style="font-weight:bold;">
                                    <td align="right" colspan="3">Tổng giờ: {if $result_today|count > 0}
                                        {$result_today[0].total_time}
                                        {/if}</td>
                                    <td align="right">{$quantity}</td>
                                    <td align="right">{$weight_in|number_format:3:",":"."}</td>
                                    <td align="right">{$weight_out|number_format:3:",":"."}</td>
                                    <td align="right">

                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.card-body -->
        <div class="card-footer">

        </div>
        <!-- /.card-footer -->
    </div>
</div><!-- ./col-md-8-->