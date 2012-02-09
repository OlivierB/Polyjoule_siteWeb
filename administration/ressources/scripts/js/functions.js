/**
 * @function CheckAll(id_checkAll, name_checkBox)
 * @brief Option qui permet de tout s�lectionner ou d�s�lectionner.
 * @param id_checkAll Id de la checkbox permettant le cochage de toutes les autres
 * @param name_checkBox Nom des champs checkbox qui doivent �tre (d�)coch�s
 * @return Vrai si tout s�lectionner, faux sinon
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
 * @param id Id de l'�l�ment � renvoyer
 * @return Retourne l'objet associ� � l'id "id"
 */
function Id(id)
{
	return document.getElementById(id);
}

/**
 * @function Submit_enter(myfield,e)
 * @brief Transmet le formulaire myfield si la touche entr�e est pr�ss�e.
 * @param myfield Formulaire � soumettre
 * @param e Ev�nement g�n�r� par l'appui sur une touche du clavier
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

function article_toDelete(nbArt)
{
	alert("nbARTICLE="+nbArt);
	var toDelete = new Array();
	var i,j=0;
	for(i=0;i<nbArt;i++)
	{
		if(document.getElementsByName('checkArticle')[i].checked == true)
		{
			toDelete[j]= document.getElementsByName('checkArticle')[i].value;
			j++;
		}
	}
	
	return toDelete;
}