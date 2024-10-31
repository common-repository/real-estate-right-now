<?php 
/**
 * @author Bill Minozzi
 * @copyright 2017 - 2024
 */
function realestaterightnow_maps()
{
    $googleapi = get_option('realestaterightnow_googlemapsapi'); 
    if (empty($googleapi))
       return;

    $post_product_id = get_the_ID(); 
    $googlemapname = realestaterightnow_findglooglemap();
    $value = get_post_meta($post_product_id, $googlemapname, true);
    if (empty($value) || gettype($value) != 'string')
        return;

    $googlemap = explode(PHP_EOL, $value);
    $googlemap_latitude = isset($googlemap[0]) ? $googlemap[0] : '';
    $googlemap_longitude = isset($googlemap[1]) ? $googlemap[1] : '';
    $googlemap_zoom = isset($googlemap[2]) ? $googlemap[2] : '';

    if (!empty($googlemap_latitude) && !empty($googlemap_longitude) && !empty($googlemap_zoom))
    {
        echo '<div id="realestaterightnow_googleMap"></div>';
        ?>  
        <script>
          function realestaterightnow_initMap() {

            
            var guluru = {lat: <?php echo esc_attr($googlemap_latitude);?>, lng: <?php echo esc_attr($googlemap_longitude);?>};
            const map = new google.maps.Map(document.getElementById('realestaterightnow_googleMap'), {
              zoom: <?php echo esc_attr($googlemap_zoom);?>,
              center: guluru,
              mapId: "DEMO_MAP_ID" // Map ID is required for advanced markers.
            });
            

            var marker = new google.maps.Marker({
              position: guluru,
              map: map,
              title: 'Uluru'
            });

            /*
            // in future...
              // The advanced marker, positioned at Uluru
              const marker = new google.maps.marker.AdvancedMarkerElement({
                  map,
                  position: guluru,
                  title: 'Uluru',
              });
              */
          }

          // Load Google Maps API asynchronously
          function realestaterightnow_loadGoogleMaps() {
            var script = document.createElement('script');
            script.src = 'https://maps.googleapis.com/maps/api/js?key=<?php echo esc_attr($googleapi);?>&loading=async&callback=realestaterightnow_initMap';
            script.async = true;
            document.body.appendChild(script);
          }

          // Call realestaterightnow_loadGoogleMaps() when the page has finished loading
          window.addEventListener('load', realestaterightnow_loadGoogleMaps);
        </script>
        <?php
    }   
    return true;
}
function realestaterightnow_content_detail(){
    $post_product_id = get_the_ID();
    ?>
    <div class="multi-content">
        <div id="sliderWrapper">
                 <?php
                   if (get_post_meta(get_the_ID(), 'product-address', true) != '') { 
                         $address = trim(get_post_meta(get_the_ID(), 'product-address', 'true'));
                         if(! empty($address)) 
                         {
                           echo '<div class="featuredTitle">'; 
                           echo '&nbsp;&nbsp;&nbsp;';
                           echo esc_attr__('Address', 'real-estate-right-now').': ';  
                          // echo esc_attr($term1->name);
                           echo esc_attr($address);
                           echo '</div><br />'; 
                         } 
                   }
                 realestaterightnow_maps();
                 $terms3 = get_the_terms( get_the_id(), 'locations');
                 
                 if(gettype($terms3) == 'array'){  
                  $term3 = $terms3[0]; 
                  if(is_object($term3))
                      {
                          $have_locations[] =  $term3->name; 
                      } 
                  }


                 ?>
             <div class="featuredTitle"> 
             <?php echo esc_attr__('Details', 'real-estate-right-now');?> </div>
  			 <div class="featuredCar">
             <?php 
              if (get_post_meta($post_product_id, 'product-beds', 'true') != '') { ?>
             <div class="featuredList">             
             <span class="carBold"> <?php echo esc_attr__('Beds', 'real-estate-right-now');?>: </span><?php echo esc_attr(get_post_meta($post_product_id, 'product-beds', 'true'));
              ?> 
             </div><!-- End of featured list -->
             <?php }
              if (get_post_meta($post_product_id, 'product-baths', 'true') != '') { ?>
             <div class="featuredList">             
             <span class="carBold"> <?php echo esc_attr__('Baths', 'real-estate-right-now');?>: </span><?php echo esc_attr(get_post_meta($post_product_id, 'product-baths', 'true'));
             ?> 
             </div><!-- End of featured list -->
             <?php }
             if (get_post_meta($post_product_id, 'product-area', 'true') != '') { ?>
             <div class="featuredList">             
             <span class="carBold"> 
             <?php 
            $realestaterightnow_measure = get_option('realestaterightnow_measure', 'M2');
            echo esc_html($realestaterightnow_measure); 
            ?>:

            
            
            </span><?php echo esc_attr(get_post_meta($post_product_id, 'product-area', 'true'));
             ?> 
             </div><!-- End of featured list -->
             <?php }
        $afieldsId = realestaterightnow_get_fields('all');
        $totfields = count($afieldsId);
        $ametadataoptions = array();
        for ($i = 0; $i < $totfields; $i++) {
            $post_id = $afieldsId[$i];
            $ametadata = realestaterightnow_get_meta($post_id);        
            if (!empty($ametadata[0]))
                $label = $ametadata[0];
            else
                $label = $ametadata[12];
            $field_id = 'product-'.$ametadata[12];
            $value = get_post_meta($post_product_id, $field_id, true);
             $typefield = $ametadata[1];
             if ($value != '' and $typefield != 'googlemap' ) 
             { 
                 if ($typefield == 'checkbox')
                 {
                   if($value == 'enabled')
                     $value = esc_attr__('Yes', 'real-estate-right-now');
                   else
                     $value = esc_attr__('No', 'real-estate-right-now');
                 }
                  ?>
                 <div class="featuredList">             
                 <span class="multiBold"> <?php echo esc_attr($label);?>: </span><?php echo '<b>'.esc_attr($value).'</b>';?> 
                 </div><!-- End of featured list --><?php }
             }
             ?>
             </div><!-- End of featured multi -->
             </div> <!-- end of Slider Content --> 
             </div> <!-- end of Slider Wrapper -->  
     <?php }
 function realestaterightnow_content_info () { ?>
 <div class="contentInfo">
         <div class="multiPriceSingle">
         	<?php 
            $price = get_post_meta(get_the_ID(), 'product-price', true);
           if ($price <> '' and $price != '0')
             { 
                $price =   number_format_i18n($price,0);
                $price = realestaterightnow_currency() . $price;
             }
             else
                $price =  esc_attr__('Call for Price', 'real-estate-right-now'); 
            echo esc_attr($price);
    		?> 
         </div>
         <div class="multiPurposeSingle">
         	<?php 
            $purpose = get_post_meta(get_the_ID(), 'product-purpose', true);
    		// die($year);
            if ( $purpose <> '') 
               echo esc_attr($purpose);
    			// echo esc_attr__($purpose, 'real-estate-right-now');
         
    		?> 
         </div>
         <div class="multiYearSingle">
         	<?php 
            $year = get_post_meta(get_the_ID(), 'product-year', true);
    		// die($year);
            if ( $year <> '') 
    			echo esc_attr__('Year', 'real-estate-right-now').': '.esc_attr($year);
    		?> 
         </div>
         <div class="multiContent">
         	<?php the_content(); ?>
         </div> 
            <?php 
            $year = get_post_meta(get_the_ID(), 'multi-year', 'true'); 
            if($year)
            { ?>
            <div class="multiDetail">
                 <?php echo esc_attr__('Year', 'real-estate-right-now').': ';
                   echo esc_attr($year); 
                ?>
                <!--
                <div class="multiBasicRow"><span class="singleInfo"><?php echo esc_attr(get_option('realestaterightnow_measure'), 'real-estate-right-now')?>: </span> <?php echo esc_attr(get_post_meta(get_the_ID(), 'multi-miles', 'true')); ?></div>
                <div class="multiBasicRow"><span class="singleInfo"><?php echo esc_attr__('Cond', 'real-estate-right-now');?>: </span> <?php echo esc_attr(get_post_meta(get_the_ID(), 'multi-con', 'true')); ?></div>
                <div class="multiBasicRow"><span class="singleInfo"><?php echo esc_attr__('HP', 'real-estate-right-now');?>:&nbsp; </span> <?php echo esc_attr(get_post_meta(get_the_ID(), 'multi-hp', 'true')); ?></div>
                -->
            </div>
            <?php } ?> 
 </div>	 
 <?php }
 //
function realestaterightnow_detail() {
  echo '<div class="multi-content">';
	while ( have_posts() ) : the_post(); 
       realestaterightnow_title_detail();
       realestaterightnow_content_info (); 
      ?> 
     <div class="multicontentWrap">
	 <?php realestaterightnow_content_detail (); ?>
     </div><?php
     break;
	 endwhile; // end of the loop.
     echo '</div>';
}
function realestaterightnow_title_detail(){
global $realestaterightnow_the_title;
   $realestaterightnow_the_title = get_the_title(); ?>
    <div class="multi-detail-title">  <?php the_title(); ?> </div>
<?php }
if(!function_exists('realestaterightnow_theme_thumb'))
{
    function realestaterightnow_theme_thumb($url, $width, $height=0, $align='') {
        if (get_the_post_thumbnail()=='') {
            $url = REALESTATERIGHTNOWIMAGES.'imagenoavailable.jpg';
        }
    return $url;
    }
}
function realestaterightnow_profile()
{
global $post;
$terms = get_the_terms( $post->ID, 'agents' );
 if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
    foreach ( $terms as $term ) {
    }
 }
 if( !isset($term->term_id))
    return;
  $termId = $term->term_id;
 //echo 'certo: '.$termId;
 //echo '<hr>';
/* 
 $agents_custom_fields = get_option( "taxonomy_term_$termId" );  
die("taxonomy_term_$termId");
die('xx '.$agents_custom_fields);
*/
 $termName = $term->name;
  //echo 'Name: '. $termName;
 // echo '<hr>';
 $termMeta = get_option( 'agents_' . $termId );
// print_r($termMeta);
 // print_r($termMeta);
  echo '<div class = "realestaterightnow_profile">';
    echo '<div class = "realestaterightnow_wrapprofile">';
      echo '<div class = "realestaterightnow_fotoprofile">';
          if(! empty($termMeta['image']))
          {
            echo '<img class = "reatestateimg-circle" src="'.esc_attr($termMeta["image"]).'"  />';
          }
          else
          {
             $image = REALESTATERIGHTNOWIMAGES . 'imagenoavailable800x400_br.jpg';
             echo '<img class = "reatestateimg-circle" src="'.esc_attr($image).'"  />';
          }
      echo '</div>'; 
     echo '<div class = "realestaterightnow_textoprofile">';
      echo '<div class = "realestaterightnow_nameprofile">';
      //if(!empty($termName)){ esc_attr_e($termName,'real-estate-right-now'); }
      if(!empty($termName)){ esc_attr($termName); }
      echo '</div>';
      echo '<div class = "realestaterightnow_titleprofile">';
      //if(!empty($termMeta['function'])){ esc_attr_e($termMeta['function'],'real-estate-right-now'); }
      if(!empty($termMeta['function'])){ esc_attr($termMeta['function']); }
 
      echo '</div>';     
      echo '<div class = "realestaterightnow_descriptionprofile">';
      //echo substr(term_description( $termId, 'agents' ),0,140);
      echo esc_attr(substr(term_description( $termId,),0,140));
      //echo 'description description description description description ';
      echo '</div>';
    ?>
     <div class = "realestaterightnow_iconsprofile"> 
      <?php 
          if(! empty($termMeta['phone']))
          {
            echo '<i class="fa fa-phone" aria-hidden="true"></i>';
            echo '&nbsp;'.esc_attr($termMeta['phone']);
            echo '<br />';
          }
          if(! empty($termMeta['skype']))
          {
            echo '<i class="fa fa-skype" aria-hidden="true"></i>';
            echo '&nbsp;'.esc_attr($termMeta['skype']);
            echo '<br />';
          }
          if(! empty($termMeta['email']))
          {
            echo ' <a href="mailto:'.esc_attr($termMeta['email']).'"><i class="fa fa-envelope-o" aria-hidden="true"></i></a> ';
            echo '&nbsp;';
          }      
          if(! empty($termMeta['facebook']))
          {
            echo ' <a href="http://facebook.com/'.esc_attr($termMeta['facebook']).'"><i class="fa fa-facebook" aria-hidden="true"></i></a> ';
            echo '&nbsp;';
          }
          if(! empty($termMeta['twitter']))
          {
            echo ' <a href="http://twitter.com/'.esc_attr($termMeta['twitter']).'"><i class="fa fa-twitter" aria-hidden="true"></i></a> ';
            echo '&nbsp;';
          }   
          if(! empty($termMeta['linkedin']))
          {
            echo ' <a href="http://linkedin.com/'.esc_attr($termMeta['linkedin']).'"><i class="fa fa-linkedin" aria-hidden="true"></i></a> ';
            echo '&nbsp;';
          }
          if(! empty($termMeta['instagram']))
          {
            echo ' <a href="http://instagram.com/'.esc_attr($termMeta['instagram']).'"><i class="fa fa-instagram" aria-hidden="true"></i></a> ';
            echo '&nbsp;';
          } 
          if(! empty($termMeta['vimeo']))
          {
            echo '<a href="http://vimeo.com/'.esc_attr($termMeta['vimeo']).'"><i class="fa fa-vimeo" aria-hidden="true"></i></a> ';
            echo '&nbsp;';
          }       
          if(! empty($termMeta['youtube']))
          {
            echo '<a href="http://youtube.com/'.esc_attr($termMeta['youtube']).'"><i class="fa fa-youtube" aria-hidden="true"></i></a> ';
            echo '&nbsp;';
          }          
      ?>
  </div>
  <?php
      echo '</div>'; 
   echo '</div>';      
   echo '</div>';  
 echo '</div>';     
}
