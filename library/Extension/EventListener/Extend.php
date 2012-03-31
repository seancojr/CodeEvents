<?php


class Extension_EventListener_Extend
{
	public static function loadClassModel($class, array &$extend)
	{
		if ($class == 'XenForo_Model_NewsFeed')
		{
			$extend[] = 'Extension_Model_NewsFeed';
		}
	}

	public static function loadClassController($class, array &$extend)
	{
		$extend[] = 'Ext_Controller_' . $class;
	}
}
