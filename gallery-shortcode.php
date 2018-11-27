<?php
/*
 * Shortcode definition
 * @link
 * @since 1.0
 *
 * @package gallery-shortcode
 * @subpackage gallery-shortcode
*/

namespace GalleryShortcode;

/*
    This class realizes the shortcode functionality
*/

class Gallery_Shortcode {

    public function __construct() {
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue_styles'));
        add_shortcode('an_gallery', array($this, 'gallery_shortcode'));
    }

    // include plugin's scripts

    public function enqueue_scripts() {
		wp_enqueue_script('gallery-shortcode-script',
				plugin_dir_url(__FILE__)."/js/gallery-shortcode.js",
				array('jquery'),
				false, false
			);
    }

    // include plugin's styles

    public function enqueue_styles() {
		wp_enqueue_style('gallery-shortcode-style',
				plugin_dir_url(__FILE__)."/css/gallery-shortcode.css",
				null, null, 'all'
			);        
    }

    // shortcode realization

    public function gallery_shortcode($atts = [], $content = null, $tag = '') {
        // all attributes to lower case
        $atts = array_change_key_case((array)$atts, CASE_LOWER);

        // obtain shortcode's parameters
        $params = shortcode_atts(
            array(
                'images' => '' 
            ),
            $atts, $tag
        );

        // if there are images in the list, then we'll show the galery
        if ($params["images"] !== "") {
            $images = preg_split("/,/", $params["images"]);

            $res = "";

            $res .= '<div class="an-gallery-shortcode-container">';
            
            foreach($images as $image) {
                if (ctype_digit($image)) {

                    $image_url = wp_get_attachment_url( intval($image) );
                    if ($image_url !== false) {
                        $image_title = get_the_title( intval($image) );
                        $res .= '<div class="an-gallery-shortcode-element">';
                        $res .= ('<img class="an-gallery-shortcode-image" src="' .$image_url. '" />');
                        $res .= ('<a href="'. $image_url . '" alt="'. $image_title. ' target="_blank">' .$image_title. '</a>');
                        $res .= "</div>";
                    }
                }
            }

            $res .= '<div class="an-gallery-shortcode-lightbox">';
            $res .= '<div class="an-gallery-shortcode-close-btn">';
            $res .= '<img src="'. plugin_dir_url(__FILE__) .'icons/baseline_close_black_18dp.png" alt="'. __("Close") .'" />';
            $res .= '</div>';
            $res .= '<img class="an-gallery-shortcode-lightbox-image" src="" />';
            $res .= '</div>';

            $res .= '</div>';

            return $res;

        } else {
            return '';
        }
    }

}

?>