<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class MThongKe extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    public function HASACO_Process_Product_Read($fromday, $today,$fromtime, $totime){
        $proc="EXEC [dbo].[HASACO_Process_Product_Read] @fromday = '".$fromday."', @today = '".$today."', @fromtime = '".$fromtime."', @totime = '".$totime."'";
        $query=$this->db->query($proc);
        return $query->result();
    }
    public function HASACO_Process_Worker_Read($fromday, $today,$fromtime, $totime){
        $proc="EXEC [dbo].[HASACO_Process_Worker_Read] @fromday = '".$fromday."', @today = '".$today."', @fromtime = '".$fromtime."', @totime = '".$totime."'";
        $query=$this->db->query($proc);
        return $query->result();
    }
    public function HASACO_Process_ThongKe_By_Worker_Product($fromday, $today, $worker_id, $product_id,$option=0,$fromtime, $totime){//0: ra, 1: vào
        $proc="EXEC [dbo].[HASACO_Process_ThongKe_By_Worker_Product] @fromday = '".$fromday."', @today = '".$today."', @worker_id = '".$worker_id."', @product_id = '".$product_id."', @option = '".$option."', @fromtime = '".$fromtime."', @totime = '".$totime."'";
        $query=$this->db->query($proc);
        return $query->row();
    }
    public function Process_ThongKe_TongHop($fromday, $today,$worker_id, $option,$fromtime,$totime){
        $proc="EXEC [dbo].[HASACO_Process_ThongKe] @worker_id='".$worker_id."', @fromday = '".$fromday."', @today = '".$today."', @option = '".$option."', @fromtime = '".$fromtime."', @totime = '".$totime."'";
        $query=$this->db->query($proc);
        return $query->result();
    }
    public function Process_ThongKe_Error_Log($fromday, $today, $err_code){
        $otherdb = $this->load->database('scale567', TRUE);
        $proc="EXEC [dbo].[HASACO_ERROR_LOG_THONG_KE] @fromday = '".$fromday."', @today = '".$today."', @err_code = '".$err_code."'";
        $query=$otherdb->query($proc);
        return $query->result();
    }
    public function HASACO_ERROR_OTHER_THONG_KE($fromday, $today, $err_code){
        $proc="EXEC [dbo].[HASACO_ERROR_OTHER_THONG_KE] @fromday = '".$fromday."', @today = '".$today."', @error_code = '".$err_code."'";
        $query=$this->db->query($proc);
        return $query->result();
    }
    public function Process_ThongKe_SanPham($fromday, $today, $option){
        $proc="EXEC [dbo].[HASACO_Process_ThongKe_SanPham] @fromday = '".$fromday."', @today = '".$today."', @option = '".$option."'";
        $query=$this->db->query($proc);
        return $query->result();
    }
    public function Fillet_ChiTiet($fromday, $today,$worker_id){
        $proc="EXEC [dbo].[FILLET_CHITIET] @worker_id='".$worker_id."', @fromday = '".$fromday."', @today = '".$today."'";
        $query=$this->db->query($proc);
        return $query->result();
    }
    public function Process_ThongKe_ChiTiet($fromday, $today,$worker_id){
        $proc="EXEC [dbo].[HASACO_Process_ThongKe_ChiTiet] @worker_id='".$worker_id."', @fromday = '".$fromday."', @today = '".$today."'";
        $query=$this->db->query($proc);
        return $query->result();
    }
    public function Process_ThongKe_NguyenLieu_Nhap($fromday, $today){
        $proc="EXEC [dbo].[HASACO_NGUYENLIEU_NHAP_THONGKE] @fromday = '".$fromday."', @today = '".$today."'";
        $query=$this->db->query($proc);
        return $query->result();
    }
    public function Process_ThongKe_NguyenLieu_ChiTiet($fromday, $today,$product_id){
        $proc="EXEC [dbo].[HASACO_NGUYENLIEU_NHAP_THONGKE_CHITIET] @fromday = '".$fromday."', @today = '".$today."', @product_id = '".$product_id."'";
        $query=$this->db->query($proc);
        return $query->result();
    }
    public function Process_ThongKe_Fillet_NL($fromday, $today){
        $proc="EXEC [dbo].[HASACO_FILLET_THONGKE_NGUYENLIEU] @fromday = '".$fromday."', @today = '".$today."'";
        $query=$this->db->query($proc);
        return $query->result();
    }
    public function Process_ThongKe_Fillet_TP($fromday, $today){
        $proc="EXEC [dbo].[HASACO_FILLET_THONGKE_THANHPHAM] @fromday = '".$fromday."', @today = '".$today."'";
        $query=$this->db->query($proc);
        return $query->result();
    }
    public function Process_ThongKe_Fillet_NguyenLieu($fromday, $today,$worker_id){
        $proc="EXEC [dbo].[HASACO_FILLET_NGUYEN_LIEU_THONGKE] @worker_id='".$worker_id."', @fromday = '".$fromday."', @today = '".$today."'";
        $query=$this->db->query($proc);
        return $query->result();
    }
    public function Process_ThongKe_Fillet_ThanhPham($fromday, $today,$worker_id){
        $proc="EXEC [dbo].[HASACO_FILLET_THANH_PHAM_THONGKE] @worker_id='".$worker_id."', @fromday = '".$fromday."', @today = '".$today."'";
        $query=$this->db->query($proc);
        return $query->result();
    }
   /* public function ThongKeNguyenLieu($fromday, $today, $worker_id, $option){
        $proc="EXEC [dbo].[QuyTrinh_ThongKe2] @fromday = '".$fromday."', @today = '".$today."', @worker_id = '".$worker_id."', @option = '".$option."'";
        $query=$this->db->query($proc);
        return $query->result();
    }
    public function ThongKeThanhPham($fromday, $today, $worker_id, $option){
        $proc="EXEC [dbo].[QuyTrinh_ThongKeChiTietThanhPham2] @fromday = '".$fromday."', @today = '".$today."', @worker_id = '".$worker_id."', @option = '".$option."'";
        $query=$this->db->query($proc);
        return $query->result();
    }
    public function QuyTrinhChiTiet($p_id){
        $proc="EXEC [dbo].[QuyTrinh_ThongKeChiTietThanhPham] @p_id = '".$p_id."'";
        $query=$this->db->query($proc);
        return $query->result();
    }
    public function TinhLuong($fromday, $today){
        $proc="EXEC [dbo].[TINHLUONG] @fromday = '".$fromday."', @today = '".$today."'";
        $query=$this->db->query($proc);
        return $query->result();
    }
    public function TinhLuongChiTiet($fromday, $today){
        $proc="EXEC [dbo].[TINHLUONGCHITIET] @fromday = '".$fromday."', @today = '".$today."'";
        $query=$this->db->query($proc);
        return $query->result();
    }
    public function TinhLuongCongNhan($fromday, $today, $card_id){
        $proc="EXEC [dbo].[TINHLUONGCONGNHAN] @fromday = '".$fromday."', @today = '".$today."', @card_id='".$card_id."'";
        $query=$this->db->query($proc);
        return $query->result();
    }*/
}
?>