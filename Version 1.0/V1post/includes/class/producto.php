
<?php
 class producto{


 private $productoID;
 private $nombreID;
 private $precioID;
 private $cantidad;


//constructor de la clase producto
function __construct($productoID,$nombreID,$precioID,$cantidad) {
    
             $this->$productoID = $productoID;
             $this->$nombreID = $nombreID;
             $this->$precioID=$precioID;
             $this->$cantidad=$cantidad;

    }

//metodos get y set de la clase productos

public function __set($productoID)
    {
       $this->$productoID = $productoID;
    }

public function __set($nombreID)
    {
       $this->$nombreID = $nombreID;
    }

    public function __set($precioID)
    {
        $this->$precioID=$precioID;
    }

   public function __set(cantidad)
    {
       $this->$cantidad=$cantidad;
    }



 public function __get($productoID)
    {
      
        return this->$productoID;
    }



     public function __get($nombreID)
    {
      
        return this->$nombreID;
    }

    public function __get($precioID)
    {
        return this->$precioID;
    }

       public function __get($cantidad)
    {
      
        return this->$cantidad;
    }


 

 }


?>