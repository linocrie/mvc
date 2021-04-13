<div class = "container">
    <div class="col-md-6 offset-md-3 bg-light border border-secondary rounded mt-5">
        <h2 class="d-flex justify-content-center mt-2">Login</h2>
        <form class = "m-5" action = "/auth/login" method = "POST">
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" name = "email" aria-describedby="emailHelp" placeholder="Enter email">
                <p><?=$this->email_error?></p>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name = "password">
                <p><?=$this->pass_error ?></p>
            </div>
            <div class = "d-flex justify-content-center">
                <button type="submit" class="btn btn-primary mt-3">Login</button>
            </div>
        </form>
    </div>
</div>