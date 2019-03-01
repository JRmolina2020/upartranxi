<!DOCTYPE html>
<html lang="en">
<head>
  <title>MovieLef</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
   <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
<div class="container">
	<br><br><br>
<div class="row">
<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
<form  id="formu"" method="post">
		<div class="form-group">
			<label for="">User</label>
			<input type="text" class="form-control" id="email" name="email" placeholder="email">
		</div>

		<div class="form-group">
			<label for="">Password</label>
			<input type="text" class="form-control" id="password" name="password" placeholder="Password">
		</div>
	
		<button type="submit" class="btn btn-primary">Login</button>
	</form>	
</div>
</div>

 </div>
 <script src="../view/ajax/entry.js"></script>
 <script type="text/javascript" src="../view/public/validator.js"></script>
 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
</body>
</html>