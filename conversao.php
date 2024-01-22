<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digitação por Voz</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
    <div class="container">
        <!-- <div class="row m-3"> -->
        <p class="heading">Printed Voice</p>
        <div class="options">
            <div class="anguage">
              <p>Linguagem</p>
              <select name="input-language" id="language"></select>
            </div>
        </div>
        <br>
        <!-- <div class="line"></div> -->
        <!-- <h2 class="heading">Texto Reconhecido</h2> -->
        <div
        class="result"
        spellcheck="false"
        placeholder="Text will be shown here"
        >
            <p class="interim"></p>
        </div>
        <button class="btn record">
            <div class="icon">
                <ion-icon name="mic-outline"></ion-icon>
                <img src="bars.svg" alt="" />
            </div>
            <p>Iniciar Gravação</p>
        </button>
        <div class="buttons botoes">
            <button class="btn clear">
              <ion-icon name="trash-outline"></ion-icon>
              <p>Limpar</p>
            </button>
            <button class="btn download" disabled>
              <ion-icon name="cloud-download-outline"></ion-icon>
              <p>Download</p>
            </button>
        </div>
    </div>
    <script
      type="module"
      src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"
    ></script>
    <script
      nomodule
      src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"
    ></script>
    
     <!-- LANGUAGES -->
     <script src="languages.js"></script>

     <!-- SCRIPT -->
     <script src="script.js"></script>






        <!-- <div class="botoes text-center">
            <button type="button" class="btn btn-primary" id="startRecording">Iniciar Gravação</button>
            <button type="button" class="btn btn-primary" id="stopRecording" disabled>Parar Gravação</button>
            
        </div>
        <div class="btn-lg btn-block">
            <button type="button" class="btn btn-dark pull-right" id="downloadDocx">Download DOCX</button>
            <button type="button" class="btn btn-dark" id="downloadPdf">Download PDF</button>
        </div> -->
    <!-- <script>
        const startButton = document.getElementById('startRecording');
        const stopButton = document.getElementById('stopRecording');
        const textArea = document.getElementById('textArea');
        let recognition;

        if ('SpeechRecognition' in window || 'webkitSpeechRecognition' in window) {
            recognition = new (window.SpeechRecognition || window.webkitSpeechRecognition)();
            recognition.continuous = true;

            let punctuations = {
                'ponto final': '.',
                'vírgula': ',',
                'ponto de interrogação': '?',
                'exclamação': '!',
                'ponto e vírgula': ';',
                'dois pontos': ':',
                'abrir aspas': '"',
                'fechar aspas': '"',
                'abrir parênteses': '(',
                'fechar parênteses': ')',
            };

            recognition.onstart = () => {
                startButton.disabled = true;
                stopButton.disabled = false;
                textArea.value = '';
            };

            recognition.onresult = (event) => {
                const result = event.results[event.results.length - 1][0].transcript;
                textArea.value = result;

                // Procurar por comandos de pontuação
                for (const command in punctuations) {
                    if (result.toLowerCase().includes(command)) {
                        const punctuation = punctuations[command];
                        textArea.value = textArea.value.replace(command, punctuation);
                    }
                }
            };

            recognition.onerror = (event) => {
                console.error('Erro na gravação:', event.error);
            };

            recognition.onend = () => {
                startButton.disabled = false;
                stopButton.disabled = true;
            };

            startButton.addEventListener('click', () => {
                recognition.start();
            });

            stopButton.addEventListener('click', () => {
                recognition.stop();
            });

            // Evento de clique no botão "Download DOCX"
            document.getElementById('downloadDocx').addEventListener('click', () => {
                const text = textArea.value;

                // Criar um arquivo DOCX
                const blob = new Blob([text], { type: 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' });
                const url = URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = 'documento.docx';
                a.click();
                URL.revokeObjectURL(url);
            });

            // Evento de clique no botão "Download PDF"
            document.getElementById('downloadPdf').addEventListener('click', () => {
                const text = textArea.value;

                // Criar um documento PDF
                const doc = new jsPDF();
                doc.text(text, 10, 10); // Adicione o texto ao PDF

                // Iniciar o download do PDF
                doc.save('documento.pdf');
            });
        } else {
            console.error('A API de reconhecimento de fala não é suportada neste navegador.');
        }
    </script> -->
</body>
</html>
