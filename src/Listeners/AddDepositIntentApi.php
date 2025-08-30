<?php

namespace acmecorp1\FlarumExt\MoneyErc20Funding\Listeners;

use Flarum\Api\Event\WillSerializeData;
use acmecorp1\FlarumExt\MoneyErc20Funding\Models\DepositIntent;

class AddDepositIntentApi
{
    public function handle(WillSerializeData $event)
    {
        // Add custom logic for deposit intents if needed (placeholder)
        // Example: $event->apiDocument->included->setData('depositIntents', ...);
    }
}