<!-- main menu -->
<div class="zn-res-menuwrapper">
    <a href="#" class="zn-res-trigger zn-header-icon"></a>
</div><!-- end responsive menu -->

<?php
    $args = array(
        'container' => 'div',
        'container_id' => 'main-menu',
        'container_class' => 'main-nav',
        'walker' => 'znmegamenu'
    );
    zn_show_nav( 'main_navigation','main-menu', $args );
?>
<!-- end main_menu -->