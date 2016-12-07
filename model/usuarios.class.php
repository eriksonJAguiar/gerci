<?PHP
class Usuario{
	/*Atributos*/
	public $nome;
	public $ra;
	public $password;

	/*Construtor*/
	function __construct($ra, $passwd){
		$this->ra = $ra;
		$this->password = $passwd;
	}
	/*GETs e SETs*/

	function getRa(){
		return $this->ra;
	}

	function getPassword(){
		return $this->password;
	}
}
