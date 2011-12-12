<?

class AutoLoader{
	public static function load($classname){
		$classname = self::sanatize($classname);
		echo $classname;
		if(file_exists(ROOT_DIR."/core/".$classname.".core.php")){
			include_once(ROOT_DIR."/core/".$classname.".core.php");
		}elseif(file_exists(ROOT_DIR."/classes/".$classname.".class.php")){
			include_once(ROOT_DIR."/classes/".$classname.".class.php");
		}elseif(file_exists(ROOT_DIR."/models/".$classname.".model.php")){
			include_once(ROOT_DIR."/models/".$classname.".model.php");
		}elseif(file_exists(ROOT_DIR."/controllers/".$classname.".controller.php")){
			include_once(ROOT_DIR."/controllers/".$classname.".controller.php");
		}
	}

	public static function sanatize($classname){
		return strtolower($classname);
	}
}

spl_autoload_register("AutoLoader::load");