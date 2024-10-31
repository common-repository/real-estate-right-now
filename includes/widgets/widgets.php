<?php 
/**
 * @author Bill Minozzi
 * @copyright 2017
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
if(!function_exists('realestaterightnow_theme_thumb'))
{
    function realestaterightnow_theme_thumb($url, $width, $height=0, $align='') {
        if (get_the_post_thumbnail()=='') {
            $url = REALESTATERIGHTNOWIMAGES.'imagenoavailable.jpg';
        }
    return $url;
    }
}

function realestaterightnow_RecentWidget() {
	register_widget( 'realestaterightnow_RecentWidget' );
}
add_action( 'widgets_init', 'realestaterightnow_RecentWidget' );
class realestaterightnow_RecentWidget extends WP_Widget {
       public function __construct() {
        parent::__construct(
        'RecentWidget',         
        'Recent properties',                
        array( 'description' => __('A list of Recent properties', 'real-estate-right-now'), ) 
        );
    }   
	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'amount' => '','Fwidth' => '','Fheight' => '') );
        if(isset($instance['Ramount']))
          {$Ramount = $instance['Ramount'];}
        else
          {$Ramount = 3;}
		echo '<p>
			<label for="'.esc_attr($this->get_field_id('Ramount')).'">
				Number of properties to show: <input maxlength="1" size="1" id="'. esc_attr($this->get_field_id('Ramount')) .'" name="'. esc_attr($this->get_field_name('Ramount')) .'" type="text" value="'. esc_attr($Ramount) .'" />
			</label>
		</p>';
	}
	function update($new_instance, $old_instance) { 
		$instance = $old_instance;
        if(is_numeric($new_instance['Ramount']))
		    {$instance['Ramount'] = $new_instance['Ramount'];}
      	return $instance;
	}
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
		$Ramount = empty($instance['Ramount']) ? ' ' : apply_filters('widget_title', $instance['Ramount']); 
		if($Ramount == '') {$Ramount = 3; }
        ?>
	    <div class="sideTitle"> <?php echo esc_attr__('New Arrivals', 'real-estate-right-now');?> </div><?php 
		$args = array(
			'post_type'      => 'products',
			'order'    => 'DESC',
			'showposts' => $Ramount,
		);
        $_query3 = new WP_Query( $args );
    $output = '<div class="RealEstate-listing-wrap"> <div class="multiGallery">';
	while ($_query3->have_posts()) : $_query3->the_post();
		$image_id = get_post_thumbnail_id();
		$image_url = wp_get_attachment_image_src($image_id,'medium', true);	
        $price = get_post_meta(get_the_ID(), 'product-price', true);
            if (!empty($price))
                 {
                    $price = number_format_i18n($price, 0);
                    $price = realestaterightnow_currency() . $price;
                    }
            else
               $price =  __('Call for Price', 'real-estate-right-now');              
		$image = str_replace("-".$image_url[1]."x".$image_url[2], "", $image_url[0]);
		$featured = trim(get_post_meta(get_the_ID(), 'product-featured', true));
        $thumb = realestaterightnow_theme_thumb($image, 800, 600, 'br'); // Crops from bottom right
        $year = get_post_meta(get_the_ID(), 'product-year', true);
            $output .= '<div>';
            $output .=  '<a href="' . get_permalink() . '">';
            $output .= '<div class="realestaterightnow_gallery_2016_widget">';
            $output .=  '<img class="realestaterightnow_caption_img_widget" src="' . $thumb .'" alt="'. get_the_title() . '" />';
            $output .= '<div class="realestaterightnow_caption_text_widget">';
            $output .= $price;
            $output .= '<br />';
            $output .= ($year <> '' ? __('Year', 'real-estate-right-now') .': '. $year.'<br />' : '');
            $output .= '</div>';
            $output .= '<div class="multiTitle-widget">' . get_the_title() . '</div>';
            $output .= '</div>';
            $output .= '</a>';
            $output .= '</div>';     
            $output .= '<br />';        
		endwhile; 
        $output .= '</div></div>';
        $realestaterightnow_allowed_atts = array(
            'align'      => array(),
            'class'      => array(),
            'type'       => array(),
            'id'         => array(),
            'dir'        => array(),
            'lang'       => array(),
            'style'      => array(),
            'xml:lang'   => array(),
            'src'        => array(),
            'alt'        => array(),
            'href'       => array(),
            'rel'        => array(),
            'rev'        => array(),
            'target'     => array(),
            'novalidate' => array(),
            'type'       => array(),
            'value'      => array(),
            'name'       => array(),
            'tabindex'   => array(),
            'action'     => array(),
            'method'     => array(),
            'for'        => array(),
            'width'      => array(),
            'height'     => array(),
            'data'       => array(),
            'title'      => array(),
        
            'checked' => array(),
            'selected' => array(),
        
        
        );
        
        
        
        
        $realestaterightnow_my_allowed['form'] = $realestaterightnow_allowed_atts ;
        $realestaterightnow_my_allowed['select'] = $realestaterightnow_allowed_atts ;
        // select options
        $realestaterightnow_my_allowed['option'] = $realestaterightnow_allowed_atts ;
        $realestaterightnow_my_allowed['style'] = $realestaterightnow_allowed_atts ;
        $realestaterightnow_my_allowed['label'] = $realestaterightnow_allowed_atts ;
        $realestaterightnow_my_allowed['input'] = $realestaterightnow_allowed_atts ;
        $realestaterightnow_my_allowed['textarea'] = $realestaterightnow_allowed_atts ;
        
        //more...future...
        $realestaterightnow_my_allowed['form']     = $realestaterightnow_allowed_atts ;
        $realestaterightnow_my_allowed['label']    = $realestaterightnow_allowed_atts ;
        $realestaterightnow_my_allowed['input']    = $realestaterightnow_allowed_atts ;
        $realestaterightnow_my_allowed['textarea'] = $realestaterightnow_allowed_atts ;
        $realestaterightnow_my_allowed['iframe']   = $realestaterightnow_allowed_atts ;
        $realestaterightnow_my_allowed['script']   = $realestaterightnow_allowed_atts ;
        $realestaterightnow_my_allowed['style']    = $realestaterightnow_allowed_atts ;
        $realestaterightnow_my_allowed['strong']   = $realestaterightnow_allowed_atts ;
        $realestaterightnow_my_allowed['small']    = $realestaterightnow_allowed_atts ;
        $realestaterightnow_my_allowed['table']    = $realestaterightnow_allowed_atts ;
        $realestaterightnow_my_allowed['span']     = $realestaterightnow_allowed_atts ;
        $realestaterightnow_my_allowed['abbr']     = $realestaterightnow_allowed_atts ;
        $realestaterightnow_my_allowed['code']     = $realestaterightnow_allowed_atts ;
        $realestaterightnow_my_allowed['pre']      = $realestaterightnow_allowed_atts ;
        $realestaterightnow_my_allowed['div']      = $realestaterightnow_allowed_atts ;
        $realestaterightnow_my_allowed['img']      = $realestaterightnow_allowed_atts ;
        $realestaterightnow_my_allowed['h1']       = $realestaterightnow_allowed_atts ;
        $realestaterightnow_my_allowed['h2']       = $realestaterightnow_allowed_atts ;
        $realestaterightnow_my_allowed['h3']       = $realestaterightnow_allowed_atts ;
        $realestaterightnow_my_allowed['h4']       = $realestaterightnow_allowed_atts ;
        $realestaterightnow_my_allowed['h5']       = $realestaterightnow_allowed_atts ;
        $realestaterightnow_my_allowed['h6']       = $realestaterightnow_allowed_atts ;
        $realestaterightnow_my_allowed['ol']       = $realestaterightnow_allowed_atts ;
        $realestaterightnow_my_allowed['ul']       = $realestaterightnow_allowed_atts ;
        $realestaterightnow_my_allowed['li']       = $realestaterightnow_allowed_atts ;
        $realestaterightnow_my_allowed['em']       = $realestaterightnow_allowed_atts ;
        $realestaterightnow_my_allowed['hr']       = $realestaterightnow_allowed_atts ;
        $realestaterightnow_my_allowed['br']       = $realestaterightnow_allowed_atts ;
        $realestaterightnow_my_allowed['tr']       = $realestaterightnow_allowed_atts ;
        $realestaterightnow_my_allowed['td']       = $realestaterightnow_allowed_atts ;
        $realestaterightnow_my_allowed['p']        = $realestaterightnow_allowed_atts ;
        $realestaterightnow_my_allowed['a']        = $realestaterightnow_allowed_atts ;
        $realestaterightnow_my_allowed['b']        = $realestaterightnow_allowed_atts ;
        $realestaterightnow_my_allowed['i']        = $realestaterightnow_allowed_atts ;
         
        
        echo wp_kses($output, $realestaterightnow_my_allowed);
        //echo $output;

	}
}
function realestaterightnow_FeaturedWidget() {
	register_widget( 'realestaterightnow_FeaturedWidget' );
}
add_action( 'widgets_init', 'realestaterightnow_FeaturedWidget' );
class realestaterightnow_featuredWidget extends WP_Widget {
    public function __construct() {
        parent::__construct(
        'FeaturedWidget',         
        'Featured properties',                
        array( 'description' => __('A list of Featured products', 'real-estate-right-now'), ) 
        );
    } 
	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'amount' => '') );
		$amount = $instance['amount'];
		echo '<p>
			<label for="'. esc_attr($this->get_field_id('amount')).'">
				Number of properties to show: <input maxlength="1" size="1" id="'. esc_attr($this->get_field_id('amount')) .'" name="'. esc_attr($this->get_field_name('amount')) .'" type="text" value="'. esc_attr($amount) .'" maxlength="3" size="3" />
			</label>
		</p>';
	}
	function update($new_instance, $old_instance) { 
		$instance = $old_instance;
        if(is_numeric($new_instance['amount']))
		    {$instance['amount'] = $new_instance['amount'];}       
		return $instance;
	}
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
		$amount = empty($instance['amount']) ? ' ' : apply_filters('widget_title', $instance['amount']); 
		if($amount == '') {$amount = 3; }
    ?>
        <div class="sideTitle"> 
        <?php echo esc_attr__('Featured properties', 'real-estate-right-now');?> 
        </div><?php 
		$args = array(
			'post_type'      => 'products',
			'order'    => 'DESC',
			'showposts' => $amount,
			'meta_query' => array(
								array(
										'key' => 'product-featured',
										'value' => 'enabled',
									  )
								   )
		);
        $_query2 = new WP_Query( $args );
		$output = '<div class="RealEstate-listing-wrap"> <div class="multiGallery">';
		while ($_query2->have_posts()) : $_query2->the_post();
		$image_id = get_post_thumbnail_id();
		$image_url = wp_get_attachment_image_src($image_id,'medium', true);	
        $price = trim(get_post_meta(get_the_ID(), 'product-price', true));
        if(! empty($price))
           $price = number_format_i18n($price);
        $price = get_post_meta(get_the_ID(), 'product-price', true);
            if (!empty($price))
                 {
                    $price = number_format_i18n($price, 0);
                    $price = realestaterightnow_currency() . $price;
                    }
            else
               $price =  __('Call for Price', 'real-estate-right-now');              
        $image = str_replace("-".$image_url[1]."x".$image_url[2], "", $image_url[0]);
        $featured = get_post_meta(get_the_ID(), 'product-featured', true);
        $thumb = realestaterightnow_theme_thumb($image, 800, 600, 'br'); // Crops from bottom right
        $year = get_post_meta(get_the_ID(), 'product-year', true);
            $output .= '<div>';
            $output .=  '<a href="' . get_permalink() . '">';
            $output .= '<div class="realestaterightnow_gallery_2016_widget">';
            $output .=  '<img class="realestaterightnow_caption_img_widget" src="' . $thumb .'" alt="'. get_the_title() . '" />';
            $output .= '<div class="realestaterightnow_caption_text_widget">';
            $output .= $price;
            $output .= '<br />';
            $output .= ($year <> '' ? __('Year', 'real-estate-right-now') .': '. $year : '');
            $output .= '</div>';
            $output .= '<div class="multiTitle-widget">' . get_the_title() . '</div>';
            $output .= '</div>';
            $output .= '</a>';
            $output .= '</div>';     
            $output .= '<br />';
        endwhile; 
        $output .= '</div></div>';
        $realestaterightnow_allowed_atts = array(
            'align'      => array(),
            'class'      => array(),
            'type'       => array(),
            'id'         => array(),
            'dir'        => array(),
            'lang'       => array(),
            'style'      => array(),
            'xml:lang'   => array(),
            'src'        => array(),
            'alt'        => array(),
            'href'       => array(),
            'rel'        => array(),
            'rev'        => array(),
            'target'     => array(),
            'novalidate' => array(),
            'type'       => array(),
            'value'      => array(),
            'name'       => array(),
            'tabindex'   => array(),
            'action'     => array(),
            'method'     => array(),
            'for'        => array(),
            'width'      => array(),
            'height'     => array(),
            'data'       => array(),
            'title'      => array(),
        
            'checked' => array(),
            'selected' => array(),
        
        
        );
        
        
        
        
        $realestaterightnow_my_allowed['form'] = $realestaterightnow_allowed_atts ;
        $realestaterightnow_my_allowed['select'] = $realestaterightnow_allowed_atts ;
        // select options
        $realestaterightnow_my_allowed['option'] = $realestaterightnow_allowed_atts ;
        $realestaterightnow_my_allowed['style'] = $realestaterightnow_allowed_atts ;
        $realestaterightnow_my_allowed['label'] = $realestaterightnow_allowed_atts ;
        $realestaterightnow_my_allowed['input'] = $realestaterightnow_allowed_atts ;
        $realestaterightnow_my_allowed['textarea'] = $realestaterightnow_allowed_atts ;
        
        //more...future...
        $realestaterightnow_my_allowed['form']     = $realestaterightnow_allowed_atts ;
        $realestaterightnow_my_allowed['label']    = $realestaterightnow_allowed_atts ;
        $realestaterightnow_my_allowed['input']    = $realestaterightnow_allowed_atts ;
        $realestaterightnow_my_allowed['textarea'] = $realestaterightnow_allowed_atts ;
        $realestaterightnow_my_allowed['iframe']   = $realestaterightnow_allowed_atts ;
        $realestaterightnow_my_allowed['script']   = $realestaterightnow_allowed_atts ;
        $realestaterightnow_my_allowed['style']    = $realestaterightnow_allowed_atts ;
        $realestaterightnow_my_allowed['strong']   = $realestaterightnow_allowed_atts ;
        $realestaterightnow_my_allowed['small']    = $realestaterightnow_allowed_atts ;
        $realestaterightnow_my_allowed['table']    = $realestaterightnow_allowed_atts ;
        $realestaterightnow_my_allowed['span']     = $realestaterightnow_allowed_atts ;
        $realestaterightnow_my_allowed['abbr']     = $realestaterightnow_allowed_atts ;
        $realestaterightnow_my_allowed['code']     = $realestaterightnow_allowed_atts ;
        $realestaterightnow_my_allowed['pre']      = $realestaterightnow_allowed_atts ;
        $realestaterightnow_my_allowed['div']      = $realestaterightnow_allowed_atts ;
        $realestaterightnow_my_allowed['img']      = $realestaterightnow_allowed_atts ;
        $realestaterightnow_my_allowed['h1']       = $realestaterightnow_allowed_atts ;
        $realestaterightnow_my_allowed['h2']       = $realestaterightnow_allowed_atts ;
        $realestaterightnow_my_allowed['h3']       = $realestaterightnow_allowed_atts ;
        $realestaterightnow_my_allowed['h4']       = $realestaterightnow_allowed_atts ;
        $realestaterightnow_my_allowed['h5']       = $realestaterightnow_allowed_atts ;
        $realestaterightnow_my_allowed['h6']       = $realestaterightnow_allowed_atts ;
        $realestaterightnow_my_allowed['ol']       = $realestaterightnow_allowed_atts ;
        $realestaterightnow_my_allowed['ul']       = $realestaterightnow_allowed_atts ;
        $realestaterightnow_my_allowed['li']       = $realestaterightnow_allowed_atts ;
        $realestaterightnow_my_allowed['em']       = $realestaterightnow_allowed_atts ;
        $realestaterightnow_my_allowed['hr']       = $realestaterightnow_allowed_atts ;
        $realestaterightnow_my_allowed['br']       = $realestaterightnow_allowed_atts ;
        $realestaterightnow_my_allowed['tr']       = $realestaterightnow_allowed_atts ;
        $realestaterightnow_my_allowed['td']       = $realestaterightnow_allowed_atts ;
        $realestaterightnow_my_allowed['p']        = $realestaterightnow_allowed_atts ;
        $realestaterightnow_my_allowed['a']        = $realestaterightnow_allowed_atts ;
        $realestaterightnow_my_allowed['b']        = $realestaterightnow_allowed_atts ;
        $realestaterightnow_my_allowed['i']        = $realestaterightnow_allowed_atts ;
         
        
        echo wp_kses($output, $realestaterightnow_my_allowed); 
        //echo $output;
	}
}
if (version_compare(phpversion(), '7.02.00', '>=')) 
 add_action( 'widgets_init', function() {return register_widget("realestaterightnow_SearchWidget");} );
else
 add_action( 'widgets_init', create_function('', 'return register_widget("realestaterightnow_SearchWidget");') );
class realestaterightnow_SearchWidget extends WP_Widget {
public function __construct() {
        parent::__construct(
        'SearchWidget',         
        'Search properties',                
        array( 'description' => __('Search properties', 'real-estate-right-now'), ) 
        );
}     
	function SearchWidget()	{
		$widget_ops = array('classname' => 'SearchWidget', 'description' => 'Search Cars' );
		$this->WP_Widget('SearchWidget', 'Search Widget', $widget_ops);
	}
	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'realestaterightnow_search_name' => '') );
		$realestaterightnow_search_name = $instance['realestaterightnow_search_name'];
		echo '<p>
			<label for="'. esc_attr($this->get_field_id('realestaterightnow_search_name')).'">';
				echo esc_attr__('Title', 'real-estate-right-now');
                echo ': <input class="widefat" id="'. esc_attr($this->get_field_id('realestaterightnow_search_name')) .'" name="'. esc_attr($this->get_field_name('realestaterightnow_search_name')) .'" type="text" value="'. esc_attr($realestaterightnow_search_name) .'" />
			</label>
		</p>';
	}
	function update($new_instance, $old_instance) { 
		$instance = $old_instance;
		$instance['realestaterightnow_search_name'] = $new_instance['realestaterightnow_search_name'];
		return $instance;
	}
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
		$realestaterightnow_search_name = empty($instance['realestaterightnow_search_name']) ? ' ' : apply_filters('widget_title', $instance['realestaterightnow_search_name']); 
		if(trim($realestaterightnow_search_name) == '') {$realestaterightnow_search_name = __('Search', 'real-estate-right-now'); }        
        echo '<div class="sideTitle">';
        echo esc_attr($realestaterightnow_search_name);
        echo '</div>';        
		echo esc_attr(realestaterightnow_search(0));
	}   
}