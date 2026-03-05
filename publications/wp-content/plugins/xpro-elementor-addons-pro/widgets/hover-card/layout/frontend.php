<?php
use Elementor\Icons_Manager;
use Elementor\Utils;

$link = $settings['link'];

$html_tag = $link['url'] ? 'a' : 'span';
$attr = '';

if ($link['url']) {
    $attr .= 'href="' . esc_url($link['url']) . '"';
    $attr .= $link['is_external'] ? ' target="_blank"' : '';
    $attr .= $link['nofollow'] ? ' rel="nofollow"' : '';
    $attr .= $link['custom_attributes'] ? ' ' . Utils::render_attribute($link['custom_attributes']) : '';
}

?>

<div class="xpro-hover-card-wrapper xpro-hover-card-item-<?php echo esc_attr($settings['layout']); ?>">
    <div class="xpro-hover-card-image">
        <?php echo (!empty($settings['image']['id'])) ? wp_get_attachment_image($settings['image']['id'], $settings['thumbnail_size']) : '<img src="' . esc_url($settings['image']['url']) . '">'; ?>
        <div class="xpro-hover-card-content-wrapper">
            <div class="xpro-hover-card-content">

                <?php if (in_array($settings['layout'], array('1', '2', '3', '14')) && $settings['counter']) : ?>
                    <span class="xpro-hover-card-counter"><?php echo esc_html($settings['counter']); ?></span>
                <?php endif; ?>

                <?php if ($settings['sub_title']) : ?>
                    <<?php echo esc_attr($settings['sub_title_tag']); ?> class="xpro-hover-card-sub-title"><?php echo esc_html($settings['sub_title']); ?></<?php echo esc_attr($settings['sub_title_tag']); ?>>
                <?php endif; ?>

                <?php if ($settings['title']) : ?>
                    <<?php echo esc_attr($settings['title_tag']); ?> class="xpro-hover-card-title"><?php echo esc_html($settings['title']); ?></<?php echo esc_attr($settings['title_tag']); ?>>
                <?php endif; ?>

                <?php if ($settings['description']) : ?>
                    <div class="xpro-hover-card-description"><?php echo wp_kses_post($settings['description']); ?></div>
                <?php endif; ?>

                <?php if ('yes' === $settings['show_button'] && $settings['button_title']) : ?>
                    <<?php echo esc_attr($html_tag); ?> class="xpro-elementor-button-w-hover-card <?php echo ('left' === $settings['icon_align']) ? 'xpro-align-icon-left' : 'xpro-align-icon-right'; ?>" <?php echo $attr; ?>>
                        <span class="xpro-elementor-button-inner">
                            <?php if ($settings['icon']['value']) : ?>
                                <span class="xpro-elementor-button-media"><?php Icons_Manager::render_icon($settings['icon'], array('aria-hidden' => 'true')); ?></span>
                            <?php endif; ?>
                            <span class="xpro-button-text"><?php echo esc_html($settings['button_title']); ?></span>
                        </span>
                    </<?php echo esc_attr($html_tag); ?>>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
