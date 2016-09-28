<?php if ( $isSearch ) { ?>
    <!-- search -->
    <div id="search" class="header-search">
        <a href="#" class="searchBtn <?php echo ($headerLayoutStyle == 'style8' || $headerLayoutStyle == 'style9') ? 'alw-visible':''; ?>"><span class="glyphicon glyphicon-search kl-icon-white"></span></a>

        <div class="search-container">
            <form class="header-searchform" action="<?php echo home_url(); ?>" method="get">
                <input name="s" maxlength="20" class="inputbox" type="text" size="20"
                       value="<?php echo __( 'SEARCH ...', 'zn_framework' ); ?>"
                       onblur="if (this.value=='') this.value='<?php echo __( 'SEARCH ...', 'zn_framework' ); ?>';"
                       onfocus="if (this.value=='<?php echo __( 'SEARCH ...', 'zn_framework' ); ?>') this.value='';"/>
                <!-- <input type="submit" id="searchsubmit" value="<?php _e( 'go', 'zn_framework' ); ?>" class="searchsubmit glyphicon glyphicon-search kl-icon-white"/> -->
                <button type="submit" class="searchsubmit glyphicon glyphicon-search kl-icon-white"></button>
                <?php echo ($headerLayoutStyle == 'style8' || $headerLayoutStyle == 'style9') ? '<span class="kl-field-bg"></span>':''; ?>
            </form>
        </div>
    </div>
    <!-- end search -->
<?php } ?>
