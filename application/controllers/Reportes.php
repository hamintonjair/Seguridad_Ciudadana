
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reportes extends CI_Controller {

    public function insidencias()
    {
      // $this->load->view('template/header');
		// $this->load->view('template/nabvar');
		// $this->load->view('template/body');
		$this->load->view('reporte/insidencias');
		// $this->load->view('template/footer');
    }
}
