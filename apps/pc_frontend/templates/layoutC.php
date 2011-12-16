<?php
$layout = $sf_user->getPreferredLayout()=='smartphone' ? 'smartphone_layout' : 'layout';
include_partial('global/'.$layout, array('view' => $this, 'sf_content' => $sf_data->getRaw('sf_content'), 'layout' => 'C')) ?>
