import { Common } from './components/common';
import { Modals } from './components/modals';
import { Slider } from './components/slider';
import { SliderBlock } from './components/slider_block';
import { Wrap } from './components/wrap';

/**
 * Init application.
 */
function Init () {

    Common.init();
    Modals.init();
    Slider.init('room');
    Slider.init('event');
    Slider.init('event_block');
    Slider.init('restaurant');
    Slider.init('entertainment');

    SliderBlock.init('offer');
    SliderBlock.init('room');

    Wrap.init();
}

export { Init };
