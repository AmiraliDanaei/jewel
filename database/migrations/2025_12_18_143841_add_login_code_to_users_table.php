<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
{
    Schema::table('users', function (Blueprint $table) {
        $table->string('login_code')->nullable()->after('password');
        $table->timestamp('login_code_expires_at')->nullable()->after('login_code');
    });
}


    
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            
        });
    }
};
