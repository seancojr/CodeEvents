<?php

class CodeEvents_Autoloader extends XenForo_Autoloader
{
	public static function getExtendedInstance()
	{
		$createClass = XenForo_Application::resolveDynamicClass('CodeEvents_Autoloader', 'autoloader');

		if (!$createClass)
		{
			throw new XenForo_Exception("Invalid autoloader '$createClass' specified");
		}

		$extendedInstance = new $createClass();
		$extendedInstance->_rootDir =  XenForo_Autoloader::getInstance()->_rootDir;
		$extendedInstance->_setup = XenForo_Autoloader::getInstance()->_setup;

		return $extendedInstance;
	}

	/**
	* Autoload the specified class.
	*
	* @param string $class Name of class to autoload
	*
	* @return boolean
	*/
	public function autoload($class)
	{
		if (class_exists($class, false) || interface_exists($class, false))
		{
			return true;
		}

		if(strpos($class, 'Ext_Controller_')===0)
		{
			$proxyClass = 'XFCP_' . $class;
			$filename = XenForo_Autoloader::getInstance()->autoloaderClassToFile('CodeEvents_Controller');

			$classCode = file_get_contents($filename);
			$classCode = substr($classCode,5); // removing '<?php' from the beginning
			$searchString = 'class CodeEvents_Controller extends XenForo_ControllerPublic_Abstract';
			$replaceString = 'class ' . $class . ' extends ' . $proxyClass;
			$classCode = str_replace($searchString, $replaceString, $classCode); // replacing declaration

			eval($classCode);
		}


		return parent::autoload($class);
	}

}