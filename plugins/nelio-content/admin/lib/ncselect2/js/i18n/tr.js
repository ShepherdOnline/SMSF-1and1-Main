/*! Select2 4.0.1 | https://github.com/ncselect2/ncselect2/blob/master/LICENSE.md */

(function(){if(jQuery&&jQuery.fn&&jQuery.fn.ncselect2&&jQuery.fn.ncselect2.amd)var e=jQuery.fn.ncselect2.amd;return e.define("ncselect2/i18n/tr",[],function(){return{inputTooLong:function(e){var t=e.input.length-e.maximum,n=t+" karakter daha girmelisiniz";return n},inputTooShort:function(e){var t=e.minimum-e.input.length,n="En az "+t+" karakter daha girmelisiniz";return n},loadingMore:function(){return"Daha fazla…"},maximumSelected:function(e){var t="Sadece "+e.maximum+" seçim yapabilirsiniz";return t},noResults:function(){return"Sonuç bulunamadı"},searching:function(){return"Aranıyor…"}}}),{define:e.define,require:e.require}})();