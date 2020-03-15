<!-- Yandex.Metrika counter -->
<script>
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter28447586 = new Ya.Metrika({
                    id:28447586,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true,
                    ecommerce:"dataLayer"
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/28447586" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-106410101-4"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-106410101-4');
</script>

<!--google analytics end -->
<!-- roistat -->
<script>
    function ReplacePhone(){this.currentAttempts=0;this.maxAttempts=200;this.phones=[];this.clearPhone=function(phone){return phone.replace(/\D+/g,"")};this.setPhones=function(phones){var self=this;phones.forEach(function(item,key){var cleanPhones=[];var cleanPhone=self.clearPhone(item.phone);if(cleanPhone.length>10){var minPhone=cleanPhone.substr(1);self.phones.push({'phone':"8"+minPhone,'class':item.class});self.phones.push({'phone':"7"+minPhone,'class':item.class});self.phones.push({'phone':minPhone,'class':item.class})}else{self.phones.push({'phone':cleanPhone,'class':item.class})}})};this.searchPhone=function(phone){for(var i=0;i<this.phones.length;i++){if(this.phones[i]['phone']===phone){return this.phones[i]}}return false};this.start=function(){var attempts=1;for(var i=0;i<attempts;i++){this.foreachChildren('body')}this.setClassForPhonesOnHref()};this.foreachChildren=function(elem){var children;if(typeof elem=='string'){children=document.querySelector(elem).children}else{children=elem.children}if(children.length>0){for(var i=0;i<children.length;i++){if(children[i].tagName!="SCRIPT"){this.foreachChildren(children[i])}}}if(elem.tagName!=="BODY"){this.findPhonesOnElement(elem)}};this.findPhonesOnElement=function(elem='body'){var myArray;var html=elem.outerHTML;var regex=/(roistat-phone[^>]*?)?>[^<>]*?((\+?\d+[\s\-\.]?)?((\(\d+\)|\d+)[\s\-\.]?)?(\d[\s\-\.]?){6,7}\d)[^<>]*?</gm;while((myArray=regex.exec(html))!=null){this.replaceContent(elem,myArray)}};this.replaceContent=function(elem,myArray){var hasRoistatClass=myArray[1];var number=myArray[2];var clearNumber=number.replace(/\D+/g,"");var search=this.searchPhone(clearNumber);var hasClass;if(elem.classList){hasClass=elem.classList.contains(search['class'])}else{hasClass=new RegExp('(^| )'+search['class']+'( |$)','gi').test(elem.className)}if(search&&!hasClass&&!hasRoistatClass&&!elem.innerHTML.match('<script>')){if(this.currentAttempts++>this.maxAttempts){return false}if(elem.innerHTML.trim()==number){if(elem.classList){elem.classList.add(search['class'])}else{elem.className+=' '+search['class']}}else{elem.innerHTML=elem.innerHTML.replace(number,'<span class="'+search['class']+'">'+number+'</span>');this.findPhonesOnElement(elem)}}};this.setClassForPhonesOnHref=function(){var self=this;var elements=document.querySelectorAll('[href^="tel:"]');elements.forEach(function(elem,key){var phone=self.clearPhone(elem.getAttribute('href'));var search=self.searchPhone(phone);if(search&&!elem.classList.contains(search['class'])){elem.classList.add(search['class']+'-tel')}})}}
    var phoneReplacer = new ReplacePhone();
    phoneReplacer.setPhones([
        {'phone': '8 (800) 350-91-84', 'class': 'roistat-phone-grandvalentina'}
    ]);
    phoneReplacer.start();

    (function(w, d, s, h, id) {
        w.roistatProjectId = id; w.roistatHost = h;
        var p = d.location.protocol == "https:" ? "https://" : "http://";
        var u = /^.*roistat_visit=[^;]+(.*)?$/.test(d.cookie) ? "/dist/module.js" : "/api/site/1.0/"+id+"/init";
        var js = d.createElement(s); js.charset="UTF-8"; js.async = 1; js.src = p+h+u; var js2 = d.getElementsByTagName(s)[0]; js2.parentNode.insertBefore(js, js2);
    })(window, document, 'script', 'cloud.roistat.com', '1d3c5807995c80eeebdde68f8b2b85ee');
</script>

<!-- BEGIN JIVOSITE INTEGRATION WITH ROISTAT -->
<script>
    var getCookie = window.getCookie = function (name) {
        var matches = document.cookie.match(new RegExp("(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"));
        return matches ? decodeURIComponent(matches[1]) : undefined;
    };
    function jivo_onLoadCallback() {
        jivo_api.setUserToken(getCookie('roistat_visit'));
    }
    function jivo_onOpen() {
        jivo_api.setUserToken(getCookie('roistat_visit'));
    }
    window.onRoistatAllModulesLoaded = function () {
        setTimeout(function () {
            jivo_api.setUserToken(getCookie('roistat_visit'));
        }, 2000);
    };
</script>
<!-- END JIVOSITE INTEGRATION WITH ROISTAT -->
<!-- roistat end -->

<div class="script-chat">

    <!-- bitrix widget -->
    <script>
        window.roistatVisitCallback = function (visitId) {
            (function (w, d, u) {
                var s = d.createElement('script');
                s.async = true;
                s.src = u + '?' + (Date.now() / 60000 | 0);
                var h = d.getElementsByTagName('script')[0];
                h.parentNode.insertBefore(s, h);
            })(window, document, 'https://cdn.bitrix24.ru/b10933452/crm/site_button/loader_4_4e6m26.js');

            window.Bitrix24WidgetObject = window.Bitrix24WidgetObject || {};
            window.Bitrix24WidgetObject.handlers = {
                'form-init': function (form) {
                    form.presets = {
                        'roistatID': visitId
                    };
                }
            };
        };
    </script>
    <!-- end widget -->

    <!-- BEGIN JIVOSITE CODE {literal} -->
    <script src="//code.jivosite.com/widget.js" jv-id="zlRHOv4fms" async></script>
    <!-- {/literal} END JIVOSITE CODE -->

    <style>.b24-widget-button-wrapper { display: none; }</style>
    <script>
        $(document).on('scroll', function () {
            var top = $(document).scrollTop();
            if (top > 500) {
                $('.b24-widget-button-wrapper').fadeIn();
            } else {
                $('.b24-widget-button-wrapper').fadeOut();
            }
        });
    </script>

</div>
