<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['role:crm|admin', 'redirectIfUnauthorized']], function () {

    Route::resource('lead', \App\Http\Controllers\Admin\Crm\LeadController::class);
    Route::resource('event', \App\Http\Controllers\Admin\Crm\EventController::class);
    Route::resource('contact', \App\Http\Controllers\Admin\Crm\ContactController::class);

    Route::get('lead/{lead}/contact', [\App\Http\Controllers\Admin\Crm\LeadController::class, 'contact']);
    Route::get('lead/{lead}/events', [\App\Http\Controllers\Admin\Crm\LeadController::class, 'events'])->name('lead.events');
    Route::get('lead/{lead}/events/create', [\App\Http\Controllers\Admin\Crm\LeadController::class, 'createEvent'])->name('lead.event.create');

    Route::get('contact/client/addClient', [\App\Http\Controllers\Admin\Crm\ContactController::class, 'addClient'])->name('contact.client.addClient');

    Route::get('contact/create/{leades}', [\App\Http\Controllers\Admin\Crm\ContactController::class, 'createLead'])->name('contact.lead.create');

    Route::get('calendar-event', [\App\Http\Controllers\Admin\Crm\CalendarController::class, 'index']);
    Route::post('calendar-crud-ajax', [\App\Http\Controllers\Admin\Crm\CalendarController::class, 'calendarEvents']);
    Route::get('/tasks/public/filter-leads/{status}/{state}/{source}', [\App\Http\Controllers\Admin\Crm\LeadController::class, 'filter']);
    Route::get('/tasks/public/filter-events/{theme}/{type}/{statuses}', [\App\Http\Controllers\Admin\Crm\EventController::class, 'filter']);

    Route::get('calendar', [\App\Http\Controllers\Admin\Crm\CalendarController::class, 'index'])->name('calendar');
    Route::post('calendar/store', [\App\Http\Controllers\Admin\Crm\CalendarController::class, 'store'])->name('calendar.store');
    Route::post('calendar/delete/{id}', [\App\Http\Controllers\Admin\Crm\CalendarController::class, 'destroy'])->name('calendar.delete');
    Route::post('calendar/event', [\App\Http\Controllers\Admin\Crm\CalendarController::class, 'show'])->name('calendar.show');
    Route::get('calendar/event/show/{date}', [\App\Http\Controllers\Admin\Crm\CalendarController::class, 'show_all'])->name('calendar.show.all');


    Route::get('setting', [\App\Http\Controllers\Admin\Crm\SettingController::class, 'index'])->name('setting.index');

    Route::get('setting/lead-source', [\App\Http\Controllers\Admin\Crm\LeadSourceController::class, 'index'])->name('setting.lead-source.index');
    Route::post('setting/lead-source', [\App\Http\Controllers\Admin\Crm\LeadSourceController::class, 'store'])->name('setting.lead-source.store');
    Route::patch('setting/lead-source/{leadSource}', [\App\Http\Controllers\Admin\Crm\LeadSourceController::class, 'update'])->name('setting.lead-source.update');
    Route::delete('setting/lead-source/{leadSource}', [\App\Http\Controllers\Admin\Crm\LeadSourceController::class, 'destroy'])->name('setting.lead-source.destroy');

    Route::get('setting/lead-state', [\App\Http\Controllers\Admin\Crm\LeadStateController::class, 'index'])->name('setting.lead-state.index');
    Route::post('setting/lead-state', [\App\Http\Controllers\Admin\Crm\LeadStateController::class, 'store'])->name('setting.lead-state.store');
    Route::patch('setting/lead-state/{leadState}', [\App\Http\Controllers\Admin\Crm\LeadStateController::class, 'update'])->name('setting.lead-state.update');
    Route::delete('setting/lead-state/{leadState}', [\App\Http\Controllers\Admin\Crm\LeadStateController::class, 'destroy'])->name('setting.lead-state.destroy');

    Route::get('setting/lead-status', [\App\Http\Controllers\Admin\Crm\LeadStatusController::class, 'index'])->name('setting.lead-status.index');
    Route::post('setting/lead-status', [\App\Http\Controllers\Admin\Crm\LeadStatusController::class, 'store'])->name('setting.lead-status.store');
    Route::patch('setting/lead-status/{leadStatus}', [\App\Http\Controllers\Admin\Crm\LeadStatusController::class, 'update'])->name('setting.lead-status.update');
    Route::delete('setting/lead-status/{leadStatus}', [\App\Http\Controllers\Admin\Crm\LeadStatusController::class, 'destroy'])->name('setting.lead-status.destroy');

    Route::get('setting/theme-event', [\App\Http\Controllers\Admin\Crm\ThemeEventController::class, 'index'])->name('setting.theme-event.index');
    Route::post('setting/theme-event', [\App\Http\Controllers\Admin\Crm\ThemeEventController::class, 'store'])->name('setting.theme-event.store');
    Route::patch('setting/theme-event/{themeEvent}', [\App\Http\Controllers\Admin\Crm\ThemeEventController::class, 'update'])->name('setting.theme-event.update');
    Route::delete('setting/theme-event/{themeEvent}', [\App\Http\Controllers\Admin\Crm\ThemeEventController::class, 'destroy'])->name('setting.theme-event.destroy');

    Route::get('setting/type-event', [\App\Http\Controllers\Admin\Crm\TypeEventController::class, 'index'])->name('setting.type-event.index');
    Route::post('setting/type-event', [\App\Http\Controllers\Admin\Crm\TypeEventController::class, 'store'])->name('setting.type-event.store');
    Route::patch('setting/type-event/{typeEvent}', [\App\Http\Controllers\Admin\Crm\TypeEventController::class, 'update'])->name('setting.type-event.update');
    Route::delete('setting/type-event/{typeEvent}', [\App\Http\Controllers\Admin\Crm\TypeEventController::class, 'destroy'])->name('setting.type-event.destroy');

    Route::get('setting/event-status', [\App\Http\Controllers\Admin\Crm\EventStatusController::class, 'index'])->name('setting.event-status.index');
    Route::post('setting/event-status', [\App\Http\Controllers\Admin\Crm\EventStatusController::class, 'store'])->name('setting.event-status.store');
    Route::patch('setting/event-status/{eventStatus}', [\App\Http\Controllers\Admin\Crm\EventStatusController::class, 'update'])->name('setting.event-status.update');
    Route::delete('setting/event-status/{eventStatus}', [\App\Http\Controllers\Admin\Crm\EventStatusController::class, 'destroy'])->name('setting.event-status.destroy');

});
