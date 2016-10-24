<?php 

	class Router 
	{
		private $routes;

		public function __construct()
		{
			$routesPath = ROOT.'/config/routes.php';
			$this -> routes = include($routesPath);
		}

		//повертає стрічку uri запиту
		private function getURI()
		{
			if(!empty($_SERVER['REQUEST_URI'])){
				return trim($_SERVER['REQUEST_URI'], '/');
			}
		}

		public function run()
		{

			// отримати стрічку запиту
			$uri = $this -> getURI();
			
			// перевірка наявності такого запиту в routes.php
			foreach ($this -> routes as $uriPattern => $path){
				
				if (preg_match("~$uriPattern~", $uri)) {
					
					// отримуєм внутрішній шлях з зовнішнього згідно правила 
					$internalRoute = preg_replace("~$uriPattern~", $path, $uri);

					// визначення контролерів, actions, параметрів
					$segments = explode('/', $internalRoute);

					$controllerName = array_shift($segments).'Controller';
					$controllerName = ucfirst($controllerName);
					
					$actionName = 'action'.ucfirst(array_shift($segments));
					$parameters = $segments;
					

					// підключення файлу класа контролера
					$controllerFile = ROOT.'/controllers/'.$controllerName.'.php';
					if (file_exists($controllerFile)){
						include_once($controllerFile);
					}
					// створення нового об'єкту класа контролера
					$controllerObject = new $controllerName;
					// виклик відповідного Action
					$result = call_user_func_array(array($controllerObject, $actionName),$parameters);
					
					if ($result != null){
						break;
					}
					
				}

			}

		}

	}

?>