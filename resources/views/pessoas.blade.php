<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<style>
		#mainTable {
			margin-top: 20px;
			margin-left: auto;
			margin-right: auto;
		}
	</style>

    <title>Characters</title>
  </head>
  <body>
	<nav class="navbar navbar-light bg-light">
		<span class="navbar-brand mb-0 h1">Studio Ghibli characters</span>
	</nav>
	<div calss="container-flex">
		<div calss="row">
			<div class="col-md-10 offset-md-1 col-12">
				<table class="table table-striped table-responsive-sm" id="mainTable">
					<thead>
					  <tr>
						<th scope="col">#</th>
						<th scope="col">Name</th>
						<th scope="col">Age</th>
						<th scope="col">Movie name</th>
						<th scope="col">Movie year</th>
						<th scope="col">Rotten Tomato Score</th>
					  </tr>
					</thead>
						<tbody>
							@foreach ($data as $char)
								<tr>
								<th scope="row">{{$loop->index +1}}</th>
									<td>{{$char['name']}}</td>
									<td>{{$char['age']}}</td>
									<td>{{$char['movieName']}}</td>
									<td>{{$char['movieYear']}}</td>
									<td>{{$char['rtScore']}}</td>
								 </tr>
							@endforeach
						</tbody>
					</table>
			</div>
		</div>
	</div>
  </body>
</html>