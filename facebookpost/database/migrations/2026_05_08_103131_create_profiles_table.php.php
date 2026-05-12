<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {

        Schema::create(

            'profiles',

            function (Blueprint $table) {

                $table->id();

                $table->string('name')
                      ->nullable();

                $table->string('email')
                      ->nullable();

                $table->longText('description')
                      ->nullable();

                $table->longText('hashtags')
                      ->nullable();

                $table->longText('tags')
                      ->nullable();

                $table->longText('images')
                      ->nullable();

                $table->longText('videos')
                      ->nullable();

                $table->longText('platforms')
                      ->nullable();

                /*
                |--------------------------------------------------------------------------
                | FACEBOOK FIELDS
                |--------------------------------------------------------------------------
                */

                $table->text('facebook_post_id')
                      ->nullable();

                $table->text('facebook_post_url')
                      ->nullable();

                $table->integer('facebook_likes')
                      ->default(0);

                $table->integer('facebook_comments')
                      ->default(0);

                $table->integer('facebook_followers')
                      ->default(0);

                /*
                |--------------------------------------------------------------------------
                | STATUS
                |--------------------------------------------------------------------------
                */

                $table->string('status')
                      ->default('publish');

                /*
                |--------------------------------------------------------------------------
                | SCHEDULE TIME
                |--------------------------------------------------------------------------
                */

                $table->dateTime('schedule_time')
                      ->nullable();

                $table->timestamps();

            }

        );

    }

    public function down(): void
    {

        Schema::dropIfExists('profiles');

    }

};