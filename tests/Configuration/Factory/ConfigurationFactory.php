<?php

declare(strict_types=1);

namespace Atlance\JwtCore\Tests\Configuration\Factory;

use Atlance\JwtCore\Tests\Configuration\Configuration;

final class ConfigurationFactory
{
    public static function create(): Configuration
    {
        return Configuration::fromArray([
            'openssl' => [
                'algorithm_id' => (string) getenv('JWT_KEY_ALGORITHM_ID'),
                'public_key' => (string) getenv('JWT_PUBLIC_KEY_FILE'),
                'private_key' => (string) getenv('JWT_PRIVATE_KEY_FILE'),
                'private_passphrase' => (string) getenv('JWT_PRIVATE_KEY_PASS_PHRASE'),
            ],
            'jwt' => [
                'claims' => [
                    'client_claim_name' => (string) getenv('JWT_CLIENT_CLAIM_NAME'),
                ],
                'options' => [
                    'ttl' => (int) getenv('JWT_TTL'),
                ],
            ],
        ]);
    }
}
