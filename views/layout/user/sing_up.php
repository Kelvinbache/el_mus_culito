<?php $PATH = "./../"; require_once __DIR__ . $PATH . "headers/header_of_sing_up.php"; ?>

<main class="container">
    <header class="header">
        <a href="/el_mus_culito/public/" class="logo">El Musculito</a>
        
    </header>
    <section class="information">
        <h1 class="title-information">Build a stronger <br> <span class="text-primary">business.</span></h1>
          <section class="information-section">
          <div>
          <h3 class="sub-title">Manage 500+ clients</h3>
          <p class="description">Scale your operations without the administrative headache.</p>
        </div>
    </div>
    <div>
          <div>
          <h3 class="sub-title">Automated reporting</h3>
          <p class="description">Real-time financial insights and automated billing cycles.</p>
          </div>
        </div>
        <div>
          <h3 class="sub-title">Integrated member app</h3>
          <p class="description">A branded experience for your members to book and pay.</p>
        </div>

    </section>
</section>


<section class="form-section">
    <section class="form-header"> 
        <h2 class="form-title">Create an account</h2>
            <p class="form-description">Complete the form to register</p>
        </section>
        <form action="/el_mus_culito/public/sing_up" method="POST" class="form" id="loginForm">
            <section class="form-group">
                <label for="username" class="form-label">User name</label>
                <input type="text" id="username" name="username" class="form-input" placeholder="User name" required>
            </section>
            
            <section class="form-group">
                <label for="lastname" class="form-label">Last name</label>
                <input type="text" id="lastname" name="lastname" class="form-input" placeholder="Last name" required>
            </section>
            
            
            <section class="form-group">
                <label for="Cedula" class="form-label">ID</label>
                <input type="text" id="Cedula" name="Cedula" class="form-input" placeholder="ID" required>
            </section>
            
            <section class="form-group">
                <label for="Phone" class="form-label">Phone</label>
                <input type="text" id="Phone" name="Phone" class="form-input" placeholder="Phone" required>
            </section>


            <section class="form-group">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-input" placeholder="Email" required>
            </section>
            
            
            <section class="form-group">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password" class="form-input" placeholder="Password" required>
            </section>

            <button type="submit" class="form-button">Register</button>
        </form>
        
        <div id="alert-container" class="alert-container"></div>

        <section class="footer-section">
            <span class="form-subtitle">¿Do you already have an account? <a href="/el_mus_culito/public/login" class="form-link">Log in here</a></span>
            <section class="links-services">
                <span class="service-text">By registering, you agree to our
                    <a href="/terms" class="service-link">Terms of service</a>
                     and
                  <a href="/privacy" class="service-link">Privacy Policy</a>
              </span> 
            </section>
        </section>
    </section>
</main>

<?php require_once __DIR__ . $PATH . "footers/footer_sing.php"?>
