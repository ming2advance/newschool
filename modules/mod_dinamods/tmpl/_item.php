<?php

 // no direct access
defined('_JEXEC') or die('Restricted access');

JPluginHelper::importPlugin('content', 'loadmodule');
if (JPluginHelper::isEnabled('content', 'loadmodule')) {
	$plgParams = new JParameter('');
	plgContentLoadModule($item, $plgParams);
}
?>
<div class="article">
	<?php echo $item->text; ?>
	<?php if (isset($item->linkOn) && $item->readmore && $params->get('readmore')) :
		echo '<a class="readmore" href="'.$item->linkOn.'">Read more...</a>';
	endif; ?>
</div>