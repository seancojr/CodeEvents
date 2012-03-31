<?php


class Extension_EventListener_Static
{
	public static function initDependencies(XenForo_Dependencies_Abstract $dependencies, array $data)
	{
		XenForo_Autoloader::setInstance(Extension_Autoloader::getExtendedInstance());
	}
}