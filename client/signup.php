<div class="container">
    <h1 class="heading">signUp</h1>
    <form method="post" action="./server/requests.php"> 
  <div class="col-6 offset-sm-3 margin-bottom-15" >
    <label for="username" class="form-label">user name</label>
    <input type="text"  name="username" class="form-control" id="username" placeholder="enter user name">
  </div>

  <div class="col-6 offset-sm-3 margin-bottom-15" >
    <label for="useremail" class="form-label">user email</label>
    <input type="email" name="email" class="form-control" id="useremail" placeholder="enter user email">
  </div>

  <div class="col-6 offset-sm-3 margin-bottom-15" >
    <label for="userpassword" class="form-label">user password</label>
    <input type="password" name="password" class="form-control" id="userpassword" placeholder="enter user password">
  </div>

  <div class="col-6 offset-sm-3 margin-bottom-15" >
    <label for="useraddress" class="form-label">user address</label>
    <input type="text" name="address" class="form-control" id="useraddress" placeholder="enter user address">
  </div>
<div class="col-6 offset-sm-3 margin-bottom-15">
<button type="submit" name="signup" class="btn btn-primary">Submit</button>
</div>
  
</form>
</div>