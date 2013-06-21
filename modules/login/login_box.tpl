      <div id="error"><?php echo $error; ?></div>
      <div class="header-500" id="login-header">Username/Password</div>
      <div class="body-500" id="login">
         <br>
         <form action="index.php?page=login" method="POST">
         <label for="username">Username:</label>
         <input type="text" name="username"><br><br>
         <label for="password">Password:</label>
         <input type="password" name="password"><br><br>
         <input type="submit" value="Login" class="login-button">&nbsp;<input type="reset" value="Reset" class="login-button">
         </form>
      </div>
   </div>
   <div class="two-col-right">
   <hr class="sidebar-ruler">
   <center><font size="+1">Login</font></center>To login, please type your username and password in the fields on the left and press <i>Login</i>.  If you have forgotten your password, please click the <i>Forgot Password</i> link to have a new password emailed to you.
   <hr class="sidebar-ruler">
   </div>
</div>