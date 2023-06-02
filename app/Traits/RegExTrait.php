<?php

namespace App\Traits;

trait RegExTrait {

    private const EMAIL_ADDRESS_REGEX = '/^([A-Za-z0-9_.-]+[@]{1}[A-Za-z0-9]+([.]{1}[A-Za-z0-9]{2,3})+)$/';

    public function getEmailAddressRegex(): string {

        return $this::EMAIL_ADDRESS_REGEX;

    }

}
