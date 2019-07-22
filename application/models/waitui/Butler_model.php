<?php
class Butler_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function get_butlerListAll(){//管家列表页面,输出全部条数
        $sql = "select * from butler_info order by create_time desc";
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    public function get_butlerDetail($butler_id){//管家编辑页面,传入butler_id
        $sql = "select * from butler_info where butler_id = ".$butler_id;
        $query = $this->db->query($sql);
        return $query->row();
    }
    
}
?>