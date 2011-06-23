<?php if($sf_request->isSmartPhone()): ?>
<?php include_partial('global/layoutSmartPhone', array('view' => $this, 'sf_content' => $sf_data->getRaw('sf_content'), 'layout' => 'C')) ?>
<?php else: ?>
<?php include_partial('global/layout', array('view' => $this, 'sf_content' => $sf_data->getRaw('sf_content'), 'layout' => 'C')) ?>
<?php endif; ?>
