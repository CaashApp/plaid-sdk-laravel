<?php

namespace CaashApp\Plaid\Facades;

use CaashApp\Plaid\Resources\AccessTokenResource;
use CaashApp\Plaid\Resources\AccountResource;
use CaashApp\Plaid\Resources\InstitutionCollectionResource;
use CaashApp\Plaid\Resources\InstitutionResource;
use CaashApp\Plaid\Resources\ItemRemoveResource;
use CaashApp\Plaid\Resources\ItemResource;
use CaashApp\Plaid\Resources\LinkTokenResource;
use CaashApp\Plaid\Resources\NewAccessTokenResource;
use CaashApp\Plaid\Resources\PublicTokenResource;
use CaashApp\Plaid\Resources\ResetItemResource;
use CaashApp\Plaid\Resources\WebhookFiredResource;
use Illuminate\Support\Facades\Facade;

/**
 * @method static LinkTokenResource createLinkToken(string $userId, array $options = [])
 * @method static LinkTokenResource updateLinkToken(string $userId, string $accessToken, array $options = [])
 * @method static AccessTokenResource exchangePublicToken(string $publicToken)
 * @method static ItemResource getItem(string $accessToken)
 * @method static ItemResource updateWebhook(string $accessToken, string $webhook)
 * @method static ItemRemoveResource removeItem(string $accessToken)
 * @method static InstitutionCollectionResource listInstitutions(int $count, int $offset, array $options = [])
 * @method static InstitutionResource getInstitution(string $institutionId, array $options = [])
 * @method static InstitutionResource searchInstitutions(string $query, array $options = [])
 * @method static AccountResource getAccount(string $accessToken)
 * @method static NewAccessTokenResource rotateAccessToken(string $accessToken)
 * @method static PublicTokenResource createPublicToken(string $institutionId, array $options = null)
 * @method static ResetItemResource resetItemLogin(string $accessToken)
 * @method static WebhookFiredResource fireWebhook(string $accessToken, string $webhookCode = 'DEFAULT_UPDATE')
 * @method static AccessTokenResource createTestItem(string $institution)
 *
 * @see \CaashApp\Plaid\Client\Factory
 */
class Plaid extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'plaid';
    }
}
