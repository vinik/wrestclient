<?php $this->load->view('header'); ?>
<?php $this->load->view('top'); ?>

<h1 class="page-header"><?php echo $equipamento->getName(); ?></h1>

<table class="table">
	<tbody>
		<tr>
			<td>Nome</td>
			<td><?php echo $equipamento->getName(); ?></td>
		</tr>
		<tr>
			<td>Tipo</td>
			<td><?php echo $equipamento->getTipo(); ?></td>
		</tr>
		<tr>
			<td>Modelo</td>
			<td><?php echo $equipamento->getModelo(); ?></td>
		</tr>
		<tr>
			<td>NSU</td>
			<td><?php echo $equipamento->getNsu(); ?></td>
		</tr>
		<tr>
			<td>Serial</td>
			<td><?php echo $equipamento->getSerial(); ?></td>
		</tr>
	</tbody>
</table>

<h2>Comandos</h2>
<?php 
//<button type="button" class="btn btn-default">Editar</button>
?>


<div class="hidden">
	<?php
	if (count($lista_comandos)) {
		?>
		<ul class="nav nav-pills">
			<?php 
			foreach ($lista_comandos as $itemComando) {
				if (in_array($itemComando, $lista_comandos_disponiveis)) {
					$active = true;
				} else {
					$active = false;
				}
				?>
				<li <?php echo $active ? 'class="active"' : ''; ?>><a href="#"><?php echo $itemComando->getNome(); ?></a></li>
				<?php 
			}
			?>
		</ul>
		<?php 
	}
	?>
</div>

<div class="show">
	<?php
	if (count($lista_comandos_disponiveis)) {
		?>
		<ul class="nav nav-pills">
			<?php 
			foreach ($lista_comandos_disponiveis as $itemComando) {
				?>
				<li><?php echo anchor('general/requisicao/' . $equipamento->getId() . '/' . $itemComando->getId(), $itemComando->getNome()); ?></li>
				<?php 
			}
			?>
		</ul>
		<?php 
	}
	?>
</div>

<?php $this->load->view('footer'); ?>