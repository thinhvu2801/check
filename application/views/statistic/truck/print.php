<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bản in</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            flex-direction: column;
        }
        .tableDau th {
            font-size: 13px;
            font-family: 'Times New Roman', Times, serif;
            font-weight: normal;
        }
        #tb_title {
            position: relative;
        }

        #tb_body {
            position: relative;
            top: 10px; 
            border-collapse: collapse;
        }
        #tb_footer {
            margin-top: 25px;
        }
    </style>
</head>
<body>
    <table width='700' class="tableDau" id="tb_title" cellspacing="0">
        <thead>
            <tr>
                <td align="left">
                    <span >
                        CÔNG TY CỔ PHẦN GÒ ĐÀNG<br>
                        Địa chỉ: Lô 25 - KCN Mỹ Tho - xã Trung An - Mỹ Tho - Tiền Giang<br>
                        ĐT: 0123456879
                    </span>
                </td>
            </tr>
            <tr>
                <td align="center" style="font-weight: bold; font-size: 25px;">
                    <span>PHIẾU TIẾP NHẬN</span>
                </td>
            </tr>
            <tr>
                <td align="center">
                    <span>
                        <?php echo date_format(date_create(date("d-m-Y")), '\N\gà\y d \t\há\n\g m \nă\m Y'); ?>
                    </span>
                </td>
                
            </tr>
            <!-- <?php foreach ($result as $rs): ?>
                <tr>
                    <td align="right">Số phiếu: <?php echo $rs['so_phieu']; ?></td>
                </tr>
            <?php endforeach; ?> -->
        </thead>
    </table>
    <table width='700'>
        <thead>
            <?php 
                $printed = false;
                foreach ($result as $rs): 
                    if (!$printed) {
            ?>
                <tr>
                    <td>
                        Khách hàng: <?php echo $rs['customer_name'];?>
                    </td>
                    <!-- <td>
                        Biển số: <?php echo $rs['xe_id']; ?>
                    </td> -->
                </tr>
                <!-- <tr>
                    <td>
                        Loại hàng: <?php echo $rs['product_name']; ?>
                    </td>
                </tr> -->
            <?php 
                    $printed = true;
                }
            endforeach; 
            ?>
            <?php 
            $printed = false; 
            $allNull = true;
            foreach ($result as $rs): 
                if(!empty($rs['note'])){
                    $allNull = false;
                    if(!$printed){?>
                        <tr>
                            <td>
                                Ghi chú: <?php echo $rs['note']; ?>
                            </td>
                        </tr>
                    <?php 
                    $printed = true;
                    }
                }
            endforeach; 

            if($allNull && !$printed){ ?>
                <tr>
                    <td>
                        Ghi chú: 
                    </td>
                </tr>
            <?php } ?>

        </thead>
    </table>
    <table width="700" cellspacing="0" id="tb_body" border="1">
        <thead>
            <tr style="font-weight: bold;" align="center">
                <td width="3%">STT</td>
                <td>Số phiếu</td>
                <td>Biển số xe</td>
                <td>Loại hàng</td>
                <td>Thời gian vào</td>
                <td>Thời gian ra</td>
                <td>Trọng lượng xe và hàng</td>
                <td>Trọng lượng xe</td>
                <td>Trọng lượng hàng</td>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; $khoi_luong = 0; ?>
            <?php foreach ($result as $rs): ?>
                <?php $khoi_luong = $khoi_luong + ($rs['weight_in'] - $rs['weight_out']); ?>
                <tr>
                    <td align="center"><?php echo $i++; ?></td>
                    <td align="center"><?php echo $rs['so_phieu']; ?></td>
                    <td align="center"><?php echo $rs['xe_id']; ?></td>
                    <td align="center"><?php echo $rs['product_name']; ?></td>
                    <td align="center"><?php echo $rs['time_in']; ?></td>
                    <td align="center"><?php echo $rs['time_out']; ?></td>
                    <td align="right"><?php echo number_format($rs['weight_in'], 3, ",", "."); ?></td>
                    <td align="right"><?php echo number_format($rs['weight_out'], 3, ",", "."); ?></td>
                    <td align="right"><?php echo number_format($rs['weight_in'] - $rs['weight_out'], 3, ",", "."); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr align="right" style="font-weight: bold;">
                <td align="right" colspan="8">Tổng khối lượng hàng khi cân: </td>
                <td align="right"><?php echo number_format($khoi_luong, 3, ",", "."); ?></td>
            </tr>
            <tr align="right" style="font-weight: bold;">
                <td align="right" colspan="8">Khối lượng hàng thêm: </td>
                <td align="right"><?php echo number_format($weightExtra, 3, ",", "."); ?></td>
            </tr>
            <tr align="right" style="font-weight: bold;">
                <td align="right" colspan="8">Tổng: </td>
                <td align="right"><?php echo number_format($khoi_luong + $weightExtra, 3, ",", "."); ?></td>
            </tr>
        </tfoot>
    </table>
    <table width='700' height='50' id="tb_footer">
        <!-- <thead>
            <tr align="right">
                <td>Ngày....tháng....năm.........</td>
            </tr>
        </thead> -->
    </table>
    <table width='700'>
        <thead>
            <tr >
                <td style="font-weight: bold; font-size: 14px;" align="center">
                    <span>KHÁCH HÀNG</span>
                </td>
                <td style="font-weight: bold; font-size: 14px;" align="center">
                    <span>BẢO VỆ</span>
                </td>
                <td style="font-weight: bold; font-size: 14px;" align="center">
                    <span>NHÂN VIÊN</span>
                </td>
                <!-- <td style="font-weight: bold; font-size: 14px;">
                    <span>THỦ KHO</span>
                </td> -->
            </tr>
            <tr>
                <td style="font-style: italic; font-size: 13px;" align="center">
                    <span>(Ký, Họ tên)</span>
                </td>
                <td style="font-style: italic; font-size: 13px;" align="center">
                    <span>(Ký, Họ tên)</span>
                </td>
                <td style="font-style: italic; font-size: 13px;" align="center">
                    <span>(Ký, Họ tên)</span>
                </td>
                <!-- <td style="font-style: italic; font-size: 13px;">
                    <span>(Ký, Họ tên)</span>
                </td> -->
            </tr>
        </thead>
    </table>
</body>

</html>