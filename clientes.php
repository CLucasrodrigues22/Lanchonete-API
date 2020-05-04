<?php include './layout/header.php'; ?>
<?php include './layout/menu.php'; ?>
<?php 
$permissoes = retornaControle('cliente');
$permissoesImagem = retornaControle('removeImagemCliente');

if(empty($permissoes)) {
	header("Location: adminstrativa.php?msg=Acesso negado.");
}
require 'classes/Cliente.php';
require 'classes/ClienteDAO.php';

$clienteDAO = new ClienteDAO();
if(isset($_GET['pesquisa']) && $_GET['pesquisa'] != '') {
	$clientes = $clienteDAO->listar($_GET['pesquisa']);
} else {
	$clientes = $clienteDAO->listar();
}

?>
<div class="row" style="margin-top:40px">
	<div class="col-6">
		<h2>Gerenciar clientes</h2>
	</div>
	<div class="col-4">
	<form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" name="pesquisa" type="search" placeholder="Pesquisar" aria-label="Pesquisar" value="<?= (isset($_GET['pesquisa']) ? $_GET['pesquisa'] : '') ?>">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">
      	<i class="fas fa-search"></i>	
      </button>
      <a href="./clientes.php" class="btn btn-outline-warning my-2 my-sm-0">
      	<i class="fas fa-trash-alt"></i>
      </a>
    </form>
	</div>
	<?php if($permissoes['insert']): ?>
	<div class="col-2">
		<a href="form_cliente.php" class="btn btn-success">Novo</a>
	</div>
	<?php endif; ?>
</div>
<div class="row">
	<table class="table table-hover table-bordered table-striped table-responsive-lg">
		<thead>
			<tr>
				<th></th>
				<th>#ID</th>
				<th>Nome</th>
				<th>CPF</th>
				<th>E-mail</th>
				<th>Data Nascimento</th>
				<th>Sexo</th>
				<th>Ações</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($clientes as $cliente){ 
			?>
			<tr>
				<td>
					<img src="assets/img/clientes/<?= ($cliente->getImagem() != '' && file_exists('assets/img/clientes/'. $cliente->getImagem()) ? $cliente->getImagem() : 'usuario.png') ?>" alt="" class="rounded-circle" width="50">
				</td>
				<td><?= $cliente->getId() ?></td>
				<td><?= $cliente->getNome() ?></td>
				<td><?= $cliente->getCpf() ?></td>
				<td><?= $cliente->getEmail() ?></td>
				<td><?= $cliente->getDtNascimento() ?></td>
				<td><?= $cliente->getSexo() ?></td>
				<td>
					<?php if($permissoes['update'] || $permissoes['show']): ?>
					<a href="form_cliente.php?id=<?= $cliente->getId() ?>" class="btn btn-warning" data-toggle="tooltip" title="Exibir/Editar cliente">
						<i class="fas fa-edit"></i>
					</a>
					<?php endif; ?>
					<?php if($permissoes['delete']): ?>
						<a href="controle_cliente.php?acao=deletar&id=<?= $cliente->getId() ?>" onclick="return confirm('Deseja realmente excluir?')" class="btn btn-danger" data-toggle="tooltip" title="Deletar cliente">
							<i class="fas fa-trash-alt"></i>
						</a>
					<?php endif; ?>
					<?php if(!empty($permissoesImagem)): ?>
					<a href="controle_cliente.php?acao=removeImagem&id=<?= $cliente->getId() ?>" onclick="return confirm('Deseja realmente remover a imagem?')" class="btn btn-danger" data-toggle="tooltip" title="Remover imagem">
						<i class="fas fa-folder-minus"></i>
					</a>
					<?php endif; ?>
				</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>

<?php include './layout/footer.php'; ?>