<main class="main-content container-xl">
            <section class="page-header">
                <div class="title-group">
                    <h1>Board Management</h1>
                    <p>Oversee the El Mus-culito community and active memberships.</p>
                </div>
                <button class="btn-primary">
                    <span class="material-symbols-outlined">person_add</span>
                    Add New Class
                </button>
            </section>

            <section class="dashboard-controls">
                <div class="stat-card">
                    <div class="stat-header">
                        <p>Total Number Of Active Class</p>
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

            <section class="table-container">
                <div class="table-scroll">
                    <table>
                        <thead>
                            <tr>
                                <th>Coach</th>
                                <th>Class</th>
                                <th>Hours</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($user)): ?>
                            <?php foreach ($user as $row): ?>
                            <tr>
                                <td>
                                    <div class="client-cell">
                                        <div class="avatar-small" style="background-image: url('https://ui-avatars.com/api/?name=<?php echo urlencode($row['user_name']); ?>&background=13ec5b&color=0d1b12');"></div>
                                        <div>
                                            <p class="name"><?php echo htmlspecialchars($row['user_name'])?></p>
                                            <p class="email"><?php echo htmlspecialchars($row['user_email'])?></p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="client-cell">
                                        <div>
                                            <p>YOGA</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="client-cell">
                                        <div>
                                             <p><spam>10AM-12PM</spam></p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="client-cell">
                                        <div>
                                            <Button class="material-symbols-outlined">Delete</Button>
                                            <Button class="material-symbols-outlined">Edit</Button>
                                        </div>
                                    </div>
                                </td>
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
            </section>  
          <div class="action-btns table-bottom-actions">
               <button class="btn-outline"><span class="material-symbols-outlined">download</span> Export</button>
        </div>
</main>    