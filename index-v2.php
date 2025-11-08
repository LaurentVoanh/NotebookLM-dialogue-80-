<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Générateur NotebookLM - Dialogue Vidéo</title>
<style>
body { font-family: Arial, sans-serif; margin:10px; background:#f7f7f7; color:#222; }
h1,h2 { text-align:center; font-size:1.4em; }
.section { background:#fff; padding:15px; margin-bottom:15px; border-radius:8px; box-shadow:0 2px 5px rgba(0,0,0,0.1); }
label { display:block; margin-top:8px; font-weight:bold; font-size:0.9em; }
select, textarea, input { width:100%; padding:8px; margin-top:4px; border-radius:4px; border:1px solid #ccc; font-size:0.9em; }
textarea { resize: vertical; }
button { margin-top:12px; padding:12px; width:100%; border:none; border-radius:5px; background:#007BFF; color:#fff; font-size:1em; cursor:pointer; }
button:hover { background:#0056b3; }
pre { background:#eee; padding:10px; border-radius:5px; overflow-x:auto; font-size:0.85em; }
.line-entry { margin-top:8px; padding:8px; background:#f0f0f0; border-radius:5px; }
</style>
</head>
<body>

<h1>Générateur NotebookLM - Dialogue Vidéo</h1>

<div class="section">
<h2>1️⃣ Définir les humeurs des personnages</h2>
<label>Humeur Personnage A :</label>
<select id="charA-mood">
  <option>Joyful</option>
  <option>Sad</option>
  <option>Furious</option>
  <option>Reflective</option>
  <option>Hallucinated</option>
  <option>Calm</option>
  <option>Surprised</option>
  <option>Melancholic</option>
  <option>Excited</option>
  <option>Angry</option>
</select>
<label>Humeur Personnage B :</label>
<select id="charB-mood">
  <option>Joyful</option>
  <option>Sad</option>
  <option>Furious</option>
  <option>Reflective</option>
  <option>Hallucinated</option>
  <option>Calm</option>
  <option>Surprised</option>
  <option>Melancholic</option>
  <option>Excited</option>
  <option>Angry</option>
</select>
</div>

<div class="section">
<h2>2️⃣ Entrer le dialogue</h2>
<div id="lines-container"></div>
<button type="button" onclick="addLine('A')">➕ Ajouter une ligne pour Personnage A</button>
<button type="button" onclick="addLine('B')">➕ Ajouter une ligne pour Personnage B</button>
</div>

<div class="section">
<button onclick="generateNotebook()">🎬 Générer la Source & le Prompt</button>
</div>

<div class="section" id="results-section" style="display:none;">
<h2>3️⃣ Résultats générés</h2>
<p><strong>Premier prompt :</strong> à copier-coller en **source** dans NotebookLM.</p>
<pre id="sourceOutput"></pre>
<p><strong>Second prompt :</strong> à copier-coller dans la **fenêtre d’édition de la vidéo** pour lancer la lecture.</p>
<pre id="promptOutput"></pre>
</div>

<script>
let lineCount = 0;

function addLine(character) {
  lineCount++;
  const container = document.getElementById('lines-container');
  const div = document.createElement('div');
  div.className = 'line-entry';
  div.innerHTML = `
    <label>Ligne ${lineCount} (${character})</label>
    <textarea class="line-text" maxlength="150" placeholder="Écrire la ligne (max 150 caractères)"></textarea>
    <label>Style / manière de lire :</label>
    <select class="line-style">
      <option>Normal</option>
      <option>Lyrique</option>
      <option>Ironique</option>
      <option>Emphatique</option>
      <option>Hallucinée</option>
    </select>
    <label>Pause après la ligne (en secondes) :</label>
    <input type="text" class="line-pause" value="0.0">
    <input type="hidden" class="character" value="${character}">
  `;
  container.appendChild(div);
  div.scrollIntoView({behavior:"smooth"});
}

function generateNotebook() {
  const moodA = document.getElementById('charA-mood').value;
  const moodB = document.getElementById('charB-mood').value;

  const lines = document.querySelectorAll('.line-entry');
  let source = "START VERBATIM\n\nDIRECTOR NOTES:\n";
  source += `Personnage A: Humeur=${moodA}\n`;
  source += `Personnage B: Humeur=${moodB}\n`;
  source += "Lire le dialogue EXACTEMENT comme écrit.\nRespecter les pauses indiquées.\n";
  source += "La vidéo doit suivre le dialogue avec texte à l’écran pour chaque phrase-choc.\nDurée vidéo cible : 3 à 5 minutes.\nPublic cible : TikTok (16-30 ans).\n\nDIALOGUE:\n\n";

  lines.forEach((line) => {
    const char = line.querySelector('.character').value;
    const text = line.querySelector('.line-text').value.trim();
    const style = line.querySelector('.line-style').value;
    const pause = line.querySelector('.line-pause').value || "0.0";
    if(text.length > 0){
      source += `Personnage ${char} (${style}): ${text} [PAUSE ${pause}s]\n`;
    }
  });

  source += "\n[END VERBATIM]";

  let prompt = `Lis le dialogue EXACTEMENT comme écrit dans la source.\n`;
  prompt += `Personnage A: Humeur=${moodA}\n`;
  prompt += `Personnage B: Humeur=${moodB}\n`;
  prompt += `Ajouter texte à l’écran pour chaque phrase-choc.\nRespecter toutes les pauses indiquées [PAUSE].\n`;
  prompt += `Durée vidéo cible : 3 à 5 minutes.\nPublic cible : TikTok 16-30 ans.\nNe pas improviser, ne pas ajouter de contenu extérieur.`;

  document.getElementById('sourceOutput').textContent = source;
  document.getElementById('promptOutput').textContent = prompt;
  const resultsSection = document.getElementById('results-section');
  resultsSection.style.display = "block";
  resultsSection.scrollIntoView({behavior:"smooth"});
}
</script>

</body>
</html>
