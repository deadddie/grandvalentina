import { Common } from './components/common';
import { Modals } from './components/modals';
import { RoomSlider } from './components/room_slider';
//import { FrontSlider } from './components/front_slider';

/**
 * Init application.
 */
function Init () {

    Common.init();
    Modals.init();
    RoomSlider.init();
    //FrontSlider.init();

}

export { Init };
