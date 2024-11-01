<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HtmlPage extends Model
{
    use HasFactory;

    protected $table = 'html_pages';

    protected $fillable = [
        'page_variable',
        'page_title',
        'html_content',
    ];
}
