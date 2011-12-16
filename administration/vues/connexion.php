<?php
if(isset($_POST['login']) && $_POST['login']!="" && isset($_POST['passwd']) && $_POST['passwd']!="")
{
	$req = mysql_query("SELECT COUNT(id_membre) AS nbr, id_membre, pseudo_membre, mdp_membre FROM MEMBRE WHERE pseudo_membre='".$_POST['login']."'") or die("Erreur");
	$membre = mysql_fetch_array($req);
	if($membre[0]==1)
	{
		if(sha1($_POST['passwd']) == $membre[3])
		{
			$_SESSION['id_membre'] = $membre[1];
			$_SESSION['pseudo_membre'] = $membre[2];
			header('Location: index.php');
		}
		else
		{
			$erreur="Erreur de mot de passe";
		}
	}
	else
	{
		$erreur="Erreur de login";
	}
}
?>	
	
<style>
body{
	background-image : none;
	background-color : #406BA4;
	color : white;
	font-size : 100%;
}
#connexion{
	margin : 100px auto auto auto;
	width:500px;
	height:300px;
	background-color : #406BA4;
	border-radius : 10px;
	border : 2px solid #FFFFFF;
}
label {
float: left;
text-align: right;
}
 
input {
float: right;
text-align: left;
margin-right : 50px;
}
.button {
   border-top: 1px solid #ff9500;
   background: #ff9900;
   background: -webkit-gradient(linear, left top, left bottom, from(#ffc800), to(#ff9900));
   background: -webkit-linear-gradient(top, #ffc800, #ff9900);
   background: -moz-linear-gradient(top, #ffc800, #ff9900);
   background: -ms-linear-gradient(top, #ffc800, #ff9900);
   background: -o-linear-gradient(top, #ffc800, #ff9900);
   padding: 6px 12px;
   -webkit-border-radius: 11px;
   -moz-border-radius: 11px;
   border-radius: 11px;
   -webkit-box-shadow: rgba(0,0,0,1) 0 1px 0;
   -moz-box-shadow: rgba(0,0,0,1) 0 1px 0;
   box-shadow: rgba(0,0,0,1) 0 1px 0;
   text-shadow: rgba(0,0,0,.4) 0 1px 0;
   color: #ffffff;
   font-size: 17px;
   font-family: Georgia, Serif;
   text-decoration: none;
   vertical-align: middle;
   }
.button:hover {
	color : black;
   }

p {
clear: both;
} 
</style>
<div id='connexion'>
	<div style="text-align : center;">
		<h2>Service d'authentification du site Polyjoule</h2>
		<p>Pour vous identifier et accéder à l'interface d'administration, veuillez entrer vos codes personnels et valider en cliquant sur le bouton connexion.</p>
	</div>
	<div style="margin:auto auto auto 30px;">
	<img src="ressources/design/classique/images/lock.png"/>
	</div>
	<div style="margin:-128px auto auto 200px;">
	<form name="connexion" method="post" action="index.php">
		<p><strong><label for="login">Login :</label></strong><input type="text" value="" name="login"/></p>
		<p><strong><label for="passwd">Password : </label></strong><input type="password" value="" name="passwd"/></p>
		<p style="margin-top: 70px;margin-left:120px;"><a class="button" href="javascript:document.connexion.submit()">Connexion</a></p>
	</form>
	<?php
		if(isset($erreur))
			echo $erreur;
	?>
	</div>
</div>