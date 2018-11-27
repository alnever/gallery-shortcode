(function($) {
    $(document).ready(function(){
        $(".an-gallery-shortcode-element").click(function() {
            $(".an-gallery-shortcode-lightbox-image").attr("src", $(this).find("img").attr("src"));
            $(".an-gallery-shortcode-lightbox").addClass("an-gallery-shortcode-lightbox-visible");

            if ($(this).find("img").width() > $(this).find("img").height()) {
                $(".an-gallery-shortcode-lightbox").addClass("an-gallery-shortcode-lightbox-wide");
            } else {
                $(".an-gallery-shortcode-lightbox").removeClass("an-gallery-shortcode-lightbox-wide");
            }
        });

        $(".an-gallery-shortcode-close-btn").click(function() {
            $(".an-gallery-shortcode-lightbox").removeClass("an-gallery-shortcode-lightbox-visible");
        });


    });
}) (jQuery);