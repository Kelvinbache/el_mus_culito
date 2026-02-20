<?php
$PATH = "./../";
require_once __DIR__ . $PATH . "headers/header_of_board.php";
require_once __DIR__ . $PATH . "headers/permissions_header.php";
require_once __DIR__ . $PATH . "nav/nav_board_user.php";

$total = null;

if(!empty($client)):
    foreach($client as $row): 
    $total = $row["total"]; 
    endforeach; 
endif;

?>

<main class="main-content container-xl">
    <section class="page-header">
                <div class="title-group">
                    <h1>Employees</h1>
                    <p>Oversee the El Mus-culito community and active memberships.</p>
                </div>
                 <button class="btn-primary">
                    <span class="material-symbols-outlined">person_add</span>
                    <a href="/el_mus_culito/employee/new_class">
                     Add New class
                    </a>                   
                </button>
            </section>

            <section class="dashboard-controls">
                <div class="stat-card">
                    <div class="stat-header">
                        <p>Total Client</p>
                        <span class="material-symbols-outlined">groups</span>
                    </div>
                    <div class="stat-body">
                        <p class="stat-number">
                            <?php echo htmlspecialchars($total)?>
                        </p>
                        <p class="stat-trend">
                            <span class="material-symbols-outlined">trending_up</span> 12%
                        </p>
                    </div>
                    <p class="stat-footer">+142 since last month</p>
                </div>

                <div class="search-filters">
                    <div class="filter-top">
                        <div class="search-bar">
                            <span class="material-symbols-outlined">search</span>
                            <input type="text" placeholder="Search by name, email or ID...">
                        </div>
                        <div class="action-btns">
                            <button class="btn-outline"><span class="material-symbols-outlined">filter_list</span> Filter</button>
                        </div>
                    </div>
                </div>
            </section>

              <?php  require_once __DIR__ . $PATH . "table/table_list_client.php"?>
             
        <div class="action-btns table-bottom-actions">
               <button class="btn-outline"><span class="material-symbols-outlined">download</span> Export</button>
        </div>
</main>                        

<?php require_once __DIR__ . $PATH . "footers/footer_of_board.php" ?>
