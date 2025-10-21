<?php 

namespace App\Http\Enums;

enum TableLocation: string {
    case Inside = "inside";
    case Side = "side";
    case Outside = "outside";

}