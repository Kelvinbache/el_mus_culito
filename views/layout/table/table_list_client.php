<section class="table-container">
                <div class="table-scroll">
                    <table>
                        <thead>
                            <tr>
                                <th>Name Client</th>
                                <th>Class</th>
                                <th>Day</th>
                                <th>Hours</th>
                                <th></th>
                                <th></th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                              <?php if(!empty($client)): ?>
                              <?php foreach($client as $row): ?>  
                            <tr>
                                <td>
                                    <div class="client-cell">
                                       <div class="avatar-small" style="background-image: url('https://ui-avatars.com/api/?name=<?php echo urlencode($row['user_name']); ?>&background=13ec5b&color=0d1b12');"></div>
                                        <div>
                                            <p class="name"><?php echo htmlspecialchars($row['user_name'])?> 
                                            <span> 
                                                <?php echo htmlspecialchars($row['user_lastname'])?> 
                                           </span>
                                            </p>
                                            <p class="email">
                                                <?php echo htmlspecialchars($row['user_email'])?>
                                            </p>                                      
                                    </div>
                                    </div>
                                </td>
                                 <td>
                                    <div class="client-cell">
                                        <div>
                                            <p>
                                            <span>
                                                <?php echo htmlspecialchars($row['class_name'])?>
                                            </span>
                                        </p>
                                    </div>
                                    </div>
                                </td>
                                 <td>
                                    <div class="client-cell">
                                        <div>
                                            <p>
                                            <spa>
                                               <?php echo htmlspecialchars($row['days'])?>
                                            </span>
                                            </p>
                                        </div>
                                    </div>  
                                </td> 
                                <td>
                                    <div class="client-cell">
                                        <div>
                                            <p>
                                            <spa>
                                               <?php echo htmlspecialchars($row['hours'])?>
                                            </span>
                                            </p>
                                        </div>
                                    </div>  
                                </td> 
                                <td>
                                    <div></div>
                                </td>
                                <td>
                                    <div></div>
                                </td>
                                <td>
                                <div class="action-buttons">
                                <form action="" method="POST">
                                    <input type="hidden" name="id" value="<?= $row['id_people']?>">
                                    <input type="hidden" name="role" value="<?= $row['type_user']?>">
                                    <button type="submit" class="material-symbols-outlined" style="background:none; border:none; color:red; cursor:pointer;">
                                        delete
                                    </button>
                                </form>
                                    <a href="/el_mus_culito/edict?id=<?= $row['id_people'] ?>" 
                                    style="background:none; border:none; color:white; cursor:pointer;"
                                     class="btn-action edit material-symbols-outlined" title="Edit">
                                        edit
                                    </a>
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