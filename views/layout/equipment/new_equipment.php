<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>El Mus-culito - Gestión de Equipo</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    
    <link rel="stylesheet" href="http://localhost/el_mus_culito/public/css/styleer_from_equipment.css">
</head>
<body>

    <div class="glow-background"></div>

    <div class="card">
        <div class="card-header">
            <div class="icon-box">
                <span class="material-symbols-outlined">fitness_center</span>
            </div>
            <h1>New Team</h1>
            <p class="subtitle">El Mus-culito Inventory</p>
        </div>

        <form action="/el_mus_culito/equipment/new_equipment" method="POST" class="form-container space-y-6">
            
            <input type="hidden" name="admin_id" value="<?= $id ?? '' ?>">

            <div class="space-y-2">
                <label>Name</label>
                <input class="input-field" name="machine_name" placeholder="Ej. Mancuernas Pro" type="text" required/>
            </div>

            <div class="grid-cols">
                <div class="space-y-2">
                    <label>Cantidad</label>
                    <input class="input-field" name="count_machine" min="1" type="number" value="1"/>
                </div>
                <div class="space-y-2">
                    <label>State</label>
                    <select class="select-field" name="status">
                        <option value='operational'>operational</option>
                        <option value="not operational">not operational</option>
                    </select>
                </div>
            </div>

            <div class="actions">
                <button class="btn-submit" type="submit">
                    Save
                </button>
                <button class="btn-discard" type="button">
                    <a href="/el_mus_culito/equipment">
                    Rule out
                    </a>
                </button>
            </div>
        </form>
    </div>

    <div class="corner-icon">
        <span class="material-symbols-outlined">settings_accessibility</span>
    </div>

</body>
</html>