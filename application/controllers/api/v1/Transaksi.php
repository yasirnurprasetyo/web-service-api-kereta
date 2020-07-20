<?php
use Restserver\Libraries\REST_Controller;
require (APPPATH.'/libraries/REST_Controller.php');
class Transaksi extends REST_Controller{
    function __construct() {
        parent::__construct();
        $this->load->model(array("TransaksiModel","ItemTransaksiModel"));
        header("Content-Type=application/json");
        if (checkToken() == false) {
            $this->response(array("pesan" => "Silahkan Login Dahulu"), 401);
            exit();
        }
    }

    public function index_get($id = null) {
        if ($id == null) {
            $perPage = ($this->get("per_page") == null) ? "10" : $this->get("per_page");
            $page = ($this->get("page") == null) ? "1" : $this->get("page");
            $search = ($this->get("search") == null) ? "" : $this->get("search");   
            $start = ((int) $page - 1) * (int) $perPage;
            $total_row = $this->TransaksiModel->totalRow($search);
            $total_page = ceil($total_row / $perPage) + 1;
            $transaksis = $this->TransaksiModel->getLimitData($perPage, $start, $search);
            $data = array(
                "meta" => array(
                    "search" => $search,
                    "page" => $page,
                    "per_page" => $perPage,
                    "total_row" => $total_row,
                    "total_page" => $total_page
                ),
                "data" => $transaksis,
            );
            $this->response($data, 200);
        } else {
            $transaksi = $this->TransaksiModel->getByPrimaryKey($id);
            if ($transaksi == null) {
                $this->response(array("message" => "Data tidak ditemukan"), 400);
            } else {
                $itemTransaksi = $this->ItemTransaksiModel->get_join_lengkap($id);
                $transaksi->item_transaksi = $itemTransaksi;
                $this->response($transaksi, 200);
            }
        }
    }

    public function index_post() {
        //menambah data transaksi dari client menggunakan json
        $dataRequest = json_decode(file_get_contents("php://input"));
        $itemTransaksi = $dataRequest->item_transaksi;
        //create transaksi
        $nomor = getLastNomor("transaksi")->nomor + 1;
        $nomorTransaksi = autoCreate(array("TRX"), "/", $nomor);
        $dataTransaksi = array(
            "nomor" => $nomor,
            "no_transaksi" => $nomorTransaksi,
            "tanggal_transaksi" => date("Y-m-d")
        );
        $idTransaksi = $this->TransaksiModel->insertGetId($dataTransaksi);
        //populate data transaksi
        $dataSimpan = array();
        foreach ($itemTransaksi as $item) {
            $dataSimpan[] = array(
                //nama field => nama objek -> field object
                "id_kereta" => $item->id_kereta,
                "id_pelanggan" => $item->id_pelanggan,
                "total_item_transaksi" => $item->total,
                "harga_item_transaksi" => $item->harga,
                "id_transaksi" => $idTransaksi
            );
        }
        $result = $this->ItemTransaksiModel->insertBatch($dataSimpan);
        if ($result) {
            $this->response(array("message" => "Data Berhasil Disimpan"), 200);
        } else {
            $this->response(array("message" => "Request Tidak Valid"), 400);
        }
    }
}