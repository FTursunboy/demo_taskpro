
<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header position-relative">
            <div class="d-flex justify-content-between align-items-center">
                <div class="logo">
                    <a href="#"><img src="<?php echo e(asset('assets/images/logo/logo 12.svg')); ?>" alt="Logo" srcset=""></a>
                </div>
                <div class="theme-toggle d-flex gap-2  align-items-center mt-2" id="toggle-dark">

























                </div>
                <div class="sidebar-toggler  x">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Меню
                    <input class="form-check-input" type="checkbox" id="fix" onchange="toggleSidebar()">
                </li>

                <li
                    class="sidebar-item <?php echo e((request()->is('dashboard-client') or request()->is('dashboard-client/*'))  ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('client.index')); ?>" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Панель</span>
                    </a>
                </li>

                <li class="sidebar-item <?php echo e((request()->is('offers') or request()->is('offers/*'))  ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('offers.index')); ?>" class='sidebar-link'>
                        <i class="bi bi-journal-minus"></i>
                        <span>Задачи</span>
                    </a>
                </li>
                <?php if(\Spatie\Permission\PermissionServiceProvider::bladeMethodWrapper('hasRole', 'client')): ?>
                <li class="sidebar-item <?php echo e((request()->is('client/task') or request()->is('client/task/*')) ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('client.tasks.index')); ?>" class="sidebar-link">
                        <i class="bi bi-journal-text"></i>
                        <span>Входяшие
                            <?php if($client_tasks > 0): ?>
                                <span class="offers-count">
                                    <span style="font-size: 13px; color: red"><?php echo e($client_tasks); ?></span>
                                </span>
                            <?php endif; ?>
                        </span>
                        <?php if($client_tasks > 0): ?>
                            <div class="notification-dot"></div>
                        <?php endif; ?>
                    </a>
                </li>
                <style>
                    .sidebar-link {
                        position: relative;
                    }

                    .notification-dot {
                        position: absolute;
                        top: 50%;
                        right: -10px;
                        transform: translate(50%, -50%);
                        width: 10px;
                        height: 10px;
                        background-color: red;
                        border-radius: 50%;
                        animation: blink-animation 1s infinite;
                    }

                    @keyframes blink-animation {
                        0% {
                            opacity: 1;
                        }
                        50% {
                            opacity: 0;
                        }
                        100% {
                            opacity: 1;
                        }
                    }

                    .offers-count {
                        margin-left: 5px;
                    }
                </style>
                <?php endif; ?>
                <?php if(\Spatie\Permission\PermissionServiceProvider::bladeMethodWrapper('hasRole', 'client')): ?>
                <li class="sidebar-item <?php echo e((request()->is('client/worker') or request()->is('client/worker/*')) ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('client.workers.index')); ?>" class="sidebar-link">
                        <i class="bi bi-people"></i>
                        <span>Сотрудники</span>
                    </a>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Предупреждение</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Точно хотите выйти?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                <a href="<?php echo e(route('logout')); ?>" class="btn btn-danger">Да</a>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var fixCheckbox = document.getElementById("fix");
        var isSidebarFixed = localStorage.getItem("sidebarFixed");

        if (isSidebarFixed === "true") {
            fixCheckbox.checked = true;
            toggleSidebar();
        }
    });

    function toggleSidebar() {
        var sidebar = document.getElementById("sidebar");
        var fixCheckbox = document.getElementById("fix");

        if (fixCheckbox.checked) {
            sidebar.classList.remove("active");

            localStorage.setItem("sidebarFixed", "true");
        } else {
            sidebar.classList.add("active");
            localStorage.setItem("sidebarFixed", "false");
        }
    }
</script>
<?php /**PATH /home/c/cx34222/task_manager/public_html/tasks/resources/views/client/incs/navbar.blade.php ENDPATH**/ ?>