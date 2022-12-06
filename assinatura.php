<?php 
	//Retira possiveis erros que irão quebrar a imagem
	error_reporting(0);
	//================================================================================================
	// Header informando que é uma imagem JPEG
	header( 'Content-type: image/jpeg; charset=utf-8' );
	// Vê qual foram as variaveis selecionadas pelo usuario 
	// recebe a imagem de fundo, depois decide altura pra cada layout
	// Telefone Sem celular e Sem emergencia
	if (isset($_GET["cel"]) AND !isset($_GET["tel"])){
		$imgResource = ImageCreateFrompng("imagens/bg1.png");
		$alturanome=57;
		$alturacargo=73;
		$alturaemail=100;
		$alturacel=119;
	}	// Celular Sem Telefone e Sem emergencia
	if (isset($_GET["tel"]) AND $_GET["cel"]==""){
		$imgResource = ImageCreateFrompng("imagens/bg2.png");
		$alturanome=57;
		$alturacargo=73;
		$alturaemail=100;
		$alturatel=119;
	}	// Telefone e celular e Sem emergencia
	if ($_GET["tel"]!="" AND $_GET["cel"]!=""){
		$imgResource = ImageCreateFrompng("imagens/bg3.png");
		$alturanome=57;
		$alturacargo=73;
		$alturaemail=100;
		$alturatel=119;
		$alturacel=157;
	}// Celular Sem telefone EMERGENCIA
	if (isset($_GET["cel"]) AND $_GET["tel"]=="" AND isset($_GET["hdc"])){
		$imgResource = ImageCreateFrompng("imagens/bghdc1.png");
		$alturanome=37;
		$alturacargo=53;
		$alturaemail=78;
		$alturacel=103;
	}// Telefone Sem Celular EMERGENCIA
	if (isset($_GET["tel"]) AND $_GET["cel"]=="" AND isset($_GET["hdc"])){
		$imgResource = ImageCreateFrompng("imagens/bghdc2.png");
		$alturanome=37;
		$alturacargo=53;
		$alturaemail=85;
		$alturatel=103;
	}
	if ($_GET["tel"]!=""  AND $_GET["cel"]!=""  AND $_GET["hdc"]=="on" ){
		$imgResource = ImageCreateFrompng("imagens/bghdc3.png");
		$alturanome=37;
		$alturacargo=53;
		$alturaemail=78;
		$alturatel=96;
		$alturacel=130;
	}
	//Explode as GET
	$nome = urldecode( $_GET['nome']);
	$cargo =urldecode( $_GET['cargo']);
	$email = urldecode( $_GET['email']);
	
	function ValidaEmail($email){
	//pega a variavel e mecla com o dominio
	$vemail = "$email@bravante.com.br";
	//verifica se o email é valido
	if (filter_var($vemail, FILTER_VALIDATE_EMAIL)) {
   } else {	}}
	validaEmail($email);
	if (isset($_GET["tel"])){$tel = urldecode( $_GET['tel']);}
	if (isset($_GET["cel"])){$cel = urldecode( $_GET['cel']);}
// Define a cor
	$textcolor1 = imagecolorallocate($imgResource, 78, 127, 113);
	$textcolor2 = imagecolorallocate($imgResource, 77, 77, 77);
 // carregar fontes...
	$fnormal = './font/Cabin_Condensed-Regular.TTF';
	$fcalibri =  './font/calibri.ttf';
	$fnegrito = './font/Cabin_Condensed-Bold.TTF';

//Tamanho das fontes
	$nomeSize=17.1;
	$cargoSize=11.2;
	$emailSize=11.2;
	$telSize=10;
	
//================================================================================================
//Cria caixa de texto
	$textNome=	imagettfbbox($nomeSize , 0 , $fnegrito , $nome );
	$textCargo=	imagettfbbox($cargoSize , 0 , $fnegrito , $cargo );
	$textrEmail=imagettfbbox($emailSize , 0 , $fnormal , $email );
	
//Escreve na tela Nome e Cargo
		imagettftext($imgResource, $nomeSize, 	0,	249, $alturanome, $textcolor1,$fnegrito, $nome);
		imagettftext($imgResource, $cargoSize, 	0, 	249, $alturacargo, $textcolor2,$fnormal, $cargo);	
		
	// Divide o email pra mudar fonte do @
		
		//Importar a logo
		$distemail = 249;
		imagettftext($imgResource, $emailSize, 	0, 	$distemail	, $alturaemail, $textcolor2,$fnormal, $email);
		
		$distancia = $textrEmail[2]+249;
		$arroba="@"; 
		imagettftext($imgResource, "11.5", 	0, 	$distancia	, $alturaemail-1, $textcolor2,$fcalibri, $arroba);
		$distancia = $distancia + 13;
		imagettftext($imgResource, $emailSize, 	0, 	$distancia	, $alturaemail, $textcolor2,$fnormal, "bravante.com.br");
		
	// Se for informado o numero de telefone, imprime texto
		if($_GET["tel"]!=""){
			imagettftext($imgResource, $telSize, 	0, 	267, $alturatel, $textcolor2,$fnormal, $tel);
		}
		
	// Se for informado o numero de celular, imprime texto
		if($_GET["cel"]!=""){
			if($_GET["tel"]==""){imagettftext($imgResource, $telSize, 	0, 	267, $alturacel, $textcolor2,$fnormal, $cel);}
			else{imagettftext($imgResource, $telSize, 	0, 	267, $alturacel-16, $textcolor2,$fnormal, $cel);}
		}
	
// Envia a imagem para o borwser ou arquivo
	imagejpeg( $imgResource, NULL, 100 );
	imagejpeg( $imgResource, "assinaturas/".$email.".jpg", 100 );
	
?>