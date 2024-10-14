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
        Schema::create('returns', function (Blueprint $table) {
            $table->id();
            $table->string('part_id'); // Reference to available stocks
            $table->integer('quantity_returned');            // Quantity returned
            $table->date('return_date');                      // Date the part was returned
            $table->string('reason_for_return');              // Reason for return
            $table->string('condition');                       // Condition of the returned part
            $table->string('returned_by');                     // Person who processed the return
            $table->string('action_taken');                    // Action taken on the return
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('returns');
    }
};
