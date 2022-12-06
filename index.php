<style>
		body {margin: 0px;}
        .boxHead{
		align-items: center;
		color: #fff;
		font-family: "Open Sans";
        border: 0px solid #5090C1;
		background-color: #5090C1;
		padding: 15px 0;
        }  
		.tabela{
            border: 1px solid #5090C1;  
			font-family: "Open Sans";
			width: 600px;
			color: #393939;
			position: relative;
			margin-left: auto;
			margin-right: auto;
			margin-top: 08%;
			display: table;
			border-collapse: collapse;
			border-spacing: 2px;
		}
		.legenda {
		width:40%; text-align: right;
		}
		.campo1 {
			width: 280px;
			height: 35px;
			text-transform:uppercase;
		}
		.campo {
			width: 280px;
			height: 35px;
		}
				.campo2 {
			width: 135px;
			height: 35px;
		}
		.check {
			width: 25px;
			align: center;
			height: 25px;
			background: #ff7212;
			border: 2px solid #ff7212;
			 box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.2);
		}
     </style>
	 

		
	<script>
	/*
	Função para mascarar o campo de Telefone
	*/
		function mascaraTelefone(event) {
			let tecla = event.key;
			let telefone = event.target.value.replace(/\D+/g, "");
			if (/^[0-9]$/i.test(tecla)) {
				telefone = telefone + tecla;
				let tamanho = telefone.length;
				if (tamanho >= 11) {
					return false;
				}
				if (tamanho > 10) {
					telefone = telefone.replace(/^(\d\d)(\d{5})(\d{4}).*/, "($1) $2-$3");
				} else if (tamanho > 5) {
					telefone = telefone.replace(/^(\d\d)(\d{4})(\d{0,4}).*/, "($1) $2-$3");
				} else if (tamanho > 2) {
					telefone = telefone.replace(/^(\d\d)(\d{0,5})/, "($1) $2");
				} else {
					telefone = telefone.replace(/^(\d*)/, "($1");
				}
				event.target.value = telefone;
			}
			if (!["Backspace", "Delete"].includes(tecla)) {
				return false;
			}
		}
	/*
	Função para mascarar o campo de Celular
	*/
		function mascaraCelular(event) {
			let tecla = event.key;
			let celular = event.target.value.replace(/\D+/g, "");
			if (/^[0-9]$/i.test(tecla)) {
				celular = celular + tecla;
				let tamanho = celular.length;
				if (tamanho >= 12) {
					return false;
				}
				if (tamanho > 10) {
					celular = celular.replace(/^(\d\d)(\d{5})(\d{4}).*/, "($1) $2-$3");
				} else if (tamanho > 5) {
					celular = celular.replace(/^(\d\d)(\d{4})(\d{0,4}).*/, "($1) $2-$3");
				} else if (tamanho > 2) {
					celular = celular.replace(/^(\d\d)(\d{0,5})/, "($1) $2");
				} else {
					celular = celular.replace(/^(\d*)/, "($1");
				}
				event.target.value = celular;
			}
			if (!["Backspace", "Delete"].includes(tecla)) {
				return false;
			}
		}



	</script>
</head>

<table class="tabela">
	<form id="formDados" method="get" action="assinatura.php" >
	
		<tr>
			<th class="boxHead" align="center" colspan="2"><div>Gerador de Assinatura</div> </th>
		</tr>

		<tr>
			<td class="legenda">Nome:</td>
			<td><input class="campo1" type="text" name="nome" placeholder="Nome" id="nome"/></td>
		</tr>
		<tr>
			<td class="legenda">Setor:</td>
			<td><input class="campo" type="text" name="cargo" placeholder="Setor"><br></td>
		</tr>
		<tr>
			<td class="legenda">Email:	<script type="text/javascript">
			/*
			Máscara para repetir o que foi digitado no nome e substituir espaço por ponto
			*/
					document.getElementById('nome').addEventListener('input', (e) => {
						var email = e.target.value.toLowerCase();
						var emailmasked = email.replace(' ', '.');
						document.getElementById('email').value = emailmasked;
			})
			
		</script></td>
			<td><input id="email"  class="campo2" type="text" name="email" />@bravante.com.br</td>
		</tr>
		<tr>
			<td class="legenda">Telefone:</td>
			<td><input class="campo" onkeydown="return mascaraTelefone(event)" type="tel" name="tel" placeholder="(xx) XXXX-XXXX"></td>
		</tr>
		<tr>
			<td class="legenda">Celular:</td>
			<td><input class="campo" onkeydown="return mascaraCelular(event)" type="tel" name="cel" placeholder="(xx) XXXX-XXXX"></td>
		</tr>
				<td class="legenda">EMERGENCIA? </td>
			<td><input class="check" type="checkbox" name="hdc"></td>
		</tr>
					
				<br>
		
		<tr>
			<td align='center' colspan='2'><input type="submit" value="Cadastrar" /></td>
		</tr>
    </table></form>