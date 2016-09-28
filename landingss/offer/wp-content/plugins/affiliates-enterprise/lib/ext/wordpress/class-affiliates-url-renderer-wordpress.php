<?php
 class Affiliates_Url_Renderer_WordPress extends Affiliates_Url_Renderer { const IXAP183 = 'affiliate-nonce'; const IXAP184 = 'affiliate-nonce-1'; const IXAP185 = 'affiliate-nonce-2'; const IXAP186 = 'affiliate-nonce-filters'; static function init() { self::$IXAP147 = get_option( 'aff_pname', AFFILIATES_PNAME ); self::$IXAP148 = 'cmid'; self::$IXAP149 = 'affiliates_encode_affiliate_id'; add_shortcode( 'affiliates_affiliate_url', array( 'Affiliates_Url_Renderer_WordPress', 'url_shortcode' ) ); add_shortcode( 'affiliates_generate_url', array( 'Affiliates_Url_Renderer_WordPress', 'generate_url_shortcode' ) ); } static function url_shortcode( $IXAP220, $IXAP167 = null ) { $IXAP105 = shortcode_atts( self::$IXAP150, $IXAP220 ); return self::render_affiliate_url( $IXAP105 ); } static function render_affiliate_url( $IXAP105 = array() ) { global $wp_rewrite; $IXAP62 = ''; if ( !isset( $IXAP105['url'] ) ) { $IXAP105['url'] = get_bloginfo( 'url' ); } $IXAP105['pname'] = get_option( 'aff_pname', AFFILIATES_PNAME ); $IXAP62 .= parent::render_affiliate_url( $IXAP105, array( 'Affiliates_Affiliate' => 'Affiliates_Affiliate_WordPress', 'affiliate_id_encoder' => 'affiliates_encode_affiliate_id', 'esc_attr' => 'esc_attr', 'use_parameter' => !$wp_rewrite->using_permalinks() ) ); return $IXAP62; } public static function generate_url_shortcode( $IXAP220, $IXAP167 = null ) { $IXAP236 = isset( $_POST['generate-url'] ) ? trim( $_POST['generate-url'] ) : ''; if ( !empty( $IXAP236 ) ) { if ( ( stripos( $IXAP236, 'http://' ) !== 0 ) && ( stripos( $IXAP236, 'https://' ) !== 0 ) ) { $IXAP236 = 'http://' . $IXAP236; } } $IXAP237 = true; if ( !empty( $IXAP236 ) ) { if ( function_exists( 'filter_var' ) ) { $IXAP237 = filter_var( $IXAP236, FILTER_VALIDATE_URL ) !== false; } } $IXAP238 = !empty( $IXAP236 ) ? self::render_affiliate_url( array( 'url' => $IXAP236, 'type' => self::IXAP154 ) ) : ''; $IXAP62 = ''; $IXAP145 = apply_filters( 'affiliates_generate_url_style', 'div.generate-field span.field-label { display:block; }' . 'div.generate-field span.field-input { display:block; width:62%; }' . 'div.generate-field span.field-input input { width:100%; }' . 'div.generate-field span.error { display:block; color: #900; }' ); if ( !empty( $IXAP145 ) ) { $IXAP62 .= '<style type="text/css">'; $IXAP62 .= $IXAP145; $IXAP62 .= '</style>'; } $IXAP62 .= '<div class="affiliates-generate-url">'; $IXAP62 .= '<form action="" method="post">'; $IXAP62 .= '<div>'; $IXAP62 .= '<div class="generate-field generate-url">'; $IXAP62 .= '<label>'; $IXAP62 .= '<span class="field-label">'; $IXAP62 .= __( 'Page URL', AFFILIATES_PRO_PLUGIN_DOMAIN ); $IXAP62 .= '</span>'; $IXAP62 .= sprintf( '<span class="error" style="%s">', $IXAP237 ? 'display:none;' : '' ); $IXAP62 .= __( 'Please enter a valid URL.', AFFILIATES_PRO_PLUGIN_DOMAIN ); $IXAP62 .= '</span>'; $IXAP62 .= '<span class="field-input">'; $IXAP62 .= sprintf( '<input type="text" name="generate-url" value="%s" />', $IXAP236 ); $IXAP62 .= '</span>'; $IXAP62 .= '</label>'; $IXAP62 .= '</div>'; $IXAP62 .= '<div class="generate-field affiliate-url">'; $IXAP62 .= '<label>'; $IXAP62 .= '<span class="field-label">'; $IXAP62 .= __( 'Affiliate URL', AFFILIATES_PRO_PLUGIN_DOMAIN ); $IXAP62 .= '</span>'; $IXAP62 .= '<span class="field-input">'; $IXAP62 .= sprintf( '<input type="text" name="affiliate-url" value="%s" readonly="readonly" />', $IXAP238 ); $IXAP62 .= '</span>'; $IXAP62 .= '</label>'; $IXAP62 .= '</div>'; $IXAP62 .= '<div class="generate-button">'; $IXAP62 .= sprintf( '<input type="submit" name="generate" value="%s"', __( 'Generate', AFFILIATES_PRO_PLUGIN_DOMAIN ) ); $IXAP62 .= '</div>'; $IXAP62 .= '</div>'; $IXAP62 .= '</form>'; $IXAP62 .= '</div>'; return $IXAP62; } } Affiliates_Url_Renderer_WordPress::init(); 