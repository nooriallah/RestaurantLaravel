<?php 

namespace App\Http\Enums;

enum TableStatus: string {
    case Available = "available";
    case Reserved = "reserved";
    case Pending = "pending";
}
