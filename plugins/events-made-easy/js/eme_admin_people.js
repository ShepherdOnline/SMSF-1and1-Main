jQuery(document).ready(function () { 

function getQueryParams(qs) {
    qs = qs.split("+").join(" ");
    var params = {},
        tokens,
        re = /[?&]?([^=]+)=([^&]*)/g;

    while (tokens = re.exec(qs)) {
        params[decodeURIComponent(tokens[1])]
            = decodeURIComponent(tokens[2]);
    }
    return params;
}
var $_GET = getQueryParams(document.location.search);

        //Prepare jtable plugin
        jQuery('#PeopleTableContainer').jtable({
            title: eme.translate_people,
            paging: true,
            sorting: true,
            toolbarsearch: true,
            jqueryuiTheme: true,
            defaultSorting: 'lastname ASC, person_id ASC',
            selecting: true, //Enable selecting
            multiselect: true, //Allow multiple selecting
            selectingCheckboxes: true, //Show checkboxes on first column
            selectOnRowClick: true, //Enable this to only select using checkboxes
            actions: {
                listAction: ajaxurl+'?action=eme_people_list',
                updateAction: ajaxurl+'?action=eme_people_edit',
                createAction: ajaxurl+'?action=eme_people_edit'
            },
            fields: {
                person_id: {
                    key: true,
                    create: false,
                    edit: false,
                    list: false
                },
                lastname: {
		    title: eme.translate_lastname,
                    inputClass: 'validate[required]'
                },
                firstname: {
		    title: eme.translate_firstname
                },
                address1: {
		    title: eme.translate_address1,
                    list: false
                },
                address2: {
		    title: eme.translate_address2,
                    list: false
                },
                zip: {
		    title: eme.translate_zip,
                    list: false
                },
                city: {
		    title: eme.translate_city,
                    list: false
                },
                state: {
		    title: eme.translate_state,
                    list: false
                },
                country: {
		    title: eme.translate_country,
                    list: false
                },
                email: {
		    title: eme.translate_email,
                    inputClass: 'validate[required]'
                },
                phone: {
		    title: eme.translate_phone,
                    list: false
                },
                showbookings: {
                    create: false,
                    edit: false,
                    searchable: false,
                    sorting: false,
                    visibility: 'fixed',
                    display: function (data) {
                       return '<a href="admin.php?page=eme-registration-seats&person_id='+ data.record.person_id+'">' + eme.translate_showallbookings + '</a>';
                    }
                }
            }
        });

        // Load list from server, but only if the container is there
        // and only in the initial load we take a possible person id in the url into account
        // This person id can come from the eme_people page when clicking on "view all bookings"
        if (jQuery('#PeopleTableContainer').length) {
           jQuery('#PeopleTableContainer').jtable('load', {
               person_id: $_GET["person_id"]
           });
        }

 
        // Actions button
        jQuery('#PeopleActionsButton').button().click(function () {
           var selectedRows = jQuery('#PeopleTableContainer').jtable('selectedRows');
           var do_action = jQuery('#eme_admin_action').val();
           var nonce = jQuery('#eme_admin_nonce').val();
           var action_ok=1;
           if (selectedRows.length > 0) {
              if ((do_action=='deletePeople') && !confirm(eme.translate_areyousuretodeleteselected)) {
                 action_ok=0;
              }
              if (action_ok==1) {
                 var ids = [];
                 selectedRows.each(function () {
                   ids.push(jQuery(this).data('record').person_id);
                 });

                 var idsjoined = ids.join(); //will be such a string '2,5,7'
                 jQuery.post(ajaxurl, {
					"person_id": idsjoined,
					"action": "eme_manage_people",
					"do_action": do_action,
					"chooseperson": jQuery('#chooseperson').val(),
					"transferto_id": jQuery('#transferto_id').val(),
					"eme_admin_nonce": nonce },
                             function() {
	                        jQuery('#PeopleTableContainer').jtable('reload');
                             });
              }
           } else {
              alert(eme.translate_pleaseselectrecords);
           }
           // return false to make sure the real form doesn't submit
           return false;
        });
 
        function updateShowHideTransferTo () {
           if (jQuery('select#eme_admin_action').val() == "deletePeople") {
              jQuery("span#span_transferto").show();
           } else {
              jQuery("span#span_transferto").hide();
           }
        }
        updateShowHideTransferTo();
        jQuery('select#eme_admin_action').change(updateShowHideTransferTo);

    // for autocomplete to work, the element needs to exist, otherwise JS errors occur
    // we check for that using length
    if (jQuery("input[name=chooseperson]").length) {
          jQuery("input[name=chooseperson]").autocomplete({
            source: function(request, response) {
                         jQuery.post(ajaxurl,
                                  { q: request.term,
                                    action: 'eme_autocomplete_people',
                                    eme_searchlimit: 'people',
                                  },
                                  function(data){
                                       response(jQuery.map(data, function(item) {
                                          return {
                                             lastname: htmlDecode(item.lastname),
                                             firstname: htmlDecode(item.firstname),
                                             email: htmlDecode(item.email),
                                             person_id: htmlDecode(item.person_id),
                                          };
                                       }));
                                  }, "json");
                    },
            select:function(evt, ui) {
                         // when a person is selected, populate related fields in this form
                         jQuery('input[name=transferto_id]').val(ui.item.person_id);
                         jQuery('input[name=chooseperson]').val(ui.item.lastname+' '+ui.item.firstname).attr("readonly", true);
                         return false;
                   },
            minLength: 2
          }).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
            return jQuery( "<li></li>" )
            .append("<a><strong>"+htmlDecode(item.lastname)+' '+htmlDecode(item.firstname)+'</strong><br /><small>'+htmlDecode(item.email)+' - '+htmlDecode(item.phone)+ '</small></a>')
            .appendTo( ul );
          };

          // if manual input: set the hidden field empty again
          jQuery('input[name=chooseperson]').keyup(function() {
             jQuery('input[name=transferto_id]').val('');
          }).change(function() {
             if (jQuery('input[name=chooseperson]').val()=='') {
                jQuery('input[name=transferto_id]').val('');
             }
          });
    }

});
