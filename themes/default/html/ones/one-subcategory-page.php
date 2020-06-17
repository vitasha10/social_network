<div id="onecat-<?php echo $D->one->idcategory?>" class="one_item">

    <div id="spacecat-<?php echo $D->one->idcategory?>">

        <div id="delcat-<?php echo $D->one->idcategory?>" class="delete_item opc_delete_cat">x</div>

        <div class="info_item">

            <div id="textname<?php echo $D->one->idcategory?>" class="the_name"><?php echo $D->one->name?></div>
            <div id="errorcat-<?php echo $D->one->idcategory?>" class="alert alert-red hide"></div>
            <div><span id="bedit-<?php echo $D->one->idcategory?>" class="the_option">Edit</span></div>

        </div>

    </div>

    <div id="areaedit-<?php echo $D->one->idcategory?>" class="hide edit_item">

        <div class="space-in-admin">

            <form id="formcat<?php echo $D->one->idcategory?>" name="formcat<?php echo $D->one->idcategory?>" method="post" action="">

            <div class="form-block">

                <label for="namecategory<?php echo $D->one->idcategory?>"><?php echo $this->lang('admin_pages_subcategories_text_subcategory')?></label>

                <input name="namecategory<?php echo $D->one->idcategory?>" type="text" id="namecategory<?php echo $D->one->idcategory?>" class="form-control" value="<?php echo $D->one->name?>"/>

            </div>

            <div id="msgerrorcat<?php echo $D->one->idcategory?>" class="alert alert-red hide"></div>

            <div class="mrg5T mrg10B">

                <span><input type="submit" name="bupdate<?php echo $D->one->idcategory?>" id="bupdate<?php echo $D->one->idcategory?>" value="<?php echo $this->lang('admin_pages_categories_txt_update'); ?>" class="my-btn my-btn-small"/></span> <span id="bcancel<?php echo $D->one->idcategory?>" class="grey2 hand" style="margin-left:10px;"><?php echo $this->lang('admin_pages_categories_txt_cancel'); ?></span>

            </div>

            </form>

        </div>

    </div>

    <div class="clear"></div>

</div>

<script>

$('#delcat-<?php echo $D->one->idcategory?>').click(function(){
    closeEmerged();
    _confirm(msg_delete_subcategory_page, nothign, deleteSubCategoryPage, <?php echo $D->one->idcategory?>);
});

$('#bedit-<?php echo $D->one->idcategory?>').click(function(e){
    e.preventDefault();
    $('#spacecat-<?php echo $D->one->idcategory?>').slideUp('slow', function(){
        $('#areaedit-<?php echo $D->one->idcategory?>').slideDown('slow');
    });
});

$('#bcancel<?php echo $D->one->idcategory?>').click(function(e){
    e.preventDefault();
    $('#areaedit-<?php echo $D->one->idcategory?>').slideUp('slow', function(){
        $('#spacecat-<?php echo $D->one->idcategory?>').slideDown('slow', function(){
            $('#namecategory<?php echo $D->one->idcategory?>').val('<?php echo $D->one->name?>');	   
        });
    });
});

$('#bupdate<?php echo $D->one->idcategory?>').click(function(e){
    e.preventDefault();
    updateSubCategoryPage(<?php echo $D->one->idcategory?>);
});

</script>