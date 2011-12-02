<h2><?php echo __('Input your server info'); ?></h2>

<form action="<?php echo url_for('setup/install'); ?>" method="post">
  <?php //PENDING: form layout ?>
  <table>
    <?php echo $form; ?>
  </table>
  <input type="submit" value="<?php echo __('Confirm'); ?>" />
</form>