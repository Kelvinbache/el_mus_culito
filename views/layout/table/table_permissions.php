<form action="/el_mus_culito/permissions" method="POST">
<div class="table-card">
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>User Details</th>
                                <th>Role</th>
                                <th class="text-center">Entry Access</th>
                                <th class="text-center">Billing View</th>
                                <th class="text-center">Profile Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($user)): ?>
                            <?php foreach ($user as $row): ?>
                            <?php if ($row['type_user'] !== "admin"): ?>
                        <tr>
                             <td>
                               <div class="user-cell">
                               <div class="avatar-small" style="background-image: url('https://ui-avatars.com/api/?name=<?php echo urlencode($row['user_name']); ?>&background=13ec5b&color=0d1b12');"></div>
                               <div>
                               <p class="name"><?php echo htmlspecialchars($row['user_name']); ?></p>
                               <p class="email"><?php echo htmlspecialchars($row['user_email']); ?></p>
                              </div>
                              </div>
                             </td>
                            <td>
                            <select name="role[<?php echo $row['id_people']; ?>]" class="custom-select">
                            <option value="employee" <?php echo ($row['type_user'] === 'employee') ? 'selected' : ''; ?>>Trainer</option>
                            <option value="user" <?php echo ($row['type_user'] === 'user') ? 'selected' : ''; ?>>User</option>
                            </select>
                            </td>
                            <td class="text-center">
                                <button type="button" class="toggle-switch active"><span class="toggle-dot"></span></button>
                            </td>
                            <td class="text-center">
                                <button type="button" class="toggle-switch inactive"><span class="toggle-dot"></span></button>
                            </td>
                            <td class="text-center">
                                <button type="button" class="toggle-switch active"><span class="toggle-dot"></span></button>
                            </td>
                    
                             <?php endif; ?>
                        </tr>
                        <?php endforeach; ?>
                        <?php else: ?>
                        <tr>
                                <td colspan="6" class="text-center">No se encontraron usuarios con roles asignados.</td>
                        </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
            </div>
    </div>
   <div class="table-footer">
        <p class="results-count">Showing permissions for 3 users</p>
        <div class="action-buttons">
        <button  class="btn-secondary"><a href="/el_mus_culito/board">Discard</a></button>
        <button type="submit" class="btn-primary">Save Changes</button>
     </div>
    </div>
</form>     