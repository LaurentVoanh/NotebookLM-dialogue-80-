<?php
// index_text_editor.php
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Éditeur NotebookLM - Dialogue Vidéo</title>
    <style>
        :root {
            --primary: #4361ee;
            --primary-dark: #3a56d4;
            --secondary: #7209b7;
            --light: #f8f9fa;
            --dark: #212529;
            --success: #4cc9f0;
            --warning: #f72585;
            --gray: #6c757d;
            --border-radius: 12px;
            --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            line-height: 1.6;
            background: linear-gradient(135deg, #f5f7fa 0%, #e4edf5 100%);
            color: var(--dark);
            padding: 20px;
            min-height: 100vh;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        header {
            text-align: center;
            margin-bottom: 30px;
            padding: 20px;
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
        }

        h1 {
            color: var(--primary);
            font-size: 2.2rem;
            margin-bottom: 10px;
            background: linear-gradient(45deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            font-weight: 700;
        }

        h2 {
            font-size: 1.4rem;
            margin-bottom: 15px;
            color: var(--primary);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        h2::before {
            content: "";
            display: block;
            width: 8px;
            height: 25px;
            background: linear-gradient(to bottom, var(--primary), var(--secondary));
            border-radius: 4px;
        }

        .section {
            background: white;
            padding: 25px;
            margin-bottom: 25px;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            transition: var(--transition);
        }

        .section:hover {
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .info-text {
            background: #e8f4fd;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-left: 4px solid var(--primary);
        }

        button {
            margin: 8px 0;
            padding: 12px 18px;
            border: none;
            border-radius: 8px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            font-size: 0.95em;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
            background: linear-gradient(135deg, var(--primary-dark), var(--secondary));
        }

        button:active {
            transform: translateY(0);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            width: 100%;
            padding: 15px;
            font-size: 1.1em;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, var(--primary-dark), var(--secondary));
        }

        .emotion-buttons {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 10px;
            margin-top: 15px;
        }

        .emotion-btn {
            background: linear-gradient(135deg, #7209b7, #4361ee);
        }

        .emotion-btn:hover {
            background: linear-gradient(135deg, #5a08a0, #3a56d4);
        }

        textarea {
            width: 100%;
            height: 400px;
            padding: 15px;
            font-family: 'Consolas', 'Monaco', monospace;
            font-size: 0.95em;
            margin-top: 10px;
            border-radius: 8px;
            border: 2px solid #e1e5e9;
            resize: vertical;
            transition: var(--transition);
            line-height: 1.5;
        }

        textarea:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.2);
        }

        pre {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            overflow-x: auto;
            font-size: 0.9em;
            border: 1px solid #e9ecef;
            margin: 15px 0;
            white-space: pre-wrap;
            word-wrap: break-word;
            position: relative;
        }

        pre::before {
            content: "📋";
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 1.2em;
            cursor: pointer;
            opacity: 0.7;
            transition: var(--transition);
        }

        pre:hover::before {
            opacity: 1;
        }

        .results-section {
            display: none;
            animation: fadeIn 0.5s ease;
        }

        .status-bar {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
            font-size: 0.85em;
            color: var(--gray);
        }

        .copy-notification {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: var(--primary);
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            box-shadow: var(--shadow);
            opacity: 0;
            transition: var(--transition);
            z-index: 1000;
        }

        .copy-notification.show {
            opacity: 1;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 768px) {
            .emotion-buttons {
                grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            }
            
            h1 {
                font-size: 1.8rem;
            }
            
            .section {
                padding: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>🎬 Éditeur NotebookLM - Dialogue Vidéo</h1>
            <p>Créez rapidement des dialogues optimisés pour vos vidéos NotebookLM</p>
        </header>

        <div class="section">
            <h2>1️⃣ Texte du dialogue</h2>
            <div class="info-text">
                <p>Modifiez directement le dialogue ci-dessous. Les lignes sont pré-remplies avec Personnage A et Personnage B alternés. Cliquez sur un bouton pour ajouter une émotion à la fin de la ligne sélectionnée.</p>
            </div>

            <textarea id="dialogueText" placeholder="Saisissez votre dialogue ici...">
<?php
// Pré-remplissage de 20 lignes alternées A/B
for ($i=1; $i<=20; $i++) {
    $personnage = ($i % 2 == 1) ? "Personnage A" : "Personnage B";
    echo $personnage.": \n";
}
?>
            </textarea>

            <div class="status-bar">
                <span id="lineCount">20 lignes</span>
                <span id="saveStatus">Sauvegardé</span>
            </div>

            <div class="emotion-buttons">
                <button class="emotion-btn" type="button" onclick="addEmotion('[Joyful]')">😊 Joyful</button>
                <button class="emotion-btn" type="button" onclick="addEmotion('[Sad]')">😢 Sad</button>
                <button class="emotion-btn" type="button" onclick="addEmotion('[Furious]')">😠 Furious</button>
                <button class="emotion-btn" type="button" onclick="addEmotion('[Reflective]')">🤔 Reflective</button>
                <button class="emotion-btn" type="button" onclick="addEmotion('[Calm]')">😌 Calm</button>
                <button class="emotion-btn" type="button" onclick="addEmotion('[Melancholic]')">🌧️ Melancholic</button>
                <button class="emotion-btn" type="button" onclick="addEmotion('[Excited]')">🎉 Excited</button>
                <button class="emotion-btn" type="button" onclick="addEmotion('[Angry]')">💢 Angry</button>
            </div>
        </div>

        <div class="section">
            <button class="btn-primary" onclick="generatePrompts()">
                🎬 Générer Source & Prompt
            </button>
        </div>

        <div class="section results-section" id="results-section">
            <h2>2️⃣ Résultats générés</h2>
            <p><strong>Premier prompt :</strong> à copier-coller en <strong>source</strong> dans NotebookLM.</p>
            <pre id="sourceOutput"></pre>
            <p><strong>Second prompt :</strong> à copier-coller dans la <strong>fenêtre d'édition de la vidéo</strong> pour lancer la lecture.</p>
            <pre id="promptOutput"></pre>
        </div>
    </div>

    <div class="copy-notification" id="copyNotification">Texte copié !</div>

    <script>
        // Éléments DOM
        const dialogueText = document.getElementById('dialogueText');
        const lineCount = document.getElementById('lineCount');
        const saveStatus = document.getElementById('saveStatus');
        const copyNotification = document.getElementById('copyNotification');

        // Sauvegarde automatique
        function autoSave() {
            localStorage.setItem('notebooklm_dialogue', dialogueText.value);
            saveStatus.textContent = 'Sauvegardé';
            setTimeout(() => {
                saveStatus.textContent = '';
            }, 2000);
        }

        // Chargement automatique
        function loadSavedDialogue() {
            const saved = localStorage.getItem('notebooklm_dialogue');
            if (saved) {
                dialogueText.value = saved;
                updateLineCount();
            }
        }

        // Mise à jour du compteur de lignes
        function updateLineCount() {
            const lines = dialogueText.value.split('\n').filter(line => line.trim() !== '');
            lineCount.textContent = `${lines.length} lignes`;
        }

        // Ajout d'émotion
        function addEmotion(emotion) {
            const cursorPos = dialogueText.selectionStart;
            const textBefore = dialogueText.value.substring(0, cursorPos);
            const textAfter = dialogueText.value.substring(cursorPos);
            
            // Vérifier si on est au début d'une ligne
            const lineStart = textBefore.lastIndexOf('\n') + 1;
            const currentLine = textBefore.substring(lineStart);
            
            // Si la ligne contient déjà une émotion, la remplacer
            const emotionRegex = /\[[^\]]+\]\s*$/;
            if (emotionRegex.test(currentLine)) {
                const newTextBefore = textBefore.replace(emotionRegex, emotion);
                dialogueText.value = newTextBefore + textAfter;
                dialogueText.focus();
                dialogueText.selectionEnd = newTextBefore.length;
            } else {
                dialogueText.value = textBefore + " " + emotion + textAfter;
                dialogueText.focus();
                dialogueText.selectionEnd = cursorPos + emotion.length + 1;
            }
            
            autoSave();
        }

        // Génération des prompts
        function generatePrompts() {
            const dialogue = dialogueText.value.trim();
            
            if (!dialogue) {
                alert("Veuillez saisir un dialogue avant de générer les prompts.");
                return;
            }
            
            const source = `START VERBATIM

DIRECTOR NOTES:
Lire le dialogue EXACTEMENT comme écrit.
Respecter les pauses et émotions indiquées.
Durée vidéo cible : 3 à 5 minutes.
Public cible : TikTok (16-30 ans).

DIALOGUE:

${dialogue}

[END VERBATIM]`;
            
            const prompt = `Lis le dialogue EXACTEMENT comme écrit dans la source.
Ajouter texte à l'écran pour chaque phrase-choc.
Respecter toutes les pauses et émotions indiquées.
Durée vidéo cible : 3 à 5 minutes.
Public cible : TikTok 16-30 ans.
Ne pas improviser, ne pas ajouter de contenu extérieur.`;

            document.getElementById('sourceOutput').textContent = source;
            document.getElementById('promptOutput').textContent = prompt;
            
            const resultsSection = document.getElementById('results-section');
            resultsSection.style.display = "block";
            resultsSection.scrollIntoView({behavior: "smooth"});
            
            // Ajouter la fonctionnalité de copie
            addCopyFunctionality();
        }

        // Ajouter la fonctionnalité de copie
        function addCopyFunctionality() {
            const preElements = document.querySelectorAll('pre');
            preElements.forEach(pre => {
                pre.onclick = function() {
                    const textToCopy = this.textContent;
                    navigator.clipboard.writeText(textToCopy).then(() => {
                        showCopyNotification();
                    });
                };
            });
        }

        // Afficher la notification de copie
        function showCopyNotification() {
            copyNotification.classList.add('show');
            setTimeout(() => {
                copyNotification.classList.remove('show');
            }, 2000);
        }

        // Initialisation
        document.addEventListener('DOMContentLoaded', function() {
            loadSavedDialogue();
            
            dialogueText.addEventListener('input', function() {
                updateLineCount();
                autoSave();
            });
            
            updateLineCount();
        });
    </script>
</body>
</html>
