/**
 * SVG sprite in LocalStorage.
 *
 * @type {{init(*=, *, *=): (boolean|undefined)}}
 */
let SvgLocalStorage = {

    init(revision, spriteFile, svgContainerId) {

        /**
         * SVG sprite localStorage caching
         */

        'use strict';
        let file = location.origin + spriteFile;

        if (!document.createElementNS || !document.createElementNS('http://www.w3.org/2000/svg', 'svg').createSVGRect)
            return true;

        let isLocalStorage = 'localStorage' in window && window['localStorage'] !== null,
            request,
            data,
            insertIT = () => document.getElementById(svgContainerId).innerHTML = data,
            insert = () => {
                if (document.body) insertIT();
                else document.addEventListener('DOMContentLoaded', insertIT);
            };

        if (isLocalStorage && localStorage.getItem('inlineSVGrev') == revision) {
            data = localStorage.getItem('inlineSVGdata');
            if (data) {
                insert();
                return true;
            }
        }

        try {
            request = new XMLHttpRequest();
            request.open('GET', file, true);
            request.onload = () => {
                if (request.status >= 200 && request.status < 400) {
                    data = request.responseText;
                    insert();
                    if (isLocalStorage) {
                        localStorage.setItem('inlineSVGdata', data);
                        localStorage.setItem('inlineSVGrev', revision);
                    }
                }
            };
            request.send();
        }
        catch(e) {}

    }

};

export { SvgLocalStorage };
