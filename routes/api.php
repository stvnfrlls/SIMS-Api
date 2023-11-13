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
use App\Http\Controllers\GradeSectionController;
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
        Route::prefix("/advisory")->group(function () {
            Route::get("/", [AdvisoryClassController::class, "getAllAdvisoryClass"]);
            Route::get("{advisoryClass}", [AdvisoryClassController::class, "getAdvisoryClass"]);
            Route::post("store", [AdvisoryClassController::class, "storeAdvisoryClass"]);
            Route::post("{advisoryClass}", [AdvisoryClassController::class, "updateAdvisoryClass"]);
            Route::post("{advisoryClass}", [AdvisoryClassController::class, "deleteAdvisoryClass"]);
        });

        Route::prefix("/attendance")->group(function () {
            Route::get("/", [AttendanceRecordController::class, "index"]);
            Route::get("{attendanceRecord}", [AttendanceRecordController::class, "show"]);
            Route::post("store", [AttendanceRecordController::class, "store"]);
            Route::post("{attendanceRecord}", [AttendanceRecordController::class, "update"]);
            Route::post("{attendanceRecord}", [AttendanceRecordController::class, "delete"]);
        });

        Route::prefix("/citymunicipality")->group(function () {
            Route::get("/", [CityMunicipalityController::class, "index"]);
            Route::get("{cityMunicipalities}", [CityMunicipalityController::class, "show"]);
            Route::post("store", [CityMunicipalityController::class, "store"]);
            Route::post("{cityMunicipalities}", [CityMunicipalityController::class, "update"]);
            Route::post("{cityMunicipalities}", [CityMunicipalityController::class, "delete"]);
        });

        Route::prefix("/classlist")->group(function () {
            Route::get("/", [ClasslistController::class, "index"]);
            Route::get("{gradeId}", [ClasslistController::class, "show"]);
            Route::post("store", [ClasslistController::class, "store"]);
            Route::post("{gradeId}", [ClasslistController::class, "update"]);
            Route::post("{gradeId}", [ClasslistController::class, "delete"]);
        });

        Route::prefix("/curriculum")->group(function () {
            Route::get("/", [CurriculumController::class, "index"]);
            Route::get("{curriculum}", [CurriculumController::class, "show"]);
            Route::post("store", [CurriculumController::class, "store"]);
            Route::post("{curriculum}", [CurriculumController::class, "update"]);
            Route::post("{curriculum}", [CurriculumController::class, "delete"]);
        });

        Route::prefix("/grades")->group(function () {
            Route::get("/", [AcademicRecordController::class, "getAll"]);
            Route::get("{academicRecord}", [AcademicRecordController::class, "getRecord"]);
            Route::post("store", [AcademicRecordController::class, "storeRecord"]);
            Route::post("{academicRecord}", [AcademicRecordController::class, "updateRecord"]);
            Route::post("{academicRecord}", [AcademicRecordController::class, "deleteRecord"]);
        });

        Route::prefix("/gradelevel")->group(function () {
            Route::get("/", [GradeLevelController::class, "index"]);
            Route::get("{gradeLevel}", [GradeLevelController::class, "show"]);
            Route::post("store", [GradeLevelController::class, "store"]);
            Route::post("{gradeLevel}", [GradeLevelController::class, "update"]);
            Route::post("{gradeLevel}", [GradeLevelController::class, "delete"]);
        });

        Route::prefix("/sections")->group(function () {
            Route::get("/", [GradeSectionController::class, "index"]);
            Route::get("{gradeSection}", [GradeSectionController::class, "show"]);
            Route::post("store", [GradeSectionController::class, "store"]);
            Route::post("{gradeSection}", [GradeSectionController::class, "update"]);
            Route::post("{gradeSection}", [GradeSectionController::class, "delete"]);
        });

        Route::prefix("/schedule")->group(function () {
            Route::get("/", [FacultyScheduleController::class, "getAll"]);
            Route::get("{facultySchedule}", [FacultyScheduleController::class, "getSchedule"]);
            Route::post("store", [FacultyScheduleController::class, "storeSchedule"]);
            Route::post("{facultySchedule}", [FacultyScheduleController::class, "updateSchedule"]);
            Route::post("{facultySchedule}", [FacultyScheduleController::class, "deleteSchedule"]);
        });
    });
});
