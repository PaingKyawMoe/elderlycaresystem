<?php
// app/services/AppointmentService.php

require_once __DIR__ . '/../repositories/AppointmentRepository.php';

class AppointmentService
{
    private $appointmentRepository;

    public function __construct(AppointmentRepositoryInterface $appointmentRepository)
    {
        $this->appointmentRepository = $appointmentRepository;
    }

    public function listAppointments(): array
    {
        return $this->appointmentRepository->getAll();
    }

    public function checkAppointment(string $name, string $dob, string $phone): ?array
    {
        return $this->appointmentRepository->findByNameDobPhone($name, $dob, $phone);
    }

    public function createAppointment(array $data): array
    {
        $existing = $this->checkAppointment($data['name'], $data['dob'], $data['phone']);
        if ($existing) {
            return ['success' => false, 'message' => 'You already have an existing appointment.'];
        }

        // Clean data array to expected keys only
        $appointmentData = [
            'name' => $data['name'],
            'dob' => $data['dob'],
            'phone' => $data['phone'],
            'address' => $data['address'] ?? '',
            'gender' => $data['gender'] ?? '',
            'preferred_date' => $data['preferred_date'] ?? '',
            'appointment_type' => $data['appointment_type'] ?? '',
            'preferred_time' => $data['preferred_time'] ?? '',
            'selectDoctor' => $data['selectDoctor'] ?? '',
            'reasonForAppointment' => $data['reasonForAppointment'] ?? '',
            'photo' => $data['photo'] ?? null,
        ];

        $id = $this->appointmentRepository->create($appointmentData);

        return [
            'success' => (bool)$id,
            'message' => $id ? 'Appointment created successfully!' : 'Failed to create appointment.'
        ];
    }

    public function updateAppointment(int $id, array $data): bool
    {
        
        $allowedFields = [
            'name',
            'phone',
            'dob',
            'gender',
            'address',
            'preferred_date',
            'preferred_time',
            'appointment_type',
            'selectDoctor',
            'reasonForAppointment',
            'photo'
        ];
        $updateData = array_intersect_key($data, array_flip($allowedFields));

        $success = $this->appointmentRepository->update($id, $updateData);

        if (!$success) {
            // Throw exception to inform caller
            throw new Exception("Failed to update appointment.");
        }

        return $success;
    }


    public function deleteAppointment(int $id): bool
    {
        return $this->appointmentRepository->delete($id);
    }
}
