<div class="box-activity centered">

<?php switch ($D->the_place) { 

        case 1: ?>

    <div class="mrg20T"><img src="<?php echo $D->the_avatar_user_min; ?>"></div>

    <div class="mrg10T bold" style="font-size:15px;"><?php echo $D->the_name_user?></div>

    <div class="mrg10T mrg20B"><?php echo $this->lang('global_txt_joined', array('#SITE_TITLE#'=>$K->SITE_TITLE))?> <?php echo date($this->lang('global_format_date'), $D->the_register_date)?></div>

    <?php   break; ?>


    <?php case 2: ?>

    <div class="mrg20T"><img src="<?php echo $D->the_avatar_page_min; ?>"></div>

    <div class="mrg10T bold" style="font-size:15px;"><?php echo $D->the_title?></div>

    <div class="mrg10T mrg20B"><?php echo $this->lang('global_txt_created', array('#SITE_TITLE#'=>$K->SITE_TITLE))?> <?php echo date($this->lang('global_format_date'), $D->the_register_date)?></div>

    <?php   break; ?>


    <?php case 3: ?>

    <div class="mrg20T bold" style="font-size:15px;"><?php echo $D->the_title?></div>

    <div class="mrg10T mrg30B"><?php echo $this->lang('global_txt_created', array('#SITE_TITLE#'=>$K->SITE_TITLE))?> <?php echo date($this->lang('global_format_date'), $D->the_register_date)?></div>

    <?php   break; ?>


    <?php case 4: ?>

    <div class="mrg20T bold" style="font-size:15px;"><?php echo $D->the_title?></div>

    <div class="mrg10T mrg30B"><?php echo $this->lang('global_txt_created', array('#SITE_TITLE#'=>$K->SITE_TITLE))?> <?php echo date($this->lang('global_format_date'), $D->the_register_date)?></div>

    <?php   break; ?>

<?php } ?>

</div>