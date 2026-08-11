<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    /** @use HasFactory<\Database\Factories\FeedbackFactory> */
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'feedbacks';

    public const AGE_RANGE_1_12 = '1-12';

    public const AGE_RANGE_13_17 = '13-17';

    public const AGE_RANGE_18_49 = '18-49';

    public const AGE_RANGE_50_PLUS = '50+';

    public const GENDER_MALE = 'male';

    public const GENDER_FEMALE = 'female';

    public const GENDER_PREFER_NOT_TO_SAY = 'prefer_not_to_say';

    public const GENDER_OTHER = 'other';

    public const RESIDENCE_TUGUEGARAO_CITY = 'tuguegarao_city';

    public const RESIDENCE_CAGAYAN = 'cagayan';

    public const RESIDENCE_PHILIPPINES = 'philippines';

    public const RESIDENCE_INTERNATIONAL = 'international';

    public const EXPERIENCE_EXCELLENT = 'excellent';

    public const EXPERIENCE_GOOD = 'good';

    public const EXPERIENCE_AVERAGE = 'average';

    public const EXPERIENCE_POOR = 'poor';

    public const EXPERIENCE_BAD = 'bad';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'visit_date',
        'name',
        'age_range',
        'gender',
        'gender_other',
        'residence_type',
        'residence_detail',
        'overall_experience',
        'comments',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'visit_date' => 'date',
        ];
    }

    /**
     * @return list<string>
     */
    public static function ageRanges(): array
    {
        return [
            self::AGE_RANGE_1_12,
            self::AGE_RANGE_13_17,
            self::AGE_RANGE_18_49,
            self::AGE_RANGE_50_PLUS,
        ];
    }

    /**
     * @return list<string>
     */
    public static function genders(): array
    {
        return [
            self::GENDER_MALE,
            self::GENDER_FEMALE,
            self::GENDER_PREFER_NOT_TO_SAY,
            self::GENDER_OTHER,
        ];
    }

    /**
     * @return list<string>
     */
    public static function residenceTypes(): array
    {
        return [
            self::RESIDENCE_TUGUEGARAO_CITY,
            self::RESIDENCE_CAGAYAN,
            self::RESIDENCE_PHILIPPINES,
            self::RESIDENCE_INTERNATIONAL,
        ];
    }

    /**
     * @return list<string>
     */
    public static function overallExperiences(): array
    {
        return [
            self::EXPERIENCE_EXCELLENT,
            self::EXPERIENCE_GOOD,
            self::EXPERIENCE_AVERAGE,
            self::EXPERIENCE_POOR,
            self::EXPERIENCE_BAD,
        ];
    }
}
