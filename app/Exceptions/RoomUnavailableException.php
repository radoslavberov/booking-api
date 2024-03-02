<?php

namespace App\Exceptions;

use Exception;

class RoomUnavailableException extends Exception
{
    protected const MESSAGE = 'The room is not available for the selected dates!';
    protected const CODE = '400';

    public function __construct()
    {
        parent::__construct(self::MESSAGE, self::CODE);
    }
}
