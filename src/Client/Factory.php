<?php

namespace Indemnity83\Plaid\Client;

use Indemnity83\Plaid\Resources\AccessTokenResource;
use Indemnity83\Plaid\Resources\AccountResource;
use Indemnity83\Plaid\Resources\InstitutionCollectionResource;
use Indemnity83\Plaid\Resources\InstitutionResource;
use Indemnity83\Plaid\Resources\InstitutionSearchResource;
use Indemnity83\Plaid\Resources\ItemRemoveResource;
use Indemnity83\Plaid\Resources\ItemResource;
use Indemnity83\Plaid\Resources\LinkTokenResource;
use Indemnity83\Plaid\Resources\NewAccessTokenResource;
use Indemnity83\Plaid\Resources\PublicTokenResource;
use Indemnity83\Plaid\Resources\ResetItemResource;
use Indemnity83\Plaid\Resources\WebhookFiredResource;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use InvalidArgumentException;
use RuntimeException;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class Factory
{
    const API_VERSION = '2020-09-14';

    protected array $plaidEnvironments = [
        'production' => 'https://production.plaid.com/',
        'development' => 'https://development.plaid.com/',
        'sandbox' => 'https://sandbox.plaid.com/',
    ];

    protected string $hostname;

    protected array $headers;

    public function __construct(
        protected string $clientId,
        protected string $clientSecret,
        protected string $environment,
        protected string $clientName,
        protected array $products = ['transactions'],
        protected string $language = 'en',
        protected array $countryCodes = ['US']
    ) {
        $this->hostname = $this->plaidEnvironments[$this->environment];

        $this->headers = [
            'Plaid-Version' => self::API_VERSION,
            'PLAID-CLIENT-ID' => config('services.plaid.client'),
            'PLAID-SECRET' => config('services.plaid.secret'),
            'Content-Type' => 'application/json',
        ];
    }

    /**
     * Send a request and return the response.
     *
     * @param string $endpoint
     * @param array $body
     * @return Response
     * @throws RequestException
     */
    private function sendRequest(string $endpoint, array $body): Response
    {
        return Http::withHeaders($this->headers)
            ->baseUrl($this->hostname)
            ->post($endpoint, $body)
            ->throw();
    }

    /**
     * Returns information about the status of an Item.
     *
     * @link https://plaid.com/docs/api/items/#itemget
     *
     * @param string $accessToken
     * @return ItemResource
     * @throws RequestException
     * @throws UnknownProperties
     */
    public function getItem(string $accessToken): ItemResource
    {
        return new ItemResource($this->sendRequest('item/get', [
            'access_token' => $accessToken,
        ])->json());
    }

    /**
     * Remove an Item.
     *
     * Once removed, the access_token associated with the Item is
     * no longer valid and cannot be used to access any data that
     * was associated with the Item.
     *
     * @link https://plaid.com/docs/api/items/#itemremove
     *
     * @param string $accessToken
     * @return ItemRemoveResource
     * @throws RequestException
     * @throws UnknownProperties
     */
    public function removeItem(string $accessToken): ItemRemoveResource
    {
        return new ItemRemoveResource($this->sendRequest('item/remove', [
            'access_token' => $accessToken,
        ])->json());
    }

    /**
     * Update the webhook URL associated with an Item.
     *
     * @link https://plaid.com/docs/api/items/#itemwebhookupdate
     *
     * @param string $accessToken
     * @param string $webhook
     * @return ItemResource
     * @throws RequestException
     * @throws UnknownProperties
     */
    public function updateWebhook(string $accessToken, string $webhook): ItemResource
    {
        return new ItemResource($this->sendRequest('item/webhook/update', [
            'access_token' => $accessToken,
            'webhook' => $webhook,
        ])->json());
    }

    /**
     * Returns details on all financial institutions currently supported by Plaid.
     *
     * Because Plaid supports thousands of institutions, results are paginated.
     *
     * @link https://plaid.com/docs/api/institutions/#institutionsget
     *
     * @param int $count
     * @param int $offset
     * @param array $options
     * @return InstitutionCollectionResource
     * @throws RequestException
     * @throws UnknownProperties
     */
    public function listInstitutions(int $count, int $offset, array $options = []): InstitutionCollectionResource
    {
        $options = array_merge([
            'include_optional_metadata' => true,
            'products' => $this->products,
        ], $options);

        if ($count < 1 || $count > 500) {
            throw new InvalidArgumentException('count must be between 0 and 500');
        }

        if ($offset < 0) {
            throw new InvalidArgumentException('offset must be greater than zero');
        }

        return new InstitutionCollectionResource($this->sendRequest('institutions/get', [
            'count' => $count,
            'offset' => $offset,
            'country_codes' => $this->countryCodes,
            'options' => $options,
        ])->json());
    }

    /**
     * Returns a specified financial institution currently supported by Plaid.
     *
     * @link https://plaid.com/docs/api/institutions/#institutionsget_by_id
     *
     * @param string $institutionId
     * @param array $options
     * @return InstitutionResource
     * @throws RequestException
     * @throws UnknownProperties
     */
    public function getInstitution(string $institutionId, array $options = []): InstitutionResource
    {
        $options = array_merge([
            'include_optional_metadata' => true,
        ], $options);

        return new InstitutionResource($this->sendRequest('institutions/get_by_id', [
            'institution_id' => $institutionId,
            'country_codes' => $this->countryCodes,
            'options' => $options,
        ])->json());
    }

    /**
     * Returns institutions that match the query parameters.
     *
     * Up to a maximum of ten institutions per query
     *
     * @link https://plaid.com/docs/api/institutions/#institutionssearch
     *
     * @param string $query
     * @param array $options
     * @return InstitutionSearchResource
     * @throws RequestException
     * @throws UnknownProperties
     */
    public function searchInstitutions(string $query, array $options = []): InstitutionSearchResource
    {
        $options = array_merge([
            'include_optional_metadata' => true,
        ], $options);

        return new InstitutionSearchResource($this->sendRequest('institutions/search', [
            'query' => $query,
            'country_codes' => $this->countryCodes,
            'products' => $this->products,
            'options' => $options,
        ])->json());
    }

    /**
     * Retrieve a list of accounts associated with any linked Item.
     *
     * @link https://plaid.com/docs/api/accounts/#accountsget
     *
     * @param string $accessToken
     * @return AccountResource
     * @throws RequestException
     * @throws UnknownProperties
     */
    public function getAccount(string $accessToken): AccountResource
    {
        return new AccountResource($this->sendRequest('accounts/get', [
            'access_token' => $accessToken,
        ])->json());
    }

    /**
     * Creates a link_token, which is required as a parameter when initializing Link.
     *
     * @link https://plaid.com/docs/api/tokens/#linktokencreate
     *
     * @param string $userId
     * @param array $options
     * @return LinkTokenResource
     * @throws RequestException
     * @throws UnknownProperties
     */
    public function createLinkToken(string $userId, array $options = []): LinkTokenResource
    {
        return new LinkTokenResource($this->sendRequest('link/token/create', array_merge([
            'client_name' => $this->clientName,
            'language' => $this->language,
            'country_codes' => $this->countryCodes,
            'user' => ['client_user_id' => $userId],
            'products' => $this->products,
        ], $options))->json());
    }

    /**
     * Creates a link_token in update/modify mode.
     *
     * @link https://plaid.com/docs/api/tokens/#linktokencreate
     *
     * @param string $userId
     * @param string $accessToken
     * @param array $options
     * @return LinkTokenResource
     * @throws RequestException
     * @throws UnknownProperties
     */
    public function updateLinkToken(string $userId, string $accessToken, array $options = []): LinkTokenResource
    {
        return new LinkTokenResource($this->sendRequest('link/token/create', array_merge([
            'client_name' => $this->clientName,
            'language' => $this->language,
            'country_codes' => $this->countryCodes,
            'user' => ['client_user_id' => $userId],
            'access_token' => $accessToken,
        ], $options))->json());
    }

    /**
     * Exchange a Link public_token for an API access_token.
     *
     * @link https://plaid.com/docs/api/tokens/#itempublic_tokenexchange
     *
     * @param string $publicToken
     * @return AccessTokenResource
     * @throws RequestException
     * @throws UnknownProperties
     */
    public function exchangePublicToken(string $publicToken): AccessTokenResource
    {
        return new AccessTokenResource($this->sendRequest('item/public_token/exchange', [
            'public_token' => $publicToken,
        ])->json());
    }

    /**
     * Rotate the access_token associated with an Item.
     *
     * The method returns a new access_token and immediately invalidates
     * the previous access_token.
     *
     * @link https://plaid.com/docs/api/tokens/#itemaccess_tokeninvalidate
     *
     * @param string $accessToken
     * @return NewAccessTokenResource
     * @throws RequestException
     * @throws UnknownProperties
     */
    public function rotateAccessToken(string $accessToken): NewAccessTokenResource
    {
        return new NewAccessTokenResource($this->sendRequest('item/access_token/invalidate', [
            'access_token' => $accessToken,
        ])->json());
    }

    /**
     * Create a valid public_token for an arbitrary institution ID.
     *
     * @link https://plaid.com/docs/api/sandbox/#sandboxpublic_tokencreate
     *
     * @param string $institutionId
     * @param array|null $options
     * @return PublicTokenResource
     * @throws RequestException
     * @throws UnknownProperties
     */
    public function createPublicToken(string $institutionId, array $options = null): PublicTokenResource
    {
        if ($this->environment !== 'sandbox') {
            throw new RuntimeException('method createPublicToken() only available in sandbox mode.');
        }

        return new PublicTokenResource($this->sendRequest('sandbox/public_token/create', [
            'institution_id' => $institutionId,
            'initial_products' => $this->products,
            'options' => $options,
        ])->json());
    }

    /**
     * Force a Sandbox Item into an error state
     *
     * @link https://plaid.com/docs/api/sandbox/#sandboxitemreset_login
     *
     * @param string $accessToken
     * @return ResetItemResource
     * @throws RequestException
     * @throws UnknownProperties
     */
    public function resetItemLogin(string $accessToken): ResetItemResource
    {
        if ($this->environment !== 'sandbox') {
            throw new RuntimeException('method createPublicToken() only available in sandbox mode.');
        }

        return new ResetItemResource($this->sendRequest('sandbox/item/reset_login', [
            'access_token' => $accessToken,
        ])->json());
    }

    /**
     * Fire a test webhook.
     *
     * @link https://plaid.com/docs/api/sandbox/#sandboxitemfire_webhook
     *
     * @param string $accessToken
     * @param string $webhookCode
     * @return WebhookFiredResource
     * @throws RequestException
     * @throws UnknownProperties
     */
    public function fireWebhook(string $accessToken, string $webhookCode = 'DEFAULT_UPDATE'): WebhookFiredResource
    {
        if ($this->environment !== 'sandbox') {
            throw new RuntimeException('method createPublicToken() only available in sandbox mode.');
        }

        if (! in_array($webhookCode, [
            'DEFAULT_UPDATE',
            'NEW_ACCOUNTS_AVAILABLE',
        ])) {
            throw new \http\Exception\InvalidArgumentException("invalid webhook code '$webhookCode'.");
        }

        return new WebhookFiredResource($this->sendRequest('sandbox/item/fire_webhook', [
            'access_token' => $accessToken,
            'webhook_code' => $webhookCode,
        ])->json());
    }

    /**
     * Create an item for testing.
     *
     * @param string $institution
     * @return AccessTokenResource
     * @throws RequestException
     * @throws UnknownProperties
     */
    public function createTestItem(string $institution): AccessTokenResource
    {
        $link = $this->createPublicToken($institution);

        return $this->exchangePublicToken($link->public_token);
    }
}
