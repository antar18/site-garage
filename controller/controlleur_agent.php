<?php
/**
 * Created by PhpStorm.
 * User: Antar
 * Date: 12/12/2017
 * Time: 16:00
 */

require_once ("../model/modele_agent.php");
require_once ("../vue/vue_agent.php");

function ctl_ajouter_client($nom,$prenom,$date_naissance,$adresse,$mail,$num_tel,$montant){
    if(!empty($nom)&& !empty($date_naissance) && !empty($adresse) && !empty($mail) && !empty($num_tel) && !empty($montant)){
        ajouter_client_agent($nom,$prenom,$date_naissance,$adresse,$mail,$num_tel,$montant);
        ctl_acceuil_agent();
    }
    else{
        afficher_erreure_agent("un des champs est vide ");
    }
}
function ctl_afficher_synthese_client_agent($id){
    if (ctype_digit($id)) {
        $client = synthese_client_agent($id);
        $liste = get_liste_intervention_agent($id);
        if ($client != null) {
            afficher_synthese_client_agent($client, $liste);
        } else {
                        afficher_erreure_agent("pas de client trouvé");

        }
    }
    else {
                        afficher_erreure_agent("champ invalide");

        }

}


function ctl_acceuil_agent(){
    
           

    afficher_acceuil_agent();
}

function ctl_get_id_et_afficher_client($nom,$date){
    if(!empty($nom) && !empty($date)){
        $id=get_id_client_agent($nom,$date);
        if($id!=null) {
            
            foreach($id as $ligne) {
                $id1 = $ligne->id_client;
                $client = get_client_agent($id1);
                afficher_id_client_et_modifier_agent($client);
            }

        }
        else{
             afficher_erreure_agent("pas de client trouvé");

        }
    }
    else {
                    afficher_erreure_agent("champ invalide");

    }
}

function ctl_editer_client_apres_recherche($id,$nom,$prenom,$date_naissance,$adresse,$mail,$num_tel,$montant){
    if(!empty($nom)&& !empty($date_naissance)&&!empty($adresse)&&!empty($mail)&&!empty($num_tel)&& !empty($montant)) {
        editer_client($id, $nom, $prenom, $date_naissance, $adresse, $mail, $num_tel, $montant);
    }else{
            afficher_erreure_agent("champ invalide");
        }


}

function ctl_afficher_editer_client_apres_recherche($id)
{
    if (ctype_digit($id)) {
        $client = synthese_client($id);
        if ($client != null) {
            afficher_editer_client($client);
        } else {
            afficher_erreure_agent("pas de client trouvé");
        }
    } else {
            afficher_erreure_agent("champ de recherche invalide");
    }
}

    function ctl_afficher_editer_client($id)
    {
        if (ctype_digit($id)) {
            
            $client = synthese_client_agent($id);
            
            if ($client != null) {
                afficher_editer_client_agent($client);
            } else {
                afficher_erreure_agent("pas de client trouvé");
            }
        } else {
            afficher_erreure_agent("champ invalide");
        }

    }


    function ctl_editer_client($id, $nom, $prenom, $date_naissance, $adresse, $mail, $num_tel, $montant)
    {
        
        if (!empty($nom) && !empty($date_naissance) && !empty($adresse) && !empty($mail) && !empty($num_tel) && !empty($montant)) {
            
            editer_client_agent($id, $nom, $prenom, $date_naissance, $adresse, $mail, $num_tel, $montant);
            ctl_acceuil_agent();
        } else {
           
            afficher_erreure_agent("champ invalide");
        }
    }

    function ctl_afficher_gestion_financiere($id)
    {
        if (ctype_digit($id)) {
            $client=synthese_client($id);
            if($client !=null) {
                $derniere = get_derniere_intervention($id);
                $differe = get_interventions_en_differe($id);
                afficher_intervention($derniere, $differe);
            }else {
                afficher_erreure_agent("champ invalide");
            }

        } else {
            afficher_erreure_agent("champ invalide");
        }

    }

    function ctl_payer_inervention($id)
    {
        if (ctype_digit($id)) {
            payer_intervention($id);
            ctl_acceuil_agent();

        } else {
            afficher_erreure_agent("champ invalide");
        }
    }


  


    function ctl_rembourser_intervention()
    {

        $nb=0;
        foreach ($_POST as $key => $value) {

            if ($key != null and strcmp($key,'rembourser')!=0) {
                payer_intervention($key);
                $nb = 1;
            }
            elseif($nb==0){
               afficher_erreure_agent("champ invalide");
            }
        }

        ctl_acceuil_agent();
    }


    function ctl_mettre_en_differe($id_client, $id_intervention)
    {
        $client = synthese_client_agent($id_client); // get toutes les information du client

        foreach($client as $ligne ) {
            $montant = $ligne->montant; //recuperer le montant de decouvert du client dans la variable $montant
        }

        $somme = somme_differe($id_client);

        foreach ($somme as $ligne) {
            $res = $ligne->somme;//recuperer la somme de differe du client dans la variable $res
        }
        $intervention = get_derniere_intervention_agent($id_client);

        foreach ($intervention as $ligne){
            $prix = $ligne->prix;
        }
        if (($montant - $res) >= $prix) {    //comparer la difference entre le montant et la somme  avec le prix
            mettere_en_differe($id_intervention);
        } else {

            afficher_erreure_agent("le prix de lintervention depasse la capacité");
        }
        ctl_acceuil_agent();


    }


//controleur pour afficher les pages d'agent

    function ctl_afficher_page_nouveau_client()
    {
        
        afficher_page_nouveau_client();
    }


    function ctl_afficher_page_id_client()
    {
        afficher_page_id_client();
    }

    function ctl_afficher_page_editer_client()
    {
        afficher_page_editer_client();
    }

    function ctl_afficher_page_synthese_client()
    {
        afficher_page_synthese_client();
    }

    function ctl_afficher_page_gestion_financiere()
    {
        afficher_page_gestion_financiere();
    }

    function ctl_afficher_page_rendez_vous()
    {
        $liste_mecanicien = get_liste_mecanicien();
        afficher_page_gestion_rendez_vous($liste_mecanicien);
    }

    function Ctl_afficher_page_planning()
    {
        $liste_mecanicien = get_liste_mecanicien();
        afficher_page_gestion_rendez_vous($liste_mecanicien);
    }

    function Ctl_afficher_page_planning_avec_element($id_type, $prix)
    {
        $liste_mecanicien = get_liste_mecanicien();
        $element = getElementt_agent($id_type);
        afficher_page_gestion_rendez_vous_avec_element($liste_mecanicien, $element, $prix);
    }


    function Ctl_affichage_planning($login, $dat)
    {
        $date = new DateTime($dat);
        $tab = remplir_jours_agent($date);
        $Mat = remplir_mat_agent($login, $date, true);
        $liste_mecanicien = get_liste_mecanicien();
        $client = get_tout_client_agent();
        $type_inter = getIntervention_agent();
        afficher_page_planning_mecano($liste_mecanicien, $tab, $Mat, $client, $type_inter);

    }


    function Ctl_prendre_rdv($id_client, $id_type, $date, $id_employe)
    {   
        $type = getInterventionById_agent($id_type);
        $client = getClientById_agent($id_client);
        $new = str_replace("_", " ", $date);
        $da = new DateTime($new);
        $time = $da->format('Y-m-d H:i:s');
        Ajouter_intervention_agent($type->nom_type, $time, $id_employe, $id_client, $id_type, $type->prix_type, "attente");
        Ctl_afficher_page_planning_avec_element($id_type, $type->prix_type);
    }


//////////a verifier
 function ctl_afficher_intervention($id){
if(ctype_digit($id)) {
    
    $derniere=get_derniere_intervention_agent($id);
    $differe=get_interventions_en_differe($id);
    afficher_intervention_agent($derniere,$differe,$id);
}
else{
    afficher_erreure_agent("champ invalide");
}
}
