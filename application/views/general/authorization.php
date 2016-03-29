<?php $this->load->view('header'); ?>
<?php $this->load->view('top'); ?>

<h1 class="page-header">Authorization</h1>

<?php $this->load->view('general/menu'); ?>

<br>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Request</h3>
	</div>
	<div class="panel-body">
		
		<form role="form">
			<div class="form-group">
				<label for="txtUsername">Username</label>
				<input type="text" name="username" class="form-control" id="txtUsername" placeholder="Username">
			</div>
			<div class="form-group">
				<label for="txtPassword">Senha</label>
				<input type="password" class="form-control" id="txtPassoword" placeholder="Senha">
			</div>
			<button type="button" class="btn btn-default" id="btnEnviar">Enviar</button>
		</form>
	
	</div>
</div>



<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Response</h3>
	</div>
	<div class="panel-body">
		<pre id="divResponse">
		</pre>
	</div>
</div>

<script type="text/javascript">

var siteUrl = "<?php echo site_url(); ?>";

$(document).ready(function(){
	$("#btnEnviar").click(function(){
		var username = $("#txtUsername").val();
		var password = $("#txtPassword").val();

		data = "username=" + username;
		data += "&password=" + password;

		$.ajax({
			url: siteUrl + "/general/authorization_request",
			data: data,
			type: "POST",
			dataType: "text",
			success: function(response){
				$("#divResponse").html(response);
			}
		});
	});
});

</script>





<?php $this->load->view('footer'); ?>