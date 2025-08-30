<?php

namespace AcmeCorp\FlarumExt\MoneyErc20Funding\Listeners;

use Flarum\Api\Event\SerializeIncludedData;
use AcmeCorp\FlarumExt\MoneyErc20Funding\Models\UserWallet;

class AddUserWalletRelation
{
    public function handle(SerializeIncludedData $event)
    {
        $event->apiDocument->included->setData('userWallets', UserWallet::where('user_id', $event->model->id)->first());
    }
}