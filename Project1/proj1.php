<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <title>Form Project</title>
  </head>
  <body>
    <div class="container">
  <form class="row g-3">
  <div class="col-md-6">
    <label for="fname" class="form-label">First Name</label>
    <input type="text" class="form-control" id="fname" name="fname">
  </div>
  <div class="col-md-6">
    <label for="lname" class="form-label">Last Name</label>
    <input type="text" class="form-control" id="lname" name="lname">
  </div>
  <div class="col-12">
    <label for="address" class="form-label">Address</label>
    <input type="text" class="form-control" id="address" name="address">
  </div>
  <div class="col-md-6">
    <label for="city" class="form-label">City</label>
    <input type="text" class="form-control" id="city" name="city">
  </div>
  <div class="col-md-4">
    <label for="state" class="form-label">State</label>
    <select id="state" class="form-select" name="state">
      <option value="hawaii">Hawaii</option>
      <option value="idaho">Idaho</option>
      <option value="michigan" selected>Michigan</option>
      <option value="oregon">Oregon</option>
      <option value="wyoming">Wyoming</option>
    </select>
  </div>
  <div class="col-md-2">
    <label for="zip" class="form-label">Zip</label>
    <input type="text" class="form-control" id="zip" name="zip">
  </div>
  <div class="col-13">
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" id="male" name="sex" value="male">
      <label class="form-check-label" for="male">Male</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" id="female" name="sex" value="female">
      <label class="form-check-label" for="female">Female</label>
    </div>
  </div>
  <div class="col-12">
    <button type="submit" class="btn btn-primary">Register</button>
  </div>
</form>
</div>
  </body>
</html>