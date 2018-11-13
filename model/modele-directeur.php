<?php


require_once('connection.php');
    
function ajouterEmploye($id_employe,$mdp,$nom,$prenom,$fonction){
	$connexion=getConnect();
    $requete="INSERT INTO employe VALUES('$id_employe','$mdp','$fonction','$nom','$prenom')" ;
    $resultat=$connexion->query($requete);  
    $resultat->closeCursor();
}	
function chercherNomEmploye($nom){
	$connexion=getConnect();
	$requete="select * from employe where nom='$nom'"  ; 
	$resultat=$connexion->query($requete); 
	if($resultat->rowCount()==1)
	{
		$resultat->setFetchMode(PDO::FETCH_OBJ);
	    $employe=$resultat->fetchall(); // chargement du rés dans un tab
	    $resultat->closeCursor();
		return $employe;
	}
	else
	{
		return null;
	}
}
function choisirEmploye($login){
	$connexion=getConnect();
	$requete="select * from employe where id_employe='$login'"  ; 
	$resultat=$connexion->query($requete); 
	if($resultat->rowCount()==1)
	{
		$resultat->setFetchMode(PDO::FETCH_OBJ);
	    $employe=$resultat->fetchall(); // chargement du rés dans un tab
	    $resultat->closeCursor();
		return $employe;
	}else
		return null;
	}
function chercherTousLesEmploye(){
	$connexion=getConnect();
	$requete="select * from employe"  ; 
	$resultat=$connexion->query($requete);
	if($resultat->rowCount()>=1)
	{
		$resultat->setFetchMode(PDO::FETCH_OBJ);
	    $employe=$resultat->fetchall(); // chargement du rés dans un tab
	    $resultat->closeCursor();
		return $employe;
	}
	else
	{
		return null;
	}
}
	
function supprimerEmploye($login){
   
	$connexion=getConnect();
    $requete="delete from employe where id_employe='$login'";
   
    $resultat=$connexion->query($requete);  
    $resultat->closeCursor();
}
function modifierEmployeLogin($login,$ancien){
	$connexion=getConnect();
    $requete="update employe  SET id_employe='$login' where id_employe='$ancien'";
    $resultat=$connexion->query($requete);  
    $resultat->closeCursor();
}
function modifierEmployeMdp($mdp1,$ancien){
	$connexion=getConnect();
    $requete="update employe SET mdp='$mdp1' where id_employe='$ancien'";
    $resultat=$connexion->query($requete);  
    $resultat->closeCursor();
}	
function ajouterIntervention($nom_intervention,$prixIntervention){
	$connexion=getConnect();
    $requete="INSERT INTO type_intervention VALUES(NULL,'$nom_intervention',$prixIntervention)" ;
    $resultat=$connexion->query($requete);  
    $resultat->closeCursor();
}
function getIntervention()
{
	$connexion=getConnect();
	$requete="SELECT * FROM type_intervention"  ; 
	$resultat=$connexion->query($requete); 
	if($resultat->rowCount()>=1)
	{
	$resultat->setFetchMode(PDO::FETCH_OBJ);
    $intervention=$resultat->fetchall(); // chargement du rés dans un tab
    $resultat->closeCursor();
	return $intervention;
	}
	else
	{
		return null;
	}
}

function supprimerIntervention($login){
	$connexion=getConnect();
    $requete="delete from type_intervention where id_type='$login'";
    $resultat=$connexion->query($requete);  
    $resultat->closeCursor();
}
function ajouterElement($nom_element,$nom_intervention)
{	
	$connexion=getConnect();
	$req="select id_type from type_intervention where nom_type='$nom_intervention'";
	$result=$connexion->query($req);
	$result->setFetchMode(PDO::FETCH_OBJ);
	$id_type=$result->fetch();
	$id=$id_type->id_type;
    $requete="INSERT INTO elements VALUES (NULL, '$nom_element',$id)" ;
    $resultat=$connexion->query($requete);  
    $resultat->closeCursor();
}
function getElement()
{
	$connexion=getConnect();
	$requete="select * from elements" ; 
	$resultat=$connexion->query($requete);
	if($resultat->rowCount()>=1)
	{
	$resultat->setFetchMode(PDO::FETCH_OBJ);
    $element=$resultat->fetchall(); // chargement du rés dans un tab
    $resultat->closeCursor();
	return $element;
	}
	else
	{
		return null;
	}
}
function getElementt($id_type)
{
	$connexion=getConnect();
	$requete="select nom_element from elements where id_type=$id_type" ; 
	$resultat=$connexion->query($requete); 
	$resultat->setFetchMode(PDO::FETCH_OBJ);
    $element=$resultat->fetchall(); // chargement du rés dans un tab
    $resultat->closeCursor();
	return $element;
}

function supprimerElement($login){
	$connexion=getConnect();
    $requete="delete from elements where id_element='$login'";
    $resultat=$connexion->query($requete);  
    $resultat->closeCursor();
}