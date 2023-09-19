// _1_local-storage
(function() {
  // light-dark-switcher - selected option based on ldSwitch localStorage value
  var ldSwitches = document.getElementsByClassName('js-ld-switch');
  if(ldSwitches.length < 1) return;
  var ldSwitchTheme = localStorage.getItem('ldSwitch');
  if( ldSwitchTheme !== null) {
    // get selected option
    var index = 0;
    if(ldSwitchTheme == 'system') index = 2;
    else if(ldSwitchTheme == 'dark') index = 1;
    
    var select = ldSwitches[0].querySelector('select');
    if(!select) return;
    select.selectedIndex = index;
  }
}());