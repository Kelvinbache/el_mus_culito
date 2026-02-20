<?php 

$id_edict = $_GET['id'] ?? null; 
$target = null;

    if(!empty($class) && $id_edict){
        foreach($class as $row) {      
           if ($row["id_class_schedule"] == $id_edict){
              $target = $row;
              break;
           } 
        }
    } 

    $days = [
            'Monday'    => ['id' => 'mon', 'label' => 'L'],
            'Tuesday'   => ['id' => 'tue', 'label' => 'M'],
            'Wednesday' => ['id' => 'wed', 'label' => 'X'],
            'Thursday'  => ['id' => 'thu', 'label' => 'J'],
            'Friday'    => ['id' => 'fri', 'label' => 'V'],
            'Saturday'  => ['id' => 'sat', 'label' => 'S'],
            'Sunday'    => ['id' => 'sun', 'label' => 'D']
        ];

?>


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
                    <p class="brand-subtitle">Class Management</p>
                </div>
            </div>
            <button class="btn-close">
                <a href="/el_mus_culito/employee">
                <span class="material-icons">close</span>
                </a>
            </button>
        </div>
        
        <form method="POST" action="/el_mus_culito/employee/edict" class="card-form">
         <input type="hidden" name  ="id_class" value="<?= $target["id_class_schedule"] ?? '' ?>"> 
         <input type="hidden" name  ="id_class" value="<?= $target["id_class"] ?? '' ?>">
            
           <div class="input-group">
                <label class="label-neon">class name</label>
                <input class="input-field neon-focus" name="class_name" value="<?=$target['class_name']?>" placeholder="Ej: Crossfit, Zumba, Powerlifting" required type="text"/>
            </div>

            <div class="input-group">
                <label class="label-neon">Class days</label>
                <div class="days-grid">
                <?php foreach ($days as $valor_db => $info): ?>
                <?php $is_checked = (isset($target['days']) && $target['days'] === $valor_db) ? 'checked' : '';?>
            <div class="day-item">  
                <input class="sr-only day-checkbox" 
                       name="days[]" 
                       value="<?= $valor_db ?>" 
                       id="<?= $info['id'] ?>" 
                       type="checkbox" 
                       <?= $is_checked ?> />
                <label for="<?= $info['id'] ?>"><?= $info['label'] ?></label>
            </div>
        <?php endforeach; ?>
                </div>
            </div>

            <div class="input-group">
                <label class="label-neon">Hour</label>
                <div class="time-wrapper">
                 <?php 
                    $hours= "";
                    if (!empty($target['hours'])) {
                   $hours = date("H:i", strtotime($target['hours']));
                }
        ?>
                    <input class="input-field neon-focus" name="hours" value="<?= $hours ?>" required type="time"/>
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