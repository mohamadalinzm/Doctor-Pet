<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Artisan;
return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Rename brand table to brand_old and brand_category table to brand_category_old
        Artisan::call('migrate', [
            '--path' => 'Modules/MedicalCenter/src/Database/migrations/2023_04_14_002254_create_medical_center_types_table.php',
        ]);

        // Rename brand table to brand_old and brand_category table to brand_category_old
        Artisan::call('migrate', [
            '--path' => 'Modules/MedicalCenter/src/Database/migrations/2023_03_25_163244_create_medical_center_table.php',
        ]);

        // Create services table
        Artisan::call('migrate', [
            '--path' => 'Modules/MedicalCenter/src/Database/migrations/2023_04_14_002445_create_medical_center_services_table.php',
        ]);

    }


};
