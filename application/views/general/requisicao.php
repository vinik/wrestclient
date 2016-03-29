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



<div class="show">
	<?php
	if (count($lista_comandos_disponiveis)) {
		?>
		<ul class="nav nav-pills">
			<?php 
			foreach ($lista_comandos_disponiveis as $itemComando) {
				?>
				<li <?php echo $itemComando->getId() == $comando->getId() ? 'class="active"': '';?>><?php echo anchor('general/requisicao/' . $equipamento->getId() . '/' . $itemComando->getId(), $itemComando->getNome()); ?></li>
				<?php 
			}
			?>
		</ul>
		<?php 
	}
	?>
</div>


<h3>Requisição</h3>



<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">
			Request
		</h3>
	</div>
	<div class="panel-body">
		<form role="form" class="form-horizontal">
		
		
			<?php
			if (count($api_list)) {
				?>
				<div class="form-group">
					<label for="selApi" class="col-sm-2 control-label">API</label>
					<div class="col-sm-6">
						<select id="selApi" class="form-control">
							<?php
							foreach ($api_list as $api_item) {
								?>
								<option value="<?php echo $api_item->getId(); ?>" <?php echo $api_item->getId() == $this->session->userdata('api_id') ? 'selected="selected"' : ''; ?>><?php echo $api_item->getNome(); ?></option>
								<?php
							}
							?>
						</select>
					</div>
				</div>
				<?php
			}
			?>
			
			<?php 
			if ($comando->isComId()) {
				?>
				<div class="form-group">
					<label class="col-sm-2 control-label">ID (para requisição)</label>
					<div class="col-sm-6">
						<input name="id" id="txtId" class="class="form-control""/>
					</div>
				</div>
				<?php 
			}
			?>
			<?php 
			foreach ($lista_parametros as $item_parametro) {
				$campo = '';
				$valor_padrao = '';
				if ($item_parametro->getValorPadrao()) {
					$valor_padrao = $item_parametro->getValorPadrao();
					
				}
				
				//Enum
				if (stripos($valor_padrao, '(') === 0) {
					$options = array();
					$enum = explode(',', str_replace('(', '', str_replace(')', '', $valor_padrao)));
					foreach ($enum as $enumItem) {
						$options[$enumItem] = $enumItem;
					}
					
					$campo = form_dropdown($item_parametro->getNome(), $options, '', 'id="campo' . $item_parametro->getId() . '" class="form-control"');
				} else {
					$campo = form_input($item_parametro->getNome(), $valor_padrao, 'id="campo' . $item_parametro->getId() . '" class="form-control"');
				}
				
				?>
				<div class="form-group">
					<label for="campo<?php echo $item_parametro->getId(); ?>" class="col-sm-2 control-label"><?php echo $item_parametro->getNome(); ?></label>
					<div class="col-sm-6">
						<?php echo $campo; ?>
					</div>
				</div>
				<?php 
			}
			?>
			
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<button type="button" class="btn btn-default" id="btnEnviar"><?php echo $comando->getMethod(); ?></button>
				</div>
			</div>
			
		</form>
	</div>
</div>

<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Response</h3>
	</div>
	<div class="panel-body">
		
		<ul class="nav nav-tabs">
			<li class="active"><a href="#divResponseData" data-toggle="tab">Data</a></li>
			<li><a href="#divResponseHeaders" data-toggle="tab">Headers</a></li>
			<li><a href="#divResponseInfo" data-toggle="tab">Info</a></li>
		</ul>
		
		<!-- Tab panes -->
		<div class="tab-content">
			<div class="tab-pane active" id="divResponseData">...RESPONSE DATA</div>
			<div class="tab-pane" id="divResponseHeaders">...RESPONSE HEADERS</div>
			<div class="tab-pane" id="divResponseInfo">...RESPONSE INFO</div>
		</div>
		
		
		<pre id="divResponse">
		</pre>
		
		
		
		
	</div>
</div>

<script type="text/javascript">
	var siteUrl = "<?php echo site_url(); ?>";
	$(document).ready(function(){
		$("#btnEnviar").click(function(){
			var data = "api_id=" + $("#selApi").val();
			<?php 
			foreach ($lista_parametros as $indexParam => $item_parametro) {
				?>
				var <?php echo $item_parametro->getNome(); ?> = $("#campo<?php echo $item_parametro->getId(); ?>").val();
				data += '&';
				data += "<?php echo $item_parametro->getNome(); ?>=" + <?php echo $item_parametro->getNome(); ?>;
				<?php
			} 
			?>

			$.ajax({
				url: siteUrl + "/general/do_request/<?php echo $equipamento->getId(); ?>/<?php echo $comando->getId(); ?>",
				data: data,
				type: "POST",
				dataType: "html",
				success: function(response){
					$("#divResponse").html(response);
				}
			});
		});
	});
</script>

<?php $this->load->view('footer'); ?>