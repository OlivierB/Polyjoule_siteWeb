/**
 * function CheckAll(id_checkAll, name_checkBox)
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
}