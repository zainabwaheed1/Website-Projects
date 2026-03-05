<?php
/**
 * Nav menu item: MegaMenu settings popup.
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="xpro_modal modal xpro-menu-modal-loading" id="xpro_menu_settings_modal">

	<div class="xpro_modal-header">
		<div class="xpro_modal-title">
			<span class="title"><?php esc_html_e( 'Mega Menu', 'xpro-elementor-addons-pro' ); ?></span>
		</div>
		<div class="xpro_modal-close">
			<a href="#" rel="modal:close"><i class="eicon-close" aria-hidden="true" title="Close"></i></a>
		</div>
	</div>

	<div class="xpro_modal-body xpro-wid-con">
		<table class="form-table" role="presentation">
			<tbody>
			<tr>
				<th scope="row"><label for="blogname"><?php esc_html_e( 'Enable Mega Menu', 'xpro-elementor-addons-pro' ); ?></label></th>
				<td>
					<div class="xpro-dashboard-widgets__item-toggle xpro-toggle">
						<input id="xpro-menu-item-enable" type="checkbox" class="xpro-toggle__check xpro-widget" value="1">
						<b class="xpro-toggle__switch"></b>
						<b class="xpro-toggle__track"></b>
					</div>
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="blogname"><?php esc_html_e( 'Mega Menu Width', 'xpro-elementor-addons-pro' ); ?></label></th>
				<td id="xs_megamenu_width_type">
					<input type="radio" name="width_type" id="width_type_default" value="default_width" checked>
					<label for="width_type_default"><?php esc_html_e( 'Default Width', 'xpro-elementor-addons-pro' ); ?></label>
					<input type="radio" id="width_type_full" name="width_type" value="full_width">
					<label for="width_type_full"><?php esc_html_e( 'Full Width', 'xpro-elementor-addons-pro' ); ?></label>
					<input type="radio" id="width_type_custom" name="width_type" value="custom_width">
					<label for="width_type_custom"><?php esc_html_e( 'Custom Width', 'xpro-elementor-addons-pro' ); ?></label>
				</td>
			</tr>
			<tr class="menu-width-container">
				<th scope="row">
					<label for="xpro-menu-vertical-menu-width-field"><?php esc_html_e( 'Menu Width', 'xpro-elementor-addons-pro' ); ?></label>
				</th>
				<td>
					<input type="text" placeholder="<?php esc_html_e( '750px', 'xpro-elementor-addons-pro' ); ?>" id="xpro-menu-vertical-menu-width-field"/>
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="blogname"><?php esc_html_e( 'Mega Menu Position', 'xpro-elementor-addons-pro' ); ?></label></th>
				<td id="vertical_megamenu_position_type">
					<input type="radio" id="position_type_top" name="position_type" value="top_position">
					<label for="position_type_top"><?php esc_html_e( 'Default', 'xpro-elementor-addons-pro' ); ?></label>
					<input type="radio" name="position_type" id="position_type_relative" checked value="relative_position">
					<label for="position_type_relative"><?php esc_html_e( 'Relative', 'xpro-elementor-addons-pro' ); ?></label>
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="blogname"><?php esc_html_e( 'Mobile Submenu Content', 'xpro-elementor-addons-pro' ); ?></label></th>
				<td id="mobile_submenu_content_type">
					<input type="radio" id="content_type_builder_content" name="content_type" checked value="builder_content">
					<label for="content_type_builder_content"><?php esc_html_e( 'Builder Content' ); ?></label>
					<input type="radio" id="content_type_submenu_list" name="content_type" value="submenu_list">
					<label for="content_type_submenu_list"><?php esc_html_e( 'Submenu items' ); ?></label>
				</td>
			</tr>
			</tbody>
		</table>

		<div class="xpro_section_heading">
			<span><?php esc_html_e( 'Icon', 'xpro-elementor-addons-pro' ); ?></span>
			<span class="sep"></span>
		</div>

		<div class="xpro-flex">
			<table class="form-table" role="presentation">
				<tbody>
				<tr>
					<th scope="row">
						<label for="xpro-menu-icon-color-field"><?php esc_html_e( 'Select Icon', 'xpro-elementor-addons-pro' ); ?></label>
					</th>
					<td>
						<div class="aim-icon-picker-wrap" id="icon-picker-wrap">
							<ul class="icon-picker">
								<li id='select-icon' class="select-icon" title="Icon Library"><i class="fas fa-circle"></i>
								</li>
								<li class="icon-none" title="None"><i class="fas fa-ban"></i></li>
								<input type="hidden" name="icon_value" id="xpro-menu-icon-field" value="">
							</ul>
						</div>
					</td>
				</tr>
				</tbody>
			</table>
			<table class="form-table" role="presentation">
				<tbody>
				<tr>
					<th scope="row">
						<label for="xpro-menu-vertical-menu-width-field"><?php esc_html_e( 'Color', 'xpro-elementor-addons-pro' ); ?></label>
					</th>
					<td>
						<input type="text" value="#ff3d99" class="xpro-menu-wpcolor-picker" id="xpro-menu-icon-color-field"/>
					</td>
				</tr>
				</tbody>
			</table>
		</div>

		<div class="xpro_section_heading">
			<span><?php esc_html_e( 'Badge', 'xpro-elementor-addons-pro' ); ?></span>
			<span class="sep"></span>
		</div>

		<div class="xpro-flex">

			<table class="form-table" role="presentation">
				<tbody>

				<tr>
					<th scope="row"><label for="xpro-menu-badge-text-field"><?php esc_html_e( 'Text', 'xpro-elementor-addons-pro' ); ?></label></th>
					<td>
						<input type="text" class="badge-text" placeholder="<?php esc_html_e( 'Badge Text', 'xpro-elementor-addons-pro' ); ?>" id="xpro-menu-badge-text-field"/>
					</td>
				</tr>

				<tr>
					<th scope="row" class="w-170"><label for=""><?php esc_html_e( 'Border Radius', 'xpro-elementor-addons-pro' ); ?></label></th>
					<td>
						<ul class="xpro_control-dimensions">
							<li class="elementor-control-dimension">
								<input id="xpro-menu-badge-radius-topLeft" type="number" data-setting="topLeft" min="0">
								<label for="xpro-menu-badge-radius-topLeft" class="elementor-control-dimension-label"><?php esc_html_e( 'T Left', 'xpro-elementor-addons-pro' ); ?></label>
							</li>
							<li class="elementor-control-dimension">
								<input id="xpro-menu-badge-radius-topRight" type="number" data-setting="topRight" min="0">
								<label for="xpro-menu-badge-radius-topRight" class="elementor-control-dimension-label"><?php esc_html_e( 'T Right', 'xpro-elementor-addons-pro' ); ?></label>
							</li>
							<li class="elementor-control-dimension">
								<input id="xpro-menu-badge-radius-bottomLeft" type="number" data-setting="bottomLeft" min="0">
								<label for="xpro-menu-badge-radius-bottomLeft" class="elementor-control-dimension-label"><?php esc_html_e( 'B Left', 'xpro-elementor-addons-pro' ); ?></label>
							</li>
							<li class="elementor-control-dimension">
								<input id="xpro-menu-badge-radius-bottomRight" type="number" data-setting="bottomRight" min="0">
								<label for="xpro-menu-badge-radius-bottomRight" class="elementor-control-dimension-label"><?php esc_html_e( 'B Right', 'xpro-elementor-addons-pro' ); ?></label>
							</li>
						</ul>
					</td>
				</tr>

				</tbody>
			</table>

			<table class="form-table" role="presentation">
				<tbody>

				<tr>
					<th scope="row"><label for="xpro-menu-badge-color-field"><?php esc_html_e( 'Color', 'xpro-elementor-addons-pro' ); ?></label>
					</th>
					<td>
						<input type="text" class="xpro-menu-wpcolor-picker" value="#ffffff" id="xpro-menu-badge-color-field"/>
					</td>
				</tr>

				<tr>
					<th scope="row"><label for="xpro-menu-badge-background-field"><?php esc_html_e( 'Background', 'xpro-elementor-addons-pro' ); ?></label>
					</th>
					<td>
						<input type="text" class="xpro-menu-wpcolor-picker" value="#ff3d99" id="xpro-menu-badge-background-field"/>
					</td>
				</tr>
				</tbody>
			</table>
		</div>

		<div class="xpro_tab-content">
			<div role="tabpanel" class="xpro_tab-pane xpro_active" id="attr_content_tab">
				<?php if ( defined( 'ELEMENTOR_VERSION' ) ) : ?>
					<div id="xpro-menu-builder-warper"></div>
				<?php else : ?>
					<p class="no-elementor-notice">
						<?php esc_html_e( 'This plugin requires Elementor page builder to edt mega menu items content', 'xpro-elementor-addons-pro' ); ?>
					</p>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<div class="xpro_modal-footer">
		<div class="xpro_modal_save_edit_wrapper">
			<a id="xpro-menu-builder-trigger" class="xpro-menu-elementor-button xpro-btn elementor" href="#xpro-menu-builder-modal"><?php esc_html_e( 'Edit Mega Menu Content' ); ?></a>
		</div>
		<div class="xpro_modal_right_area_btns">
			<div class="xpro_modal_save_btn_wrapper">
				<input type="hidden" id="xpro-menu-modal-menu-id">
				<input type="hidden" id="xpro-menu-modal-menu-has-child">
				<span class='spinner'></span>
				<?php echo get_submit_button( esc_html__( 'Save & Close', 'xpro-elementor-addons-pro' ), 'xpro-menu-item-save aligncenter', '', false ); ?>
			</div>
			<a id="xpro-menu-close-trigger" href="#modal-close" class="xpro-menu-item-close xpro-btn" rel="modal:close"><?php esc_html_e( 'Discard', 'xpro-elementor-addons-pro' ); ?></a>
		</div>
	</div>

</div>

<div class="modal" id="xpro-menu-builder-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="xpro_modal-dialog xpro_modal-dialog-centered" role="document">
		<div class="xpro_modal-content">
			<div class="xpro_modal-body">
				<iframe id="xpro-menu-builder-iframe" src=""></iframe>
			</div>
		</div>
	</div>
</div>
