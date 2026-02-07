<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
{
    Schema::create('coupons', function (Blueprint $table) {
        $table->id();
        $table->string('code')->unique();
        $table->string('type');
        $table->integer('value');
        $table->date('expires_at')->nullable();
        $table->timestamps();
    });
}



    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
