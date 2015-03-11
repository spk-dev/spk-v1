var end = new Date('8 Jun 2013 12:00:00'); // inscrire la date d'expiration
			
var _second = 1000;
var _minute = _second * 60;
var _hour = _minute * 60;
var _day = _hour *24
var timer;

function showRemaining()
{
        var now = new Date();
        var distance = end - now;
        if (distance < 0 ) {
           clearInterval( timer ); // on arr�te le d�compte une fois que c'est termin�
                document.getElementById('countdown').innerHTML = '<div class="end">Fin du compteur</div>';

           return; // on stop tout
        }
        var days = Math.floor(distance / _day);
        var hours = Math.floor( (distance % _day ) / _hour );
        var minutes = Math.floor( (distance % _hour) / _minute );
        //var seconds = Math.floor( (distance % _minute) / _second );
        //var milliseconds = Math.floor( (distance % _second)/10 );


        var seconds = Math.floor( (distance % _minute) / _second );
        var milliseconds = Math.floor( (distance % _second) );

        var millisecondsToDisplay = milliseconds.toString();


        if(millisecondsToDisplay.length == 1){
                millisecondsToDisplay = "00"+millisecondsToDisplay;
        }else if(millisecondsToDisplay.length == 2){
                millisecondsToDisplay = "0"+millisecondsToDisplay;
        }


        seconds = (seconds<10) ? "0" + seconds : seconds;


        document.getElementById('countdown').innerHTML = '<div class="time days">' + days + '<div id="LabelDay" class="label">Jours</div></div>';
        document.getElementById('countdown').innerHTML += '<div class="hours time carre"> ' + hours+ '<div id="LabelHour" class="label">Heures</div></div>';
        document.getElementById('countdown').innerHTML += '<div class="minutes time carre">' + minutes+ '<div id="LabelMinute" class="label">Minutes</div></div>';
        document.getElementById('countdown').innerHTML += '<div class="seconds time carre">' + seconds+ '<div id="LabelTime" class="label">Secondes</div></div>';
        document.getElementById('countdown').innerHTML += '<div class="time millisecondes carre">' + millisecondsToDisplay+ '</div>';
}

timer = setInterval(showRemaining, 10);
			
			