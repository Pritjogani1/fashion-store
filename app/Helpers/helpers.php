<?php
use App\Models\StaticBlock;

function getBlock($slug)
{
    $status = StaticBlock::where('is_active', true)->where('slug', $slug)->first();
    if ($status) {
        return $status;
    }
    
    
}