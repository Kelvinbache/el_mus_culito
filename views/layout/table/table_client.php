 <section class="table-container">
                <div class="table-scroll">
                    <table>
                        <thead>
                            <tr>
                                <th>Client Name</th>
                                <th>Membership Type</th>
                                <th>Status</th>
                                <th>Last Payment</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($user)): ?>
                            <?php foreach ($user as $row): ?>
                            <?php if($row["type_user"] === "user"):?>
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
                                    <div>
                                        <p>normal</p>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <p>activo</p>
                                    </div>
                                </td>
                                 <td>
                                    <div>
                                        <p>12/2/2026</p>
                                        <div></div>
                                    </div>
                                </td>
                                 <td>
                                    <div>
                                        <Button class="material-symbols-outlined">Delete</Button>
                                        <Button class="material-symbols-outlined">Edit</Button>
                                    </div>
                                </td>
                                <?php endif; ?>
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