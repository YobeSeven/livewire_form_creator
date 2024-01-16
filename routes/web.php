<?php

use App\Http\Controllers\Forms\FormController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// *----------------* //

Route::get("/" , [HomeController::class , "index"])->name("home.index");

//* INDEX DE TOUT LES FORMILAIRES
Route::get("/forms/index" , [FormController::class , "index"])->name("forms.index");
//* PAGE EDIT
Route::get("/forms/{form}/edit" , [FormController::class , "edit"])->name("forms.edit");
//* PAGE POUR REPONDRE AU FORMULAIRE
Route::get("/forms/{form}/form" , [FormController::class , "form"])->name("forms.form");
//* FUNCTION POUR REPONDRE AU FORMULAIRE
Route::post("/forms/{form}/store" , [FormController::class , "store"])->name("forms.store");
//* FUNCTION POUR NE PLUS EDIT LE FORMULAIRE
Route::put("/forms/{form}/finish" , [FormController::class , "finish"])->name("forms.finish");
//* PAGE POUR VOIR LES REPONSES DU FORMULAIRE
Route::get("/forms/{form}/show" , [FormController::class , "show"])->name("forms.show");


