<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Plaid Environment
    |--------------------------------------------------------------------------
    |
    | Plaid has three environments: Sandbox, Development, and Production.
    | Items, once created, cannot be moved to another environment. The
    | Sandbox environment supports only test Items. The Development
    | environment supports up to 100 live Items using real data.
    |
    */

    'env' => env('PLAID_ENV', 'sandbox'),

    /*
    |--------------------------------------------------------------------------
    | Client ID
    |--------------------------------------------------------------------------
    |
    | Your client_id is an identifier given to you by Plaid and required by
    | the API to uniquely identify yourself. It must be provided for most
    | API calls. Your client ID can be found on the dashboard.
    |
    */

    'client' => env('PLAID_CLIENT_ID'),

    /*
    |--------------------------------------------------------------------------
    | Secret
    |--------------------------------------------------------------------------
    |
    | Your secret is used to authenticate calls to the Plaid API. Secrets
    | can be found on the Plaid dashboard. Your secret is specific to
    | the environment being used. Your secret should be kept secret
    | and rotated if it is ever compromised. For more information
    | see rotating keys in the Plaid documentation.
    |
    */

    'secret' => env('PLAID_SECRET'),

    /*
    |--------------------------------------------------------------------------
    | Default Webhook
    |--------------------------------------------------------------------------
    |
    | The destination to which any webhooks should be sent. This is sent to
    | Plaid when creating a link token. To change an existing webhooks use
    | the changeWebhook() method on the Plaid facade.
    |
    */

    'webhook' => '/webhooks',

    /*
    |--------------------------------------------------------------------------
    | Products
    |--------------------------------------------------------------------------
    |
    | List of Plaid product(s) you wish to use. Valid products are:
    |
    | transactions, auth, identity, assets, investments, liabilities,
    | payment_initiation, deposit_switch, income_verification, transfer,
    | employment
    |
    | In Production, you will be billed for each product that you specify
    | when initializing Link. Note that a product cannot be removed from
    | an item once the item has been initialized with that product. To
    | stop billing on items for subscription-based products, such as
    | Liabilities, Investments, and Transactions, remove the Item.
    |
    */

    'products' => [
        'transactions',
        'auth',
        'identity',
        'assets',
        'investments',
        'liabilities',
    ],

    /*
    |--------------------------------------------------------------------------
    | Country Codes
    |--------------------------------------------------------------------------
    |
    | Specify an array of country codes using the ISO-3166-1 alpha-2 country
    | code standard. Institutions from all listed countries will be shown.
    |
    | Supported country codes are: US, CA, DE, ES, FR, GB, IE, NL
    |
    | All country codes are enabled for your account by default in Sandbox
    | and Development. But in Production, only US and Canada are enabled
    | at the account level by default. To gain access to institutions
    | in European countries in the Production environment, file an
    | access Support ticket via the Plaid dashboard
    |
    */

    'country_codes' => ['US', 'GB'],

    /*
    |--------------------------------------------------------------------------
    | Language
    |--------------------------------------------------------------------------
    |
    | The language that Link should be displayed in. Supported languages are:
    |
    | English ('en'), French ('fr'), Spanish ('es'), Dutch ('nl'),
    | German('de')
    |
    | When using Link customization, the language configured here must match
    | the setting in the customization, or the customization will not be
    | applied.
    */

    'language' => config('app.locale'),
];
