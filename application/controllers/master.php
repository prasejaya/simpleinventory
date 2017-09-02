<?php
class Master extends CI_Controller{
    function __construct(){
        parent::__construct();
        if($this->session->userdata('login_status') != TRUE ){
            $this->session->set_flashdata('notif','LOGIN GAGAL USERNAME ATAU PASSWORD ANDA SALAH !');
            redirect('');
        };
        $this->load->model('model_app');
        $this->load->helper('currency_format_helper');
    }

    function index(){
        $ListBerita = array();
        $data=array(
            'title'=>'Data Toko',
            'active_master'=>'active',
            'kd_barang'=>$this->model_app->getKodeBarang(),
            'kd_pelanggan'=>$this->model_app->getKodePelanggan(),
            'kd_pemilik'=>$this->model_app->getKodepemilik(),
            'data_barang'=>$this->model_app->getAllDataBarang('tbl_barang'),
            'data_pelanggan'=>$this->model_app->getAllData('tbl_pelanggan'),
            'data_pemilik'=>$this->model_app->getAllData('tbl_pemilik'),
        );
        $this->load->view('element/v_header',$data);
        $this->load->view('pages/v_master');
       
        $this->load->view('element/v_footer');
    }
    
     function cari(){
        $namabarang= $this->input->post('nm_barang');
        $sess_data=array(
            'nm_barang'=>$namabarang
        );
        $this->session->set_userdata($sess_data);
        $data=array(
            'dt_result'=> $this->model_app->getPencarian($namabarang),
            'nm_barang'=>$this->session->userdata('nm_barang')
        );
        $this->load->view('element/v_header',$data);
        $this->load->view('pages/v_caribarang',$data);
        $this->load->view('element/v_footer');
    }
//
//    ===================== INSERT =====================
    function tambah_barang(){
         $this->load->library('upload');
        $nmfile = "file_".time(); //nama file saya beri nama langsung dan diikuti fungsi time
        $config['upload_path'] = './asset/uploads/'; //path folder
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
        $config['max_size'] = '10048'; //maksimum besar file 10M
        $config['max_width']  = '10088'; //lebar maksimum 10088 px
        $config['max_height']  = '10068'; //tinggi maksimu 10068 px
        $config['file_name'] = $nmfile; //nama yang terupload nantinya

        $this->upload->initialize($config);
        if($_FILES['filefoto']['name'])
        {    
        if ($this->upload->do_upload('filefoto'))
        {
        $gbr = $this->upload->data();
        $data=array(
            'kd_barang'=>$this->input->post('kd_barang'),
            'nm_barang'=>$this->input->post('nm_barang'),
            'stok'=>$this->input->post('stok'),
            'harga'=>$this->input->post('harga'),
            'nm_gambar'=>$gbr['file_name']
        );
        $this->model_app->insertData('tbl_barang',$data);
        redirect("master");
        }
        }
    }
    function tambah_pelanggan(){
        $data=array(
            'kd_pelanggan'=> $this->input->post('kd_pelanggan'),
            'nm_pelanggan'=>$this->input->post('nm_pelanggan'),
            'alamat'=>$this->input->post('alamat'),
            'notelp'=>$this->input->post('notelp'),
            'username'=>$this->input->post('username')
        );
        $this->model_app->insertData('tbl_pelanggan',$data);
        redirect("master");
    }
    function tambah_pemilik(){
        $data=array(
            'kd_pemilik'=> $this->input->post('kd_pemilik'),
            'username'=>$this->input->post('username'),
            'nm_pemilik'=> $this->input->post('nm_pemilik'),
            'alamat'=> $this->input->post('alamat'),
            'notelp'=>$this->input->post('notelp')
        );
        $this->model_app->insertData('tbl_pemilik',$data);
        redirect("master");
    }


//    ======================== EDIT =======================
    function edit_barang(){
         $this->load->library('upload');
        $nmfile = "file_".time(); //nama file saya beri nama langsung dan diikuti fungsi time
        $config['upload_path'] = './asset/uploads/'; //path folder
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
        $config['max_size'] = '10048'; //maksimum besar file 10M
        $config['max_width']  = '10088'; //lebar maksimum 10088 px
        $config['max_height']  = '10068'; //tinggi maksimu 10068 px
        $config['file_name'] = $nmfile; //nama yang terupload nantinya

        $this->upload->initialize($config);
        if($_FILES['filefoto']['name'])
        {    
        if ($this->upload->do_upload('filefoto'))
        {
        $gbr = $this->upload->data();
        $id['kd_barang'] = $this->input->post('kd_barang');
        $data=array(
            'nm_barang'=>$this->input->post('nm_barang'),
            'stok'=>$this->input->post('stok'),
            'harga'=>$this->input->post('harga'),
            'nm_gambar'=>$gbr['file_name']
        );
        $this->model_app->updateData('tbl_barang',$data,$id);
        redirect("master");
    }
    }
    }
    function edit_pelanggan(){
        $id['kd_pelanggan'] = $this->input->post('kd_pelanggan');
        $data=array(
            'nm_pelanggan'=>$this->input->post('nm_pelanggan'),
            'username'=>$this->input->post('username'),
            'alamat'=>$this->input->post('alamat'),
            'notelp'=>$this->input->post('notelp'),
        );
        $this->model_app->updateData('tbl_pelanggan',$data,$id);
        redirect("master");
    }
    function edit_pemilik(){
        $id['kd_pemilik'] = $this->input->post('kd_pemilik');
        $data=array(
            'username'=>$this->input->post('username'),
            'nm_pemilik'=>$this->input->post('nm_pemilik'),
            'alamat'=>$this->input->post('alamat'),
            'notelp'=>$this->input->post('notelp'),
        );
        $this->model_app->updateData('tbl_pemilik',$data,$id);
        redirect("master");
    }

//    ========================== DELETE =======================
    function hapus_barang(){
        $id['kd_barang'] = $this->uri->segment(3);
        $this->model_app->deleteData('tbl_barang',$id);
        redirect("master");
    }
    function hapus_pelanggan(){
        $id['kd_pelanggan'] = $this->uri->segment(3);
        $this->model_app->deleteData('tbl_pelanggan',$id);
        redirect("master");
    }
    function hapus_pemilik(){
        $id['kd_pemilik'] = $this->uri->segment(3);
        $this->model_app->deleteData('tbl_pemilik',$id);
        redirect("master");
    } 
}


