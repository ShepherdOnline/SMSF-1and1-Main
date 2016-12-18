function htmlDecode(value){ 
   return jQuery('<div/>').html(value).text(); 
}

function go_back_twopages() {
    window.history.go(-2);
}

jQuery(document).ready( function($) {
   // Managing bookings delete operations 

   function eme_calc_price_json() {
      var alldata = $('#eme-rsvp-form').serializeArray();
      alldata.push({name: 'eme_override_eventAction', value: 'calc_price'});
      jQuery('span#eme_calc_price').html('<img src="'+emebasic.translate_plugin_url+'images/spinner.gif">');
      jQuery.post(self.location.href, alldata, function(data){
         jQuery('span#eme_calc_price').html(data.total);
      }, "json");
   }

   var timer;
   var delay = 600; // 0.6 seconds delay after last input
   jQuery('input.seatsordiscount').on('input',function() { 
        window.clearTimeout(timer);
        timer = window.setTimeout(function(){
           eme_calc_price_json();
        }, delay);
   });
   jQuery('select.seatsordiscount').change(function() {
      eme_calc_price_json();
   });

   // now calculate the price, but only do it if we have a "full" form
   // during rsvp double-posting the form gets reposted and this would otherwise also trigger
   if (jQuery('span#eme_calc_price').length) {
      eme_calc_price_json();
   }
});

