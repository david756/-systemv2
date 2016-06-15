<?php 

/*
/*test para probar el proceso : Ingresar un nuevo pedido
*/
class Test(){

	$json = "{  
   "mesa": 1,
   "atencion": null,
  "pedido": [
    {"id":1,
      "mesero":"12",
      "producto":3,
      "valor":500000,
      "anexo": "anexo",
      "cantidad":1,
      "horaPedido":"3:04:09"
    },
    {"id":2,
      "mesero":"12",
      "producto":2,
      "valor":300000,
      "anexo":"anexo",
      "cantidad":2,
      "horaPedido":"3:04:09"
    },
    {"id":3,
      "mesero":"12",
      "producto":5,
      "valor":400000,
      "anexo":"anexo",
      "cantidad":1,
      "horaPedido":"3:04:09"
    }
  ]
}"		

	public pruebaPedido($pedido=json_decode($json)){
      $mesaId=$pedido->"mesa";
      $atencionId=$pedido->"atencion";
      $productosId=$pedido->"pedido";
      //obtener mesa
      $mesa = new Mesa();
      $mesa = $mesa->getMesa($mesaId);
      //obtner usuario
      $usuario = new Usuario();
      $usuario = $usuario -> getUsuario($usuarioId);



      $atencion = new Atencion($mesa,$usuario,$productosId,);



	}

}
 ?>
