<?php

namespace App\Interfaces\Evaluation;

interface EmployeeRepositoryInterface
{
    public function getAllEmployees();
    public function getPublishEmployees( $page, $list);
    public function getPaginateEmployees($data,);
    public function getEmployeeById($employeeId);
    public function deleteEmployee($employeeId);
    public function createEmployee($employeeDetails);
    public function updateEmployee($employeeId, $newDetails);
    public function getEmployeeBySlug($employeeSlug);
    public function getCount();
}
