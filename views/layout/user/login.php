<?php include __DIR__ . '/header.php' ?>

<main>
 <h1>Login Page</h1>
 <form method="POST" action="/el_mus_culito/public/login">
    <label for="username">Username:</label> 
    <input type="text" id="username" name="username" required>
    <br><br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    <br><br>
    <input type="submit" value="Login">
</form>
</main>

<?php include __DIR__ . '/footer.php' ?>