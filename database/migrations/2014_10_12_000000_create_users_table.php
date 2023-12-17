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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->unsignedBigInteger('role_id')->default(1); // Clave foránea para la relación con roles
            $table->boolean('activo')->default(true);
            $table->string('foto')->nullable(); 
            $table->timestamps();

            // Definir la clave foránea
            $table->foreign('role_id')->references('id')->on('roles');
        });

        // Insertar usuarios con roles 'Administrador'
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),
            'role_id' => 2, // Rol 'Administrador'
            'activo' => true,
            'foto' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'name' => 'Daniel',
            'email' => 'daniel@gmail.com',
            'password' => bcrypt('12345678'),
            'role_id' => 1, // Rol 'Administrador'
            'activo' => true,
            'foto' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
