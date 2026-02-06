<?php

$PATH = "./../";
require_once __DIR__ . $PATH . "headers/header_of_board.php";
require_once __DIR__ . $PATH . "headers/permissions_header.php";
require_once __DIR__ . $PATH . "nav/nav_board.php"; 

?>

<main class="main-content container-xl">
            <section class="page-header">
                <div class="title-group">
                    <h1>Management</h1>
                    <p>Oversee the El Mus-culito community and active memberships.</p>
                </div>
        </section>

            <section class="dashboard-controls">
                <div class="stat-card">
                    <div class="stat-header">
                        <p>Total Active Clients</p>
                        <span class="material-symbols-outlined">groups</span>
                    </div>
                    <div class="stat-body">
                        <p class="stat-number">1,248</p>
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
                    <div class="active-tags">
                        <button class="tag tag-active">All Clients</button>
                        <button class="tag">Membership: Premium <span class="material-symbols-outlined">close</span></button>
                        <button class="tag">Status: Active <span class="material-symbols-outlined">close</span></button>
                    </div>
                </div>
            </section>

           <?php  require_once __DIR__ . $PATH . "table/table_admin.php"?>

           <div class="action-btns table-bottom-actions">
               <button class="btn-outline"><span class="material-symbols-outlined">download</span> Export</button>
        </div>
</main>    

<?php require_once __DIR__ . $PATH . "footers/footer_of_board.php" ?>
