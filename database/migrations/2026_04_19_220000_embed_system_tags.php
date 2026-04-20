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
        if (Schema::hasTable('tag_task')) {
            Schema::create('tag_task_system', function (Blueprint $table) {
                $table->foreignId('task_id')->constrained()->cascadeOnDelete();
                $table->unsignedInteger('tag_id');
                $table->primary(['task_id', 'tag_id']);
                $table->timestamps();
            });

            DB::table('tag_task')->select([
                'task_id',
                'tag_id',
                'created_at',
                'updated_at',
            ])->orderBy('task_id')->chunk(100, function ($rows) {
                DB::table('tag_task_system')->insert(
                    collect($rows)->map(static fn ($row) => (array) $row)->all()
                );
            });

            Schema::drop('tag_task');
            Schema::rename('tag_task_system', 'tag_task');
        }

        Schema::dropIfExists('tags');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('color')->default('#6c757d');
            $table->timestamps();
        });

        $timestamp = now();
        DB::table('tags')->insert([
            ['id' => 1, 'name' => 'Work', 'color' => '#2563eb', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => 2, 'name' => 'School', 'color' => '#059669', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => 3, 'name' => 'Personal', 'color' => '#7c3aed', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => 4, 'name' => 'Urgent', 'color' => '#dc2626', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => 5, 'name' => 'Coding', 'color' => '#ea580c', 'created_at' => $timestamp, 'updated_at' => $timestamp],
        ]);

        if (Schema::hasTable('tag_task')) {
            Schema::create('tag_task_with_fk', function (Blueprint $table) {
                $table->foreignId('task_id')->constrained()->cascadeOnDelete();
                $table->foreignId('tag_id')->constrained()->cascadeOnDelete();
                $table->primary(['task_id', 'tag_id']);
                $table->timestamps();
            });

            DB::table('tag_task')->select([
                'task_id',
                'tag_id',
                'created_at',
                'updated_at',
            ])->orderBy('task_id')->chunk(100, function ($rows) {
                DB::table('tag_task_with_fk')->insert(
                    collect($rows)->map(static fn ($row) => (array) $row)->all()
                );
            });

            Schema::drop('tag_task');
            Schema::rename('tag_task_with_fk', 'tag_task');
        }
    }
};
