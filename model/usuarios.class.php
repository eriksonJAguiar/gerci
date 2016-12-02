<?PHP
class Usuario{
	/*Atributos*/
	public $nome;
	public $ra;
	private $password;

	/*Construtor*/
	function __construct($ra, $passwd){
		$this->ra = $ra;
		$this->passwd = $passwd;
	}
	/*GETs e SETs*/

	function getRa(){
		return $this->ra;
	}

	function getPassword(){
		return $this->password;
	}
}
