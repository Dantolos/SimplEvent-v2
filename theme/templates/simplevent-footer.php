<img src="<?php echo get_template_directory_uri() . '/theme/Wordmark-pos.svg'; ?>" alt="" height="50px" style="margin-top:30px; margin-bottom:10px; width:97.5%;" >
<h2></h2>
<style>
  /*--COLOR--*/
  .se-mc-bg { background-color: <?php echo esc_attr( get_option( 'main_color_picker' ) ) ; ?>; } /*maincolor*/
  .se-mc-txt { color: <?php echo esc_attr( get_option( 'main_color_picker' ) ); ?>; }
  .se-sc-bg { background-color: <?php echo esc_attr( get_option( 'second_color_picker' ) ); ?>; } /*dark*/
  .se-sc-txt { color: <?php echo esc_attr( get_option( 'second_color_picker' ) ); ?>; }
  .se-wc-bg { background-color: <?php echo esc_attr( get_option( 'light_color_picker' ) ); ?>; } /*light*/
  .se-wc-txt { color: <?php echo esc_attr( get_option( 'light_color_picker' ) ); ?>; }
</style>

<?php settings_errors(); ?>
<div class="se-settings-container">
     <form action="options.php" method="post" class="simplevent-general-form">
     <?php settings_fields( 'simplevent-footer-group' ); ?>
     <?php do_settings_sections('simplevent_footer'); ?>
     <?php submit_button(); ?>
     </form>
</div>

<!--VORSCHAU-->
