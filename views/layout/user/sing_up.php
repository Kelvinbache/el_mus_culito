<main class="container">
    <header class="header">
        <a href="/el_mus_culito/public/home" class="logo">El Musculito</a>

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
            <h2 class="form-title">Crear una cuenta</h2>
            <p class="form-description">Completa el formulario para registrarte</p>
        </section>
        <form action="/el_mus_culito/public/sing_up" method="POST" class="form">
            <section class="form-group">
                <label for="username" class="form-label">Nombre de usuario</label>
                <input type="text" id="username" name="username" class="form-input" placeholder="Nombre de usuario" required>
            </section>
            
            <section class="form-group">
                <label for="lastname" class="form-label">Apellido</label>
                <input type="text" id="lastname" name="lastname" class="form-input" placeholder="Apellido" required>
            </section>
            
            
            <section class="form-group">
                <label for="Cedula" class="form-label">Cédula</label>
                <input type="text" id="Cedula" name="Cedula" class="form-input" placeholder="Cedula" required>
            </section>
            
            <section class="form-group">
                <label for="Phone" class="form-label">Teléfono</label>
                <input type="text" id="Phone" name="Phone" class="form-input" placeholder="Telefono" required>
            </section>


            <section class="form-group">
                <label for="email" class="form-label">Correo electrónico</label>
                <input type="email" id="email" name="email" class="form-input" placeholder="Correo electrónico" required>
            </section>


            <section class="form-group">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" id="password" name="password" class="form-input" placeholder="Contraseña" required>
            </section>

            <button type="submit" class="form-button">Registrarse</button>
        </form>
        <section class="footer-section">
            <span class="form-subtitle">¿Ya tienes una cuenta? <a href="/el_mus_culito/public/login" class="form-link">Inicia sesión aquí</a></span>
            <section class="links-services">
              <span class="service-text">Al registrarte, aceptas nuestros 
                  <a href="/terms" class="service-link">Términos de servicio</a>
                     y
                  <a href="/privacy" class="service-link">Política de privacidad</a>
              </span> 
            </section>
        </section>
    </section>
</main>