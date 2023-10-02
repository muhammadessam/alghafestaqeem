<?php

namespace App\Interfaces\Evaluation;

interface CompanyRepositoryInterface
{
    public function getAllCompanies();
    public function getPublishCompanies( $page, $list);
    public function getPaginateCompanies($data,);
    public function getCompanyById($companyId);
    public function deleteCompany($companyId);
    public function createCompany($companyDetails);
    public function updateCompany($companyId, $newDetails);
    public function getCompanyBySlug($companySlug);
    public function getCount();
}