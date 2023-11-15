<?php

use App\Http\Controllers\AcademicRecordController;
use App\Http\Controllers\AdvisoryClassController;
use App\Http\Controllers\AttendanceRecordController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CityMunicipalityController;
use App\Http\Controllers\ClasslistController;
use App\Http\Controllers\CurriculumController;
use App\Http\Controllers\FacultyRecordController;
use App\Http\Controllers\FacultyScheduleController;
use App\Http\Controllers\GradeLevelController;
use App\Http\Controllers\StudentRecordController;
use App\Http\Controllers\UserAddressController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware("api")->group(function () {
    Route::prefix("/auth")->group(function () {
        Route::post("/login", [AuthController::class, "login"]);
        Route::post("/reset-password", [AuthController::class, "resetPassword"]);
        Route::get("/verify-email/{id}/{hash}", [AuthController::class, "verifyEmail"]);
    });
});

Route::middleware("auth:api")->group(function () {
    Route::prefix("/user")->group(function () {
        Route::get("/", [UserController::class, "getAll"]);
        Route::get("{user}", [UserController::class, "getUser"]);
        Route::post("store", [UserController::class, "storeUser"]);
        Route::post("{user}", [UserController::class, "updateUser"]);
        Route::post("{user}", [UserController::class, "deleteUser"]);

        Route::prefix("/address")->group(function () {
            Route::get("/", [UserAddressController::class, "getAllAddress"]);
            Route::get("{userAddress}", [UserAddressController::class, "getUserAddress"]);
            Route::post("store", [UserAddressController::class, "storeUserAddress"]);
            Route::post("{userAddress}", [UserAddressController::class, "updateUserAddress"]);
            Route::post("{userAddress}", [UserAddressController::class, "deleteUserAddress"]);
        });
    });

    Route::prefix("/faculty")->group(function () {
        Route::get("/", [FacultyRecordController::class, "getAllFaculty"]);
        Route::get("{facultyRecord}", [FacultyRecordController::class, "getFaculty"]);
        Route::post("store", [FacultyRecordController::class, "storeFaculty"]);
        Route::post("{facultyRecord}", [FacultyRecordController::class, "updateFaculty"]);
        Route::post("{facultyRecord}", [FacultyRecordController::class, "deleteFaculty"]);
    });

    Route::prefix("/student")->group(function () {
        Route::get("/", [StudentRecordController::class, "getAllStudent"]);
        Route::get("{studentRecord}", [StudentRecordController::class, "getStudent"]);
        Route::post("store", [StudentRecordController::class, "storeStudent"]);
        Route::post("{studentRecord}", [StudentRecordController::class, "updateStudent"]);
        Route::post("{studentRecord}", [StudentRecordController::class, "deleteStudent"]);

        Route::prefix("/attendance")->group(function () {
            Route::get("/{attendanceRecord}", [AttendanceRecordController::class, "showRecord"]);
        });

        Route::prefix("/grades")->group(function () {
            Route::get("/{academicRecord}", [AcademicRecordController::class, "showRecord"]);
        });
    });

    Route::prefix("/tools")->group(function () {
        Route::prefix("/grades")->group(function () {
            Route::get("/", [AcademicRecordController::class, "getAll"]);
            Route::get("{academicRecord}", [AcademicRecordController::class, "getRecord"]);
            Route::post("store", [AcademicRecordController::class, "storeRecord"]);
            Route::put("{academicRecord}", [AcademicRecordController::class, "updateRecord"]);
            Route::delete("{academicRecord}", [AcademicRecordController::class, "destroyRecord"]);
        });

        Route::prefix("/advisory")->group(function () {
            Route::get("/", [AdvisoryClassController::class, "getAllAdvisoryClass"]);
            Route::get("{advisoryClass}", [AdvisoryClassController::class, "getAdvisoryClass"]);
            Route::post("store", [AdvisoryClassController::class, "storeAdvisoryClass"]);
            Route::put("{advisoryClass}", [AdvisoryClassController::class, "updateAdvisoryClass"]);
            Route::delete("{advisoryClass}", [AdvisoryClassController::class, "deleteAdvisoryClass"]);
        });

        Route::prefix("/schedule")->group(function () {
            Route::get("/", [FacultyScheduleController::class, "getAll"]);
            Route::get("{facultySchedule}", [FacultyScheduleController::class, "getSchedule"]);
            Route::post("store", [FacultyScheduleController::class, "storeSchedule"]);
            Route::put("{facultySchedule}", [FacultyScheduleController::class, "updateSchedule"]);
            Route::delete("{facultySchedule}", [FacultyScheduleController::class, "deleteSchedule"]);
        });

        Route::prefix("/classlist")->group(function () {
            Route::get("/", [ClasslistController::class, "index"]);
            Route::get("{gradeId}", [ClasslistController::class, "show"]);
        });

        // Route::prefix("/attendance")->group(function () {
        //     Route::get("/", [AttendanceRecordController::class, "index"]);
        //     Route::get("{attendanceRecord}", [AttendanceRecordController::class, "show"]);
        //     Route::post("store", [AttendanceRecordController::class, "store"]);
        //     Route::post("{attendanceRecord}", [AttendanceRecordController::class, "update"]);
        //     Route::post("{attendanceRecord}", [AttendanceRecordController::class, "delete"]);
        // });

        // Route::prefix("/citymunicipality")->group(function () {
        //     Route::get("/", [CityMunicipalityController::class, "index"]);
        //     Route::get("{cityMunicipalities}", [CityMunicipalityController::class, "show"]);
        // });

        // Route::prefix("/curriculum")->group(function () {
        //     Route::get("/", [CurriculumController::class, "index"]);
        //     Route::get("{curriculum}", [CurriculumController::class, "show"]);
        //     Route::post("store", [CurriculumController::class, "store"]);
        //     Route::post("{curriculum}", [CurriculumController::class, "update"]);
        //     Route::post("{curriculum}", [CurriculumController::class, "delete"]);
        // });

        // Route::prefix("/gradelevel")->group(function () {
        //     Route::get("/", [GradeLevelController::class, "index"]);
        //     Route::get("{gradeLevel}", [GradeLevelController::class, "show"]);
        //     Route::post("store", [GradeLevelController::class, "store"]);
        //     Route::post("{gradeLevel}", [GradeLevelController::class, "update"]);
        //     Route::post("{gradeLevel}", [GradeLevelController::class, "delete"]);
        // });

    });
});
