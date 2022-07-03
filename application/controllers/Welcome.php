<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{

		$this->load->helper('url');
		redirect('https://v1.atlo.es/index.php/home');

		//$this->load->view('welcome_message');
		/*$this->load->view('00_head');
		$this->load->view('10_carrusel');
		$this->load->view('40_reservas');
		$this->load->view('50_info');
		$this->load->view('80_cierre');*/

	}


}
