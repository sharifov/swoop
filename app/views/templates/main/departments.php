<main role="main">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-4">
				<table class="table table-striped">
					<thead class="thead-dark">
						<th scope="col">#</th>
						<th scope="col">Название</th>
					</thead>
					<tbody>
						<?foreach ($departments as $department):?>
							<tr scope="row">
								<td><?=$department->id?></td>
								<td><?=$department->name?></td>
							</tr>
						<?endforeach?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</main>