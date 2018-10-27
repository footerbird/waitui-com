<?php
class Flash_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function get_flashList($start,$length){//快讯列表页面,输出前$length条数
        $sql = "select * from flash_info order by create_time desc limit ".$start.",".$length;
        $query = $this->db->query($sql);
        return $query->result();
    }
    
}
?>