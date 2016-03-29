<body>

	<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				
				<a class="navbar-brand" href="#">S2Way API Client</a>
			</div>
			
			<?php
			/* 
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav navbar-right">
					<li><?php echo anchor('dashboard', '<span class="glyphicon glyphicon-home"></span>', 'title="Painel"'); ?></li>
					<li><?php echo anchor('settings', '<span class="glyphicon glyphicon-cog"></span>', 'title="Configurações"'); ?></li>
				</ul>
				
				<form class="navbar-form navbar-right">
					<input type="text" class="form-control" placeholder="Search...">
				</form>
			</div>
			*/
			?>
		</div>
	</div>
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-3 col-md-2 sidebar">
				<ul class="nav nav-sidebar">
					<li class="active"><a href="#">API</a></li>
					<?php 
					if (isset($lista_equipamentos)) {
						foreach ($lista_equipamentos as $item_equipamento) {
							?>
							<li><?php echo anchor('general/equipamento/' . $item_equipamento->getId(), $item_equipamento->getName()); ?></li>
							<?php
						}
					}
					?>
				</ul>
				
				<?php
				//echo anchor('equipamentos/add', '<span class="glyphicon glyphicon-plus"></span>Equipamento', 'class="btn btn-primary btn-lg btn-block"');
				?>
				
			</div>
			
			<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">