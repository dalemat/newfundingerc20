<?php

namespace acmecorp1\FlarumExt\MoneyErc20Funding\Forum\Controllers;  // Line 3: Namespace matches folder structure (no error)

use Flarum\Forum\Controller\AbstractForumController;  // Line 5: Valid Flarum import
use Flarum\Settings\SettingsRepositoryInterface;  // Line 6: Settings interface exists

class FundingPageController extends AbstractForumController  // Line 9: Extends base forum controller (exists)
{
    protected $settings;  // Line 11: Protected property (standard)

    public function __construct(SettingsRepositoryInterface $settings)  // Line 13: Constructor with DI (valid)
    {
        $this->settings = $settings;  // Line 15: Assignment (no type mismatch)
    }

    public function index()  // Line 18: Index method for GET route (standard for forum controllers)
    {
        return $this->view('acmecorp1-money-erc20-funding.funding-page', [  // Line 20: Returns view with params (requires template file)
            'address' => $this->settings->get('acmecorp1-money-erc20.receiving_address'),  // Line 21: Settings get (valid key)
            'rate' => $this->settings->get('acmecorp1-money-erc20.conversion_rate'),  // Line 22: Settings get
        ]);
    }
}