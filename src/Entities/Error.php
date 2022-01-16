<?php

namespace CaashApp\Plaid\Entities;

use Spatie\DataTransferObject\DataTransferObject;

class Error extends DataTransferObject
{
    public string $error_type;

    public string $error_code;

    public string $error_message;

    public ?string $display_message;

    public ?string $request_id;

    public ?array $causes;

    public ?int $status;

    public ?string $documentation_url;

    public ?string $suggested_action;
}
