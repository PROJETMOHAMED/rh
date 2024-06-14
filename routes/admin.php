<?php

use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\Admin\DepartementController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\ExcelController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SwitchController;
use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\NoteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::prefix('admin')->middleware('auth')->name("admin.")->group(function () {
    //
    Route::controller(HomeController::class)->group(function () {
        Route::get("/", "index")->name("home");
        Route::get("/DeletePermissionFromUser/{user}", "DeletePermissionFromUser")->name("DeletePermissionFromUser");
        Route::get('/remove-department/{user}/{department}', 'removeDepartment')->name('removeDepartmentFromUser');
        Route::get("/WorkTime", "WorkTime")->name("WorkTime");
        Route::put("/EditeWorkTime{week}", "EditeWorkTime")->name("EditeWorkTime");
    });
    //
    Route::resource("departement", DepartementController::class)->except("index");
    Route::get('getDepartement/{departement}', [DepartementController::class, 'getDepartement'])->name('departement.home')->middleware("DepartementCheckMiddleware");
    Route::resource("types", TypeController::class);
    Route::resource("employees", EmployeeController::class);
    Route::resource("users", UsersController::class);
    Route::resource("tasks", TaskController::class);
    Route::resource("notes", NoteController::class);

    Route::controller(SwitchController::class)->name("switch.")->group(function () {
        Route::get('SwitchEmployeeStatusMode/{employee}', "SwitchEmployeeActiveMode")->name("employee");
        Route::get('SwitchAttendanceStatus/{attendance}', 'SwitchAttendanceStatus')->name('SwitchAttendanceStatus');
        Route::get('SwitchTaskStatus/{task}', 'SwitchTaskStatus')->name('SwitchTaskStatus');
    });

    Route::controller(AttendanceController::class)->name("att.")->group(function () {
        Route::post('CreateAttendance/{employee}', "CreateAttendance")->name("CreateAttendance");
        //
        Route::get('RetardAbence', "RetardAbence")->name("RetardAbence");
        //
        Route::post('CheckAtt', 'CheckAtt')->name("store.check");
        Route::get('viewAtt', 'ViewAttendance')->name("ViewAttendance");
    });

    //
    Route::controller(ProfileController::class)->name('profile.')->group(function () {
        Route::get("profile", "profile")->name("index");
        Route::post("UpdateProfile", "UpdateProfile")->name("UpdateProfile");
        Route::post("resetPassword", "resetPassword")->name("resetPassword");
    });

    Route::controller(ExcelController::class)->name('excel.')->group(function () {
        Route::get('GetRetardAbsenceOfEmployee/{employee}', 'GetRetardAbsenceOfEmployee')->name("GetRetardAbsenceOfEmployee");
        Route::get('ExportEmployeesAttendance', 'ExportEmployeesAttendance')->name("ExportEmployeesAttendance");
        Route::get('ExportDepartement', 'ExportDepartement')->name("ExportDepartement");
        Route::get('ExportEmployees', 'ExportEmployees')->name("ExportEmployees");
        Route::get('ExportNotes', 'ExportNotes')->name("ExportNotes");
        Route::get('ExportTasks', 'ExportTasks')->name("ExportTasks");
        Route::get('GetEmployeeRaport/{employee}', 'GetEmployeeRaport')->name("GetEmployeeRaport");
    });
});
