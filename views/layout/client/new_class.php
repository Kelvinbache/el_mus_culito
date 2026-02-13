<!DOCTYPE html>
<html class="dark" lang="es">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>El Mus-culito | Gestión de Clases</title>
    
    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="http://localhost/el_mus_culito/public/css/client_new_class.css">
    <link rel="stylesheet" href="http://localhost/el_mus_culito/public/css/new_class.css">

</head>
<body>
    <main class="main-container">
        <header class="header">
            <div class="header-content">
                <div class="logo-wrapper">
                    <div class="logo-icon">
                        <span class="material-icons">fitness_center</span>
                    </div>
                    <div class="logo-text">
                        <h1 class="title">EL MUS-<span class="title-highlight">CULITO</span></h1>
                        <p class="subtitle">Gestión Simplificada de Clases</p>
                    </div>
                </div>
            </div>
           <button class="btn-close">
                <a href="/el_mus_culito/client">
                <span class="material-icons">close</span>
                </a>
            </button>
        </header>

        <div class="table-wrapper">
            <div class="table-container">
                <table class="class-table">
                    <thead>
                        <tr>
                            <th>Nombre del Entrenador</th>
                            <th>Nombre de la Clase</th>
                            <th>Día</th>
                            <th>Hora</th>
                            <th class="text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                         <?php if (!empty($class)): ?>
                         <?php foreach ($class as $row): ?>
                        <tr class="class-row">
                            <td>
                                <div class="trainer-info">
                                    <img class="trainer-img" style="background-image: url('https://ui-avatars.com/api/?name=<?php echo htmlspecialchars(strtoupper($row['user_name'])); ?>&background=13ec5b&color=0d1b12');">
                                    <div>
                                        <p class="trainer-name"><?php echo htmlspecialchars($row['user_name'])?></p>
                                        <p class="trainer-specialty"><?php echo htmlspecialchars($row['user_lastname'])?></p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="class-name"><?php echo htmlspecialchars($row['class_name'])?></span>
                            </td>
                            <td class="class-day">
                                <?php echo htmlspecialchars($row['days'])?>
                            </td>
                            <td>
                                <div class="class-time">
                                    <span class="material-icons"><?php echo htmlspecialchars($row['class_name'])?></span>
                                    <span><?php echo htmlspecialchars($row['hours'])?></span>
                                </div>
                            </td>
                            <td class="text-right">
                                <div class="action-buttons">
                                    <button class="btn-add">
                                        <span class="material-symbols-outlined">add</span>
                                    </button>
                                </div>
                            </td>
                        </tr>               
                             </tr>
                                <?php endforeach; ?>
                                <?php else: ?>
                                <tr>
                                <td colspan="5" class="text-center">No se encontraron usuarios con roles asignados.</td>
                                </tr>
                            <?php endif; ?>
                    </tbody>
                </table>
                
            </div>
        </div>
    </main>
</body>
</html>