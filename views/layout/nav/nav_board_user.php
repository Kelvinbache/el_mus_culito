<header class="main-header">
            <div class="header-content container-xl">
                <div class="brand">
                    <div class="brand-icon">
                        <span class="material-symbols-outlined">fitness_center</span>
                    </div>
                    <div class="brand-text">
                        <h2>El Mus-culito</h2>
                        <span>Gym Management</span>
                    </div>
                </div>
                <div class="user-profile">
                    <div class="user-info">
                        <p class="user-role"style="text-transform: capitalize"><?php echo htmlspecialchars(strtoupper($username)); ?></p>
                        <p class="user-org" style="text-transform: capitalize"><?php echo htmlspecialchars(strtoupper($role)); ?> </p>
                    </div>
                    <div class="avatar-small" style="background-image: url('https://ui-avatars.com/api/?name=<?php echo htmlspecialchars(strtoupper($username ?? 'Invitado')); ?>&background=13ec5b&color=0d1b12');"></div>
                    <a href="/el_mus_culito/login" style="color:aliceblue">
                        <span class="material-symbols-outlined text-lg">logout</span>
                    </a>  
                </div>
        </div>
</header>
