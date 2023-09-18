// File#: _3_testimonial-banner
// Usage: codyhouse.co/license
(function() {
  var Tbanner = function(element) {
    this.element = element;
    this.slideshowContent = this.element.getElementsByClassName('js-t-banner__content-slideshow');
    this.slideshowBg = this.element.getElementsByClassName('js-t-banner__bg-slideshow');
    this.navControls = this.element.getElementsByClassName('js-slideshow__control');

    initSlideshow(this);
    initBannerNavigation(this);
  };

  function initSlideshow(banner) {
    // init background and content slideshows
    banner.slideshowContentObj = new Slideshow({element: banner.slideshowContent[0], navigation: false}); 
    banner.slideshowBgObj = new Slideshow({element: banner.slideshowBg[0], navigation: false});
  };

  function initBannerNavigation(banner) {
    if(banner.navControls.length < 2) return;
    // use arrows to navigate the slideshow
    banner.navControls[0].addEventListener('click', function(){
      updateSlideshow(banner, 'prev');
    });

    banner.navControls[1].addEventListener('click', function(){
      updateSlideshow(banner, 'next');
    });
  };

  function updateSlideshow(banner, direction) {
    if(direction == 'next') {
      banner.slideshowContentObj.showNext();
      banner.slideshowBgObj.showNext();
    } else {
      banner.slideshowContentObj.showPrev();
      banner.slideshowBgObj.showPrev();
    }
  };

  // init Tbanner obj
  var tBanner = document.getElementsByClassName('js-t-banner');
  if(tBanner.length > 0) {
    for( var i = 0; i < tBanner.length; i++) {
      new Tbanner(tBanner[i]);
    }
  }
}());