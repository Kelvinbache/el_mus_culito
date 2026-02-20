<?php 
$PATH = "./../"; 
require_once __DIR__ . $PATH . "headers/header_of_login.php"; 
?>


<main class="container-login">
 <section class="logo-section">
 <h1>EL <a href="/el_mus_culito/" style="text-decoration: none;"><span class="mus-culito">MUS-CULITO</span></a></h1>
 <p>Elite Gym Management Platform</p>
 </section>   
 <section class="login-cart">
   <section class="title">
   <h2 class="">Welcome Back</h2>
   <p class="">Access your fitness dashboard</p>
   </section>
    <form method="POST" action="/el_mus_culito/public/login" class="login-form" id="loginForm">
    <label for="username">Username</label> 
    <input type="text" id="username" name="username" placeholder="username" required>
    <label for="password">Password</label>
    <input type="password" id="password" name="password" placeholder="password" required>
    <button type="submit">Login</button>
    <button class="btn-secondary"><a href="/el_mus_culito/public/sing_up">Sing Up</a></button>
    </form>
 </section>
 <div id="alert-container" class="alert-container"></div>
 <section class="footer-links-section">
    <section class="footer-links">
    <a class="link" href="#">Terms of Service</a>
    <a class="link" href="#">Privacy Policy</a>
    <a class="link" href="#">Support</a>
    </section>
    <span class="copy">© 2024 El Mus-culito. Built for Champions.</span>
 </section>
</main>

<?php require_once __DIR__ . $PATH . "footers/footer_form_employee.php"?>

