<?php 
/*-----------------------------------------------------------------------------------*/
/* Social icons																		*/
/*-----------------------------------------------------------------------------------*/
function icraft_social_icons () {
	
	$socio_list = '';
	$siciocount = 0;
    $services = array ('facebook','twitter','youtube','flickr','feed','instagram','googleplus');
    
		$socio_list .= '<ul class="social">';	
		foreach ( $services as $service ) :
			
			if( $service == 'facebook' ) {
				$active[$service] = esc_url( get_theme_mod('itrans_social_'.$service, esc_url('https://www.facebook.com/wordress')) );
			} elseif( $service == 'twitter' ) {
				$active[$service] = esc_url( get_theme_mod('itrans_social_'.$service, esc_url('https://www.twitter.com/wordpress')) );
			} elseif( $service == 'youtube' ) {
				$active[$service] = esc_url( get_theme_mod('itrans_social_'.$service, esc_url('https://www.youtube.com/wordpress')) );
			} elseif( $service == 'instagram' ) {
				$active[$service] = esc_url( get_theme_mod('itrans_social_'.$service, esc_url('https://www.instagram.com/wordpress')) );
			} else {
				$active[$service] = esc_url( get_theme_mod('itrans_social_'.$service, '') );
			}
			
			if ($active[$service]) { 
				$socio_list .= '<li><a href="'.esc_url($active[$service]).'" title="'.$service.'" target="_blank"><i class="genericon socico genericon-'.$service.'"></i></a></li>';
				$siciocount++;
			}
			
		endforeach;
		$socio_list .= '</ul>';
		
		if($siciocount>0)
		{	
			return $socio_list;
		} else
		{
			return;
		}
}

/*-----------------------------------------------------------------------------------*/
/* ibanner Slider																		*/
/*-----------------------------------------------------------------------------------*/
function icraft_ibanner_slider () {    
	$arrslidestxt = array();
	$template_dir = get_template_directory_uri();
	$banner_text = esc_attr(get_theme_mod('banner_text', ''));

	$text_alignment = esc_attr(get_theme_mod('itrans_align', 'nxs-left'));
	$banner_overlay = esc_attr(get_theme_mod('itrans_overlay', 'nxs-max19'));
	$itrans_sliderparallax = get_theme_mod('itrans_sliderparallax', 1);	
	$sliderscpeed = intval(esc_attr(get_theme_mod('itrans_sliderspeed', '6'))) * 1000 ;	
	
	if( $banner_overlay == 'nxs-max18' || $banner_overlay == 'nxs-max19' )	
	{
		$text_alignment = 'left';
	}
		
	$upload_dir = wp_upload_dir();
	$upload_base_dir = $upload_dir['basedir'];
	$upload_base_url = $upload_dir['baseurl'];	
	
	$slides_preset = array (
        array(
            'itrans_slide_title' => esc_attr__( '<span class="themecolor">Drag & Drop</span> Ready Layouts', 'i-craft' ),
            'itrans_slide_desc' => esc_attr__( 'Perfect For Business And WooCommerce WordPress Sites', 'i-craft' ),
            'itrans_slide_linktext' => esc_attr__( 'Know More', 'i-craft' ),
            'itrans_slide_linkurl' => esc_url('http://www.templatesnext.org/i-craft/'),
            'itrans_slide_image' => esc_url( get_template_directory_uri() . '/images/slide1.jpg' ),
        ),
        array(
            'itrans_slide_title' => esc_attr__( 'SiteOrigin Page Builder & Elementor', 'i-craft' ),
            'itrans_slide_desc' => esc_attr__( 'Design Your Pages With Most Popular Page Builders', 'i-craft' ),
            'itrans_slide_linktext' => esc_attr__( 'Know More', 'i-craft' ),
            'itrans_slide_linkurl' => '',
            'itrans_slide_image' => esc_url( get_template_directory_uri() . '/images/slide2.jpg' ),
        ),
        array(
            'itrans_slide_title' => esc_attr__( 'Exclusive <span class="themecolor">WooCommerce</span> Features', 'i-craft' ),
            'itrans_slide_desc' => esc_attr__( 'Create Sections Using Pagebuilder Or TemplatesNext Shortcodes', 'i-craft' ),
            'itrans_slide_linktext' => esc_attr__( 'Know More', 'i-craft' ),
            'itrans_slide_linkurl' => '',
            'itrans_slide_image' => esc_url( get_template_directory_uri() . '/images/slide3.jpg' ),
        ),
        array(
            'itrans_slide_title' => esc_attr__( 'Portfolio, Testimonial, Services...', 'i-craft' ),
            'itrans_slide_desc' => esc_attr__( 'Use the [tx] button on your editor to create the columns, services, portfolios, testimonials and custom sliders.', 'i-craft' ),
            'itrans_slide_linktext' => esc_attr__( 'Know More', 'i-craft' ),
            'itrans_slide_linkurl' => '',
            'itrans_slide_image' => esc_url( get_template_directory_uri() . '/images/slide4.jpg' ),
        ),

	);		
	
    for( $slideno = 0; $slideno < 4; $slideno++ ){
			$strret = '';
			$counter = $slideno+1;
			
			$slide_title = esc_attr(get_theme_mod('itrans_slide'.$counter.'_title', $slides_preset[$slideno]['itrans_slide_title'] ));
			$slide_desc = esc_attr(get_theme_mod('itrans_slide'.$counter.'_desc', $slides_preset[$slideno]['itrans_slide_desc'] ));
			$slide_linktext = esc_attr(get_theme_mod('itrans_slide'.$counter.'_linktext', $slides_preset[$slideno]['itrans_slide_linktext'] ));
			$slide_linkurl = esc_url(get_theme_mod('itrans_slide'.$counter.'_linkurl', $slides_preset[$slideno]['itrans_slide_linkurl'] ));
			$slide_image = esc_url(get_theme_mod('itrans_slide'.$counter.'_image', $slides_preset[$slideno]['itrans_slide_image'] ));
			
			$slider_height = esc_attr(get_theme_mod('slider_height', 72 ));
			$slider_reduct = esc_attr(get_theme_mod('slider_reduction', 60 ));						
			
			$slider_image_id = icraft_get_attachment_id_from_url( $slide_image );			
			$slider_resized_image = wp_get_attachment_image( $slider_image_id, "icraft-slider-thumb" );			
			
			if ( $slide_image ) {

				if( $slide_image!='' ){
					if( file_exists( str_replace($upload_base_url,$upload_base_dir,$slide_image) ) ){
						
						$slide_image_url = wp_get_attachment_image_src( $slider_image_id, 'icraft-slider-thumb' );
						$slide_image_url = $slide_image_url[0];						
						//$strret .= '<div class="da-img">' . $slider_resized_image .'</div>';
						$strret .= '<div class="da-img" style="background-image: url('.$slide_image_url.');"></div>';
					}
					else
					{
						$slide_image = $template_dir.'/images/slide'.$counter.'.jpg';
						//$strret .= '<div class="da-img noslide-image"><img src="'.$slide_image.'" alt="'.$slide_title.'" /></div>';
						$strret .= '<div class="da-img noslide-image" style="background-image: url('.$slide_image.');"></div>';
					}
				}
				else
				{					
					$slide_image = $template_dir.'/images/slide'.$counter.'.jpg';
					//$strret .= '<div class="da-img noslide-image"><img src="'.$slide_image.'" alt="'.$slide_title.'" /></div>';
					$strret .= '<div class="da-img noslide-image" style="background-image: url('.$slide_image.');"></div>';					
				}
				
				$strret .= '<div class="slider-content-wrap"><div class="nx-slider-container">';
				$strret .= '<h2>'.wp_specialchars_decode($slide_title, $quote_style = ENT_QUOTES).'</h2>';
				$strret .= '<p>'.$slide_desc.'</p>';
				$strret .= '<a href="'.$slide_linkurl.'" class="da-link">'.$slide_linktext.'</a>';
				$strret .= '</div></div>';
			}
			if ( $strret != '' ){
				$arrslidestxt[$slideno] = $strret;
			}
					
	}
	
	if( count( $arrslidestxt ) > 0 ){
		echo '<div class="ibanner '.$banner_overlay.' '.$text_alignment.'" data-edit-slides="Edit Slider">';
		echo '	<div id="da-slider" class="da-slider" role="banner" data-slider-speed="'.$sliderscpeed.'" data-slider-height="'.$slider_height.'" data-slider-reduct="'.$slider_reduct.'" data-slider-parallax="'.$itrans_sliderparallax.'">';
			
		foreach ( $arrslidestxt as $slidetxt ) :
			echo '<div class="nx-slider">';	
			echo	$slidetxt;
			echo '</div>';

		endforeach;
		echo '	</div>';
		echo '</div>';
	} else
	{
        echo '<div class="iheader front">';
        echo '    <div class="titlebar">';
        echo '        <h1>';
		
		if ($banner_text) {
			echo $banner_text;
		} 
        echo '        </h1>';
        echo '    </div>';
        echo '</div>';
	}
    
}


/*-----------------------------------------------------------------------------------*/
/* find attachment id from url																	*/
/*-----------------------------------------------------------------------------------*/
function icraft_get_attachment_id_from_url( $attachment_url = '' ) {

    global $wpdb;
    $attachment_id = false;

    // If there is no url, return.
    if ( '' == $attachment_url )
        return;

    // Get the upload directory paths
    $upload_dir_paths = wp_upload_dir();

    // Make sure the upload path base directory exists in the attachment URL, to verify that we're working with a media library image
    if ( false !== strpos( $attachment_url, $upload_dir_paths['baseurl'] ) ) {

        // If this is the URL of an auto-generated thumbnail, get the URL of the original image
        $attachment_url = preg_replace( '/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $attachment_url );

        // Remove the upload path base directory from the attachment URL
        $attachment_url = str_replace( $upload_dir_paths['baseurl'] . '/', '', $attachment_url );

        // Finally, run a custom database query to get the attachment ID from the modified attachment URL
        $attachment_id = $wpdb->get_var( $wpdb->prepare( "SELECT wposts.ID FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = '%s' AND wposts.post_type = 'attachment'", $attachment_url ) );

    }

    return $attachment_id;
}


/* Demo import by One Click Demo Import */
// include get_template_directory() . '/inc/one-click-demo-import/one-click-demo-import.php';

function icraft_import_files() {
  return array(
		array(
		  'import_file_name'             	=> 'Elementor Slider',
		  'import_file_url'            		=> 'http://wp-demos.com/downloads/demos/i-craft/elementor/elementor-slider.xml',
		  //'import_widget_file_url'     		=> 'http://wp-demos.com/downloads/demos/i-craft/elementor/restaurant.wie',
		  'import_customizer_file_url' 		=> 'http://wp-demos.com/downloads/demos/i-craft/elementor/elementor-slider.dat',
		  //'import_preview_image_url'     	=> '//wp-demos.com/downloads/demos/i-craft/elementor/restaurant.jpg',
		  'import_preview_image_url'     	=> trailingslashit( get_template_directory_uri() ) . 'inc/txoc/small-images/elementor-slider.jpg',
		  'import_notice'                	=> __( 'This process involves transfer of data and media from server to server and might take some time.', 'i-craft' ),
		  'preview_url'                		=> 'http://www.wp-demos.com/i-spirit/i-craft-elementor-slider/',
		  'required_plugin'					=> array(
												'elementor',
												'contact-form-7',
											),
		  'categories'                 		=> array( 'Free', 'Elementor' ),	  
		),
		array(
		  'import_file_name'             	=> 'Restaurant',
		  'import_file_url'            		=> 'http://wp-demos.com/downloads/demos/i-craft/elementor/restaurant.xml',
		  //'import_widget_file_url'     		=> 'http://wp-demos.com/downloads/demos/i-craft/elementor/restaurant.wie',
		  'import_customizer_file_url' 		=> 'http://wp-demos.com/downloads/demos/i-craft/elementor/restaurant.dat',
		  //'import_preview_image_url'     	=> '//wp-demos.com/downloads/demos/i-craft/elementor/restaurant.jpg',
		  'import_preview_image_url'     	=> trailingslashit( get_template_directory_uri() ) . 'inc/txoc/small-images/restaurant.jpg',
		  'import_notice'                	=> __( 'This process involves transfer of data and media from server to server and might take some time.', 'i-craft' ),
		  'preview_url'                		=> 'http://www.wp-demos.com/i-spirit/i-craft-restaurant/',
		  'required_plugin'					=> array(
												'elementor',
												'essential-addons-for-elementor-lite',
												'contact-form-7',
											),
		  'categories'                 		=> array( 'Free', 'Elementor' ),	  
		),
		array(
		  'import_file_name'             	=> 'Small Business',
		  'import_file_url'            		=> 'http://wp-demos.com/downloads/demos/i-craft/elementor/small-business.xml',
		  //'import_widget_file_url'     		=> 'http://wp-demos.com/downloads/demos/i-craft/elementor/small-business.wie',
		  'import_customizer_file_url' 		=> 'http://wp-demos.com/downloads/demos/i-craft/elementor/small-business.dat',
		  'import_preview_image_url'     	=> trailingslashit( get_template_directory_uri() ) . 'inc/txoc/small-images/business.jpg',
		  'import_notice'                	=> __( 'This process involves transfer of data and media from server to server and might take some time.', 'i-craft' ),
		  'preview_url'                		=> 'http://www.wp-demos.com/i-spirit/i-craft-smallbusiness/',
		  'required_plugin'					=> array(
												'elementor',
												'essential-addons-for-elementor-lite',
												'contact-form-7',
											),
		  'categories'                 		=> array( 'Free', 'Elementor' ),	  
		),		
		array(
		  'import_file_name'             	=> 'Personal',
		  'import_file_url'            		=> 'http://wp-demos.com/downloads/demos/i-craft/elementor/personal.xml',
		  //'import_widget_file_url'     		=> 'http://wp-demos.com/downloads/demos/i-craft/elementor/personal.wie',
		  'import_customizer_file_url' 		=> 'http://wp-demos.com/downloads/demos/i-craft/elementor/personal.dat',
		  'import_preview_image_url'     	=> trailingslashit( get_template_directory_uri() ) . 'inc/txoc/small-images/personal.jpg',
		  'import_notice'                	=> __( 'This process involves transfer of data and media from server to server and might take some time.', 'i-craft' ),
		  'preview_url'                		=> 'http://www.wp-demos.com/i-spirit/i-craft-personal/',
		  'required_plugin'					=> array(
												'elementor',
												'essential-addons-for-elementor-lite',
												'contact-form-7',
											),
		  'categories'                 		=> array( 'Free', 'Elementor' ),	  
		),
		array(
		  'import_file_name'             	=> 'Multilingual',
		  'import_file_url'            		=> 'http://wp-demos.com/downloads/demos/i-craft/elementor/multilingual.xml',
		  //'import_widget_file_url'     		=> 'http://wp-demos.com/downloads/demos/i-craft/elementor/personal.wie',
		  'import_customizer_file_url' 		=> 'http://wp-demos.com/downloads/demos/i-craft/elementor/multilingual.dat',
		  'import_preview_image_url'     	=> trailingslashit( get_template_directory_uri() ) . 'inc/txoc/small-images/multilingual.jpg',
		  'import_notice'                	=> __( 'This process involves transfer of data and media from server to server and might take some time.', 'i-craft' ),
		  'preview_url'                		=> 'http://www.wp-demos.com/i-spirit/i-craft-multilingual/',
		  'required_plugin'					=> array(
												'elementor',
												'essential-addons-for-elementor-lite',
												'contact-form-7',
												'polylang',												
											),
		  'categories'                 		=> array( 'Free', 'Elementor' ),	  
		),
		array(
		  'import_file_name'             	=> 'RTL',
		  'import_file_url'            		=> 'http://wp-demos.com/downloads/demos/i-craft/elementor/rtl.xml',
		  //'import_widget_file_url'     		=> 'http://wp-demos.com/downloads/demos/i-craft/elementor/personal.wie',
		  'import_customizer_file_url' 		=> 'http://wp-demos.com/downloads/demos/i-craft/elementor/rtl.dat',
		  'import_preview_image_url'     	=> trailingslashit( get_template_directory_uri() ) . 'inc/txoc/small-images/rtl.jpg',
		  'import_notice'                	=> __( 'This process involves transfer of data and media from server to server and might take some time.', 'i-craft' ),
		  'preview_url'                		=> 'http://www.wp-demos.com/i-spirit/i-craft-rtl/',
		  'required_plugin'					=> array(
												'elementor',
												'essential-addons-for-elementor-lite',
												'contact-form-7',
												'loco-translate',												
											),
		  'categories'                 		=> array( 'Free', 'Elementor' ),	  
		),
		array(
		  'import_file_name'             	=> 'Online Courses',
		  'import_widget_file_url'     		=> 'http://wp-demos.com/downloads/demos/i-craft/elementor/personal.wie',
		  'import_preview_image_url'     	=> trailingslashit( get_template_directory_uri() ) . 'inc/txoc/small-images/max-institute.jpg',
		  'import_notice'                	=> __( 'This demo design is only available with premium theme I-SPIRIT.', 'i-craft' ),
		  'preview_url'                		=> 'http://www.wp-demos.com/i-spirit/max-institute/',
		  'required_plugin'					=> '',
		  'categories'                 		=> array( 'Premium', 'Elementor' ),										
		),
		array(
		  'import_file_name'             	=> 'MAX Store',
		  'import_widget_file_url'     		=> 'https://raw.githubusercontent.com/TemplatesNext/i-craft-demo/master/i-craft-shop.wie',
		  'import_preview_image_url'     	=> trailingslashit( get_template_directory_uri() ) . 'inc/txoc/small-images/maxstore.jpg',
		  'import_notice'                	=> __( 'This demo design is only available with premium theme I-SPIRIT.', 'i-craft' ),
		  'preview_url'                		=> 'http://www.wp-demos.com/i-spirit/maxstore/',
		  'required_plugin'					=> '',
		  'categories'                 		=> array( 'Premium', 'WooCommerce', 'Elementor' ),										
		),
		
		/* Starting 2019 - 3 demos */
		array(
		  'import_file_name'             	=> 'Church',
		  'import_file_url'            		=> 'http://wp-demos.com/downloads/demos/i-craft/elementor/church.xml',
		  //'import_widget_file_url'     		=> 'http://wp-demos.com/downloads/demos/i-craft/elementor/personal.wie',
		  'import_customizer_file_url' 		=> 'http://wp-demos.com/downloads/demos/i-craft/elementor/church.dat',
		  'import_preview_image_url'     	=> trailingslashit( get_template_directory_uri() ) . 'inc/txoc/small-images/church.jpg',
		  'import_notice'                	=> __( 'This process involves transfer of data and media from server to server and might take some time.', 'i-craft' ),
		  'preview_url'                		=> 'http://www.wp-demos.com/i-spirit/i-craft-church/',
		  'required_plugin'					=> array(
												'elementor',
												'essential-addons-for-elementor-lite',
												'contact-form-7',
											),
		  'categories'                 		=> array( 'Free', 'Elementor' ),	  
		),
		array(
		  'import_file_name'             	=> 'SEO',
		  'import_file_url'            		=> 'http://wp-demos.com/downloads/demos/i-craft/elementor/seo.xml',
		  //'import_widget_file_url'     		=> 'http://wp-demos.com/downloads/demos/i-craft/elementor/personal.wie',
		  'import_customizer_file_url' 		=> 'http://wp-demos.com/downloads/demos/i-craft/elementor/seo.dat',
		  'import_preview_image_url'     	=> trailingslashit( get_template_directory_uri() ) . 'inc/txoc/small-images/seo.jpg',
		  'import_notice'                	=> __( 'This process involves transfer of data and media from server to server and might take some time.', 'i-craft' ),
		  'preview_url'                		=> 'http://www.wp-demos.com/i-spirit/i-craft-seo/',
		  'required_plugin'					=> array(
												'elementor',
												'essential-addons-for-elementor-lite',
												'contact-form-7',
											),
		  'categories'                 		=> array( 'Free', 'Elementor' ),	  
		),
		array(
		  'import_file_name'             	=> 'Yoga',
		  'import_widget_file_url'     		=> 'http://wp-demos.com/downloads/demos/i-craft/elementor/personal.wie',
		  'import_preview_image_url'     	=> trailingslashit( get_template_directory_uri() ) . 'inc/txoc/small-images/yoga.jpg',
		  'import_notice'                	=> __( 'This demo design is only available with premium theme I-SPIRIT.', 'i-craft' ),
		  'preview_url'                		=> 'http://www.wp-demos.com/i-spirit/yoga/',
		  'required_plugin'					=> '',
		  'categories'                 		=> array( 'Premium', 'Elementor' ),										
		),
		array(
		  'import_file_name'             	=> 'Gym',
		  'import_widget_file_url'     		=> 'http://wp-demos.com/downloads/demos/i-craft/elementor/personal.wie',
		  'import_preview_image_url'     	=> trailingslashit( get_template_directory_uri() ) . 'inc/txoc/small-images/gym.jpg',
		  'import_notice'                	=> __( 'This demo design is only available with premium theme I-SPIRIT.', 'i-craft' ),
		  'preview_url'                		=> 'http://www.wp-demos.com/i-spirit/gym/',
		  'required_plugin'					=> '',
		  'categories'                 		=> array( 'Premium', 'Elementor' ),										
		),									
				
    array(
      'import_file_name'             	=> 'Agency 1',
      'import_file_url'            		=> 'https://raw.githubusercontent.com/TemplatesNext/i-craft-demo/master/i-craft-agency.xml',
      'import_widget_file_url'     		=> 'https://raw.githubusercontent.com/TemplatesNext/i-craft-demo/master/i-craft-agency.wie',
      'import_customizer_file_url' 		=> 'https://raw.githubusercontent.com/TemplatesNext/i-craft-demo/master/i-craft-agency-1.dat',
      'import_preview_image_url'     	=> trailingslashit( get_template_directory_uri() ) . 'inc/txoc/small-images/agency-1.jpg',
      'import_notice'                	=> __( 'Please make sure you have plugin "TemplatesNext ToolKit" and "Contact Form 7" installed and active before you start the import process. <br> This process involves transfer of data and media from server to server and might take some time.', 'i-craft' ),
	  'preview_url'                		=> 'http://wp-demos.com/agency/',
	  'required_plugin'					=> array(
											'siteorigin-panels',
											'so-widgets-bundle',
	  									),
  	  'categories'                 		=> array( 'Free', 'SiteOrigin Page Builder' ),	
    ),
    array(
      'import_file_name'             	=> 'Business Home 1',
      'import_file_url'            		=> 'https://raw.githubusercontent.com/TemplatesNext/i-craft-demo/master/i-craft-agency.xml',
      'import_widget_file_url'     		=> 'https://raw.githubusercontent.com/TemplatesNext/i-craft-demo/master/i-craft-agency.wie',
      'import_customizer_file_url' 		=> 'https://raw.githubusercontent.com/TemplatesNext/i-craft-demo/master/i-craft-business-1.dat',
      'import_preview_image_url'     	=> trailingslashit( get_template_directory_uri() ) . 'inc/txoc/small-images/business-1.jpg',
      'import_notice'                	=> __( 'Please make sure you have plugin "TemplatesNext ToolKit" and "Contact Form 7" installed and active before you start the import process. <br> This process involves transfer of data and media from server to server and might take some time.', 'i-craft' ),
	  'preview_url'                		=> 'http://wp-demos.com/agency/business-home-1-pb/',
	  'required_plugin'					=> array(
											'siteorigin-panels',
											'so-widgets-bundle',
	  									),
	  'categories'                 		=> array( 'Free', 'SiteOrigin Page Builder' ),		  
    ),	
	
    array(
      'import_file_name'             	=> 'Fashion Shop 1',
      'import_file_url'            		=> 'https://raw.githubusercontent.com/TemplatesNext/i-craft-demo/master/i-craft-demo.xml',
      'import_widget_file_url'     		=> 'https://raw.githubusercontent.com/TemplatesNext/i-craft-demo/master/i-craft-shop.wie',
      'import_customizer_file_url' 		=> 'https://raw.githubusercontent.com/TemplatesNext/i-craft-demo/master/i-craft-fashion-shop-1.dat',
      'import_preview_image_url'     	=> trailingslashit( get_template_directory_uri() ) . 'inc/txoc/small-images/fashion-shop.jpg',
      'import_notice'                	=> __( 'Please make sure you have plugin "TemplatesNext ToolKit", "WooCommerce" and "Contact Form 7" installed and active before you start the import process. <br> This process involves transfer of data and media from server to server and might take some time.', 'i-craft' ),
	  'preview_url'                		=> 'http://www.wp-demos.com/shop/',
	  'required_plugin'					=> array(
											'breadcrumb-navxt',
											'siteorigin-panels',
											'so-widgets-bundle',
											'contact-form-7',
	  									),
	  'categories'                 		=> array( 'Free','WooCommerce', 'SiteOrigin Page Builder' ),	
    ),
    array(
      'import_file_name'             	=> 'Shop Shaurya',
      'import_file_url'            		=> 'https://raw.githubusercontent.com/TemplatesNext/i-craft-demo/master/i-craft-demo.xml',
      'import_widget_file_url'     		=> 'https://raw.githubusercontent.com/TemplatesNext/i-craft-demo/master/i-craft-shop.wie',
      'import_customizer_file_url' 		=> 'https://raw.githubusercontent.com/TemplatesNext/i-craft-demo/master/i-craft-shop-shaurya.dat',
      'import_preview_image_url'     	=> trailingslashit( get_template_directory_uri() ) . 'inc/txoc/small-images/shaurya.jpg',
      'import_notice'                	=> __( 'Please make sure you have plugin "TemplatesNext ToolKit", "WooCommerce" and "Contact Form 7" installed and active before you start the import process. <br> This process involves transfer of data and media from server to server and might take some time.', 'i-craft' ),
	  'preview_url'                		=> 'http://wp-demos.com/shop/shop-shaurya/',
	  'required_plugin'					=> array(
											'breadcrumb-navxt',
											'siteorigin-panels',
											'so-widgets-bundle',
											'contact-form-7',
	  									),
	  'categories'                 		=> array( 'Free','WooCommerce', 'SiteOrigin Page Builder' ),
    ),
	
    array(
      'import_file_name'             	=> 'Craft-18 Shop',
      'import_file_url'            		=> 'https://raw.githubusercontent.com/TemplatesNext/i-craft-demo/master/i-craft-demo.xml',
      'import_widget_file_url'     		=> 'https://raw.githubusercontent.com/TemplatesNext/i-craft-demo/master/i-craft-shop.wie',
      'import_customizer_file_url' 		=> 'https://raw.githubusercontent.com/TemplatesNext/i-craft-demo/master/i-craft-18-shop.dat',
      'import_preview_image_url'     	=> trailingslashit( get_template_directory_uri() ) . 'inc/txoc/small-images/shop-craft-18.jpg',
      'import_notice'                	=> __( 'Please make sure you have plugin "TemplatesNext ToolKit", "WooCommerce" and "Contact Form 7" installed and active before you start the import process. <br> This process involves transfer of data and media from server to server and might take some time.', 'i-craft' ),
	  'preview_url'                		=> 'http://wp-demos.com/shop/shop-blank/',
	  'required_plugin'					=> array(
											'breadcrumb-navxt',
											'siteorigin-panels',
											'so-widgets-bundle',
											'contact-form-7',
	  									),
	  'categories'                 		=> array( 'Free','WooCommerce', 'SiteOrigin Page Builder' ),
    ),
	
	
    array(
      'import_file_name'             	=> 'Agency 3',
      'import_file_url'            		=> 'http://wp-demos.com/downloads/demos/i-craft/creative/i-craft-creative.xml',
      'import_widget_file_url'     		=> 'http://wp-demos.com/downloads/demos/i-craft/creative/i-craft-creative.wie',
      'import_customizer_file_url' 		=> 'http://wp-demos.com/downloads/demos/i-craft/creative/i-craft-creative.dat',
      'import_preview_image_url'     	=> trailingslashit( get_template_directory_uri() ) . 'inc/txoc/small-images/agency-3.jpg',
      'import_notice'                	=> __( 'Please make sure you have plugin "TemplatesNext ToolKit" and "SiteOrigin Page Builder" installed and active before you start the import process. <br> This process involves transfer of data and media from server to server and might take some time.', 'i-craft' ),
	  'preview_url'                		=> 'http://wp-demos.com/agency/agency-3/',
	  'required_plugin'					=> array(
											'siteorigin-panels',
											'so-widgets-bundle',
	  									),
	  'categories'                 		=> array( 'Free', 'SiteOrigin Page Builder' ),		  
    ),	

    array(
      'import_file_name'             	=> 'Agency 4',
      'import_file_url'            		=> 'http://wp-demos.com/downloads/demos/i-craft/creative/i-craft-creative.xml',
      'import_widget_file_url'     		=> 'http://wp-demos.com/downloads/demos/i-craft/creative/i-craft-creative.wie',
      'import_customizer_file_url' 		=> 'http://wp-demos.com/downloads/demos/i-craft/creative/i-craft-creative.dat',
      'import_preview_image_url'     	=> trailingslashit( get_template_directory_uri() ) . 'inc/txoc/small-images/agency-4.jpg',
      'import_notice'                	=> __( 'This process involves transfer of data and media from server to server and might take some time.', 'i-craft' ),
	  'preview_url'                		=> 'http://wp-demos.com/creative/',
	  'required_plugin'					=> array(
											'siteorigin-panels',
											'so-widgets-bundle',
	  									),
	  'categories'                 		=> array( 'Free', 'SiteOrigin Page Builder' ),	  
    ),
    array(
      'import_file_name'             	=> 'School',
      'import_file_url'            		=> 'http://wp-demos.com/downloads/demos/i-craft/creative/i-craft-creative.xml',
      'import_widget_file_url'     		=> 'http://wp-demos.com/downloads/demos/i-craft/creative/i-craft-creative.wie',
      'import_customizer_file_url' 		=> 'http://wp-demos.com/downloads/demos/i-craft/creative/i-craft-creative.dat',
      'import_preview_image_url'     	=> trailingslashit( get_template_directory_uri() ) . 'inc/txoc/small-images/school.jpg',
      'import_notice'                	=> __( 'This process involves transfer of data and media from server to server and might take some time.', 'i-craft' ),
	  'preview_url'                		=> 'http://wp-demos.com/creative/graceland-school/',
	  'required_plugin'					=> array(
											'siteorigin-panels',
											'so-widgets-bundle',
	  									),
	  'categories'                 		=> array( 'Free', 'SiteOrigin Page Builder' ),	  
    ),
    array(
      'import_file_name'             	=> 'Charity',
      'import_file_url'            		=> 'http://wp-demos.com/downloads/demos/i-craft/creative/i-craft-creative.xml',
      'import_widget_file_url'     		=> 'http://wp-demos.com/downloads/demos/i-craft/creative/i-craft-creative.wie',
      'import_customizer_file_url' 		=> 'http://wp-demos.com/downloads/demos/i-craft/creative/i-craft-creative.dat',
      'import_preview_image_url'     	=> trailingslashit( get_template_directory_uri() ) . 'inc/txoc/small-images/ngo-charity.jpg',
      'import_notice'                	=> __( 'This process involves transfer of data and media from server to server and might take some time.', 'i-craft' ),
	  'preview_url'                		=> 'http://wp-demos.com/creative/visionale/',
	  'required_plugin'					=> array(
											'siteorigin-panels',
											'so-widgets-bundle',
	  									),
	  'categories'                 		=> array( 'Free', 'SiteOrigin Page Builder' ),	  
    ),
    array(
      'import_file_name'             	=> 'Computer',
      'import_file_url'            		=> 'http://wp-demos.com/downloads/demos/i-craft/creative/i-craft-creative.xml',
      'import_widget_file_url'     		=> 'http://wp-demos.com/downloads/demos/i-craft/creative/i-craft-creative.wie',
      'import_customizer_file_url' 		=> 'http://wp-demos.com/downloads/demos/i-craft/creative/i-craft-creative.dat',
      'import_preview_image_url'     	=> trailingslashit( get_template_directory_uri() ) . 'inc/txoc/small-images/computer.jpg',
      'import_notice'                	=> __( 'This process involves transfer of data and media from server to server and might take some time.', 'i-craft' ),
	  'preview_url'                		=> 'http://wp-demos.com/creative/computers-1/',
	  'required_plugin'					=> array(
											'siteorigin-panels',
											'so-widgets-bundle',
	  									),
	  'categories'                 		=> array( 'Free', 'SiteOrigin Page Builder' ),	  
    ),	
    array(
      'import_file_name'             	=> 'Agency 2',
      'import_file_url'            		=> 'https://raw.githubusercontent.com/TemplatesNext/i-craft-demo/master/i-craft-agency-2.xml',
      'import_widget_file_url'     		=> 'https://raw.githubusercontent.com/TemplatesNext/i-craft-demo/master/i-craft-agency.wie',
      'import_customizer_file_url' 		=> 'https://raw.githubusercontent.com/TemplatesNext/i-craft-demo/master/i-craft-agency-2.dat',
      'import_preview_image_url'     	=> trailingslashit( get_template_directory_uri() ) . 'inc/txoc/small-images/agency-2.jpg',
      'import_notice'                	=> __( 'Please make sure you have plugin "TemplatesNext ToolKit" and "Contact Form 7" installed and active before you start the import process. <br> This process involves transfer of data and media from server to server and might take some time.', 'i-craft' ),
	  'preview_url'                		=> 'http://wp-demos.com/agency/agency-2-pb/',
	  'required_plugin'					=> array(
											'siteorigin-panels',
											'so-widgets-bundle',
	  									),
	  'categories'                 		=> array( 'Free', 'SiteOrigin Page Builder' ),	
    ),	
    array(
      'import_file_name'             	=> 'Classic 1',
      'import_widget_file_url'     		=> 'https://raw.githubusercontent.com/TemplatesNext/i-excel-demo/master/i-excel-shop.wie',
      'import_preview_image_url'     	=> trailingslashit( get_template_directory_uri() ) . 'inc/txoc/small-images/classic-1.jpg',
      'import_notice'                	=> __( 'This demo design is only available with premium theme I-SPIRIT.', 'i-craft' ),
	  'preview_url'                		=> 'http://www.wp-demos.com/ispirit/classic/',
	  'required_plugin'					=> '',
	  'categories'                 		=> array( 'Premium', 'WPBakery Page Builder' ),										
    ),
	
    array(
      'import_file_name'             	=> 'Modern 1',
      'import_widget_file_url'     		=> 'https://raw.githubusercontent.com/TemplatesNext/i-excel-demo/master/i-excel-shop.wie',
      'import_preview_image_url'     	=> trailingslashit( get_template_directory_uri() ) . 'inc/txoc/small-images/modern-1.jpg',
      'import_notice'                	=> __( 'This demo design is only available with premium theme I-SPIRIT.', 'i-craft' ),
	  'preview_url'                		=> 'http://www.wp-demos.com/ispirit/modern/',
	  'required_plugin'					=> '',
	  'categories'                 		=> array( 'Premium', 'WPBakery Page Builder' ),										
    ),	
    array(
      'import_file_name'             	=> 'Flat 1',
      'import_widget_file_url'     		=> 'https://raw.githubusercontent.com/TemplatesNext/i-excel-demo/master/i-excel-shop.wie',
      'import_preview_image_url'     	=> trailingslashit( get_template_directory_uri() ) . 'inc/txoc/small-images/flat-1.jpg',
      'import_notice'                	=> __( 'This demo design is only available with premium theme I-SPIRIT.', 'i-craft' ),
	  'preview_url'                		=> 'http://www.wp-demos.com/ispirit/flat/',
	  'required_plugin'					=> '',
	  'categories'                 		=> array( 'Premium', 'WPBakery Page Builder' ),										
    ),			
	
    array(
      'import_file_name'             	=> 'Shop 1',
      'import_widget_file_url'     		=> 'https://raw.githubusercontent.com/TemplatesNext/i-excel-demo/master/i-excel-shop.wie',
      'import_preview_image_url'     	=> trailingslashit( get_template_directory_uri() ) . 'inc/txoc/small-images/shop-1.jpg',
      'import_notice'                	=> __( 'This demo design is only available with premium theme I-SPIRIT.', 'i-craft' ),
	  'preview_url'                		=> 'http://www.wp-demos.com/ispirit/shop/',
	  'required_plugin'					=> '',
	  'categories'                 		=> array( 'Premium','WooCommerce', 'WPBakery Page Builder' ),										
    ),
    array(
      'import_file_name'             	=> 'Modern 2',
      'import_widget_file_url'     		=> 'https://raw.githubusercontent.com/TemplatesNext/i-excel-demo/master/i-excel-shop.wie',
      'import_preview_image_url'     	=> trailingslashit( get_template_directory_uri() ) . 'inc/txoc/small-images/modern-2.jpg',
      'import_notice'                	=> __( 'This demo design is only available with premium theme I-SPIRIT.', 'i-craft' ),
	  'preview_url'                		=> 'http://www.wp-demos.com/ispirit/modern/home-visual-composer/',
	  'required_plugin'					=> '',
	  'categories'                 		=> array( 'Premium', 'WPBakery Page Builder' ),										
    ),	
    array(
      'import_file_name'             	=> 'Classic MAX',
      'import_widget_file_url'     		=> 'https://raw.githubusercontent.com/TemplatesNext/i-excel-demo/master/i-excel-shop.wie',
      'import_preview_image_url'     	=> trailingslashit( get_template_directory_uri() ) . 'inc/txoc/small-images/classic-max.jpg',
      'import_notice'                	=> __( 'This demo design is only available with premium theme I-SPIRIT.', 'i-craft' ),
	  'preview_url'                		=> 'http://www.wp-demos.com/ispirit/classic/classic-max',
	  'required_plugin'					=> '',
	  'categories'                 		=> array( 'Premium', 'WPBakery Page Builder' ),										
    ),	
    array(
      'import_file_name'             	=> 'Classic 2',
      'import_widget_file_url'     		=> 'https://raw.githubusercontent.com/TemplatesNext/i-excel-demo/master/i-excel-shop.wie',
      'import_preview_image_url'     	=> trailingslashit( get_template_directory_uri() ) . 'inc/txoc/small-images/classic-2.jpg',
      'import_notice'                	=> __( 'This demo design is only available with premium theme I-SPIRIT.', 'i-craft' ),
	  'preview_url'                		=> 'http://www.wp-demos.com/ispirit/classic/nx-front/',
	  'required_plugin'					=> '',
	  'categories'                 		=> array( 'Premium', 'WPBakery Page Builder' ),										
    ),
	
    array(
      'import_file_name'             	=> 'Shop 2',
      'import_widget_file_url'     		=> 'https://raw.githubusercontent.com/TemplatesNext/i-excel-demo/master/i-excel-shop.wie',
      'import_preview_image_url'     	=> trailingslashit( get_template_directory_uri() ) . 'inc/txoc/small-images/shop-2.jpg',
      'import_notice'                	=> __( 'This demo design is only available with premium theme I-SPIRIT.', 'i-craft' ),
	  'preview_url'                		=> 'http://www.wp-demos.com/ispirit/shop/nx-shop/',
	  'required_plugin'					=> '',
	  'categories'                 		=> array( 'Premium','WooCommerce', 'WPBakery Page Builder' ),										
    ),	
    array(
      'import_file_name'             	=> 'Flat 2',
      'import_widget_file_url'     		=> 'https://raw.githubusercontent.com/TemplatesNext/i-excel-demo/master/i-excel-shop.wie',
      'import_preview_image_url'     	=> trailingslashit( get_template_directory_uri() ) . 'inc/txoc/small-images/flat-2.jpg',
      'import_notice'                	=> __( 'This demo design is only available with premium theme I-SPIRIT.', 'i-craft' ),
	  'preview_url'                		=> 'http://www.wp-demos.com/ispirit/flat/home-fullscreen-image-slider/',
	  'required_plugin'					=> '',
	  'categories'                 		=> array( 'Premium', 'WPBakery Page Builder' ),										
    ),	
    array(
      'import_file_name'             	=> 'Modern MAX',
      'import_widget_file_url'     		=> 'https://raw.githubusercontent.com/TemplatesNext/i-excel-demo/master/i-excel-shop.wie',
      'import_preview_image_url'     	=> trailingslashit( get_template_directory_uri() ) . 'inc/txoc/small-images/modern-max.jpg',
      'import_notice'                	=> __( 'This demo design is only available with premium theme I-SPIRIT.', 'i-craft' ),
	  'preview_url'                		=> 'http://www.wp-demos.com/ispirit/modern/home-halfscreen-slider-3/',
	  'required_plugin'					=> '',
	  'categories'                 		=> array( 'Premium', 'WPBakery Page Builder' ),										
    ),	
		
	
  );
}
add_filter( 'pt-ocdi/import_files', 'icraft_import_files' );

add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );

function icraft_after_import_setup($selected_import) {
	
	if ( 'Elementor Slider' === $selected_import['import_file_name'] ) {

		$main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );
	
		set_theme_mod( 'nav_menu_locations', array(
				'primary' => $main_menu->term_id,
			)
		);
		
		$front_page_id = get_page_by_title( 'Home' );
		$blog_page_id  = get_page_by_title( 'Blog' );
				
       	if ( isset( $front_page_id->ID ) ) {
			update_option( 'page_on_front', $front_page_id->ID );
        	update_option( 'show_on_front', 'page' );
			update_option( 'page_for_posts', $blog_page_id->ID );			
       	}		
		
	} elseif ( 'Restaurant' === $selected_import['import_file_name'] ) {

		$main_menu = get_term_by( 'name', 'Main Navigation', 'nav_menu' );
	
		set_theme_mod( 'nav_menu_locations', array(
				'primary' => $main_menu->term_id,
			)
		);
		
		$front_page_id = get_page_by_title( 'Home' );
       	if ( isset( $front_page_id->ID ) ) {
			update_option( 'page_on_front', $front_page_id->ID );
        	update_option( 'show_on_front', 'page' );
       	}		
		
	} elseif ( 'Small Business' === $selected_import['import_file_name'] ) {

		$main_menu = get_term_by( 'name', 'Main Navigation', 'nav_menu' );
	
		set_theme_mod( 'nav_menu_locations', array(
				'primary' => $main_menu->term_id,
			)
		);
		
		$front_page_id = get_page_by_title( 'Front Page' );
       	if ( isset( $front_page_id->ID ) ) {
			update_option( 'page_on_front', $front_page_id->ID );
        	update_option( 'show_on_front', 'page' );
       	}		
		
	} elseif ( 'Personal' === $selected_import['import_file_name'] ) {

		$main_menu = get_term_by( 'name', 'Main Navigation', 'nav_menu' );
	
		set_theme_mod( 'nav_menu_locations', array(
				'primary' => $main_menu->term_id,
			)
		);
		
		$front_page_id = get_page_by_title( 'Home' );
       	if ( isset( $front_page_id->ID ) ) {
			update_option( 'page_on_front', $front_page_id->ID );
        	update_option( 'show_on_front', 'page' );
       	}		
		
	} elseif ( 'Multilingual' === $selected_import['import_file_name'] ) {
		
		if ( class_exists( 'PLL_Model' ) ) {
			
			$polylang_options = get_option( 'polylang');			
			if( !array_key_exists('default_lang', $polylang_options) ) {
				
				$polylang_options['default_lang'] = 'en';
				update_option( 'polylang', $polylang_options );
								
			}		
		}			

		$main_menu = get_term_by( 'name', 'Main Navigation', 'nav_menu' );
		$main_menu_de = get_term_by( 'name', 'Main Navigation De', 'nav_menu' );
		$main_menu_ru = get_term_by( 'name', 'Main Navigation Ru', 'nav_menu' );		
	
		set_theme_mod( 'nav_menu_locations', array(
				'primary' => $main_menu->term_id,
				'primary___de' => $main_menu_de->term_id,
				'primary___ru' => $main_menu_ru->term_id,				
			)
		);
		
		$front_page_id = get_page_by_title( 'Home' );
       	if ( isset( $front_page_id->ID ) ) {
			update_option( 'page_on_front', $front_page_id->ID );
        	update_option( 'show_on_front', 'page' );
       	}		
		
	} elseif ( 'RTL' === $selected_import['import_file_name'] ) {

		$main_menu = get_term_by( 'name', 'Main Navigation', 'nav_menu' );
	
		set_theme_mod( 'nav_menu_locations', array(
				'primary' => $main_menu->term_id,
			)
		);
		
		$front_page_id = get_page_by_title( 'Home' );
       	if ( isset( $front_page_id->ID ) ) {
			update_option( 'page_on_front', $front_page_id->ID );
        	update_option( 'show_on_front', 'page' );
       	}		
		
	} elseif ( 'SEO' === $selected_import['import_file_name'] ) {

		$main_menu = get_term_by( 'name', 'Main Navigation', 'nav_menu' );
	
		set_theme_mod( 'nav_menu_locations', array(
				'primary' => $main_menu->term_id,
			)
		);
		
		$front_page_id = get_page_by_title( 'Front Page' );
       	if ( isset( $front_page_id->ID ) ) {
			update_option( 'page_on_front', $front_page_id->ID );
        	update_option( 'show_on_front', 'page' );
       	}		
		
	} elseif ( 'Church' === $selected_import['import_file_name'] ) {

		$main_menu = get_term_by( 'name', 'Main Navigation', 'nav_menu' );
	
		set_theme_mod( 'nav_menu_locations', array(
				'primary' => $main_menu->term_id,
			)
		);
		
		$front_page_id = get_page_by_title( 'Home' );
       	if ( isset( $front_page_id->ID ) ) {
			update_option( 'page_on_front', $front_page_id->ID );
        	update_option( 'show_on_front', 'page' );
       	}		
		
	} elseif ( 'Agency 1' === $selected_import['import_file_name'] ) {

		// Assign menus to their locations.
			$main_menu = get_term_by( 'name', 'i-craft Main Nav', 'nav_menu' );
	
			set_theme_mod( 'nav_menu_locations', array(
				'primary' => $main_menu->term_id,
			)
		);
		
		$front_page_id = get_page_by_title( 'Agency 1' );
       	if ( isset( $front_page_id->ID ) ) {
			update_option( 'page_on_front', $front_page_id->ID );
        	update_option( 'show_on_front', 'page' );
       	}		
		
	} elseif ( 'Agency 2' === $selected_import['import_file_name'] ) {
	
		// Assign menus to their locations.
		$main_menu = get_term_by( 'name', 'i-craft Main Nav', 'nav_menu' );
		set_theme_mod( 'nav_menu_locations', array(
				'primary' => $main_menu->term_id,
			)
		);
		
		$front_page_id = get_page_by_title( 'Agency 2' );
       	if ( isset( $front_page_id->ID ) ) {
			update_option( 'page_on_front', $front_page_id->ID );
        	update_option( 'show_on_front', 'page' );
       	}			
	
	} elseif ( 'Agency 3' === $selected_import['import_file_name'] ) {
	
		// Assign menus to their locations.
		$main_menu = get_term_by( 'name', 'Main Navigation', 'nav_menu' );
		set_theme_mod( 'nav_menu_locations', array(
				'primary' => $main_menu->term_id,
			)
		);
		
		$front_page_id = get_page_by_title( 'Agency 3' );
       	if ( isset( $front_page_id->ID ) ) {
			update_option( 'page_on_front', $front_page_id->ID );
        	update_option( 'show_on_front', 'page' );
       	}			
	
	} elseif ( 'Agency 4' === $selected_import['import_file_name'] ) {
	
		// Assign menus to their locations.
		$main_menu = get_term_by( 'name', 'Main Navigation', 'nav_menu' );
		set_theme_mod( 'nav_menu_locations', array(
				'primary' => $main_menu->term_id,
			)
		);
		
		$front_page_id = get_page_by_title( 'Agency 4 PB' );
       	if ( isset( $front_page_id->ID ) ) {
			update_option( 'page_on_front', $front_page_id->ID );
        	update_option( 'show_on_front', 'page' );
       	}			
	
	} elseif ( 'Business Home 1' === $selected_import['import_file_name'] ) {
	
		// Assign menus to their locations.
		$main_menu = get_term_by( 'name', 'i-craft Main Nav', 'nav_menu' );
		set_theme_mod( 'nav_menu_locations', array(
				'primary' => $main_menu->term_id,
			)
		);
		
		$front_page_id = get_page_by_title( 'Business Home 1' );
       	if ( isset( $front_page_id->ID ) ) {
			update_option( 'page_on_front', $front_page_id->ID );
        	update_option( 'show_on_front', 'page' );
       	}			
	
	} elseif ( 'Fashion Shop 1' === $selected_import['import_file_name'] ) {

		// Assign menus to their locations.
			$main_menu = get_term_by( 'name', 'i-craft Main Nav', 'nav_menu' );
	
			set_theme_mod( 'nav_menu_locations', array(
				'primary' => $main_menu->term_id,
			)
		);
		
		$front_page_id = get_page_by_title( 'Fashion Shop 1' );
       	if ( isset( $front_page_id->ID ) ) {
			update_option( 'page_on_front', $front_page_id->ID );
        	update_option( 'show_on_front', 'page' );
       	}		
		
	} elseif ( 'Shop Shaurya' === $selected_import['import_file_name'] ) {
	
		// Assign menus to their locations.
		$main_menu = get_term_by( 'name', 'i-craft Main Nav', 'nav_menu' );
		set_theme_mod( 'nav_menu_locations', array(
				'primary' => $main_menu->term_id,
			)
		);
		
		$front_page_id = get_page_by_title( 'Shop Shaurya' );
       	if ( isset( $front_page_id->ID ) ) {
			update_option( 'page_on_front', $front_page_id->ID );
        	update_option( 'show_on_front', 'page' );
       	}			
	
	} elseif ( 'Craft-18 Shop' === $selected_import['import_file_name'] ) {
	
		// Assign menus to their locations.
		$main_menu = get_term_by( 'name', 'i-craft Main Nav', 'nav_menu' );
		set_theme_mod( 'nav_menu_locations', array(
				'primary' => $main_menu->term_id,
			)
		);
		
		$front_page_id = get_page_by_title( 'Craft-18 Shop' );
       	if ( isset( $front_page_id->ID ) ) {
			update_option( 'page_on_front', $front_page_id->ID );
        	update_option( 'show_on_front', 'page' );
       	}			
	
	} elseif ( 'School' === $selected_import['import_file_name'] ) {
	
		// Assign menus to their locations.
		$main_menu = get_term_by( 'name', 'Main Navigation', 'nav_menu' );
		set_theme_mod( 'nav_menu_locations', array(
				'primary' => $main_menu->term_id,
			)
		);
		
		$front_page_id = get_page_by_title( 'Graceland School' );
       	if ( isset( $front_page_id->ID ) ) {
			update_option( 'page_on_front', $front_page_id->ID );
        	update_option( 'show_on_front', 'page' );
       	}			
	
	} elseif ( 'Charity' === $selected_import['import_file_name'] ) {
	
		// Assign menus to their locations.
		$main_menu = get_term_by( 'name', 'Main Navigation', 'nav_menu' );
		set_theme_mod( 'nav_menu_locations', array(
				'primary' => $main_menu->term_id,
			)
		);
		
		$front_page_id = get_page_by_title( 'Vision Eartth' );
       	if ( isset( $front_page_id->ID ) ) {
			update_option( 'page_on_front', $front_page_id->ID );
        	update_option( 'show_on_front', 'page' );
       	}			
	
	} elseif ( 'Computer' === $selected_import['import_file_name'] ) {
	
		// Assign menus to their locations.
		$main_menu = get_term_by( 'name', 'Main Navigation', 'nav_menu' );
		set_theme_mod( 'nav_menu_locations', array(
				'primary' => $main_menu->term_id,
			)
		);
		
		$front_page_id = get_page_by_title( 'Computers 1' );
       	if ( isset( $front_page_id->ID ) ) {
			update_option( 'page_on_front', $front_page_id->ID );
        	update_option( 'show_on_front', 'page' );
       	}			
	
	}

}
add_action( 'pt-ocdi/after_import', 'icraft_after_import_setup' );

/* Delete The default Hello World Post before import */
/* Resetting default Widgets */
function icraft_before_content_import( $selected_import ) {
	wp_delete_post(1);
	update_option( 'sidebars_widgets', array() );
}
add_action( 'pt-ocdi/before_content_import', 'icraft_before_content_import' );

/* change title for page and menu */
function ocdi_plugin_page_setup( $default_settings ) {
    $default_settings['page_title']  = esc_html__( 'One Click Demo Set-up', 'i-craft' );
    $default_settings['menu_title']  = esc_html__( 'Theme Demo Setup' ,'i-craft' );
    return $default_settings;
}
add_filter( 'pt-ocdi/plugin_page_setup', 'ocdi_plugin_page_setup' );


/*
 * Polylang language switcher
 *
 * @since icraft 1.0.1
 */

function icraft_polylang_switcher(){

	$tb_plylang = 2;
	$tb_plylang = intval(get_theme_mod('show_polylang', '2'));
	//$tb_plylang = $ispirit_data['tb-polylang'];
	$tx_topbar_output = "";	
		
	if( $tb_plylang == 1 || $tb_plylang == 2 ) {
		$tx_topbar_output .= '<div class="tb-right tb-polylang">';
		$tx_topbar_output .= '<ul>';
		if( $tb_plylang == 1 ) {
			$tx_topbar_output .= pll_the_languages( array( 'show_flags' => 1,'show_names' => 0,'echo' => 0,'hide_current' => 1 ) );
		} else {
			$tx_topbar_output .= pll_the_languages( array( 'show_flags' => 1,'show_names' => 1,'echo' => 0,'hide_current' => 1 ) );
		}
		$tx_topbar_output .= '</ul>';
		$tx_topbar_output .= '</div>';
	}
	
	return $tx_topbar_output;
}


/* Calling Theme Welcome on activation */
require_once( get_template_directory() . '/inc/theme-welcome/theme-welcome.php' );
require_once( get_template_directory() . '/inc/txoc/txoc.php' );

/* activating all site origin widgets bundle */
function icraft_filter_active_widgets($active){
    $active['features'] = true;
    $active['icon'] = true;
	
    $active['button'] = true;	
    $active['layout-slider'] = true;	
    $active['social-media-buttons'] = true;	
    $active['call-to-action'] = true;
    $active['google-maps'] = true;	
    //$active['image'] = true;	
    //$active['post-carousel'] = true;	
    //$active['taxonomy'] = true;
    $active['contact'] = true;	
    $active['headline'] = true;	
    $active['image-grid'] = true;	
    $active['price-table'] = true;	
    $active['testimonial'] = true;	
    $active['editor'] = true;	
    $active['hero'] = true;	
    $active['image-slider'] = true;
    $active['simple-masonry'] = true;
    $active['video'] = true;		
	
    return $active;
}
add_filter('siteorigin_widgets_active_widgets', 'icraft_filter_active_widgets');