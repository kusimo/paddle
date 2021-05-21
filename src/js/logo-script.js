document.addEventListener('DOMContentLoaded', (event) => {

    (function() {
        "use strict";
        let logoUrl = frontend_ajax_object.paddle_logo_url;
        let logoAlt = frontend_ajax_object.alt;
        if(!logoUrl) return;
    
        let siteFooter = document.querySelectorAll('.site-footer');
        if ( !siteFooter ) return;
    
        let firstFooter = document.getElementsByClassName('if-logo-footer')[0];
        if ( !firstFooter ) return;
      
        if(firstFooter) {
            let logoContainer = document.createElement('div');
            logoContainer.setAttribute('class', 'footer-logo-container mb-4');
            let footerLogo = document.createElement('img');
            footerLogo.setAttribute('src', logoUrl);
            footerLogo.setAttribute('alt', logoAlt);
            footerLogo.setAttribute('width', '100px');
            logoContainer.append(footerLogo);
            firstFooter.insertAdjacentElement('afterbegin', logoContainer);
        }  
    }());
})