<section class="table-container">
                <div class="table-scroll">
                    <table>
                        <thead>
                            <tr>
                                <th>Name Client</th>
                                <th>Class</th>
                                <th>Hours</th>
                                <th class="text-right"></th>
                            </tr>
                        </thead>
                        <tbody>
                              <?php if(!empty($user)): ?>
                              <?php foreach($user as $row): ?>  
                              <?php if ($row["type_user"] === "employee"): ?>
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
                                            <p><span>YOGA</span></p>
                                    </div>
                                    </div>
                                </td> <td>
                                    <div class="client-cell">
                                        <div>
                                            <p><spa>10AM-12PM</span></p>
                                        </div>
                                    </div>
                                </td> <td>
                                    <div class="client-cell">
                                        <div>
                                            <Button class="material-symbols-outlined">Delete</Button>
                                            <Button class="material-symbols-outlined">Edit</Button>
                                    </div>
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