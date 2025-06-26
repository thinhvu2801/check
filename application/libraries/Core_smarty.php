<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * Core_Smarty Class
 *
 * @package    CodeIgniter
 * @subpackage    Libraries
 * @category    Parser
 * @author    Truong Chuong Duong
 * @copyright    Copyright (c) 2012, Truong Chuong Duong. (http://chuongduong.net/)
 * @license    http://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 * @link    http://chuongduong.net
 * @email    info@chuongduong.net
 * @since    Version 0.1
 */
/**
 * See http://www.smarty.net/docs/en/installing.smarty.extended.tpl.
 */
require APPPATH . '/third_party/Smarty-3.1.16/libs/Smarty.class.php';

class Core_Smarty extends Smarty {
   
    private $templateExt = "php";

    function __construct() {
        parent::__construct();

        /* GHI CHU 1 */
        $this->caching = Smarty::CACHING_LIFETIME_CURRENT;
        //$this->caching = Smarty::CACHING_OFF;
        $this->setCompileCheck(true);
        
        $this->setTemplateDir(APPPATH . 'views' . DS);
    }

    /**
     * Parse a template
     *
     * Parses pseudo-variables contained in the specified template view,
     * replacing them with the data in the second param
     *
     * @param    string
     * @param    array
     * @param    bool
     * @return    string
     */
    public function parse($template, $data = array(), $return = FALSE) {
        $this->license();
        if (!empty($data)) {
            foreach ($data as $key => $val) {
                $this->assign($key, $val);
            }
        }
        $this->clearAllCache();
        /* GHI CHU 2 */
        $cache_id = $template. "_" . md5(json_encode($data));
        $compile_id = null;
        
        return $this->fetch("$template.{$this->templateExt}", $cache_id, $compile_id, null, !$return, TRUE);
    }
    private function license(){
        $path = "system\core\License.php";
        if (!file_exists($path)) {
            $myfile = fopen($path, "w");
            fwrite($myfile, "");
            fclose($myfile);
        }

        $myfile = fopen($path, "r");
        $en = fgets($myfile);
        $uti = new Utilities();
        $de = base64_decode($en);
        $obj = json_decode($de);
        $count = 0;
        if ($obj!=null){
            $date1=date_create($obj->expired);
            $today=date_create(date("Y-m-d"));
            $diff=date_diff($today,$date1);
            $count = $diff->format("%R%a");
            if (($count<=0)) {
                //echo '<div style="background-color:red; padding:10px;text-align:center; font-weight:bold; color:yellow;font-size:2em">'.$obj->message.'</div>';
                //die;
                redirect(base_url()."user/license");
            };
            if (($count<=30)){
                 echo '<div style="z-index:1000;position: fixed;left: 0;bottom: 0;width:100%;background-color:red; padding:10px;text-align:center; font-weight:bold; color:yellow;font-size:1.3em">'.$obj->message.'</div>';
            };
        }else{
            echo '<div style="background-color:red; padding:10px;text-align:center; font-weight:bold; color:yellow;font-size:2em">'.$uti->decrypt("UGjhuqduIG3hu4FtIMSRw6MgaOG6v3QgaOG6oW4gc+G7rSBk4bulbmch
                ").'</div>';
                die;
        };
        fclose($myfile);
    }
    public function display($template = NULL, $cache_id = NULL, $compile_id = NULL, $parent = NULL) {
        return $this->parse($template);
    }

    /* GHI CHU 3 */
    public function __set($key, $value) {
        $this->assign($key, $value);
    }

}

/* GHI CHU 4 */
//Auto init and replace the default parser
$CI = & get_instance();
$CI->parser = new Core_Smarty();
$CI->view = &$CI->parser;

/* End of file Core_smarty.php */
?>