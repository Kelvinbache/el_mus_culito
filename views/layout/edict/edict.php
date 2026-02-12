<?php 

$PATH = "./../";
require_once __DIR__ . $PATH . "headers/header_form_employee.php";
$id_edict = $_GET['id'] ?? null; 

$target_user = null;
if (!empty($user) && $id_edict) {
    foreach ($user as $row) {
        if ($row['id_people'] == $id_edict) {
            $target_user = $row;
            break;
        }
    }
}

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
               
                <?php if($target_user): ?>  
                <form method="POST" action="/el_mus_culito/edict" class="employee-form">
                
                <input type="hidden" name="id" value="<?= $target_user['id_people'] ?>">
                <input type="hidden" name="role" value="<?= $target_user['type_user'] ?>">


                <div class="form-group">
                    <label>Nombre</label>
                    <div class="input-wrapper">
                        <span class="material-symbols-outlined">person</span>
                        <input type="text" id="username" name="username" value="<?= $target_user['user_name']?>" class="form-input" placeholder="Nombre de usuario" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Apellido</label>
                    <div class="input-wrapper">
                        <span class="material-symbols-outlined">person</span>
                        <input type="text" id="lastname" name="lastname" value="<?= $target_user['user_lastname']?>" class="form-input" placeholder="Apellido" required>                    
                    </div>
                </div>

                <div class="form-group">
                    <label>Cédula</label>
                    <div class="input-wrapper">
                        <span class="material-symbols-outlined">id_card</span>
                        <input type="text" id="Cedula" name="dni" value="<?= $target_user['user_dni']?>" class="form-input" placeholder="Cedula" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Teléfono</label>
                    <div class="input-wrapper">
                        <span class="material-symbols-outlined">call</span>
                        <input type="text" id="Phone" name="phone" value="<?= $target_user['user_phone']?>" class="form-input" placeholder="Telefono" required>
                    </div>
                </div>

                <div class="form-group full-width">
                    <label>Correo Electrónico</label>
                    <div class="input-wrapper">
                        <span class="material-symbols-outlined">mail</span>
                        <input type="email" id="email" name="email" class="form-input" value="<?= $target_user['user_email']?>" placeholder="Correo electrónico" required>
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
            <?php else: ?>
            <p colspan="5" class="text-center">The user could not be found</p>
            <?php endif; ?>
        </main>
    </div>

<?php require_once __DIR__ . $PATH .  "footers/footer_form_employee.php"?>