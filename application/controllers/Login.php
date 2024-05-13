
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {

        
        parent::__construct();
        $this->load->model( 'ModelReporte' );
    }

    public function login()
    {
		$this->load->view('login/login');
	
    }
    //regstro user
    public function registro_user(){

        $this->load->view( 'login/registro_usuario' );

    }
    //validar inicio de sesion
    public function iniciar_session(){
        $correo = $this->input->post( 'correo' );
        $clave = $this->input->post( 'clave' );

        $validado = $this->ModelReporte->validar_login($correo,$clave);
        if(!empty($validado)){
            $this->ModelReporte->insert_session($validado[0]->id,$validado[0]->nombre,$validado[0]->rol);        
            $msg = array('ok' => true, 'post' => 'Logueado.', 'rol' => $validado[0]->rol);

        }else{
            $msg = array('ok' => false, 'post' => 'Usuario o contraseña incorrecta');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    
}
