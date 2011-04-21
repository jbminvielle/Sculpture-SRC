<?php


//Ce fichier est basé sur le module de téléchargement, les noms des classes, des méthodes et la plupart des commentaires sont en anglais. J'ai apporté quelques modification et ajouté du code personne à partir de la ligne 154.

include_once('../functions.php');
include_once('../functionsCrud.php');


/**
 * Handle file uploads via XMLHttpRequest
 */
class qqUploadedFileXhr {
    /**
     * Save the file to the specified path
     * @return boolean TRUE on success
     */
    function save($path) {    
        $input = fopen("php://input", "r");
        $temp = tmpfile();
        $realSize = stream_copy_to_stream($input, $temp);
        fclose($input);
        
        if ($realSize != $this->getSize()){            
            return false;
        }
        
        $target = fopen($path, "w");        
        fseek($temp, 0, SEEK_SET);
        stream_copy_to_stream($temp, $target);
        fclose($target);
        
        return true;
    }
    function getName() {
        return $_GET['qqfile'];
    }
    function getSize() {
        if (isset($_SERVER["CONTENT_LENGTH"])){
            return (int)$_SERVER["CONTENT_LENGTH"];            
        } else {
            throw new Exception('Getting content length is not supported.');
        }      
    }   
}

/**
 * Handle file uploads via regular form post (uses the $_FILES array)
 */
class qqUploadedFileForm {  
    /**
     * Save the file to the specified path
     * @return boolean TRUE on success
     */
    function save($path) {
        if(!move_uploaded_file($_FILES['qqfile']['tmp_name'], $path)){
            return false;
        }
        return true;
    }
    function getName() {
        return $_FILES['qqfile']['name'];
    }
    function getSize() {
        return $_FILES['qqfile']['size'];
    }
}

class qqFileUploader {
    private $allowedExtensions = array();
    private $sizeLimit = 10485760;
    private $file;
    
    function __construct(array $allowedExtensions = array(), $sizeLimit = 10485760){        
        $allowedExtensions = array_map("strtolower", $allowedExtensions);
            
        $this->allowedExtensions = $allowedExtensions;        
        $this->sizeLimit = $sizeLimit;
        
        $this->checkServerSettings();       

        if (isset($_GET['qqfile'])) {
            $this->file = new qqUploadedFileXhr();
        } elseif (isset($_FILES['qqfile'])) {
            $this->file = new qqUploadedFileForm();
        } else {
            $this->file = false; 
        }
    }
    
    private function checkServerSettings(){        
        $postSize = $this->toBytes(ini_get('post_max_size'));
        $uploadSize = $this->toBytes(ini_get('upload_max_filesize'));        
        
        if ($postSize < $this->sizeLimit || $uploadSize < $this->sizeLimit){
            $size = max(1, $this->sizeLimit / 1024 / 1024) . 'M';             
            die("{'error':'increase post_max_size and upload_max_filesize to $size'}");    
        }        
    }
    
    private function toBytes($str){
        $val = trim($str);
        $last = strtolower($str[strlen($str)-1]);
        switch($last) {
            case 'g': $val *= 1024;
            case 'm': $val *= 1024;
            case 'k': $val *= 1024;        
        }
        return $val;
    }
    
    /**
     * Returns array('success'=>true) or array('error'=>'error message')
     */
    function handleUpload($uploadDirectory, $replaceOldFile = FALSE){
        if (!is_writable($uploadDirectory)){
            return array('error' => 'Le serveur n\'est pas disponible en ecriture. Veuillez contacter l\'administrateur. ('.$uploadDirectory.')');
        }
        
        if (!$this->file){
            return array('error' => 'Aucun fichier envoye.');
        }
        
        $size = $this->file->getSize();
        
        if ($size == 0) {
            return array('error' => 'Fichier vide.');
        }
        
    /*    if ($size > $this->sizeLimit) {
            return array('error' => 'Fichier trop lourd.');
        } */
        
        $pathinfo = pathinfo($this->file->getName());
        $filename = $pathinfo['filename'];
        //$filename = md5(uniqid());
        $ext = $pathinfo['extension'];

        if($this->allowedExtensions && !in_array(strtolower($ext), $this->allowedExtensions)){
            $these = implode(', ', $this->allowedExtensions);
            return array('error' => 'Votre fichier n\'est pas valide, il devrait se terminer par '. $these . '.');
        }
        
        if(!$replaceOldFile){
            /// don't overwrite previous files that were uploaded
            while (file_exists($uploadDirectory . $filename . '.' . $ext)) {
                $filename .= rand(10, 99);
            }
        }
        
        if ($this->file->save($uploadDirectory . $filename . '.' . $ext)){
        	$nomFichier = $filename . '.' . $ext;
            
            //MODULE DE REDIMMENSIONNEMENT ---------------------------------------------------------
            
            //Ce module utilise les librairies d'images de PHP pour redimmensionner et créer des images. Pour plus d'information prière de se référer à la documentation.
            
            //on va chercher la taille, on calcule un ratio 
            $dimImage = getimagesize('../' . ADRESSE_GRAND . $nomFichier);//Prérequis des lignes suivantes
            $hauteurPeinture = $dimImage[1];//Détermination de la hauteur de l'image
            $largeurPeinture = $dimImage[0];//Détermination de la largeur de l'image
            
            //Si l'image est en jpg on crée une un nouveau JPG, et pareil si on est en PNG.
            if ($ext == 'jpg' || $ext == 'jpeg' || $ext == 'JPG' || $ext == 'JPEG')
            	$source = imagecreatefromjpeg('../' . ADRESSE_GRAND . $nomFichier); // La photo est la source	
            else if ($ext == 'png' || $ext == 'PNG')
            	$source = imagecreatefrompng('../' . ADRESSE_GRAND . $nomFichier); // La photo est la source	
            
            //PREMIERE REDIMMENSION :
            $largeurMoyen = (500 * $largeurPeinture)/$hauteurPeinture;//On determine la largeur de moyen...
            $destination = imagecreatetruecolor($largeurMoyen, 500); // On crée la miniature vide
            imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeurMoyen, 500, $largeurPeinture, $hauteurPeinture);//On redimmensionne cette premiere copie pour la taille moyen
            if ($ext == 'jpg' || $ext == 'jpeg' || $ext == 'JPG' || $ext == 'JPEG')
            	imagejpeg($destination, '../' . ADRESSE_MOYEN . $nomFichier);
            else if ($ext == 'png' || $ext == 'PNG')
            	imagepng($destination, '../' . ADRESSE_MOYEN . $nomFichier);
            
            
            //Seconde redimmension :	
            $largeurPetit = (90 * $largeurPeinture)/$hauteurPeinture;//On determine la largeur de petit...
            $destination = imagecreatetruecolor($largeurPetit, 90); // On crée la miniature vide
            
            	imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeurPetit, 90, $largeurPeinture, $hauteurPeinture);//On redimmensionne cette seconde copie pour la taille petit*/
            if ($ext == 'jpg' || $ext == 'jpeg' || $ext == 'JPG' || $ext == 'JPEG')
            	imagejpeg($destination, '../' . ADRESSE_PETIT . $nomFichier);
            else if ($ext == 'png' || $ext == 'PNG')
            	imagepng($destination, '../' . ADRESSE_PETIT . $nomFichier);

            
            //on va stocker dans un array les valeurs qui doivent être écrites dans la base (le nom est basé sur le nom de l'image).
            $tableChamps = array('URLpetit'=>ADRESSE_PETIT . $nomFichier, 'URLmoyen'=> ADRESSE_MOYEN . $nomFichier, 'URLgrand'=>ADRESSE_GRAND . $nomFichier, 'nom'=> $pathinfo['filename']);
                        
           //Si la page n'est pas image c'est qu'on doit rentrer dans la base l'image :
           if ($_GET['p'] != 'images') {
            	 $tableChamps['id'] = creerEntite('images', 'id', $tableChamps);
            }
            
            $tableChamps['success'] = true; //on ajoute ce champs pour dire à jquery que ça a bien réussi
            
           return $tableChamps;
            
        } else {
            return array('error'=> 'Le fichier n\'a pas ete envoye. ' .
                'La photo n\'a pas ete envoyee car une erreur inconnue a ete rencontree.');
        }
        
        
    }    
}

// list of valid extensions, ex. array("jpeg", "xml", "bmp")
$allowedExtensions = array("jpeg", "jpg", "JPEG", "JPG", "png", "PNG");
// max file size in bytes
$sizeLimit = ini_get('upload_max_filesize');

define('ADRESSE_GRAND', 'images/grand/');
define('ADRESSE_MOYEN', 'images/moyen/');
define('ADRESSE_PETIT', 'images/petit/');

$uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
$result = $uploader->handleUpload('../' . ADRESSE_GRAND);

// to pass data through iframe you will need to encode all html tags
echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);

?>