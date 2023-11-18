<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header position-relative">
            <div class="d-flex justify-content-between align-items-center">
                <div class="logo">
                    <a href="<?php echo e(route('admin.index')); ?>"><img src="<?php echo e(asset('assets/images/logo/logo 12.svg')); ?>" alt="Logo"
                                                              srcset=""></a>
                </div>
                <div class="theme-toggle d-flex gap-2  align-items-center mt-2" id="toggle-dark">
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                </div>
                <div class="sidebar-toggler ">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Меню
                    <input class="form-check-input" type="checkbox" id="fix" onchange="toggleSidebar()">
                </li>
                <li class="sidebar-item <?php echo e((request()->is('dashboard-admin') or request()->is('dashboard-admin/*'))  ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('admin.index')); ?>" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Панель</span>
                    </a>
                </li>


                <li class="sidebar-item <?php echo e((request()->is('mytasks') or request()->is('mytasks/*'))  ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('mytasks.index')); ?>" class='sidebar-link'>
                        <i class="bi bi-grid-1x2-fill"></i>
                        <span>Мои задачи</span>
                    </a>
                </li>


                <li class="sidebar-item <?php echo e((request()->is('monitoring-tasks') or request()->is('monitoring-tasks/*') or request()->is('monitoring/edit/*') or request()->is('monitoring/show-task/*'))  ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('mon.index')); ?>" class='sidebar-link'>
                        <i class="bi bi-file-earmark-medical-fill"></i>
                        <span>Мониторинг</span>
                    </a>
                </li>


                <li class="sidebar-item has-sub <?php echo e((request()->is('clients/offers') or request()->is('clients/offers/*') or request()->is('client') or request()->is('client/*') or request()->is('tasks_client') or request()->is('tasks_client/*')) ? 'active' : ''); ?>">
                    <a href="#" class="sidebar-link">
                        <i class="bi bi-file-earmark-spreadsheet-fill"></i>
                        <span>Партнеры
                            <?php if($offers_count > 0): ?>
                                <span class="offers-count">
                                    <span style="font-size: 13px; color: red"><?php echo e($offers_count); ?></span>
                                </span>
                            <?php endif; ?>
                        </span>
                        <?php if($offers_count > 0): ?>
                            <div class="notification-dot"></div>
                        <?php endif; ?>
                    </a>


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

                    <ul class="submenu <?php echo e((request()->is('clients/offers') or request()->is('clients/offers/*') or request()->is('client')or request()->is('client/*') or request()->is('tasks_client')or request()->is('tasks_client/*'))  ? 'active' : ''); ?>">
                        <li class="submenu-item <?php echo e((request()->is('clients/offers') or request()->is('clients/offers/*'))  ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('client.offers.index')); ?>">Входящие</a>
                        </li>
                        <li class="submenu-item <?php echo e((request()->is('tasks_client')or request()->is('tasks_client/*'))  ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('tasks_client.index')); ?>">Исходящие</a>
                        </li>
                        <li class="submenu-item <?php echo e((request()->is('client')or request()->is('client/*'))  ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('employee.client')); ?>">Клиенты</a>
                        </li>
                    </ul>
                </li>


                <li class="sidebar-item  has-sub <?php echo e((request()->is('lead') or request()->is('lead/*')or request()->is('contact')or request()->is('contact/*')or request()->is('event')or request()->is('event/*') or request()->is('calendar') or request()->is('calendar/*') or request()->is('setting') or request()->is('setting/*'))  ? 'active' : ''); ?>">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-file-earmark-spreadsheet-fill"></i>
                        <span>CRM</span>
                    </a>
                    <ul class="submenu <?php echo e((request()->is('lead') or request()->is('lead/*') or request()->is('contact') or request()->is('contact/*') or request()->is('event') or request()->is('event/*') or request()->is('calendar') or request()->is('calendar/*') or request()->is('setting') or request()->is('setting/*'))  ? 'active' : ''); ?>">
                        <li class="submenu-item <?php echo e(( request()->is('lead') or request()->is('lead/*')) ? 'active' : ''); ?> ">
                            <a href="<?php echo e(route('lead.index')); ?>">Лиды</a>
                        </li>
                        <li class="submenu-item <?php echo e(( request()->is('contact') or request()->is('contact/*')) ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('contact.index')); ?>">Контакты</a>
                        </li>
                        <li class="submenu-item <?php echo e(( request()->is('event') or request()->is('event/*')) ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('event.index')); ?>">События</a>
                        </li>
                        <li class="submenu-item <?php echo e(( request()->is('calendar') or request()->is('calendar/*')) ? 'active' : ''); ?> ">
                            <a href="<?php echo e(route('calendar')); ?>">Календарь</a>
                        </li>
                        <li class="submenu-item <?php echo e(( request()->is('setting') or request()->is('setting/*')) ? 'active' : ''); ?> ">
                            <a href="<?php echo e(route('setting.index')); ?>">Настройки</a>
                        </li>
                    </ul>
                </li>


                <li class="sidebar-item  has-sub <?php echo e((request()->is('settings/project') or request()->is('settings/project/*') or request()->is('settings/task')or request()->is('settings/task/*') or request()->is('settings/kpi')or request()->is('settings/kpi/*')or request()->is('settings/role')or request()->is('settings/role/*')or request()->is('settings/depart') or request()->is('settings/depart/*') or request()->is('projects') or request()->is('projects/*') or request()->is('employees') or request()->is('employees/*') or request()->is('profile') or request()->is('profile/*')  )  ? 'active' : ''); ?>">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-file-earmark-spreadsheet-fill"></i>
                        <span>Настройки</span>
                    </a>
                    <ul class="submenu <?php echo e((request()->is('settings/project') or request()->is('settings/project/*') or request()->is('settings/task') or request()->is('settings/task/*') or request()->is('settings/kpi') or request()->is('settings/kpi/*')or request()->is('settings/role') or request()->is('settings/role/*')or request()->is('settings/depart') or request()->is('settings/depart/*') or request()->is('projects') or request()->is('projects/*') or request()->is('employees') or request()->is('employees/*') or request()->is('profile') or request()->is('profile/*'))  ? 'active' : ''); ?>">



                        <li class="submenu-item <?php echo e((request()->is('settings/depart') or request()->is('settings/depart/*'))  ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('settings.depart')); ?>">Отдел</a>
                        </li>
                        <li class="submenu-item <?php echo e((request()->is('settings/task') or request()->is('settings/task/*') or request()->is('settings/kpi') or request()->is('settings/kpi/*'))  ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('settings.task')); ?>">Задачи</a>
                        </li>
                        <li class="submenu-item <?php echo e((request()->is('settings/project') or request()->is('settings/project/*'))  ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('settings.project')); ?>">Тип проекта</a>
                        </li>
                        <li class="submenu-item  <?php echo e((request()->is('employees') or request()->is('employees/*'))  ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('employee.index')); ?>">
                                Сотрудники
                            </a>
                        </li>
                        <li class="submenu-item  <?php echo e((request()->is('projects') or request()->is('projects/*'))  ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('project.index')); ?>">
                                Проекты
                            </a>
                        </li>
                        <li class="submenu-item  <?php echo e((request()->is('profile') or request()->is('profile/*'))  ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('profile.index')); ?>">
                                Профиль
                            </a>
                        </li>
                    </ul>
                </li>


            </ul>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
<?php /**PATH /home/c/cx34222/taskosonmarket/resources/views/admin/incs/navbar.blade.php ENDPATH**/ ?>