<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('campaign_subscriber', function (Blueprint $table) {
            $table->boolean('opened')->default(false)->after('subscriber_id');
            $table->timestamp('opened_at')->nullable()->after('opened');
        });
    }

    public function down()
    {
        Schema::table('campaign_subscriber', function (Blueprint $table) {
            $table->dropColumn(['opened', 'opened_at']);
        });
    }
};
