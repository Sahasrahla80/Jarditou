<?php $title='Tableau - Jarditou';
$description = 'Tableau des ventes - Jarditou'; ?>
	
	<?php ob_start(); ?>
	
	
	<section>
		<div class="row">
		<article class="col-6 col-sm-6 col-md-6 col-lg-8">
		
		<h1>Tableau des ventes</h1>
		
		<div class="table-responsive">
		
		<table class="table">
			<thead>
			<tr>
				<th> - </th>
				<th>Janvier</th>
				<th>Février</th>
				<th>Mars</th>
			</tr>
			</thead>
			<tr>
				<td colspan="4">Ventes du 1<sup>er</sup> trimestre</td>
			</tr>
			<tbody>
			<tr>
				<td>Pierre</td>
				<td>65 800</td>
				<td>53 200</td>
				<td>46 400</td>
			</tr>
			<tr>
				<td>Paul</td>
				<td>88 000</td>
				<td>51 500</td>
				<td>62 300</td>
			</tr>
			<tr>
				<td rowspan="2">Jacques</td>
				<td>74 400</td>
				<td>64 200</td>
				<td>78 900</td>
			</tr>
			<tr>
				<td>68 100</td>
				<td>76 700</td>
				<td>99 500</td>
			</tr>
			</tbody>
			<tfoot>
			<tr>
				<td>Total</td>
				<td>296 300</td>
				<td>268 400</td>
				<td>287 100</td>
			</tr>
			</tfoot>
			<caption>Ventes sur le premier trimestre</caption>
		</table>
		
		</div>
				
		</article>
		
		<aside class="col-6 col-sm-6 col-md-6 col-lg-4">
			<p>[COLONNE DROITE]</p>
		</aside>
		</div>
	</section>
<?php $contenu=ob_get_clean(); ?>
<?php require 'template.php'; ?>

