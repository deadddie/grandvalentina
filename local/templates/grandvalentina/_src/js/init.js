import { Common } from './components/common';
import { Modals } from './components/modals';
import { Slider } from './components/slider';
//import { FrontSlider } from './components/front_slider';

/**
 * Init application.
 */
function Init () {

    Common.init();
    Modals.init();
    Slider.init('room');
    Slider.init('event');
    //FrontSlider.init();

}

export { Init };
