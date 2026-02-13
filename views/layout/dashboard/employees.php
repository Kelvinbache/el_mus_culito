<?php $PATH = "./../";?>


<main class="main-content container-xl">
    <section class="page-header">
                <div class="title-group">
                    <h1>Employees</h1>
                    <p>Oversee the El Mus-culito community and active memberships.</p>
                </div>
                <button class="btn-primary">
                    <span class="material-symbols-outlined">person_add</span>
                    <a href="/el_mus_culito/employees/new_employee">New Employee</a>
                </button>
            </section>

            <section class="dashboard-controls">
                <div class="stat-card">
                    <div class="stat-header">
                        <p>Total Client</p>
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
                </div>
            </section>

              <?php  require_once __DIR__ . $PATH . "table/table_employees.php"?>
             
        <div class="action-btns table-bottom-actions">
               <button class="btn-outline"><span class="material-symbols-outlined">download</span><a href="/el_mus_culito/donwload/employee">Export</a></button>
        </div>
</main>                        