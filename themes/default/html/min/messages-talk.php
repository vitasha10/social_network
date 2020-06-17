                    <div id="messages-2-parts-right">

                        <div class="box-white mrg20B">
                            
                            <div class="box-white-header-clean">
                                <div class="title"><?php if (isset($D->name_user_chat)) echo $D->name_user_chat?></div>
                                <div class="clear"></div>
                            </div>
                            
                            <div class="container-body noempty">
                                <div>
                                    <div id="space-talk-messages" class="slimscrollers" style="padding:0 7px; border-bottom:1px solid #DFE4E6" data-slimScroll-height="370px">
                                        <div id="list_messages_talk_alone">
                                        <?php
                                        if (isset($D->html_talks_messages) && !empty($D->html_talks_messages)) echo $D->html_talks_messages;
                                        ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div id="space_inpu_chat_alone">
                            
                                <div><textarea id="input_chat_in_talk" name="input_chat_in_talk" class="action_autosize theinputchatmax" rows="1" placeholder="<?php echo $this->lang('global_txt_write_message')?>"></textarea></div>


                                <div class="bar-tools">
                                
                                    <div id="tool-photo-chat-alone" class="one-tool-chat">
                                        <img id="bphoto_chat_alone" class="ico-tool-chat" src="<?php echo getImageTheme('cha-ico-photo.png'); ?>" title="<?php echo $this->lang('global_box_chat_alt_photo')?>">
                                        <form id="form_photo_chat_alone" name="form_photo_chat_alone" action="" method="POST" enctype="multipart/form-data">
                                            <input id="chat_photo_alone" name="chat_photo_alone" accept="image/*" type="file"  class="hide">
                                        </form>
                                    
                                    </div>
                                
                                    <div class="one-tool-chat the-smiles-chat"><img class="ico-tool-chat" src="<?php echo getImageTheme('cha-ico-smile.png'); ?>" title="<?php echo $this->lang('global_box_chat_alt_smile')?>"></div>
                                    
                                    <div class="menusmiles-chat" style="bottom:88px; left:5px;"><?php echo getAreaEmoticons('input_chat_in_talk'); ?></div>
                                
                                    <div id="tool-file-chat-alone" class="one-tool-chat">
                                        <img id="bfile_chat_alone" class="ico-tool-chat" src="<?php echo getImageTheme('cha-ico-attach.png'); ?>" title="<?php echo $this->lang('global_box_chat_alt_file')?>">
                                        <form id="form_attachfile_chat_alone" name="form_attachfile_chat_alone" action="" method="POST" enctype="multipart/form-data">
                                            <input id="chat_attachfile_alone" name="chat_attachfile_alone" accept="i*" type="file"  class="hide">
                                        </form>
                                    </div>
                                
                                    <div id="bstick-alone" class="one-tool-chat the-stickers-chat">
                                        <img class="ico-tool-chat" src="<?php echo getImageTheme('cha-ico-sticker.png'); ?>" title="<?php echo $this->lang('global_box_chat_alt_sticker')?>">
                                    </div>
                                    <div class="menustickers-chat inalone" style="bottom:58px; left:5px;"><div id="box-stickrs-alone" class="slimscrollers"><?php echo getAreaStickers($D->code_user_chat, 'insertStickerAlone'); ?></div></div>
                                    
                                    <div class="one-tool-chat tright">
                                        <img onclick="insertStickerAlone('<?php echo $D->code_user_chat; ?>', '00');" class="ico-tool-chat" src="<?php echo getImageTheme('cha-ico-ok.png'); ?>">
                                    </div>
                                
                                    <div class="clear"></div>
                                
                                </div>   
                                
                                <script>
                                    $(".action_autosize").each(function(){
                                        autosize(this);
                                    });
                                    
                                    $("#bphoto_chat_alone").click(function(){
                                        $("#chat_photo_alone").click();
                                    });
                                    
                                    $("#chat_photo_alone").change(function(){
                                        insertPhotoInChatAlone('<?php echo $D->code_user_chat; ?>', this.files[0]);
                                    });
                                    
                                    $("#bfile_chat_alone").click(function(){
                                        $("#chat_attachfile_alone").click();
                                    });
                                    
                                    $("#chat_attachfile_alone").change(function(){
                                        insertFileInChatAlone('<?php echo $D->code_user_chat; ?>', this.files[0]);
                                    });
                                </script>
                            
                            </div>
                            
                        </div>
                        
                    </div>
                    
                    <div class="clear"></div>
                    
                    <?php if (isset($D->titlePhantom) && !empty($D->titlePhantom)) { ?>
                    <div id="newtitlesite" style="display:none;"><?php echo $D->titlePhantom?></div>
                    <?php } ?>
                    
                    <script>
                       $('#the-talk-<?php echo $D->the_idtalk?>').addClass('active');
                    
                        if (NUM_CHATS_ALL > 0) closeBoxChat('<?php echo $D->code_user_chat?>');
                        
                        var message_talk_alone;
                    
                        activeSlimScrollers();
                        $('#space-talk-messages').slimScroll({ scrollTo: $('#space-talk-messages')[0].scrollHeight + 'px' });
                        
                        $("#input_chat_in_talk").on("keydown", function (event) {
                            if (event.keyCode == 13 && event.shiftKey == 0) {
                                event.preventDefault();
                                message_talk_alone = $(this).val();
                                if (is_empty(message_talk_alone)) return;
                                sendMessageChatAlone('<?php echo $D->code_user_chat?>');
                            }
                        });   
                        
                        getChatAlone('<?php echo $D->code_user_chat?>');
                    </script>