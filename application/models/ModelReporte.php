<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModelReporte extends CI_Model
{

	function __construct()
	{

		parent::__construct();
	}
	//obtener incidencias

	public function get_Incidencia($idUsuario)
	{
		$this->db->select('*');

		$this->db->from('incidencias');
		$this->db->where('idUsuario', $idUsuario);
		return $this->db->get()->result();
	}

	public function obtenerCantidadIncidencias()
	{
		$query = $this->db->query("SELECT MONTH(fecha) as mes, COUNT(*) as cantidad FROM incidencias GROUP BY MONTH(fecha)");
		return $query->result();
	}
	
	public function obtenerCantidadIncidenciasPorMes()
	{
		$query = $this->db->query("SELECT 
				MONTH(fecha) as mes, 
				DAY(fecha) as dia, 
				hora, 
				barrio, 
				tipo_incidencia, 
				nivel_urgencia, 
				COUNT(*) as cantidad 
			FROM incidencias 
			GROUP BY mes, dia, hora, barrio, tipo_incidencia, nivel_urgencia
		");
		return $query->result_array();
	}


	//obtener incidencias en procesos

	public function get_Incidencias()
	{
		$this->db->select('*');

		$this->db->from('incidencias');
		$this->db->where('estado', 'En proceso');
		$this->db->where('idUsuario', NULL);

		return $this->db->get()->result();
	}

	public function get_Incidenciass()
	{
		$this->db->select('i.*, u.correo');

		$this->db->from('incidencias i');
		$this->db->join('usuarios u', 'i.idUsuario = u.id');
		$this->db->where('estado', 'En proceso');
		return $this->db->get()->result();
	}
	//guardar incidencias

	public function guardar_incidencia(
		$tipo_incidencia,
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
	) {

		$data = array(
			'tipo_incidencia' => $tipo_incidencia,
			'fecha' => $fecha,
			'hora' => $hora,
			'barrio' => $barrio,
			'descripcion' => $descripcion,
			'latitud' => $latitud,
			'longitud' => $longitud,
			'imagen' => $adjuntos,
			'nivel_urgencia' => $urgencia,
			'idUsuario' => $idUsuario,
			'nombre' => $nombre_anonimo,
			'correo' => $correo_anonimo
		);
		return $this->db->insert('incidencias', $data);
	}
	//obtener alertas

	public function obtenerNumeroAlertas()
	{
		$this->db->select('*');

		$this->db->from('incidencias');
		$this->db->where('estado', 'En proceso');
		$result = $this->db->get()->result();
		return count($result);
	}
	//finalizar incidencias

	public function set_Finalizar_Incidecia($id, $estado, $fecha)
	{
		$this->db->where('id', $id);
		$data = array(
			'estado' => $estado,
			'fecha_finalizacion' => $fecha
		);
		return $this->db->update('incidencias', $data);
	}
	// registro de usuario y operador

	public function set_usuario($nombre, $correo, $clave, $rol)
	{
		$data = array(
			'nombre' => $nombre,
			'correo' => $correo,
			'clave' => $clave,
			'rol' => $rol
		);

		return $this->db->insert('usuarios', $data);
	}
	// listar usuarios

	public function get_usuarios()
	{
		$this->db->select('*');

		$this->db->from('usuarios');
		return $this->db->get()->result();
	}
	// listar usuario

	public function get_usuario($idUser)
	{
		$this->db->select('*');

		$this->db->from('usuarios');
		$this->db->where('id', $idUser);
		return $this->db->get()->result();
	}
	//validar login

	public function validar_login($correo, $clave)
	{

		$this->db->select('*');

		$this->db->from('usuarios');
		$this->db->where('correo', $correo);
		$this->db->where('clave', $clave);
		return $this->db->get()->result();
	}
	//validar correo antes de registrar

	public function validar($correo)
	{
		$this->db->select('correo');

		$this->db->from('usuarios');
		$this->db->where('correo', $correo);
		return $this->db->get()->result();
	}
	//editar nota de incidencias

	public function editar_incidencia($id)
	{
		$this->db->select('id,nota');
		$this->db->from('incidencias');
		$this->db->where('id', $id);
		return $this->db->get()->result();
	}
	//insertar avances a casos

	public function insertNota($id, $nota)
	{

		$this->db->where('id', $id);
		$data = array('nota' => $nota);
		return $this->db->update('incidencias', $data);
	}
	//ves mas detalles incidencias

	public function verMas($id)
	{
		$this->db->select('fecha,hora,nota,descripcion,estado,fecha_finalizacion');
		$this->db->from('incidencias');
		$this->db->where('id', $id);
		return $this->db->get()->result();
	}
	// incidencias cerradas

	public function get_Incidencia_cerradas()
	{
		$this->db->select('*');

		$this->db->from('incidencias');
		$this->db->where('estado', 'Finalizada');
		return $this->db->get()->result();
	}
	// ver mas detalles incidencias cerradad
	//ves mas

	public function ver_Mas($id)
	{
		$this->db->select('fecha,hora,nota,descripcion,estado,fecha_finalizacion');
		$this->db->from('incidencias');
		$this->db->where('id', $id);
		$this->db->where('estado', 'Finalizada');
		return $this->db->get()->result();
	}
	// validar linea de emergencia

	public function validar_linea($entidad, $linea)
	{

		$this->db->select('*');

		$this->db->from('lineas_emergencias');
		$this->db->where('entidad', $entidad);
		$result = $this->db->get()->result();

		if (empty($result)) {
			$this->db->select('*');

			$this->db->from('lineas_emergencias');
			$this->db->where('linea', $linea);

			$result = $this->db->get()->result();
		}
		return $result;
	}
	// insertar lineas de emergencias

	public function set_lineas($entidad, $linea, $nota)
	{
		$data = array(
			'entidad' => $entidad,
			'linea' => $linea,
			'nota' => $nota,
		);

		return $this->db->insert('lineas_emergencias', $data);
	}
	// listar ineas

	public function listar_lineas()
	{
		$this->db->select('*');

		$this->db->from('lineas_emergencias');
		return $this->db->get()->result();
	}
	// eliminar linea de emergencias

	public function eliminar_linea($id)
	{

		$this->db->where('id', $id);
		return $this->db->delete('lineas_emergencias');
	}
	// listar link

	public function listar_link()
	{
		$this->db->select('*');

		$this->db->from('link');
		return $this->db->get()->result();
	}
	// inserta link de youtuve

	public function set_link($link)
	{
		$data = array(
			'url' => $link,
		);

		return $this->db->insert('link', $data);
	}
	// eliminar link

	public function eliminar_link($id)
	{
		$this->db->where('id', $id);
		return $this->db->delete('link');
	}

	public function Eliminar_user($id)
	{
		$this->db->where('id', $id);
		return $this->db->delete('usuarios');
	}
	// insertar session temporal

	public function insert_session($idUsuario, $nombre, $rol)
	{
		$data = array(
			'idUsuario' => $idUsuario,
			'nombre' => $nombre,
			'rol' => $rol,
		);

		return $this->db->insert('session_temporal', $data);
	}
	// consultar session temporar

	public function get_Session()
	{
		$this->db->select('*');

		$this->db->from('session_temporal');
		return $this->db->get()->result();
	}
	// eliminar session temporal

	public function set_sesion($id)
	{
		$this->db->where('idUsuario', $id);
		return $this->db->delete('session_temporal');
	}
}
