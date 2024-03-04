<?php

namespace App\Enums;

enum PaymentStatusEnum: string
{
    case Pending = 'pending';
    case Completed = 'completed';
    case Rejected = 'rejected';
}
