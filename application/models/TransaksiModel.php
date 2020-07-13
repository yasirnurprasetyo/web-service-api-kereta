<?php
class TransaksiModel extends CI_Model{
    var $table = "transaksi";
    var $primaryKey = "id_transaksi";    
    
    public function getAll() {
        return $this->db->get($this->table)->result();
    }

    public function getByPrimaryKey($primaryKey) {
        $this->db->where($this->primaryKey,$primaryKey);
        return $this->db->get($this->table)->row();
    }

    public function insert($data) {
        return $this->db->insert($this->table,$data);
    }

    public function update($data, $primaryKey) {
        $this->db->where($this->primaryKey,$primaryKey);
        return $this->db->update($this->table,$data);
    }

    public function delete($primaryKey) {
        $this->db->where($this->primaryKey, $primaryKey);
        return $this->db->delete($this->table);
    }
    
    public function insertGetId($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    
    public function totalRow($search=null){
        return $this->db->count_all_results();
    }

    public function getLimitData($limit, $start=0, $search=null){
        return $this->db->get($this->table)->result();
    }
}