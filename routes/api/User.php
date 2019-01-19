<?php

Route::middleware('auth:api')->group(function() {
    /**
     * USERS
     */
    Route::apiResource('users', 'UserController');
});