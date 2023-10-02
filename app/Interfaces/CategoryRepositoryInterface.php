<?php

namespace App\Interfaces;

interface CategoryRepositoryInterface
{
    public function getAllCategories($scope);
    public function getPublishCategories($scope, $page, $list);
    public function getPublishCategoriesByIds($scope,$ids ,$page, $list);
    public function getPaginateCategories($data,$scope);
    public function getCategoryById($categoryId);
    public function deleteCategory($categoryId);
    public function createCategory($categoryDetails);
    public function updateCategory($categoryId, $newDetails);
    public function getCategoryBySlug($categorySlug);
    public function getCount($scope);
}