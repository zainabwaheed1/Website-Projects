<?php
global $drake_options;
/**
 * Header file for the drake WordPress default theme.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package drake
 */

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    

    <link rel="icon" type="image/x-icon" href="<?php echo esc_url($drake_options['favicon-logo']['url']); ?>">



    <?php  wp_head(); ?>

</head>
<body class="home2-page">
<video class="body-overlay" muted autoplay loop>
        <source src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/video2.mp4'); ?>" type="video/mp4">
</video>
<?php if ($drake_options['preloader_on_off'] == 1) {
?>
    <div class="page-loader">
        <div class="bounceball"></div>
    </div>
<?php } ?>
    <span class="icon-menu">
        <span class="bar"></span>
        <span class="bar"></span>
    </span>
<?php if ($drake_options['color_Switch_on_off'] == 1) {
?>
    <div class="global-color">
        <span class="setting-toggle">
            <i class="las la-cog"></i>
        </span>
        <div class="inner">
            <div class="overlay"></div>
            <div class="global-color-option">
                <span class="close-settings">
                    <i class="las la-times"></i>
                </span>
                <h3>Configuration</h3>
                <div class="global-color-option-inner">
                    <p>Colors</p>
                    <div class="color-boxed">
                        <a href="#" class="clr-active" onclick="color1();"></a>
                        <a href="#" onclick="color2();"></a>
                        <a href="#" onclick="color3();"></a>
                        <a href="#" onclick="color4();"></a>
                        <a href="#" onclick="color5();"></a>
                        <a href="#" onclick="color6();"></a>
                        <a href="#" onclick="color7();"></a>
                        <a href="#" onclick="color8();"></a>
                    </div>

                    <p>THREE DIMENSIONAL SHAPES</p>
                    <ul class="themes">
                        <li><a href="https://wpriverthemes.com/drake/earth-lines-sphere/">Earth Lines Sphere</a></li>
                        <li><a href="https://wpriverthemes.com/drake/3d-abstract-ball/">3D Abstract Ball</a></li>
                        <li><a href="https://wpriverthemes.com/drake/water-waves/">Water Waves</a></li>
                        <li><a href="https://wpriverthemes.com/drake/liquids-wavy/">Liquids Wavy</a></li>
                        <li><a href="https://wpriverthemes.com/drake/">Solid Color</a></li>
                        <li><a href="https://wpriverthemes.com/drake/simple-strings/">Simple Strings</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
<?php } ?>


        <div class="responsive-sidebar-menu">
        <div class="overlay"></div>
        <div class="sidebar-menu-inner">
            <div class="menu-wrap">
                <p><?php echo esc_html($drake_options['menu_section_title']); ?></p>
                <ul class="dmenu scroll-nav-responsive d-flex">
                    <?php if(!empty($drake_options['mi_icon1'] )): ?>
                    <li>
                        <a class="scroll-to" href="<?php echo esc_html($drake_options['mi_link1']); ?>">
                            <i class="<?php echo esc_attr($drake_options['mi_icon1']); ?>"></i> <span><?php echo esc_html($drake_options['mi_text1']); ?></span>
                        </a>
                    </li><?php endif;?>
                    <?php if(!empty($drake_options['mi_icon2'] )): ?>
                    <li>
                        <a class="scroll-to" href="<?php echo esc_html($drake_options['mi_link2']); ?>">
                            <i class="<?php echo esc_attr($drake_options['mi_icon2']); ?>"></i> <span><?php echo esc_html($drake_options['mi_text2']); ?></span>
                        </a>
                    </li><?php endif;?>
                    <?php if(!empty($drake_options['mi_icon3'] )): ?>
                    <li>
                        <a class="scroll-to" href="<?php echo esc_html($drake_options['mi_link3']); ?>">
                            <i class="<?php echo esc_attr($drake_options['mi_icon3']); ?>"></i> <span><?php echo esc_html($drake_options['mi_text3']); ?></span>
                        </a>
                    </li><?php endif;?>
                    <?php if(!empty($drake_options['mi_icon4'] )): ?>
                    <li>
                        <a class="scroll-to" href="<?php echo esc_html($drake_options['mi_link4']); ?>">
                            <i class="<?php echo esc_attr($drake_options['mi_icon4']); ?>"></i> <span><?php echo esc_html($drake_options['mi_text4']); ?></span>
                        </a>
                    </li><?php endif;?>
                    <?php if(!empty($drake_options['mi_icon5'] )): ?>
                    <li>
                        <a class="scroll-to" href="<?php echo esc_html($drake_options['mi_link5']); ?>">
                            <i class="<?php echo esc_attr($drake_options['mi_icon5']); ?>"></i> <span><?php echo esc_html($drake_options['mi_text5']); ?></span>
                        </a>
                    </li><?php endif;?>
                    <?php if(!empty($drake_options['mi_icon6'] )): ?>
                    <li>
                        <a class="scroll-to" href="<?php echo esc_html($drake_options['mi_link6']); ?>">
                            <i class="<?php echo esc_attr($drake_options['mi_icon6']); ?>"></i> <span><?php echo esc_html($drake_options['mi_text6']); ?></span>
                        </a>
                    </li><?php endif;?>
                    <?php if(!empty($drake_options['mi_icon7'] )): ?>
                    <li>
                        <a class="scroll-to" href="<?php echo esc_html($drake_options['mi_link7']); ?>">
                            <i class="<?php echo esc_attr($drake_options['mi_icon7']); ?>"></i> <span><?php echo esc_html($drake_options['mi_text7']); ?></span>
                        </a>
                    </li><?php endif;?>
                    <?php if(!empty($drake_options['mi_icon8'] )): ?>
                    <li>
                        <a class="scroll-to" href="<?php echo esc_html($drake_options['mi_link8']); ?>">
                            <i class="<?php echo esc_attr($drake_options['mi_icon8']); ?>"></i> <span><?php echo esc_html($drake_options['mi_text8']); ?></span>
                        </a>
                    </li><?php endif;?> 
                </ul>
            </div>


            <div class="sidebar-social">
                <p><?php echo esc_html($drake_options['social_section_title']); ?></p>
                <ul class="social-links d-flex align-items-center">
                    <li>
                        <a href="<?php echo esc_html($drake_options['sl1']); ?>"><i class="<?php echo esc_attr($drake_options['sicon1']); ?>"></i></a>
                    </li>
                    <li>
                        <a href="<?php echo esc_html($drake_options['sl2']); ?>"><i class="<?php echo esc_attr($drake_options['sicon2']); ?>"></i></a>
                    </li>
                    <li>
                        <a href="<?php echo esc_html($drake_options['sl3']); ?>"><i class="<?php echo esc_attr($drake_options['sicon3']); ?>"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <ul class="dmenu scroll-nav d-flex">
        <?php if(!empty($drake_options['mi_icon1'] )): ?>
        <li>
            <a class="scroll-to" href="<?php echo esc_html($drake_options['mi_link1']); ?>">
                <span><?php echo esc_html($drake_options['mi_text1']); ?></span> <i class="<?php echo esc_attr($drake_options['mi_icon1']); ?>"></i>
            </a>
        </li><?php endif;?>
        <?php if(!empty($drake_options['mi_icon2'] )): ?>
        <li>
            <a class="scroll-to" href="<?php echo esc_html($drake_options['mi_link2']); ?>">
                <span><?php echo esc_html($drake_options['mi_text2']); ?></span> <i class="<?php echo esc_attr($drake_options['mi_icon2']); ?>"></i>
            </a>
        </li><?php endif;?>
        <?php if(!empty($drake_options['mi_icon3'] )): ?>
        <li>
            <a class="scroll-to" href="<?php echo esc_html($drake_options['mi_link3']); ?>">
                <span><?php echo esc_html($drake_options['mi_text3']); ?></span> <i class="<?php echo esc_attr($drake_options['mi_icon3']); ?>"></i>
            </a>
        </li><?php endif;?>
        <?php if(!empty($drake_options['mi_icon4'] )): ?>
        <li>
            <a class="scroll-to" href="<?php echo esc_html($drake_options['mi_link4']); ?>">
                <span><?php echo esc_html($drake_options['mi_text4']); ?></span> <i class="<?php echo esc_attr($drake_options['mi_icon4']); ?>"></i>
            </a>
        </li><?php endif;?>
        <?php if(!empty($drake_options['mi_icon5'] )): ?>
        <li>
            <a class="scroll-to" href="<?php echo esc_html($drake_options['mi_link5']); ?>">
                <span><?php echo esc_html($drake_options['mi_text5']); ?></span> <i class="<?php echo esc_attr($drake_options['mi_icon5']); ?>"></i>
            </a>
        </li><?php endif;?>
        <?php if(!empty($drake_options['mi_icon6'] )): ?>
        <li>
            <a class="scroll-to" href="<?php echo esc_html($drake_options['mi_link6']); ?>">
                <span><?php echo esc_html($drake_options['mi_text6']); ?></span> <i class="<?php echo esc_attr($drake_options['mi_icon6']); ?>"></i>
            </a>
        </li><?php endif;?>
        <?php if(!empty($drake_options['mi_icon7'] )): ?>
        <li>
            <a class="scroll-to" href="<?php echo esc_html($drake_options['mi_link7']); ?>">
                <span><?php echo esc_html($drake_options['mi_text7']); ?></span> <i class="<?php echo esc_attr($drake_options['mi_icon7']); ?>"></i>
            </a>
        </li><?php endif;?>
        <?php if(!empty($drake_options['mi_icon8'] )): ?>
        <li>
            <a class="scroll-to" href="<?php echo esc_html($drake_options['mi_link8']); ?>">
                <span><?php echo esc_html($drake_options['mi_text8']); ?></span> <i class="<?php echo esc_attr($drake_options['mi_icon8']); ?>"></i>
            </a>
        </li><?php endif;?>
    </ul>

    <div class="left-sidebar">
        <div class="sidebar-header d-flex align-items-center justify-content-between">
            <img src="<?php echo esc_url($drake_options['main-logo']['url']); ?>" alt="Logo">
            <span class="designation"><?php echo esc_html($drake_options['designation']); ?></span>
        </div>
        <img class="me" src="<?php echo esc_url($drake_options['profile-picture']['url']); ?>" alt="Me">
        <h3 class="email"><?php echo esc_html($drake_options['email']); ?></h3>
        <h3 class="address"><?php echo esc_html($drake_options['basedin']); ?></h3>
        <p class="copyright">&copy; <?php echo esc_html($drake_options['copyright']); ?></p>
        <ul class="social-profile d-flex align-items-center flex-wrap justify-content-center">
    <?php if(!empty($drake_options['sicon1'] )): ?>
    <li>

    <?php if ($drake_options['link_Switch_on_off1'] == 1) {
    ?>
        <a  target="_blank" href="<?php echo esc_html($drake_options['sl1']); ?>"><i class="<?php echo esc_attr($drake_options['sicon1']); ?>"></i></a>
    <?php } ?>

    <?php if ($drake_options['link_Switch_on_off1'] == 2) {
    ?>
        <a href="<?php echo esc_html($drake_options['sl1']); ?>"><i class="<?php echo esc_attr($drake_options['sicon1']); ?>"></i></a>
    <?php } ?>


    </li><?php endif;?>

            <?php if(!empty($drake_options['sicon2'] )): ?>
            <li>
                <?php if ($drake_options['link_Switch_on_off2'] == 1) {
    ?>
        <a  target="_blank" href="<?php echo esc_html($drake_options['sl2']); ?>"><i class="<?php echo esc_attr($drake_options['sicon2']); ?>"></i></a>
    <?php } ?>

    <?php if ($drake_options['link_Switch_on_off2'] == 2) {
    ?>
        <a href="<?php echo esc_html($drake_options['sl2']); ?>"><i class="<?php echo esc_attr($drake_options['sicon2']); ?>"></i></a>
    <?php } ?>
            </li><?php endif;?>
            <?php if(!empty($drake_options['sicon3'] )): ?>
            <li>
                <?php if ($drake_options['link_Switch_on_off3'] == 1) {
    ?>
        <a  target="_blank" href="<?php echo esc_html($drake_options['sl3']); ?>"><i class="<?php echo esc_attr($drake_options['sicon3']); ?>"></i></a>
    <?php } ?>

    <?php if ($drake_options['link_Switch_on_off3'] == 2) {
    ?>
        <a href="<?php echo esc_html($drake_options['sl3']); ?>"><i class="<?php echo esc_attr($drake_options['sicon3']); ?>"></i></a>
    <?php } ?>
            </li><?php endif;?>
            <?php if(!empty($drake_options['sicon4'] )): ?>
            <li>
                <?php if ($drake_options['link_Switch_on_off4'] == 1) {
    ?>
        <a  target="_blank" href="<?php echo esc_html($drake_options['sl4']); ?>"><i class="<?php echo esc_attr($drake_options['sicon4']); ?>"></i></a>
    <?php } ?>

    <?php if ($drake_options['link_Switch_on_off4'] == 2) {
    ?>
        <a href="<?php echo esc_html($drake_options['sl4']); ?>"><i class="<?php echo esc_attr($drake_options['sicon4']); ?>"></i></a>
    <?php } ?>
            </li><?php endif;?>
        </ul>
        <a href="<?php echo esc_html($drake_options['hiremelink']); ?>" class="theme-btn">
            <i class="<?php echo esc_attr($drake_options['hire_icon']); ?>"></i> <?php echo esc_html($drake_options['hireme']); ?>
        </a>
    </div>

    <main class="drake-main">
        <div id="smooth-wrapper">
            <div id="smooth-content">

                <div class="left-sidebar">
                    <div class="sidebar-header d-flex align-items-center justify-content-between">
                        <img src="<?php echo esc_url($drake_options['main-logo']['url']); ?>" alt="Logo">
                        <span class="designation"><?php echo esc_html($drake_options['designation']); ?></span>
                    </div>
                    <img class="me" src="<?php echo esc_url($drake_options['profile-picture']['url']); ?>" alt="Me">
        <h3 class="email"><?php echo esc_html($drake_options['email']); ?></h3>
        <h3 class="address"><?php echo esc_html($drake_options['basedin']); ?></h3>
        <p class="copyright">&copy; <?php echo esc_html($drake_options['copyright']); ?></p>
                    <ul class="social-profile d-flex align-items-center flex-wrap justify-content-center">
            <?php if(!empty($drake_options['sicon1'] )): ?>
            <li>
                <a href="<?php echo esc_html($drake_options['sl1']); ?>"><i class="<?php echo esc_attr($drake_options['sicon1']); ?>"></i></a>
            </li><?php endif;?>
            <?php if(!empty($drake_options['sicon2'] )): ?>
            <li>
                <a href="<?php echo esc_html($drake_options['sl2']); ?>"><i class="<?php echo esc_attr($drake_options['sicon2']); ?>"></i></a>
            </li><?php endif;?>
            <?php if(!empty($drake_options['sicon3'] )): ?>
            <li>
                <a href="<?php echo esc_html($drake_options['sl3']); ?>"><i class="<?php echo esc_attr($drake_options['sicon3']); ?>"></i></a>
            </li><?php endif;?>
            <?php if(!empty($drake_options['sicon4'] )): ?>
            <li>
                <a href="<?php echo esc_html($drake_options['sl4']); ?>"><i class="<?php echo esc_attr($drake_options['sicon4']); ?>"></i></a>
            </li><?php endif;?>
                    </ul>
                    <a href="<?php echo esc_html($drake_options['hiremelink']); ?>" class="theme-btn">
                        <i class="<?php echo esc_attr($drake_options['hire_icon']); ?>"></i> <?php echo esc_html($drake_options['hireme']); ?>
                    </a>
                </div>