<?php
class Welfare_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function get_welfareList(){//福利列表
        $sql = "select * from welfare_info where welfare_status = 1 order by publish_time desc";
        $query = $this->db->query($sql);
        return $query->result();
    }
    
}
?>