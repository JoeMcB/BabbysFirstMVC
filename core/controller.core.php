<?

abstract class Controller {
	private $view;
	private $args;

	public function __construct(){
		$this->args = array();

		$this->controllerName = str_replace("Controller", "", get_class($this));
	}

	public function dispatch(){
		if(method_exists($this, $this->view)){
			$viewFunction = $this->view;
			$this->$viewFunction();
		}

		$this->render();
	}

	public function render(){
		extract($this->args);

		if(file_exists(ROOT_DIR.'/views/'.$this->controllerName.$this->view.".view.php")){
			include(ROOT_DIR.'/views/'.$this->controllerName.".".$this->view.".view.php");
		}
	}

	public function setView($view){
		$this->view = $view;
	}

	public function __set($var, $value){
		$this->args[$var] = $value;
	}

	public function __get($var){
		return $this->args[$var];
	}
}