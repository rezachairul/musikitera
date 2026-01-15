<?php

namespace App\Models\Admin\Administrator;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminManageBPH extends Model
{
    use HasFactory;

    protected $table = 'admin_manage_b_p_h_s';

    protected $fillable = [
        'nama',
        'jenis',
        'parent_id',
        'level',
        'urutan',
    ];

    /**
     * Jenis jabatan yang diizinkan
     */
    public const ALLOWED_JENIS = [
        'ketum',
        'sekjen',
        'sekum',
        'bendum',
        'kadep',
        'sekdep',
        'kadiv',
        'sekdiv',
        'staff',
    ];

    /**
     * Mapping jenis → level struktur
     */
    public const LEVEL_MAP = [
        'ketum'  => 1,
        'sekjen' => 2,
        'sekum'  => 3,
        'bendum' => 3,
        'kadep'  => 4,
        'sekdep' => 4,
        'kadiv'  => 5,
        'sekdiv' => 5,
        'staff'  => 6,
    ];

    // RELATIONSHIPS
    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id')->orderBy('urutan');
    }

    // DOMAIN HELPERS
    public static function levelOf(string $jenis): int
    {
        return self::LEVEL_MAP[$jenis];
    }
}