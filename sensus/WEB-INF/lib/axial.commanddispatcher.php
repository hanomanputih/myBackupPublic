<?php
class Axial_CommandDispatcher
      {
      var $Command;

      function Axial_CommandDispatcher(&$command)
            {
            $this->Command = $command;
            }

      function isController($controllerName)
            {
            if(file_exists('WEB-INF/controller/'.$controllerName.'_aksi.php'))
                  {
                  return true;
                  }
            else
                  {
                  return false;
                  }
            }
            
      function Dispatch()
            {
            $controllerName = $this->Command->getControllerName();
			
            if($this->isController($controllerName) == false)
                  {
                  $controllerName = 'error';
                  $this->Command->setControllerName($controllerName);
                  $this->Command->setFunction('page_not_found');
                  }
            include_once('WEB-INF/controller/'.$controllerName.'_aksi.php');
            $controllerClass = $controllerName."_aksi";
            $controller = new $controllerClass($this->Command);
            if(!is_callable(array($controller,$this->Command->getFunction()))) {
				$this->Command->setFunction('_error');
				$this->Command->setControllerName('error');
				$controller->set_command($this->Command);
			}
            $controller->execute();
            }
      }
?>