<header class="f-header hide-nav hide-nav--fixed js-hide-nav js-hide-nav--main js-f-header">
  <div class="f-header__mobile-content container max-width-lg">
      <a href="{{ home_url('/') }}" class="f-header__logo">
        {!! $siteName !!}
      </a>

      <button class="reset anim-menu-btn js-anim-menu-btn js-tab-focus f-header__nav-control" aria-label="Toggle menu">
          <i class="anim-menu-btn__icon anim-menu-btn__icon--close" aria-hidden="true"></i>
      </button>
  </div>

  <div class="f-header__nav" role="navigation">
    <div class="f-header__nav-grid container max-width-lg">
      <div class="f-header__nav-logo-wrapper margin-right-lg@md">
          <a href="{{ home_url('/') }}" class="f-header__logo">
            {!! $siteName !!}
          </a>
      </div>
      <ul class="f-header__list js-f-header__list">
        @if (has_nav_menu('primary_navigation'))
          <nav class="nav-primary" aria-label="{{ wp_get_nav_menu_name('primary_navigation') }}">
            {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav', 'echo' => false]) !!}
          </nav>
        @endif
      </ul>
      @include('partials.page-header')
      <ul class="f-header__list margin-left-auto@md">
        <li class="f-header__item"><a href="/login" class="f-header__link">Login</a></li>
        <li class="f-header__item"><a href="/pricing" class="f-header__btn btn btn--primary">Try for free</a></li>
      </ul>
    </div>
  </div>
</header>