<?php

class Extension_Model_NewsFeed extends XFCP_Extension_Model_NewsFeed
{
	protected function _prepareNewsFeedItem(array $item, $handlerClassName, array $viewingUser)
	{
		$createClass = XenForo_Application::resolveDynamicClass($handlerClassName, 'news_feed');

		if (!$createClass)
		{
			throw new XenForo_Exception("Invalid news feed handler '$createClass' specified");
		}

		return parent::_prepareNewsFeedItem($item, $createClass, $viewingUser);
	}

}