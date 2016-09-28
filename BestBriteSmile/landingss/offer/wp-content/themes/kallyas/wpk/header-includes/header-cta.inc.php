<?php if ( ! empty( $cta_button_class ) ) { ?>
    <?php
    if ( $head_add_cta_link = zget_option( 'head_add_cta_link', 'general_options' ) ) {

        $cta_style = zget_option( 'head_show_cta_style', 'general_options', false, 'ribbon' ) == 'lined' ? 'lined btn btn-lined' : 'ribbon';

        $link_start = '';
        $link_end = '';

        if(!empty($head_add_cta_link) && is_array($head_add_cta_link)){
            $url = $head_add_cta_link['url'];
            $title = $head_add_cta_link['title'];

            $target = $head_add_cta_link['target'];
            $link_target = '';
            if($target == '_blank' || $target == '_self'){
                $link_target .= ' target="' . $target  . '"';
            } else if($target == 'modal'){
                $link_target .= ' data-lightbox="image"';
            } else if($target == 'modal_iframe'){
                $link_target .= ' data-lightbox="iframe"';
            } else if($target == 'modal_inline'){
                $link_target .= ' data-lightbox="inline"';
            } else if($target == 'smoothscroll'){
                $link_target .= ' data-target="smoothscroll"';
            }

            if( !empty($url) ){
                $link_start = '<a href="'.$url.'" '.$link_target.' title="'.$title.'" class="ctabutton kl-cta-'.$cta_style.'" id="ctabutton">';
                $link_end = '</a>';
            }
        }

        if ( $head_set_text_cta = zget_option( 'head_set_text_cta', 'general_options' ) ) {

            echo !empty( $link_start ) ? $link_start : '<span id="ctabutton" class="ctabutton kl-cta-'.$cta_style.'">';
                echo $head_set_text_cta;

                if( zget_option( 'head_show_cta_style', 'general_options', false, 'ribbon' ) != 'lined') {
                    echo '<svg version="1.1" class="trisvg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" preserveAspectRatio="none" width="14px" height="5px" viewBox="0 0 14.017 5.006" enable-background="new 0 0 14.017 5.006" xml:space="preserve"><path fill-rule="evenodd" clip-rule="evenodd" d="M14.016,0L7.008,5.006L0,0H14.016z"></path></svg>';
                }
            echo !empty( $link_end ) ? $link_end : '</span>' ;
        }
    }
} ?>