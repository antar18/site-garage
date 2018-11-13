<?php 
require_once('../controller/controlleur_mecano.php');
 require_once('../controller/controleur-directeur.php');
require_once('../controller/controlleur_agent.php');

try{
    if(isset($_POST['chercher'])){
    $date=new DateTime($_POST['inpdate']);
    Ctl_affichage($date,$_POST['login_employe_hidden']);
}else if(isset($_POST['chercher_reservation'])){
    $date=new DateTime($_POST['inpdate']);
    Ctl_reservation($date,$_POST['login_employe_hidden']); 
}else if(isset($_POST['precedent'])){
    
    $date=new DateTime($_POST['actuelle']);
    Ctlsemaine_precedente($date,$_POST['login_employe_hidden']);
}
else if(isset($_POST['suivant'])){
    
    $date=new DateTime($_POST['actuelle']);
    Ctlsemaine_suivante($date,$_POST['login_employe_hidden']);
}else if(isset($_POST['reserver'])){
    $nom=$_POST['nom_formation'];
    
    foreach($_POST as $key => $val){
        if(strcmp($val,'L')==0){
        $date=$key;
            
            controller_reserver($date,$nom,$_POST['login_employe_hidden']);
        }
    }
    $date=new DateTime(); 
    Ctl_reservation($date,$_POST['login_employe_hidden']);
}else if(isset($_POST['changer'])){
    $mecano=$_POST['id_mecano'];
    $date=$_POST['date_mecano'];
   Ctl_autre_mecano($mecano,$date,$_POST['login_employe_hidden']);
}else if(isset($_POST['cherchage'])){
    
    Ctl_chercher($_POST['login_employe_hidden']);
    
}else if(isset($_POST['information'])){
   
    Ctl_information($_POST['login_employe_hidden']);
    
}else if(isset($_POST['reservation'])){
    $date=new DateTime();
    Ctl_reservation($date,$_POST['login_employe_hidden']);
    
}else if(isset($_POST['affichage'])){
    $date=new DateTime();
   
    Ctl_affichage($date,$_POST['login_employe_hidden']);
   
    
}else if (strcmp(next($_POST),'RDV')==0){
    
    
    $date= key($_POST);
    ctl_afficher_synthese($date,$_POST['login_employe_hidden']);
}
else if (isset($_POST['boutonAjouter'])){
	                  $login=$_POST['login'];
	                  $mdp=$_POST['mdp'];
	                  $nom=$_POST['nom'];
	                  $prenom=$_POST['prenom'];
	                  $fonction=$_POST['fonction'];
    
			          ctlAjouterEmploye($login,$mdp,$nom,$prenom,$fonction);
			    }
			 elseif (isset($_POST['boutonRechercher'])){ 
		     	       $nom=$_POST['nomCl'];
					   ctlChercherEmploye($nom);
			     }
				 
			elseif (isset($_POST['boutonSupprimer'])){ 
			     	    ctlSupprimerEmploye();
                ctlAcceuil_directeur();
				     }	  
			elseif (isset($_POST['boutonAfficher'])){ 
			 		   	ctlAfficherEmploye();
			 			     }	  
		   	elseif (isset($_POST['boutonChoisir'])){
		   		 foreach ($_POST as $key => $val){
		   				 
		   				 	ctlChoisirEmploye($key);
		   				 
		   	}}
		   	elseif (isset($_POST['boutonModifier'])){
		   				$login=$_POST['login'];
		   				$mdp1=$_POST['mdp1'];
		   				ctlModifierEmploye($login,$mdp1);
		   	}
		   	elseif (isset($_POST['AjouterIntervention'])) {
		   			$prix=$_POST['prixIntervention'];
		   			$nom_intervention=$_POST['nom_intervention'];
		   			ctlAjouterIntervention($nom_intervention,$prix);
		   	}
		   	elseif(isset($_POST['AfficherIntervention']))
		   	{
                
		   			ctlAfficherIntervention();
		   	}	
		   	elseif (isset($_POST['supprimerIntervention']))
		   	{
		   			ctlSupprimerIntervention();
		   	}
		   	elseif (isset($_POST['AjouterElement'])) 
		   	{
					$nom_element=$_POST['nom_element'];
					$nom_intervention=$_POST['nom_intervention'];
					ctlAjouterElement($nom_element,$nom_intervention);
		   	}
		   	elseif (isset($_POST['AjouterEmployD'])) {
		   			ctlAfficherAjoutD();
		   	}
		   	elseif (isset($_POST['AfficherElement'])) {
		   			ctlAfficherElement();
		   	}
		   	elseif(isset($_POST['supprimerElement']))
		   	{
		   			ctlSupprimerElement();
		   	}
		    elseif (isset($_POST['AjouterInterventionD'])) {
		    		
                
		    		ctlAfficherInterventionD();
		    }
		    elseif (isset($_POST['RechercherEmployeD'])) {
		    		ctlAfficherEmployeD();
		    }
		    elseif (isset($_POST['AjouterElementD'])) {
		    		ctlAfficherInterventionA();
		    		ctlAfficherElementD();
		    }
		    elseif (isset($_POST['Acceuil'])) {

		    	ctlAcceuil_directeur();
		    }elseif (isset($_POST['ajouter_client_agent'])) {
                
                $nom = $_POST['nom'];
                $prenom = $_POST['prenom'];
                $date_naissance = $_POST['date_naissance'];
                $adresse = $_POST['adresse'];
                $mail = $_POST['mail'];
                $num_tel = $_POST['num_tel'];
                $montant = $_POST['montant'];
                ctl_ajouter_client( $nom, $prenom, $date_naissance, $adresse, $mail, $num_tel, $montant);
            } elseif (isset($_POST['valider_synthese_client_agent'])) {
                
                $id = $_POST['id'];
                ctl_afficher_synthese_client_agent($id);
            }
            elseif(isset($_POST['chercher_client_agent'])){
                $nom=$_POST['nom'];
                $date=$_POST['date'];
                ctl_get_id_et_afficher_client($nom,$date);

            }
            elseif(isset($_POST['afficher_client_agent'])){
                $id=$_POST['id'];
                ctl_afficher_editer_client($id);

            }

            elseif(isset($_POST['editer_client_agent'])){
            $id = $_POST['id'];
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $date_naissance = $_POST['date_naissance'];
            $adresse = $_POST['adresse'];
            $mail = $_POST['mail'];
            $num_tel = $_POST['num_tel'];
            $montant = $_POST['montant'];
            
            ctl_editer_client($id,$nom,$prenom, $date_naissance, $adresse, $mail, $num_tel, $montant);

             }
            elseif(isset($_POST['gestion_client_agent'])){
                
                $id=$_POST['id'];
                ctl_afficher_intervention($id);
            }
            elseif(isset($_POST['payer_client_agent'])){
                $id=$_POST['id_intervention'];
                ctl_payer_inervention($id);
            }

            elseif (isset($_POST['rembourser_agent_client'])){
                ctl_rembourser_intervention();

            }
            elseif(isset($_POST['differe_agent'])){
                
                $id_client=$_POST['id_client'];
                $id_intervention=$_POST['id_intervention'];
                ctl_mettre_en_differe($id_client,$id_intervention);
            } elseif(isset($_POST['nouveau_client'])){
                
               ctl_afficher_page_nouveau_client();
            }
            elseif(isset($_POST['chercher_client'])){
                ctl_afficher_page_id_client();
            }
            elseif(isset($_POST['editer_client'])){
                ctl_afficher_page_editer_client();
            }
            elseif(isset($_POST['synthese_client'])){
                ctl_afficher_page_synthese_client();
            }
            elseif(isset($_POST['gestion_client'])){
                ctl_afficher_page_gestion_financiere();

            }
            elseif(isset($_POST['rendez_vous'])){
                ctl_afficher_page_rendez_vous();
            }


            elseif(isset($_POST['home'])){
                ctl_acceuil();
            }else if(isset($_POST['planning_mecanicien'])){
                $date= $_POST['date_rendez_vous'];
                $login=$_POST['id_mecanicien'];
                Ctl_affichage_planning($login,$date);
                
                
            }else if(isset($_POST['valider_rendezvous'])){
                 $id_type= $_POST['id_tout_intervention'];
                 $id_client=$_POST['id_tout_client'];
                $id_employe=$_POST['id_mecanicien'];
                
                foreach($_POST as $key => $val){
                    if(strcmp('L',$val)==0){
                       Ctl_prendre_rdv($id_client,$id_type,$key,$id_employe); 
                    }
                }
                ctl_afficher_page_rendez_vous();
               
            }elseif(isset($_POST['seconnecter'])){
   $login=$_POST['logincxn'];
    $mdp=$_POST['mdpcnx'];
    
    if(checkConnection($login,$mdp)==-1){
        
      afficher_erreure_connect($login);
    }else
    {
        
        $employe=checkConnection($login,$mdp);
        if(strcmp($employe->fonction,'mecanicien')==0){
            CtlAcceuil_mecano($employe);
        }elseif(strcmp($employe->fonction,'directeur')==0){
            ctlAcceuil_directeur();
        
        }elseif(strcmp($employe->fonction,'agent')==0){
             ctl_acceuil_agent();
        }else{
            eafficher_erreure_connect($msg);
        }
    }}
                 else{
    Ctl_Acceuil_cnx();
                 }
    
}catch(Exception $e){
   
                     $msg=$e->getMessage;
                     echo $msg;
                 }

  


  

