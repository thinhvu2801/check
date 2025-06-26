<div class="card card-info" id="card_result">
    <div class="card-header">
        <h3 class="card-title">
            Chi tiết
        </h3>
        <a href="{$base_url}truck/detail" class="btn btn-primary btn-sm float-right" style="margin-left:15px;">
            <i class="fa fa-arrow-left" aria-hidden="true"></i>
            Quay lại
        </a>
        <form action="{$base_url}truck/general/{$customer_id}/{$date}" method="post">
            <button type="submit" class="btn btn-success btn-sm float-right" name="export">Xuất file</button>
        </form>
        
        
    </div>
    <div class="card-body">
        <form action="{$base_url}truck/extraweight" method="post" id="form">
        <div class="table-responsive">
        <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr style="font-weight: bold;" align="center">
                    <td>STT</td>
                    <td>Ngày</td>
                    <td>Số phiếu</td>
                    <td>Biển số</td>
                    <td>Khách hàng</td>
                    <td>Sản phẩm</td>
                    <td>Khối lượng vào</td>
                    <td>Khối lượng ra</td>
                    <td>Khối lượng hàng</td>
                    <td>Thời gian vào</td>
                    <td>Thời gian ra</td> 
                    <td>Chú thích</td>
                    <td></td>
                    <!-- <td>KL thêm</td> -->
                </tr>
            </thead>
            <tbody>
                {$i=1}
                {$khoi_luong=0}
                {foreach $result as $rs}
                {if $rs.weight_out neq 0}
                    {$khoi_luong = $khoi_luong + ($rs.weight_in - $rs.weight_out)}
                {/if}
                <tr>
                    <input type="hidden" name="customer_id" value="{$customer_id}">
                    <input type="hidden" name="date" value="{$date}">
                    <td align="center">{$i++}</td>
                    <td>{$rs.date|date_format:"d/m/Y"}</td>
                    <td align="center">{$rs.so_phieu}</td>
                    <!-- <input type="hidden" name="so_phieu[]" value="{$rs.so_phieu}"> -->
                    <td align="center">{$rs.xe_id}</td>
                    <td>{$rs.customer_name}</td>
                    <td>{$rs.product_name}</td>
                    <td align="right">{$rs.weight_in|number_format:3:",":"."}</td>
                    <td align="right">{$rs.weight_out|number_format:3:",":"."}</td>
                    <td align="right">{if $rs.weight_out eq 0}{($rs.weight_in - $rs.weight_in)|number_format:3:",":"."}{else}{($rs.weight_in - $rs.weight_out)|number_format:3:",":"."}{/if}</td>
                    <td>{$rs.time_in}</td>
                    <td>{$rs.time_out}</td> 
                    <td>{$rs.note}</td>
                    <td width="5%">
                        <input type="button" class="btn btn-block btn-primary btn-xs" style="margin-top:5px; padding:5px;" value="In" name="printvalue2" data-so-phieu="{$rs.so_phieu}">
                        {if ($admin eq 1) or ( $admin eq 99)}
                            {if $rs.weight_out eq 0}
                                <input type="button" name="editButton" style="margin-top:5px; padding:5px;" value="Sửa" data-toggle="modal" data-target="#update{$rs.so_phieu}" style="cursor: pointer;" alt="Điều chỉnh">
                                </input>
                            {/if}
                        {/if}
                    </td>
                    <!-- <td width="8%">
                        <input type="number" class="form-control" name="weight_remain[]"
                            value="0" min="0" step="0.01"/>
                    </td> -->
                </tr>
                {/foreach}
            </tbody>
            <tfoot>
                <tr align="right" style="font-weight: bold;">
                    <td align="right" colspan="8">Tổng khối lượng hàng khi cân: </td>
                    <td align="right">{$khoi_luong|number_format:3:",":"."}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr align="right" style="font-weight: bold;">
                    <td align="right" colspan="8">Khối lượng hàng thêm: </td>
                    <td>
                        <input type="number" class="form-control" name="weight_remain"
                        value="{if empty($extra_weight)}0{else}{$extra_weight}{/if}" min="0" step="0.01"/>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr align="right" style="font-weight: bold;">
                    <td align="right" colspan="8">Tổng: </td>
                    <td align="right">{if empty($extra_weight)}{$khoi_luong|number_format:3:",":"."}{else}{($extra_weight + $khoi_luong)|number_format:3:",":"."}{/if}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
        </div>
        <div class="card-footer">
            <div class="btn-group btn-block">
                <button type="submit" class="btn btn-block btn-outline-dark btn-flat" style="margin-top:5px; padding:5px;font-size:15px;margin-right:35px;" name="kiemke">Thêm khối lượng</button>
                <input type="button" class="btn btn-block btn-outline-primary btn-flat" style="margin-top:5px; padding:5px;" value="In chi tiết" name="printvalue">
            </div>
        </div>
        </form>
    </div>
</div>
{foreach $result as $rs}
<div class="modal fade" id="update{$rs.so_phieu}">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Điều chỉnh</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal" method="post" name="updateproduct" action="{$base_url}truck/update">
        <input type="hidden" name="customer_id" value="{$customer_id}">
        <input type="hidden" name="date" value="{$date}">
        <input type="hidden" name="so_phieu" value="{$rs.so_phieu}">
        <input type="hidden" name="xe_id" value="{$rs.xe_id}">
        <div class="modal-body">
            <div class="form-group row">
            <label for="so_phieu" class="col-sm-2 col-form-label">Số phiếu:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="so_phieu{$rs.so_phieu}" name="so_phieu" placeholder="Số phiếu" required value="{$rs.so_phieu}" disabled>
                </div>
            </div>
          <div class="form-group row">
            <label for="xe_id" class="col-sm-2 col-form-label">Biển số:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="xe_id{$rs.so_phieu}" name="xe_id" placeholder="Biển số" required value="{$rs.xe_id}" disabled>
            </div>
          </div>
          <div class="form-group row">
            <label for="weight_out" class="col-sm-2 col-form-label">Khối lượng ra:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" placeholder="Khối lượng ra" id="weight_out{$rs.so_phieu}" name="weight_out" placeholder="Khối lượng ra" required value="{$rs.weight_out}">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Đóng</button>
          <button type="submit" class="btn btn-primary btn-sm" name="editcapnhat" data-so-phieu="{$rs.so_phieu}">Cập nhật</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
{/foreach}
<script type="text/javascript">
$(document).ready(function() {
    $('#dataTable').dataTable();

    function printphieu() {
        // Tạo request mới và chuyển hướng đến trang in, truyền dữ liệu qua phương thức POST
        $.ajax({
            type: 'POST',
            url: '{$base_url}truck/printvalue/{$customer_id}/{$date}/{$extra_weight}',
            success: function(response) {
                // Mở trang in trong cửa sổ mới
                var iframe = document.createElement('iframe');
                iframe.style.display = 'none';

                // Gán nội dung HTML cho iframe
                iframe.srcdoc = response;

                // Thêm iframe vào body của trang hiện tại
                document.body.appendChild(iframe);

                // Thêm sự kiện onload cho iframe để khi nó đã được load, thực hiện window.print()
                iframe.onload = function() {
                    var style = document.createElement('style');
                    style.textContent = `
                        @page {
                            size: auto;
                            margin: 1.5cm 0 0 0;
                        }
                    `;
                    iframe.contentDocument.head.appendChild(style);

                    iframe.contentWindow.print();
                };
            }
        });
    }

    $('input[name="printvalue"]').on('click', function() {
        printphieu();
    });

    $('button[name="editcapnhat"]').on('click', function() {
      $('input[name="editButton"]').attr('type', 'hidden');
    });

    function printphieu2(so_phieu) {
            $.ajax({
                type: 'POST',
                url: '{$base_url}truck/printdetail/' + so_phieu,
                success: function(response) {
                    var iframe = document.createElement('iframe');
                    iframe.style.display = 'none';

                    iframe.srcdoc = response;

                    document.body.appendChild(iframe);

                    iframe.onload = function() {
                        var style = document.createElement('style');
                        style.textContent = `
                            @page {
                                size: auto;
                                margin: 1.5cm 0 0 0;
                            }
                        `;
                        iframe.contentDocument.head.appendChild(style);

                        iframe.contentWindow.print();
                    };
                }
            });
        }

    $('input[name="printvalue2"]').on('click', function() {
        var so_phieu = $(this).data('so-phieu');
        printphieu2(so_phieu);
    });
});
</script>