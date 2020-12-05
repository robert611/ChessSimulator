<?php 

namespace App\Model;

class SecretGenerator 
{
    private array $secrets = [];

    public function generate(): string
    {
        $alphabet = range('A', 'Z');

        do {
            $secret = null;

            for ($i = 1; $i <= 6; $i++) {
                $letterOrNumber = ceil(rand(0, 1));
                $secret .= $letterOrNumber == 1 ? $alphabet[rand(0, count($alphabet) - 1)] : ceil(rand(0, 8));
            } 
        } while(!$this->isSecretAvailable($secret));

        $this->secrets[] = $secret;

        return $secret;
    }

    public function isSecretAvailable(string $secret): bool
    {
        if (in_array($secret, $this->secrets)) {
            return false;
        }

        return true;
    }
}