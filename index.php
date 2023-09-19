<html>
	<head>
		<meta charset="utf-8" />
    	<title>App Send Mail</title>
		<!-- FontAwesome-->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    	<!--Bootstrap-->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<style>
			html body{
				scroll-behavior: smooth;
				box-shadow: inset 0 0 9rem rgb(252, 197, 197);
				color: rgba(0, 0, 0, 0.747);
				background-color: #ffffff;	
			}
			/* Estilizando o ScrollBar*/

			/* Trilho */
			::-webkit-scrollbar{
				background: rgba(252, 197, 197, 0.473);
				width: 0.9vw;
			}

			/* ScrollBar*/
			::-webkit-scrollbar-thumb{
				background-color: #dc3545;
				border-radius: 6px;
			}
			.fa-solid {
				font-size: 58px;
			}
		</style>
	</head>
<body>
	<div class="container">  
		<div class="text-center">
			<i class="fa-solid fa-comments text-danger my-3"></i>
				<h3>Send Mail</h3>
				<p>Seu app de envio de e-mails particular!</p>
			</div>
      		<div class="row justify-content-center">
      			<div class="col-md-6">
					<div class="card-body font-weight-bold">
						<form action="Pages/processa-envio.php" method="POST">
							<div class="form-group">
								<label for="para">Para</label>
								<input type="text" name="para" class="form-control" id="para" placeholder="joao@dominio.com.br">
							</div>

							<div class="form-group">
								<label for="assunto">Assunto</label>
								<input type="text"  name="assunto" class="form-control" id="assunto" placeholder="Assundo do e-mail">
							</div>

							<div class="form-group">
								<label for="mensagem">Mensagem</label>
								<textarea class="form-control"  name="mensagem" id="mensagem"></textarea>
							</div>
							<div class="d-flex justify-content-center">
								<button type="submit" class="btn btn-danger btn-lg">Enviar Mensagem</button>
							</div>
						</form>
					</div>
				</div>
      		</div>
    	</div>
</body>
</html>