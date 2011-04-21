<p><strong>Avertissement : Le back-office n'est pas utilisable dans sa version actuelle sur les diff�rentes version d'Internet Explorer. Merci d'utiliser id�alement Chrome/Safari, sinon Firefox</strong></p>

<h3>Manuel d'utilisation</h3>

<h4>Introduction</h4>
<p>Ce back-office est pr�vu pour g�rer l'ensemble du site Sculpture-SRC et a �t� cr�� par Jean-Baptiste Minvielle, Micka�l Descoudard, Paul Rouger et Fabian Rivi�re au printemps 2011, en vue de la soutenance du 8 avril 2010 dans le cadre des projets tuteur�s de SRC Blois.</p>
<p>Il est bas� sur la base de donn�e associ�e et est pr�vu pour �tre th�oriquement utilisable sur les ann�es � venir et les autres projets artistiques de l'IUT.</p>

<p>Les sections suivantes apportent une documentation sur l'utilisation compl�te de l'administration. Pour cr�er une nouvelle ann�e et ajouter du contenu � partir d'une page blanche, les sections sont lisibles dans l'ordre. Pour l'�dition ou la cr�ation d'un contenu particulier pri�re de se r�f�rer � la section qui correspond � la demande</p>

<p>Il est possible d'ouvrir les sections dans des nouveaux onglets (avec la touche CTRL ou CMD lors du clic) pour garder la page d'accueil sous la main</p>

<h4>Pr�sentations g�n�rales</h4>
<p>Chaque sections du back-office correspond � une table de la base de donn�e pr�cise. Leurs icones sont organis�es de fa�on � cr�er le contenu dans l'ordre. Dans chaques sections les enregistrements de la table sont pr�sent�es sous formes d'icones (avec l'aper�u des image le cas �ch�ant). Un champs recherche est disponible en haut � droite de chaque section. Il suffit de taper quelques lettres du d�but d'un mot ou d'un nom pour filtrer les icones.</p>
<p>Un clic sur une icone enregitrements entraine l'ouverture d'une pop-up dans la page dont le chargement et la validation se fait en ajax. Les champs �ditables sont pr�sent�s � gauche, et des modules particuliers sont pr�sent�s � droite.</p>
<p>La premi�re icone de chaque module repr�sente l'ajout d'enregistrement dans la table correspondante.</p>

<h4>La cr�ation d'ann�e</h4>
<p>Pour cr�er une nouvelle ann�e <em>(c�d une nouvelle promotion et une nouvelle sculpture)</em>, aller dans la section <strong>Promotions</strong>. Un seul champs est disponible : le nom de l'ann�e. C'est une �tape n�cessaire � la cr�ations de contenu pour chaque promotions</p>

<h4>L'ajout de personnes</h4>
<p>Chaque personnes intervenant dans le projet est identifi� dans la base. Ce ne sont pas des utilisateurs du back-office : un seul identifiant est disponible et il est inscrit en dur dans le code source : voir pour modification le fichier <em>functions.php</em></em>
<p>Les personnes r�pertori�es dans cette section sont utilis�es pour les sections <em>Symboles</em> et <em>Avis</em>. Il est n�cessaire de les cr�er dans la base de donn�e avant de cr�er du contenu dans ces sections</p>
<p>Les champs disponibles sont le nom, le pr�nom et le statut de la personne. Comme une personne peut �tre pr�sente sur plusieurs ann�es, il n'est pas possible de l'associer � une ann�e pr�cise. La recherche reste pr�sente pour trouver facilement une personne en particulier.</p>

<h4>La gestion des images</h4>
<p>Ce module recense toutes les images stoqu�es dans la base. Un aper�u est disponible � la place des icones.</p>
<p>Lors de l'ajout/�dition des images, Seul son nom est �ditable : il est primordial d'en choisir un qui soit perspicace, car lors de la recherche c'est avec son nom qu'on peut retrouver l'image. Sur la gauche un aper�u de l'image et un bouton d'upload de fichier. Si aucun nom n'est d�j� entr� dans le champs "nom" le back office compl�tera automatiquement avec le nom du fichier upload�.</p>
<p>Les fichiers images sont utilis�s par les modules <em>face de la sclupture</em>, <em>Symboles</em>, et dans les contenus des pages, des avanc�es du projet, des avis et du descriptif des symboles (elle peuvent toutefois �tre ajout�es directement depuis ces modules pour plus de souplesse, mais toutes les images sont r�pertori�es dans cette section).</p>

<h4>La gestion des pages</h4>
<p>Pour chaque projet il est utile d'avoir des contenus de description ou de texte libre. Vous pouvez cr�er n'importe quelle page depuis ce panneau en vue de l'int�grer dans les pages du front-office. Un titre est n�cessaire ainsi qu'une ann�e attach�e � cette page. Le contenu est �ditable en texte riche et des images peuvent �tre ins�r�es.</p>

<h4>L'avanc�e du projet</h4>
<p>Une section avanc�es du projet est pr�vue dans le front office actuel : il est g�r� depuis ce module qui permet une souplesse d'utilisation dans les �tapes distinctes du projet : chaque �tape correspond � un enregisrement dans la section. Chaque actualit�s est identifi� par un titre, une date qui correspond � celle de l'actualit�, et l'ann�e � laquelle l'�tape est attach�e Le contenu est �ditable en texte riche et des images peuvent �tre ins�r�es.</p>

<h4>La gestion des faces</h4>
<p>Chaque sculpture est g�r�e ainsi : elle est d�compos�e en faces distinctes sur laquelle vient se greffer les symboles. C'est un mod�le qui correspond au plus de projets possibles, mais qui n'est pas id�al. Il convient donc de les d�terminer dans cette section pour l'affichage dans le front office. Chaque face est identifi�e par un nom, l'ann�e de la sulpture et  une image qui repr�sente la face (important : pour �viter un fastidieux travail de red�finition des symboles, choisir d�s le d�but l'image qui va correspondre � l'affichage final, voir � ce sujet le chapitre sur la gestion des symboles).</p>

<h4>La gestion des symboles</h4>
<p>Cette section permet de d�finir les symboles pr�sents sur les faces de la sculpture (voir le chapitre <em>gestion des faces</em> pour plsu d'informations. Chaque symbole est identifi� par son auteur (idPersonne), l'image principale du symbole, la face sur laquelle il doit �tre pos� et l'ann�e du projet auquel il appartient. Le descriptif est �ditable en texte riche et des images peuvent �tre ins�r�es.</p>
<p>Sur la gauche un aper�u du symbole est visible, ainsi qu'un champs pour changer l'image (ce bouton ajoutera une image dans la section Images). Un module est �galement pr�sent pour localiser le symbole sur la face : le visuel de la face est affich� et il suffit de s�lectionner sa localisation avec la sourie, comme si l'on rognait une image. C'est pour cela qu'il est important de d�finir d�s le d�but le visuel de la face pour ne pas que les coordonn�es de la face soient � red�finir en cas de changement d'image.</p>
<p>Il est utile de noter que le visuel de la face doit d�j� inclure les symboles car le logiciel ne les ajoute pas lui-m�me : les coordon�es ne servent qu'� d�finir les zones cliquables des symboles.</p>

<h4>L'ajout d'avis</h4>
<p>Les avis sont pr�sents sur la page avis, et sont class� selon qu'ils viennent d'un �l�ve, d'un professeur ou de quelqu'un d'ext�rieur au projet. Ils n'ont pas de titre mais sont identifi�s par la personne qui a �crit l'avis. Ils sont �galement attach�s � l'ann�e du projet. Le contenu est �ditable en texte riche et des images peuvent �tre ins�r�es.</p>

<h4>Cr�dits</h4>
<p>L'ensemble du code du back-office a �t� r�dig� par Jean-Baptiste Minvielle (jean.baptiste.minvielle@gmail.com), les icones ont �t� design�es par Paul Rouger. Le fonctionnement g�n�ral a �t� pens� avec tous les membres du groupe (Jean-Baptiste Minvielle, Micka�l Descoudard, Paul Rouger et Fabian Rivi�re) avec le concours de Jean-Louis Lapouille, concepteur du projet.</p>