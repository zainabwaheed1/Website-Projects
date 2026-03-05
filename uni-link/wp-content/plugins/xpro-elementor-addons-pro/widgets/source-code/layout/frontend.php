<?php if ( ! empty( $settings['source_code'] ) ) : ?>
	<div class="xpro-source-code-wrapper">
		<div class="xpro-source-code <?php echo esc_attr( $settings['source_code_theme'] ); ?>" data-language-type="<?php echo esc_attr( $settings['language_type'] ); ?>" data-after-copy="<?php echo esc_attr( $settings['after_copy_btn_text'] ); ?>">
			<?php if ( 'yes' === $settings['copy_btn_text_show'] && $settings['copy_btn_text'] ) : ?>
				<button class="xpro-source-code-btn"><?php echo esc_html( $settings['copy_btn_text'] ); ?></button>
			<?php endif; ?>
			<pre>
				<code class="language-<?php echo esc_attr( $settings['language_type'] ); ?>">
					<?php echo esc_html( $settings['source_code'] ); ?>
				</code>
			</pre>
		</div>
	</div>
<?php endif; ?>
