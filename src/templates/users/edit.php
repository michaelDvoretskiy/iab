<h2>Edit User</h2>
<a href="/roles">Back to the list</a>
<form method="post" action="/users/edit/?id=<?= $params['user']->getId() ?>" id="edit-user-form">
    <div>
        <label for="user-login">Login:</label>
        <input type="text" id="user-login" name="user_login" value="<?= $params['user']->getLogin() ?>" required>
    </div>
    <div>
        <label for="user-login">Email:</label>
        <input type="text" id="user-email" name="user_email" value="<?= $params['user']->getEmail() ?>" required>
    </div>
    <div>
        <label for="user-login">Old password:</label>
        <input type="password" id="old-password" name="old_password">
    </div>
    <div>
        <label for="user-login">Password:</label>
        <input type="password" id="user-password" name="user_password">
    </div>
    <div>
        <label for="user-login">Comfirm password:</label>
        <input type="password" id="user-confirm-password" name="user_confirm_password">
    </div>
    <div>
        <button type="submit">Save User</button>
    </div>
</form>
<script>
document.getElementById('edit-user-form').addEventListener('submit', function (e) {
    console.log('Form submit event triggered');
  const pw  = document.getElementById('user-password').value;
  const cpw = document.getElementById('user-confirm-password').value;

  if (pw !== cpw) {
    e.preventDefault();
    alert("Passwords do not match");
  }
});
</script>