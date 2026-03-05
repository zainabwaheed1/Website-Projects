<?php

use Elementor\Icons_Manager;
use XproElementorAddons\Modules\Swatches\Swatches;

$uid = uniqid();
?>

<div class="xpro-product-filter-wrapper">
	<div class="xpro-product-filter-inner">
		<form action="" method="get" class="xpro-woo-filter-form">
			<?php foreach ( $settings['product_filter_list'] as $item ) : ?>
				<div class="xpro-filter-single">
					<?php
					if ( 'price' === $item['filter_view'] ) :
						$price_min = $item['filter_price_min'] ? $item['filter_price_min'] : 0;
						$price_max = $item['filter_price_max'] ? $item['filter_price_max'] : 1000;

						$default_range = apply_filters( 'xpro_filter_price_range', array( $price_min, $price_max ) );

						$value_range = $default_range;

						if ( isset( $_GET['min-price'] ) && $_GET['max-price'] ) {
							$value_range = array( intval( $_GET['min-price'] ), intval( $_GET['max-price'] ) );
						}

						?>
						<!-- Price Range -->
						<div class="xpro-filter xpro-filter-price dot-type-<?php echo esc_attr( $item['range_slider_dot_type'] ); ?>" data-default-range="<?php echo wp_json_encode( $default_range ); ?>" data-value-range="<?php echo wp_json_encode( $value_range ); ?>" data-exchange-rate="<?php echo apply_filters( 'xpro_currency_exchange_rate', 0 ); ?>">
							<?php if ( $item['filter_title'] ) : ?>
								<h3 class="xpro-product-filter-title"><?php echo esc_html( $item['filter_title'] ); ?></h3>
							<?php endif; ?>
							<div class="xpro-filter-price-slider"></div>
							<div class="xpro-filter-price-range">
								<input type="range" name="min-price" value="<?php echo esc_attr( $value_range[0] ); ?>" min="<?php echo esc_attr( $default_range[0] ); ?>" max="<?php echo esc_attr( $default_range[1] ); ?>"/>
								<input type="range" name="max-price" value="<?php echo esc_attr( $value_range[1] ); ?>" min="0" max="<?php echo esc_attr( $default_range[1] ); ?>"/>
							</div>
							<div class="xpro-filter-price-btn">
								<p class="xpro-filter-price-result" data-sign="<?php echo get_woocommerce_currency_symbol(); ?>">
									<?php
									$format = apply_filters( 'xpro_product_filter_currency_symbol_format', '%1$s%2$s' );
									echo sprintf( $format, get_woocommerce_currency_symbol(), esc_html( $value_range[0] ) ) . ' - ' . sprintf( $format, get_woocommerce_currency_symbol(), esc_html( $value_range[1] ) );
									?>
								</p>
								<button type="button" class="xpro-woo-filter-reset"><?php echo __( 'Reset', 'xpro-elementor-addons-pro' ); ?></button>
							</div>
						</div>
					<?php endif; ?>

					<?php if ( 'rating' === $item['filter_view'] ) : ?>
						<!-- Product Rating -->
						<div class="xpro-filter xpro-filter-rating">
							<?php if ( $item['filter_title'] ) : ?>
								<h3 class="xpro-product-filter-title"><?php echo esc_html( $item['filter_title'] ); ?></h3>
							<?php endif; ?>
							<ul class="xpro-filter-ratting-list" data-filter-key="rating">
								<?php

								$active_rating = array();
								if ( isset( $_GET['rating'] ) ) {
									$active_rating = sanitize_text_field( $_GET['rating'] );
									$active_rating = explode( ',', urldecode_deep( $active_rating ) );
								}

								for ( $i = 5; $i >= 1; $i -- ) :
									?>
									<li class="xpro-rating-label-trigger<?php echo ( in_array( $i, $active_rating ) ? ' active' : '' ); ?>" data-filter-value="<?php echo esc_attr( $i ); ?>">
										<span class="xpro-checkbox-icon">
											<?php Icons_Manager::render_icon( $item['checkbox_icon'], array( 'aria-hidden' => 'true' ) ); ?>
										</span>
										<span class="xpro-filter-rating-stars">
											<?php
											for ( $star = 1; $star <= 5; $star ++ ) :
												Icons_Manager::render_icon( $item['star_icon'], array( 'aria-hidden' => 'true' ) );
											endfor;
											?>
										</span>
									</li>
								<?php endfor; ?>
							</ul>
							<input class="xpro-filter-input-fields" value="<?php echo implode( ',', $active_rating ); ?>" type="hidden" name="rating">
						</div>
					<?php endif; ?>

					<?php
					if ( 'category' === $item['filter_view'] ) :
						$hierarchical = isset( $item['hierarchical'] ) ? $item['hierarchical'] : true;

						$categories = get_terms(
							array(
								'taxonomy'   => 'product_cat',
								'orderby'    => $item['hide_empty'],
								'order'      => 'asc',
								'hide_empty' => $item['hide_empty'],
								'exclude'    => $item['except_exclude'],
							)
						);

						?>
						<div class="xpro-filter xpro-filter-category">
						<!-- Product Category -->
						<?php if ( $item['filter_title'] ) : ?>
							<h3 class="xpro-product-filter-title"><?php echo esc_html( $item['filter_title'] ); ?></h3>
						<?php endif; ?>

						<ul class="xpro-filter-category-list" data-filter-key="category">
							<?php
							$active_category = array();
							if ( isset( $_GET['category'] ) ) {
								$active_category = sanitize_text_field( $_GET['category'] );
								$active_category = explode( ',', urldecode_deep( $active_category ) );
							}
							foreach ( $categories as $category ) :
								?>
								<li data-filter-value="<?php echo esc_attr( $category->slug ); ?>" class="<?php echo ( ! empty( get_term_children( $category->term_id, 'product_cat' ) ) ) ? 'xpro-filter-category-has-child' : 'xpro-filter-category-parent'; ?><?php echo ( in_array( $category->slug, $active_category ) ? ' active' : '' ); ?>">
									<div class="xpro-filter-category-item">
										<span class="xpro-checkbox-icon">
												<?php Icons_Manager::render_icon( $item['checkbox_icon'], array( 'aria-hidden' => 'true' ) ); ?>
											</span>
										<?php echo esc_html( $category->name ); ?>
									</div>

									<?php
									if ( 'yes' !== $item['show_parent_only'] && ! empty( get_term_children( $category->term_id, 'product_cat' ) ) && 'yes' === $hierarchical ) :

										$sub_categories = get_terms(
											array(
												'taxonomy' => 'product_cat',
												'orderby'  => 'names',
												'order'    => 'asc',
												'hide_empty' => $item['hide_empty'],
												'exclude'  => $item['except_exclude'],
												'parent'   => $category->term_id,
											)
										);
										?>
										<ul class="xpro-filter-category-subcategories" data-filter-key="subcategory">
											<?php
											$active_subcategory = array();
											if ( isset( $_GET['subcategory'] ) ) {
												$active_subcategory = sanitize_text_field( $_GET['subcategory'] );
												$active_subcategory = explode( ',', urldecode_deep( $active_subcategory ) );
											}
											foreach ( $sub_categories as $child_categories ) :
												?>
												<li data-filter-value="<?php echo esc_attr( $child_categories->slug ); ?>" class="xpro-filter-category-child<?php echo ( in_array( $child_categories->slug, $active_subcategory ) ? ' active' : '' ); ?>">
													<div class="xpro-filter-subcategory-item">
														<span class="xpro-checkbox-icon">
																<?php Icons_Manager::render_icon( $item['checkbox_icon'], array( 'aria-hidden' => 'true' ) ); ?>
															</span>
														<?php echo esc_html( $child_categories->name ); ?>
													</div>
												</li>
											<?php endforeach; ?>
										</ul>
										<input class="xpro-filter-input-fields" value="<?php echo implode( ',', $active_subcategory ); ?>" type="hidden" name="subcategory">
									<?php endif; ?>
								</li>
							<?php endforeach; ?>
						</ul>
							<input class="xpro-filter-input-fields" value="<?php echo implode( ',', $active_category ); ?>" type="hidden" name="category">
						</div>
					<?php endif; ?>

					<?php
					if ( 'stock' === $item['filter_view'] ) :
						$stock_status = wc_get_product_stock_status_options();
						if ( ! empty( $stock_status ) ) {
							?>
							<!-- Product Stock -->
							<div class="xpro-filter xpro-filter-stock">
							<?php if ( $item['filter_title'] ) : ?>
								<h3 class="xpro-product-filter-title"><?php echo esc_html( $item['filter_title'] ); ?></h3>
							<?php endif; ?>

						<ul class="xpro-filter-stock-list" data-filter-key="stock">
							<?php

							$active_stock = array();
							if ( isset( $_GET['stock'] ) ) {
								$active_stock = sanitize_text_field( $_GET['stock'] );
								$active_stock = explode( ',', urldecode_deep( $active_stock ) );
							}
							foreach ( $stock_status as $key => $stock ) :
								$id   = 'xs-filter-stock-' . $key;
								$name = 'xpro_filter_stock';
								?>
								<li data-filter-value="<?php echo esc_attr( $key ); ?>" class="xpro-filter-input-group<?php echo ( in_array( $key, $active_stock ) ? ' active' : '' ); ?>">
									<span class="xpro-checkbox-icon">
										<?php Icons_Manager::render_icon( $item['checkbox_icon'], array( 'aria-hidden' => 'true' ) ); ?>
									</span>
									<?php echo esc_html( $stock ); ?>
								</li>
							<?php endforeach; ?>
						</ul>
                            <input class="xpro-filter-input-fields" value="<?php echo implode( ',', $active_stock ); ?>" type="hidden" name="stock">
						</div>
						<?php } ?>
					<?php endif; ?>

					<?php
					if ( 'on-sale' === $item['filter_view'] ) :
						$onsale = array(
							'on-sale'       => __( 'On Sale', 'xpro-elementor-addons-pro' ),
							'regular-price' => __( 'Regular Price', 'xpro-elementor-addons-pro' ),
						);
						if ( ! empty( $onsale ) ) {
							?>
							<!-- Product On Sale -->
							<div class="xpro-filter xpro-filter-stock">
							<?php if ( $item['filter_title'] ) : ?>
								<h3 class="xpro-product-filter-title"><?php echo esc_html( $item['filter_title'] ); ?></h3>
							<?php endif; ?>

							<ul class="xpro-filter-stock-list" data-filter-key="sale">
							  <?php

								$active_sale = array();
								if ( isset( $_GET['sale'] ) ) {
									$active_sale = sanitize_text_field( $_GET['sale'] );
									$active_sale = explode( ',', urldecode_deep( $active_sale ) );
								}

								foreach ( $onsale as $key => $value ) :
									$id = 'xs-filter-onsale';
									?>
								<li data-filter-value="<?php echo esc_attr( $key ); ?>" class="xpro-filter-input-group<?php echo ( in_array( $key, $active_sale ) ? ' active' : '' ); ?>">
									<span class="xpro-checkbox-icon">
										<?php Icons_Manager::render_icon( $item['checkbox_icon'], array( 'aria-hidden' => 'true' ) ); ?>
									</span>
									<?php echo esc_html( $value ); ?>
								</li>
							<?php endforeach; ?>
							</ul>
                                <input class="xpro-filter-input-fields" value="<?php echo implode( ',', $active_sale ); ?>" type="hidden" name="sale">
							</div>
						<?php } ?>
					<?php endif; ?>

					<?php
					if ( 'attribute' === $item['filter_view'] ) :

						$taxonomies = wc_get_attribute_taxonomies();

						if ( isset( $taxonomies[ 'id:' . $item['attribute'] ]->attribute_type ) ) {

							$taxonomy   = wc_attribute_taxonomy_name( $taxonomies[ 'id:' . $item['attribute'] ]->attribute_name );
							$variations = get_terms( $taxonomy, 'orderby=name&hide_empty=0' );

							?>
						  <!-- Product Attributes -->
						  <div class="xpro-filter xpro-filter-attributes">
							<?php if ( $item['filter_title'] ) : ?>
								<h3 class="xpro-product-filter-title"><?php echo esc_html( $item['filter_title'] ); ?></h3>
							<?php endif; ?>

						  <ul class="xpro-filter-attribute-list" data-filter-key="<?php echo esc_attr( $taxonomy ); ?>">
							<?php

							$active_attr = array();
							if ( isset( $_GET[ $taxonomy ] ) ) {
								$active_attr = sanitize_text_field( $_GET[ $taxonomy ] );
								$active_attr = explode( ',', urldecode_deep( $active_attr ) );
							}

							if ( 'select' === $taxonomies[ 'id:' . $item['attribute'] ]->attribute_type ) :

								foreach ( $variations as $variation ) :

									?>
								<li data-filter-value="<?php echo esc_attr( $variation->slug ); ?>" class="xpro-filter-input-group<?php echo ( in_array( $variation->slug, $active_attr ) ? ' active' : '' ); ?>">
									 <span class="xpro-checkbox-icon">
										<?php Icons_Manager::render_icon( $item['checkbox_icon'], array( 'aria-hidden' => 'true' ) ); ?>
									</span>
									<?php echo esc_html( $variation->name ); ?>
								</li>
								<?php endforeach; ?>
								<?php
								endif;

							if ( 'xpro_color' === $taxonomies[ 'id:' . $item['attribute'] ]->attribute_type ) :

								$options = $this->get_custom_terms( Swatches::PA_COLOR, $taxonomies[ 'id:' . $item['attribute'] ]->attribute_name );

								if ( ! empty( $options ) ) {

									foreach ( $options as $option ) :
										?>
										  <li data-filter-value="<?php echo esc_attr( $option->slug ); ?>" class="xpro-filter-input-group<?php echo ( in_array( $option->slug, $active_attr ) ? ' active' : '' ); ?>">
										<span class="xpro-checkbox-icon">
											<?php Icons_Manager::render_icon( $item['checkbox_icon'], array( 'aria-hidden' => 'true' ) ); ?>
										</span>
											  <span class="xpro-color-filter-dot" style="background:<?php echo strpos( $option->color, '#' ) === 0 ? '' : '#'; ?><?php echo esc_attr( $option->color ); ?>"></span>
											<?php echo esc_html( $option->name ); ?>
										  </li>
									  <?php endforeach; ?>

								<?php } ?>

								<?php
							  endif;

							if ( 'xpro_image' === $taxonomies[ 'id:' . $item['attribute'] ]->attribute_type ) :

								$options = $this->get_custom_terms( Swatches::PA_IMAGE, $taxonomies[ 'id:' . $item['attribute'] ]->attribute_name );

								if ( ! empty( $options ) ) {

									foreach ( $options as $option ) :
										?>
										<li data-filter-value="<?php echo esc_attr( $option->slug ); ?>" class="xpro-filter-input-group<?php echo ( in_array( $option->slug, $active_attr ) ? ' active' : '' ); ?>">
										<span class="xpro-checkbox-icon">
												<?php Icons_Manager::render_icon( $item['checkbox_icon'], array( 'aria-hidden' => 'true' ) ); ?>
											</span>
													<img src="<?php echo wp_get_attachment_image_url( $option->image, 'thumbnail' ); ?>" alt="attributes">
												</li>
											<?php endforeach; ?>
								<?php } ?>

								<?php
							endif;

							if ( 'xpro_label' === $taxonomies[ 'id:' . $item['attribute'] ]->attribute_type ) :

								$options = $this->get_custom_terms( Swatches::PA_LABEL, $taxonomies[ 'id:' . $item['attribute'] ]->attribute_name );

								if ( ! empty( $options ) ) {

									foreach ( $options as $option ) :
										?>
										<li data-filter-value="<?php echo esc_attr( $option->slug ); ?>" class="xpro-filter-input-group<?php echo ( in_array( $option->slug, $active_attr ) ? ' active' : '' ); ?>">
											<span class="xpro-checkbox-icon">
												<?php Icons_Manager::render_icon( $item['checkbox_icon'], array( 'aria-hidden' => 'true' ) ); ?>
											</span>
											<?php echo esc_html( $option->label ? $option->label : $option->name ); ?>
										</li>
									<?php endforeach; ?>
								<?php } ?>

								<?php
							endif;

							?>
							</ul>
                              <input class="xpro-filter-input-fields" value="<?php echo implode( ',', $active_attr ); ?>" type="hidden" name="<?php echo esc_attr( $taxonomy ); ?>">
						  </div>
						<?php } ?>
					<?php endif; ?>
				</div>
			<?php endforeach; ?>
		</form>
	</div>
</div>