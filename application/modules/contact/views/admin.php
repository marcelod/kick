<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><?php echo $title ?></h1>
    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="row">
    <div class="col-lg-7">

		<div id="infoMessage"><?php echo $message;?></div>

		<?php if (count($contacts) > 0): ?>

			<table class="table table-condensed table-striped table-hover table-bordered">
				<thead>
					<tr>
						<th>Nome</th>
						<th>Email</th>
						<th>Telefone</th>
						<th>Mensagem</th>
						<th>Data</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($contacts as $contact):?>
					<tr>
			            <td><?php echo htmlspecialchars($contact->name, ENT_QUOTES,'UTF-8');?></td>
			            <td><?php echo htmlspecialchars($contact->email, ENT_QUOTES,'UTF-8');?></td>
			            <td><?php echo htmlspecialchars($contact->telephone, ENT_QUOTES,'UTF-8');?></td>
			            <td><?php echo htmlspecialchars($contact->message, ENT_QUOTES,'UTF-8');?></td>
			            <td><?php echo $contact->created_at;?></td>
					</tr>
				<?php endforeach;?>
				</tbody>
			</table>

		<?php else: ?>
			<?php echo cAlerts('Não há mensagens de contato.', "alert-danger", false) ?>
		<?php endif ?>

    </div>
    <!-- /.col-lg-7 -->

    <div class="col-lg-5">

    	exibir parametrizações que estao na tabela options para a parte de contato... ainda a criar tbm essa linha e a consulta

    </div>
</div>