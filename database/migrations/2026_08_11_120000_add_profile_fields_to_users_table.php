<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('first_name')->nullable()->after('name');
            $table->string('last_name')->nullable()->after('first_name');
            $table->string('phone', 20)->nullable()->after('email');
            $table->string('role', 20)->default('staff')->after('phone');
            $table->string('status', 20)->default('active')->after('role');
            $table->timestamp('last_login_at')->nullable()->after('status');
            $table->timestamp('password_changed_at')->nullable()->after('last_login_at');
        });

        foreach (DB::table('users')->orderBy('id')->get() as $user) {
            $parts = preg_split('/\s+/', trim((string) $user->name), 2) ?: [];
            $firstName = $parts[0] ?? (string) $user->name;
            $lastName = $parts[1] ?? '';

            DB::table('users')->where('id', $user->id)->update([
                'first_name' => $firstName,
                'last_name' => $lastName,
                'role' => 'admin',
                'status' => 'active',
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'first_name',
                'last_name',
                'phone',
                'role',
                'status',
                'last_login_at',
                'password_changed_at',
            ]);
        });
    }
};
