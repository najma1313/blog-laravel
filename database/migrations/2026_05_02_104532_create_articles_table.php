<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            
            // Kita pakai 'content' supaya sama dengan yang di Controller
            $table->text('content'); 
            
            // Kita pakai 'image_url' supaya sama dengan fitur upload kita
            $table->string('image_url')->nullable(); 

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('articles');
    }
};