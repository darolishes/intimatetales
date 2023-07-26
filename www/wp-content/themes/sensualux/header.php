<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/svg+xml" href="assets/img/favicon.svg">
  <!-- Google font -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
  <link href="https://fonts.googleapis.com/css2?family=Albert+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
  <!-- end - Google font -->
  <script src="assets/js/color-theme.js"></script>
  <link rel="stylesheet" href="assets/css/style.css">
  <title>Urano | Landing template by CodyHouse</title>
</head>
<body>
  <header class="f-header hide-nav hide-nav--fixed js-hide-nav js-hide-nav--main js-f-header">
    <div class="f-header__mobile-content container max-width-lg">
      <a href="#0" class="f-header__logo">
        <svg width="40" height="40" viewBox="0 0 40 40">
          <title>Go to page top</title>
          <path d="M40,0H0V40H40Z" fill="var(--color-primary)" />
          <path d="M31,9H24V24h7Z" fill="#fff" />
          <path d="M16,9H9V31H24V24H16Z" fill="#fff" />
        </svg>
      </a>
  
      <button class="reset anim-menu-btn js-anim-menu-btn js-tab-focus f-header__nav-control" aria-label="Toggle menu">
        <i class="anim-menu-btn__icon anim-menu-btn__icon--close" aria-hidden="true"></i>
      </button>
    </div>
  
    <div class="f-header__nav" role="navigation">
      <div class="f-header__nav-grid container max-width-lg">
        <div class="f-header__nav-logo-wrapper margin-right-lg@md">
          <a href="#0" class="f-header__logo">
            <svg width="40" height="40" viewBox="0 0 40 40">
              <title>Go to page top</title>
              <path d="M40,0H0V40H40Z" fill="var(--color-primary)" />
              <path d="M31,9H24V24h7Z" fill="#fff" />
              <path d="M16,9H9V31H24V24H16Z" fill="#fff" />
            </svg>
          </a>
        </div>
    
        <ul class="f-header__list js-f-header__list">
          <li class="f-header__item"><a href="#product" class="f-header__link js-f-header__link js-tab-focus">Product</a></li>
          <li class="f-header__item"><a href="#learn" class="f-header__link js-f-header__link js-tab-focus">Learn</a></li>
          <li class="f-header__item"><a href="#testimonials" class="f-header__link js-f-header__link js-tab-focus">Testimonials</a></li>
          <li class="f-header__item"><a href="#pricing" class="f-header__link js-f-header__link js-tab-focus">Pricing</a></li>
        </ul>
    
        <ul class="f-header__list margin-left-auto@md">
          <li class="f-header__item"><a href="login.html" class="f-header__link">Login</a></li>
          <li class="f-header__item"><a href="#pricing" class="f-header__btn btn btn--primary">Try for free</a></li>
          <li class="display@md">
            <div class="ld-switch flex flex-center js-adv-select js-ld-switch">
              <select name="select-color-theme" id="select-color-theme">
                <optgroup label="Appearance">
                  <option value="0" data-option-theme="default" data-option-theme-preview="select-color-theme-light.svg">Light</option>
                  <option value="1" data-option-theme="dark" data-option-theme-preview="select-color-theme-dark.svg">Dark</option>
                  <option value="2" data-option-theme-preview="select-color-theme-system.svg">System</option>
                </optgroup>
              </select>
            
              <button class="reset ld-switch-btn is-hidden js-adv-select__control" aria-controls="color-theme-popover" aria-haspopup="listbox">
                <span class="sr-only js-adv-select__value"></span>
            
                <div class="ld-switch-btn__icon-wrapper ld-switch-btn__icon-wrapper--in js-ld-switch-icon" aria-hidden="true">
                  <svg class="icon ld-switch-btn__icon" viewBox="0 0 20 20">
                    <title>light</title>
                    <g fill="currentColor">
                      <circle cx="10" cy="10" r="4" fill-opacity=".2" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></circle>
                      <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 1v1.5"></path>
                      <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.364 3.636l-1.061 1.061"></path>
                      <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 10h-1.5"></path>
                      <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.364 16.364l-1.061-1.061"></path>
                      <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19v-1.5"></path>
                      <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.636 16.364l1.061-1.061"></path>
                      <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 10h1.5"></path>
                      <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.636 3.636l1.061 1.061"></path>
                    </g>
                  </svg>
                </div>
            
                <div class="ld-switch-btn__icon-wrapper js-ld-switch-icon" aria-hidden="true">
                  <svg class="icon ld-switch-btn__icon" viewBox="0 0 20 20">
                    <title>dark</title>
                    <g fill="currentColor">
                      <path d="M11.964 3.284c.021.237.036.474.036.716a8 8 0 0 1-8 8c-.242 0-.479-.015-.716-.036a7 7 0 1 0 8.68-8.68z" fill-opacity=".2" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                      <path d="M7 4a.979.979 0 0 1-1-1 1 1 0 0 0-2 0 .979.979 0 0 1-1 1 1 1 0 0 0 0 2 .979.979 0 0 1 1 1 1 1 0 0 0 2 0 .979.979 0 0 1 1-1 1 1 0 0 0 0-2z"></path>
                    </g>
                  </svg>
                </div>
            
                <div class="ld-switch-btn__icon-wrapper js-ld-switch-icon" aria-hidden="true">
                  <svg class="icon ld-switch-btn__icon" viewBox="0 0 20 20">
                    <title>light-auto</title>
                    <g fill="currentColor">
                      <path d="M10 14a4 4 0 1 1 3.465-6" fill-opacity=".2" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                      <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18l2.5-7h1l2.5 7"></path>
                      <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12.714 16h4.572"></path>
                      <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 1v1.5"></path>
                      <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.364 3.636l-1.061 1.061"></path>
                      <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.636 16.364l1.061-1.061"></path>
                      <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 10h1.5"></path>
                      <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.636 3.636l1.061 1.061"></path>
                    </g>
                  </svg>
                </div>
            
                <div class="ld-switch-btn__icon-wrapper js-ld-switch-icon" aria-hidden="true">
                  <svg class="icon ld-switch-btn__icon" viewBox="0 0 20 20">
                    <title>dark-auto</title>
                    <g fill="currentColor">
                      <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18l2.5-7h1l2.5 7"></path>
                      <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12.714 16h4.572"></path>
                      <path d="M12.146 10.159A2.5 2.5 0 0 1 14.5 8.5h1a2.5 2.5 0 0 1 1.412.441 7 7 0 0 0-4.948-5.657c.021.237.036.474.036.716a8 8 0 0 1-8 8c-.242 0-.479-.015-.716-.036a6.99 6.99 0 0 0 6.427 5.012z" fill-opacity=".2"></path>
                      <path d="M16.71 8a7.015 7.015 0 0 0-4.746-4.716c.021.237.036.474.036.716a8 8 0 0 1-8 8c-.242 0-.479-.015-.716-.036A7.006 7.006 0 0 0 9 16.929" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                      <path d="M7 4a.979.979 0 0 1-1-1 1 1 0 0 0-2 0 .979.979 0 0 1-1 1 1 1 0 0 0 0 2 .979.979 0 0 1 1 1 1 1 0 0 0 2 0 .979.979 0 0 1 1-1 1 1 0 0 0 0-2z"></path>
                    </g>
                  </svg>
                </div>
              </button>
            </div>
            
            <div id="color-theme-popover" class="popover ld-switch-popover bg-light padding-x-xs padding-bottom-xs padding-top-xxxs radius-md inner-glow shadow-md is-hidden js-popover js-adv-select-popover js-tab-focus" role="listbox">
              <div class="flex flex-wrap justify-between" role="group" describedby="select-color-theme-optgroup-label">
                <div class="width-100% margin-bottom-xs" id="select-color-theme-optgroup-label">
                  <span class="text-xs color-contrast-medium">{optgroup-label}</span>
                </div>
            
                <div class="ld-switch-popover__option" role="option">
                  <figure class="radius-md inner-glow">
                    <img class="block radius-inherit" src="assets/img/{option-theme-preview}" alt="Theme preview">
                  </figure>
            
                  <div class="text-xs margin-top-xxxs padding-x-xxxxs">{option-label}</div>
                </div>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </header>