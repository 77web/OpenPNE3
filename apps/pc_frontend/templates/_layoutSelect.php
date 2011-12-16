<?php echo __('Layout'); ?>:
<?php if('pc'==$sf_user->getPreferredLayout()): ?>
<?php echo __('PC'); ?>|<a href="./?op_layout=smartphone"><?php echo __('Smartphone'); ?></a>
<?php else: ?>
<a href="./?op_layout=pc"><?php echo __('PC'); ?></a>|<?php echo __('Smartphone'); ?>
<?php endif; ?>
