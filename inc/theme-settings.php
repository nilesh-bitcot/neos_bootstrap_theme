<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Neos_Theme
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */

// create custom plugin settings menu
add_action('admin_menu', 'neos_theme_option_menu');
add_action( 'admin_init', 'register_neos_theme_option_settings' );

function neos_theme_option_menu() {

	/*add_menu_page('Neos Theme settings', 'Neos Theme', 'administrator', 'neos-theme-page', 'neos_theme_option_settings_page' , get_template_directory_uri().'/images/theme_icon.png' );*/

    add_options_page('Neos Theme settings', 'Neos Theme', 'manage_options', 'neos-theme-page', 'neos_theme_option_settings_page');
	

    /*add_action( 'admin_init', 'stp_api_settings_init' );*/
    
}

function register_neos_theme_option_settings() {
    register_setting("neosThemeSetting", "nbt_set_nav_align");
    add_settings_section(
        "nav_section_setting",
        __( 'Navigation Position','neos_theme' ),
        "stp_api_settings_section_callback",
        "neosThemeSetting"
    );
    
    add_settings_field(
        "nbt_nav_align_to",
        __( 'Where you want to align navigation menu items', 'neos_theme' ),
        "main_nav_align_select_display",
        "neosThemeSetting",
        "nav_section_setting"
    ); 

    add_settings_field(
        "nbt_nav_theme",
        __( 'Navigation Theme', 'neos_theme' ),
        "main_nav_theme_select_display",
        "neosThemeSetting",
        "nav_section_setting"
    ); 

    add_settings_field(
        "nbt_nav_sticky",
        __( 'Sticky Navbar on scroll', 'neos_theme' ),
        "main_nav_sticky_display",
        "neosThemeSetting",
        "nav_section_setting"
    ); 
}

function main_nav_align_select_display() {
    
    $options = get_option( 'nbt_set_nav_align' );
    ?>
        <select name="nbt_set_nav_align[nbt_nav_align_to]">
            <option value="ml-auto" <?php selected($options['nbt_nav_align_to'], "ml-auto"); ?>>Right</option>
            <option value="nbt-nav-center" <?php selected($options['nbt_nav_align_to'], "nbt-nav-center"); ?>>Center</option>
            <option value="mr-auto" <?php selected($options['nbt_nav_align_to'], "mr-auto"); ?>>Left</option>
        </select>
   <?php
}

function main_nav_theme_select_display() {
    
    $options = get_option( 'nbt_set_nav_align' ); 
    ?>
        <input type="radio" id="nav_theme_dark" name="nbt_set_nav_align[nbt_nav_theme]" value="dark" <?php echo checked( "dark", $options['nbt_nav_theme'], false ); ?>>
        <label for="nav_theme_dark">Dark</label>
        <input type="radio" id="nav_theme_light" name="nbt_set_nav_align[nbt_nav_theme]" value="light" <?php echo checked( "light", $options['nbt_nav_theme'], false ); ?>>
        <label for="nav_theme_light">Light</label>
   <?php
}

function main_nav_sticky_display() {
    
    $options = get_option( 'nbt_set_nav_align' );
    ?>
        <input type="checkbox" name="nbt_set_nav_align[nbt_nav_sticky]" value="1" <?php echo checked( "1", $options['nbt_nav_sticky'], false ); ?>>
   <?php
}


function neos_theme_option_settings_page() {
    ?>
      <div class="wrap">
         <h1>Demo</h1>
 
         <form method="post" action="options.php">
            <?php
               settings_fields("neosThemeSetting");
 
               do_settings_sections("neosThemeSetting");
                 
               submit_button();
            ?>
         </form>
      </div>
   <?php 
}


function stp_api_settings_section_callback(  ) {
    echo __( 'This Section Description', 'wordpress' );
}
