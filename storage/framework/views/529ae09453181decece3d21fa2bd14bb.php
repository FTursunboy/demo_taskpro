<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header position-relative">
            <div class="d-flex justify-content-between align-items-center">
                <div class="logo">
                    <a href="<?php echo e(route('user.index')); ?>"><img src="<?php echo e(asset('assets/images/logo/logo 12.svg')); ?>" alt="Logo"
                                                              srcset=""></a>

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
                    <input class="form-check-input" type="checkbox" id="fix" onchange="toggleSidebar()"></li>

                <li
                    class="sidebar-item <?php echo e((request()->is('dashboard-user') or request()->is('task-list/*'))  ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('user.index')); ?>" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Панель</span>
                    </a>
                </li>

                <li class="sidebar-item <?php echo e((request()->is('my-all-tasks') or request()->is('my-all-tasks/*'))  ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('all-tasks.index')); ?>" class='sidebar-link'>
                        <i class="bi bi-bookmark"></i>
                        <span>Все задачи</span>
                    </a>
                </li>

                <li class="sidebar-item <?php echo e((request()->is('my-plan') or request()->is('my-plan/*'))  ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('plan.index')); ?>" class='sidebar-link'>
                        <i class="bi bi-bookmark-check"></i>
                        <span>Мои планы</span>
                    </a>
                </li>
                <li class="sidebar-item <?php echo e((request()->is('user/clients') or request()->is('user/clients/*'))  ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('user.clients')); ?>" class='sidebar-link'>
                        <i class="bi bi-person-circle"></i>
                        <span>Клиенты</span>
                    </a>
                </li>

                <?php if(\Spatie\Permission\PermissionServiceProvider::bladeMethodWrapper('hasRole', 'team-lead')): ?>
                <li class="sidebar-item <?php echo e((request()->is('my-command') or request()->is('my-command/*'))  ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('my-command.index')); ?>" class='sidebar-link'>
                        <i class="bi bi-people"></i>
                        <span>Моя команда</span>
                    </a>
                </li>
                <?php endif; ?>

                <?php if(\Illuminate\Support\Facades\Auth::user()->getRoleNames()->contains('crm')): ?>
                <li class="sidebar-item  has-sub <?php echo e((request()->is('lead') or request()->is('lead/*')or request()->is('contact')or request()->is('contact/*')or request()->is('event')or request()->is('event/*') or request()->is('calendar') or request()->is('calendar/*') or request()->is('setting') or request()->is('setting/*'))  ? 'active' : ''); ?>">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-file-earmark-spreadsheet-fill"></i>
                        <span>CRM</span>
                    </a>
                    <ul class="submenu <?php echo e((request()->is('lead') or request()->is('lead/*') or request()->is('contact') or request()->is('contact/*') or request()->is('event') or request()->is('event/*') or request()->is('calendar') or request()->is('calendar/*') or request()->is('setting') or request()->is('setting/*'))  ? 'active' : ''); ?>">
                        <li class="submenu-item <?php echo e(( request()->is('lead') or request()->is('lead/*')) ? 'active' : ''); ?> " >
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
<?php /**PATH /home/c/cx34222/task_manager/public_html/tasks/resources/views/user/incs/navbar.blade.php ENDPATH**/ ?>