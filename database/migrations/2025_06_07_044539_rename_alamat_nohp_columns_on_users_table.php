<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
         Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('alamat', 'address');
            $table->renameColumn('no_hp', 'phone');
        });
    }

  
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('address', 'alamat');
            $table->renameColumn('phone', 'no_hp');
        });
    }
};
