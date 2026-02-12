<main class="main-content container-xl">
            <section class="page-header">
                <div class="title-group">
                    <h1>Equipment</h1>
                    <p>Oversee the El Mus-culito community and active memberships.</p>
                </div>
                <button class="btn-primary">
                    <span class="material-symbols-outlined">fitness_center</span>
                    <a href="/el_mus_culito/equipment/new_equipment">
                   New Equipment
                    </a>
                </button>
            </section>

            <section class="dashboard-controls">
                <div class="stat-card">
                    <div class="stat-header">
                        <p>Total Active Equipment</p>
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
                        <button class="tag tag-active">All Equipment</button>
                        <button class="tag">Name Equipment<span class="material-symbols-outlined">close</span></button>
                        <button class="tag">Status: Active <span class="material-symbols-outlined">close</span></button>
                    </div>
                </div>
            </section>

            <section class="table-container">
                <div class="table-scroll">
                    <table>
                        <thead>
                            <tr>
                                <th>Name Equipment</th>
                                <th>Status</th>
                                <th>Count</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($machine)): ?>
                            <?php foreach ($machine as $row): ?>
                            <tr>
                                <td>
                                    <div class="client-cell">
                                        <div class="client-avatar" style="background-image: url('https://equiposdelfisio.com/wp-content/uploads/2023/05/multifuerza-fondo-blanco-.jpg');"></div>
                                        <div>
                                            <p class="name"><?php echo htmlspecialchars($row['machine_name'])?></p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="client-cell">
                                        <div>
                                            <p class="name"><?php echo htmlspecialchars($row['machine_status'])?></p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="client-cell">
                                        <div>
                                            <p class="name"><?php echo htmlspecialchars($row['count_machine'])?></p>
                                        </div>
                                    </div>
                                </td>
                                 <td class="text-right">
                                <div class="action-buttons">
                                <form action="" method="POST">
                                    <input type="hidden" name="id" value="<?= $row['id_machine']?>">
                                    <input type="hidden" name="role" value="<?= $role?>">
                                    <button type="submit" class="material-symbols-outlined" style="background:none; border:none; color:red; cursor:pointer;">
                                        delete
                                    </button>
                                </form>
                                    <a href="/el_mus_culito/edict?id=<?= $row['id_machine'] ?>" 
                                    style="background:none; border:none; color:white; cursor:pointer;"
                                     class="btn-action edit material-symbols-outlined" title="Edit">
                                        edit
                                    </a>
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
            </section>
            
               <div class="action-btns table-bottom-actions">
               <button class="btn-outline"><span class="material-symbols-outlined">download</span> Export</button>
            </div>

</main>                        