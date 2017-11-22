<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	require APPPATH .'/libraries/REST_Controller.php';
	use Restserver\Libraries\REST_Controller;

	class Pembeli extends REST_Controller{

		function __construct($config = 'rest'){
			parent::__construct($config);
			$this->load->database();
		}

		function index_get(){
			$id = $this->get('id_pembeli');
			if($id ==''){
				$pembeli = $this->db->get('pembeli')->result();
			}else{
				$this->db->where('id',$id);
				$pembeli = $this->db->get('pembeli')->result();
			}
			$this->response($pembeli,200);
		}

		function index_post(){
			$data = array(
				'id_pembeli' => $this->post('id_pembeli'),
				'nama_pembeli' => $this->post('nama_pembeli'),
				'notelp_pembeli' => $this->post('notelp_pembeli'));
			$insert = $this->db->insert('pembeli',$data);
			if($insert){
				$this->response($data,200);
			}else{
				$this->response(array('status'=>'fail',502));
			}
		}

		function index_put(){
			$id = $this->put('id_pembeli');
			$data = array(
				'id_pembeli' => $this->put('id_pembeli'),
				'nama_pembeli' => $this->put('nama_pembeli'),
				'notelp_pembeli' => $this->put('notelp_pembeli'));
			$this->db->where('id_pembeli',$id);
			$update = $this->db->update('pembeli',$data);
			if($update){
				$this->response($data,200);
			}else{
				$this->response(array('status'=>'fail',502));
			}
		}

		function index_delete(){
			$id = $this->delete('id_pembeli');
			$this->db->where('id_pembeli',$id);
			$delete = $this->db->delete('pembeli');
			if($delete){
				$this->response(array('status'=>'success'),201);
			}else{
				$this->response(array('status'=>'fail',502));
			}
		}
	}
?>