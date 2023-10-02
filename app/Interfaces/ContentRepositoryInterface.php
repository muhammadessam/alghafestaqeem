<?php

namespace App\Interfaces;

interface ContentRepositoryInterface
{
    public function getAllContents($scope);
    public function getPublishContents($scope, $page, $list);
    public function getPublishContentsByIds($scope,$ids ,$page, $list);
    public function getPaginateContents($data,$scope);
    public function getContentById($contentId);
    public function deleteContent($contentId);
    public function createContent($contentDetails);
    public function updateContent($contentId, $newDetails);
    public function getContentBySlug($contentSlug);
    public function getCount($scope);
}