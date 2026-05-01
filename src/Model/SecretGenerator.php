<?php 

declare(strict_types=1);

namespace App\Model;

class SecretGenerator 
{
    private static array $secrets = [];

    public static function generate(): string
    {
        $alphabet = range('A', 'Z');

        do {
            $secret = null;

            for ($i = 1; $i <= 6; $i++) {
                $letterOrNumber = ceil(rand(0, 1));
                $secret .= $letterOrNumber == 1 ? $alphabet[rand(0, count($alphabet) - 1)] : ceil(rand(0, 8));
            } 
        } while (false === self::isSecretAvailable($secret));

        self::$secrets[] = $secret;

        return $secret;
    }

    public static function isSecretAvailable(string $secret): bool
    {
        if (in_array($secret, self::$secrets)) {
            return false;
        }

        return true;
    }
}
