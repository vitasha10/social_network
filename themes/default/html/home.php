<?php $this->load_template('_header.php'); ?>

<div class="inhome">
    <div class="space-logo">
        <div class="isotipo"><img src="<?php echo getImageTheme('isotipo-white.png')?>"></div>
        <div class="logo"><img src="<?php echo getImageTheme('logo-white.png')?>"></div>
    </div>
    
    <div class="space-message">
        <div class="message1"><?php echo $this->lang('home_msg_line1')?></div>
        <div class="message2"><?php echo $this->lang('home_msg_line2')?></div>
    </div>
    
    <div class="space-botons">
        <div class="one-boton"><a href="<?php echo $K->SITE_URL?>login"><span class="hbtn"><?php echo $this->lang('home_blogin')?></span></a></div>
        <div class="one-boton"><a href="<?php echo $K->SITE_URL?>signup"><span class="hbtn"><?php echo $this->lang('home_bregister')?></span></a></div>
    </div>
    
    
    <?php if ($K->LOGIN_WITH_FACEBOOK || $K->LOGIN_WITH_TWITTER) { ?>
    <div class="space-social">
        <div class="stitle"><?php echo $this->lang('home_txt_connect')?></div>
        
        <div>
        
            <?php if ($K->LOGIN_WITH_FACEBOOK) { ?>
            <div class="areabfacebook">
                <a href="<?php echo $D->FB_loginURL?>" class="undecorated">
                <div class="bfacebook">
                    <div class="iconofbf"><img src="<?php echo getImageTheme('icobfacebook.png')?>"></div>
                    <div class="titlebfb"><div class="centered"><?php echo $this->lang('home_bfacebook')?></div></div>
                    <div class="sh"></div>
                </div>
                </a>
            </div>
            <?php } ?>
        
            <?php if ($K->LOGIN_WITH_TWITTER) { ?>
            <div class="areabtwitter">
                <a href="<?php echo $K->SITE_URL ?>oauthtwitter" class="undecorated">
                <div class="btwitter">
                    <div class="iconobtw"><img src="<?php echo getImageTheme('icobtwitter.png')?>"></div>
                    <div class="titlebtw"><div class="centered"><?php echo $this->lang('home_btwitter')?></div></div>
                    <div class="sh"></div>
                </div>
                </a>
            </div>
            <?php } ?>

        </div>

    </div>
    
    <?php } ?>


</div>

<?php $this->load_template('_footer.php'); ?>