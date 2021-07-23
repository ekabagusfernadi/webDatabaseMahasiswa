<?php

class Mahasiswa_model extends CI_model {
    // controllers wajib extends CI_Controller
    // models wajib extends CI_model
    public function getAllMahasiswa()
    {
        // baca cara mengolah database menggunakan ci di dokumentasi query builder class

        // select mahasiswa
        // $query = $this->db->get("mahasiswa");

        // generating query result (fetch)
        // return $query->result_array();

        // atau bisa disingkat jadi
        return $this->db->get("mahasiswa")->result_array();
    }

    public function tambahDataMahasiswa()
    {
        $data = [
            // "nama" => $dataMahasiswa["nama"],
            // "nim" => $dataMahasiswa["nim"],
            // "email" => $dataMahasiswa["email"],
            // "jurusan" => $dataMahasiswa["jurusan"]

            // di ci bisa pakai cara ini, bisa dengan mudah menghindari sql injection, (htmlspecialchars) dengan memberi parameter tambahan di method post("nama", true);
            "nama" => $this->input->post("nama", true),
            "nim" => $this->input->post("nim", true),
            "email" => $this->input->post("email", true),
            "jurusan" => $this->input->post("jurusan", true)
        ];
    
        $this->db->insert('mahasiswa', $data); 
    }

    public function hapusDataMahasiswa($idMahasiswaPar)
    {
        // $this->db->delete('mahasiswa', ['id' => $idMahasiswaPar]);

        $this->db->where('id', $idMahasiswaPar);
        $this->db->delete('mahasiswa');
    }

    public function getMahasiswaById($idMahasiswaPar)
    {
        // $this->db->where("id", 1);
        // $this->db->or_where("nama", "Uyup");
        // return $this->db->get("mahasiswa")->result_array();

        // return $this->db->get_where("mahasiswa", ["id" => $idMahasiswaPar])->result_array(); // result_array() sebenarnya bisa untuk ngambil 1 data, tapi lebih baik digunakan untuk mengambil banyak data
        return $this->db->get_where("mahasiswa", ["id" => $idMahasiswaPar])->row_array();   // jika data return hanya 1 lebih baik gunakan row_array(), jika row(); saja bentuknya object, tambahi row_array(); jika ingin bentuk array
    }

    public function ubahDataMahasiswa($dataMahasiswa)
    {
        $data = [
            // "nama" => $dataMahasiswa["nama"],
            // "nim" => $dataMahasiswa["nim"],
            // "email" => $dataMahasiswa["email"],
            // "jurusan" => $dataMahasiswa["jurusan"]

            // pakai ini lebih aman, dari sql injection
            "nama" => $this->input->post("nama", true),
            "nim" => $this->input->post("nim", true),
            "email" => $this->input->post("email", true),
            "jurusan" => $this->input->post("jurusan", true)

        ];
        
        // $this->db->where('id', $dataMahasiswa["id"]);
        $this->db->where("id", $this->input->post("id"));
        $this->db->update('mahasiswa', $data);  // ingat jangan pakai repalce, karena data akan dihapus dan buat yang baru
    }

    public function cariDataMahasiswa()
    {
        $keyword = $this->input->post("keyword", true);
        // sebenarnya true itu berfungsi kalau datanya diinsert ke database, tapi gpp tulis saja
        $this->db->like('nama', $keyword);
        $this->db->or_like('nim', $keyword);
        $this->db->or_like('email', $keyword);
        $this->db->or_like('jurusan', $keyword);

        return $this->db->get("mahasiswa")->result_array();
    }

}

?>