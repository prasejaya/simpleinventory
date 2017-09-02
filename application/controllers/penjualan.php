<?php
class Penjualan extends CI_Controller{
    function __construct(){
        parent::__construct();
        if($this->session->userdata('login_status') != TRUE ){
            $this->session->set_flashdata('notif','Login Gagal !! Usernamae atau Password Salah !!');
            redirect('');
        };
        $this->load->model('model_app');
        $this->load->helper('currency_format_helper');
    }

    function index(){
		if ($this->session->userdata('LEVEL') == 'admin'){
        $data=array(
            'title'=>'Penjualan Barang',
            'active_penjualan'=>'active',
            'data_penjualan'=>$this->model_app->getAllDataPenjualan(),
        );
        $this->load->view('element/v_header',$data);
        $this->load->view('pages/v_penjualan');
        $this->load->view('element/v_footer');

        $this->session->unset_userdata('limit_add_cart');
        $this->cart->destroy();
		}else{
            //$session_id = $this->session->userdata('session_id');
            $id = $this->session->userdata('ID');
			$data=array(
            'title'=>'Tambah Penjualan Barang',
            'active_penjualan'=>'active',
            'kd_penjualan'=>$this->model_app->getKodePenjualan(),
            'data_barang'=>$this->model_app->getBarangJual(),
            'data_penjualan'=>$this->model_app->getDataPenjualanUser($id),
            'data_pelanggan'=>$this->model_app->getDataPelanggan($id),
        );
        $this->load->view('element/v_header',$data);
        $this->load->view('pages/v_penjualan');
        $this->load->view('element/v_footer');
        
        $this->session->unset_userdata('limit_add_cart');
        $this->cart->destroy();
		}
    }
//    GET DATA
    function pages_tambah_penjualan(){
		if ($this->session->userdata('LEVEL') == 'admin'){
        $data=array(
            'title'=>'Tambah Penjualan Barang',
            'active_penjualan'=>'active',
            'kd_penjualan'=>$this->model_app->getKodePenjualan(),
            'data_barang'=>$this->model_app->getBarangJual(),
            'data_pelanggan'=>$this->model_app->getAllData('tbl_pelanggan'),
        );
        $this->load->view('element/v_header',$data);
        $this->load->view('pages/v_add_penjualan');
        $this->load->view('element/v_footer');
		}else{
            $id = $this->session->userdata('ID');
			 $data=array(
            'title'=>'Tambah Penjualan Barang',
            'active_penjualan'=>'active',
            'kd_penjualan'=>$this->model_app->getKodePenjualan(),
            'data_barang'=>$this->model_app->getBarangJual(),
            'data_pelanggan'=>$this->model_app->getDataPelanggan($id),
        );
        $this->load->view('element/v_header',$data);
        $this->load->view('pages/v_add_penjualan');
        $this->load->view('element/v_footer');
		}
    }

    function detail_penjualan(){
        if ($this->session->userdata('LEVEL') == 'admin'){
        $id= $this->uri->segment(3);
        $data=array(
            'title'=>'Detail Penjualan Barang',
            'active_penjualan'=>'active',
            'dt_penjualan'=>$this->model_app->getDataPenjualan($id),
            'barang_jual'=>$this->model_app->getBarangPenjualan($id),
        );
        $update['isbaca'] = '1';
        $key['idpenjualan'] = $id;
        $this->model_app->updateData("tbl_pengumuman",$update,$key);
        $this->load->view('element/v_header',$data);
        $this->load->view('pages/v_detail_penjualan');
        $this->load->view('element/v_footer');
    } else {
        $id= $this->uri->segment(3);
        $data=array(
            'title'=>'Detail Penjualan Barang',
            'active_penjualan'=>'active',
            'dt_penjualan'=>$this->model_app->getDataPenjualan($id),
            'barang_jual'=>$this->model_app->getBarangPenjualan($id),
        );
        $this->load->view('element/v_header',$data);
        $this->load->view('pages/v_detail_penjualan');
        $this->load->view('element/v_footer');
    }
}

    function get_detail_barang(){
        $id['kd_barang']=$this->input->post('kd_barang');
        $data=array(
            'detail_barang'=>$this->model_app->getSelectedData('tbl_barang',$id)->result(),
        );
        $this->load->view('pages/ajax_detail_barang',$data);
    }

    function get_detail_pelanggan(){
        $id['kd_pelanggan']=$this->input->post('kd_pelanggan');
        $data=array(
            'detail_pelanggan'=>$this->model_app->getSelectedData('tbl_pelanggan',$id)->result(),
        );
        $this->load->view('pages/ajax_detail_pelanggan',$data);
    }

//    INSERT DATA
    function tambah_penjualan_to_cart(){
		$this->load->library('cart');
		$qty = $this->input->post('qty');
		$stok = $this->input->post('stok');
		/*if ($qty > $stok ){
			print "<script type=\"text/javascript\">alert('Tidak boleh melebihi stok');</script>";
			redirect('penjualan/pages_tambah_penjualan');
		}
		else{*/
        $data = array(
            'id'    => $this->input->post('kd_barang'),
            'qty'   => $this->input->post('qty'),
            'price' => $this->input->post('harga'),
            'name'  => $this->input->post('nm_barang'),
        );
        $this->cart->insert($data);
        redirect('penjualan/pages_tambah_penjualan');
		//}
	}
    function tambah_penjualan_to_cart_klien(){
         $this->load->library('cart');
        $data = array(
            'id'    => $this->input->post('kd_barang'),
            'qty'   => $this->input->post('qty'),
            'price' => $this->input->post('harga'),
            'name'  => $this->input->post('nm_barang'),
        );
        $this->cart->insert($data);
        redirect('penjualan/pages_tambah_penjualan');
    }

    function simpan_penjualan(){
        $data = array(
            'kd_penjualan'=>$this->input->post('kd_penjualan'),
            'kd_pelanggan'=>$this->input->post('kd_pelanggan'),
            'total_harga'=>$this->input->post('total_harga'),
            'tanggal_penjualan'=>date("Y-m-d",strtotime($this->input->post('tanggal_penjualan'))),
        );
        $this->model_app->insertData("tbl_penjualan_header",$data);
		$data1 = array(
            'idpenjualan'=>$this->input->post('kd_penjualan'),
            'idpelanggan'=>$this->input->post('kd_pelanggan'),
            'isbaca'=>'0',
        );
        $this->model_app->insertData("tbl_pengumuman",$data1);
        foreach($this->cart->contents() as $items){
            $kd_barang = $items['id'];
            $qty = $items['qty'];
            $data_detail = array(
                'kd_penjualan' => $this->input->post('kd_penjualan'),
                'kd_barang'=> $kd_barang,
                'qty'=>$qty,
            );
            $this->model_app->insertData("tbl_penjualan_detail",$data_detail);

            $update['stok'] = $this->model_app->getKurangStok($kd_barang,$qty);
            $key['kd_barang'] = $kd_barang;
            $this->model_app->updateData("tbl_barang",$update,$key);
        }
        $this->session->unset_userdata('limit_add_cart');
        $this->cart->destroy();
        redirect('penjualan');
    }


//    DELETE
    function hapus_barang(){
        $id= $this->uri->segment(3);
        $bc=$this->model_app->getSelectedData("tbl_penjualan_header",$id);
        foreach($bc->result() as $dph){
            $sess_data['kd_penjualan'] = $dph->kd_penjualan;
            $this->session->set_userdata($sess_data);
        }

        $kode = explode("/",$_GET['kode']);
        if($kode[0]=="tambah")
        {
            $data = array(
                'rowid' => $kode[1],
                'qty'   => 0
            );
            $this->cart->update($data);
        }
        else if($kode[0]=="edit")
        {
            $data = array(
                'rowid' => $kode[1],
                'qty'   => 0
            );
            $this->cart->update($data);
            $hps['kd_penjualan'] = $kode[2];
            $hps['kd_barang'] = $kode[3];
            $this->model_app->deleteData("tbl_penjualan_detail",$hps);

            $key_barang['kd_barang'] = $hps['kd_barang'];
            $d_u['stok'] = $kode[4]+$kode[5];
            $this->model_app->updateData("tbl_barang",$d_u,$key_barang);
        }
        redirect('penjualan/pages_edit/'.$this->session->userdata('kd_penjualan'));
    }

    function hapus(){
        $hapus['kd_penjualan'] = $this->uri->segment(3);
        $q = $this->model_app->getSelectedData("tbl_penjualan_detail",$hapus);
        foreach($q->result() as $d){
            $d_u['stok'] = $this->model_app->getTambahStok($d->kd_barang,$d->qty);
            $key['kd_barang'] = $d->kd_barang;
            $this->model_app->updateData("tbl_barang",$d_u,$key);
        }
        $this->model_app->deleteData("tbl_penjualan_header",$hapus);
        $this->model_app->deleteData("tbl_penjualan_detail",$hapus);
        redirect('penjualan');
    }

     function update(){
        $id= $this->uri->segment(3);
        $data=array(
            'title'=>'Detail Penjualan Barang',
            'active_penjualan'=>'active',
            'dt_penjualan'=>$this->model_app->getDataPenjualan($id),
            'barang_jual'=>$this->model_app->getBarangPenjualan($id),
        );
        $update['ismasuk'] = '1';
        $key['idpenjualan'] = $id;
        $this->model_app->updateData("tbl_pengumuman",$update,$key);
        redirect('penjualan');
    }

    function updatekirim(){
        $id= $this->uri->segment(3);
        $data=array(
            'title'=>'Detail Penjualan Barang',
            'active_penjualan'=>'active',
            'dt_penjualan'=>$this->model_app->getDataPenjualan($id),
            'barang_jual'=>$this->model_app->getBarangPenjualan($id),
        );
        $update['ismasuk'] = '2';
        $key['idpenjualan'] = $id;
        $this->model_app->updateData("tbl_pengumuman",$update,$key);
        redirect('penjualan');
    }

    function insertfoto(){
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
            $id= $this->input->post('kd_penjualan');
            $gbr = $this->upload->data();
            $data=array(
            'title'=>'Upload Gambar',
            'active_penjualan'=>'active',
            'dt_penjualan'=>$this->model_app->getDataPenjualan($id),
            'barang_jual'=>$this->model_app->getBarangPenjualan($id),
        );
        $update['nm_gambar'] = $gbr['file_name'];
        $key['kd_penjualan'] = $id;
        $this->model_app->updateData("tbl_penjualan_header",$update,$key);
        $this->load->view('element/v_header',$data);
        $this->load->view('pages/v_detail_penjualan');
        $this->load->view('element/v_footer');
        $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-success\" id=\"alert\">Upload gambar berhasil !!</div></div>");
                
            }else{
                //pesan yang muncul jika terdapat error dimasukkan pada session flashdata
                //$this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">Gagal upload gambar !!</div></div>");
                //redirect('upload/add'); //jika gagal maka akan ditampilkan form upload
            }
        }
    }
}
