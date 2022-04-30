<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;

class MigrationController extends Controller
{
    // migrate database
    public function migrateDatabase(){
        Artisan::call('migrate');
    }
}
