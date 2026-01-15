<?php

namespace App\Models\admin\administrator;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminManageDPO extends Model
{
    /** @use HasFactory<\Database\Factories\AdminManageDPOFactory> */
    use HasFactory;

    protected $table = 'admin_manage_d_p_o_s';

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
        'koordinator',
        'sekretaris',
        'komisi',
        'staff',
    ];

    /**
     * Mapping jenis → level struktur
     */
    public const LEVEL_MAP = [
        'koordinator'  => 1,
        'sekretaris' => 2,
        'komisi'  => 3,
        'staff'  => 4,
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
