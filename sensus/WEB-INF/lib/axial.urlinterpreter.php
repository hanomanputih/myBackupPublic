<?php
class Axial_URLInterpreter
      {
      var $Command;
      var $log;
      var $username;
      
      function Axial_URLInterpreter()
            {
            $this->username = Auth::getCurrentUser()->get_username();
			$this->log = new KLogger('log/controller', KLogger::DEBUG);
            $requestURI = explode('/', $_SERVER['REQUEST_URI']);
            $scriptName = explode('/',string_tools::addSlashes($_SERVER['SCRIPT_NAME']));
            $commandArray = array_diff_assoc(string_tools::replaceUnderscoreToStrip($requestURI),string_tools::replaceUnderscoreToStrip($scriptName));
            $commandArray = array_values($commandArray);
            $controllerFunction = null;
			$controllerName = null;
			$parameters = array();
			
            if (strpos($commandArray[0], "?") !== false) {
            	$controllerNameNoExt = explode('.html',$commandArray[0]);
            	$controllerName = $controllerNameNoExt[0];
            } else {
            	$controllerName = $commandArray[0];
            }
            
			if (count($commandArray) > 1) {
				if (strpos($commandArray[1], "?") !== true) {
					$functionNoExt = explode('.html',$commandArray[1]);
					$controllerFunction = $functionNoExt[0];
				}
			}
            
            if (count($commandArray) > 2) {
				if (strpos($commandArray[2], "?") !== true)
					$parameters = array_slice($commandArray,2);
			}
            // Check if the url is the root.
            // if it is then set the command to the root controller.
            // and _default function.
            if($controllerName == '' or $controllerName == 'index.html')
                  {
                  $controllerName = 'main';
                  }
            else if($controllerName == 'login.html')
                  {
                  $controllerName = 'login';
                  }

			$this->log->logInfo('Expectedly :: ' . $this->username . ' tried to access controller ' . $controllerName . ', function ' . $controllerFunction . ', param ' . json_encode($parameters));
            
        	$functionToCall = $controllerFunction;
	    	if($controllerFunction == ''){
				$functionToCall = 'default';
				$controllerFunction = '_default';
	        } else if ($controllerFunction == 'list'){
				$functionToCall = 'list';
				$controllerFunction = '_list';
	        } else if ($controllerFunction == 'secret'){
				$functionToCall = 'secret';
				$controllerFunction = '_default';
	        } 
	        
	    	$this->log->logInfo('Actualy	  :: ' . $this->username . ' tried to access controller ' . $controllerName . ', function ' . $controllerFunction . ', param ' . json_encode($parameters));
                
			require_once 'WEB-INF/controller/permission_aksi.php';
            $this->Command = new Axial_Command($controllerName,$functionToCall,$parameters);
			$permission_aksi = new permission_aksi($this->Command);
        	if (!$permission_aksi->is_accessible_controller()) {
        		$controllerName = 'error';
        		if ($functionToCall == 'secret') {
        			$controllerFunction = 'iframe_not_found';
        		}
        	}
			$this->Command->setControllerName($controllerName);
            $this->Command->setFunction($controllerFunction);
            $this->Command->setParameters($parameters);
            }

      function getCommand()
            {
            return $this->Command;
            }
      }
?>