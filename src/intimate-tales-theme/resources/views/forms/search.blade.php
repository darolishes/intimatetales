<form role="search" method="get" class="search-form" action="{{ home_url('/') }}">
  <label>
    <span class="sr-only">
      {{ _x('Search for:', 'label', 'intimate-tales') }}
    </span>

    <input
      type="search"
      placeholder="{!! esc_attr_x('Search &hellip;', 'placeholder', 'intimate-tales') !!}"
      value="{{ get_search_query() }}"
      name="s"
    >
  </label>

  <button>{{ _x('Search', 'submit button', 'intimate-tales') }}</button>
</form>
