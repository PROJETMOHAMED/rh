<?php

namespace App\Providers;

use App\Models\Departement;
use App\Models\Employee;
use App\Models\Note;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
        View::composer('admin.layouts.sidebar', function ($view) {
            $view->with('departementlist', Departement::all());
        });
        View::composer('admin.components.BlocNotesNotification', function ($view) {
            $today = Carbon::today()->toDateString();
            $view->with('data', Note::where('date', $today)->get());
        });
        View::composer('admin.components.EmployeesNearEnd', function ($view) {

            // Get today's date
            $today = Carbon::today();

            // Calculate the date exactly 5 days from today
            $fiveDaysFromNow = $today->copy()->addDays(5);

            // Query to get employees where date_fin is exactly 5 days from today
            $data = Employee::whereDate('date_fin', $fiveDaysFromNow)->get();

            // Pass the data to the view
                $view->with('data', $data);

        });
        Validator::extend('time_range', function ($attribute, $value, $parameters, $validator) {
            return strtotime($value) >= strtotime($parameters[0]) && strtotime($value) <= strtotime($parameters[1]);
        });
    }
}
