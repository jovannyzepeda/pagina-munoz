<?php
/**
 * Session manager
 *
 * Controla la sesion del sistema
 *
  * @version 1.0.0
 * @copyright 2014 - sbda14b CUCEI
 * @package system
 * @subpackage security
 *            
 */
class Session {

	/**
	 * Vigencia de la sesion
	 *
	 * @var int
	 */
	private static $_timeout;

	/**
	 * Identificador unico de sesión
	 *
	 * @var string
	 */
	private $_sid;

	/**
	 * Direccion IP desde la cual se accesa al sistema
	 *
	 * @var string
	 */
	private $_ip;

	/**
	 * Tiempo de expiración de sesión
	 *
	 * @var string
	 */
	private $_datetime;

	/**
	 * Datos de sesion
	 *
	 * @var array
	 */
	private $_data;

	/**
	 * Constructor con parametros
	 *
	 * Inicia la sesión previamente creada, si no existe la crea.
	 *
	 * @access public
	 *        
	 */
	function __construct($timeout = 60){		
		self::$_timeout = $timeout;
		
		// Carga la sesion anterior, si no existe la crea
		if (isset($_SESSION ['info'])) {
			$this->load();
		}
		else {
			$this->create();
		}
		
		$this->check();
	}

	/**
	 * Nombre largo, Modulo
	 *
	 * Descripcción
	 *
	 * @access private
	 *        
	 * @param tipo $nombre Descripccion
	 *       
	 * @return tipo Descripccion
	 *        
	 * @see nombreClase::nombreAttributo (Opccional)
	 *     
	 */
	function __destruct() {
	}

	/**
	 * Imprime la clase
	 *
	 * @access public
	 *        
	 * @return string Una version imprimible de la clase
	 *        
	 */
	function __toString() {
		$str = "";
		
		$str .= "Session\n";
		$str .= "\tSID:\t\t" . $this->_sid . "\n";
		$str .= "\tIP:\t\t" . $this->_ip . "\n";
		$str .= "\tDATETIME:\t" . date('Y-m-d H:i:s', $this->_datetime) . "\n";
		$str .= "\tDATA:\t" . print_r($this->_data, true) . "\n";
		
		return $str;
	}

	/**
	 * Imprime la clase en HTML
	 *
	 * @access public
	 *        
	 * @return string Una version imprimible de la clase
	 *        
	 */
	public function toHTML() {
		$str = "";
		
		$str .= "<br/>";
		$str .= "Session<br/>";
		$str .= "\tSID:\t\t" . $this->_sid . "<br/>";
		$str .= "\tIP:\t\t" . $this->_ip . "<br/>";
		$str .= "\tDATETIME:\t" . date('Y-m-d H:i:s', $this->_datetime) . "<br/>";
		$str .= "\tDATA:\t <pre>" . print_r($this->_data, true) . "</pre><br/>";
		
		return $str;
	}

	/**
	 * Crea la sesion
	 *
	 * Crea una sesion nueva para el usuario que se acaba de conectar
	 *
	 * @access public
	 *        
	 */
	public function create() {
		$this->_sid = session_id();
		$this->_ip = $this->getIP();
		$this->_datetime = time();
		$this->_data = array("module"=>"index");
		
		$_SESSION ['info'] ['sid'] = $this->_sid;
		$_SESSION ['info'] ['ip'] = $this->_ip;
		$_SESSION ['info'] ['datetime'] = $this->_datetime;
		$_SESSION ['info'] ['data'] = $this->_data;
	}

	/**
	 * Carga la sesion
	 *
	 * Carga la sesion anterior que se habia guardado en la sesion
	 *
	 * @access public
	 *        
	 */
	public function load() {
		$this->_sid = $_SESSION ['info'] ['sid'];
		$this->_ip = $_SESSION ['info'] ['ip'];
		$this->_datetime = $_SESSION ['info'] ['datetime'];
		$this->_data = $_SESSION ['info'] ['data'];
	}

	/**
	 * Revisa la vigencia de la sesion
	 *
	 * Revisa que la sesion haya sido actualizada en un timepo no mayor a $SESSION_TIMEOUT
	 *
	 * @access public
	 *        
	 */
	public function check() {
		if ($this->_sid === session_id() && $this->_ip === $this->getIP()) {
			
			$elapsedTime = time() - $this->_datetime;
			
			if ($elapsedTime < self::$_timeout) {
				return true;
			}
			else {
				return false;
			}
		}
		else {
			return false;
		}
	}

	/**
	 * Actualiza la sesion
	 *
	 * Actualiza la sesion, aumentando su tiempo de vigencia por el tiempo indicado en $SESSION_TIMEOUT
	 *
	 * @access public
	 *        
	 */
	public function update() {
		$_SESSION ['info'] ['datetime'] = $this->_datetime = time();
	}

	/**
	 * Crea un nuevo ID de sesion
	 *
	 * Crea un nuevo ID de sesión para mejorar la seguridad del sitio
	 *
	 * @access public
	 *        
	 */
	public function regenerate() {
		session_regenerate_id(true);
		
		$this->_sid = session_id();
		
		$this->update();
		
		$_SESSION ['info'] ['sid'] = $this->_sid;
	}

	/**
	 * Crea un nuevo ID de sesion
	 *
	 * Crea un nuevo ID de sesión para mejorar la seguridad del sitio
	 *
	 * @access public
	 *        
	 */
	public function delete($id=0) {
		$this->_sid = '';
		$this->_ip = '';
		$this->_datetime = 0;
		$this->_data = null;
		
		session_unset();
		
		session_destroy();
	}

	/**
	 * Obtiene la direccion IP
	 *
	 * Trata de obtener la direccion IP del cliente sin importar si esta detras de proxi o firewall
	 *
	 * @access public
	 *        
	 */
	public function getIP() {
		$IP = '';
		if (isset($_SERVER ['HTTP_CLIENT_IP'])) {
			$IP = $_SERVER ['HTTP_CLIENT_IP'];
		}
		elseif (isset($_SERVER ['HTTP_X_FORWARDED_FOR'])) {
			$IP = $_SERVER ['HTTP_X_FORWARDED_FOR'];
		}
		elseif (isset($_SERVER ['HTTP_X_FORWARDED'])) {
			$IP = $_SERVER ['HTTP_X_FORWARDED'];
		}
		elseif (isset($_SERVER ['HTTP_FORWARDED_FOR'])) {
			$IP = $_SERVER ['HTTP_FORWARDED_FOR'];
		}
		elseif (isset($_SERVER ['HTTP_FORWARDED'])) {
			$IP = $_SERVER ['HTTP_FORWARDED'];
		}
		elseif (isset($_SERVER ['REMOTE_ADDR'])) {
			$IP = $_SERVER ['REMOTE_ADDR'];
		}
		else {
			$IP = '0.0.0.0';
		}
		
		return $IP;
	}

	/**
	 * Obtiene los datos
	 *
	 * Obtiene los datos almacenados en la sesion
	 *
	 * @access public
	 * 
	 * @return array Datos alamacenados en la session
	 *
	 */
	public function getData() {
		return $this->_data;
	}
	
	/**
	 * Guarda los datos
	 *
	 * Guardas los datos almacenados en la sesion
	 *
	 * @access public
	 *
	 * @param array $newValue Datos alamacenados en la session
	 *
	 */
	public function setData($newValue) {
		$this->_data = $newValue;
		$_SESSION['usuario']['data'] = $this->_data;
	}
}
?>