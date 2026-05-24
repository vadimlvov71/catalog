<?php

namespace App\Enums;

enum IndexStatus: string
{
   case SHOW = 'show';
   case HIDDEN = 'hidden';

   /**
     * Get human-readable label
     */
    public function label(): string
    {
        return match($this) {
            self::SHOW => 'show',
            self::HIDDEN => 'hidden',
        };
    }
    
   /**
     * Get FontAwesome icon class
     */
    public function icon(): string
    {
        return match($this) {
            self::SHOW => 'fa-check-circle',
            self::HIDDEN => 'fa-ban',

        };
    }
}



