<?php 

$PATH = "./../";
require_once __DIR__ . $PATH . "headers/header_form_employee.php"; 
// require_once __DIR__ . $PATH . "nav/nav_form_employee.php";
?>

<div class="card-wrapper">
<main class="form-content custom-scrollbar">
            <div class="closer">
                <button class="btn-secudary">
                <a href="/el_mus_culito/employees">
                <span class="material-symbols-outlined">close</span>
                </a>
                </button>
            </div>
            
            <header class="form-header">
                <h1>Registro de Empleado</h1>
                <p>Ingrese los detalles personales, contractuales y de acceso.</p>
            </header>

            <form class="employee-form" method="POST" action="/el_mus_culito/employees/new_employee">
                <div class="form-group">
                    <label>Nombre</label>
                    <div class="input-wrapper">
                        <span class="material-symbols-outlined">person</span>
                        <input type="text" id="username" name="username" class="form-input" placeholder="Nombre de usuario" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Apellido</label>
                    <div class="input-wrapper">
                        <span class="material-symbols-outlined">person</span>
                        <input type="text" id="lastname" name="lastname" class="form-input" placeholder="Apellido" required>                    
                    </div>
                </div>

                <div class="form-group">
                    <label>Cédula</label>
                    <div class="input-wrapper">
                        <span class="material-symbols-outlined">id_card</span>
                        <input type="text" id="Cedula" name="Cedula" class="form-input" placeholder="Cedula" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Teléfono</label>
                    <div class="input-wrapper">
                        <span class="material-symbols-outlined">call</span>
                        <input type="text" id="Phone" name="Phone" class="form-input" placeholder="Telefono" required>
                    </div>
                </div>

                <div class="form-group full-width">
                    <label>Correo Electrónico</label>
                    <div class="input-wrapper">
                        <span class="material-symbols-outlined">mail</span>
                        <input type="email" id="email" name="email" class="form-input" placeholder="Correo electrónico" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Contraseña</label>
                    <div class="input-wrapper">
                        <span class="material-symbols-outlined">lock</span>
                        <input type="password" id="password" name="password" class="form-input" placeholder="••••••••" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Confirmar Contraseña</label>
                    <div class="input-wrapper">
                        <span class="material-symbols-outlined">lock_reset</span>
                        <input type="password" id="password" name="password" class="form-input" placeholder="••••••••" required>
                    </div>
                </div>
                
                <div class="form-actions full-width">
                    <button type="submit" class="btn-submit">
                        <span class="material-symbols-outlined">person_add</span> 
                    </button>     
                </div>
            </form>
        </main>
    </div>

<?php require_once __DIR__ . $PATH .  "footers/footer_form_employee.php"?>