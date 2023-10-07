<?php $__env->startSection('title'); ?>
    Панель
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div id="page-heading">


        <?php echo $__env->make('.inc.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php if(\Session::has('errorBalance')): ?>
            <div class="alert alert-danger alert-dismissible show fade">
                <?php echo e(\Session::get('errorBalance') . '. На вашем счету ' . \Session::get('balance') . 'смн'); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <section class="section overflow-hidden">
            <div class="page-content">
                <?php echo $__env->make('admin.index_page.panel', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </section>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(asset('assets/js/filter3.js')); ?>"></script>

    <script>
        $(document).ready(function () {
            var table = $('#example').DataTable({
                "processing": true,
                "stateSave": true
            });


            var statusParam = decodeURIComponent(window.location.pathname.split('/').pop());


            $("#example thead th").each(function(i) {
                var th = $(this);
                var filterColumns = ['Проект', 'Автор', 'Тип', 'Статус', 'Сотрудник', 'КПД'];

                if (filterColumns.includes(th.text().trim())) {

                    if (th.text().trim() === 'Статус') {

                        var select = th.find('select');

                        select.val(statusParam);
                        select.trigger('change');
                    }
                }
            });



            var filters = JSON.parse(localStorage.getItem('datatableFilters'));
            if (filters) {
                for (var i = 0; i < filters.length; i++) {
                    var filter = filters[i];
                    table.column(filter.columnIndex).search(filter.value);
                }
                table.draw();
            }

            $("#example thead th").each(function (i) {
                var th = $(this);
                var filterColumns = ['Проект', 'Автор', 'Тип', 'Статус', 'Сотрудник'];

                if (filterColumns.includes(th.text().trim())) {
                    var select = $('<select></select>')
                        .appendTo(th.empty())
                        .addClass('form-control')
                        .on('change', function () {
                            var columnIndex = i;
                            var value = $(this).val();
                            table.column(columnIndex).search(value).draw();


                            var filters = [];
                            $("#example thead select").each(function () {
                                var filter = {
                                    columnIndex: $(this).closest('th').index(),
                                    value: $(this).val()
                                };
                                filters.push(filter);
                            });
                            localStorage.setItem('datatableFilters', JSON.stringify(filters));
                        });


                    $('<option value="" selected>Все</option>').appendTo(select);

                    var options = table.column(i).data().unique().sort().toArray();

                    options = options.map(function (option) {
                        var tempElement = $('<div>').html(option);
                        return tempElement.text();
                    });

                    var uniqueOptions = [];
                    options.forEach(function (option) {
                        if (!uniqueOptions.includes(option)) {
                            uniqueOptions.push(option);
                            var optionText = option === null ? 'Нет данных' : option;
                            var optionElement = $('<option></option>').attr('value', option).text(optionText);
                            select.append(optionElement);
                        }
                    });

                    var storedFilters = JSON.parse(localStorage.getItem('datatableFilters'));
                    if (storedFilters) {
                        var storedFilter = storedFilters.find(function (filter) {
                            return filter.columnIndex === i;
                        });
                        if (storedFilter) {
                            select.val(storedFilter.value);
                        }
                    }
                }
            });

            var resetButton = $('<button></button>')
                .addClass('btn btn-primary')
                .text('X')
                .on('click', function () {

                    table
                        .search('')
                        .columns()
                        .search('')
                        .draw();


                    localStorage.removeItem('datatableFilters');

                    $("#example thead select").val('');

                    $('#example_filter input').val('');
                });

            var searchWrapper = $('#example_filter');
            searchWrapper.addClass('d-flex align-items-center');
            resetButton.addClass('ml-2');
            resetButton.appendTo(searchWrapper);


        });

        $(document).ready(function () {
            $('#home-tab').click( function () {
                $('#pan-stat').text('Панель')
                $('#pan-stat1').text('Панель /')
            });
            $('#profile-tab').click( function () {
                $('#pan-stat').text('Статистика')
                $('#pan-stat1').text('Статистика /')
            });
        });

    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Khusrav\tasks\resources\views/admin/index.blade.php ENDPATH**/ ?>