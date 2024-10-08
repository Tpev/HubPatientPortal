<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
	public function up()
	{
		Schema::create('form_submissions', function (Blueprint $table) {
			$table->id();
			$table->foreignId('form_instance_id')->constrained()->onDelete('cascade');
			$table->json('data'); // Store the submitted form data as JSON
			$table->timestamps();
		});

	}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_submissions');
    }
};
