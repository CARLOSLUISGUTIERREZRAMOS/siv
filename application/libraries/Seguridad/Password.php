<?php if ( ! defined('BASEPATH')) exit('No esta permitido el acceso'); 
//La primera línea impide el acceso directo a este script
class Password {
    public function encriptar_password($pass){
        $opciones = ['cost' => 10 ];
        $pass =  password_hash($pass, PASSWORD_BCRYPT, $opciones)."\n";
        return $pass;
    }
    public function validarPassword($pass,$hash){
       
            if (password_verify($pass, $hash)) {
                return true;
            } else {
                return false;
            }
    }
    
    public function generarPass(){
        //Se define una cadena de caractares. Te recomiendo que uses esta.
	$cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
	//Obtenemos la longitud de la cadena de caracteres
	$longitudCadena=strlen($cadena);
	//Se define la variable que va a contener la contraseña
	$pass = "";
	//Se define la longitud de la contraseña, en mi caso 10, pero puedes poner la longitud que quieras
	$longitudPass=6;
	//Creamos la contraseña
	for($i=1 ; $i<=$longitudPass ; $i++){
	//Definimos numero aleatorio entre 0 y la longitud de la cadena de caracteres-1
	$pos=rand(0,$longitudCadena-1);
	//Vamos formando la contraseña en cada iteraccion del bucle, añadiendo a la cadena $pass la letra correspondiente a la posicion $pos en la cadena de caracteres definida.
	$pass .= substr($cadena,$pos,1);
	}
	return $pass;
    }
    

}
?>