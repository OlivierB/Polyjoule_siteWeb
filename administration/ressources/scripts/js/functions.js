/**
 * @function CheckAll(id_checkAll, name_checkBox)
 * @brief Option qui permet de tout sélectionner ou désélectionner.
 * @param id_checkAll Id de la checkbox permettant le cochage de toutes les autres
 * @param name_checkBox Nom des champs checkbox qui doivent être (dé)cochés
 * @return Vrai si tout sélectionner, faux sinon
 */
function CheckAll(id_checkAll, name_checkBox)
{
	if (document.getElementById(id_checkAll).checked == true) 
	{
		for (i = 0; i < name_checkBox.length; i++)
		{
			document.getElementsByName(name_checkBox)[i].checked = true;
		}
		return true;
	}
	else
	{
		for (i = 0; i < name_checkBox.length; i++)
		{
			document.getElementsByName(name_checkBox)[i].checked = false;
		}
		return false;
	}
};

/**
 * @function Id(id)
 * @brief Raccourcie de document.getElementById()
 * @param id Id de l'élément à renvoyer
 * @return Retourne l'objet associé à l'id "id"
 */
function Id(id)
{
	return document.getElementById(id);
}

/**
 * @function Submit_enter(myfield,e)
 * @brief Transmet le formulaire myfield si la touche entrée est préssée.
 * @param myfield Formulaire à soumettre
 * @param e Evénement généré par l'appui sur une touche du clavier
 */
function Submit_enter(myfield,e)
{
	var keycode;
	
	if (window.event) keycode = window.event.keyCode;
	else if (e) keycode = e.which;
	
	if (keycode == 13)
	{
		myfield.form.submit();
	}
}

function recuperer_selection(name,nb,redirection)
{
	var toReturn = redirection;
	var i;
	for(i=0;i<nb;i++)
	{
		if(document.getElementsByName(name)[i].checked == true)
		{
			toReturn += "&id[]="+document.getElementsByName(name)[i].value;
		}
	}
	return toReturn;
}

function valider_ajoutArticle()
{
  if(document.ajoutArticle.titleFR.value != "" && document.ajoutArticle.titleEN.value != "")
		document.ajoutArticle.submit();
  else
		alert("Veuillez remplir tout les champs du formulaire.");
}

function check_form_contact()
{
  // si la valeur du champ titleFR n'est pas vide
  if(document.contact.objet.value != "" && document.contact.message.value != "")
		document.contact.submit();
  else
		alert("Veuillez remplir tout les champs du formulaire.");
}

