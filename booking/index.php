<?php

use Bitrix\Main\Context;
use LapkinLab\Content\Rooms;

require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');

$title = 'Бронирование номера';

$request = Context::getCurrent()->getRequest();
$id = $request->get('id');

$room = false;
if ($id) {
    $room = Rooms::getById($id);
}
$APPLICATION->SetTitle($title);
if ($room) {
    $title .= ' ' . $room->fields['NAME'];
}
$APPLICATION->SetPageProperty('title', $title);


?>
<div class="page-booking">
    <div class="container">
        <div class="row">
            <h1 class="page-title col-12 text-center"><?= $title ?></h1>
            <div class="col-12">
                <div class="page-booking--content">

                    <!-- start TL Booking form script -->
                    <div id="tl-booking-form">&nbsp;</div>
                    <script>
                        $(document).ready(function () {
                            // Roistat Begin
                            function bookingSuccess(data) {
                                $.get('//grandvalentina.ru/roistat/webhooks/armor.php', data);
                            }
                            // Roistat End
                            (function(w){
                                var q=[
                                    ['setContext', 'TL-INT-grandvalentina', 'ru'],
                                    ['embed', 'booking-form', {container: 'tl-booking-form'}]
                                ];
                                var t=w.travelline=(w.travelline||{}),ti=t.integration=(t.integration||{});ti.__cq=ti.__cq?ti.__cq.concat(q):q;
                                if (!ti.__loader){ti.__loader=true;var d=w.document,p=d.location.protocol,s=d.createElement('script');s.type='text/javascript';s.async=true;s.src=(p=='https:'?p:'http:')+'//ibe.tlintegration.com/integration/loader.js';(d.getElementsByTagName('head')[0]||d.getElementsByTagName('body')[0]).appendChild(s);}
                            })(window);
                        });
                    </script>
                    <!-- end TL Booking form script -->

                </div>
            </div>
        </div>
    </div>
</div>
<?php require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php'); ?>
