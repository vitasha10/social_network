<?php echo nl2br($this->lang('email_recovery_hello')); ?><br><br>
<?php echo nl2br($this->lang('email_recovery_msg1', array('#SITE_TITLE#'=>$K->SITE_TITLE))); ?><br>
<a href="<?php echo $D->linkresetpass; ?>" target="_blank"><?php echo $D->linkresetpass; ?></a><br><br>
<?php echo nl2br($this->lang('email_recovery_msg2', array('#SITE_TITLE#'=>$K->SITE_TITLE))); ?><br><br>
<?php echo nl2br($this->lang('email_recovery_signature', array('#SITE_TITLE#'=>$K->SITE_TITLE))); ?><br><br>