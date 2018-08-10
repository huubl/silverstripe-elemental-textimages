(function($){
    // use $ here safely

    // Lightbox  ----------------------------------------------------------------
    $textimages_lightbox_config = {
        selector: 'a.lightbox',
        hash: false,
        fullScreen: false,
        actualSize: false,
        getCaptionFromTitleOrAlt: false,
        loop: true,
        thumbnail: true,
        showThumbByDefault: false,
        fullScreen: false,
        download: false,
        autoplayControls: true,
        exThumbImage: 'data-exthumbimage'

    };

    // .lightbox .item
    $(".derralf__elements__textimages__element__elementtextimages").lightGallery(
        $textimages_lightbox_config
    );

})(jQuery);
