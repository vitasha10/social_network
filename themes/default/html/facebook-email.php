<?php $this->load_template('_header.php'); ?>

<div id="generic-top-area">
    <?php $this->load_template('_top.php'); ?>
</div>

<div id="generic-main-area">

    <div class="onlycontainer-basic">
        <div style="text-align:center; margin-top:100px; margin-bottom:80px; ">
            <div style="font-size:20px; font-weight:bold;"><?php echo $this->lang('global_txt_facebook_email_title');?></div>
            
            <div style="font-size:16px; margin-top:20px;"><?php echo $this->lang('global_txt_facebook_email_line01');?></div>
            
            <div style="font-size:16px; margin-top:20px;"><?php echo $this->lang('global_txt_facebook_email_line02');?></div>
            
            <div style="font-size:16px; margin-top:20px;"><?php echo $this->lang('global_txt_facebook_email_line03');?></div>
            
        </div>
    </div>

</div>

<div id="generic-foot-area">
<?php $this->load_template('_foot-out.php'); ?>
</div>

<?php $this->load_template('_footer.php'); ?>