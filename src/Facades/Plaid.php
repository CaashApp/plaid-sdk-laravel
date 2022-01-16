<?php

namespace Indemnity83\Plaid\Facades;

use Indemnity83\Plaid\Resources\AccessTokenResource;
use Indemnity83\Plaid\Resources\AccountResource;
use Indemnity83\Plaid\Resources\InstitutionCollectionResource;
use Indemnity83\Plaid\Resources\InstitutionResource;
use Indemnity83\Plaid\Resources\ItemRemoveResource;
use Indemnity83\Plaid\Resources\ItemResource;
use Indemnity83\Plaid\Resources\LinkTokenResource;
use Indemnity83\Plaid\Resources\NewAccessTokenResource;
use Indemnity83\Plaid\Resources\PublicTokenResource;
use Indemnity83\Plaid\Resources\ResetItemResource;
use Indemnity83\Plaid\Resources\WebhookFiredResource;
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
 * @see \Indemnity83\Plaid\Client\Factory
 */
class Plaid extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'plaid';
    }
}
