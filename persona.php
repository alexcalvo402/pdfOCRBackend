<?php
	$request_method=$_SERVER["REQUEST_METHOD"];
    const DATABASE = "data.json";

	switch($request_method)
	{
		case 'GET':
			// Retrive Products
			if(!empty($_GET["persona_id"]))
			{
				$persona_id=intval($_GET["persona_id"]);
				get_persona($persona_id);
			}
			else
			{
				get_persones();
			}
			break;
		case 'POST':
			// Insert Product
			insert_persona();
			break;
		/*case 'PUT':
			// Update Product
			$persona_id=intval($_GET["persona_id"]);
			update_persona($persona_id);
			break;
		case 'DELETE':
			// Delete Product
			$persona_id=intval($_GET["persona_id"]);
			delete_product($persona_id);
			break;*/
		default:
			// Invalid Request Method
			header("HTTP/1.0 405 Method Not Allowed");
			break;
	}


    function get_persona($persona_id){
        $json = json_decode(file_get_contents(DATABASE),TRUE);
        $persona = $json["persona"][$persona_id];
        echo json_encode($persona);
    }

    function get_persones(){
        $json = json_decode(file_get_contents(DATABASE),TRUE);
        $persones = $json["persona"];
        echo json_encode($persones);
    }

    function insert_persona(){
        $json = json_decode(file_get_contents(DATABASE),TRUE);
        $nom = $_POST["nom"];
        $habitatge=$_POST["habitatge"];
		$tipus=$_POST["tipus"];

        $persona = new Persona($nom,$habitatge,$tipus);
        $json["persona"][$persona->id] = $persona;

        file_put_contents(DATABASE, json_encode($json));

    }


    class Persona {
        public string $id;
        public string $nom;
        public string $habitatge;
        public string $tipus;
        
        public function __construct(string $nom, string $habitatge, string $tipus) {
            $this->id = uniqid();
            $this->nom = $nom;
            $this->habitatge = $habitatge;
            $this->tipus = $tipus;
        }
    }
?>
