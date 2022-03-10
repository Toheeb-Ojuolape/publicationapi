<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</head>
<body>
    
<div class="container">
<div class="row mt-5">
    <div class="col-md-6 offset-md-3">
        <div class="card mt-5">
            <div class="card-header">
                File Upload form
</div>
<div class="card-body">
    <form method="POST" action="/api/upload" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
         <label for="file">Choose File </label>
         <input type="file" class="form-control" name="file" id="file" /> 
       </div>
       <button type="submit" class="mt-2 btn btn-primary">Upload </button>
</form>
</div>
</div>
</div>
</div>
</div>




</body>
</html>