<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	/**
	* 
	*/
	require APPPATH .'/libraries/REST_Controller.php';
	use Restserver\Libraries\REST_Controller;
	class Penjual extends REST_Controller
	{
		
		function __construct($config = 'rest')
		{
			# code...
			parent::__construct($config);
			$this->load->database();
		}

		function index_get()
		{
			$id_penjual = $this->get('id_penjual');
			if ($id_penjual == '') {
				# code...
				$Penjual = $this->db->get('Penjual')->result();
			}
			else
			{
				$this->db->where('id_penjual',$id_penjual);
				$Penjual = $this->db->get('Penjual')->result();
			}
			$this->response($Penjual,200);
		}
		
		function index_post()
		{
			$data = array(
				'id_penjual' =>  $this->post('id_penjual'),
				'id_kost' =>  $this->post('id_kost'),
				'nama_penjual' =>  $this->post('nama_penjual'),
				'alamat_penjual' =>  $this->post('alamat_penjual'),
				'notelp_penjual' =>  $this->post('notelp_penjual'),
				 );
			$insert = $this->db->insert('Penjual',$data);
			if ($insert) {
				# code...
				$this->response($data,200);
			}
			else
			{
				$this->response(array('status'=>'fail',502));		
			}
		}

		function index_put()
		{
			$id_penjual = $this->put('id_penjual');
			$data = array(
				'id_penjual' =>  $this->put('id_penjual'),
				'id_kost' =>  $this->put('id_kost'),
				'nama_penjual' =>  $this->put('nama_penjual'),
				'alamat_penjual' =>  $this->put('alamat_penjual'),
				'notelp_penjual' =>  $this->put('notelp_penjual'),
				 );
			$this->db->where('id_penjual', $id_penjual);
			$update = $this->db->update('Penjual',$data);
			if ($update) {
				# code...
				$this->response($data, 200);
			}
			else
			{
				$this->response(array('status'=>'fail',502));		
			}
		}	

		function index_delete()
		{
			$id_penjual = $this->delete('id_penjual');
			$this->db->where('id_penjual',$id_penjual);
			$delete = $this->db->delete('Penjual');
			if ($delete) {
				# code...
				$this->response(array('status'=>'success',201));		
			}	
			else
			{
				$this->response(array('status'=>'fail',502));		
			}	

		}
	}
?>