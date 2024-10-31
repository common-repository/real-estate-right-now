try {
    if (window.jQuery) {
    // Se o jQuery estiver disponível, execute o código relacionado ao jQuery aqui
    
    


    jQuery(document).ready(function($) {
        var max = $("#meta_price_max").val();
        var min = 0;
        var choice_price_min = $("#choice_price_min").val();
        var choice_price_max = $("#choice_price_max").val();
        //var urlParams = new URLSearchParams(window.location.search);
        // console.log(window.location.search);
        //console.log(urlParams.get('meta_price_max')); 
        jQuery("#rent_sale").change(function() {
            $('#RealEstate-submitBtn').click();
        });
        if (typeof choice_price_min === 'undefined' || typeof choice_price_min === 'undefined') {
            choice_price_min = 0;
            choice_price_max = max;
        }
        $("#meta_price").val(min + " - " + max);

        $("#realestaterightnow_meta_price").slider({
            range: true,
            step: 100,
            min: 0,
            max: max,
            values: [choice_price_min, choice_price_max],
            slide: function(event, ui) {
                $("#meta_price").val(ui.values[0] + " - " + ui.values[1]);
            },
            create: function() {
                // Adiciona IDs personalizados aos botões do slider
                $(".ui-slider-handle", this).each(function(i) {
                $(this).attr("id", "slider-button-" + i);
                });
            }
        });
        var $sliderMax = $("#meta_price_max2");
        var $choiceMin = $("#choice_price_min2")
        var $choiceMax = $("#choice_price_max2")
        var maxVal = $sliderMax.val();
        var choiceMinVal = $choiceMin.val();
        var choiceMaxVal = $choiceMax.val();
        if (typeof choiceMinVal === 'undefined' || typeof choiceMaxVal === 'undefined') {
            choiceMinVal = 0;
            choiceMaxVal = maxVal;
        }
        $("#meta_price2").val(min + " - " + maxVal);

        $("#realestaterightnow_meta_price2").slider({
            range: true,
            step: 100,
            min: 0,
            max: maxVal,
            values: [choiceMinVal, choiceMaxVal],
            slide: function(event, ui) {
                $("#meta_price2").val(ui.values[0] + " - " + ui.values[1]);
            },
            create: function() {
                // Adiciona IDs personalizados aos botões do slider
                $(".ui-slider-handle", this).each(function(i) {
                $(this).attr("id", "slider-button-" + (i+2));
                });
            }

        });
        $(window).bind("load resize scroll", function(e) {
            /* 2018 */



            var realestaterightnow_meta_price = document.getElementById('realestaterightnow_meta_price');

            // if ( jQuery("#realestaterightnow_meta_price").lenght  )
            if (typeof(realestaterightnow_meta_price) != 'undefined' && realestaterightnow_meta_price != null) {
                var realestatelabelprice = $(".realestatelabelprice")
                var offset = realestatelabelprice.offset();
                // console.log(offset.top);
                var realestaterightnow_meta_price = $("#realestaterightnow_meta_price")
                var offset2 = realestaterightnow_meta_price.offset();
                // console.log(offset2.top);
                var distance = offset2.top - offset.top
                var carsellerwidth = document.body.offsetWidth;

                //console.log(distance);
                //console.log(carsellerwidth);

                if (carsellerwidth < 783) {
                    var deveria = 60;
                } else {
                    var deveria = 30;
                }
                if (distance != deveria) {
                    var missing = (deveria - distance)
                    var marginTop = parseInt(realestaterightnow_meta_price.css("marginTop"));
                    var tofix = (marginTop + missing);
                    //   realestaterightnow_meta_price.css("margin-top", tofix+" !important");
                    document.getElementById("realestaterightnow_meta_price").style.marginTop = tofix + "px";
                }

            }
            if ($("#realestaterightnow_meta_price2").lenght) {
                var realestatelabelprice = $(".realestatelabelprice2")
                var offset = realestatelabelprice.offset();
                var realestaterightnow_meta_price = $("#realestaterightnow_meta_price2")
                if (!realestaterightnow_meta_price.length)
                    return;
                var offset2 = realestaterightnow_meta_price.offset();
                /*
                console.log(offset2.top);
                console.log(offset.top); 
                */
                deveria = 30;
                var distance = offset2.top - offset.top
                if (distance != deveria) {
                    var missing = (deveria - distance)
                    var marginTop = parseInt(realestaterightnow_meta_price.css("marginTop"));
                    var tofix = (marginTop + missing);
                    realestaterightnow_meta_price.css("margin-top", tofix + " !important");
                }
            }




        });
    });
  }
} catch (error) {
   //console.error("Ocorreu um erro:", error);
}

