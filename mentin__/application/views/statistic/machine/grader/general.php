<div class="row">
    <div class="col-md-3">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Lựa chọn</h3>
            </div>
            <form action="{$base_url}machine/index/{$machine_code}/{$machine_serial}" method="post" id="form">
                <input type="hidden" name="machine_code" value="{$machine_code}"/>
                <input type="hidden" name="machine_serial" value="{$machine_serial}"/>
                <div class="card-body">
                    <!-- Date and time range -->
                    <div class="form-group">
                        <label>Ngày giờ:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-clock"></i></span>
                            </div>
                            <input type="text" class="form-control float-right" name="datetime" id="reservationtime">
                            <input type="hidden" name="option" value="1"/>
                        </div>
                        <!-- /.input group -->
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
     
       <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
              <tr class="btn-success" style="font-weight: bold;" align="center">
                <td width="3%">TT</td>
                <td>Ngày</td>
                <td>Size</td>
                <td>Số lượng</td>
                <td>Khối lượng</td>
                <td>Trung bình</td>
                <td>Thời gian</td>
              </tr>
          </thead>
              {$i=1}
              {$quantity = 0}
              {$total = 0}
              {$date=""}
              <tbody>
              
              {foreach $result as $rs}
              {$quantity = $quantity + $rs.quantity}
              {$total = $total + $rs.weight}
              
              <tr align="center">
                <td>{$i}</td>
                <td>
                  {if $rs.date|cat:$rs.lot neq $date}
                    {$rs.date|date_format:"d/m/Y"}(Lô {$rs.lot})
                    {$date=$rs.date|cat:$rs.lot}
                  {else}
                  -
                  {/if}
                </td>
                <td>{$rs.size}</td>
                <td align="right">{$rs.quantity|number_format:0:",":"."}</td>
                <td align="right">{$rs.weight|number_format:0:",":"."}</td>
                <td align="right">{if $rs.quantity neq 0}{($rs.weight/$rs.quantity)|number_format:0:",":"."}{/if}</td>
                <td>{$rs.min_time}-{$rs.max_time}</td>
              </tr>
              {$i = $i+ 1}
              {/foreach}
            </tbody>
            <tfoot>
               <tr style="font-weight: bold;" align="right">
                <td colspan="3">Tổng cộng: </td>
                <td>{$quantity|number_format:0:",":"."}</td>
                <td>{$total|number_format:0:",":"."}</td>
                <td colspan="4"></td>
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
<script>
    $(document).ready(function() {
        //$('#dataTable').dataTable();
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