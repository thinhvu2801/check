<?php
class MyExcel{

  public $obj;
  public $sheet;
  public $config=array('font' =>'Times New Roman',
    'size' =>12,
    'pagesetup' =>array('top' => 0.75,
      'right'=>0.4,
      'bottom'=>0.75 ,
      'left'=>0.5,
      'orientation'=>0)
    );
  public $column = array('0' => 'A', '1' => 'B','2' => 'C','3' => 'D','4' => 'E','5' => 'F','6' => 'G','7' => 'H','8' => 'I','9' => 'J','10' => 'K','11' => 'L','12' => 'M','13' => 'N','14' => 'O','15' => 'P','16' => 'Q','17' => 'R','18' => 'S','19' => 'T','20' => 'U','21' => 'V','22' => 'W','23' => 'X','24' => 'Y','25' => 'Z',
    '26' => 'AA','27' => 'AB','28' => 'AC','29' => 'AD','30' => 'AE','31' => 'AF','32' => 'AG','33' => 'AH','34' => 'AI','35' => 'AJ','36' => 'AK','37' => 'AL','38' => 'AM','39' => 'AN','40' => 'AO','41' => 'AP','42' => 'AQ','43' => 'AR','44' => 'AS','45' => 'AT','46' => 'AU','47' => 'AV','48' => 'AW','49' => 'AX','50' => 'AY','51' => 'AZ',
    '52' => 'BA','53' => 'BB','54' => 'BC','55' => 'BD','56' => 'BE','57' => 'BF','58' => 'BG','59' => 'BH','60' => 'BI','61' => 'BJ','62' => 'BK','63' => 'BL','64' => 'BM','65' => 'BN','66' => 'BO','67' => 'BP','68' => 'BQ','69' => 'BR','70' => 'BS','71' => 'BT','72' => 'BU','73' => 'BV','74' => 'BW','75' => 'BX','76' => 'BY','77' => 'BZ',
    '78' => 'CA','79' => 'CB','80' => 'CC','81' => 'CD','82' => 'CE','83' => 'CF','84' => 'CG','85' => 'CH','86' => 'CI','87' => 'CJ','88' => 'CK','89' => 'CL','90' => 'CM','91' => 'CN','92' => 'CO','93' => 'CP','94' => 'CQ','95' => 'CR','96' => 'CS','97' => 'CT','98' => 'CU','99' => 'CV','100' => 'CW','101' => 'CX','102' => 'CY','103' => 'CZ',
    '104' => 'DA','105' => 'DB','106' => 'DC','107' => 'DD','108' => 'DE','109' => 'DF','110' => 'DG','111' => 'DH','112' => 'DI','113' => 'DJ','114' => 'DK','115' => 'DL','116' => 'DM','117' => 'DN','118' => 'DO','119' => 'DP','120' => 'DQ','121' => 'DR','122' => 'DS','123' => 'DT','124' => 'DU','125' => 'DV','126' => 'DW','127' => 'DX','128' => 'DY','129' => 'DZ');
  function __construct(){
    set_include_path(get_include_path() . PATH_SEPARATOR . 'ClassesExcel/');
    require_once 'PHPExcel.php';
    require_once 'PHPExcel/RichText.php';
    require_once 'PHPExcel/IOFactory.php';
    $this->obj = new PHPExcel();
    
  }
  
  public function SetColumnAutoSize()
  {
    $getHighestColumn = $this->sheet->getHighestColumn();
    foreach(range('A',$getHighestColumn) as $column) {
      $this->sheet->getColumnDimension($column)->setAutoSize(true);
    }
  }
  public function SetColor($add)
  {
    $this->obj->getActiveSheet()->getStyle($add)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFFFF000');
  }

  public function SetSheet($sh){
    $this->obj->setActiveSheetIndex($sh);
    $this->sheet=$this->obj->getActiveSheet();
    /*đặt font, size*/
    $this->obj->getDefaultStyle()->getFont()->setName($this->config["font"])->setSize($this->config["size"]);
    /*page setup*/

    $this->sheet->getPageMargins()->setTop($this->config["pagesetup"]["top"]);
    $this->sheet->getPageMargins()->setRight($this->config["pagesetup"]["right"]);
    $this->sheet->getPageMargins()->setLeft($this->config["pagesetup"]["bottom"]);
    $this->sheet->getPageMargins()->setBottom($this->config["pagesetup"]["left"]);
    if($this->config["pagesetup"]["orientation"]==0)
      $this->sheet->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
    else
      $this->sheet->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
    $this->sheet->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
  } 
  public function setWidth($width) {
    foreach ($width as $key => $value) {
      $this->sheet->getColumnDimension($key)->setWidth($value);
    }
  }
  public function setvalue($values) {
    foreach ($values as $key => $value) {
      $this->sheet->setCellValue($key, $value);
    }
  }
  public function SetBorder($add){
    $styleBorder = array(
      'borders' => array(
        'outline' => array(
          'style' => PHPExcel_Style_Border::BORDER_THIN
          ),
        'inside' => array(
          'style' => PHPExcel_Style_Border::BORDER_THIN
          )
        )
      );
    $this->sheet->getStyle($add)->applyFromArray($styleBorder);
  }
  
  public function CellAlign($add,$opt='left'){
    switch ($opt) {
      case 'left':$align=PHPExcel_Style_Alignment::HORIZONTAL_LEFT;
      break;
      case 'right':$align=PHPExcel_Style_Alignment::HORIZONTAL_RIGHT;
      break;
      case 'center':$align=PHPExcel_Style_Alignment::HORIZONTAL_CENTER;
      break;
    }
    $this->sheet->getStyle($add)->getAlignment()->setHorizontal($align);
  }
  public function CellValign($add,$opt='top'){
    switch ($opt) {
      case 'top':$valign=PHPExcel_Style_Alignment::VERTICAL_TOP;
      break;
      case 'bottom':$valign=PHPExcel_Style_Alignment::VERTICAL_BOTTOM;
      break;
      case 'center':$valign=PHPExcel_Style_Alignment::VERTICAL_CENTER;
      break;
    }
    $this->sheet->getStyle($add)->getAlignment()->setVertical($valign);
  }
  public function WrapText($add){
    $this->sheet->getStyle($add)->getAlignment()->setWrapText(true);
  }
  public function Save($filename){
    $objWriter = PHPExcel_IOFactory::createWriter($this->obj, 'Excel5');
    $objWriter->save($filename);
  }
  public function FontStyle($add, $opt="R"){
    switch ($opt) {
      case 'B':
      $this->sheet->getStyle($add)->getFont()->setBold(true);
      break;
      case 'I':
      $this->sheet->getStyle($add)->getFont()->setItalic(true);
      break;
      default:
      $this->sheet->getStyle($add)->getFont()->setBold(false);
      $this->sheet->getStyle($add)->getFont()->setItalic(false);
      break;
    }
  }

  public function mergeCells($add){
    $this->obj->getActiveSheet()->mergeCells($add);
  }
  // public function SetFilter(){
    // $this->obj->getActiveSheet()->setAutoFilter($add);
  //   $this->obj->getActiveSheet()->setAutoFilter(
  //     $this->obj->getActiveSheet()
  //         ->calculateWorksheetDimension()
  // );
  // }
  public function SetFill($add,$color){
    $this->obj->getActiveSheet()->getStyle($add)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
    $this->obj->getActiveSheet()->getStyle($add)->getFill()->getStartColor()->setARGB($color);
  }
  public function ToCSV($file,$pathtosave){
      $inputFileType = 'Excel5';
      $inputFileName = $file["tmp_name"];
      $objReader = PHPExcel_IOFactory::createReader($inputFileType);
      $objPHPExcelReader = $objReader->load($inputFileName);
      $loadedSheetNames = $objPHPExcelReader->getSheetNames();
      $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcelReader, 'CSV');
      $objWriter->setSheetIndex(0);
      $objWriter->save($pathtosave."/".'exceltocsv.csv');
      return $pathtosave."/".'exceltocsv.csv';
  }
  public function ConvertCSV2Excel($fnameCSV,$fnameExcel){
    header('Content-type: application/vnd.ms-excel');
    header('Content-Disposition: attachment; filename='.$fnameExcel);
    $objReader = PHPExcel_IOFactory::createReader('csv');
    $objPHPExcel = $objReader->load($fnameCSV);
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    $objWriter->save('php://output');
  }
}
?>