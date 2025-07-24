<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $table = 'site_settings';
    public $timestamps = true;
    protected $fillable = ['name', 'value'];

    public static function getSetting($name, $default = null)
    {
        return optional(self::where('name', $name)->first())->value ?? $default;
    }
}
