<?php

function zn_addons_page_extensions(){
	?>
	<div class="wrap zn-extensions-container">
		<header class="zn-extensions-header">
			<h2><?php _e( 'THEME EXTENSIONS', 'zn_framework' ); ?></h2>
			<p><?php _e( 'Expand the functionality of the theme with the following extensions.', 'zn_framework' ); ?></p>

		</header>

		<?php
		// Check to see if an older TGM class is instantiated
		if( ! method_exists( TGM_Plugin_Activation::$instance, 'is_plugin_installed' ) ){

			echo '<div class="zn-extensions-error-container">';
				echo '<p class="zn-extensions-error-message">'. __( 'It seems that one of your plugins included an outdated version of the TGM Plugin Activation class. This means that you will not get the full features of this page. Please contact that plugin developer and kindly ask him to upgrade the TGM Plugin Activation class', 'zn_framework' ).'</p>';
				echo '<p><a href="'. admin_url( 'themes.php?page=install-required-plugins' ).'">'.__( 'In the meantime, install plugins from here', 'zn_framework' ).'</a></p>';

				// Extra check for reflection class as it is not installed on all servers
				if( class_exists( 'ReflectionClass' ) ){
					$reflection_class = new ReflectionClass( TGM_Plugin_Activation::$instance );
					echo '<div class="zn-extensions-error-location">'.__( 'The file was loaded from this location :','zn_framework') . $reflection_class->getFileName() .'</div>';
				}

			echo '</div>';

			return false;
		}
		?>

		<ul class="zn-extensions-list cf">
		<?php


		foreach ( TGM_Plugin_Activation::$instance->plugins as $plugin ) : ?>

			<?php
			$button = '';
			if( TGM_Plugin_Activation::$instance->is_plugin_installed( $plugin['slug'] ) ){

				// TODO
				if( TGM_Plugin_Activation::$instance->does_plugin_have_update( $plugin['slug'] ) ){
					$status			= 'has_update';
					$status_message	= __( 'Needs update', 'zn_framework');
					$text			= __( 'Update plugin', 'zn_framework');
					$class			= 'zn-extension-button button button-primary';
					$action			= 'update_plugin';
					$url   = wp_nonce_url(
						add_query_arg(
							array(
								'page' => TGM_Plugin_Activation::$instance->menu,
								'plugin' => $plugin['slug'],
								'tgmpa-update' => 'update-plugin',
							),
							admin_url( TGM_Plugin_Activation::$instance->parent_slug )
						),
						'tgmpa-update',
						'tgmpa-nonce'
					);

				}
				// TODO
				elseif ( TGM_Plugin_Activation::$instance->is_plugin_active( $plugin['slug'] ) ) {
					$status			= 'active';
					$status_message	= __( 'Active', 'zn_framework');

					$text			= __( 'Disable plugin', 'zn_framework');
					$class			= 'zn-extension-button button button-primary';
					$action			= 'disable_plugin';
					$url   = false;
			

				} else  {
					$status			= 'inactive';
					$status_message	= __( 'Inctive', 'zn_framework');
					$text			= __( 'Enable plugin', 'zn_framework');
					$class			= 'zn-extension-button button button-primary';
					$action			= 'enable_plugin';
					$url   = wp_nonce_url(
						add_query_arg(
							array( 
								'page' => TGM_Plugin_Activation::$instance->menu, 
								'plugin' => $plugin['slug'],
								'tgmpa-activate' => 'activate-plugin', 
							),
							admin_url( TGM_Plugin_Activation::$instance->parent_slug )
						),
						'tgmpa-activate',
						'tgmpa-nonce'
					);

				}
			}
			// TODO
			else{
				$status			= 'not-installed';
				$status_message	= __( 'Not Installed', 'zn_framework');
				$text			= __( 'Install plugin', 'zn_framework');
				$class			= 'zn-extension-button button button-primary';
				$action			= 'install_plugin';
				$url   = wp_nonce_url( 
					add_query_arg( 
						array( 
							'page' => TGM_Plugin_Activation::$instance->menu,
							'plugin' => $plugin['slug'],
							'tgmpa-install' => 'install-plugin',
						),
						admin_url( TGM_Plugin_Activation::$instance->parent_slug )
					),
					'tgmpa-install',
					'tgmpa-nonce'
				);

			}
				$button = '<a class="button button-primary" href="'.$url.'">' . $text . '</a>';
			?>
			<li class="zn-extension <?php echo $status; ?>" id="<?php echo $plugin['slug']; ?>">
				<div class="zn-extension-inner">
					<img src="<?php echo $plugin['z_plugin_icon']; ?>" class="img">
					<div class="zn-extension-info">
						<h4 class="zn-extension-title"><?php echo $plugin['name']; ?></h4>
						<span class="zn-extension-status <?php echo $status; ?>"><?php echo $status_message; ?></span>
						<p class="zn-extension-desc"><?php echo $plugin['z_plugin_description']; ?></p>
						<p class="zn-extension-author"><cite>By <?php echo $plugin['z_plugin_author']; ?></cite></p>
					</div>
					<?php if( !empty( $url ) ) : ?>
					<div class="zn-extension-actions">
						<div class="">
							<?php echo $button; ?>
						</div>
					</div>
					<?php endif; ?>
				</div>
				
			</li>
		<?php endforeach; ?>
		</ul>
	</div>
	<?php
}