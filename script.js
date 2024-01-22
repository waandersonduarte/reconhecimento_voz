const recordBtn = document.querySelector(".record");
const result = document.querySelector(".result");
const downloadBtn = document.querySelector(".download");
const inputLanguage = document.querySelector("#language");
const clearBtn = document.querySelector(".clear");

// Declaração da Web Speech API
let SpeechRecognition =
  window.SpeechRecognition || window.webkitSpeechRecognition;
let recognition;
let recording = false;

// Comandos específicos de pontuação
const commands = {
  "ponto final": ".",
  "full stop": ".",
  "vírgula": ",",
  "comma": ",",
  "ponto de interrogação": "?",
  "interrogation": "?",
  "exclamação": "!",
  "exclamation": "!",
  "ponto e vírgula": ";",
  "semicolon": ";",
  "dois pontos": ":",
  "two points": ":",
  "abrir aspas": '"',
  "open quotation marks": '"',
  "fechar aspas": '"',
  "close quotes": '"',
  "abrir parênteses": "(",
  "open parentheses": "(",
  "fechar parênteses": ")",
  "close parentheses": ")",
  "quebra de linha": "\n",
  "next line": "\n",
};

// Função para permitir a escolha da linguagem: Português e Inglês (languages.js)
function populateLanguages() {
  languages.forEach((lang) => {
    const option = document.createElement("option");
    option.value = lang.code;
    option.innerHTML = lang.name;
    inputLanguage.appendChild(option);
  });
}

populateLanguages();

// Função para padronizar a primeira letra da primeira palavra em maiúscula
function capitalizeFirstLetter(string){
  return string.charAt(0).toUpperCase() + string.slice(1);
}

// Função principal de reconhecimento da API e transcrição da fala em texto
function speechToText() {
  try {
    recognition = new SpeechRecognition(); // Cria um novo objeto 
    recognition.lang = inputLanguage.value; // Define a linguagem na tag select
    recognition.interimResults = true;
    recordBtn.classList.add("recording");
    recordBtn.querySelector("p").innerHTML = "Gravando..."; // o texto da tag <p> é alterado assim que inicia a gravação
    recognition.start(); // evento de início
    recognition.onresult = (event) => {
      let speechResult = event.results[0][0].transcript; // Coloca o resultado da transcrição dento de da variavel speechResult

      // Verifica se existe algum comando de pontuação durante a transcrição
      for (const command in commands) {
        if (speechResult.includes(command)) {
          speechResult = speechResult.replace(command, commands[command]);
        }
      }
      speechResult = capitalizeFirstLetter(speechResult.trim()); // Define a primeira letra do resultado em maiuscula

      if (event.results[0].isFinal) {
        result.innerHTML += " " + speechResult;
        result.querySelector("p").remove(); 
      } else {
        if (!document.querySelector(".interim")) {
          const interim = document.createElement("p");
          interim.classList.add("interim");
          result.appendChild(interim); // Adiciona o resultado final dentro de um elemento <p>
        }
        document.querySelector(".interim").innerHTML = " " + speechResult;
      }
      downloadBtn.disabled = false; // deixa o botão de download habilitado para clicar
    };
    recognition.onspeechend = () => {
      speechToText();
    };
    // Trata os possíveis error que possa ocorrer
    recognition.onerror = (event) => {
      stopRecording();
      if (event.error === "no-speech") {
        alert("Nenhuma fala foi detectada. Parando...");
      } else if (event.error === "audio-capture") {
        alert(
          "Nenhum microfone foi encontrado. Certifique-se de que um microfone esteja instalado."
        );
      } else if (event.error === "not-allowed") {
        alert("A permissão para usar o microfone está bloqueada.");
      } else if (event.error === "aborted") {
        alert("A gravação parou.");
      } else {
        alert("Ocorreu um erro no reconhecimento: " + event.error);
      }
    };
  } catch (error) {
    recording = false;
    console.log(error);
  }
}

recordBtn.addEventListener("click", () => {
  if (!recording) {
    speechToText();
    recording = true;
  } else {
    stopRecording();
  }
});

function stopRecording() {
  recognition.stop();
  recordBtn.querySelector("p").innerHTML = "Iniciar Gravação";
  recordBtn.classList.remove("recording");
  recording = false;
}

// Função para fazer o download do arquivo de texto caso haja algo transcrito no campo
function download() {
  const text = result.innerText;
  const filename = "speech.docx"; // Define o nome do arquivo

  const element = document.createElement("a");
  element.setAttribute(
    "href",
    "data:text/plain;charset=utf-8," + encodeURIComponent(text)
  );
  element.setAttribute("download", filename);
  element.style.display = "none";
  document.body.appendChild(element);
  element.click();
  document.body.removeChild(element);
}

downloadBtn.addEventListener("click", download);

// Limpar o texto que está transcrito
clearBtn.addEventListener("click", () => {
  result.innerHTML = "";
  downloadBtn.disabled = true; // Deixa o botão de download desabilitado pois não texto no campo
});
