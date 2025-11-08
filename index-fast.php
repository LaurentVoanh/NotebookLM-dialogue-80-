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
body { font-family: Arial, sans-serif; margin:10px; background:#f7f7f7; color:#222; }
h1,h2 { text-align:center; font-size:1.4em; }
.section { background:#fff; padding:15px; margin-bottom:15px; border-radius:8px; box-shadow:0 2px 5px rgba(0,0,0,0.1); }
button { margin:6px 0; padding:10px; width:48%; border:none; border-radius:5px; background:#007BFF; color:#fff; font-size:0.95em; cursor:pointer; }
button:hover { background:#0056b3; }
textarea { width:100%; height:400px; padding:10px; font-family: monospace; font-size:0.9em; margin-top:6px; border-radius:5px; border:1px solid #ccc; }
pre { background:#eee; padding:10px; border-radius:5px; overflow-x:auto; font-size:0.85em; }
</style>
</head>
<body>

<h1>Éditeur NotebookLM - Dialogue Vidéo</h1>

<div class="section">
<h2>1️⃣ Texte du dialogue</h2>
<p>Modifiez directement le dialogue ci-dessous. Les lignes sont pré-remplies avec Personnage A et Personnage B alternés. Cliquez sur un bouton pour ajouter une émotion à la fin de la ligne sélectionnée.</p>

<textarea id="dialogueText">
<?php
// Pré-remplissage de 20 lignes alternées A/B
for ($i=1; $i<=20; $i++) {
    $personnage = ($i % 2 == 1) ? "Personnage A" : "Personnage B";
    echo $personnage.": \n";
}
?>
</textarea>

<div style="display:flex; justify-content:space-between; flex-wrap:wrap; margin-top:10px;">
<button type="button" onclick="addEmotion('[Joyful]')">Ajouter [Joyful]</button>
<button type="button" onclick="addEmotion('[Sad]')">Ajouter [Sad]</button>
<button type="button" onclick="addEmotion('[Furious]')">Ajouter [Furious]</button>
<button type="button" onclick="addEmotion('[Reflective]')">Ajouter [Reflective]</button>
<button type="button" onclick="addEmotion('[Calm]')">Ajouter [Calm]</button>
<button type="button" onclick="addEmotion('[Melancholic]')">Ajouter [Melancholic]</button>
<button type="button" onclick="addEmotion('[Excited]')">Ajouter [Excited]</button>
<button type="button" onclick="addEmotion('[Angry]')">Ajouter [Angry]</button>
</div>
</div>

<div class="section">
<button onclick="generatePrompts()">🎬 Générer Source & Prompt</button>
</div>

<div class="section" id="results-section" style="display:none;">
<h2>2️⃣ Résultats générés</h2>
<p><strong>Premier prompt :</strong> à copier-coller en <strong>source</strong> dans NotebookLM.</p>
<pre id="sourceOutput"></pre>
<p><strong>Second prompt :</strong> à copier-coller dans la <strong>fenêtre d’édition de la vidéo</strong> pour lancer la lecture.</p>
<pre id="promptOutput"></pre>
</div>

<script>
function addEmotion(emotion) {
    const textarea = document.getElementById('dialogueText');
    const cursorPos = textarea.selectionStart;
    const textBefore = textarea.value.substring(0, cursorPos);
    const textAfter = textarea.value.substring(cursorPos);
    textarea.value = textBefore + " " + emotion + textAfter;
    textarea.focus();
    textarea.selectionEnd = cursorPos + emotion.length + 1;
}

function generatePrompts() {
    const dialogue = document.getElementById('dialogueText').value.trim();
    const source = "START VERBATIM\n\nDIRECTOR NOTES:\nLire le dialogue EXACTEMENT comme écrit.\nRespecter les pauses et émotions indiquées.\nDurée vidéo cible : 3 à 5 minutes.\nPublic cible : TikTok (16-30 ans).\n\nDIALOGUE:\n\n" + dialogue + "\n\n[END VERBATIM]";
    
    const prompt = "Lis le dialogue EXACTEMENT comme écrit dans la source.\nAjouter texte à l’écran pour chaque phrase-choc.\nRespecter toutes les pauses et émotions indiquées.\nDurée vidéo cible : 3 à 5 minutes.\nPublic cible : TikTok 16-30 ans.\nNe pas improviser, ne pas ajouter de contenu extérieur.";

    document.getElementById('sourceOutput').textContent = source;
    document.getElementById('promptOutput').textContent = prompt;
    document.getElementById('results-section').style.display = "block";
    document.getElementById('results-section').scrollIntoView({behavior:"smooth"});
}
</script>

</body>
</html>
