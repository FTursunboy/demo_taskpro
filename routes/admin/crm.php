<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['role:admin', 'redirectIfUnauthorized']], function () {

    Route::resource('lead', \App\Http\Controllers\Admin\Crm\LeadController::class);
    Route::resource('event', \App\Http\Controllers\Admin\Crm\EventController::class);
    Route::resource('contact', \App\Http\Controllers\Admin\Crm\ContactController::class);


    Route::get('contact/client/addClient', [\App\Http\Controllers\Admin\Crm\ContactController::class, 'addClient'])->name('contact.client.addClient');



    Route::get('calendar-event', [\App\Http\Controllers\Admin\Crm\CalendarController::class, 'index']);
    Route::post('calendar-crud-ajax', [\App\Http\Controllers\Admin\Crm\CalendarController::class, 'calendarEvents']);
    Route::get('/tasks/public/lead/filter-leads/{status}/{state}/{source}', [\App\Http\Controllers\Admin\Crm\LeadController::class, 'filter']);
    Route::get('/tasks/public/filter-events/{theme}/{type}', [\App\Http\Controllers\Admin\Crm\EventController::class, 'filter']);

    Route::get('calendar', [\App\Http\Controllers\Admin\Crm\CalendarController::class, 'index'])->name('calendar');
    Route::post('calendar/store', [\App\Http\Controllers\Admin\Crm\CalendarController::class, 'store'])->name('calendar.store');
    Route::post('calendar/delete/{id}', [\App\Http\Controllers\Admin\Crm\CalendarController::class, 'destroy'])->name('calendar.delete');
    Route::post('calendar/event', [\App\Http\Controllers\Admin\Crm\CalendarController::class, 'show'])->name('calendar.show');
    Route::get('calendar/event/show/{date}', [\App\Http\Controllers\Admin\Crm\CalendarController::class, 'show_all'])->name('calendar.show.all');


});
