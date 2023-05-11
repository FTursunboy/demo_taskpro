<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statuses extends Model
{
    use HasFactory;

    const CREATE = 1;
    const SEND = 2;
    const ACCEPT = 3;
    const DECLINED = 4;
    const FINISH = 5;
    const CONFIRM = 6;
    const OUT_OF_DATE = 7;
    const SEND_TO_TEST = 8;
    const UPDATE = 9;
    const DELETE = 10;
    const RESEND = 11;
    const SEND_USER = 12;
}
