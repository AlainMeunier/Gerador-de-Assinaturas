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
					document.getElementById('nome').addEventListener('input', (e) => {
						document.getElementById('email').value = e.target.value.toLowerCase() 
				
			})
		</script></td>
			<td><input id="email" class="campo2" type="text" name="email" />@bravante.com.br</td>
		</tr>
		<tr>
			<td class="legenda">Telefone:</td>
			<td><input class="campo" type="tel" name="tel" placeholder="(xx) XXXX-XXXX"></td>
		</tr>
		<tr>
			<td class="legenda">Celular:</td>
			<td><input class="campo" type="tel" name="cel" placeholder="(xx) XXXX-XXXX"></td>
		</tr>
				<td class="legenda">EMERGENCIA? </td>
			<td><input class="check" type="checkbox" name="hdc"></td>
		</tr>
					
				<br>
		
		<tr>
			<td align='center' colspan='2'><input type="submit" value="Cadastrar" /></td>
		</tr>
    </table></form>