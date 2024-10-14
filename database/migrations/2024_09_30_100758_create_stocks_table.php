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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->string('part_name');                 
            $table->string('part_number')->unique();    
            $table->string('manufacturer');              
            $table->integer('quantity_in_stock');         
            $table->string('compatibility');             
            $table->integer('reorder_level');            
            $table->string('warehouse_location');        
            $table->decimal('price_per_unit', 10, 2);   
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
