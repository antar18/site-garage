
<?php
 
require_once('../model/model_mecano.php');
require_once('../vue/vue_connexion_mecano.php');

function Ctl_recherche_date($date,$login){
     $employe=getMecano($login);
    $tab=remplir_jours($date);
    $Mat=remplir_mat($employe->id_employe,$date);
      afficher_connexion($employe,$tab,$Mat,false,$login);
    
}
function Ctl_autre_mecano($mecano,$dat,$login){
    $date=new DateTime($dat);
    $tab=remplir_jours($date);
    $Mat=remplir_mat($mecano,$date,false,true);
      afficher_autre_emplois($tab,$Mat,$login);
}
function CtlAcceuil_mecano($employe){
    $contenu=''.$employe->id_employe;
    require_once('../vue/gabarit_connexion_mecano_home.php');
   
}
function Ctlsemaine_suivante($dat,$login){

    $date=semaine_suivante($dat);    
    $employe=getMecano($login);
    $tab=remplir_jours($date);
    $Mat=remplir_mat($employe->id_employe,$date,false,false);
    afficher_mon_emplois($tab,$Mat,$login);
    
}
function Ctlsemaine_precedente($dat,$login){

    $date=semaine_precedente($dat);    
    $employe=getMecano($login);
    $tab=remplir_jours($date);
    $Mat=remplir_mat($employe->id_employe,$date,false);
   afficher_mon_emplois($tab,$Mat,$login);
    
}
function controller_reserver($date,$nom,$login){
    $employe=getMecano($login);
    reserve($employe->id_employe,$nom,$date);
    
    
}



function Ctl_information($login){
    $employe=getMecano($login);
    afficher_information($employe,$login);
    
}
function Ctl_affichage($date,$login){
    
    $employe=getMecano($login);
    $tab=remplir_jours($date);
    $Mat=remplir_mat($employe->id_employe,$date,false);
    afficher_mon_emplois($tab,$Mat,$login);
}

function Ctl_reservation($date,$login){
    $employe=getMecano($login);
    $tab=remplir_jours($date);
    $Mat=remplir_mat($employe->id_employe,$date,true);
    reserver_creneau($tab,$Mat,$login);
}

function Ctl_chercher($login){
    afficher_gabarit_autre_mecano($login);
}

function ctl_afficher_synthese($date,$login){
    $new = str_replace("_"," ",$date);
    $da=new DateTime($new);
    $time= $da->format('Y-m-d H:i:s');
    $intervention=get_interventionByDate($date);
    $client=synthese_client($intervention->id_client);
    $liste=get_liste_intervention($client->id_client);
    afficher_synthese_client($client,$liste,$intervention,$login);
}

function Ctl_Acceuil_cnx(){
    require_once('../vue/gabarit_connection.php');
}

