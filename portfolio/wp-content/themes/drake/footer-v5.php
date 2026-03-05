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

            </div>
        </div>
    </main>
    <?php wp_footer(); ?>

<?php if( class_exists( 'ReduxFrameworkPlugin' ) ) { 

global $drake_options; 
if($drake_options['attribution_on_off'] == 1) : ?>				
<a href="https://www.vecteezy.com/video/12658040-abstract-string-background">Abstract String Background Stock Videos by Vecteezy</a>
<!-- Don’t want to give attribution? Join Pro to get our entire library with generous usage rights, so you can use items with confidence. -->
				
<?php elseif($drake_options['attribution_on_off'] == 2) : ?>
						
<?php endif; } ?>
</body>
</html>