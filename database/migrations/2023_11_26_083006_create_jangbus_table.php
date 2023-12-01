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
        Schema::create('jangbus', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('io')->nullable();      // 매입=0 / 매출=1
            $table->date('writeday')->nullable();       // 날짜
            $table->integer('products_id')->nullable(); // 제품명
            $table->integer('price')->nullable();       // 단가
            $table->integer('numi')->nullable();        // 매입수량
            $table->integer('numo')->nullable();        // 매출수량
            $table->integer('prices')->nullable();      // 금액
            $table->string('bigo', 20)->nullable();     // 비고
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jangbus');
    }
};
