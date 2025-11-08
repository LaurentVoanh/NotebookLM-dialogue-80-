# Générateur de Dialogue Vidéo pour NotebookLM

Bienvenue sur ce projet ! Ce générateur permet de créer facilement des dialogues pour NotebookLM afin de produire des vidéos interactives et immersives. Il est spécialement pensé pour la création rapide de contenus vidéo pour TikTok ou d’autres réseaux, avec des personnages et des humeurs paramétrables.

---

## 📄 Fichiers principaux

### `index.html`
- Version **basique** du générateur.
- Permet d’ajouter des lignes de dialogue, de choisir la manière de lire chaque ligne et la pause après chaque phrase.
- Génère deux prompts :
  1. **Source** à copier-coller dans NotebookLM.
  2. **Prompt d’exécution** à coller dans la fenêtre d’édition de la vidéo.

### `indexV2.html`
- Version **améliorée** et plus rapide.
- **Deux boutons distincts** pour ajouter directement une ligne pour **Personnage A** ou **Personnage B**.
- Permet de créer les dialogues plus rapidement et plus intuitivement.
- Inclus **scroll automatique** pour voir immédiatement les prompts générés.
- Responsive et optimisé pour smartphone.

---

## ⚙️ Fonctionnalités

1. **Choix des humeurs des personnages**  
   - Personnage A et Personnage B.  
   - Humeurs disponibles : `Joyful`, `Sad`, `Furious`, `Reflective`, `Hallucinated`, `Calm`, `Surprised`, `Melancholic`, `Excited`, `Angry`.

2. **Création des lignes de dialogue**  
   - Choix du personnage (A ou B).  
   - Texte de la ligne (max 150 caractères).  
   - Style / manière de lire : `Normal`, `Lyrique`, `Ironique`, `Emphatique`, `Hallucinée`.  
   - Pause après la ligne (en secondes, valeur par défaut 0.0).

3. **Génération des prompts**  
   - Premier prompt : **Source** à copier-coller dans NotebookLM.  
   - Second prompt : **Prompt d’exécution vidéo** à copier-coller dans la fenêtre d’édition pour lancer la lecture.  
   - Les prompts respectent toutes les humeurs, styles et pauses définies.  
   - Compatible pour une production rapide de vidéos TikTok (16-30 ans).

4. **Praticité mobile**  
   - Design responsive, lisible sur smartphone.  
   - Scroll automatique sur les prompts générés.  
   - IndexV2 permet de gagner du temps avec les boutons directs pour chaque personnage.

---

## 🚀 Comment utiliser

1. Ouvrir `index.html` pour la version basique ou `indexV2.html` pour la version rapide.  
2. Sélectionner les humeurs des personnages A et B.  
3. Ajouter des lignes de dialogue en choisissant le personnage et le style de lecture.  
4. Régler les pauses si nécessaire.  
5. Cliquer sur **Générer la Source & le Prompt**.  
6. Copier le **premier prompt** dans la source de NotebookLM.  
7. Copier le **second prompt** dans la fenêtre d’édition de la vidéo pour lancer la lecture.  

---

## 📌 Remarques

- Les noms des personnages ne sont pas modifiables : toujours **Personnage A** et **Personnage B**.  
- Les pauses, styles et humeurs respectent les paramètres acceptés par NotebookLM.  
- L’utilisateur peut ajouter autant de lignes qu’il le souhaite.  
- Ce projet est conçu pour TikTok mais fonctionne avec tout type de production vidéo NotebookLM.

---

## 💡 Suggestions futures

- Ajouter un **aperçu en temps réel** pour visualiser les pauses et le style de lecture.  
- Permettre de **réorganiser les lignes par glisser-déposer**.  
- Exporter les dialogues en **CSV/JSON** pour réutilisation ultérieure.  
- Ajouter des **templates prédéfinis** pour différents types de dialogues et personnages.

---

Merci d’utiliser ce générateur ! Vos retours et contributions sont les bienvenus.  
laurent vo anh
