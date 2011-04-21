<p><strong>Avertissement : Le back-office n'est pas utilisable dans sa version actuelle sur les différentes version d'Internet Explorer. Merci d'utiliser idéalement Chrome/Safari, sinon Firefox</strong></p>

<h3>Manuel d'utilisation</h3>

<h4>Introduction</h4>
<p>Ce back-office est prévu pour gérer l'ensemble du site Sculpture-SRC et a été créé par Jean-Baptiste Minvielle, Mickaël Descoudard, Paul Rouger et Fabian Rivière au printemps 2011, en vue de la soutenance du 8 avril 2010 dans le cadre des projets tuteurés de SRC Blois.</p>
<p>Il est basé sur la base de donnée associée et est prévu pour être théoriquement utilisable sur les années à venir et les autres projets artistiques de l'IUT.</p>

<p>Les sections suivantes apportent une documentation sur l'utilisation complète de l'administration. Pour créer une nouvelle année et ajouter du contenu à partir d'une page blanche, les sections sont lisibles dans l'ordre. Pour l'édition ou la création d'un contenu particulier prière de se référer à la section qui correspond à la demande</p>

<p>Il est possible d'ouvrir les sections dans des nouveaux onglets (avec la touche CTRL ou CMD lors du clic) pour garder la page d'accueil sous la main</p>

<h4>Présentations générales</h4>
<p>Chaque sections du back-office correspond à une table de la base de donnée précise. Leurs icones sont organisées de façon à créer le contenu dans l'ordre. Dans chaques sections les enregistrements de la table sont présentées sous formes d'icones (avec l'aperçu des image le cas échéant). Un champs recherche est disponible en haut à droite de chaque section. Il suffit de taper quelques lettres du début d'un mot ou d'un nom pour filtrer les icones.</p>
<p>Un clic sur une icone enregitrements entraine l'ouverture d'une pop-up dans la page dont le chargement et la validation se fait en ajax. Les champs éditables sont présentés à gauche, et des modules particuliers sont présentés à droite.</p>
<p>La première icone de chaque module représente l'ajout d'enregistrement dans la table correspondante.</p>

<h4>La création d'année</h4>
<p>Pour créer une nouvelle année <em>(càd une nouvelle promotion et une nouvelle sculpture)</em>, aller dans la section <strong>Promotions</strong>. Un seul champs est disponible : le nom de l'année. C'est une étape nécessaire à la créations de contenu pour chaque promotions</p>

<h4>L'ajout de personnes</h4>
<p>Chaque personnes intervenant dans le projet est identifié dans la base. Ce ne sont pas des utilisateurs du back-office : un seul identifiant est disponible et il est inscrit en dur dans le code source : voir pour modification le fichier <em>functions.php</em></em>
<p>Les personnes répertoriées dans cette section sont utilisées pour les sections <em>Symboles</em> et <em>Avis</em>. Il est nécessaire de les créer dans la base de donnée avant de créer du contenu dans ces sections</p>
<p>Les champs disponibles sont le nom, le prénom et le statut de la personne. Comme une personne peut être présente sur plusieurs années, il n'est pas possible de l'associer à une année précise. La recherche reste présente pour trouver facilement une personne en particulier.</p>

<h4>La gestion des images</h4>
<p>Ce module recense toutes les images stoquées dans la base. Un aperçu est disponible à la place des icones.</p>
<p>Lors de l'ajout/édition des images, Seul son nom est éditable : il est primordial d'en choisir un qui soit perspicace, car lors de la recherche c'est avec son nom qu'on peut retrouver l'image. Sur la gauche un aperçu de l'image et un bouton d'upload de fichier. Si aucun nom n'est déjà entré dans le champs "nom" le back office complètera automatiquement avec le nom du fichier uploadé.</p>
<p>Les fichiers images sont utilisés par les modules <em>face de la sclupture</em>, <em>Symboles</em>, et dans les contenus des pages, des avancées du projet, des avis et du descriptif des symboles (elle peuvent toutefois être ajoutées directement depuis ces modules pour plus de souplesse, mais toutes les images sont répertoriées dans cette section).</p>

<h4>La gestion des pages</h4>
<p>Pour chaque projet il est utile d'avoir des contenus de description ou de texte libre. Vous pouvez créer n'importe quelle page depuis ce panneau en vue de l'intégrer dans les pages du front-office. Un titre est nécessaire ainsi qu'une année attachée à cette page. Le contenu est éditable en texte riche et des images peuvent être insérées.</p>

<h4>L'avancée du projet</h4>
<p>Une section avancées du projet est prévue dans le front office actuel : il est géré depuis ce module qui permet une souplesse d'utilisation dans les étapes distinctes du projet : chaque étape correspond à un enregisrement dans la section. Chaque actualités est identifié par un titre, une date qui correspond à celle de l'actualité, et l'année à laquelle l'étape est attachée Le contenu est éditable en texte riche et des images peuvent être insérées.</p>

<h4>La gestion des faces</h4>
<p>Chaque sculpture est gérée ainsi : elle est décomposée en faces distinctes sur laquelle vient se greffer les symboles. C'est un modèle qui correspond au plus de projets possibles, mais qui n'est pas idéal. Il convient donc de les déterminer dans cette section pour l'affichage dans le front office. Chaque face est identifiée par un nom, l'année de la sulpture et  une image qui représente la face (important : pour éviter un fastidieux travail de redéfinition des symboles, choisir dès le début l'image qui va correspondre à l'affichage final, voir à ce sujet le chapitre sur la gestion des symboles).</p>

<h4>La gestion des symboles</h4>
<p>Cette section permet de définir les symboles présents sur les faces de la sculpture (voir le chapitre <em>gestion des faces</em> pour plsu d'informations. Chaque symbole est identifié par son auteur (idPersonne), l'image principale du symbole, la face sur laquelle il doit être posé et l'année du projet auquel il appartient. Le descriptif est éditable en texte riche et des images peuvent être insérées.</p>
<p>Sur la gauche un aperçu du symbole est visible, ainsi qu'un champs pour changer l'image (ce bouton ajoutera une image dans la section Images). Un module est également présent pour localiser le symbole sur la face : le visuel de la face est affiché et il suffit de sélectionner sa localisation avec la sourie, comme si l'on rognait une image. C'est pour cela qu'il est important de définir dès le début le visuel de la face pour ne pas que les coordonnées de la face soient à redéfinir en cas de changement d'image.</p>
<p>Il est utile de noter que le visuel de la face doit déjà inclure les symboles car le logiciel ne les ajoute pas lui-même : les coordonées ne servent qu'à définir les zones cliquables des symboles.</p>

<h4>L'ajout d'avis</h4>
<p>Les avis sont présents sur la page avis, et sont classé selon qu'ils viennent d'un élève, d'un professeur ou de quelqu'un d'extérieur au projet. Ils n'ont pas de titre mais sont identifiés par la personne qui a écrit l'avis. Ils sont également attachés à l'année du projet. Le contenu est éditable en texte riche et des images peuvent être insérées.</p>

<h4>Crédits</h4>
<p>L'ensemble du code du back-office a été rédigé par Jean-Baptiste Minvielle (jean.baptiste.minvielle@gmail.com), les icones ont été designées par Paul Rouger. Le fonctionnement général a été pensé avec tous les membres du groupe (Jean-Baptiste Minvielle, Mickaël Descoudard, Paul Rouger et Fabian Rivière) avec le concours de Jean-Louis Lapouille, concepteur du projet.</p>