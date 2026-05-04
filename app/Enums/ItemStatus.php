<?php

namespace App\Enums;

enum ItemStatus: string
{
   case ACTIVE = 'active';
   case OUT_OF_STOCK = 'out_of_stock';
   case CLOSED = 'closed';

   /**
     * Get human-readable label
     */
    public function label(): string
    {
        return match($this) {
            self::ACTIVE => 'active',
            self::OUT_OF_STOCK => 'out of Stock',
            self::CLOSED => 'closed',
        };
    }
    
   /**
     * Get FontAwesome icon class
     */
    public function icon(): string
    {
        return match($this) {
            self::ACTIVE => 'fa-check-circle',
            self::OUT_OF_STOCK => 'fa-ban',
            self::CLOSED => 'fa-times-circle',
        };
    }
}



