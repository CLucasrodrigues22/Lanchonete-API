<?php
	include_once('header.php');

	if(!isset($_SESSION['perfil']) && $_SESSION['perfil'] == '') {
		$msg = 'Usuário não efetuou login.';
		$alert = 'danger';
		header("Location: login.php?msg=$msg&alert=$alert");
	} 
	include_once('admin/classes/Produto.php');
	include_once('admin/classes/ProdutoDAO.php');
	include_once('admin/classes/Venda.php');
	include_once('admin/classes/VendaDAO.php');
	include_once('admin/classes/VendaProduto.php');
	include_once('admin/classes/VendaProdutoDAO.php');

	$vendaDAO = new VendaDAO();
	$venda = new Venda();
	$vendaProdutoDAO = new VendaProdutoDAO();

	//alimentando o objeto de venda
	$venda->setCodigo(date('YmdHms').gettimeofday()["usec"]);
	$venda->setClienteId($_SESSION['id_cliente']);
	$venda->setDataVenda(date('Y-m-d H:i:s'));
	$venda->setDataFinalizacao(date('Y-m-d H:i:s'));
	$venda->setDataPagamento(date('Y-m-d H:i:s'));
	$venda->setFormaPagamento($_POST['forma_pagamento']);
	$venda->setStatus($_POST['status']);

	/*echo '<pre>';
	print_r($venda);
	exit;*/
	//inserindo a venda no BD e recurando o id
	$id_venda = $vendaDAO->insereVenda($venda);
	//add o id da venda no objeto
	$venda->setId($id_venda);
	//echo $id_venda; //exit;
	$total = 0;
	if(isset($_SESSION['compras']) && $_SESSION['compras'] != '') {
	foreach ($_SESSION['compras'] as $item) {
		$vendaProduto = new VendaProduto();
		$vendaProduto->setVendaId($venda->getId());
		$vendaProduto->setProdutoId($item['produto_id']);
		$vendaProduto->setValor($item['val_produto']);
		$vendaProduto->setQtd($item['qtd_produto']);
		$vendaProduto->setDesconto(0);
	/*echo '<pre>';
	print_r($vendaProduto);
	exit;*/
		$vendaProdutoDAO->insereVendaProduto($vendaProduto);

		$total += $vendaProduto->getValor();

	}

	}
	unset($_SESSION['compras']);


	/*Envia email*/

	include_once('email_config.php');

	header('Content-type: text/html; charset=UTF-8'); 
	require 'admin/PHPMailer/SMTP.php';
	require 'admin/PHPMailer/PHPMailer.php';

	/* Usando MailTrap */
	$mail = new PHPMailer();

	$mail->isSMTP();
	$mail->Host = $mail_host;
	$mail->SMTPAuth = true;
	$mail->Username = $mail_username; //paste one generated by Mailtrap
	$mail->Password = $mail_password; //paste one generated by Mailtrap
	$mail->SMTPSecure = 'tls';
	$mail->Port = $mail_port;


	$mail->setFrom($_SESSION['email'], $_SESSION['nome']);
	$mail->addAddress('teste@gmail.com', 'Teste'); 


	$mail->Subject = 'Nova compra - Grecia Burguer.';
	$mail->isHTML(true);

	$mailContent = '
	<!DOCTYPE html>
	<html>
	<head>
		<meta charset="utf-8">
		<title>Grécia Burguer</title>
		<style>
			body,html,p, h2 {
				font-family: Arial
			}
		</style>
	</head>
	<body>
	<div style="width: 700px; margin: 0 auto;">
		<table style="width: 100%">
			<thead>
				<tr>
					<th align="center" style="background-color: #ccc;">
					<img src="assets/img/logo.png" alt="" width="250px;" align="center">
						
					</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>
						<h2>Nova compra efetuada</h2>
						<p>C&oacute;digo da venda: <strong>'.$venda->getCodigo().'</strong></p>
						<p>Data da venda: <strong>'. $venda->getDataVenda() .'</strong></p>
						<p>Valor total: <strong> R$ '. number_format($total, 2, ',','.') .'</strong></p>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
	</body>
	</html>
	';
	$mail->Body = $mailContent;


	try {
		$mail->send();
	} catch (Exception $e) {
		echo $e->getMessage;
		exit;
	}

	$msg = 'Compra finalizada com sucesso';
	$alert = 'success';
	header("Location: index.php?msg=$msg&alert=$alert");

?>