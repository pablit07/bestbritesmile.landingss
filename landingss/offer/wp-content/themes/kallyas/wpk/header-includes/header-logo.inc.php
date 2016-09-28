<!-- logo container-->
<?php
    $hasInfoCard = zget_option( 'infocard_display_status', 'general_options', false, 'no' ) == 'yes' ? 'hasInfoCard' : '';
?>
<div class="logo-container <?php echo $hasInfoCard; ?> logosize--<?php echo zget_option( 'logo_size', 'general_options', false, 'yes' ); ?>">
    <!-- Logo -->
    <?php
        echo zn_kl_logo();
    ?>
    <!-- InfoCard -->
    <?php do_action( 'zn_show_infocard' ); ?>
</div>
