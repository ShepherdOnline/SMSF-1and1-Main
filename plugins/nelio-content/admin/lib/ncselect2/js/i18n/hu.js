/*! Select2 4.0.1 | https://github.com/ncselect2/ncselect2/blob/master/LICENSE.md */

(function(){if(jQuery&&jQuery.fn&&jQuery.fn.ncselect2&&jQuery.fn.ncselect2.amd)var e=jQuery.fn.ncselect2.amd;return e.define("ncselect2/i18n/hu",[],function(){return{inputTooLong:function(e){var t=e.input.length-e.maximum;return"Túl hosszú. "+t+" karakterrel több, mint kellene."},inputTooShort:function(e){var t=e.minimum-e.input.length;return"Túl rövid. Még "+t+" karakter hiányzik."},loadingMore:function(){return"Töltés…"},maximumSelected:function(e){return"Csak "+e.maximum+" elemet lehet kiválasztani."},noResults:function(){return"Nincs találat."},searching:function(){return"Keresés…"}}}),{define:e.define,require:e.require}})();