<h2>Add New User</h2>
<a href="/users" class="button-link secondary">Back to the list</a>
<form method="post" action="/users/add" id="add-user-form">
    <div>
        <label for="user-login">Login:</label>
        <input type="text" id="user-login" name="user_login" required>
    </div>
    <div>
        <label for="user-login">Email:</label>
        <input type="text" id="user-email" name="user_email" required>
    </div>
    <div>
        <label for="user-login">Password:</label>
        <input type="password" id="user-password" name="user_password" required>
    </div>
    <div>
        <label for="user-login">Comfirm password:</label>
        <input type="password" id="user-confirm-password" name="user_confirm_password" required>
    </div>
    <div>
        <button type="submit">Add User</button>
    </div>
</form>

<script>
document.getElementById('add-user-form').addEventListener('submit', function (e) {
    console.log('Form submit event triggered');
  const pw  = document.getElementById('user-password').value;
  const cpw = document.getElementById('user-confirm-password').value;

  if (pw !== cpw) {
    e.preventDefault();
    alert("Passwords do not match");
  }
});
</script>