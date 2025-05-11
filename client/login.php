<div class="container ">
    <h1 class="heading">Login</h1>
<form action="./server/requests.php" method="post">

  
  <div class="col-6 offset-sm-3 margin-bottom-15" >
    <label for="useremail" class="form-label">user email</label>
    <input type="email" name="email" class="form-control" id="useremail" placeholder="enter user email">
  </div>

  <div class="col-6 offset-sm-3 margin-bottom-15" >
    <label for="userpassword" class="form-label">user password</label>
    <input type="password" name="password" class="form-control" id="userpassword" placeholder="enter user password">
  </div>
<div class="col-6 offset-sm-3 margin-bottom-15">
<button type="submit" name="login" class="btn btn-primary">Login</button>
</div>
  
</form>
</div>
