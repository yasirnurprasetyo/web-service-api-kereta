<?php

if(!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kereta extends Restserver\Libraries\REST_Controller{

    //Panggil Kereta
    function __construct(){
        parent:: __construct();
        $this->load->model("KeretaModel");
    //cek Token
        header('Content-Type: application/json');
        if(checkToken()==FALSE){
            $this->response(["pesan"=>"Silahkan Login dulu Gan!"],401);
            exit();
        }
    }

    //Get AllProperty berdasarkan pencarian page dan search
    public function index_get($id = null){
        if ($id == null){
        $perpage = ($this->get("per_page")== NULL)? "10" : $this->get("per_page");
        $page = intval($this->get("page"));
        $search = ($this->get("search")== NULL)? "" : $this->get("search");
        $start = ((int)$page -1) *(int) $perpage;

        $total_row = $this->KeretaModel->totalRow($search);
        $total_page = ceil($total_row / $perpage);
        $keretas = $this->KeretaModel->getLimitData($perpage,$start,$search);
        
        $data = array(
            "meta" => array(
                "page" => $page,
                "per_page" => $perpage,
                "search" => $search,
                "total_row" => $total_row,
                "total_page" => $total_page
            ),
            "kereta_data" => $keretas,
        );
        $this->response($data, 200); 
    }else{
        $kereta = $this->KeretaModel->getByPrimaryKey($id);
        if ($kereta == null) {
            $this->response(array("message" => "Data tidak ditemukan"), 400);
        } else {
            $this->response($kereta, 200);
        }
    }
}
    
    //POST Kereta
    public function index_post(){
        
        //Tambah Kereta
        $data = array(
            "nama_kereta" => $this->post("nama_kereta", TRUE),
            "kelas" => $this->post("kelas", TRUE),
            "gerbong" => $this->post("gerbong", TRUE),
            "tgl_berangkat" => $this->post("tgl_berangkat", TRUE),
            "asal" => $this->post("asal", TRUE),
            "tujuan" => $this->post("tujuan", TRUE),
            "harga" => $this->post("harga", true),
        );
        echo json_encode($data, 200);
        $result = $this->KeretaModel->insert($data);
        if ($result) {
            $pesan = array (
                "message" => "Data Kereta Berhasil Disimpan"
            );
            $this->response($pesan, Restserver\Libraries\REST_Controller::HTTP_CREATED);
        } else {
            $pesan = array (
                "message" => "Data Kereta Gagal Disimpan"
            );
            $this->response($pesan, Restserver\Libraries\REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    //MengUpdate Data Kereta
    public function index_put(){
        $idKereta = $this->put("id_kereta", true);
        $kereta = $this->KeretaModel->getByPrimaryKey($idKereta);

        //Update Kereta
        $data = array(            
            "nama_kereta" => $this->put("nama_kereta", TRUE),
            "kelas" => $this->put("kelas", TRUE),
            "gerbong" => $this->put("gerbong", TRUE),
            "tgl_berangkat" => $this->put("tgl_berangkat", TRUE),
            "asal" => $this->put("asal", TRUE),
            "tujuan" => $this->put("tujuan", TRUE),
            "harga" => $this->put("harga",TRUE),
        );
        $result = $this->KeretaModel->update($data, $idKereta);
        if ($result) {
            $pesan = array(
                "message" => "Data Kereta Berhasil di Update"
            );
            $this->response($pesan, Restserver\Libraries\REST_Controller::HTTP_OK);
        } else {
            $pesan = array(
                "message" => "Data Kereta Gagal di Update"
            );
            $this->response($pesan, Restserver\Libraries\REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    //Hapus Data Kereta
    public function index_delete(){
        $idKereta = $this->delete("id_kereta", true);
        $kereta = $this->KeretaModel->getByPrimaryKey($idKereta);

        $result = $this->KeretaModel->delete($idKereta);
        if ($result) {
            $pesan = array(
                "message" => "Data Kereta Berhasil di Hapus"
            );
            $this->response($pesan, Restserver\Libraries\REST_Controller::HTTP_OK);
        } else {
            $pesan = array(
                "message" => "Data Kereta Gagal di Hapus"
            );
            $this->response($pesan, Restserver\Libraries\REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}