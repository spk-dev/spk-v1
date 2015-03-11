<?php

/**
 * Main application class.
 */
final class MainIndex {

//    const DEFAULT_PAGE = 'home2';
//    const PAGE_DIR = '../page/';
    private $startTime;
    private $endTime;
    private $default_page ;
    private $page_dir;
    private $booAdmin;
    private $connexion_page = "";
    
    public function getDefault_page() {
        return $this->default_page;
    }

    public function setDefault_page($default_page) {
        $this->default_page = $default_page;
    }

    public function getPage_dir() {
        return $this->page_dir;
    }

    public function setPage_dir($page_dir) {
        $this->page_dir = $page_dir;
    }

    public function getBooAdmin() {
        return $this->booAdmin;
    }

    public function setBooAdmin($booAdmin) {
        $this->booAdmin = $booAdmin;
    }
    public function getConnexion_page() {
        return $this->connexion_page;
    }

    public function setConnexion_page($connexion_page) {
        $this->connexion_page = $connexion_page;
    }

            /**
     * System config.   
     */
    public function init() {

       // Démarrage du chrono
       $this->startTime = $this->getmicrotime();
       
       
        // error reporting - all errors for development (ensure you have display_errors = On in your php.ini file)
        error_reporting(E_ALL | E_STRICT);
        mb_internal_encoding('UTF-8');
        set_exception_handler(array($this, 'handleException'));
        spl_autoload_register(array($this, 'loadClass'));
        
        
        
        // Chargement des properties dans une variable d'environnement       
        if(!isset($_ENV["properties"])){
            $configPath = "../config/config.ini";
            $confValue = LoadConfig::getInstance();      
            $_ENV["properties"] = $confValue->getProperties($configPath);
        }
        
        TextStatic::defineLanguage();
        
        if(isset($_GET['resetLangue'])){
            TextStatic::reloadLanguage();
        }
        
    }

    /**
     * Charge le Header de la page 
     */
    public function loadPage(){

//        $page = "home";
        $page = $this->default_page;
        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }    
    }
    

    
    /**
     * Run the application!
     */
    public function run() {
        
        $this->runPage($this->getPage());
        AppLog::ecrireLog("Chargement de la page ".$this->getPage(),"info");
        // $this->getPage();
    }

    /**
     *
     * @param Theme $page
     * @param array $extra 
     */
    private function runPage($page, array $extra = array()) {
        $run = false;
        if ($this->hasScript($page)) {
            $run = true;
            require $this->getScript($page);
        }

        if (!$run) {
            echo ('Page "' . $page . '" has neither script nor template!');
        }
    }

    /**
     * Exception handler.
     */
    public function handleException(Exception $ex) {
        $extra = array('message' => $ex->getMessage());
        if ($ex instanceof NotFoundException) {
            header('HTTP/1.0 404 Not Found');
            $this->runPage('404', $extra);
        } else {
            // TODO log exception
            header('HTTP/1.1 500 Internal Server Error');
            $this->runPage('500', $extra);
        }
    }

    /**
     * Class loader.
     */
    public function loadClass($name) {
       
        // Chargement du tableau de classe.
        require("../utils/classLoader.php");
       
        if (!array_key_exists($name, $classes)) {
            die('Class "' . $name . '" not found.');
        }
        require_once $classes[$name];
    }

    /**
     * Chargement des pages
     * @return Theme 
     */
    private function getPage() {
        
        if($this->booAdmin){
            if(UtilSession::isSessionLoaded()){
                $page = $this->default_page;
                if (array_key_exists('page', $_GET)) {
                    $page = $_GET['page'];
                }
            }else{
                $page = $this->connexion_page;
            }
        }else{
            $page = $this->default_page;
            if (array_key_exists('page', $_GET)) {
                $page = $_GET['page'];
            }
        }
        
        return $this->checkPage($page);
    }

    /**
     * Vérification de la syntaxe des pages.
     * @param Theme $page
     * @return Theme
     * @throws NotFoundException 
     */
    private function checkPage($page) {
        if (!preg_match('/^[a-z0-9-]+$/i', $page)) {
            // TODO log attempt, redirect attacker, ...
            throw new NotFoundException('Unsafe page "' . $page . '" requested');
        }
        /** if (!$this->hasScript($page) && !$this->hasTemplate($page)) {
          // TODO log attempt, redirect attacker, ...
          throw new NotFoundException('Page "' . $page . '" not found');
          }* */
        return $page;
    }

    /**
     * Vérifie que la page existe avant de la charger
     * @param Theme $page
     * @return Theme 
     */
    private function hasScript($page) {
        return file_exists($this->getScript($page));
    }

    /**
     * Charge la page
     * @param Theme $page
     * @return Theme 
     */
    private function getScript($page) {
        return $this->page_dir . $page . '.php';
    }

    /**
     * Reset le chargement des classes auto.
     * @return string 
     */
    private function resetAutoload(){
        $_SESSION;
     }
     
     /**
      * Renvoi le tamps écoulé entre les 2 chronos
      */
     public function getChrono(){
         $this->endTime = $this->getMicroTime();
         return round( $this->endTime - $this->startTime, 3);
     }
     
    /**
    * Calcul le temps entre 2 marqueurs.
    * @return Number
    */ 
    private function getmicrotime(){  
        list($usec, $sec) = explode(" ",microtime());  
        return ((float)$usec + (float)$sec);  
    }
    
    public function getDefaultPage(){
        return $this->default_page;
    }
}

?>
