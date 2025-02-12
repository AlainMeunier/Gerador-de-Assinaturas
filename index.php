<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<title>Gerador de Assinatura - Grupo Bravante</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="assets/css/main.css" media="screen" />	
	</head>
	<body>
	<div class="home">
		<div id="container">
			<div class="form">
				<form id="signform" >
					<table class="table">
						<tr>
							<th class="toptable" colspan="2">
								<div>Gerador de Assinatura</div>
							</th>
							</tr>
							<tr>
								<td class="caption">Nome:</td>
								<td>
								<input class="field" type="text" name="nome" placeholder="Nome" id="nome" required />
								</td>
							</tr>
							<tr>
								<td class="caption">Setor:</td>
								<td>
								<input class="field" type="text" name="cargo" placeholder="Setor" required />
								</td>
							</tr>
							<tr>
								<td class="caption">Email:</td>
								<td>
								<input id="email" class="field2" type="text" name="email" placeholder="Email" required />@bravante.com.br
								</td>
							</tr>
							<tr>
								<td class="caption">Telefone:</td>
								<td>
								<input class="field" id="tel"  type="tel" name="tel" placeholder="(xx) XXXX-XXXX" />
								</td>
							</tr>
							<tr>
								<td class="caption">Celular:</td>
								<td>													<!--Não está errado é o tipo, nao existe type=cel-->
								<input class="field" id="cel"  type="tel" name="cel" placeholder="(xx) XXXXX-XXXX" />
								</td>
							</tr>
							<tr>
								<td class="caption">EMERGENCIA?</td>
								<td>
								<input class="check" type="checkbox" name="hdc" id="hdc" value="on" />
								</td>
							</tr>
					</table>
				</form>
					
					<div class="preview">
						<!-- Imagem gerada -->
						<img id="SignImg" src="http://127.0.0.1/Gerador-de-Assinaturas/assinatura.php" alt="Assinatura Gerada">
					</div>
					<div>	
						<button class="btndownload" id="btndownload">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="20" height="20">
							<path fill="white" d="M288 32c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 242.7-73.4-73.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l128 128c12.5 12.5 32.8 12.5 45.3 0l128-128c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L288 274.7 288 32zM64 352c-35.3 0-64 28.7-64 64l0 32c0 35.3 28.7 64 64 64l384 0c35.3 0 64-28.7 64-64l0-32c0-35.3-28.7-64-64-64l-101.5 0-45.3 45.3c-25 25-65.5 25-90.5 0L165.5 352 64 352zm368 56a24 24 0 1 1 0 48 24 24 0 1 1 0-48z"/>
						</svg>
						Download</button>
					</div>
		</div>

		<!-- Área de debug para exibir a URL gerada  - Desativada
		<div id="debug"></div>-->
	</div>
	</body>
	<!------------------------------------------------ Scripts -------------------------------->
	<script>
        document.addEventListener("DOMContentLoaded", function() {
            console.log("DOM completamente carregado.");

            function aplicarMascaraTelefoneOuCelular(input) {
                let numero = input.value.replace(/\D/g, ""); // Remove tudo que não for número

                if (numero.length > 11) numero = numero.slice(0, 11); // Limita a 11 dígitos

                if (numero.length === 11) {
                    // Celular com nono dígito
                    input.value = numero.replace(/^(\d{2})(\d{5})(\d{4})$/, "($1) $2-$3");
                } else if (numero.length === 10) {
                    // Telefone fixo
                    input.value = numero.replace(/^(\d{2})(\d{4})(\d{4})$/, "($1) $2-$3");
                } else if (numero.length > 2) {
                    // DDD + parte do número
                    input.value = `(${numero.slice(0, 2)}) ${numero.slice(2)}`;
                } else {
                    // Apenas DDD
                    input.value = `(${numero}`;
                }
            }

            let telefoneInput = document.getElementById("tel");
            let celularInput = document.getElementById("cel");
            
            // Função para atualizar a URL da imagem
            function updateImage() {
                const form = document.getElementById("signform");
                const formData = new FormData(form);
                const params = new URLSearchParams(formData).toString();
                const fullURL = "http://127.0.0.1/Gerador-de-Assinaturas/assinatura.php?" + params;
                document.getElementById("SignImg").src = fullURL;
            }

            if (telefoneInput) {
                telefoneInput.addEventListener("input", function () {
                    aplicarMascaraTelefoneOuCelular(this);
                    updateImage(); // Atualiza a imagem após a máscara
                });
            }

            if (celularInput) {
                celularInput.addEventListener("input", function () {
                    aplicarMascaraTelefoneOuCelular(this);
                    updateImage(); // Atualiza a imagem após a máscara
                });
            }

            // Atualiza o campo de email a partir do nome
            function updateEmail() {
                let nome = document.getElementById('nome').value.toLowerCase();
                let emailMasked = nome.replace(/\s+/g, '.');
                document.getElementById('email').value = emailMasked;
            }

            document.getElementById('nome').addEventListener('input', function() {
                updateEmail();
                updateImage();
            });

            document.getElementById("signform").addEventListener("input", updateImage);
            document.getElementById("hdc").addEventListener("change", updateImage);

            // Função para gerar o link de download da imagem
            document.getElementById("btndownload").addEventListener("click", function() {
                const form = document.getElementById("signform");
                const formData = new FormData(form);
                const params = new URLSearchParams(formData).toString();
                const downloadURL = "http://127.0.0.1/Gerador-de-Assinaturas/assinatura.php?" + params + "&down=on";
                const link = document.createElement('a');
                link.href = downloadURL;
                link.download = 'assinatura.jpg';
                link.click();
            });

            updateImage();
        });
    </script>

</html>