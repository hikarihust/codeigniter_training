<?php
class User_model extends CI_Model{

    // Hàm khởi tạo
    public function __construct(){
        // Gọi đến hàm khởi tạo của cha
        parent::__construct();
        $this->load->database();
    }

    public function get_list(){
        $this->db->select('id, name, phone, email');
        // $where = array(
        //                 'email' => 'tuyenht90@yahoo.com'
        //             );
        // $this->db->where($where);
        $this->db->order_by('id', 'desc');
        $this->db->limit(10, 0);
        $query = $this->db->get('user');

        return $query->result();
    }

    public function create(){
        $data = array(
                    'name' => 'Hoc PHP',
                    'email' => 'hocphp@gmail.com',
                    'phone' => '123456'
                );
        $this->db->insert('user', $data);
    }

    public function update($id){
        $data = array(
                    'name' => 'Hoc PHP update',
                    'email' => 'hocphp_update@gmail.com',
                    'phone' => '111111'
                );
        $where = array(
                        'id' => $id
                    );
        $this->db->where($where);
        $this->db->update('user', $data);
    }

    public function delete(){
        $where = array(
                        'id' => 20
                    );
        $this->db->where($where);
        $this->db->delete('user');
    }
}