<?php
$this->load->view('header');
$this->load->view('top');
?>

<h1>Configurações</h1>
<div class="row">
	<div class="col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Tipos de Equipamentos</h3>
			</div>
			<div class="panel-body">
			
				<?php 
				if (count($lista_tipo_equipamento)) {
					?>
					<table class="table">
						<tbody>
							<?php
							foreach ($lista_tipo_equipamento as $item_tipo_equipamento) {
								?>
								<tr>
									<td><?php echo $item_tipo_equipamento->getNome(); ?></td>
									<td><?php echo anchor('settings/tipo_equipamento/' . $item_tipo_equipamento->getId(), '<span class="glyphicon glyphicon-cog"></span>', 'class="pull-right"'); ?></td>
								</tr>
								<?php 
							}
							?>
						</tbody>
					</table>
					<?php 
				}
				?>
			
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Tipos de Equipamentos</h3>
			</div>
			<div class="panel-body">
			
				<?php 
				if (count($lista_tipo_equipamento)) {
					?>
					<table class="table">
						<tbody>
							<?php
							foreach ($lista_tipo_equipamento as $item_tipo_equipamento) {
								?>
								<tr>
									<td><?php echo $item_tipo_equipamento->getNome(); ?></td>
									<td><?php echo anchor($item_tipo_equipamento->getId(), '<span class="glyphicon glyphicon-cog"></span>', 'class="pull-right"'); ?></td>
								</tr>
								<?php 
							}
							?>
						</tbody>
					</table>
					<?php 
				}
				?>
			
			</div>
		</div>
	</div>
</div>



<?php
$this->load->view('footer');