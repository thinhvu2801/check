<div class="row">
  <div class="col-md-3">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">Chọn ngày</h3>
      </div>
      <div class="card-body">
       <form class="form-horizontal" method="post" action="{$base_url}checkweigher">
          <div class="input-group mb-3">
              <input type="date" class="form-control" id="date" name="date" placeholder="Từ ngày" required value="{$date}"> 
          </div>
          
          <div class="input-group mb-3">
              <button type="submit" class="btn btn-danger btn-block" name="thongke">Thống kê</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- col-md-3-->
  <div class="col-md-9">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">
            Danh sách loại sản phẩm
        </h3>
      </div>
      <div class="card-body">
      <div class="table-responsive">
        <p style="font-weight: bold;text-align: center;">Thống kê ngày {$date|date_format:"d/mY"} 
          </p>
       <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
              <tr class="btn-success" style="font-weight: bold;" align="center">
                <td width="3%">TT</td>
                
                <td>Size</td>
                <td>Số lượng</td>
                <td>Khối lượng</td>
              </tr>
          </thead>
              {$i=0}
              {$tong = 0}
              <tbody>
              {foreach $result as $rs}
              {if $rs.size neq 'Total'}
              {$tong = $tong + $rs.weight}
              <tr align="center">
                <td>{$i}</td>
                <td>{$rs.size}</td>
                <td>{$rs.quantity}</td>
                <td align="right">{$rs.weight|number_format:0:",":"."}</td>
              </tr>
              {$i = $i+ 1}
              {/if}
              {/foreach}
            </tbody>
            <tfoot>
               <tr style="font-weight: bold;" align="right">
                <td colspan="3">Tổng cộng: </td>
                <td>{$tong|number_format:0:",":"."}</td>
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

  </div>
  <!-- col-md-8-->
</div>


<script type="text/javascript">
  $(document).ready(function() {
    /*$( "#worker_id" ).combobox();*/
      $('#dataTable').DataTable({
        "language": {
          "decimal":        "",
          "emptyTable":     "Không có dữ liệu",
          "info":           "Hiển thị _START_ tới _END_ của _TOTAL_ các mục",
          "infoEmpty":      "Hiển thị 0 tới 0 của 0 các mục",
          "infoFiltered":   "(đã lọc từ _MAX_ tổng số mục)",
          "infoPostFix":    "",
          "thousands":      ",",
          "lengthMenu":     "Hiển thị _MENU_ mục",
          "loadingRecords": "Đang tải...",
          "processing":     "Đang xử lý...",
          "search":         "Tìm kiếm:",
          "zeroRecords":    "Không tìm thấy kết quả",
          "paginate": {
              "first":      "Đầu",
              "last":       "Cuối",
              "next":       "Tiếp",
              "previous":   "Trước"
          },
          "aria": {
              "sortAscending":  ": activate to sort column ascending",
              "sortDescending": ": activate to sort column descending"
          }
        }
    });
  } );
</script>