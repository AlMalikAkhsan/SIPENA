<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sarans', function (Blueprint $table) {
            $table->enum('status', ['menunggu', 'dibaca', 'ditinjau', 'diterapkan', 'ditolak'])->default('menunggu')->after('isi');
            $table->text('tanggapan_admin')->nullable()->after('status');
            $table->timestamp('tanggapan_at')->nullable()->after('tanggapan_admin');
        });
    }

    public function down(): void
    {
        Schema::table('sarans', function (Blueprint $table) {
            $table->dropColumn(['status', 'tanggapan_admin', 'tanggapan_at']);
        });
    }
};