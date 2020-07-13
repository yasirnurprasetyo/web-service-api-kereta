<?php

require 'CrudFunction.php';
class KeretaModel extends CI_Model implements CrudFunction{

    //Definisikan nama table dan primary key nya.
    var $table = "kereta";
    var $primaryKey = "id_kereta";

    //Implementasi Crud Function
    public function getAll(){
        return $this->db->get($this->table)->result();
    }

    public function getByPrimaryKey($primaryKey){
        $this->db->where($this->primaryKey, $primaryKey);
        return $this->db->get($this->table)->row();
    }

    public function insert($data){
        return $this->db->insert($this->table, $data);
    }

    public function update($data, $primaryKey){
        $this->db->where($this->primaryKey, $primaryKey);
        return $this->db->update($this->table, $data);
    }

    public function delete($primaryKey){
        $this->db->where($this->primaryKey, $primaryKey);
        return $this->db->delete($this->table);
    }

    //Mencari data menggunakan Like
    //Menghitung total barisnya berapa?
    public function totalRow($search = null){
        $this->db->like("nama_kereta",$search);
        $this->db->or_like("kelas",$search);
        $this->db->or_like("gerbong",$search);
        $this->db->or_like("asal",$search);
        $this->db->or_like("tujuan",$search);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    //Mencari isi atau Data
    public function getLimitData($limit,$start=0, $search=null){
        $this->db->like("nama_kereta",$search);
        $this->db->or_like("kelas",$search);
        $this->db->or_like("gerbong",$search);
        $this->db->or_like("asal",$search);
        $this->db->or_like("tujuan",$search);
        $this->db->limit($limit,$search);
        return $this->db->get($this->table)->result();
    }
}