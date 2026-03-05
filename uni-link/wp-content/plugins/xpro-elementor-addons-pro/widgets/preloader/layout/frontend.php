<?php
use XproElementorAddons\Control\Xpro_Elementor_Widget_Area_Utils;
?>
<div class="xpro-preloader-wrapper xpro-preloader-layout-<?php echo esc_attr( $settings['preloader_layout'] ); ?>">
	<div class="xpro-preloader">
		<?php if ( '1' === $settings['preloader_layout'] ) : ?>
			<div class="xpro-preloader-box"></div>
		<?php endif; ?>

		<?php if ( '2' === $settings['preloader_layout'] ) : ?>
			<div class="xpro-preloader-box">
				<div class="dot dot-1"></div>
				<div class="dot dot-2"></div>
				<div class="dot dot-3"></div>
			</div>
			<svg xmlns="http://www.w3.org/2000/svg">
				<defs>
					<filter id="goo">
						<feGaussianBlur in="SourceGraphic" stdDeviation="10" result="blur"></feGaussianBlur>
						<feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 21 -7"></feColorMatrix>
					</filter>
				</defs>
			</svg>
		<?php endif; ?>

		<?php if ( '3' === $settings['preloader_layout'] ) : ?>
			<div class="xpro-preloader-box">
				<span></span>
				<span></span>
				<span></span>
				<span></span>
				<span></span>
				<span></span>
				<span></span>
				<span></span>
				<span></span>
				<span></span>
				<span></span>
				<span></span>
				<span></span>
				<span></span>
				<span></span>
			</div>
		<?php endif; ?>

		<?php if ( '4' === $settings['preloader_layout'] ) : ?>
			<div class="xpro-preloader-box">
				<div class="xpro-loader">
					<div class="xpro-loader-container">
						<div class="xpro-loader-ball-wrapper">
							<div class="xpro-loader-ball-holder">
								<div class="xpro-loader-ball"></div>
							</div>
							<div class="xpro-loader-ball-shadow"></div>
						</div>
						<div class="xpro-loader-ball-wrapper">
							<div class="xpro-loader-ball-holder">
								<div class="xpro-loader-ball"></div>
							</div>
							<div class="xpro-loader-ball-shadow"></div>
						</div>
						<div class="xpro-loader-ball-wrapper">
							<div class="xpro-loader-ball-holder">
								<div class="xpro-loader-ball"></div>
							</div>
							<div class="xpro-loader-ball-shadow"></div>
						</div>
					</div>
				</div>
			</div>
		<?php endif; ?>

		<?php if ( '5' === $settings['preloader_layout'] ) : ?>
			<div class="xpro-preloader-box">
				<div class="xpro-loader-spinner">
					<div class="blob blob-top"></div>
					<div class="blob blob-bottom"></div>
					<div class="blob blob-left"></div>
					<div class="blob blob-move"></div>
				</div>
			</div>
		<?php endif; ?>

		<?php if ( '6' === $settings['preloader_layout'] ) : ?>
			<div class="xpro-preloader-box">
				<svg viewBox="0 0 100 100">
					<defs>
						<filter id="shadow">
							<feDropShadow dx="0" dy="0" stdDeviation="0.5" flood-color="#dabd1d"></feDropShadow>
						</filter>
					</defs>
					<circle id="spinner" cx="50" cy="50" r="45"></circle>
				</svg>
			</div>
		<?php endif; ?>

		<?php if ( '7' === $settings['preloader_layout'] ) : ?>
			<div class="xpro-preloader-box">
				<div class="xpro-loader">
					<div class="xpro-loader-box"></div>
				</div>
			</div>
		<?php endif; ?>

		<?php if ( '8' === $settings['preloader_layout'] ) : ?>
			<div class="xpro-preloader-box">
				<div class="xpro-loader-spinner">
					<span class="xpro-preloader-circle-1"></span>
					<span class="xpro-preloader-circle-2"></span>
					<span class="xpro-preloader-circle-3"></span>
					<span class="xpro-preloader-circle-4"></span>
					<span class="xpro-preloader-circle-5"></span>
					<span class="xpro-preloader-circle-6"></span>
					<span class="xpro-preloader-circle-7"></span>
					<span class="xpro-preloader-circle-8"></span>
					<span class="xpro-preloader-circle-9"></span>
					<span class="xpro-preloader-circle-10"></span>
					<span class="xpro-preloader-circle-11"></span>
					<span class="xpro-preloader-circle-12"></span>
					<span class="xpro-preloader-circle-13"></span>
					<span class="xpro-preloader-circle-14"></span>
					<span class="xpro-preloader-circle-15"></span>
					<span class="xpro-preloader-circle-16"></span>
				</div>
			</div>
		<?php endif; ?>

		<?php if ( '9' === $settings['preloader_layout'] ) : ?>
			<div class="xpro-preloader-box">
				<div class="xpro-loader-spinner">
					<span></span>
					<span></span>
					<span></span>
					<span></span>
					<span></span>
					<span></span>
					<span></span>
					<span></span>
					<span></span>
				</div>
			</div>
		<?php endif; ?>

		<?php if ( '10' === $settings['preloader_layout'] ) : ?>
			<div class="xpro-preloader-box">
				<div class="xpro-loader-spinner spinner-1"></div>
				<div class="xpro-loader-spinner spinner-2"></div>
				<div class="xpro-loader-spinner spinner-3"></div>
			</div>
		<?php endif; ?>

		<?php if ( 'custom' === $settings['preloader_layout'] ) : ?>
			<div class="xpro-preloader-box">
				<?php
				if ( 'custom' === $settings['preloader_layout'] ) {
					Xpro_Elementor_Widget_Area_Utils::parse( $settings['preloader_content'], $this->get_id() );
				}
				?>
			</div>
		<?php endif; ?>
	</div>

	<?php if ( 'yes' === $settings['ink_show'] ) : ?>
		<div class="xpro-preloader-ink visible opening">
			<div class="xpro-preloader-ink-bg"></div>
		</div>
	<?php endif; ?>
</div>
