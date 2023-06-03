<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="container mt-6">
        <div class="row">
            <div class="-md-12">
                <button type="button" class="btn btn-success mb-4">Add new article</button>
                <div class="card">
                    <div class="card-header">
                        <div class="card-body">
                            <a href="" class="btn btn-primary">Edit</a>
                            <a href="" class="btn btn-danger">Delete</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


{{--    <div class="py-12">--}}
{{--        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">--}}
{{--            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">--}}
{{--                <div class="p-6 text-gray-900 dark:text-gray-100">--}}
{{--                    {{ __("You're logged in!") }}--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
</x-app-layout>
