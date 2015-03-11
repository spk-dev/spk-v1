<?php




/**
 * Controlleur des actions & vérification du cache 
 */
class ControlerService{
    
    public function reflection($class,$method,$arg){
     
        
        $reflectionMethod = new ReflectionMethod($class, $method);
        echo $reflectionMethod->invoke(new HelloWorld(), $arg);
        
    }
    
    
}


?>
