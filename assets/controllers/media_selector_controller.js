import { Controller } from '@hotwired/stimulus';

/*
* The following line makes this controller "lazy": it won't be downloaded until needed
* See https://github.com/symfony/stimulus-bridge#lazy-controllers
*/
/* stimulusFetch: 'lazy' */
export default class extends Controller {
    static targets = ['selector', 'capture', 'link']
    
    connect() {
        this.selectorTarget.addEventListener('change', (e) => {
            this.captureTarget.src = e.target.value;
            this.linkTarget.href = e.target.selectedOptions[0].dataset.url;
        })
    }
}
