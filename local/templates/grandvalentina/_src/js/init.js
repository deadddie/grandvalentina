import { Common } from './components/common';
import { Ajax } from './components/ajax';
//import { FrontSlider } from './components/front_slider';

/**
 * Init application.
 */
function Init () {

    Common.init();
    Ajax.init();
    //FrontSlider.init();

}

export { Init };
