<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Panel extends CI_Controller
{
	function __construct()
	{
		// session_start();
		parent::__construct();
		$this->load->model('ModelReporte');
	}

	public function index()
	{

		$this->load->view('template/header');
		$this->load->view('template/nabvar');
		$this->load->view('template/body');
		$this->load->view('template/slider');
		$this->load->view('template/footer');
	}
	//reportar incidencias

	public function insidencias()
	{
		$this->load->view('template/header');
		$this->load->view('template/nabvar');
		$this->load->view('reporte/insidencias');
		$this->load->view('template/slider');
		$this->load->view('template/footer');
	}
	//reportar incidencias

	public function registrar_incidencia()
	{
		// Obtén los datos del formulario

		$nombre = $this->input->post('nombre');
		$email = $this->input->post('email');

		$tipo_incidencia = $this->input->post('tipo_incidencia');
		$fecha = $this->input->post('fecha');
		$hora = $this->input->post('hora');
		$barrio = $this->input->post('barrio');
		$descripcion = $this->input->post('descripcion');
		$urgencia = $this->input->post('urgencia');
		$latitud = $this->input->post('coordenadas');
		$longitud = $this->input->post('coordenadas1');

		$validado = $this->ModelReporte->get_Session();
		if (!empty($validado)) {
			$idUsuario  = $validado[0]->idUsuario;
			$usuario = $this->ModelReporte->get_usuario($idUsuario);
			$nombre_anonimo = $usuario[0]->nombre;
			$correo_anonimo = $usuario[0]->correo;
		} else {
			$idUsuario = null;
			$nombre_anonimo = $nombre;
			$correo_anonimo = $email;
		}
		if ($tipo_incidencia == "otro") {
			$incidencia = $this->input->post('otro_campo_input');;
		} else {
			$incidencia =  $tipo_incidencia;
		}

		// Verifica si se ha subido un archivo
		if (!empty($_FILES['fotoInput']['name'])) {
			// Configura las opciones de subida de archivos
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'jpg|jpeg|png';
			$config['max_size'] = 2048;
			$config['file_name'] = date('YmdHis') . '_' . $_FILES['fotoInput']['name'];

			$this->load->library('upload', $config);

			if ($this->upload->do_upload('fotoInput')) {
				// Obtiene información del archivo subido
				$upload_data = $this->upload->data();
				// Obtiene el nombre del archivo subido
				$adjuntos = $upload_data['file_name'];
			} else {
				// Maneja errores de subida de archivos aquí
				$error = $this->upload->display_errors();
				echo json_encode(['ok' => false, 'post' => 'Error al subir el archivo: ' . $error], JSON_UNESCAPED_UNICODE);
				return;
			}
		} else {
			// Si no se ha seleccionado ninguna imagen, asigna un nombre por defecto
			$adjuntos = 'default.png';
		}

		// Inserta los datos en la base de datos
		$data = $this->ModelReporte->guardar_incidencia(
			$incidencia,
			$fecha,
			$hora,
			$barrio,
			$descripcion,
			$urgencia,
			$latitud,
			$longitud,
			$adjuntos,
			$idUsuario,
			$nombre_anonimo,
			$correo_anonimo
		);

		if ($data) {
			$msg = ['ok' => true, 'post' => 'Incidencia registrada con éxito.'];
		} else {
			$msg = ['ok' => false, 'post' => 'Error al registrar la Incidencia.'];
		}

		echo json_encode($msg, JSON_UNESCAPED_UNICODE);
		die;
	}

	//alertas
	public function alertas()
	{
		$incidenciasSinUsuario = $this->ModelReporte->get_Incidencias();
		$incidenciasConUsuario = $this->ModelReporte->get_Incidenciass();
		$dato['alertas'] = array_merge($incidenciasSinUsuario, $incidenciasConUsuario);

		$this->load->view('template/header');
		$this->load->view('template/nabvar');
		$this->load->view('reporte/alert', $dato);
		$this->load->view('template/slider');
		$this->load->view('template/footer');
	}
	// estadisticas
	//alertas
	public function estadisticas()
	{
		// $datos[ 'datos' ] = $this->ModelReporte->obtenerCantidadIncidenciasPorMes();

		$this->load->view('template/header');
		$this->load->view('template/nabvar');
		$this->load->view('reporte/estadisticas');
		$this->load->view('template/slider');
		$this->load->view('template/footer');
	}
	//finalizar incidencias

	public function finalizarIncidencia()
	{
		$alerta_id = $this->input->post('alerta_id');
		$nuevo_estado = $this->input->post('nuevo_estado');
		$fecha = date('Y-m-d H:i:s');

		$dato = $this->ModelReporte->set_Finalizar_Incidecia($alerta_id, $nuevo_estado, $fecha);
		if ($dato) {
			$msg = array('ok' => true, 'post' => 'Incidencia finalizada con éxito.');
		} else {
			$msg = array('ok' => false, 'post' => 'Error al finalizar la incidencia.');
		}
		echo json_encode($msg, JSON_UNESCAPED_UNICODE);
	}
	//listar incidencias

	public function getIncidencia()
	{
		$incidenciasSinUsuario = $this->ModelReporte->get_Incidencias();
		$incidenciasConUsuario = $this->ModelReporte->get_Incidenciass();
		$dato['alertas'] = array_merge($incidenciasSinUsuario, $incidenciasConUsuario);

		echo json_encode($dato);
	}

	//ver incidencia en mapa

	public function getMap()
	{
		$latitud = $this->input->get('latitud');
		$longitud = $this->input->get('longitud');
		$data['map'] = array('lat' => $latitud, 'lng' => $longitud);
		$this->load->view('template/header');
		$this->load->view('template/nabvar');
		$this->load->view('reporte/mapa', $data);
		$this->load->view('template/slider');
		$this->load->view('template/footer');
	}
	//obtenercantidad d ealertas

	public function obtenerNumeroAlertas()
	{
		// Lógica para obtener el número de alertas desde tu modelo o base de datos
		$numero_alertas = $this->ModelReporte->obtenerNumeroAlertas();

		// Devuelve el número de alertas como una respuesta JSON
		$response = array('numero_alertas' => $numero_alertas);
		echo json_encode($response);
	}
	//vista recursos d eemergencias

	public function recursos_emergencias()
	{
		$data['lineas'] = $this->ModelReporte->listar_lineas();
		$this->load->view('template/header');
		$this->load->view('template/nabvar');
		$this->load->view('reporte/emergencia', $data);
		$this->load->view('template/slider');
		$this->load->view('template/footer');
	}
	//listar incidencias
	//vista recursos d eemergencias

	public function mis_incidencias()
	{
		$validado = $this->ModelReporte->get_Session();
		$idUsuario  = $validado[0]->idUsuario;

		$data['incidencias'] = $this->ModelReporte->get_Incidencia($idUsuario);
		$this->load->view('template/header');
		$this->load->view('template/nabvar');
		$this->load->view('reporte/mis_incidencias', $data);
		$this->load->view('template/slider');
		$this->load->view('template/footer');
	}
	public function getIncidenciasGraf()
	{
		$datos['datos'] = $this->ModelReporte->obtenerCantidadIncidencias();
		echo json_encode($datos);
	}

	public function patrones_barrios()
	{

		$this->load->view('template/header');
		$this->load->view('template/nabvar');
		$this->load->view('reporte/patrones_barrios');
		// $this->load->view('template/slider');
		$this->load->view('template/footer');
	}

	public function patrones_tipos()
	{

		$this->load->view('template/header');
		$this->load->view('template/nabvar');
		$this->load->view('reporte/patrones_tipos');
		// $this->load->view('template/slider');
		$this->load->view('template/footer');
	}


	public function getDatosEstadisticasYPredicciones()
	{
		// Extraer los datos de la base de datos
		$datos = $this->ModelReporte->obtenerCantidadIncidenciasPorMes();

		// Asegúrate de que los datos sean un array si no lo son
		if (is_object($datos)) {
			$datos = json_decode(json_encode($datos), true);
		}

		// Cargar los datos del archivo JSON
		$jsonData = json_encode($datos);

		// URL de la API local (servidor Flask)
		$apiUrl = 'http://127.0.0.1:5001/entrenar_modelo';

		// Iniciar una nueva sesión cURL
		$ch = curl_init();

		// Configurar las opciones de cURL para enviar la solicitud POST
		curl_setopt($ch, CURLOPT_URL, $apiUrl);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
		curl_setopt($ch, CURLOPT_HTTPHEADER, [
			'Content-Type: application/json',
			'Content-Length: ' . strlen($jsonData)
		]);

		// Ejecutar la solicitud y obtener la respuesta
		$response = curl_exec($ch);

		// Verificar si hubo algún error con la solicitud cURL
		if (curl_errno($ch)) {
			$error = curl_error($ch);
			curl_close($ch);
			echo json_encode([
				'predicciones' => [
					'error' => 'Error de conexión: ' . $error
				]
			]);
			return;
		}

		// Obtener el código de estado HTTP
		$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);

		// Verificar si la respuesta fue exitosa
		if ($httpCode !== 200) {
			echo json_encode([
				'predicciones' => [
					'error' => 'Error del servidor: ' . $httpCode
				]
			]);
			return;
		}

		// Decodificar la respuesta de la API
		$predicciones = json_decode($response, true);

		// Verificar si la decodificación fue exitosa
		if (json_last_error() !== JSON_ERROR_NONE) {
			echo json_encode([
				'predicciones' => [
					'error' => 'Error al decodificar la respuesta: ' . json_last_error_msg()
				]
			]);
			return;
		}

		// Preparar el resultado para devolver
		$resultado = [
			'predicciones' => $predicciones
		];

		// Devolver el resultado como JSON
		echo json_encode($resultado);
	}


	// registrar usuario
	public function registrar_usuario()
	{
		$nombre = $this->input->post('nombre');
		$correo = $this->input->post('correo');
		$clave = $this->input->post('clave');

		$validar = $this->ModelReporte->validar($correo);

		$validado = $this->ModelReporte->get_Session();
		if (!empty($validado)) {
			$rol = 'operador';
		} else {
			$rol = 'usuario';
		}

		if (!empty($validar)) {
			$msg = (array('ok' => false, 'post' => 'Ya existe un registro con este correo, debes iniciar sesión.'));
		} else {

			$data = $this->ModelReporte->set_usuario($nombre, $correo, $clave, $rol);

			if ($data) {
				$msg = (array('ok' => true, 'post' => 'Usuario registrado con éxito.'));
			} else {
				$msg = (array('ok' => false, 'post' => 'Error al registrar el usuario.'));
			}
		}
		echo json_encode($msg, JSON_UNESCAPED_UNICODE);
		die();
	}
	// listar usuarios
	public function listar_usuario()
	{
		$dato['usuarios'] = $this->ModelReporte->get_usuarios();

		// var_dump($dato);exit;

		$this->load->view('template/header');
		$this->load->view('template/nabvar');
		$this->load->view('reporte/listar_usuario', $dato);
		$this->load->view('template/slider');
		$this->load->view('template/footer');
	}
	//registro de avances
	public function registrarAvances()
	{
		$id = $this->input->post('id');
		$nota = $this->input->post('nota');

		$data = $this->ModelReporte->insertNota($id, $nota);

		if ($data) {
			$msg = array('ok' => true, 'post' => 'Registrado.');
		} else {
			$msg = array('ok' => false, 'post' => 'Error al registrar avances.');
		}
		echo json_encode($msg, JSON_UNESCAPED_UNICODE);
		die();
	}
	//editar incidencia
	public function editarIncidencia($id)
	{

		$data = $this->ModelReporte->editar_incidencia($id);
		echo json_encode($data, JSON_UNESCAPED_UNICODE);
	}
	//mas detalles
	public function verMas($id)
	{

		$data = $this->ModelReporte->verMas($id);

		echo json_encode($data, JSON_UNESCAPED_UNICODE);
	}
	// incidencias cerradas
	public function incidencias_cerradas()
	{
		$data['incidencias'] = $this->ModelReporte->get_Incidencia_cerradas();
		$this->load->view('template/header');
		$this->load->view('template/nabvar');
		$this->load->view('reporte/incidencias_cerradas', $data);
		$this->load->view('template/slider');
		$this->load->view('template/footer');
	}
	// ver mas detalles incicdencias cerradas
	public function ver_Mas($id)
	{
		$data = $this->ModelReporte->ver_Mas($id);
		echo json_encode($data, JSON_UNESCAPED_UNICODE);
	}
	public function listar_lineas()
	{
		$data['lineas'] = $this->ModelReporte->listar_lineas();
		$this->load->view('template/header');
		$this->load->view('template/nabvar');
		$this->load->view('reporte/listar_lineas', $data);
		$this->load->view('template/slider');
		$this->load->view('template/footer');
	}
	// vista lineas de emergencias

	public function vista_lineas_emergencias()
	{

		$this->load->view('template/header');
		$this->load->view('template/nabvar');
		$this->load->view('reporte/registro_lineas_emergencia');
		$this->load->view('template/slider');
		$this->load->view('template/footer');
	}
	// registrar lineas de emergencias
	public function registrar_lineas()
	{

		$this->load->view('template/header');
		$this->load->view('template/nabvar');
		$this->load->view('reporte/registro_lineas_emergencia');
		$this->load->view('template/slider');
		$this->load->view('template/footer');
	}
	// video
	public function videos()
	{
		$data['link'] = $this->ModelReporte->listar_link();
		$this->load->view('template/header');
		$this->load->view('template/nabvar');
		$this->load->view('reporte/video', $data);
		$this->load->view('template/slider');
		$this->load->view('template/footer');
	}
	// registrar usuario

	public function registrarLineas()
	{
		$entidad = $this->input->post('entidad');
		$linea = $this->input->post('linea');
		$nota = $this->input->post('nota');

		$validar = $this->ModelReporte->validar_linea($linea, $entidad);

		if (!empty($validar)) {
			$msg = (array('ok' => false, 'post' => 'Ya existe un registro con estos datos.'));
		} else {
			$data = $this->ModelReporte->set_lineas($entidad, $linea, $nota);
			if ($data) {
				$msg = (array('ok' => true, 'post' => 'Línea registrada con éxito.'));
			} else {
				$msg = (array('ok' => false, 'post' => 'Error al registrar la línea.'));
			}
		}
		echo json_encode($msg, JSON_UNESCAPED_UNICODE);
		die();
	}
	// eliminar linea de emergencia

	public function Eliminar_linea($id)
	{
		$eliminado = $this->ModelReporte->eliminar_linea($id);
		if ($eliminado) {
			$msg = (array('ok' => true, 'post' => 'Línea eliminada con éxito.'));
		} else {
			$msg = (array('ok' => false, 'post' => 'Error al eliminar la línea.'));
		}
		echo json_encode($msg, JSON_UNESCAPED_UNICODE);
		die();
	}
	//   vista link
	public function vista_link()
	{
		$this->load->view('template/header');
		$this->load->view('template/nabvar');
		$this->load->view('reporte/link');
		$this->load->view('template/slider');
		$this->load->view('template/footer');
	}
	// insertar link de casos
	public function set_link()
	{

		$link = $this->input->post('liken');
		$data = $this->ModelReporte->set_link($link);
		if ($data) {
			$msg = (array('ok' => true, 'post' => 'Link guardado con éxito.'));
		} else {
			$msg = (array('ok' => false, 'post' => 'Error al guardar el link.'));
		}

		echo json_encode($msg, JSON_UNESCAPED_UNICODE);
		die();
	}
	// eliminar link youtube
	public function Eliminar_link($id)
	{
		$eliminado = $this->ModelReporte->eliminar_link($id);
		if ($eliminado) {
			$msg = (array('ok' => true, 'post' => 'Link eliminado con éxito.'));
		} else {
			$msg = (array('ok' => false, 'post' => 'Error al eliminar el link.'));
		}
		echo json_encode($msg, JSON_UNESCAPED_UNICODE);
		die();
	}
	//   vista link
	public function listar_link()
	{
		$dato['link'] = $this->ModelReporte->listar_link();
		$this->load->view('template/header');
		$this->load->view('template/nabvar');
		$this->load->view('reporte/listar_link', $dato);
		$this->load->view('template/slider');
		$this->load->view('template/footer');
	}
	// vista usuario
	public function vista_usuario()
	{

		$this->load->view('template/header');
		$this->load->view('template/nabvar');
		$this->load->view('reporte/registrar_usuario');
		$this->load->view('template/slider');
		$this->load->view('template/footer');
	}
	// eliminar usuario
	public function Eliminar_user($id)
	{
		$eliminado = $this->ModelReporte->Eliminar_user($id);
		if ($eliminado) {
			$msg = (array('ok' => true, 'post' => 'Usuario eliminado con éxito.'));
		} else {
			$msg = (array('ok' => false, 'post' => 'Error al eliminar el Usuario.'));
		}
		echo json_encode($msg, JSON_UNESCAPED_UNICODE);
		die();
	}
	//cerrar session
	public function logout()
	{
		$validado = $this->ModelReporte->get_Session();
		$this->ModelReporte->set_sesion($validado[0]->idUsuario);
		echo '<script>window.location.href="http://localhost/Seguridad_Ciudadana/"</script>';
	}
}