<?php
include_once('header.php');
include_once('menu.php');
if (isset($_GET['tipo'])) {
	$tipo = $_GET['tipo'];
} else {
	$tipo = 'logar';
}
?>
<main class="container sobre">
	<div class="row">
		<div class="accordion col-12" id="accordionExample">
			<div class="card">
				<div class="card-header" id="headingOne">
					<h5 class="mb-0">
						<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
							<h3>Login do cliente</h3>
						</button>
						<button class="btn btn-link collapsed" onclick="return false;" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">Não possui cadastro?</button>
					</h5>
				</div>

				<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
					<div class="card-body">
						<form action="logar.php?tipo=<?php echo $tipo; ?>" method="post">
							<div class="form-group">
								<label for="email">E-mail:</label>
								<input type="text" name="email" id="email" value="" class="form-control">
							</div>
							<div class="form-group">
								<label for="senha">Senha:</label>
								<input type="password" name="senha" id="senha" value="" class="form-control">
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-primary w-100">Efetuar login</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="card">
				<div class="card-header" id="headingTwo">
					<h5 class="mb-0">
						<button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
							<h3>Novo cadastro de cliente</h3>
						</button>
					</h5>
				</div>
				<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
					<div class="card-body">
						<form action="cadastrar_cliente.php" method="post">
							<div class="row">
								<div class="form-group col-8">
									<label for="nome">Nome:</label>
									<input type="text" class="form-control" name="nome" id="nome" required value="">
								</div>
								<div class="form-group col-4">
									<label for="cpf">CPF:</label>
									<input type="text" name="cpf" id="cpf" value="" class="form-control cpf">
								</div>
							</div>
							<div class="row">
								<div class="form-group col-4">
									<label for="dt_nascimento">Data de nascimento:</label>
									<input type="date" name="dt_nascimento" id="dt_nascimento" value="" class="form-control">
								</div>
								<div class="form-group col-4">
									<label for="sexo">Sexo:</label>
									<select name="sexo" id="sexo" class="form-control">
										<option value="">Selecione</option>
										<option value="Feminino">Feminino</option>
										<option value="Masculino">Masculino</option>
										<option value="Não informado">Não informado</option>
									</select>
								</div>
								<div class="form-group col-4">
									<label for="celular">Celular:</label>
									<input type="text" name="celular" id="celular" value="" class="form-control telefone">
								</div>
							</div>
							<div class="row">
								<div class="form-group col-8">
									<label for="email">E-mail:</label>
									<input type="email" name="email" id="email" class="form-control" required value="">
								</div>
								<div class="form-group col-4">
									<label for="senha">Senha:</label>
									<input type="password" name="senha" id="senha" class="form-control">
								</div>
							</div>
							<div class="row">
								<div class="form-group col-4">
									<label for="cep">CEP: <span class="msg-error-form" id="msg-cep">(CEP não encontrado)</span></label>
									<input type="text" name="cep" id="cep" value="" class="form-control cep">
								</div>
								<div class="form-group col-8">
									<label for="logradouro">Logradouro:</label>
									<input type="text" name="logradouro" id="logradouro" value="" class="form-control">
								</div>
							</div>
							<div class="row">
								<div class="form-group col-4">
									<label for="numero">Número:</label>
									<input type="text" name="numero" id="numero" value="" class="form-control">
								</div>
								<div class="form-group col-8">
									<label for="complemento">Complemento:</label>
									<input type="text" name="complemento" id="complemento" value="" class="form-control">
								</div>
							</div>
							<div class="row">
								<div class="form-group col-4">
									<label for="bairro">Bairro:</label>
									<input type="text" name="bairro" id="bairro" value="" class="form-control">
								</div>
								<div class="form-group col-6">
									<label for="cidade">Cidade:</label>
									<input type="text" name="cidade" id="cidade" value="" class="form-control">
								</div>
								<div class="form-group col-2">
									<label for="estado">Estado:</label>
									<input type="text" name="estado" id="estado" value="" class="form-control">
								</div>
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-primary w-100">Salvar</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>


	</div>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
</main>
<?php
include_once('footer.php');
?>

<script>
	$('.cep').on('change', function() {
		var cep = $(this).val().replace('-', '');

		$.ajax({
			url: 'https://viacep.com.br/ws/' + cep + '/json/',
			type: 'GET',
			dataType: 'json',
			beforeSend: function() {
				$('#logradouro').val('...');
				$('#bairro').val('...');
				$('#cidade').val('...');
				$('#estado').val('...');
			},
			success: function(resultado) {
				if (typeof resultado.logradouro === "undefined") {
					$('#msg-cep').show();
					$('#cep').val('');
					$('#logradouro').val('');
					$('#bairro').val('');
					$('#cidade').val('');
					$('#estado').val('');
					$('#cep').focus();
				} else {
					$('#msg-cep').hide();
					$('#logradouro').val(resultado.logradouro);
					$('#bairro').val(resultado.bairro);
					$('#cidade').val(resultado.localidade);
					$('#estado').val(resultado.uf);
					$('#numero').focus();

				}
			},
		})

	})
</script>