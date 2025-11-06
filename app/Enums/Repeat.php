<?php

namespace App\Enums;

enum Repeat: string
{
    case Daily = 'Daily';
    case Weekday = 'Weekday';
    case Weekly = 'Weekly';
    case Monthly = 'Monthly';
    case Yearly = 'Yearly';
    case Custom = 'Custom';
}
