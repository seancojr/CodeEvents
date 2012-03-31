<?php

/**
 * This class will be used as a string in eval() to extend all public and admin conrollers.
 * String '<?php' will be removed from the beginning.
 * Declaration 'class Extension_Controller extends XenForo_ControllerPublic_Abstract'
 * will be replaced by declarations of type
 * 'class Extension_Controller%Type%_%Name% extends XFCP_Extension_Controller%Type%_%Name%'.
 * Here %Type% is Public or Admin amd %Name% is the the name of extended controller.
 *
 * It is declared only for convenient use in IDE.
 * What is really needed, its body as a string, argument of eval()
 */

class Extension_Controller extends XenForo_ControllerPublic_Abstract
{
	protected function _postDispatch($controllerResponse, $controllerName, $action)
	{
		XenForo_CodeEvent::fire('controller_post_dispatch', array($this, &$controllerResponse, $controllerName, $action));

		parent::_postDispatch($controllerResponse, $controllerName, $action);
	}

	public function getHelper($class)
	{
		if (strpos($class, '_') === false)
		{
			$class = 'XenForo_ControllerHelper_' . $class;
		}

		$createClass = XenForo_Application::resolveDynamicClass($class, 'controller_helper');

		if (!$createClass)
		{
			throw new XenForo_Exception("Invalid controller helper '$class' specified");
		}

		return parent::getHelper($createClass);
	}
}