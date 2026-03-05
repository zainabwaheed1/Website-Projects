<?php
/**
 * The template for displaying the footer
 *
 * Contains the opening of the #site-footer div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package drake
 */
$drake_footerlink = "https://themeforest.net/user/wordpressriver/portfolio";
?>


<footer>
    <p class="copyright"><?php esc_html_e('Copyright &copy;  2022. Designed by' , 'drake'); ?> <a href="<?php echo esc_url($drake_footerlink); ?>"><?php esc_html_e('WordPressRiver' , 'drake'); ?></p>
</footer>
</main>

<!-- End Footer --> 
<?php wp_footer(); ?>

</body>
</html>


