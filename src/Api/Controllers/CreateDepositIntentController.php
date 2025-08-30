<?php

namespace acmecorp1\FlarumExt\MoneyErc20Funding\Api\Controllers;

use Flarum\Api\Controller\AbstractCreateController;  // Line 4: Valid import
use Illuminate\Support\Str;  // Line 5: Str class exists
use acmecorp1\FlarumExt\MoneyErc20Funding\Models\DepositIntent;  // Line 6: Model assumed to exist (create via migration)
use Flarum\User\Exception\PermissionDeniedException;  // Line 7: Valid exception
use Flarum\Settings\SettingsRepositoryInterface;  // Line 8: Valid interface

class CreateDepositIntentController extends AbstractCreateController  // Line 10: Extends base class (exists)
{
    protected $settings;  // Line 12: Private var
    
    public function __construct(SettingsRepositoryInterface $settings)  // Line 14: Type hint correct
    {
        $this->settings = $settings;  // Line 16: Assignment ok
    }

    public function data($request, $document)  // Line 19: Override method exists in base
    {
        $actor = $request->getAttribute('actor');  // Line 21: Actor from PSRIS set via Flarum middleware
        if (!$actor->id) {  // Line 22: Check if logged in
            throw new PermissionDeniedException;  // Line 23: Correct exception
        }

        $amount = $request->getParsedBody()['amount'] ?? 0;  // Line 26: Body access via PSR-7 (valid)
        if ($amount <= 0 || !is_numeric($amount)) {  // Line 27: Validation logic ok
            throw new \InvalidArgumentException('Invalid amount');  // Line 28: Exception ok
        }

        $min = (float) $this->settings->get('acmecorp1-money-erc20.min_deposit');  // Line 31: Cast to float
        $max = (float) $this->settings->get('acmecorp1-money-erc20.max_deposit');  // Line 32: Cast to float
        if ($amount < $min || $amount > $max) {  // Line 33: Range check
            throw new \InvalidArgumentException('Amount out of bounds');  // Line 34: Exception
        }

        $intentId = Str::random(16);  // Line 37: Random ID (Str exists)
        $intent = DepositIntent::create([  // Line 38: Model create (assumes model exists)
            'user_id' => $actor->id,  // Line 39: FK
            'intent_id' => $intentId,  // Line 40: Unique
            'amount' => $amount,  // Line 41: Decimal
            'expires_at' => now()->addMinutes(60),  // Line 42: Laravel helper ok
        ]);

        return [  // Line 45: Return array (API format valid)
            'intent_id' => $intentId,  // Line 46: Key-value
            'message' => 'Intent created. Send tokens to receiving address.'  // Line 47: User message
        ];
    }
}