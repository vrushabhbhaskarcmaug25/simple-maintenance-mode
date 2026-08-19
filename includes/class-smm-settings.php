<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Handles the WordPress admin settings page.
 */
class SMM_Settings {

	/**
	 * Initialize settings.
	 *
	 * @return void
	 */
	public static function init() {

		add_action(
			'admin_menu',
			array( __CLASS__, 'register_menu' )
		);

		add_action(
			'admin_init',
			array( __CLASS__, 'register_settings' )
		);

		add_action(
			'admin_notices',
			array( __CLASS__, 'maintenance_notice' )
		);

	}


	/**
	 * Register the settings page.
	 *
	 * @return void
	 */
	public static function register_menu() {

		add_options_page(
			__( 'Maintenance Mode', 'simple-maintenance-mode' ),
			__( 'Maintenance Mode', 'simple-maintenance-mode' ),
			'manage_options',
			'simple-maintenance-mode',
			array( __CLASS__, 'render_page' )
		);

	}


	/**
	 * Register plugin settings.
	 *
	 * @return void
	 */
	public static function register_settings() {

		register_setting(
			'smm_settings_group',
			SMM_OPTION_ENABLED,
			array(
				'type'              => 'boolean',
				'sanitize_callback' => array(
					__CLASS__,
					'sanitize_enabled',
				),
				'default'           => false,
			)
		);


		register_setting(
			'smm_settings_group',
			SMM_OPTION_MESSAGE,
			array(
				'type'              => 'string',
				'sanitize_callback' => array(
					__CLASS__,
					'sanitize_message',
				),
				'default' =>
					'We are performing some improvements and will be back shortly.',
			)
		);

	}


	/**
	 * Sanitize the maintenance mode status.
	 *
	 * @param mixed $value Submitted value.
	 * @return int
	 */
	public static function sanitize_enabled( $value ) {

		return ! empty( $value ) ? 1 : 0;

	}


	/**
	 * Sanitize the visitor message.
	 *
	 * @param mixed $value Submitted message.
	 * @return string
	 */
	public static function sanitize_message( $value ) {

if ( ! is_string( $value ) ) {
		return __(
			'We are performing some improvements and will be back shortly.',
			'simple-maintenance-mode'
		);
	}

		$value = sanitize_textarea_field( $value );

		if ( '' === trim( $value ) ) {

			return __(
				'We are performing some improvements and will be back shortly.',
				'simple-maintenance-mode'
			);

		}

		return $value;

	}


	/**
	 * Render the settings page.
	 *
	 * @return void
	 */
	public static function render_page() {

		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		$enabled = (bool) get_option(
			SMM_OPTION_ENABLED,
			false
		);

		$message = get_option(
			SMM_OPTION_MESSAGE,
			__(
				'We are performing some improvements and will be back shortly.',
				'simple-maintenance-mode'
			)
		);

		?>

		<div class="wrap smm-settings-wrap">

			<h1>
				<?php
				esc_html_e(
					'Maintenance Mode',
					'simple-maintenance-mode'
				);
				?>
			</h1>


			<div class="smm-status-box">

				<p>
					<strong>
						<?php
						esc_html_e(
							'Current status:',
							'simple-maintenance-mode'
						);
						?>
					</strong>

					<?php if ( $enabled ) : ?>

						<span class="smm-status smm-status-on">
							<?php
							esc_html_e(
								'ON',
								'simple-maintenance-mode'
							);
							?>
						</span>

					<?php else : ?>

						<span class="smm-status smm-status-off">
							<?php
							esc_html_e(
								'OFF',
								'simple-maintenance-mode'
							);
							?>
						</span>

					<?php endif; ?>

				</p>

				<?php if ( $enabled ) : ?>

					<p>
						<?php
						esc_html_e(
							'Visitors are currently seeing the maintenance page. Administrators can still view the normal site.',
							'simple-maintenance-mode'
						);
						?>
					</p>

				<?php else : ?>

					<p>
						<?php
						esc_html_e(
							'Your website is currently available to visitors.',
							'simple-maintenance-mode'
						);
						?>
					</p>

				<?php endif; ?>

			</div>


			<form
				method="post"
				action="options.php"
			>

				<?php
				settings_fields( 'smm_settings_group' );
				?>


				<table
					class="form-table"
					role="presentation"
				>

					<tr>

						<th scope="row">

							<?php
							esc_html_e(
								'Maintenance mode',
								'simple-maintenance-mode'
							);
							?>

						</th>

						<td>

							<label>

								<input
									type="checkbox"
									name="<?php echo esc_attr( SMM_OPTION_ENABLED ); ?>"
									value="1"
									<?php checked( $enabled, true ); ?>
								>

								<?php
								esc_html_e(
									'Enable maintenance mode',
									'simple-maintenance-mode'
								);
								?>

							</label>

							<p class="description">

								<?php
								esc_html_e(
									'When enabled, visitors will see the maintenance page. Administrators can continue viewing the normal website.',
									'simple-maintenance-mode'
								);
								?>

							</p>

						</td>

					</tr>


					<tr>

						<th scope="row">

							<label for="smm_message">

								<?php
								esc_html_e(
									'Visitor message',
									'simple-maintenance-mode'
								);
								?>

							</label>

						</th>

						<td>

							<textarea
								id="smm_message"
								name="<?php echo esc_attr( SMM_OPTION_MESSAGE ); ?>"
								rows="5"
								class="large-text"
								maxlength="500"
							><?php echo esc_textarea( $message ); ?></textarea>

							<p class="description">

								<?php
								esc_html_e(
									'This message is displayed to visitors while maintenance mode is active.',
									'simple-maintenance-mode'
								);
								?>

							</p>

						</td>

					</tr>

				</table>


				<?php submit_button(); ?>

			</form>


			<?php if ( $enabled ) : ?>

				<hr>

				<p>

					<?php
					esc_html_e(
						'You can view the normal website because you have administrator access.',
						'simple-maintenance-mode'
					);
					?>

				</p>

			<?php endif; ?>

		</div>

		<?php

	}


	/**
	 * Display an administrator notice while maintenance
	 * mode is active.
	 *
	 * @return void
	 */
	public static function maintenance_notice() {

		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		if ( ! get_option( SMM_OPTION_ENABLED, false ) ) {
			return;
		}

		?>

		<div class="notice notice-warning is-dismissible">

			<p>

				<strong>
					<?php
					esc_html_e(
						'Maintenance Mode is active.',
						'simple-maintenance-mode'
					);
					?>
				</strong>

				<?php
				esc_html_e(
					'Visitors are currently seeing the maintenance page. Administrators can still view the normal website.',
					'simple-maintenance-mode'
				);
				?>

			</p>

		</div>

		<?php

	}

}

