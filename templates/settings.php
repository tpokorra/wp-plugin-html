<div class="wrap">
    <h2>My Pricing</h2>
    <form method="post" action="options.php"> 
        <?php settings_fields('plugin_html-group'); ?>

        <?php do_settings_sections('plugin_html'); ?>

        <?php submit_button(); ?>
    </form>
</div>
