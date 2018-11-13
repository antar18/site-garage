<?php 

require_once('../model/modele-directeur.php') ;
require_once('../vue/vue-directeur.php');

function ctlAcceuil_directeur(){
	afficherAcceuil_directeur();
}


function ctlAfficherEmploye(){
	$employe=chercherTousLesEmploye();
	if($employe!=null)
	{
	afficherEmploye($employe);
	}
	else
	{
		{afficher_erreure_directeur("aucun employe dans la base"); }
	}
}


function ctlAjouterEmploye($id_employe,$mdp,$nom,$prenom,$fonction){
    if (!empty($id_employe) && !empty($mdp) && !empty($nom) && !empty($prenom) && !empty($fonction)) { 
	   ajouterEmploye($id_employe,$mdp,$nom,$prenom,$fonction);
	   ctlAcceuil_directeur();
	   	}
	else  {afficher_erreure_directeur("champ invalide");}   
}

function ctlChercherEmploye($nom){
    if (!empty($nom)){ 

	   $employe=chercherNomEmploye($nom);
	   if($employe!=null)
	   {
	   afficherEmploye($employe);
	}else
		{afficher_erreure_directeur("champ invalide"); }
	}
	else  {afficher_erreure_directeur("champ invalide"); }   
}
function ctlChoisirEmploye($val){
    		$employe=choisirEmploye($val);
    		if($employe!=null)
    		{
    		afficherChoisis($employe);
    		}
    		else
    			{afficher_erreure_directeur("champ invalide");}
}

function ctlSupprimerEmploye(){
	
	 foreach($_POST as $key => $val){
		    if ($key!='boutonSupprimer') { // car même le bouton est posté 
			supprimerEmploye($key);
			}
			
	}   
	   
	
}  
function ctlModifierEmploye($login,$mdp1){
	foreach ($_POST as $key => $value) {
	
	if(!empty($login) || !empty($mdp1))
	{
		modifierEmployeLogin($login,$key);
		modifierEmployeMdp($mdp1,$key);
	}
	else 
	{
		afficher_erreure_directeur("champ invalide");
	}
	ctlAcceuil_directeur();
	}
}

function ctlAjouterIntervention($nom_intervention,$prixIntervention){
    if (!empty($nom_intervention) && (!empty($prixIntervention))) { 
	   ajouterIntervention($nom_intervention,$prixIntervention);
	  ctlAcceuil_directeur();
	  	}
	else  {afficher_erreure_directeur("champ invalide"); }   
}
function ctlAfficherIntervention()
{
	$intervention=getIntervention();
	if($intervention!=null)
	{
	afficherIntervention($intervention);
	}
	else
	{
		{afficher_erreure_directeur("champ invalide"); }
	}
}
function ctlAfficherElement()
{
	$element=getElement();
	if($element!=null)
	{
	afficherElement($element);
	}
	else
	{
		{afficher_erreure_directeur("champ invalide");}
	}
}
function ctlSupprimerIntervention(){
	
	 foreach($_POST as $key => $val){
		    if ($key!='supprimerIntervention') { // car même le bouton est posté 
			supprimerIntervention($key);
			}
			
	}   
	   
	ctlAcceuil_directeur();	
}
function ctlAjouterElement($nom_element,$nom_intervention){
    if (!empty($nom_element)&& !empty($nom_intervention)) { 
	   ajouterElement($nom_element,$nom_intervention);
	   ctlAcceuil_directeur();
	   	}
	else  {afficher_erreure_directeur("champ invalide"); }   
}
function ctlAfficherInterventionA()
{
	$intervention=getIntervention();
	afficherInterventionA($intervention);
}
function ctlAfficherElementA()
{
	$element=getElement();
	afficherElementA($element);
}
function CtlErreur($erreur){
	afficherErreur($erreur);
}

function ctlSupprimerElement(){
	
	 foreach($_POST as $key => $val){
		    if ($key!='supprimerElement') { // car même le bouton est posté 
			supprimerElement($key);
			}
			
	}  
    ctlAcceuil_directeur();
	   }

function ctlAfficherAjoutD()
{
	afficherAjoutD();
}
function ctlAfficherInterventionD()
{
	afficherInterventionD();
}
function ctlAfficherEmployeD()
{
	afficherEmployeD();
}
function ctlAfficherElementD()
{
	afficherElementD();
}