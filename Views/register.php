<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title></title>
</head>
<body>
    <div class = "container">
    <div class="col-md-6 offset-md-3 mt-5">
        <h2 class="d-flex justify-content-center mt-2">Register</h2>
        <p><?=$this->create_error?></p>
        <form class = "m-5" action = "/auth/register" method = "POST">
            <div class="form-group">
                <label for="email">Your Name</label>
                <input type="text" class="form-control" id="name" name = "name" placeholder="Enter your name">
                <p><?=$this->name_error?></p>
            </div>
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="text" class="form-control" id="email" name = "email" placeholder="Enter email">
                <p><?=$this->email_error?></p>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name = "password">
                <p><?=$this->pass_error?></p>
            </div>
            <div class = "d-flex justify-content-center">
                <button type="submit" class="btn btn-dark mt-3">Register</button>
            </div>
        </form>
    </div>
</div>
</body>


