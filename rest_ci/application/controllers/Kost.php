<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	require APPPATH .'/libraries/REST_Controller.php';
	use Restserver\Libraries\REST_Controller;

	class Kost extends REST_Controller{

		function __construct($config = 'rest'){
			parent::__construct($config);
			$this->load->database();
		}

		function index_get(){
			$id = $this->get('id_kost');
			if($id ==''){
				$kost = $this->db->get('kost')->result();
			}else{
				$this->db->where('id_kost',$id);
				$kost = $this->db->get('kost')->result();
			}
			$this->response($kost,200);
		}

		function index_post(){
			$data = array(
				'id_kost' => $this->post('id_kost'),
				'nama_kost' => $this->post('nama_kost'),
				'alamat_kost' => $this->post('alamat_kost'),
				'luas_kamar' => $this->post('luas_kamar'),
				'biaya_sewa' => $this->post('biaya_sewa'));
			$insert = $this->db->insert('kost',$data);
			if($insert){
				$this->response($data,200);
			}else{
				$this->response(array('status'=>'fail',502));
			}
		}

		function index_put(){
			$id = $this->put('id_kost');
			$data = array(
				'id_kost' => $this->put('id_kost'),
				'nama_kost' => $this->put('nama_kost'),
				'alamat_kost' => $this->put('alamat_kost'),
				'luas_kamar' => $this->put('luas_kamar'),
				'biaya_sewa' => $this->put('biaya_sewa'));
			$this->db->where('id_kost',$id);
			$update = $this->db->update('kost',$data);
			if($update){
				$this->response($data,200);
			}else{
				$this->response(array('status'=>'fail',502));
			}
		}

		function index_delete(){
			$id = $this->delete('id_kost');
			$this->db->where('id_kost',$id);
			$delete = $this->db->delete('kost');
			if($delete){
				$this->response(array('status'=>'success'),201);
			}else{
				$this->response(array('status'=>'fail',502));
			}
		}
	}
?>