=== Events Made Easy ===  
Contributors: liedekef
Donate link: http://www.e-dynamics.be/wordpress
Tags: events, locations, booking, calendar, maps, paypal, rsvp  
Requires at least: 4.0
Tested up to: 4.7
Stable tag: 1.7.10
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Manage and display events, recurring events, locations and maps, widgets, RSVP, ICAL and RSS feeds, payment gateways support. SEO compatible.
             
== Description ==
Events Made Easy is a full-featured event management solution for Wordpress. Events Made Easy supports public, private, draft and recurring events, locations management, RSVP (+ optional approval), Paypal, 2Checkout, FirstData and Google maps. With Events Made Easy you can plan and publish your event, or let people reserve spaces for your weekly meetings. You can add events list, calendars and description to your blog using multiple sidebar widgets or shortcodes; if you are a web designer you can simply employ the template tags provided by Events Made Easy. 

Events Made Easy integrates with Google Maps; thanks to geocoding, Events Made Easy can find the location of your event and accordingly display a map. 
Events Made Easy handles RSVP and bookings, integrates payments for events using paypal and other payment gateways and allows payment tracking.

Events Made Easy provides also a RSS and ICAL feed, to keep your subscribers updated about the events you're organising. 

Events Made Easy is fully multi-site compatible.

Events Made Easy is fully customisable; you can customise the amount of data displayed and their format in events lists, locations, attendees and in the RSS/ICAL feed. Also the RSVP form can be changed to your liking with extra fields, and by using EME templates let you change the layout even per page!

Events Made Easy is fully localisable and already partially localised in Italian, Spanish, German, Swedish, French and Dutch. 

Events Made Easy is also fully compatible with qtranslate (and mqtranslate): most of the settings allow for language tags so you can show your events in different languages to different people. The booking mails also take the choosen language into account.

For more information, documentation and support forum visit the [Official site](http://www.e-dynamics.be/wordpress/) .

== Installation ==

Always take a backup of your db before doing the upgrade, just in case ...  
1. Upload the `events-made-easy` folder to the `/wp-content/plugins/` directory  
2. Activate the plugin through the 'Plugins' menu in WordPress  
3. Add events list or calendars following the instructions in the Usage section.  

= Usage =

After the installation, Events Made Easy add a top level "Events" menu to your Wordpress Administration.

*  The *Events* page lets you edit or delete the events. The *Add new* page lets you insert a new event.  
	In the event edit page you can specify the number of spaces available for your event. You just need to turn on RSVP for the event and specify the spaces available in the right sidebar box.  
	When a visitor responds to your events, the box sill show you his reservation. You can remove reservation by clicking on the *x* button or view the respondents data in a printable page.
	You can also specify the category the event is in, if you activated the Categories support in the Settings page.  
	Also fine grained control of the RSVP mails and the event layout are possible here, if the defaults you configured in the Settings page are not ok for this specific event.  
*  The *Locations* page lets you add, delete and edit locations directly. Locations are automatically added with events if not present, but this interface lets you customise your locations data and add a picture. 
*  The *Categories* page lets you add, delete and edit categories (if Categories are activated in the Settings page). 
*  The *People* page serves as a gathering point for the information about the people who reserved a space in your events. 
*  The *Pending approvals* page is used to manage registrations/bookings for events that require approval 
*  The *Change registration* page is used to change bookings for events 
*  The *Settings* page allows a fine-grained control over the plugin. Here you can set the [format](#formatting-events) of events in the Events page.
*  Access control is in place for managing events and such: 
        - a user with role "Editor" can do anything 
        - with role "Author" you can only add events or edit existing events for which you are the author or the contact person 
        - with role "Contributor" you can only add events *in draft* or edit existing events for which you are the author or the contact person 

Events list and calendars can be added to your blogs through widgets, shortcodes and template tags. See the full documentation at the [Events Made Easy Support Page](http://www.e-dynamics.be/wordpress/).
 
== Frequently Asked Questions ==

See the FAQ section at [the documentation site](http://www.e-dynamics.be/wordpress).

== Changelog ==

= 1.7.10 (2016/12/16) =
* Fixed #_LOCATIONIMAGETHUMBURL
* Added #_LOCATIONIMAGETHUMBURL{MyCustomSize}
* Split out mail templates in separate section, so we can easily take the option to send html mails into account and disable the
  html editor if not needed
* Fixed some location issues

= 1.7.9 (2016/12/11) =
* Offline fix

= 1.7.8 (2016/12/10) =
* Add new discount type "fixed discount per seat"
* Add offline-payment setting
* Backwards incompatibility: renamed the multibooking option eme_register_empty_seats to just register_empty_seats
  (and documented it)
* Backwards incompatibility: for a multibooking, events that use the attendance option won't store empty seats (the 'no'-answer) unless you use the option register_empty_seats=1 (default=0)
* The HTML editor is shown for many settings/templates now, more will follow after feedback
* Add extra fields for location info: address1, address2, city, state, zip, country (the old address field is now address1; the old town field is now city).

= 1.7.7 (2016/11/01) =
* Make the delete icon for events and discounts actually work again
* Add option to make captcha case insensitive
* Make notices permanently dismissable again

= 1.7.6 (2016/10/14) =
* Added eme_for shortcode, to be able to show certain html multiple times (2 values: min, max, see doc for examples)
* Bugfix: show the no-longer-allowed-to-book message again if the end-date has passed (not for multi-booking)
* Bugfix: allow 0-seats for attendance-like events again
* Bugfix: the extra attributes field for formfields was not showing the correct value when editing the formfield
* Add the possibility to send a test email via the "Send Mails" page
* Bugfix: the smtp port setting was not correctly taken into account (always resulting in port 25 being used)

= 1.7.5 (2016/09/14) =
* Client clock functionality was not working anymore
* Fix setting 'Age of unpaid pending bookings in minutes'
* Make captcha work again (although sometimes it worked ... the quirks of php session autostart I guess)

= 1.7.4 (2016/09/13) =
* Mail was not being sent after payment arrived for autoapproval

= 1.7.3 (2016/09/12) =
* Moving a registration to another event was not working anymore

= 1.7.2 (2016/09/07) =
* Make sure mail is sent out when denying a registration
* Correct the link to RSVP in the Pending registration menu
* When adding a booking in the backend, don't mark it immediately as paid
* Add booking ID back to rsvp overview

= 1.7.1 (2016/09/06) =
* Small fix: make sure payments received via ipn approve the booking if auto-approve is set
* Improvents in the event overview: you can now click on pending bookings

= 1.7.0 (2016/09/06) =
* Paging events for the last day of the month failed if the next month has fewer days. E.g. if you're
  on August 31 and tried to go to the next month via event paging, it would give you October because Sept 31 doesn't exist
* Added the possibility to send mails after payment notification from payment gateway was received. You just need to set what you want in the regular mail settings page of EME.
* Added shortcode [eme_holidays], with 1 parameter: the id of the holidays list. Will return a simple html list of your holidays list
* The event listing in the backend is now ajax based, this will result in much better performance if you have many events
* Bugfix: typo: payed => paid

Older changes can be found in changelog.txt
