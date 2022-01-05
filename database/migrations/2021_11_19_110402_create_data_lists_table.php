<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_lists', function (Blueprint $table) {
            $table->id();
            $table->string('unique_id', 50)->unique();
            $table->foreignId('borrower_id')->constrained()->cascadeOnDelete();
            $table->text('note')->nullable();
            $table->string('accepted_by')->nullable();
            $table->boolean('is_returned')->default(0);
            $table->timestamps();
            $table->timestamp('borrowed_at')->useCurrent();
            $table->timestamp('returned_at')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_lists');
    }
}
