/* 
 * Vérification d'un formulaire
 */

//Début du programme
//Création de variables ayant comme valeur les éléments html à tester ou à modifier
var nom = document.getElementById("nom"); 
var prenom = document.getElementById("prénom");
var date = document.getElementById("date");
var adresse = document.getElementById("adresse");
var ville = document.getElementById("ville");
var code = document.getElementById("code");
var mail = document.getElementById("mail");
var metier = document.getElementById("métier");
var zoneTexte = document.getElementById("commentaires");
var dateAfpa = document.getElementById("date_afpa");
var formuValide = document.getElementById("envoyer");
var precision = document.getElementById("précision");




var message1 = document.getElementById("message1");
var message2 = document.getElementById("message2");
var message3 = document.getElementById("message3");
var message4 = document.getElementById("message4");
var message5 = document.getElementById("message5");
var message6 = document.getElementById("message6");
var message7 = document.getElementById("message7");
var message8 = document.getElementById("message8");
var message9 = document.getElementById("message9");

//déclaration de variables contenant des expressions régulières
var r1 = /^([a-zA-Z'àâäãåéèêëôöœøùûüçñÀÂÄÃÅÉÈËÔÖŒØÙÛÜÇÑ\s -]{1,30})$/; //regex pour les noms 
var r2 = /^[0-9]{5}$/; //regex pour le code postal
var r3 = /^[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/; //regex pour l'adresse mel
var r4 = /^(0[1-9]|[12][0-9]|3[01])\/(0[1-9]|1[012])\/[1|2]\d{3}$/; //regex pour la date
var r5 = /^(?:19|20)[0-9]{2}$/; //regex pour l'année
var r6 = /^[0-9]{0,5}(?:bis|ter|b|t)?,? ?[a-zA-Z'àâäãåéèêëôöœøùûüçñÀÂÄÃÅÉÈËÔÖŒØÙÛÜÇÑ\s -]+$/; //regex pour l'adresse

//déclaration des fonctions décrivant ce qui se passe pour certains événements donnés
function verifierNom() //cette fonction permet de vérifier le nom entré par l'utilisateur 
{
  if (r1.test(nom.value)===false) //Si le nom n'est pas valide (comparaison avec la regex)
  {
	  message1.textContent= "Nom non valide"; //Un message apparaît dans une balise div placée à côté de la balise input et qui porte l'id "message1"
	  message1.style.color = "red"; //Ce message est écrit en rouge 
  }
  else
  {
	  message1.textContent= ""; //Si le nom est valide, aucun message n'apparaît ou bien le message est effacé
  }
}

function verifierPrenom() //cette fonction permet de vérifier le prénom
{
  if (r1.test(prenom.value)===false) //Si le prénom n'est pas valide
  {
	message2.textContent = "Prénom non valide"; //Un message apparaît dans une balise div placée à côté de la balise input et qui porte l'id "message"
    message2.style.color = "red"; //Ce message est écrit en rouge 
  }
  else
  {
	message2.textContent = ""; //Si le prénom est valide, aucun message n'apparaît ou bien le message est effacé
  }
}

function verifierDate() //cette fonction permet de vérifier la date
{
  if (r4.test(date.value)===false) //Si la date n'est pas valide
  {
	message3.textContent = "Date non valide"; //Un message apparaît dans une balise div placée à côté de la balise input et qui porte l'id "message"
    message3.style.color = "red"; //Ce message est écrit en rouge 
  }
  else
  {
	message3.textContent = "";  
  }
}

function verifierAdresse() 
{
  if (r6.test(adresse.value)===false) 
  {
	message4.textContent = "Adresse non valide"; 
    message4.style.color = "red"; 
  }
  else
  {
	message4.textContent = ""; 
  }
}

function verifierVille() 
{
  if (r1.test(ville.value)===false) 
  {
	message5.textContent = "Ville non valide"; 
    message5.style.color = "red"; 
  }
  else
  {
	message5.textContent= ""; 
  }
}

function verifierCode() 
{
  if (r2.test(code.value)===false) 
  {
	message6.textContent = "Code postal non valide"; 
    message6.style.color = "red"; 
  }
  else
  {
	message6.textContent = ""; //Si le numéro est valide, aucun message n'apparaît ou bien le message est effacé
  }
}

function verifierMel()
{
  if (r3.test(mail.value)===false) 
  {
	message7.textContent = "Mél non valide"; 
    message7.style.color = "red";  
  }
  else
  {
	message7.textContent = ""; 
  }
}

function verifierMetier() //fonction qui permet de vérifier que l'utilisateur a bien précisé un métier s'il a sélectionné "autre" dans la liste des métiers
{
  if ((metier.value == "autre")&&(r1.test(precision.value)===false)) 
  {
	message8.textContent = "N'oubliez pas de préciser votre métier."; 
    message8.style.color = "red";  
  }
  else if ((metier.value == "autre")&&(r1.test(precision.value)===true))
  {
	message8.textContent = ""; 
  }
  else
  {
	message8.textContent = ""; 
  }
}

function verifierAnnee() 
{
  if (r5.test(date_afpa.value)===false) 
  {
	message9.textContent = "Année non valide"; 
    message9.style.color = "red";  
  }
  else
  {
	message9.textContent= ""; //Si le numéro est valide, aucun message n'apparaît ou bien le message est effacé
  }
}

function verifierFormulaire(e) //fonction qui permet de vérifier la validité du formulaire avant l'envoi. Si un champ est mal rempli, le formulaire n'est pas envoyé et un message d'erreur apparaît
{
	if ((r1.test(nom.value)===false)||(r1.test(prenom.value)===false)||(r4.test(date.value)===false)||(r6.test(adresse.value)===false)||(r1.test(ville.value)===false)||(r2.test(code.value)===false)||(r3.test(mail.value)===false)||((metier.value == "autre")&&(precision.value== ""))||(r5.test(date_afpa.value)===false))
	{
		 alert("Le formulaire ne peut être envoyé.\nVeuillez vérifier que vous avez correctement rempli les champs.");
		 e.preventDefault(); 
	}
}




//appel des fonctions permettant de vérifier les champs. Ces fonctions sont appelées pour l'événement "blur", c'est-à-dire quand le focus quitte le champ
nom.addEventListener("blur",verifierNom); 
prenom.addEventListener("blur",verifierPrenom);
date.addEventListener("blur",verifierDate);
adresse.addEventListener("blur",verifierAdresse);
ville.addEventListener("blur",verifierVille);
code.addEventListener("blur",verifierCode);
mail.addEventListener("blur",verifierMel);
precision.addEventListener("blur",verifierMetier);
date_afpa.addEventListener("blur",verifierAnnee);
//appel de la fonction permettant de bloquer l'envoi du formulaire lorsque l'utilisateur clique sur "envoyer"
formuValide.addEventListener("click",verifierFormulaire); 



//Fin du programme

