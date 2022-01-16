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

];
