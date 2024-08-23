<?php

use App\Models\Subscription;
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
        Schema::create(Subscription::TABLE, function (Blueprint $table) {
            $table->id(Subscription::ID);
            $table->string(Subscription::URL, 2_048);
            $table->string(Subscription::EMAIL, 256);
            $table->float(Subscription::PRICE);
            $table->timestamps();

            $table->unique([Subscription::URL, Subscription::EMAIL]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(Subscription::TABLE);
    }
};
