(()=>{"use strict";var e={n:t=>{var r=t&&t.__esModule?()=>t.default:()=>t;return e.d(r,{a:r}),r},d:(t,r)=>{for(var a in r)e.o(r,a)&&!e.o(t,a)&&Object.defineProperty(t,a,{enumerable:!0,get:r[a]})},o:(e,t)=>Object.prototype.hasOwnProperty.call(e,t)};const t=window.wp.apiFetch;var r=e.n(t);window.addEventListener("load",(async function(){const e=await r()({path:"/create-block-theme/v1/wp-org-theme-names"});wpOrgThemeDirectory.themeSlugs=e.names}))})();