<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pelanggan extends Restserver\Libraries\REST_Controller
{

    //Panggil PelangganModel
    function __construct()
    {
        parent::__construct();
        $this->load->model("PelangganModel");
        //Cek
        header('Content-Type: application/json');
        if (checkToken() == FALSE) {
            $this->response(["pesan" => "Silahkan Login dulu Gan!"], 401);
            exit();
        }
    }

    //Get AllPelanggan berdasarkan pencarian page dan search
    public function index_get($id = null)
    {
        if ($id == null) {
            $perpage = ($this->get("per_page") == NULL) ? "500" : $this->get("per_page");
            $page = intval($this->get("page"));
            $search = ($this->get("search") == NULL) ? "" : $this->get("search");
            $start = ((int) $page - 1) * (int) $perpage;

            $total_row = $this->PelangganModel->totalRow($search);
            $total_page = ceil($total_row / $perpage);
            $pelanggans = $this->PelangganModel->getLimitData($perpage, $start, $search);
            // $idPelangganss = $this->PelangganModel->getByPrimaryKey($id, $search);
            $dataPelanggan = array();
            foreach ($pelanggans as $pelanggan) {
                $pelanggan->image_url = base_url() . "image/" . $pelanggan->gambar;
                $dataPelanggan[] = $pelanggan;
            }

            $data = array(
                "meta" => array(
                    "page" => $page,
                    "per_page" => $perpage,
                    "search" => $search,
                    "total_row" => $total_row,
                    "total_page" => $total_page,
                    // "id_Pelanggan" => $idPelangganss
                ),
                "pelanggan_data" => $dataPelanggan,
            );
            $this->response($data, 200);
        } else {
            $pelanggan = $this->PelangganModel->getByPrimaryKey($id);
            if ($pelanggan == null) {
                $this->response(array("message" => "Data tidak ditemukan"), 400);
            } else {
                $pelanggan->image_url = base_url() . "image/" . $pelanggan->gambar;
                $this->response($pelanggan, 200);
            }
        }
    }

    //POST Pelanggan
    public function index_post()
    {
        //Proses menambah image
        $stringBase64 = $this->input->post("gambar", true);
        $fileName = md5(date("d-m-Y H:i:s") . rand(1, 100000));
        $fileName .= ".jpg";
        $decode = base64_decode($stringBase64);
        file_put_contents("image/$fileName", $decode);

        //Tambah Pelanggan
        $data = array(
            "nama_pelanggan" => $this->post("nama_pelanggan", TRUE),
            "jk" => $this->post("jk", TRUE),
            "alamat" => $this->post("alamat", TRUE),
            "no_tlpn" => $this->post("no_tlpn", TRUE),
            "gambar" => $fileName,
        );
        echo json_encode($data, \Restserver\Libraries\REST_Controller::HTTP_CREATED);
        $result = $this->PelangganModel->insert($data);
        if ($result) {
            $pesan = array(
                "message" => "Data Pelanggan Berhasil Disimpan"
            );
            $this->response($pesan, Restserver\Libraries\REST_Controller::HTTP_CREATED);
        } else {
            $pesan = array(
                "message" => "Data Pelanggan Gagal Disimpan"
            );
            $this->response($pesan, Restserver\Libraries\REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    //MengUpdate Data Pelanggan
    public function index_put()
    {
        $pelanggan = json_decode(file_get_contents("php://input"));

        // $idPelanggan = $this->put("id_Pelanggan", true);
        // $Pelanggan = $this->PelangganModel->getByPrimaryKey($idPelanggan);

        //Hapus gambar lama terlebih dahulu
        if (file_exists("image/$pelanggan->gambar")) {
            unlink("image/$pelanggan->gambar");
        }

        //Update Gambar Baru dan Data Pelanggan Baru
        $stringBase64 = $pelanggan->gambar;
        $fileName = md5(date("d-m-Y H:i:s") . rand(1, 100000));
        $fileName .= ".jpg";
        $decode = base64_decode($stringBase64);
        file_put_contents("image/$fileName", $decode);

        //Update Pelanggan
        $data = array(
            "nama_pelanggan" => $pelanggan->nama_pelanggan,
            "jk" => $pelanggan->jk,
            "alamat" => $pelanggan->alamat,
            "no_tlpn" => $pelanggan->no_tlpn,
            "gambar" => $fileName,
        );
        $result = $this->PelangganModel->update($data, $pelanggan->id_pelanggan);
        if ($result) {
            $pesan = array(
                "message" => "Data Pelanggan Berhasil di Update"
            );
            $this->response($pesan, Restserver\Libraries\REST_Controller::HTTP_OK);
        } else {
            $pesan = array(
                "message" => "Data Pelanggan Gagal di Update"
            );
            $this->response($pesan, Restserver\Libraries\REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    //Hapus Data Pelanggan
    public function index_delete()
    {
        $idPelanggan = $this->delete("id_Pelanggan", true);
        $pelanggan = $this->PelangganModel->getByPrimaryKey($idPelanggan);

        //Hapus Gambar
        if (file_exists("image/$pelanggan->gambar")) {
            unlink("image/$pelanggan->gambar");
        }

        $result = $this->PelangganModel->delete($idPelanggan);
        if ($result) {
            $pesan = array(
                "message" => "Data Pelanggan Berhasil di Hapus"
            );
            $this->response($pesan, Restserver\Libraries\REST_Controller::HTTP_OK);
        } else {
            $pesan = array(
                "message" => "Data Pelanggan Gagal di Hapus"
            );
            $this->response($pesan, Restserver\Libraries\REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
