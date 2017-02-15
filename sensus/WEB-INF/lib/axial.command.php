<?php
class Axial_Command
      {
      var $Name = '';
      var $User = null;
      var $Function = '';
      var $Parameters = array();
      var $Option = '';

      function Axial_Command($controllerName,$functionName,$parameters)
            {
            $this->Parameters = $parameters;
            $this->Name = $controllerName;
            $this->Function =$functionName;
            $this->User = Auth::getCurrentUser();
            }

	  function getUserLogged()
            {
            return $this->User;
            }
            
      function getControllerName()
            {
            return $this->Name;
            }

      function setControllerName($controllerName)
            {
            $this->Name = $controllerName;
            }

      function getFunction()
            {
            return $this->Function;
            }

      function setFunction($functionName)
            {
            $this->Function = $functionName;
            }

      function getParameters()
            {
            return $this->Parameters;
            }

      function setParameters($controllerParameters)
            {
            $this->Parameters = $controllerParameters;
            }
	
	function getOption()
            {
            return $this->Option;
            }

      function setOption($Option)
            {
            $this->Option = $Option;
            }
      }
?>