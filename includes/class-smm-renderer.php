<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Renders the public maintenance page.
 */
class SMM_Renderer {

	/**
	 * Render the complete maintenance page.
	 *
	 * @return string
	 */
	public static function render() {

		$site_name = get_bloginfo( 'name' );

		$message = get_option(
			SMM_OPTION_MESSAGE,
			'We are performing some improvements and will be back shortly.'
		);

		$logo_url = self::get_site_logo();

		$site_name = esc_html( $site_name );

		$message = esc_html( $message );

		ob_start();
		?>
		<!DOCTYPE html>
		<html <?php language_attributes(); ?>>
		<head>

			<meta charset="<?php bloginfo( 'charset' ); ?>">

			<meta
				name="viewport"
				content="width=device-width, initial-scale=1"
			>

			<meta
				name="robots"
				content="noindex, nofollow"
			>

			<title>
				<?php
				echo esc_html(
					sprintf(
						/* translators: %s: site name */
						__( 'Maintenance — %s', 'simple-maintenance-mode' ),
						$site_name
					)
				);
				?>
			</title>

			<style>
				:root {
					color-scheme: light;
				}

				* {
					box-sizing: border-box;
				}

				html,
				body {
					margin: 0;
					padding: 0;
					width: 100%;
					min-height: 100%;
				}

				body {
					display: flex;
					align-items: center;
					justify-content: center;

					min-height: 100vh;
					padding: 32px 20px;

					background: #f6f7f9;
					color: #1d2327;

					font-family:
						-apple-system,
						BlinkMacSystemFont,
						"Segoe UI",
						Roboto,
						Helvetica,
						Arial,
						sans-serif;

					-webkit-font-smoothing: antialiased;
					text-rendering: optimizeLegibility;
				}

				.smm-container {
					width: 100%;
					max-width: 640px;
					margin: 0 auto;
				}

				.smm-card {
					padding: 48px 40px;

					background: #ffffff;

					border: 1px solid #dcdcde;
					border-radius: 16px;

					text-align: center;

					box-shadow:
						0 12px 40px rgba(0, 0, 0, 0.06);
				}

				.smm-logo {
					display: block;

					max-width: 220px;
					max-height: 100px;

					width: auto;
					height: auto;

					margin: 0 auto 32px;
				}

				.smm-icon {
					display: flex;

					align-items: center;
					justify-content: center;

					width: 72px;
					height: 72px;

					margin: 0 auto 28px;

					background: #f0f0f1;

					border-radius: 50%;

					font-size: 32px;

					line-height: 1;
				}

				.smm-heading {
					margin: 0 0 18px;

					color: #1d2327;

					font-size: clamp(
						28px,
						5vw,
						40px
					);

					font-weight: 700;

					line-height: 1.15;
					letter-spacing: -0.02em;
				}

				.smm-message {
					margin: 0;

					color: #50575e;

					font-size: 17px;
					line-height: 1.7;
				}

				.smm-thanks {
					margin: 12px 0 0;

					color: #646970;

					font-size: 15px;
					line-height: 1.6;
				}

				.smm-site-name {
					margin-top: 30px;

					color: #8c8f94;

					font-size: 13px;
					font-weight: 500;

					letter-spacing: 0.02em;
				}

				@media (max-width: 480px) {

					body {
						padding: 20px 16px;
					}

					.smm-card {
						padding: 36px 22px;
						border-radius: 12px;
					}

					.smm-logo {
						max-width: 180px;
						max-height: 80px;

						margin-bottom: 26px;
					}

					.smm-icon {
						width: 60px;
						height: 60px;

						margin-bottom: 22px;

						font-size: 26px;
					}

					.smm-heading {
						font-size: 30px;
					}

					.smm-message {
						font-size: 16px;
					}

				}
			</style>

		</head>

		<body>

			<main
				class="smm-container"
				role="main"
				aria-labelledby="smm-heading"
			>

				<section class="smm-card">

					<?php if ( $logo_url ) : ?>

						<img
							class="smm-logo"
							src="<?php echo esc_url( $logo_url ); ?>"
							alt="<?php echo esc_attr( $site_name ); ?>"
						>

					<?php else : ?>

						<div
							class="smm-icon"
							aria-hidden="true"
						>
							&#128736;
						</div>

					<?php endif; ?>


					<h1
						id="smm-heading"
						class="smm-heading"
					>
						<?php
						esc_html_e(
							'We’ll be back shortly',
							'simple-maintenance-mode'
						);
						?>
					</h1>


					<p class="smm-message">
						<?php echo $message; ?>
					</p>


					<p class="smm-thanks">
						<?php
						esc_html_e(
							'Thank you for your patience.',
							'simple-maintenance-mode'
						);
						?>
					</p>


					<?php if ( $site_name ) : ?>

						<div class="smm-site-name">
							<?php echo esc_html( $site_name ); ?>
						</div>

					<?php endif; ?>

				</section>

			</main>

		</body>
		</html>
		<?php

		return ob_get_clean();
	}


	/**
	 * Retrieve the site's WordPress Site Logo.
	 *
	 * @return string
	 */
	private static function get_site_logo() {

		$custom_logo_id = get_theme_mod( 'custom_logo' );

		if ( ! $custom_logo_id ) {
			return '';
		}

		$logo_url = wp_get_attachment_image_url(
			$custom_logo_id,
			'full'
		);

		return $logo_url ? $logo_url : '';
	}

}