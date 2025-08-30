# Money ERC20 Funding Extension for Flarum

This extension integrates ERC20 token funding into Flarum's money system (extends `antoinefr/flarum-ext-money`). It allows users to fund accounts with automatic crediting.

## Installation
1. Install via Composer: `composer require acmecorp/flarum-ext-money-erc20funding`
2. Enable in admin panel.
3. Run `php flarum migrate`.
4. Configure settings (RPC, address, etc.).

## Features
- Link Ethereum addresses with signature verification.
- Create deposit intents for secure sends.
- Automatic polling and crediting via blockchain.

## Requirements
- Flarum 1.8+.
- Ethereum-compatible network.

## License
MIT