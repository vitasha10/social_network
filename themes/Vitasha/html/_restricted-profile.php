                    <div id="profile-content-area">

                        <div class="box-white">
    
                            <div class="mrg50T mrg30B" style="font-size:16px; font-weight:bold;"><p class="centered"><?php echo $this->lang('profile_txt_restrictedprofile')?></p></div>
                            
                            <?php if ($D->privacy == 1) { ?>
                            <div class="mrg50B" style="font-size:14px;"><p class="centered"><?php echo $this->lang('profile_txt_mustbefriend')?></p></div>
                            <?php } ?>
                            
                            <?php if ($D->privacy == 2) { ?>
                            <div class="mrg50B" style="font-size:14px;"><p class="centered"><?php echo $this->lang('profile_txt_profileprivate')?></p></div>
                            <?php } ?>
                            
                        </div>

                    </div>
