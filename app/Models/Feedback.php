<?php

namespace App\Models;

use Illuminate\Contracts\Database\Query\Builder;
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

    /**
     * Numeric scores used for dashboard averages.
     *
     * @return array<string, int>
     */
    public static function experienceScores(): array
    {
        return [
            self::EXPERIENCE_EXCELLENT => 5,
            self::EXPERIENCE_GOOD => 4,
            self::EXPERIENCE_AVERAGE => 3,
            self::EXPERIENCE_POOR => 2,
            self::EXPERIENCE_BAD => 1,
        ];
    }

    /**
     * @return array<string, string>
     */
    public static function ageRangeLabels(): array
    {
        return [
            self::AGE_RANGE_1_12 => '1–12',
            self::AGE_RANGE_13_17 => '13–17',
            self::AGE_RANGE_18_49 => '18–49',
            self::AGE_RANGE_50_PLUS => '50+',
        ];
    }

    /**
     * @return array<string, string>
     */
    public static function genderLabels(): array
    {
        return [
            self::GENDER_MALE => 'Male',
            self::GENDER_FEMALE => 'Female',
            self::GENDER_PREFER_NOT_TO_SAY => 'Prefer not to say',
            self::GENDER_OTHER => 'Other',
        ];
    }

    /**
     * @return array<string, string>
     */
    public static function residenceLabels(): array
    {
        return [
            self::RESIDENCE_TUGUEGARAO_CITY => 'Tuguegarao City',
            self::RESIDENCE_CAGAYAN => 'Cagayan Province',
            self::RESIDENCE_PHILIPPINES => 'Other PH areas',
            self::RESIDENCE_INTERNATIONAL => 'International',
        ];
    }

    /**
     * @return array<string, string>
     */
    public static function experienceLabels(): array
    {
        return [
            self::EXPERIENCE_EXCELLENT => 'Excellent',
            self::EXPERIENCE_GOOD => 'Good',
            self::EXPERIENCE_AVERAGE => 'Average',
            self::EXPERIENCE_POOR => 'Poor',
            self::EXPERIENCE_BAD => 'Bad',
        ];
    }

    public function visitorName(): string
    {
        return filled($this->name) ? $this->name : 'Anonymous';
    }

    public function ageRangeLabel(): ?string
    {
        return $this->age_range !== null
            ? (self::ageRangeLabels()[$this->age_range] ?? $this->age_range)
            : null;
    }

    public function genderLabel(): ?string
    {
        if ($this->gender === null) {
            return null;
        }

        $label = self::genderLabels()[$this->gender] ?? $this->gender;

        if ($this->gender === self::GENDER_OTHER && filled($this->gender_other)) {
            return "{$label} ({$this->gender_other})";
        }

        return $label;
    }

    public function residenceLabel(): ?string
    {
        if ($this->residence_type === null) {
            return null;
        }

        $label = self::residenceLabels()[$this->residence_type] ?? $this->residence_type;

        if (filled($this->residence_detail)) {
            return "{$label} — {$this->residence_detail}";
        }

        return $label;
    }

    public function experienceLabel(): ?string
    {
        return $this->overall_experience !== null
            ? (self::experienceLabels()[$this->overall_experience] ?? $this->overall_experience)
            : null;
    }

    public function experienceScore(): ?int
    {
        return $this->overall_experience !== null
            ? (self::experienceScores()[$this->overall_experience] ?? null)
            : null;
    }

    /**
     * Average experience score on a 1–5 scale for the given query.
     */
    public static function averageExperienceScore(?Builder $query = null): ?float
    {
        $query = ($query ?? static::query())->whereNotNull('overall_experience');

        $case = collect(static::experienceScores())
            ->map(fn (int $score, string $experience): string => "WHEN '{$experience}' THEN {$score}")
            ->implode(' ');

        $average = $query
            ->selectRaw("AVG(CASE overall_experience {$case} END) as average_score")
            ->value('average_score');

        return $average !== null ? round((float) $average, 1) : null;
    }
}
