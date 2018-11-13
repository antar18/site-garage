<?php
function getConnect(){  
 require_once('connection.php');
$connexion=new PDO('mysql:host='.SERVEUR.';dbname='.BDD,USER,PASSWORD);
$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$connexion->query('SET NAMES UTF8');
return $connexion;
}
function reserve($id_employe,$nom,$date){
    
    $new = str_replace("_"," ",$date);
    $da=new DateTime($new);
    $time= $da->format('Y-m-d H:i:s');
    $connexion=getConnect();
    $requete="INSERT INTO `formation`(`id_formation`, `date_formation`, `nom_formation`, `id_employe`) VALUES (NULL,'$time','$nom','$id_employe')";
    $resultat=$connexion->query($requete);
    $resultat->closeCursor();
}
function remplire_emplois($login,$date){
    $connexion=getConnect();
    $datedeb=debut_semaine($date)->format('Y-m-d');
    $datefin=fin_semaine($date)->format('Y-m-d');
   $requete="select date_formation as 'date','formation' as 'type',id_formation as 'id'from formation where date_formation Between '$datedeb' and '$datefin' and id_employe='$login'
            union 
            select date as 'date','intervention' as 'type',id_intervention as 'id' from intervention where date Between  '$datedeb' and '$datefin' and id_employe='$login'
   
   ";
    $resultat=$connexion->query($requete);
    $resultat->setFetchMode(PDO::FETCH_OBJ); 
    $ligne=$resultat->fetchall();
    $resultat->closeCursor();
    return $ligne;
    
}
function debut_semaine($date){
    
    $datetemp=mktime(0, 0, 0, $date->format('m'), $date->format('d'),$date->format('Y'));
    $jour=date('w',$datetemp);
    
    $date->modify(" - $jour days");
    
    return $date;   
 
}
function fin_semaine($datetime){
    $date=debut_semaine($datetime);
    $date->modify("+6 days");
    return $date;
}
function remplir_jours($date){
    $datedeb=debut_semaine($date);
    
    for($i=0;$i<5;$i++){
        $datedeb->modify("+ 1 days");
        $tab[$i]=$datedeb->format('Y-m-d');
        
    }
   return $tab;
    
}
function remplir_mat($login,$date,$bool,$bool2){
    $tab=remplir_jours($date);
    $tab2=remplire_emplois($login,$date);
    $i=0;
    $j=0;
   // initialisation de la matrice !!  
    for($i=0;$i<5;$i++){
        for($j=0;$j<13;$j++){
            if($bool==true){
                if($bool2==false){
                    $Matrice[$i][$j]='<input type="checkbox" name="'.$tab[$i].'_'.($j+8).':00:00" value="L">';
                }else{
                    $Matrice[$i][$j]='RDV';
                }
                
            }else{
                $Matrice[$i][$j]='';
            }
             
        }
    }
    
    // remplir la matrice : 
    
    for($i=0;$i<5;$i++){
        $j=0;
        foreach($tab2 as $date){
            
            $tmp=new DateTime($date->date);
            $jour=$tmp->format('Y-m-d');
            $heur=$tmp->format('H');
            $valheur=intval($heur)-8;
            $type=$date->type;
            if(strcmp($tab[$i],$jour)==0){
                
               if(strcmp($type,'intervention')==0){
                   $Matrice[$i][$valheur]='RDV' ;
              
               }else
               {
                   $Matrice[$i][$valheur]='X';
               }
                
                $j=$j+1;
                
            }
        }
        
    }
    if($bool2==false){for($i=0;$i<5;$i++){
        for($j=0;$j<13;$j++){
           if(strcmp($Matrice[$i][$j],'RDV')==0){
               $Matrice[$i][$j]='<input type="submit" name="'.$tab[$i].'_'.($j+8).':00:00" value="RDV" />';
           }
            
        }
    }
    }//Remplissage de date intervention 
      
    
    
    
    
    
    return $Matrice;
   
    
    
}
function semaine_suivante($date){
    $date_1=$date->modify("+ 7 days");
    return $date_1;
}
function semaine_precedente($date){
    $date_1=$date->modify("- 7 days");
    return $date_1;
}
function getMecano($id_employe){
    $connexion=getConnect();
    $requete="select * from employe where id_employe='$id_employe'";
    $resultat=$connexion->query($requete);
    $resultat->setFetchMode(PDO::FETCH_OBJ); 
    $ligne=$resultat->fetch();
    $resultat->closeCursor();
    return $ligne;
    
}
function synthese_client($id){
    $connexion=getConnect();
    $requte="select * from client  where id_client=$id";
    $resultat=$connexion->query($requte);
    $resultat->setFetchMode(PDO::FETCH_OBJ);
    $client=$resultat->fetch();
    $resultat->closeCursor();
    return $client;
}

function get_interventionByDate($date){
    $connexion=getConnect();
    $requte="select * from intervention  where date='$date'";
    $resultat=$connexion->query($requte);
    $resultat->setFetchMode(PDO::FETCH_OBJ);
    $client=$resultat->fetch();
    $resultat->closeCursor();
    return $client;
}
function get_liste_intervention($id){
    $connexion=getConnect();
    $requte="select * from (intervention NATURAL JOIN employe) where id_client=$id";
    $resultat=$connexion->query($requte);
    $resultat->setFetchMode(PDO::FETCH_OBJ);
    $liste=$resultat->fetchAll();
    $resultat->closeCursor();
    return $liste;

}

function checkConnection($login,$mdp)
{
     $connexion=getConnect();
    	$requete="select * from employe where id_employe='$login' and mdp='$mdp'" ;
    	$resultat=$connexion->query($requete);
    	if($resultat->rowCount()==1){
        $resultat->setFetchMode(PDO::FETCH_OBJ);
        $employe=$resultat->fetch(); 
        return $employe;
    }else return -1;
    
}








