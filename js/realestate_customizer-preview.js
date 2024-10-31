(function($) {

    // console.log('9000');
    $(document).ready(function() {

        $(document).click(function(event) {

           // console.log('Elemento clicado:', event.target);
            const url =  event.target;
            const parsedUrl = new URL(url);
            var urlProper = parsedUrl.origin + parsedUrl.pathname;
            const hasCustomizeChangeset = parsedUrl.searchParams.has('customize_changeset_uuid');
            const hasCustomizeMessengerChannel = parsedUrl.searchParams.has('customize_messenger_channel');
            if (hasCustomizeChangeset && hasCustomizeMessengerChannel) {
                console.log('A URL contém os parâmetros customize_changeset e customize_messenger_channel!!!.');
                const urlCookie = realestaterightnow_getCookie('realestaterightnow_url');
                if (urlCookie) {
                    console.log('Tem cookie '+urlCookie);
                    document.cookie = 'realestaterightnow_url' + "=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                }
                  realestaterightnow_setUrlCookie(urlProper);
                //  console.log('Tem cookie '+urlCookie);
            } 
        });

        /*    Search Box   */
        // Search BKG color
        wp.customize('realestate-search-box-bk-color', function(value) {
            value.bind(function(new_value) {
                //console.log('bkg: ' + new_value);
                // Update preview
                $('.realestate-search-box').css("background-color", new_value);
            });
        });
        wp.customize('realestate-search-box-border-color', function(value) {
            value.bind(function(new_value) {
                // Update preview
                $('.realestate-search-box').css("border-color", new_value);
            });
        });
        // Search Border Size
        wp.customize('realestate-search-box-border-size', function(value) {
            value.bind(function(new_value) {
                // Update preview
                var $set_border = new_value + "px";
                $('.realestate-search-box').css("border-width", $set_border);
            });
        });
        // Search Border Radius
        wp.customize('realestate-search-box-border-radius', function(value) {
            value.bind(function(new_value) {
                // Update preview
                var $set_border = new_value + "px";
                $('.realestate-search-box').css("border-radius", $set_border);
            });
        });
        // Margin Bottom
        wp.customize('realestate-search-box-margin-bottom', function(value) {
            value.bind(function(new_value) {
                // Update preview
                var $set_margin = new_value + "px";
                $('.realestate-search-box').css("margin-bottom", $set_margin);
            });
        });
        /*    End Search Box   */
        /*    Search Fields   */
        wp.customize('realestate-search-label', function(value) {
            value.bind(function(new_value) {
                $('.realestate-search-label').css("color", new_value);
                $('.search-label-widget').css("color", new_value);
            });
        });
        // .realestate-select-box-meta
        wp.customize('realestate-select-box-meta-color', function(value) {
            value.bind(function(new_value) {
                $('.realestate-select-box-meta').css("color", new_value);
                $('.realestate-select-box-meta-widget').css("color", new_value);
            });
        });
        wp.customize('realestate-search-fields-control-bkg-color', function(value) {
            value.bind(function(new_value) {
                $('.realestate-select-box-meta').css("background", new_value);
                $('.realestate-select-box-meta-widget').css("background", new_value);
            });
        });
        //realestate-search-fields-radius
        wp.customize('realestate-search-fields-radius', function(value) {
            value.bind(function(new_value) {
                var $set_border = new_value + "px";
                $('.realestate-select-box-meta').css("border-radius", $set_border);
                $('.realestate-select-box-meta-widget').css("border-radius", $set_border);
            });
        });
        /*    End Search Fields   */
        // submitBtn
        wp.customize('realestate-search-button-color', function(value) {
            value.bind(function(new_value) {
                $('#realestate-submitBtn').css("color", new_value);
                $('#realestate-submitBtn-widget').css("color", new_value);
            });
        });
        wp.customize('realestate-search-button-bkg-color', function(value) {
            value.bind(function(new_value) {
                $('#realestate-submitBtn').css("background", new_value);
                $('#realestate-submitBtn-widget').css("background", new_value);
            });
        });
        //realestate-search-button-radius
        wp.customize('realestate-search-button-radius', function(value) {
            value.bind(function(new_value) {
                var $set_border = new_value + "px";
                $('#realestate-submitBtn').css("border-radius", $set_border);
                $('#realestate-submitBtn-widget').css("border-radius", $set_border);
            });
        });
                // realestate-search-button-width
                wp.customize('realestate-search-button-width', function(value) {
                    value.bind(function(new_value) {
                        var $set_width = new_value + "px";
                        $('#realestate-submitBtn').css("width", $set_width);
                    });
                });  
        // Slider
        // .realestate-select-box-meta
        wp.customize('realestate-search-slider-label-color', function(value) {
            value.bind(function(new_value) {
                console.log(new_value);
                $('.realestatelabelprice').css("color", new_value);
                $('#meta_price').css("color", new_value);
                $('.realestatelabelprice2').css("color", new_value);
                $('#meta_price2').css("color", new_value);
                /* >>>>>>>>>>>>>>>>>>>>  */
            });
        });
        wp.customize('realestate-search-slider-control-bkg-color', function(value) {
            value.bind(function(new_value) {
                $('.realestate-price-slider').css("background", new_value);
                $('.realestate-price-slider2').css("background", new_value);
                $('#meta_price').css("color", new_value);
                $('#meta_price2').css("color", new_value);
              
            });
        });
        wp.customize('realestate-search-slider-control-color', function(value) {
            value.bind(function(new_value) {
                console.log(new_value);
                $('.ui-slider .ui-slider-range').hide(); 
                $('.ui-widget.ui-widget-content').css("background-color", new_value);
                $('.ui-button.ui-state-disabled:hover, html .ui-button.ui-state-disabled:active').css("background-color", new_value+' !important');
                $('.ui-state-default, .ui-widget-content .ui-state-default').css("background-color", new_value+' !important');
                $('.ui-slider .ui-slider-handle').css("background-color", new_value+' !important');
                $('.ui-slider .ui-slider-range').css("background-color", new_value);
            });
        });
        wp.customize('realestate-search-slider-handle-color', function(value) {
            value.bind(function(new_value) {
                $('#slider-button-0').css("background-color", new_value); 
                $('#slider-button-1').css("background-color", new_value); 
                $('#slider-button-2').css("background-color", new_value); 
                $('#slider-button-3').css("background-color", new_value); 
            });
        });
        wp.customize('realestate-search-slider-border-color', function(value) {
            value.bind(function(new_value) {
                $('.realestate-price-slider').css("border-color", new_value);
                $('.realestate-price-slider2').css("border-color", new_value);
            });
        });
        wp.customize('realestate-search-slider-radius', function(value) {
            value.bind(function(new_value) {
                var $set_border = new_value + "px";
                $('.realestate-price-slider').css("border-radius", $set_border);
                $('.realestate-price-slider2').css("border-radius", $set_border);
            });
        });
        // Template Single Car
        //realestate-template-single-bk-color
        wp.customize('realestate-template-single-bk-color', function(value) {
            value.bind(function(new_value) {
                $('#content2').css("background", new_value);
            });
        });
        wp.customize('realestate-template-single-color', function(value) {
            value.bind(function(new_value) {
                $('.multiContent').css("color", new_value);
                $('#content2').css("color", new_value);
                $('.featuredList').css("color", new_value);
            });
        });
        wp.customize('realestate-template-single-features-bkg', function(value) {
            value.bind(function(new_value) {
                $('.featuredTitle').css("background", new_value);
            });
        });
        wp.customize('realestate-template-single-features-color', function(value) {
            value.bind(function(new_value) {
                $('.featuredTitle').css("color", new_value);
            });
        });
        wp.customize('realestate-template-single-features-border-color', function(value) {
            value.bind(function(new_value) {
                $('.featuredCar').css("border-color", new_value);
            });
        });
        wp.customize('realestate-template-single-features-border-radius', function(value) {
            value.bind(function(new_value, event) {
                var $set_border = "0px 0px "+new_value + "px "  + new_value + "px" ;
                var $set_border2 = new_value + "px "  + new_value + "px 0px 0px" ;
                $('.featuredCar').css("border-radius", $set_border);
                $('.featuredTitle').css("border-radius", $set_border2);
            });
        });
        // .realestate-back and contact
        wp.customize('realestate-back-contact-buttons-color', function(value) {
            value.bind(function(new_value) {
                $('#realestaterightnow_goback').css("color", new_value);
                $('#realestaterightnow_cform').css("color", new_value);
                
            });
        });
        wp.customize('realestate-back-contact-buttons-bk-color', function(value) {
            value.bind(function(new_value) {
                $('#realestaterightnow_goback').css("background", new_value);
                $('#realestaterightnow_cform').css("background", new_value);
            });
        });
        wp.customize('realestate-back-contact-buttons-radius', function(value) {
            value.bind(function(new_value, event) {
                var $set_radius = new_value + "px";
                $('#realestaterightnow_goback').css("border-radius", $set_radius);
                $('#realestaterightnow_cform').css("border-radius", $set_radius);
            });
        });
		wp.customize('realestate-back-contact-buttons-width', function(value) {
            value.bind(function(new_value, event) {
                var $set_width = new_value + "px";
                $('#realestaterightnow_goback').css("width", $set_width);
                $('#realestaterightnow_cform').css("width", $set_width);
            });
        });

        
        // Change Template
        wp.customize('realestaterightnow_template_gallery', function(value) {
            value.bind(function(new_value) {

                var previewUrl = realestaterightnow_my_data.realestaterightnow_previewUrl;
                const ultimoSlashIndex = previewUrl.lastIndexOf("/");
                siteUrl = previewUrl.slice(0, ultimoSlashIndex + 1);
                
                 if (new_value == 'list') {
                    $('#realestaterightnow_content').html('<img src="'+siteUrl+'wp-content/plugins/real-estate-right-now/assets/images/lview.jpg">');
                 }
                 else if (new_value == 'grid') {
                    $('#realestaterightnow_content').html('<img src="'+siteUrl+'wp-content/plugins/real-estate-right-now/assets/images/grid.jpg">');
                }
                else {
                    $('#realestaterightnow_content').html('<img src="'+siteUrl+'wp-content/plugins/real-estate-right-now/assets/images/gallery.jpg">');
                }
                $('#realestaterightnow_content').css("margin-bottom", "50px");
            });
        });

        // Change Single Car Template
        wp.customize('realestaterightnow_template_single', function(value) {
            value.bind(function(new_value) {

                var previewUrl = realestaterightnow_my_data.realestaterightnow_previewUrl;
                const ultimoSlashIndex = previewUrl.lastIndexOf("/");
                siteUrl = previewUrl.slice(0, ultimoSlashIndex + 1);

                // console.log(siteUrl);
                //console.log(new_value);

                 if (new_value == '1') {
                    $('#realestaterightnow_content').html('<img src="'+siteUrl+'wp-content/plugins/real-estate-right-now/assets/images/mod1.jpg">');
                 }
                 else{
                    $('#realestaterightnow_content').html('<img src="'+siteUrl+'wp-content/plugins/real-estate-right-now/assets/images/mod2.jpg">');
                 }
                $('#realestaterightnow_content').css("margin-bottom", "50px");
            });
        });




        // Template
        wp.customize('realestate-template-bk-color', function(value) {
            value.bind(function(new_value) {
                $('#realestaterightnow_content').css("background", new_value);
            });
        });
        wp.customize('realestate-template-title-color', function(value) {
            value.bind(function(new_value) {
                $('.multiTitle17').css("color", new_value);
                $('.multiInforightText17').css("color", new_value);
            });
        });
        wp.customize('realestate-template-fg-color', function(value) {
            value.bind(function(new_value) {
                $('.realestaterightnow_description').css("color", new_value);
                $('#realestaterightnow_content').css("color", new_value);
            });
        });
            // .realestate-Button View
            wp.customize('realestate-template-button-color', function(value) {
                value.bind(function(new_value) {
                    $('.realestaterightnow_btn_view').css("color", new_value);
                });
            });
            wp.customize('realestate-template-button-bkg-color', function(value) {
                value.bind(function(new_value) {
                    var new_value99 = new_value + ' !important';
                    var count = $('[id^="realestaterightnow_btn_view-"]').length;
                    for (let i = 1; i <= count; i++) {
                        let elementId = "#realestaterightnow_btn_view-" + i;
                        $(elementId).css("background", new_value);
                    }
                });
            });
            wp.customize('realestate-template-button-radius', function(value) {
                value.bind(function(new_value, event) {
                    var $set_border = new_value + "px";
                    var count = $('[id^="realestaterightnow_btn_view-"]').length;
                    for (let i = 1; i <= count; i++) {
                        let elementId = "#realestaterightnow_btn_view-" + i;
                        let elementId2 = ".realestaterightnow_btn_view-" + i;
                        $(elementId).css("border-radius", $set_border);
                        $(elementId2).css("border-radius", $set_border);
                    }
                });
            });
            wp.customize('realestate-template-button-width', function(value) {
                value.bind(function(new_value, event) {
                    var $set_width = new_value + "px";
                    $('.realestaterightnow_btn_view').css("width", $set_width);
                });
            });
   // .realestaterightnow_container17
   wp.customize('realestate-template-list-separator', function(value) {
        value.bind(function(new_value, event) {
            console.log(new_value);
            var $set_border = "1px solid "+new_value
            console.log($set_border);
            $('.realestaterightnow_container17').css("border-bottom", $set_border );
            
        });
    });
    // Gallery Title
    wp.customize('realestate-template-gallery-title', function(value) {
        value.bind(function(new_value, event) {
            $('.multiTitle').css("color", new_value);
            $('.sideTitle').css("color", new_value);
            $('.RealEstateTitle').css("color", new_value);
        });
    });
    wp.customize('realestate-template-gallery-title-bkg', function(value) {
        value.bind(function(new_value, event) {
            $('.multiTitle').css("background", new_value);
            $('.sideTitle').css("background", new_value);
            $('.multiTitle-widget').css("background", new_value);
            $('.RealEstateTitle').css("background", new_value);
        });
    });


    // Gallery Border  Radius
        wp.customize('realestate-template-gallery-border-radius', function(value) {
            value.bind(function(new_value) {
                // Update preview
                var $set_border = new_value + "px " +  new_value + "px " + "0px 0px" ;
                $('.realestaterightnow_gallery_2016').css("border-radius", $set_border);
                $('.sideTitle').css("border-radius", $set_border);
                $('.realestaterightnow_caption_img').css("border-radius", $set_border);
                $('.realestaterightnow_caption_text').css("border-radius", $set_border);
                // $("p#44.test").css("background-color","red");
            });
        });
        wp.customize('realestate-template-gallery-border', function(value) {
            value.bind(function(new_value, event) {
                var $set_border = "1px solid " +  new_value;
                $('.realestaterightnow_gallery_2016').css("border", $set_border);
            });
        });
        wp.customize('realestate-template-grid-border', function(value) {
            value.bind(function(new_value, event) {
                var $set_border = "1px solid " +  new_value;
                $('.realestate-item-grid').css("border", $set_border);
            });
        });
        // Test Site Title...
        wp.customize('myplugin_setting', function(value) {
            value.bind(function(new_value) {
                if (new_value == '1') {
                    $('.site-title-text').hide();
                } else {
                    $('.site-title-text').show();
                }
            });
        });
        wp.customize('realestate-widget-bkg', function(value) {
            value.bind(function(new_value, event) {
                $('#realestate-search-box-widget').css("background", new_value);
            });
        });
});  // end doc ready...

    function realestaterightnow_setUrlCookie(url) {
        document.cookie = `realestaterightnow_url=${encodeURIComponent(url)+ "; path=/"}`;
      }
      if (typeof realestaterightnow_getCookie !== 'function') {
        function realestaterightnow_getCookie(name) {
            const cookieString = document.cookie;
            const cookies = cookieString.split(';');
            for (let i = 0; i < cookies.length; i++) {
            const cookie = cookies[i].trim();
            if (cookie.startsWith(name + '=')) {
                return decodeURIComponent(cookie.substring(name.length + 1));
            }
            }
            return null;
        }
    }
})(jQuery);