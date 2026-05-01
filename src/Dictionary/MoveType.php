<?php

declare(strict_types=1);

namespace App\Dictionary;

enum MoveType: string
{
    case DEFAULT = 'DEFAULT';
    case CAPTURE = 'CAPTURE';
    case CHECK = 'CHECK';
    case PROMOTION = 'PROMOTION';
    case PROMOTION_WITH_CAPTURE_AND_CHECK = 'PROMOTION_WITH_CAPTURE_AND_CHECK';
    case PROMOTION_WITH_CAPTURE = 'PROMOTION_WITH_CAPTURE';
    case CHECK_WITH_CAPTURE = 'CHECK_WITH_CAPTURE';
}
