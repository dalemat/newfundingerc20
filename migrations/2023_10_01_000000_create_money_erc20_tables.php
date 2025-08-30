<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Create the tables for ERC20 funding extension.
 */
class CreateMoneyErc20Tables extends Migration
{
    public function up()
    {
        // Table for user-linked wallets
        Schema::create('user_wallets', function (Blueprint $table) {
            $table->increments('id');  // Line 13: Auto-incrementint primary key (int type ok)
            $table->integer('user_id')->unsigned();  // Line 14: FK to users (unsigned for constraint)
            $table->string('address');  // Line 15: Eth address (varchar, ready for validation)
            $table->boolean('verified')->default(false);  // Line 16: Boolean default
            $table->string('nonce');  // Line 17: Random string for sig verification
            $table->timestamps();  // Line 18: Standard Laravel timestamps
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');  // Line 19: FK valid
        });

        // Table for deposit intents
        Schema::create('deposit_intents', function (Blueprint $table) {
            $table->increments('id');  // Line 22: id
            $table->integer('user_id')->unsigned();  // Line 23: user_id
            $table->string('intent_id')->unique();  // Line 24: Unique ID (prevents dupes)
            $table->decimal('amount', 15, 8);  // Line 25: Precise decimal
            $table->string('tx_hash')->nullable();  // Line 26: Allow null tx_hash
            $table->string('status')->default('pending');  // Line 27: Default status
            $table->timestamp('expires_at');  // Line 28: Expiry timestamp
            $table->timestamps();  // Line 29: timestamps
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');  // Line 30: FK
            $table->index(['user_id', 'status']);  // Line 31: Index for performance
        });

        // Audit log table
        Schema::create('money_erc20_audits', function (Blueprint $table) {
            $table->increments('id');  // Line 35: id
            $table->integer('user_id')->unsigned()->nullable();  // Line 36: Optional user FK
            $table->string('action');  // Line 37: Action string
            $table->json('data');  // Line 38: JSON data (Laravel handles)
            $table->timestamps();  // Line 39: timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('money_erc20_audits');  // Line 43: Reverse order safe
        Schema::dropIfExists('deposit_intents');  // Line 44: Drop intents
        Schema::dropIfExists('user_wallets');  // Line 45: Drop wallets
    }
}