<div id="xpro-team-carousel-<?php echo esc_attr( $this->get_id() ); ?>" class="xpro-team-wrapper owl-carousel xpro-owl-theme xpro-owl-navigation-horizontal-<?php echo esc_attr( $settings['nav_layout'] ?? 'style-1' ); ?> xpro-owl-dots-horizontal-<?php echo esc_attr( $settings['dots_layout'] ?? 'style-1' ); ?>">

	<?php use Elementor\Icons_Manager;

	foreach ( $settings['item'] as $k => $item ) {
		?>

	<div class="xpro-team-layout-inner xpro-team-layout-<?php echo esc_attr( $settings['layout'] ); ?>">
		<?php
		$title_tag   = ( $item['title_link']['url'] ) ? 'a' : 'h2';
		$title_attr  = $item['title_link']['is_external'] ? ' target="_blank"' : '';
		$title_attr .= $item['title_link']['nofollow'] ? ' rel="nofollow"' : '';
		$title_attr .= $item['title_link']['url'] ? ' href="' . $item['title_link']['url'] . '"' : '';
		?>

		<?php if ( $item['designation'] && '2' === $settings['layout'] ) : ?>
			<h4 class="xpro-team-designation"><?php echo esc_attr( $item['designation'] ); ?></h4>
		<?php endif; ?>

		<?php if ( $item['image']['id'] || $item['image']['url'] ) { ?>
		<div class="xpro-team-image">
			<?php
			$image_markup = ( ! empty( $item['image']['id'] ) ) ? wp_get_attachment_image( $item['image']['id'], $settings['thumbnail_size'] ) : '';
			echo ! empty( $image_markup ) ? $image_markup : '<img src="' . esc_url( $item['image']['url'] ) . '">';
			?>
			<?php if ( '8' === $settings['layout'] || '9' === $settings['layout'] ) : ?>
			<div class="xpro-team-inner-content">
				<?php if ( $item['title'] ) : ?>
				<<?php echo esc_attr( $title_tag ); ?> <?php echo esc_html( $title_attr ); ?> class="xpro-team-title"><?php echo esc_attr( $item['title'] ); ?></<?php echo esc_attr( $title_tag ); ?>>
		<?php endif; ?>
				<?php if ( $item['designation'] ) : ?>
				<h4 class="xpro-team-designation"><?php echo esc_attr( $item['designation'] ); ?></h4>
			<?php endif; ?>
		</div>
	<?php endif; ?>
			<?php if ( ( '2' === $settings['layout'] || '3' === $settings['layout'] || '5' === $settings['layout'] || '8' === $settings['layout'] || '12' === $settings['layout'] || '13' === $settings['layout'] || '15' === $settings['layout'] ) ) { ?>
			<ul class="xpro-team-social-list">
				<?php
				if ( 'yes' === $item['social_icon_item_1'] && $item['social_icon_1'] ) {
					$tag_1   = $item['social_icon_link_1']['url'] ? 'a' : 'span';
					$attr_1  = $item['social_icon_link_1']['is_external'] ? ' target="_blank"' : '';
					$attr_1 .= $item['social_icon_link_1']['nofollow'] ? ' rel="nofollow"' : '';
					$attr_1 .= $item['social_icon_link_1']['url'] ? ' href="' . $item['social_icon_link_1']['url'] . '"' : '';
					?>
					<li>
					<<?php echo esc_attr( $tag_1 ); ?><?php echo $attr_1; ?> class="xpro-team-social-icon">
					<?php Icons_Manager::render_icon( $item['social_icon_1'], array( 'aria-hidden' => 'true' ) ); ?>
					</<?php echo esc_attr( $tag_1 ); ?>>
					<?php
				}

				if ( 'yes' === $item['social_icon_item_2'] && $item['social_icon_2'] ) {
					$tag_2   = $item['social_icon_link_2']['url'] ? 'a' : 'span';
					$attr_2  = $item['social_icon_link_2']['is_external'] ? ' target="_blank"' : '';
					$attr_2 .= $item['social_icon_link_2']['nofollow'] ? ' rel="nofollow"' : '';
					$attr_2 .= $item['social_icon_link_2']['url'] ? ' href="' . $item['social_icon_link_2']['url'] . '"' : '';
					?>
					<li>
					<<?php echo esc_attr( $tag_2 ); ?><?php echo $attr_2; ?> class="xpro-team-social-icon">
					<?php Icons_Manager::render_icon( $item['social_icon_2'], array( 'aria-hidden' => 'true' ) ); ?>
					</<?php echo esc_attr( $tag_2 ); ?>>
					<?php
				}

				if ( 'yes' === $item['social_icon_item_3'] && $item['social_icon_3'] ) {
					$tag_3   = $item['social_icon_link_3']['url'] ? 'a' : 'span';
					$attr_3  = $item['social_icon_link_3']['is_external'] ? ' target="_blank"' : '';
					$attr_3 .= $item['social_icon_link_3']['nofollow'] ? ' rel="nofollow"' : '';
					$attr_3 .= $item['social_icon_link_3']['url'] ? ' href="' . $item['social_icon_link_3']['url'] . '"' : '';
					?>
					<li>
					<<?php echo esc_attr( $tag_3 ); ?><?php echo $attr_3; ?> class="xpro-team-social-icon">
					<?php Icons_Manager::render_icon( $item['social_icon_3'], array( 'aria-hidden' => 'true' ) ); ?>
					</<?php echo esc_attr( $tag_3 ); ?>>
					<?php
				}

				if ( 'yes' === $item['social_icon_item_4'] && $item['social_icon_4'] ) {
					$tag_4   = $item['social_icon_link_4']['url'] ? 'a' : 'span';
					$attr_4  = $item['social_icon_link_4']['is_external'] ? ' target="_blank"' : '';
					$attr_4 .= $item['social_icon_link_4']['nofollow'] ? ' rel="nofollow"' : '';
					$attr_4 .= $item['social_icon_link_4']['url'] ? ' href="' . $item['social_icon_link_4']['url'] . '"' : '';
					?>
					<li>
					<<?php echo esc_attr( $tag_4 ); ?><?php echo $attr_4; ?> class="xpro-team-social-icon">
					<?php Icons_Manager::render_icon( $item['social_icon_4'], array( 'aria-hidden' => 'true' ) ); ?>
					</<?php echo esc_attr( $tag_4 ); ?>>
					<?php
				}

				?>
			</ul>
		<?php } ?>
	</div>
<?php } ?>

	<div class="xpro-team-content">
		<?php if ( '8' !== $settings['layout'] && '9' !== $settings['layout'] ) : ?>
			<?php if ( $item['title'] ) : ?>
		<<?php echo esc_attr( $title_tag ); ?> <?php xpro_elementor_kses( $title_attr ); ?>
		class="xpro-team-title"><?php echo esc_attr( $item['title'] ); ?></<?php echo esc_attr( $title_tag ); ?>>
<?php endif; ?>
			<?php if ( $item['designation'] && '2' !== $settings['layout'] ) : ?>
	<h4 class="xpro-team-designation"><?php echo esc_attr( $item['designation'] ); ?></h4>
			<?php endif; ?>
<?php endif; ?>
		<?php if ( $item['description'] ) : ?>
		<p class="xpro-team-description"><?php echo esc_attr( $item['description'] ); ?></p>
	<?php endif; ?>
		<?php if ( ( '2' !== $settings['layout'] && '3' !== $settings['layout'] && '5' !== $settings['layout'] && '8' !== $settings['layout'] && '12' !== $settings['layout'] && '13' !== $settings['layout'] && '15' !== $settings['layout'] ) ) { ?>
		<ul class="xpro-team-social-list">
			<?php

			if ( 'yes' === $item['social_icon_item_1'] && $item['social_icon_1'] ) {
				$tag_1   = $item['social_icon_link_1']['url'] ? 'a' : 'span';
				$attr_1  = $item['social_icon_link_1']['is_external'] ? ' target="_blank"' : '';
				$attr_1 .= $item['social_icon_link_1']['nofollow'] ? ' rel="nofollow"' : '';
				$attr_1 .= $item['social_icon_link_1']['url'] ? ' href="' . $item['social_icon_link_1']['url'] . '"' : '';
				?>
				<li>
				<<?php echo esc_attr( $tag_1 ); ?><?php echo $attr_1; ?> class="xpro-team-social-icon">
				<?php Icons_Manager::render_icon( $item['social_icon_1'], array( 'aria-hidden' => 'true' ) ); ?>
				</<?php echo esc_attr( $tag_1 ); ?>>
				</li>
				<?php
			}

			if ( 'yes' === $item['social_icon_item_2'] && $item['social_icon_2'] ) {
				$tag_2   = $item['social_icon_link_2']['url'] ? 'a' : 'span';
				$attr_2  = $item['social_icon_link_2']['is_external'] ? ' target="_blank"' : '';
				$attr_2 .= $item['social_icon_link_2']['nofollow'] ? ' rel="nofollow"' : '';
				$attr_2 .= $item['social_icon_link_2']['url'] ? ' href="' . $item['social_icon_link_2']['url'] . '"' : '';
				?>
				<li>
				<<?php echo esc_attr( $tag_2 ); ?><?php echo $attr_2; ?> class="xpro-team-social-icon">
				<?php Icons_Manager::render_icon( $item['social_icon_2'], array( 'aria-hidden' => 'true' ) ); ?>
				</<?php echo esc_attr( $tag_2 ); ?>>
				</li>
				<?php
			}

			if ( 'yes' === $item['social_icon_item_3'] && $item['social_icon_3'] ) {
				$tag_3   = $item['social_icon_link_3']['url'] ? 'a' : 'span';
				$attr_3  = $item['social_icon_link_3']['is_external'] ? ' target="_blank"' : '';
				$attr_3 .= $item['social_icon_link_3']['nofollow'] ? ' rel="nofollow"' : '';
				$attr_3 .= $item['social_icon_link_3']['url'] ? ' href="' . $item['social_icon_link_3']['url'] . '"' : '';
				?>
				<li>
				<<?php echo esc_attr( $tag_3 ); ?><?php echo $attr_3; ?> class="xpro-team-social-icon">
				<?php Icons_Manager::render_icon( $item['social_icon_3'], array( 'aria-hidden' => 'true' ) ); ?>
				</<?php echo esc_attr( $tag_3 ); ?>>
				</li>
				<?php
			}

			if ( 'yes' === $item['social_icon_item_4'] && $item['social_icon_4'] ) {
				$tag_4   = $item['social_icon_link_4']['url'] ? 'a' : 'span';
				$attr_4  = $item['social_icon_link_4']['is_external'] ? ' target="_blank"' : '';
				$attr_4 .= $item['social_icon_link_4']['nofollow'] ? ' rel="nofollow"' : '';
				$attr_4 .= $item['social_icon_link_4']['url'] ? ' href="' . $item['social_icon_link_4']['url'] . '"' : '';
				?>
				<li>
				<<?php echo esc_attr( $tag_4 ); ?><?php echo $attr_4; ?> class="xpro-team-social-icon">
				<?php Icons_Manager::render_icon( $item['social_icon_4'], array( 'aria-hidden' => 'true' ) ); ?>
				</<?php echo esc_attr( $tag_4 ); ?>>
				</li>
				<?php
			}

			?>
		</ul>
	<?php } ?>
</div>
</div>

<?php } ?>


</div>
