<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Products</title>

	<!-- Fonts -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
	<link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

	<!-- Styles -->
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
	{{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

	<style>
		body {
			font-family: 'Lato';
		}
		.fa-btn {
			margin-right: 6px;
		}
	</style>
</head>
<body id="app-layout">
<nav class="navbar navbar-default">
	<div class="container">
		<div class="navbar-header">

			<!-- Branding Image -->
			<a class="navbar-brand" href="{{ url('products/') }}">
				Product List
			</a>
		</div>

	</div>
</nav>

<div class="container">
	<div class="col-sm-offset-2 col-sm-8">
		<div class="panel panel-default">
			<div class="panel-heading">
				New
			</div>

			<div class="panel-body">
				<!-- Display Validation Errors -->
				@if (count($errors) > 0)
						<!-- Form Error List -->
				<div class="alert alert-danger">
					<strong>Whoops! Something went wrong!</strong>

					<br><br>

					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
				@endif


				<!-- New Product Form -->
				<form action="{{ url('/product') }}" method="POST" class="form-horizontal">
					{{ csrf_field() }}

							<!-- Product Name -->
					<div class="form-group">
						<label for="product-name" class="col-sm-3 control-label">Product</label>

						<div class="col-sm-6">
							<input type="text" name="name" id="product-name" class="form-control" value = {{old('name')}}>
						</div>
					</div>

					<!-- Product Art -->
					<div class="form-group">
						<label for="product-art" class="col-sm-3 control-label">Art</label>

						<div class="col-sm-6">
							<input type="text" name="art" id="art-name" class="form-control"  {{old('art')}}>
						</div>
					</div>

					<!-- Add Product Button -->
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-6">
							<button type="submit" class="btn btn-default">
								<i class="fa fa-btn fa-plus"></i>Add Product
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>

		<!-- Current Products -->
		@if (count($products) > 0)
			<div class="panel panel-default">
				<div class="panel-heading">
					Products
				</div>

				<div class="panel-body">
					<table class="table table-striped product-table">
						<thead>
						<th>Product</th>
						<th>&nbsp;</th>
						</thead>
						<tbody>
						@foreach ($products as $product)
							<tr>
								<td class="product-text"><div>{{ $product->name }}</div></td>
								<td class="product-text"><div>{{ $product->art }}</div></td>
								<!-- Product Update Button -->
								<td>
									<form action="{{ url('product/'.$product->id) }}" method="GET">
										{{ csrf_field() }}

										<button type="submit" class="btn btn-warning">
											<i class="fa fa-btn fa-trash"></i>Update
										</button>
									</form>
								</td>
								<!-- Product Delete Button -->
								<td>
									<form action="{{ url('product/'.$product->id) }}" method="POST">
										{{ csrf_field() }}
										{{ method_field('DELETE') }}

										<button type="submit" class="btn btn-danger">
											<i class="fa fa-btn fa-trash"></i>Delete
										</button>
									</form>
								</td>
							</tr>
						@endforeach
						</tbody>
					</table>
				</div>
			</div>
		@endif
	</div>
</div>

		<!-- JavaScripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
{{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
