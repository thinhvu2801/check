<?php
class Utilities
{
  public function vitoen($str)
  {
    $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
    $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
    $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
    $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
    $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
    $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
    $str = preg_replace("/(đ)/", 'd', $str);
    $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
    $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
    $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
    $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
    $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
    $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
    $str = preg_replace("/(Đ)/", 'D', $str);
    $str = str_replace(" ", "-", $str);
    $str = str_replace("/", "-", $str);
    return $str;
  }
  public function addzero($str, $number)
  {
    $s = strlen($str);
    $rst = $str;
    for ($i = 0; $i < $number - $s; $i++) {
      $rst = "0" . $rst;
    }
    return $rst;
  }

  public function decode($str)
  {
    $str = str_replace("_", " ", $str);
    return $str;
  }
  function makefolder()
  {

    $today = date("m-Y");
    $folder_upload = "upload/" . $today . "/";
    if (!file_exists($folder_upload)) {
      $result = mkdir($folder_upload);
    }
    return $folder_upload;
  }
  function get_date($date)
  {
    $date = date_create($date);
    return date_format($date, "Y-m-d");
  }
  function dateforsql($date)
  {
    $date = explode("/", $date);
    return $date[2] . "-" . $date[1] . "-" . $date[0];
  }
  function dateforpicker($date)
  {
    $date = date_create($date);
    return date_format($date, "d/m/Y");
  }
  function export($data, $filename_output, $typeOutput=0)
  {
    $filename = $filename_output . ".csv";
    if ($typeOutput==0){
      $fp = fopen($filename, 'w');
      fwrite($fp, pack("CCC", 0xef, 0xbb, 0xbf)); //utf-8
      $header = array();
      if (sizeof($data) > 0) {
        $data0 = $data[0];
        foreach ($data0 as $k => $value) {
          array_push($header, $k);
        }
      }
      fputcsv($fp, $header);
      foreach ($data as $dt) {
        fputcsv($fp, $dt);
      }
      fclose($fp);
      $ex = new MyExcel();
      $ex->ConvertCSV2Excel($filename, $filename_output . '.xls');
    }else{
      header('Content-type: application/csv');
      header('Content-Disposition: attachment; filename=' . $filename);
      $fp = fopen('php://output', 'w');
      fwrite($fp, pack("CCC", 0xef, 0xbb, 0xbf)); //utf-8
      $header = array();
      if (sizeof($data) > 0) {
        $data0 = $data[0];
        foreach ($data0 as $k => $value) {
          array_push($header, $k);
        }
      }
      fputcsv($fp, $header);
      foreach ($data as $dt) {
        fputcsv($fp, $dt);
      }
      fclose($fp);
      exit;
    }

  }
  function exportExcel($data, $filename_output)
  {
    $filename = $filename_output . ".csv";
   
  }
}
