<?php include './layout/header.php'; ?>
<?php include './layout/menu.php'; ?>
<?php 

require 'classes/Categoria.php';
require 'classes/CategoriaDAO.php';

$categoriaDAO = new CategoriaDAO();

if(isset($_GET['pesquisa']) && $_GET['pesquisa'] != '') {
	$categorias = $categoriaDAO->listar($_GET['pesquisa']);
} else {
	$categorias = $categoriaDAO->listar();
}


?>
<?php 
	if(isset($_GET['msg']) && $_GET['msg'] != '') {
	 echo '<div class="alert alert-info">'.$_GET['msg'].'</div>';
	}
?>
<div class="row" style="margin-top:40px">
	<div class="col-6">
		<h2>Gerencias categorias</h2>
	</div>
	<div class="col-4">
		<form class="form-inline my-2 my-lg-0">
		<input class="form-control mr-sm-2" name="pesquisa" type="search" placeholder="Pesquisar" aria-label="Pesquisar" value="<?= (isset($_GET['pesquisa']) ? $_GET['pesquisa'] : '') ?>">
			<button class="btn btn-outline-success my-2 my-sm-0" type="submit">
				<i class="fas fa-search"></i>	
			</button>
			<a href="categorias.php" class="btn btn-outline-warning my-2 my-sm-0">
				<i class="fas fa-trash-alt"></i>
			</a>
		</form>
	</div>
	<div class="col-2">
		<a href="form_categoria.php" class="btn btn-success">Nova</a>
	</div>
</div>
<div class="row">
	<table class="table table-hover table-bordered table-striped">
		<thead>
			<tr>
				<th>#ID</th>
				<th>Nome</th>
				<th>Ações</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($categorias as $categoria){ ?>
			<tr>
				<td><?= $categoria->getId() ?></td>
				<td><?= $categoria->getNome() ?></td>
				<td>
					<a href="form_categoria.php?id=<?= $categoria->getId() ?>" class="btn btn-warning">
						<i class="fas fa-edit"></i>
					</a>
					<a href="controle_categoria.php?acao=deletar&id=<?= $categoria->getId() ?>" onclick="return confirm('Deseja realmente excluir?')" class="btn btn-danger">
						<i class="fas fa-trash-alt"></i>
					</a>
				</td>
			</tr>
		<?php } ?>
		</tbody>
	</table>
</div>

<?php include './layout/footer.php'; ?>