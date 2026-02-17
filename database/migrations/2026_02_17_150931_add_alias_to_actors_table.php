<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('actors', function (Blueprint $table) {
            $table->string('alias')->nullable()->after('surname');
        });

        // Generar alias para los actores existentes
        $actors = DB::table('actors')->get();
        foreach ($actors as $actor) {
            $alias = \Illuminate\Support\Str::slug($actor->name . ' ' . $actor->surname);
            
            // Asegurar unicidad básica si fuera necesario, pero por ahora simple
            DB::table('actors')
                ->where('id', $actor->id)
                ->update(['alias' => $alias]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('actors', function (Blueprint $table) {
            $table->dropColumn('alias');
        });
    }
};
