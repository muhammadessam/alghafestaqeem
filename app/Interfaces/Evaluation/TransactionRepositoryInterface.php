<?php

namespace App\Interfaces\Evaluation;

interface TransactionRepositoryInterface
{
    public function getAllTransactions();
    public function getPublishTransactions( $page, $list);
    public function getPaginateTransactions($data,);
    public function getTransactionById($transactionId);
    public function deleteTransaction($transactionId);
    public function createTransaction($transactionDetails);
    public function updateTransaction($transactionId, $newDetails);
    public function getTransactionBySlug($transactionSlug);
    public function getCount();
}