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
            $table->string('payment_mode')->nullable()->after('role');
            $table->date('date')->nullable()->after('payment_mode');
            $table->date('update_date')->nullable()->after('date');
            $table->string('account_no')->nullable()->after('update_date');
            $table->string('bank_branch')->nullable()->after('account_no');
            $table->string('bank_ifsc')->nullable()->after('bank_branch');
            $table->string('account_holder_name')->nullable()->after('bank_ifsc');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('payment_mode');
            $table->dropColumn('date');
            $table->dropColumn('update_date');
            $table->dropColumn('account_no');
            $table->dropColumn('bank_branch');
            $table->dropColumn('bank_ifsc');
            $table->dropColumn('account_holder_name');
        });
    }
};
