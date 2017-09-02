<?php
class Model_app extends CI_Model{
    function __construct(){
        parent::__construct();
    }

    //  ================= AUTOMATIC CODE ==================

    //    KODE PENJUALAN
    public function getKodePenjualan()
    {
        $q = $this->db->query("select MAX(RIGHT(kd_penjualan,3)) as kd_max from tbl_penjualan_header");
        $kd = "";
        if($q->num_rows()>0)
        {
            foreach($q->result() as $k)
            {
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%03s", $tmp);
            }
        }
        else
        {
            $kd = "001";
        }
        return "O-".$kd;
    }

    //    KODE BARANG
    function getKodeBarang(){
        $q = $this->db->query("select MAX(RIGHT(kd_barang,3)) as kd_max from tbl_barang");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%03s", $tmp);
            }
        }else{
            $kd = "001";
        }
        return "B-".$kd;
    }

    //    KODE PELANGGAN
    public function getKodePelanggan(){
        $q = $this->db->query("select MAX(RIGHT(kd_pelanggan,3)) as kd_max from tbl_pelanggan");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%03s", $tmp);
            }
        }else{
            $kd = "001";
        }
        return "P-".$kd;
    }

    //    KODE PEMILIK
    public function getKodePemilik(){
        $q = $this->db->query("select MAX(RIGHT(kd_pemilik,3)) as kd_max from tbl_pemilik");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%03s", $tmp);
            }
        }else{
            $kd = "001";
        }
        return "A-".$kd;
    }

    public function getTambahStok($kd_barang,$tambah)
    {
        $q = $this->db->query("select stok from tbl_barang where kd_barang='".$kd_barang."'");
        $stok = "";
        foreach($q->result() as $d)
        {
            $stok = $d->stok + $tambah;
        }
        return $stok;
    }
    public function getKurangStok($kd_barang,$kurangi)
    {
        $q = $this->db->query("select stok from tbl_barang where kd_barang='".$kd_barang."'");
        $stok = "";
        foreach($q->result() as $d)
        {
            $stok = $d->stok - $kurangi;
        }
        return $stok;
    }
    public function getKembalikanStok($kd_barang)
    {
        $q = $this->db->query("select stok from tbl_barang where kd_barang='".$kd_barang."'");
        $stok = "";
        foreach($q->result() as $d)
        {
            $stok = $d->stok;
        }
        return $stok;
    }
	function ambildata($perPage, $uri, $ringkasan) {
		$this->db->select('*');
		$this->db->from('tbl_barang');
		if (!empty($ringkasan)) {
			$this->db->like('nm_barang', $ringkasan);
		}
		$this->db->order_by('stok','asc');
		$getData = $this->db->get('', $perPage, $uri);

		if ($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}
	public function cariBarang($cari){
		$cari=$this->db->query("select * from tbl_barang where nm_barang like '%$cari%'");
		return $cari->result();
	}
    public function getAllData($table)
    {
        return $this->db->get($table)->result();
    }
     public function getAllDataBarang($table)
    {
       $this->db->select("*");
       $this->db->from("tbl_barang");
       $this->db->order_by("stok","asc");
       return $hasil=$this->db->get()->result();
    }
    public function getSelectedData($table,$data)
    {
        return $this->db->get_where($table, $data);
    }
    function updateData($table,$data,$field_key)
    {
        $this->db->update($table,$data,$field_key);
    }
    function deleteData($table,$data)
    {
        $this->db->delete($table,$data);
    }
    function insertData($table,$data)
    {
        $this->db->insert($table,$data);
    }
    function manualQuery($q)
    {
        return $this->db->query($q);
    }

    function getBarangJual(){
        return $this->db->query ("SELECT * from tbl_barang where stok > 0")->result();
    }

    function getAllDataPenjualan(){
        return $this->db->query("SELECT
                a.kd_penjualan,
                a.tanggal_penjualan,
                a.total_harga,
			    (select count(kd_penjualan) as jum from tbl_penjualan_detail where kd_penjualan=a.kd_penjualan) as jumlah,
                b.isbaca,c.nm_pelanggan,b.ismasuk
			    from tbl_penjualan_header a
                join tbl_pengumuman b on b.idpenjualan = a.kd_penjualan
                join tbl_pelanggan c on c.kd_pelanggan = a.kd_pelanggan
			    ORDER BY a.kd_penjualan DESC
		")->result();
    }

    function getDataPenjualanUser($id){
        return $this->db->query("SELECT
                a.kd_penjualan,
                a.tanggal_penjualan,
                a.total_harga,
                (select count(kd_penjualan) as jum from tbl_penjualan_detail where kd_penjualan=a.kd_penjualan) as jumlah
                ,c.nm_pelanggan,b.ismasuk,a.nm_gambar
                from tbl_penjualan_header a
                join tbl_pengumuman b on b.idpenjualan = a.kd_penjualan
                join tbl_pelanggan c on c.kd_pelanggan = a.kd_pelanggan
                where a.kd_pelanggan = '$id'
                ORDER BY a.kd_penjualan DESC
        ")->result();
    }
    function getDataPelanggan($id){
        return $this->db->query("select * from tbl_pelanggan where kd_pelanggan='$id'")->result();
    }
    function getDataPenjualan($id){
        return $this->db->query("SELECT * from tbl_penjualan_header a
                left join tbl_pelanggan b on a.kd_pelanggan=b.kd_pelanggan
                where a.kd_penjualan = '$id'")->result();
    }

    function getBarangPenjualan($id){
        return $this->db->query("
                select a.kd_barang,a.qty,b.nm_barang,b.harga
                from tbl_penjualan_detail a
                left join tbl_barang b on a.kd_barang=b.kd_barang
                where a.kd_penjualan = '$id'")->result();
    }
	function getPencarian($nmbarang){
		return $this->db->query("SELECT * FROM TBL_BARANG WHERE NM_BARANG LIKE '%$nmbarang%'")->result();
	}
    function getLapPenjualan($tgl_awal,$tgl_akhir){
        return $this->db->query("SELECT a.*,b.nm_pelanggan from tbl_penjualan_header a
                 join tbl_pelanggan b on b.kd_pelanggan=a.kd_pelanggan
                where a.tanggal_penjualan between '$tgl_awal' and '$tgl_akhir'
                ")->result();
    }

    function login($username, $password) {
        //create query to connect user login database
        $this->db->select('*');
        $this->db->from('tbl_user');
        $this->db->where('username', $username);
        $this->db->where('password', MD5($password));
        $this->db->limit(1);

        //get query and processing
        $query = $this->db->get();
        if($query->num_rows() == 1) {
            return $query->result(); //if data is true
        } else {
            return false; //if data is wrong
        }
    }
}
