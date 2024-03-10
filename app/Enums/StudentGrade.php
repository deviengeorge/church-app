<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum StudentGrade: string implements HasLabel
{
    case BABY_CLASS_1 = "baby_class_1";
    case BABY_CLASS_2 = "baby_class_2";

    // Primary Stage
    case KG1 = "kg1";
    case KG2 = "kg2";

    // Primary Stage
    case G1 = "g1";
    case G2 = "g2";
    case G3 = "g3";
    case G4 = "g4";
    case G5 = "g5";
    case G6 = "g6";

    // Secondary Stage
    case G7 = "g7";
    case G8 = "g8";
    case G9 = "g9";

    // High School Stage
    case G10 = "g10";
    case G11 = "g11";
    case G12 = "g12";

    public function getLabel(): ?string
    {
        return match ($this) {
            self::BABY_CLASS_1 => __("enums.student_grade.baby_class_1"),
            self::BABY_CLASS_2 => __("enums.student_grade.baby_class_2"),
            self::KG1 => __("enums.student_grade.kg1"),
            self::KG2 => __("enums.student_grade.kg2"),
            self::G1 => __("enums.student_grade.g1"),
            self::G2 => __("enums.student_grade.g2"),
            self::G3 => __("enums.student_grade.g3"),
            self::G4 => __("enums.student_grade.g4"),
            self::G5 => __("enums.student_grade.g5"),
            self::G6 => __("enums.student_grade.g6"),
            self::G7 => __("enums.student_grade.g7"),
            self::G8 => __("enums.student_grade.g8"),
            self::G9 => __("enums.student_grade.g9"),
            self::G10 => __("enums.student_grade.g10"),
            self::G11 => __("enums.student_grade.g11"),
            self::G12 => __("enums.student_grade.g12"),
        };
    }
}
