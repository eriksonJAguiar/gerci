<?PHP
class LdapServer{

	/*Atributos*/
	public $ldap_server;
	public $dominio;

	/*Construtor*/
	function __construct($ldap_server, $dominio){
		$this->ldap_server = $ldap_server;
		$this->dominio = $dominio;
	}
	/*GETs e SETs*/

	function autentica($usuario){
	        if (!($connect = @ldap_connect($this->ldap_server))) {
        	        return FALSE; //false
	        }
        	// Tenta autenticar no servidor
	        ldap_set_option($connect, LDAP_OPT_PROTOCOL_VERSION, 3);
        	ldap_set_option($connect, LDAP_OPT_REFERRALS, 0);
		$user = $usuario->getRa().'@'.$this->dominio;
        	if (!($bind = @ldap_bind($connect, $user,$usuario->getPassword()))) {
                	// se não validar retorna false
	                return FALSE;
        	} else {
                	// se validar retorna true
	                return TRUE;
        	}
	}
}
?>
