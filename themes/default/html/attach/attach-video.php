            <div style="padding:0 10px 10px;">
                <div class="video-js-responsive-container vjs-hd">
                    <video class="video-js js_video-js vjs-big-play-centered" controls preload="auto" poster="">
                        <source src="<?php echo($D->is_shared ? $D->shared->file_src : $D->file_src); ?>">
                    </video>
                </div>
            </div>