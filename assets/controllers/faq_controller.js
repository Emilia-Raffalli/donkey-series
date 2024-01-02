import { Controller } from '@hotwired/stimulus';

/*
* The following line makes this controller "lazy": it won't be downloaded until needed
* See https://github.com/symfony/stimulus-bridge#lazy-controllers
*/
/* stimulusFetch: 'lazy' */
export default class extends Controller {
    static targets = ['answer'];


    toggle() {
        const el = this.answerTarget;
        // Vérifie si l'élément est actuellement masqué (display === 'none').
        if (el.ownerDocument.defaultView.getComputedStyle(el, null).display === 'none') {
        // Si l'élément est masqué, il le rend visible en changeant la propriété display à 'block'. Sinon, il le masque en changeant la propriété display à 'none'.
            el.style.display = 'block';
        } else {
        el.style.display = 'none';
    }

    
}

}

