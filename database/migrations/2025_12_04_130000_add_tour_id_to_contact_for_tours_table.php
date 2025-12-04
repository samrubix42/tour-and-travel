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
        Schema::table('contact_for_tours', function (Blueprint $table) {
            if (!Schema::hasColumn('contact_for_tours', 'tour_id')) {
                $table->foreignId('tour_id')->nullable()->constrained('tour_packages')->nullOnDelete()->after('check_out_date');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contact_for_tours', function (Blueprint $table) {
            if (Schema::hasColumn('contact_for_tours', 'tour_id')) {
                $table->dropForeign(['tour_id']);
                $table->dropColumn('tour_id');
            }
        });
    }
};
