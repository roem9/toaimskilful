<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Soal extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Main_model");
        $this->load->model("Other_model");
        ini_set('xdebug.var_display_max_depth', '10');
        ini_set('xdebug.var_display_max_children', '256');
        ini_set('xdebug.var_display_max_data', '1024');
    }

    public function config(){
        $data = $this->Main_model->get_all("config");
        return $data;
    }
    
    public function id($id_tes){
        // $tes = $this->Main_model->get_one("tes", ["md5(id_tes)" => $id_tes, "status" => "Berjalan"]);
        $tes = $this->Main_model->get_one("tes", ["md5(id_tes)" => $id_tes]);

        $data['background'] = $this->Main_model->get_one("config", ["field" => 'background']);
        
        $data['link'] = $this->Main_model->get_one("config", ['field' => "web admin"]);
        
        if($tes['status'] == "Berjalan"){
            // $data['cek'] = $this->Main_model->get_one("item_soal", ["id_item" => 7]);
            $data['id'] = $id_tes;

            $soal = $this->Main_model->get_one("soal", ["id_soal" => $tes['id_soal']]);
            $sesi = $this->Main_model->get_all("sesi_soal", ["id_soal" => $soal['id_soal']]);

            if($soal['tipe_soal'] == "TOAFL" || $soal['tipe_soal'] == "TOEFL"){
                $data['table'] = "peserta_toefl";

                if($tes['tipe_tes'] == "Tes TOEFL Kolaborasi Universitas"){
                    $data['form'] = "
                        <div class=\"form-floating mb-3\">
                            <input type=\"text\" name=\"email\" class=\"form form-control required\">
                            <label for=\"email\">Alamat Email</label>
                        </div>
                        <div class=\"form-floating mb-3\">
                            <input type=\"text\" name=\"nama\" class=\"form form-control required\">
                            <label for=\"nama\">Nama Lengkap</label>
                        </div>
                        <div class=\"form-floating mb-3\">
                            <input type=\"text\" name=\"nim\" class=\"form form-control required number\">
                            <label for=\"nim\">NIM</label>
                        </div>
                        <div class=\"form-floating mb-3\">
                            <select name=\"jk\" class=\"form form-control required\">
                                <option value=\"\">Pilih Gender</option>
                                <option value=\"Male\">Male</option>
                                <option value=\"Female\">Female</option>
                            </select>
                            <label for=\"jk\">Gender</label>
                        </div>
                        <div class=\"form-floating mb-3\">
                            <input type=\"text\" name=\"no_wa\" class=\"form form-control required number\">
                            <label for=\"no_wa\">No Whatsapp</label>
                        </div>
                        <div class=\"form-floating mb-3\">
                            <input type=\"text\" name=\"t4_lahir\" class=\"form form-control required\">
                            <label for=\"t4_lahir\">Kota Lahir</label>
                        </div>
                        <div class=\"form-floating mb-3\">
                            <input type=\"date\" name=\"tgl_lahir\" class=\"form form-control required\">
                            <label for=\"tgl_lahir\">Tgl Lahir</label>
                        </div>
                        <div class=\"form-floating mb-3\">
                            <textarea name=\"alamat\" class=\"form form-control required\"></textarea>
                            <label for=\"alamat\">Alamat</label>
                        </div>
                        <div class=\"form-floating mb-3\">
                            <select name=\"tujuan_tes\" class=\"form form-control required\">
                                <option value=\"\">Pilih Tujuan</option>
                                <option value=\"Syarat Lolos Seminar Proposal/hasil di Universitas\">Syarat Lolos Seminar Proposal/hasil di Universitas</option>
                                <option value=\"Kelengkapan berkas CPNS\">Kelengkapan berkas CPNS</option>
                                <option value=\"Kelengkapan Berkas Lamaran Kerja\">Kelengkapan Berkas Lamaran Kerja</option>
                                <option value=\"Latihan Soal sebelum test TOEFL ITP\">Latihan Soal sebelum test TOEFL ITP</option>
                                <option value=\"Lainnya\">Lainnya</option>
                            </select>
                            <label for=\"tujuan_tes\">Tujuan Mengikuti Tes TOEFL</label>
                        </div>
                    ";
                } else {
                    $data['form'] = "
                        <div class=\"form-floating mb-3\">
                            <input type=\"text\" name=\"email\" class=\"form form-control required\">
                            <label for=\"email\">Alamat Email</label>
                        </div>
                        <div class=\"form-floating mb-3\">
                            <input type=\"text\" name=\"nama\" class=\"form form-control required\">
                            <label for=\"nama\">Nama Lengkap</label>
                        </div>
                        <div class=\"form-floating mb-3\">
                            <select name=\"jk\" class=\"form form-control required\">
                                <option value=\"\">Pilih Gender</option>
                                <option value=\"Male\">Male</option>
                                <option value=\"Female\">Female</option>
                            </select>
                            <label for=\"jk\">Gender</label>
                        </div>
                        <div class=\"form-floating mb-3\">
                            <input type=\"text\" name=\"no_wa\" class=\"form form-control required number\">
                            <label for=\"no_wa\">No Whatsapp</label>
                        </div>
                        <div class=\"form-floating mb-3\">
                            <input type=\"text\" name=\"t4_lahir\" class=\"form form-control required\">
                            <label for=\"t4_lahir\">Kota Lahir</label>
                        </div>
                        <div class=\"form-floating mb-3\">
                            <input type=\"date\" name=\"tgl_lahir\" class=\"form form-control required\">
                            <label for=\"tgl_lahir\">Tgl Lahir</label>
                        </div>
                        <div class=\"form-floating mb-3\">
                            <textarea name=\"alamat\" class=\"form form-control required\"></textarea>
                            <label for=\"alamat\">Alamat</label>
                        </div>
                        <div class=\"form-floating mb-3\">
                            <select name=\"tujuan_tes\" class=\"form form-control required\">
                                <option value=\"\">Pilih Tujuan</option>
                                <option value=\"Male\">Male</option>
                                <option value=\"Female\">Female</option>
                            </select>
                            <label for=\"tujuan_tes\">Tujuan Mengikuti Tes TOEFL</label>
                        </div>
                    ";
                }

            } else {
                $data['table'] = "peserta";
                $data['form'] = "
                    <div class=\"form-floating mb-3\">
                        <input type=\"text\" name=\"email\" class=\"form form-control required\">
                        <label for=\"email\">Alamat Email</label>
                    </div>
                    <div class=\"form-floating mb-3\">
                        <input type=\"text\" name=\"nama\" class=\"form form-control required\">
                        <label for=\"nama\">Nama Lengkap</label>
                    </div>";
            }

            $data['title'] = $tes['nama_tes'];
            $data['tes'] = $tes;
            $data['soal'] = $soal;
            foreach ($sesi as $i => $sesi) {
                $sub_soal = $this->Main_model->get_all("item_soal", ["id_sub" => $sesi['id_sub']], 'urutan');
                $data['sesi'][$i] = [];
                $number = 1;
                foreach ($sub_soal as $j => $soal) {
                    if($soal['item'] == "soal"){
                        // from json to array 
                        // $txt_soal = json_decode( preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $soal['data']), true );
                        $string = trim(preg_replace('/\s+/', ' ', $soal['data']));
                        // $txt_soal = json_decode( preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $soal['data']), true );
                        $txt_soal = json_decode($string, true );
                        
                        if($soal['penulisan'] == "RTL"){
                            $no = $this->Other_model->angka_arab($number).". ";
                            $txt_soal['soal'] = str_replace("{no}", $no, $txt_soal['soal']);
                        } else {
                            $no = $number.". ";
                            $txt_soal['soal'] = str_replace("{no}", $no, $txt_soal['soal']);
                        }

                        $data['sesi'][$i]['soal'][$j]['id_item'] = $soal['id_item'];
                        $data['sesi'][$i]['soal'][$j]['item'] = $soal['item'];
                        $data['sesi'][$i]['soal'][$j]['data']['soal'] = $txt_soal['soal'];
                        $data['sesi'][$i]['soal'][$j]['data']['pilihan'] = $txt_soal['pilihan'];
                        $data['sesi'][$i]['soal'][$j]['data']['jawaban'] = $txt_soal['jawaban'];
                        $data['sesi'][$i]['soal'][$j]['penulisan'] = $soal['penulisan'];

                        if(isset($txt_soal['pembahasan_benar'])){
                            $data['sesi'][$i]['soal'][$j]['data']['pembahasan_benar'] = $txt_soal['pembahasan_benar'];
                        } else {
                            $data['sesi'][$i]['soal'][$j]['data']['pembahasan_benar'] = "";
                        }
            
                        if(isset($txt_soal['pembahasan_salah'])){
                            $data['sesi'][$i]['soal'][$j]['data']['pembahasan_salah'] = $txt_soal['pembahasan_salah'];
                        } else {
                            $data['sesi'][$i]['soal'][$j]['data']['pembahasan_salah'] = "";
                        }
                        
                        $number++;

                    } else if($soal['item'] == "petunjuk" || $soal['item'] == "audio"){
                        $data['sesi'][$i]['soal'][$j] = $soal;
                    }

                    $data['sesi'][$i]['jumlah_soal'] = COUNT($this->Main_model->get_all("item_soal", ["id_sub" => $sesi['id_sub'], "item" => "soal"]));
                    $data['sesi'][$i]['id_sub'] = $sesi['id_sub'];
                }
            }

            // javascript 
            $data['js'] = [
                "ajax.js",
                "function.js",
                "helper.js",
            ];

            if($this->session->flashdata('pesan') && $tes['pembahasan'] == "Ya"){
                $this->load->view("pages/soal-pembahasan", $data);
            } else {
                if($data['soal']['tipe_soal'] == "TOEFL"){
                    $this->load->view("pages/soal-toefl", $data);
                } else {
                    $this->load->view("pages/soal", $data);
                }
            }
        } else {
            $data['title'] = "Blank Link";
            $this->load->view("pages/blank", $data);
        }

    }

    public function email_check($table){
        $id_tes = $this->input->post("id");
        $email = $this->input->post("email");
        $data = $this->Main_model->get_one($table, ["email" => $email, 'md5(id_tes)' => $id_tes]);
        if($data) {
            echo json_encode($data['email']);
        } else {
            echo json_encode("");
        }
    }

    public function password_check(){
        $id_tes = $this->input->post("id");
        $password = $this->input->post("password");
        $data = $this->Main_model->get_one("tes", ["password" => $password, "md5(id_tes)" => $id_tes]);
        if($data) {
            echo json_encode($data['id_tes']);
        }
    }

    public function add_jawaban_toefl(){
        $id_tes = $this->input->post("id_tes");
        $tes = $this->Main_model->get_one("tes", ["md5(id_tes)" => $id_tes]);
        $soal = $this->Main_model->get_one("soal", ["id_soal" => $tes['id_soal']]);
        $sesi = COUNT($this->Main_model->get_all("sesi_soal", ["id_soal" => $soal['id_soal']]));
        $id_sub = $this->input->post("kunci_sesi");
        
        $text = "";

        
        for ($i=1; $i < $sesi+1; $i++) {
            $benar = 0;
            $salah = 0;
            $nilai = "";
            $id = $id_sub[$i-1];
            $sub_soal = $this->Main_model->get_all("item_soal", ["id_sub" => $id, "item" => "soal"], 'urutan');
            $jawaban = $this->input->post("jawaban_sesi_".$i);
            // $jum_soal = COUNT($sub_soal);
            foreach ($sub_soal as $j => $sub_soal) {
                // from json to array 
                $string = trim(preg_replace('/\s+/', ' ', $sub_soal['data']));
                $txt_soal = json_decode($string, true );

                $sub_soal = $txt_soal['jawaban'];
                if($sub_soal == $jawaban[$j]){
                    $status = "benar";
                    $benar++;
                } else {
                    $status = "salah";
                    $salah++;
                }
                $no = $j+1;
                $text .= '['.$i.','.$no.',"'.$jawaban[$j].'","'.$status.'"],';
            }

            if($i == 1){
                $nilai_listening = $benar;
            } elseif ($i == 2) {
                $nilai_structure = $benar;
            } elseif ($i == 3) {
                $nilai_reading = $benar;
            }
        }

        
        $text = substr($text, 0, -1);
        $text = '{"jawaban":['.$text.']}';

        // waktu yang digunakan adalah Jakarta 
        date_default_timezone_set('Asia/Jakarta');
        $time = date("Y-m-d H:i:s");

        if($tes['tipe_tes'] == "Tes TOEFL Kolaborasi Universitas"){
            $data = [
                "id_tes" => $tes['id_tes'],
                "nama" => $this->input->post("nama"),
                "nim" => $this->input->post("nim"),
                "t4_lahir" => $this->input->post("t4_lahir"),
                "tgl_lahir" => $this->input->post("tgl_lahir"),
                "alamat" => $this->input->post("alamat"),
                "no_wa" => $this->input->post("no_wa"),
                "email" => $this->input->post("email"),
                "jk" => $this->input->post("jk"),
                "tujuan_tes" => $this->input->post("tujuan_tes"),
                "nilai_listening" => $nilai_listening,
                "nilai_structure" => $nilai_structure,
                "nilai_reading" => $nilai_reading,
                "text" => $text,
                "tgl_input" => $time
            ];
        } else {
            $data = [
                "id_tes" => $tes['id_tes'],
                "nama" => $this->input->post("nama"),
                "nim" => "-",
                "t4_lahir" => $this->input->post("t4_lahir"),
                "tgl_lahir" => $this->input->post("tgl_lahir"),
                "alamat" => $this->input->post("alamat"),
                "no_wa" => $this->input->post("no_wa"),
                "email" => $this->input->post("email"),
                "jk" => $this->input->post("jk"),
                "tujuan_tes" => $this->input->post("tujuan_tes"),
                "nilai_listening" => $nilai_listening,
                "nilai_structure" => $nilai_structure,
                "nilai_reading" => $nilai_reading,
                "text" => $text,
                "tgl_input" => $time
            ];
        }

        $id = $this->Main_model->add_data("peserta_toefl", $data);

        // add barcode 
            if($tes['tipe_tes'] == 'Tes TOEFL Aimskilful' || $tes['tipe_tes'] == 'Tes TOEFL Kolaborasi Perusahaan' || $tes['tipe_tes'] == 'Tes TOEFL Kolaborasi Universitas'){
                $this->add_sertifikat_toefl($id);
            }
        // add barcode 
        
        $skor = skor($nilai_listening, $nilai_structure, $nilai_reading);

        $replacements = array(
            '$nama' => $this->input->post("nama"),
            '$t4_lahir' => $this->input->post("t4_lahir"),
            '$tgl_lahir' => tgl_indo($this->input->post("tgl_lahir")),
            '$alamat' => $this->input->post("alamat"),
            '$no_wa' => $this->input->post("no_wa"),
            '$email' => $this->input->post("email"),
            '$jk' => $this->input->post("jk"),
            '$nilai_listening' => poin("Listening", $nilai_listening),
            '$nilai_structure' => poin("Structure", $nilai_structure),
            '$nilai_reading' =>poin("Reading", $nilai_reading),
            '$tes' => $tes['nama_tes'],
            '$skor' => $skor,
            '$tgl_tes' => tgl_indo($tes["tgl_tes"], "lengkap"),
            '$tgl_pengumuman' => tgl_indo($tes["tgl_pengumuman"], "lengkap"),
        );

        $msg = str_replace(array_keys($replacements), $replacements, $tes['msg']);

        $data['msg'] = $msg;
        // $this->session->set_flashdata('pesan', $msg);
        $this->session->set_flashdata('pesan', $data);

        redirect(base_url("soal/id/".$id_tes));
    }

    public function add_jawaban(){
        $id_tes = $this->input->post("id_tes");
        $tes = $this->Main_model->get_one("tes", ["md5(id_tes)" => $id_tes]);
        $soal = $this->Main_model->get_one("soal", ["id_soal" => $tes['id_soal']]);
        $sesi = COUNT($this->Main_model->get_all("sesi_soal", ["id_soal" => $soal['id_soal']]));
        $id_sub = $this->input->post("kunci_sesi");
        
        $text = "";

        
        $benar = 0;
        $salah = 0;

        for ($i=1; $i < $sesi+1; $i++) {
            $id = $id_sub[$i-1];
            $sub_soal = $this->Main_model->get_all("item_soal", ["id_sub" => $id, "item" => "soal"], 'urutan');
            $jawaban = $this->input->post("jawaban_sesi_".$i);
            foreach ($sub_soal as $j => $sub_soal) {
                // from json to array 
                $string = trim(preg_replace('/\s+/', ' ', $sub_soal['data']));
                $txt_soal = json_decode($string, true );

                $sub_soal = $txt_soal['jawaban'];
                if($sub_soal == $jawaban[$j]){
                    $status = "benar";
                    $benar++;
                } else {
                    $status = "salah";
                    $salah++;
                }
                $no = $j+1;
                $text .= '['.$i.','.$no.',"'.$jawaban[$j].'","'.$status.'"],';
            }
        }

        
        $text = substr($text, 0, -1);
        $text = '{"jawaban":['.$text.']}';

        $data = [
            "id_tes" => $tes['id_tes'],
            "nama" => $this->input->post("nama"),
            "email" => $this->input->post("email"),
            "nilai" => $benar,
            "text" => $text,
        ];

        $this->Main_model->add_data("peserta", $data);
        $poin = $benar * $soal['poin'];

        $replacements = array(
            '$poin' => $poin,
            '$email' => $this->input->post("email"),
            '$nama' => $this->input->post("nama"),
            '$tes' => $tes['nama_tes'],
            '$tgl_tes' => tgl_indo($tes["tgl_tes"], "lengkap"),
            '$tgl_pengumuman' => tgl_indo($tes["tgl_pengumuman"], "lengkap"),
        );

        $msg = str_replace(array_keys($replacements), $replacements, $tes['msg']);

        $data['msg'] = $msg;
        
        $this->session->set_flashdata('pesan', $data);

        redirect(base_url("soal/id/".$id_tes));
    }

    public function add_sertifikat_toefl($id){
        $config = $this->config();

        // $id = $this->input->post("id");
        // $sertifikat = $this->input->post("sertifikat");

        $peserta = $this->Main_model->get_one("peserta_toefl", ["id" => $id]);
        $tes = $this->Main_model->get_one("tes", ["id_tes" => $peserta['id_tes']]);
        
        $date = date('Y', strtotime($tes['tgl_tes']));

        $this->db->select("CONVERT(no_doc, UNSIGNED INTEGER) AS num");
        $this->db->from("peserta_toefl as a");
        $this->db->join("tes as b", "a.id_tes = b.id_tes");
        $this->db->where("YEAR(tgl_tes)", $date);
        $this->db->order_by("num", "DESC");
        $data = $this->db->get()->row_array();

        if($data) $no = $data['num']+1;
        else $no = 1;

        if($no > 0 && $no < 10) $no_doc = "000".$no;
        elseif($no >= 10 && $no < 100) $no_doc = "00".$no;
        elseif($no >= 100 && $no < 1000) $no_doc = "0".$no;
        elseif($no >= 1000) $no_doc = $no;
        
        $this->load->library('qrcode/ciqrcode'); //pemanggilan library QR CODE

        $config['cacheable']    = true; //boolean, the default is true
        $config['cachedir']     = './assets/'; //string, the default is application/cache/
        $config['errorlog']     = './assets/'; //string, the default is application/logs/
        $config['imagedir']     = './assets/qrcode/'; //direktori penyimpanan qr code
        $config['quality']      = true; //boolean, the default is true
        $config['size']         = '1024'; //interger, the default is 1024
        $config['black']        = array(224,255,255); // array, default is array(255,255,255)
        $config['white']        = array(70,130,180); // array, default is array(0,0,0)
        $this->ciqrcode->initialize($config);

        $image_name=$id.'.png'; //buat name dari qr code sesuai dengan nim

        $params['data'] = $config[1]['value']."/sertifikat/no/".md5($id); //data yang akan di jadikan QR CODE
        $params['level'] = 'H'; //H=High
        $params['size'] = 10;
        $params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE


        $data = $this->Main_model->edit_data("peserta_toefl", ["id" => $id], ["no_doc" => $no_doc]);
        // if($data) return 1;
        // else return 0;
    }

    public function tgl_indo($tgl){
        $data = explode("-", $tgl);
        $hari = $data[0];
        $bulan = $data[1];
        $tahun = $data[2];

        if($bulan == "01") $bulan = "Januari";
        if($bulan == "02") $bulan = "Februari";
        if($bulan == "03") $bulan = "Maret";
        if($bulan == "04") $bulan = "April";
        if($bulan == "05") $bulan = "Mei";
        if($bulan == "06") $bulan = "Juni";
        if($bulan == "07") $bulan = "Juli";
        if($bulan == "08") $bulan = "Agustus";
        if($bulan == "09") $bulan = "September";
        if($bulan == "10") $bulan = "Oktober";
        if($bulan == "11") $bulan = "November";
        if($bulan == "12") $bulan = "Desember";

        return $hari . " " . $bulan . " " . $tahun;
    }
     
    function hari_ini($hari){
        // $hari = date ("D");
    
        switch($hari){
            case 'Sun':
                $hari_ini = "Ahad";
            break;
    
            case 'Mon':			
                $hari_ini = "Senin";
            break;
    
            case 'Tue':
                $hari_ini = "Selasa";
            break;
    
            case 'Wed':
                $hari_ini = "Rabu";
            break;
    
            case 'Thu':
                $hari_ini = "Kamis";
            break;
    
            case 'Fri':
                $hari_ini = "Jumat";
            break;
    
            case 'Sat':
                $hari_ini = "Sabtu";
            break;
            
            default:
                $hari_ini = "Tidak di ketahui";		
            break;
        }
    
        return $hari_ini;
    
    }
}

/* End of file Peserta.php */