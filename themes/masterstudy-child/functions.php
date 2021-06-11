<?php 
	add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
	function theme_enqueue_styles() {
	    // Styles
		wp_enqueue_style( 'boostrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', NULL, STM_THEME_VERSION, 'all' ); 
		wp_enqueue_style( 'font-awesome-min', get_template_directory_uri() . '/assets/css/font-awesome.min.css', NULL, STM_THEME_VERSION, 'all' ); 
		wp_enqueue_style( 'font-icomoon', get_template_directory_uri() . '/assets/css/icomoon.fonts.css', NULL, STM_THEME_VERSION, 'all' ); 
        wp_enqueue_style( 'fancyboxcss', get_template_directory_uri() . '/assets/css/jquery.fancybox.css', NULL, STM_THEME_VERSION, 'all' );
        wp_enqueue_style( 'select2-min', get_template_directory_uri() . '/assets/css/select2.min.css', NULL, STM_THEME_VERSION, 'all' );
		wp_enqueue_style( 'theme-style-less', get_template_directory_uri() . '/assets/css/styles.css', NULL, STM_THEME_VERSION, 'all' );
		
		// Animations
		if ( !wp_is_mobile() ) {
			wp_enqueue_style( 'theme-style-animation', get_template_directory_uri() . '/assets/css/animation.css', NULL, STM_THEME_VERSION, 'all' );
		}
		
		// Theme main stylesheet
		wp_enqueue_style( 'theme-style', get_stylesheet_uri(), null, STM_THEME_VERSION, 'all' );
		
		// FrontEndCustomizer
		wp_enqueue_style( 'skin_red_green', get_template_directory_uri() . '/assets/css/skins/skin_red_green.css', NULL, STM_THEME_VERSION, 'all' );
		wp_enqueue_style( 'skin_blue_green', get_template_directory_uri() . '/assets/css/skins/skin_blue_green.css', NULL, STM_THEME_VERSION, 'all' );
		wp_enqueue_style( 'skin_red_brown', get_template_directory_uri() . '/assets/css/skins/skin_red_brown.css', NULL, STM_THEME_VERSION, 'all' );
		wp_enqueue_style( 'skin_custom_color', get_template_directory_uri() . '/assets/css/skins/skin_custom_color.css', NULL, STM_THEME_VERSION, 'all' );
	}

/*funcion smtp */
/*add_action('phpmailer_init','send_smtp_email');
function send_smtp_email( $phpmailer )
{
    // Define que estamos enviando por SMTP
    $phpmailer->isSMTP();
 
    // La dirección del HOST del servidor de correo SMTP p.e. smtp.midominio.com
    $phpmailer->Host = "vps.imakina.com.ec";
 
    // Uso autenticación por SMTP (true|false)
    $phpmailer->SMTPAuth = true;
 
    // Puerto SMTP - Suele ser el 25, 465 o 587
    $phpmailer->Port = "587";
 
    // Usuario de la cuenta de correo
    $phpmailer->Username = "info@imakina.com.ec";
 
    // Contraseña para la autenticación SMTP
    $phpmailer->Password = "Kz6sjnPC";
 
    // El tipo de encriptación que usamos al conectar - ssl (deprecated) o tls
    $phpmailer->SMTPSecure = "tls";
 
    $phpmailer->From = "info@imakina.com.ec";
    $phpmailer->FromName = "Imakina Elearning"; 
}*/

function hide_notices_dashboard() {
    global $wp_filter;
 
    if (is_network_admin() and isset($wp_filter["network_admin_notices"])) {
        unset($wp_filter['network_admin_notices']);
    } elseif(is_user_admin() and isset($wp_filter["user_admin_notices"])) {
        unset($wp_filter['user_admin_notices']);
    } else {
        if(isset($wp_filter["admin_notices"])) {
            unset($wp_filter['admin_notices']);
        }
    }
 
    if (isset($wp_filter["all_admin_notices"])) {
        unset($wp_filter['all_admin_notices']);
    }
}
add_action( 'admin_init', 'hide_notices_dashboard' );


function add_file_types_to_uploads($file_types){
$new_filetypes = array();
$new_filetypes['svg'] = 'image/svg+xml';
$file_types = array_merge($file_types, $new_filetypes );
return $file_types;
}
add_action('upload_mimes', 'add_file_types_to_uploads');










// hooks your functions into the correct filters
function wdm_add_mce_button() {
    // check user permissions
    if ( !current_user_can( 'edit_posts' ) &&  !current_user_can( 'edit_pages' ) ) {
               return;
       }
   // check if WYSIWYG is enabled
   if ( 'true' == get_user_option( 'rich_editing' ) ) {
       add_filter( 'mce_external_plugins', 'wdm_add_tinymce_plugin' );
       add_filter( 'mce_buttons', 'wdm_register_mce_button' );
       }
}
add_action('admin_head', 'wdm_add_mce_button');

// register new button in the editor
function wdm_register_mce_button( $buttons ) {
    array_push( $buttons, 'wdm_mce_button' );
    return $buttons;
}


// declare a script for the new button
// the script will insert the shortcode on the click event
function wdm_add_tinymce_plugin( $plugin_array ) {
  $plugin_array['wdm_mce_button'] = get_stylesheet_directory_uri() .'/js/wdm-mce-button.js';
  return $plugin_array;
}



add_action( 'pre_get_posts', 'dcms_exclude_specific_pages' );
function dcms_exclude_specific_pages($query)
{
	if ( $query->is_search() && $query->is_main_query() )
		$query->set( 'post__not_in', array( 1228, 2707, 1554, 2711 ) );
}