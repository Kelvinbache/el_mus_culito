<?php 
$PATH = "./../";
require_once __DIR__ . $PATH . "headers/permissions_header.php"
?>

<main class="container">
            <div class="page-title-section">
                <div class="title-content">
                    <h1>Permissions & Access</h1>
                    <p>Manage user roles and system access levels for El Mus-culito staff and members.</p>
                </div>
                <div class="search-box">
                    <span class="material-symbols-outlined">search</span>
                    <input type="text" placeholder="Search users by name or email..."/>
                </div>
            </div>
               <?php  require_once __DIR__ . $PATH . "table/table_permissions.php"?>             
        </main>

<?php require_once __DIR__ . $PATH . "footers/permissions_footer.php"?>        