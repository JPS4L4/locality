<?php
include_once 'Views/template/header-admin.php';
?>

<!-- Contenedor de informacion -->
<div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
	<!-- Ver cantidad de pedidos pendientes -->
	<div class="col">
		<div class="card radius-10 border-warning border-start border-0 border-4">
			<div class="card-body">
				<div class="d-flex align-items-center">
					<div>
						<p class="mb-0 text-secondary">Pedidos pendientes</p>
						<h4 class="my-1 text-warning">
							<?php echo $data['pendientes']['total']; ?>
						</h4>
					</div>
					<div class="text-warning ms-auto font-35"><i class="fas fa-exclamation-circle"></i>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Ver cantidad de pedidos en proceso -->
	<div class="col">
		<div class="card radius-10 border-info border-start border-0 border-4">
			<div class="card-body">
				<div class="d-flex align-items-center">
					<div>
						<p class="mb-0 text-secondary">Pedidos en proceso</p>
						<h4 class="my-1 text-info">
							<?php echo $data['procesos']['total']; ?>
						</h4>
					</div>
					<div class="text-info ms-auto font-35"><i class="fas fa-spinner"></i>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Ver cantidad de pedidos finalizados -->
	<div class="col">
		<div class="card radius-10  border-success border-start border-0 border-4">
			<div class="card-body">
				<div class="d-flex align-items-center">
					<div>
						<p class="mb-0 text-secondary">Pedidos finalizados</p>
						<h4 class="my-1 text-success">
							<?php echo $data['finalizados']['total']; ?>
						</h4>
					</div>
					<div class="text-success ms-auto font-35"><i class="fas fa-check-circle"></i>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Ver cantidad de productos a la venta -->
	<div class="col">
		<div class="card radius-10 border-danger border-start border-0 border-4">
			<div class="card-body">
				<div class="d-flex align-items-center">
					<div>
						<p class="mb-0 text-secondary">Total productos</p>
						<h4 class="my-1 text-danger">
							<?php echo $data['productos']['total']; ?>
						</h4>
					</div>
					<div class="text-danger ms-auto font-35"><i class="bx bx-comment-detail"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Graficos informaticos  -->
<div class="row">

	<!-- Ver cantidad de pedidos -->
	<div class="col-12 col-lg-4">
		<div class="card radius-10">
			<div class="card-header">
				<div class="d-flex align-items-center">
					<div>
						<h6 class="mb-0">Pedidos</h6>
					</div>
				</div>
			</div>
			<div class="card-body">
				<div class="chart-container-2 mt-4">
					<canvas id="chart1"></canvas>
				</div>
			</div>
		</div>
	</div>

	<!-- Ver productos con el stock minimo -->
	<div class="col-12 col-lg-4">
		<div class="card radius-10">
			<div class="card-header">
				<div class="d-flex align-items-center">
					<div>
						<h6 class="mb-0">Productos con stock minimo</h6>
					</div>
				</div>
			</div>
			<div class="card-body">
				<div class="chart-container-2 mt-4">
					<canvas id="chart2"></canvas>
				</div>
			</div>
		</div>
	</div>

	<!-- Ver productos mas vendidos -->
	<div class="col-12 col-lg-4">
		<div class="card radius-10">
			<div class="card-header">
				<div class="d-flex align-items-center">
					<div>
						<h6 class="mb-0">Productos mas vendidos</h6>
					</div>
				</div>
			</div>
			<div class="card-body">
				<div class="chart-container-2 mt-4">
					<canvas id="chart3"></canvas>
				</div>
			</div>
		</div>
	</div>
</div>

<?php include_once 'Views/template/footer-admin.php'; ?>

<script>
	var ctx = document.getElementById("chart1").getContext('2d');

	var myChart = new Chart(ctx, {
		type: 'doughnut',
		data: {
			labels: ["Pendientes", "Proceso", "Finalizados"],
			datasets: [{
				backgroundColor: [
					'#ffd200',
					'#008cff',
					'#15ca20'
				],
				hoverBackgroundColor: [
					'#ffd200',
					'#008cff',
					'#15ca20'
				],
				data: [
					<?php echo $data['pendientes']['total']; ?>,
					<?php echo $data['procesos']['total']; ?>,
					<?php echo $data['finalizados']['total']; ?>
				],
				borderWidth: [1, 1, 1]
			}]
		},
		options: {
			maintainAspectRatio: false,
			cutoutPercentage: 75,
			legend: {
				position: 'bottom',
				display: true,
				labels: {
					boxWidth: 20
				}
			},
			tooltips: {
				displayColors: false,
			}
		}
	});
</script>

<script src="<?php echo BASE_URL; ?>assets/js/index.js"></script>
</body>

</html>