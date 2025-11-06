<?php

namespace App\Enums;

enum Priority: string
{
    case Urgent = 'Urgent';
    case Important = 'Important';
    case Medium = 'Medium';
    case Low = 'Low';
}
