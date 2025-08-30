<?php

namespace acmecorp1\FlarumExt\MoneyErc20Funding\Api\Controllers;

use Flarum\Api\Controller\AbstractCreateController;  // Line 4: Valid
use Illuminate\Support\Str;  // Line 5: Valid
use acmecorp1\FlarumExt\MoneyErc20Funding\Services\SignatureVerifier;  // Line 6: Assumed service
use acmecorp1\FlarumExt\MoneyErc20Funding\Models\UserWallet;  // Line 7: Assumed model

class VerifyAddressController extends AbstractCreateController  // Line 9: Extends base
{
    protected $verifier;  // Line 11: Private
    
    public function __construct(SignatureVerifier $verifier)  // Line 13: Type hint
    {
        $this->verifier = $verifier;  // Line 15: Assign
    }

    public function data($request, $document)  // Line 17: Override
    {
        $actor = $request->getAttribute('actor');  // Line 19: Actor from request
        $body = $request->getParsedBody();  // Line 20: Body parsing
        $address = $body['address'] ?? '';  // Line 21: Default empty
        $signature = $body['signature'] ?? '';  // Line 22: Default empty
        $message = "Verify address for user {$actor->id}";  // Line 23: String interpolation ok

        if (!$address || !preg_match('/^0x[a-fA-F0-9]{40}$/', $address)) {  // Line 25: Regex for ETH address (valid)
            throw new \InvalidArgumentException('Invalid address');  // Line 26: Exception
        }

        if (!$this->verifier->verify($address, $signature, $message, $actor->id)) {  // Line 29: Service call (assumed)
            throw new \InvalidArgumentException('Signature verification failed');  // Line 30: Exception
        }

        UserWallet::updateOrCreate(