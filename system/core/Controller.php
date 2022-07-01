<?php


defined('BASEPATH') or exit('No direct script access allowed');

class CI_Controller{

	/**
	 * Reference to the CI singleton
	 *
	 * @var	object
	 */
	private static $instance;

	/**
	 * CI_Loader
	 *
	 * @var	CI_Loader
	 */
	public $load;

	/**
	 * Class constructor
	 *
	 * @return	void
	 */
	public function __construct()
	{
		self::$instance = &$this;

		// Assign all the class objects that were instantiated by the
		// bootstrap file (CodeIgniter.php) to local class variables
		// so that CI can run as one big super object.
		foreach (is_loaded() as $var => $class) {
			$this->$var = &load_class($class);
		}

		$this->load = &load_class('Loader', 'core');
		$this->load->initialize();
		log_message('info', 'Controller Class Initialized');
	}

	// --------------------------------------------------------------------

	/**
	 * Get the CI singleton
	 *
	 * @static
	 * @return	object
	 */
	public static function &get_instance(){
		return self::$instance;
	}
}

class App extends CI_Controller{


	public $defaultLanguage = 'fr';
	public $language = null;


	function __construct(){
		parent::__construct();


		if( $this->input->get("lang") != "" && in_array($this->input->get("lang"), array("en", "fr")) ){
            $_SESSION['lang'] = $this->input->get("lang");
        }
        
        $lang = ( array_key_exists("lang", $_SESSION) && $_SESSION['lang'] ) ? $_SESSION['lang'] : $this->defaultLanguage;
        $this->language = $lang;


		$this->load->model("Base_model", "Base", true);

		// Définition du timezone
		date_default_timezone_set($this->config->item("default_timezone"));
	}


	public function lang($index, $vars = null){
		$this->load->library('parser');
		$translation = $this->lang->line($index);
		if( !is_null($vars) && gettype($vars) == "array" ){
			$string = $this->parser->parse_string($translation, $vars, TRUE);
			return $string;
		}
		else{
			return $translation;
		}
	}


	protected function isAjax($getout = true){
		if (!$this->input->is_ajax_request()) {
			if ($getout)
				show_404();
			else
				return false;
		} else
			return true;
	}




	public function get_uid($prefix = ""){
		$code = $prefix . "1" . date("md") . abs(crc32(uniqid())); return $code;
	}



	public function _get($table, $where = ""){
		$data = $this->Base->getwhere($table, $where, "*", 9999, "dateof", "DESC");
		return $data;
	}

}
