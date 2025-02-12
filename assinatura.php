<?php 
// Retira possíveis erros que irão quebrar a imagem
error_reporting(0);

// Header informando que é uma imagem JPEG
header('Content-type: image/jpeg; charset=utf-8');

// Variáveis de fundo e altura definidas com base nos parâmetros
$backgrounds = [
    'bg1'   => ['path' => 'assets/images/bg1.png', 'height' => [57, 73, 100, 119, 119  ]],
    'bg2'   => ['path' => 'assets/images/bg2.png', 'height' => [57, 73, 100, 119, 119  ]],
    'bg3'   => ['path' => 'assets/images/bg3.png', 'height' => [57, 73, 100, 119, 141  ]],
    'bg4'   => ['path' => 'assets/images/bg4.png', 'height' => [37, 53, 78, 103,  119  ]],
    'bg5'   => ['path' => 'assets/images/bg5.png', 'height' => [37, 53, 85, 103,  119  ]],
    'bg6'   => ['path' => 'assets/images/bg6.png', 'height' => [37, 53, 78, 96,   115  ]],
];

// Seleciona qual tamanho e fundo será usado
$imageKey = '';
    if (!empty($_GET["cel"]) && empty($_GET["tel"])  && empty($_GET["hdc"])) {$imageKey = 'bg1';}   //Se apenas o Celular estiver definido 
elseif (!empty($_GET["tel"]) && empty($_GET["cel"])  && empty($_GET["hdc"])) {$imageKey = 'bg2';}   //Se apenas o Telefone estiver definido 
elseif (!empty($_GET["tel"]) && !empty($_GET["cel"]) && empty($_GET["hdc"])) {$imageKey = 'bg3';}   //Se ambos estiverem definidos
elseif (!empty($_GET["cel"]) && empty($_GET["tel"])  && ($_GET["hdc"]=="on")){$imageKey = 'bg4';}   //Se apenas o Celular estiver definido 
elseif (!empty($_GET["tel"]) && empty($_GET["cel"])  && ($_GET["hdc"]=="on")){$imageKey = 'bg5';}   //Se apenas o Telefone estiver definido 
elseif (!empty($_GET["tel"]) && !empty($_GET["cel"]) && ($_GET["hdc"]=="on")){$imageKey = 'bg6';}   //Se ambos estiverem definidos 
else                                                                         {$imageKey = 'bg1';}   //Se nenhum parâmetro for passado, use um valor de fallback

//Verifica se a imagem de fundo existe
$imgResource = ImageCreateFrompng($backgrounds[$imageKey]['path']);
if (!$imgResource) {
    die("Erro ao carregar a imagem de fundo.");
}

//Explore a Array
list($alturanome, $alturacargo, $alturaemail, $alturatel, $alturacel) = $backgrounds[$imageKey]['height'];
// Explode as GET

// Sanitiza as entradas
$nome  = htmlspecialchars($_GET['nome'] ?? '', ENT_QUOTES, 'UTF-8');
$cargo = htmlspecialchars($_GET['cargo'] ?? '', ENT_QUOTES, 'UTF-8');
$email = filter_input(INPUT_GET, 'email', FILTER_SANITIZE_EMAIL) ?? '';
$tel   = htmlspecialchars($_GET['tel'] ?? '', ENT_QUOTES, 'UTF-8');
$cel   = htmlspecialchars($_GET['cel'] ?? '', ENT_QUOTES, 'UTF-8');



//Função para validar email
//function validaEmail($email) {
//    $vemail = "$email@bravante.com.br";
//    if (!filter_var($vemail, FILTER_VALIDATE_EMAIL)) {
//        die("Email inválido.");
//
//    }
//    return true;
//}
//Invoca a função e valida o email
//validaEmail($email);

// Define a cor
$textcolor1 = imagecolorallocate($imgResource, 78, 127, 113);
$textcolor2 = imagecolorallocate($imgResource, 77, 77, 77);

// Carregar fontes
$fnormal = 'assets/font/Cabin_Condensed-Regular.ttf';
$fcalibri = 'assets/font/calibri.ttf';
$fnegrito = 'assets/font/Cabin_Condensed-Bold.ttf';

// Verifica se as fontes existem
if (!file_exists($fnormal) || !file_exists($fcalibri) || !file_exists($fnegrito)) {
    die("Fontes não encontradas.");
}

// Tamanho das fontes
$nomeSize   = 17.1;
$cargoSize  = 11.2;
$emailSize  = 11.2;
$telSize    = 10;

// Cria caixa de texto para calcular largura e altura
$textNome   = imagettfbbox($nomeSize, 0, $fnegrito, $nome);
$textCargo  = imagettfbbox($cargoSize, 0, $fnegrito, $cargo);
$textrEmail = imagettfbbox($emailSize, 0, $fnormal, $email);

// Escreve o nome e cargo
if (!empty($nome)) {
imagettftext($imgResource, $nomeSize, 0, 249, $alturanome, $textcolor1, $fnegrito, $nome);
}
if (!empty($cargo)) {
imagettftext($imgResource, $cargoSize, 0, 249, $alturacargo, $textcolor2, $fnormal, $cargo);
}
if (!empty($email)) {
// Divide o email para mudar a fonte do "@"
$distemail = 249;
imagettftext($imgResource, $emailSize, 0, $distemail, $alturaemail, $textcolor2, $fnormal, $email);

// Pega a distância para inserir o "@"
$distancia = $textrEmail[2] + 249;
imagettftext($imgResource, 11.5, 0, $distancia, $alturaemail - 1, $textcolor2, $fcalibri, "@");

// Pega a distância para inserir o domínio
$distancia = $distancia + 13;
imagettftext($imgResource, $emailSize, 0, $distancia, $alturaemail, $textcolor2, $fnormal, "bravante.com.br");
}
// Se for informado o número de telefone, imprime o texto
if (!empty($tel)) {
    imagettftext($imgResource, $telSize, 0, 267, $alturatel, $textcolor2, $fnormal, $tel);
}

// Se for informado o número de celular, imprime o texto
if (!empty($cel)) {
    imagettftext($imgResource, $telSize, 0, 267, $alturacel, $textcolor2, $fnormal, $cel);
}
$isDownload = isset($_GET['down']) && $_GET['down'] == 'on';

// Se o parâmetro "down" for verdadeiro, força o download da imagem
if ($isDownload) {
    // Cabeçalhos para forçar o download
    header('Content-Disposition: attachment; filename="assinatura.jpg"');
    imagejpeg($imgResource, NULL, 100);  // Envia a imagem para o navegador
} else {
    // Caso contrário, apenas exibe a imagem
    imagejpeg($imgResource, NULL, 100);
}
// Liberar a memória
imagedestroy($imgResource);
exit();
?>