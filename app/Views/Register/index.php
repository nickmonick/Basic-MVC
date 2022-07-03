<form method="post" action="/register">

    <label for="username">Enter Your Username:</label><br>
    <input type="text" name="username"><br>
    <p><?= $usernameError ?? "" ?></p><br>
    <label for="username">Enter Your Password:</label><br>
    <input type="password" name="password"><br>
    <p><?= $passwordError ?? "" ?></p><br>
    <button type="submit">Submit</button>

</form>