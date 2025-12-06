<?php

namespace App\Service;

use App\Entity\Student;

class StudentService
{

    public function toArray(Student $student): array
    {
        return [
            'id' => $student->getId(),
            'fullname' => $student->getFullname(),
            'dateOfBirth' => $student->getDateOfBirth()->format('Y-m-d'),
            'classroom' => $student->getClassroom()->getName() . ' - ' . $student->getClassroom()->getLevel(),
        ];
    }
}
