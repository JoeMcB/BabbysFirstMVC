<?

class Router {
	const REGEXP = 0;
	const EXACT = 1;
	
	private static $routes = array(
		self::REGEXP => array(),
		self::EXACT => array()
	);
	
	public static function add_route($path, $type, $controller, $view){
		self::$routes[$type][] = array(
			"path" => $path,
			"controller"	=> $controller,
			"view"	=> $view
		);
	}

	public static function route($path){
			$matched = false;
			
			//Check exact routes
			foreach(self::$routes[self::EXACT] as $route){
				if($path == $route['path']){
					if(file_exists(ROOT_DIR.'/controllers/'.$route['controller'].".controller.php")){
						$controllerClass = ucfirst($route['controller']).'Controller'; 
						$controller = new $controllerClass();
						$controller->setView($route['view']);

						break;
					}else{
						
						throw new Exception("Route matched, Controller not found!");
					}
				}
			}

			//Check regexp routes 
			foreach(self::$routes[self::REGEXP] as $route){
				if( pregmatch($route, $path)){
					if(file_exists(ROOT_DIR.'/controllers/'.$controller.".controller.php")){
						$controllerClass = ucfirst($route['controller']).'Controller'; 
						$controller = new  ${$controllerClass}();
						$controller->setView($route['view']);

						break;
					}else{
						throw new Exception("Route matched, Controller not found!");
					}

					break;		
				}
			}

			if(isset($controller) && is_object($controller)){
				return $controller;
			}else{
				throw new Exception("Route not found.");
			}
		}
			
	}
