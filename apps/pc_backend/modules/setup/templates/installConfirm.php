<h2><?php echo __('Confirm your server info', array(), 'form_install'); ?></h2>

<form action="<?php echo url_for('setup/install'); ?>" method="post">
  <?php //PENDING: confirm layout ?>
  <table>
    <?php foreach($form as $name => $field): ?>
      <?php if('_csrf_token' != $name): ?>
        <tr>
          <th><?php echo $form[$name]->renderLabel(); ?></th>
          <td><?php echo is_array($form->getValue($name)) ? implode('<br />', $form->getValue($name, ESC_RAW)) : $form->getValue($name); ?></td>
        </tr>
      <?php endif; ?>
    <?php endforeach; ?>
  </table>
  <?php echo $confirmForm; ?>
  <input type="submit" value="<?php echo __('Install', array(), 'form_install'); ?>" />
</form>