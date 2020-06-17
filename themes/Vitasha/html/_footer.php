   
<?php 
global $D;
if (isset($D->_WITH_NOTIFIER) && $D->_WITH_NOTIFIER) {
?>
    <script>
        $(window).focus(function() {
            titlenotifier.reset();
        });
    </script>
<?php } ?>

<?php if (isset($D->msg_alert) && !empty($D->msg_alert)) {?>
    <script>
        alert('<?php echo $D->msg_alert?>')
    </script>
<?php } ?>

</div>

    <!--[if (lt IE 9) & (!IEMobile)]>
    <script src="<?php echo $K->SITE_URL ?>themes/<?php echo $K->THEME; ?>/js/selectivizr.min.js"></script>
    <![endif]-->

    <?php
        // Important - do not remove this:
        if ($K->DEBUG_MODE && $K->DEBUG_CONSOLE) $this->load_template('debug-console.php');
    ?>

    <?php
        @include( $K->INCPATH.'../themes/include_in_footer.php' );
    ?> 
</body>
</html>