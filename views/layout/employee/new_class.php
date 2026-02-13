<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Crear Nueva Clase | El Mus-culito</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    
    <link rel="stylesheet" href="http://localhost/el_mus_culito/public/css/new_class.css">
</head>
<body class="main-container">
    <div class="overlay"></div>

    <div class="card">
        <div class="card-header">
            <div class="brand-section">
                <div class="logo-box">
                    <span class="material-symbols-outlined icon-main">fitness_center</span>
                </div>
                <div>
                    <h1 class="brand-title">El Mus-culito</h1>
                    <p class="brand-subtitle">Gestión de Clases</p>
                </div>
            </div>
            <button class="btn-close">
                <a href="/el_mus_culito/employee">
                <span class="material-icons">close</span>
                </a>
            </button>
        </div>

        <form method="POST" action="/el_mus_culito/employee/new_class" class="card-form">
            
         <input type="hidden" name="id_employee" value="<?= $id ?? '' ?>">
            
           <div class="input-group">
                <label class="label-neon">Nombre de la clase</label>
                <input class="input-field neon-focus" name="class_name" placeholder="Ej: Crossfit, Zumba, Powerlifting" required type="text"/>
            </div>

            <div class="input-group">
                <label class="label-neon">Días de clase</label>
                <div class="days-grid">
                    <div class="day-item">
                        <input class="sr-only day-checkbox" name="days[]" value="Monday" id="mon" type="checkbox"/>
                        <label for="mon">L</label>
                    </div>
                    <div class="day-item">
                        <input class="sr-only day-checkbox" name="days[]" value="Tuesday" id="tue" value="Tuesday" type="checkbox"/>
                        <label for="tue">M</label>
                    </div>
                    <div class="day-item">
                        <input class="sr-only day-checkbox" name="days[]" value="Wednesday" id="wed" type="checkbox"/>
                        <label for="wed">X</label>
                    </div>
                    <div class="day-item">
                        <input class="sr-only day-checkbox" name="days[]" value="Thursday" id="thu" type="checkbox"/>
                        <label for="thu">J</label>
                    </div>
                    <div class="day-item">
                        <input class="sr-only day-checkbox" name="days[]" value="Friday" id="fri" type="checkbox"/>
                        <label for="fri">V</label>
                    </div>
                    <div class="day-item">
                        <input class="sr-only day-checkbox" name="days[]" value="Saturday" id="sat" type="checkbox"/>
                        <label for="sat">S</label>
                    </div>
                    <div class="day-item">
                        <input class="sr-only day-checkbox" name="days[]" value="Sunday" id="sun" type="checkbox"/>
                        <label class="sun-label" for="sun">D</label>
                    </div>
                </div>
            </div>

            <div class="input-group">
                <label class="label-neon">Hora</label>
                <div class="time-wrapper">
                    <input class="input-field neon-focus" name="hours" required type="time"/>
                    <span class="material-icons time-icon">schedule</span>
                </div>
            </div>

            <div class="actions">
                <button class="btn-primary" type="submit">Crear Clase</button>
            </div>
        </form>

        <div class="bottom-accent">
            <div class="accent-bar"></div>
        </div>
    </div>

    <div class="bg-decoration-text">GAINS</div>
    <div class="bg-decoration-icon">
        <span class="material-symbols-outlined">monitoring</span>
    </div>
</body>
</html>