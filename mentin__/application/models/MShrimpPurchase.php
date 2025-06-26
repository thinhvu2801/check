<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class MSuaCa extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    public function Detail($date)
    {
        $proc = "EXEC [dbo].[Shrimp_Purchase_Detail] @date = '$date'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
}