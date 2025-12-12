<?php

namespace App\Controller;

use App\Entity\Student;
use App\Entity\Classroom;
use App\Service\StudentService;
use App\Repository\StudentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class StudentController extends AbstractController
{
    public function __construct(
        private readonly StudentRepository $studentRepository,
        private readonly EntityManagerInterface $entityManager,
        private readonly StudentService $studentService
    ) { }

    #[Route('/student', name: 'app_student', methods: ['GET'])]
    public function index(): Response
    {
        $students = $this->studentRepository->findAll();

        $students = array_map(function (Student $student) {
            return $this->studentService->toArray($student);
        }, $students);

        return $this->render('student/index.html.twig', [
            'students' => $students,
        ]);
    }

    #[Route('/student/{id}', name: 'app_student_show', methods: ['GET'])]
    public function show(int $id): Response
    {
        $student = $this->studentRepository->find($id);

        return $this->render('student/details.html.twig', [
            'student' => $student
        ]);
    }

    #[Route('/student/{id}', name: 'app_student_delete', methods: ['DELETE'])]
    public function delete(int $id): Response
    {
        $student = $this->studentRepository->find($id);
        if ($student) {
            $this->entityManager->remove($student);
            $this->entityManager->flush();
        }

        return $this->json(null, Response::HTTP_NO_CONTENT);
    }

    #[Route('/student', name: 'app_student_create', methods: ['POST'])]
    public function create(): Response
    {
        $classroom = new Classroom();
        $classroom->setName('CISI');
        $classroom->setLevel(3);

        $this->entityManager->persist($classroom);

        $student = new Student();
        $student->setFullname('Abdelilah Jabri');
        $student->setDateOfBirth(new \DateTime('1997-04-09'));
        $student->setClassroom($classroom);

        $this->entityManager->persist($student);

        $this->entityManager->flush();

        return $this->json($student, Response::HTTP_CREATED);
    }

    #[Route('/student/{id}', name: 'app_student_edit', methods: ['PUT'])]
    public function edit(int $id): Response
    {
        $student = $this->studentRepository->find($id);
        if (!$student) {
            return $this->json(['message' => 'Student not found'], Response::HTTP_NOT_FOUND);
        }

        $student->setFullname('Amine Jabri');

        $this->entityManager->flush();

        return $this->json($this->studentService->toArray($student));
    }
}
