
     $(window).load(
        function() {
            //$('#slider_principal').orbit();
            $('#slider_principal').orbit({
                animation: 'fade',                  // fade, horizontal-slide, vertical-slide, horizontal-push
                animationSpeed: 1000,                // how fast animtions are
                timer: true,                        // true or false to have the timer
                resetTimerOnClick: false,           // true resets the timer instead of pausing slideshow progress
                advanceSpeed: 4000,                 // if timer is enabled, time between transitions
                pauseOnHover: false,                // if you hover pauses the slider
                startClockOnMouseOut: false,        // if clock should start on MouseOut
                startClockOnMouseOutAfter: 1000,    // how long after MouseOut should the timer start again
                directionalNav: false,               // manual advancing directional navs
                captions: true,                     // do you want captions?
                captionAnimation: 'fade',           // fade, slideOpen, none
                captionAnimationSpeed: 800,         // if so how quickly should they animate in
                bullets: true,                     // true or false to activate the bullet navigation
                bulletThumbs: false,                // thumbnails for the bullets
                bulletThumbLocation: '',            // location from this file where thumbs will be
                afterSlideChange: function(){},     // empty function
                fluid: true                         // or set a aspect ratio for content slides (ex: '4x3')
              });
        }
        
        
    );
    
 
 
     /* TIMEPICKER Retraite*/
    (function($) {
        $.timepicker.regional['fr'] = {
        timeOnlyTitle: 'Choisir une heure',
        timeText: 'Heure',
        hourText: 'Heures',
        minuteText: 'Minutes',
        secondText: 'Secondes',
        millisecText: 'Millisecondes',
        microsecText: 'Microsecondes',
        timezoneText: 'Fuseau horaire',
        currentText: 'Ok',
        timeFormat: 'HH:mm',
        amNames: ['AM', 'A'],
        pmNames: ['PM', 'P'],
        closeText: 'Fermer',
        prevText: 'Précédent',
        nextText: 'Suivant',
        monthNames: ['janvier', 'février', 'mars', 'avril', 'mai', 'juin','juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre'],
        monthNamesShort: ['janv.', 'févr.', 'mars', 'avril', 'mai', 'juin','juil.', 'août', 'sept.', 'oct.', 'nov.', 'déc.'],
        dayNames: ['dimanche', 'lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi'],
        dayNamesShort: ['dim.', 'lun.', 'mar.', 'mer.', 'jeu.', 'ven.', 'sam.'],
        dayNamesMin: ['D','L','M','M','J','V','S'],
        weekHeader: 'Sem.',
        dateFormat: 'dd/mm/yy',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false
        };
        $.timepicker.setDefaults($.timepicker.regional['fr']);
        })(jQuery);


    var startDateTextBox = $('#DateMin');
    var endDateTextBox = $('#DateMax');

    startDateTextBox.datetimepicker({ 
        addSliderAccess: true,
        sliderAccessArgs: { touchonly: false },
        timeFormat: 'HH:mm:ss',
        stepHour: 1,
        stepMinute: 15,
//        minDateTime: Date.now(),
        minDate: new Date(),
        dateFormat: "yy-mm-dd",
        onClose: function(dateText, inst) {
                if (endDateTextBox.val() != '') {
                        var testStartDate = startDateTextBox.datetimepicker('getDate');
                        var testEndDate = endDateTextBox.datetimepicker('getDate');
                        if (testStartDate > testEndDate)
                                endDateTextBox.datetimepicker('setDate', testStartDate);
                }
//                else {
//                        endDateTextBox.val(dateText);
//                }
        },
        onSelect: function (selectedDateTime){
                endDateTextBox.datetimepicker('option', 'minDate', startDateTextBox.datetimepicker('getDate') );
        }
    });
    
    endDateTextBox.datetimepicker({ 
        addSliderAccess: true,
        sliderAccessArgs: { touchonly: false },
        timeFormat: 'HH:mm:ss',
        stepHour: 1,
        stepMinute: 15,
        dateFormat: "yy-mm-dd",
         minDate: new Date(),
        onClose: function(dateText, inst) {
                if (startDateTextBox.val() != '') {
                        var testStartDate = startDateTextBox.datetimepicker('getDate');
                        var testEndDate = endDateTextBox.datetimepicker('getDate');
                        if (testStartDate > testEndDate)
                                startDateTextBox.datetimepicker('setDate', testEndDate);
                }
//                else {
//                        startDateTextBox.val(dateText);
//                }
        },
        onSelect: function (selectedDateTime){
                startDateTextBox.datetimepicker('option', 'maxDate', endDateTextBox.datetimepicker('getDate') );
        }
    });
    
    /*TIME PICKER MENU*/
    var startDateTextBoxReveal = $('#DateMinReveal');
    var endDateTextBoxReveal = $('#DateMaxReveal');

    startDateTextBoxReveal.datetimepicker({ 
        addSliderAccess: true,
        sliderAccessArgs: { touchonly: false },
        timeFormat: 'HH:mm:ss',
        stepHour: 1,
        stepMinute: 15,
         minDate: new Date(),
        dateFormat: "yy-mm-dd",
        onClose: function(dateText, inst) {
                if (endDateTextBoxReveal.val() != '') {
                        var testStartDate = startDateTextBoxReveal.datetimepicker('getDate');
                        var testEndDate = endDateTextBoxReveal.datetimepicker('getDate');
                        if (testStartDate > testEndDate)
                                endDateTextBoxReveal.datetimepicker('setDate', testStartDate);
                }
//                else {
//                        endDateTextBox.val(dateText);
//                }
        },
        onSelect: function (selectedDateTime){
                endDateTextBoxReveal.datetimepicker('option', 'minDate', startDateTextBoxReveal.datetimepicker('getDate') );
        }
    });
    endDateTextBoxReveal.datetimepicker({ 
        addSliderAccess: true,
        sliderAccessArgs: { touchonly: false },
        timeFormat: 'HH:mm:ss',
        stepHour: 1,
        stepMinute: 15,
         minDate: new Date(),
        dateFormat: "yy-mm-dd",
        onClose: function(dateText, inst) {
                if (startDateTextBoxReveal.val() != '') {
                        var testStartDate = startDateTextBoxReveal.datetimepicker('getDate');
                        var testEndDate = endDateTextBoxReveal.datetimepicker('getDate');
                        if (testStartDate > testEndDate)
                                startDateTextBoxReveal.datetimepicker('setDate', testEndDate);
                }
//                else {
//                        startDateTextBox.val(dateText);
//                }
        },
        onSelect: function (selectedDateTime){
                startDateTextBoxReveal.datetimepicker('option', 'maxDate', endDateTextBoxReveal.datetimepicker('getDate') );
        }
    });
    

    $(document).ready(function() {
       $("#menu_1stlevelRecherche").click(function() {
         $("#quickSearchBox").reveal();
       });
     });
     





$(function() {

    $('.imgCaptionFixedTheme').capty({
            animation:	'fixed',
            height:40,
            opacity:0.9
    });
    
    $('.imgCaptionFixed').capty({
            animation:	'slide',
            height:70,
            opacity:0.9
    });
    $('.imgCaptionFixedLarge').capty({
            animation:	'fixed',
            height:   50,
            opacity:  .8
    });

   $('.imgCaptionListe').capty({
            height:   120,
            animation: 'slide',
            opacity:  .9
    });
    
    $('.imgCaptionSmallListe').capty({
            height:   70,
            opacity:  .9
    });

});

//      $(window).load(function() {
function toto(){
        $('#joyRideTipContent').joyride({
          autoStart : false,
          postStepCallback : function (index, tip) {
          if (index == 2) {
            $(this).joyride('set_li', false, 1);
          }
        },
        modal:true,
        expose: true
        });
}
//      });


        $("#resetFormOrga").click(
            function() { 
                document.getElementById('keywords').value = "";
                $("#listeRegions").select2("val", ""); 
                $("#listeDepartements").select2("val", ""); 
                $("#listeCommunautes").select2("val", ""); 
                $("#listeLieux").select2("val", ""); 
                $("#listeTypes").select2("val", ""); 


            }
        );
            
        $("#resetFormEvent").click(
            function() { 
                document.getElementById('DateMin').value = "";
                document.getElementById('DateMax').value = "";
                document.getElementById('keywords').value = "";
                $("#listeTypeOrga").select2("val", ""); 
                $("#GarderieIDHome").select2("val", ""); 
                $("#HebergementIDHome").select2("val", ""); 
                $("#listeIntervenants").select2("val", ""); 
                $("#listeLieux").select2("val", ""); 
                $("#listeThemes").select2("val", ""); 



            }
        );


//$(document).ready(function(){
    $("#GarderieIDHome").select2({});    
    $("#HebergementIDHome").select2(); 
    $("#listeThemes").select2({});    
    $("#listeType").select2({});
    $("#listeRegions").select2({});
    $("#listeDepartements").select2({});
    $("#listeCommunautes").select2({});
    $("#listeTypeOrga").select2({});
    $('#listeIntervenants').select2({});
    $('#listeLieux').select2({});
//    $('#listeLieux').select2({
//        
//        multiple : true,
//        minimumInputLength: 0,
//         initSelection : function (element, callback) {
////            var data = [];
////            $(element.val().split(",")).each(function () {
////                data.push({id: this, text: this});
////            });
////            
////           
//            var data = [];
//            
//            
//            $(element.val().split(",")).each(function () {
//                var selectedValue = this.split(":");
//                
//                data.push({id: selectedValue[0], text: selectedValue[1]});
//            });
//            document.getElementById('listeLieux').value = "";
//             callback(data);
//        },
//        ajax: {
//          url: "ajaxManagement.php?json=lieux",
//          dataType: 'json',
//          data: function (term, page) {
//            return {
//              q: term
//            };
//          },
//          results: function (data, page) {
//            return { results: data };
//          }
//        }
//
//      });

//   
      
//    $('#listeIntervenants').select2({
//
//        multiple : true,
//        minimumInputLength: 0,
//         initSelection : function (element, callback) {
//            var data = [];
//            $(element.val().split(",")).each(function () {
//                data.push({id: this, text: this});
//            });
//            
//            callback(data);
//        },
//        ajax: {
//          url: "ajaxManagement.php?json=intervenants",
//          dataType: 'json',
//          data: function (term, page) {
//            return {
//              q: term
//            };
//          },
//          results: function (data, page) {
//            return { results: data };
//          }
//        }
//
//      });
//});  

$('#datetimepicker_dateMin').datetimepicker({
	mask:true,
        lang:'fr',
        i18n:{
         de:{
          months:[
           'Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre',
          ],
          dayOfWeek:[
           "Dim", "Lun", "Mar", "Mer", 
           "Jeu", "Ven", "Sam",
          ]
         }
        },
        timepicker:false,
        format:'Y-m-d'
        
         
}); 


$('#clearDateMin').click(function(){
//	$('#datetimepicker_dateMin').datetimepicker('hide');
        document.getElementById('datetimepicker_dateMin').value = '';
});


$('#datetimepicker_dateMax').datetimepicker({
	mask:true,
        lang:'fr',
        i18n:{
         de:{
          months:[
           'Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre',
          ],
          dayOfWeek:[
           "Dim", "Lun", "Mar", "Mer", 
           "Jeu", "Ven", "Sam",
          ]
         }
        },
        timepicker:false,
        format:'Y-m-d'
         
}); 
$('#clearDateMax').click(function(){
	document.getElementById('datetimepicker_dateMax').value = '';
});

