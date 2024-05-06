
var SpeechRecognition = SpeechRecognition || webkitSpeechRecognition;
var SpeechGrammarList = SpeechGrammarList || webkitSpeechGrammarList;
var SpeechRecognitionEvent = SpeechRecognitionEvent || webkitSpeechRecognitionEvent;



var campoInforme = document.querySelector('#informe');


var activo = false;


function GrabadorInforme() {
	   
    console.log('estado 1'+activo);

	if (activo) {
        console.log('estado 2'+activo);
		document.querySelector("#iinforme").setAttribute("class", "fa fa-microphone fa-fw");
		activo = false;
	}
	else {
        console.log('estado 3'+activo);
		document.querySelector("#iinforme").setAttribute("class", "fa fa-microphone fa-fw text-red");
		activo = true;

		var reconocimiento = new SpeechRecognition();
		reconocimiento.lang = 'es-CO';
		reconocimiento.interimResults = false;
		reconocimiento.maxAlternatives = 1;

		reconocimiento.start();

		reconocimiento.onresult = function (event) {

			var resultadoEscucha = event.results[0][0].transcript;

			if (resultadoEscucha != '') {
            
            
                $('#informe').summernote('createRange');
                $('#informe').summernote('editor.restoreRange');
                $('#informe').summernote('editor.focus');
                $('#informe').summernote('editor.insertText', ConvetidorHtml(' ' + resultadoEscucha.toLowerCase()+' '));
			}
			else {
				
			}
		}

        reconocimiento.onspeechend = function () {
            reconocimiento.stop();
            document.querySelector("#iinforme").setAttribute("class", "fa fa-microphone fa-fw");
            activo = false;
        }
        reconocimiento.onerror = function (event) {

        }
	}
 

}
