<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	require APPPATH .'/libraries/REST_Controller.php';
	use Restserver\Libraries\REST_Controller;

	class Reservasi extends REST_Controller{

		function __construct($config = 'rest'){
			parent::__construct($config);
			$this->load->database();
		}

		function index_get(){
			$id = $this->get('id_reservasi');
			if($id ==''){
				$reservasi = $this->db->get('reservasi')->result();
			}else{
				$this->db->where('id_reservasi',$id);
				$reservasi = $this->db->get('reservasi')->result();
			}
			$this->response($reservasi,200);
		}

		function index_post(){
			$data = array(
				'id_reservasi' => $this->post('id_reservasi'),
				'id_pembeli' => $this->post('id_pembeli'),
				'id_penjual' => $this->post('id_penjual'),
				'tgl_mulaisewa' => $this->post('tgl_mulaisewa'));
			$insert = $this->db->insert('reservasi',$data);
			if($insert){
				$this->response($data,200);
			}else{
				$this->response(array('status'=>'fail',502));
			}
		}

		function index_put(){
			$id = $this->put('id_reservasi');
			$data = array(
				'id_reservasi' => $this->put('id_reservasi'),
				'id_pembeli' => $this->put('id_pembeli'),
				'id_penjual' => $this->put('id_penjual'),
				'tgl_mulaisewa' => $this->put('tgl_mulaisewa'));
			$this->db->where('id_reservasi',$id);
			$update = $this->db->update('reservasi',$data);
			if($update){
				$this->response($data,200);
			}else{
				$this->response(array('status'=>'fail',502));
			}
		}

		function index_delete(){
			$id = $this->delete('id_reservasi');
			$this->db->where('id_reservasi',$id);
			$delete = $this->db->delete('reservasi');
			if($delete){
				$this->response(array('status'=>'success'),201);
			}else{
				$this->response(array('status'=>'fail',502));
			}
		}
	}
?>