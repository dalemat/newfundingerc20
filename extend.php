<?php
return [
    'listeners' => [
        'Flarum\Api\Event\SerializeIncludedData' => 'acmecorp1\FlarumExt\MoneyErc20Funding\Listeners\AddUserWalletRelation',
        'Flarum\Api\Event\WillSerializeData' => 'acmecorp1\FlarumExt\MoneyErc20Funding\Listeners\AddDepositIntentApi',
    ],
    'routes' => [
        'api' => [
            'POST /money-erc20/deposit-intent' => 'acmecorp1\FlarumExt\MoneyErc20Funding\Api\Controllers\CreateDepositIntentController',
            'POST /money-erc20/verify-address' => 'acmecorp1\FlarumExt\MoneyErc20Funding\Api\Controllers\VerifyAddressController',
        ],
        'forum' => [
            'GET /funding' => 'acmecorp1\FlarumExt\MoneyErc20Funding\Forum\Controllers\FundingPageController',
        ],
    ],
    'settings' => [
        'acmecorp1-money-erc20.blockchain_network' => 'sepolia',
        'acmecorp1-money-erc20.rpc_endpoint' => 'https://sepolia.infura.io/v3/YOUR_INFURA_PROJECT_ID',
        'acmecorp1-money-erc20.explorer_url' => 'https://sepolia.etherscan.io/',
        'acmecorp1-money-erc20.explorer_api_key' => '',
        'acmecorp1-money-erc20.receiving_address' => '',
        'acmecorp1-money-erc20.conversion_rate' => 100,
        'acmecorp1-money-erc20.erc20_contract' => '',
        'acmecorp1-money-erc20.decimals' => 18,
        'acmecorp1-money-erc20.confirmations_required' => 12,
        'acmecorp1-money-erc20.poll_interval' => 300,
        'acmecorp1-money-erc20.min_deposit' => 0.1,
        'acmecorp1-money-erc20.max_deposit' => 1000,
        'acmecorp1-money-erc20.intent_expiry' => 86400,
    ],
    'permissions' => [
        'acmecorp1-money-erc20.link_wallet' => 'Link Ethereum wallet',
    ],
    'discussion' => [
        'permissions' => [
            'view' => 'acmecorp1-money-erc20.link_wallet',
        ],
    ],
    'user' => [
        'preferences' => [
            'acmecorp1-money-erc20.notification_on_credit' => true,
        ],
    ],
];