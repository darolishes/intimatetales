(function() {
  // change the HTML data-theme value when the page is loaded (to prevent change of color flash) - the select behaviour is handled by the light-dark-switch component

  // check if the local storage data is set
  var ldTheme = localStorage.getItem('ldSwitch');
  
  if(ldTheme == 'dark' || (ldTheme == 'system' && window.matchMedia("(prefers-color-scheme: dark)").matches) ) {
    // set dark data theme
    document.getElementsByTagName("html")[0].setAttribute('data-theme', 'dark');
  }
}());
