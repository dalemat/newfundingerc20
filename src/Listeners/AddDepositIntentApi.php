<?php

namespace AcmeCorp\FlarumExt\MoneyErc20Funding\Listeners;

use Flarum\Api\Event\WillSerializeData;
use AcmeCorp\FlarumExt\MoneyErc20Funding\Models\DepositIntent;

class AddDepositIntentApi
{
    public function handle(WillSerializeData $event)
    {
        // Add custom logic for deposit intents if needed (placeholder)
        // Example: $event->apiDocument->included->setData('depositIntents', ...);
    }
}