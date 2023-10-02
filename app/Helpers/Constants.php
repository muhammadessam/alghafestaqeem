<?php

namespace App\Helpers;

final class Constants
{
    
    public const PendingRequest = 0;
    public const InReviewRequest = 1;
    public const ContactedRequest = 2;
    public const RefusedRequest = 3;

    public const ServiceType = 0;
    public const AboutType = 1;
    public const ClientType = 2;
    public const ObjectiveType = 3;
    public const CounterType = 4;
    public const CompanyServiceType = 5;
    public const CompanyType = 6;
    

    public const ApartmentGoal =0;
    public const ApartmentType =1;
    public const ApartmentEntity =2;
    public const ApartmentUsage =3;
    public const CityType = 4;

    public const  NewRequest  =0;
    public const  NewWorkRequest  =1;
    public const  SuspendedRequest  =2;
    public const  CheckedRequest  =3;

    /*
     * جديد
    بانتظار الدفع
    قيد التقييم
    تم التقييم
    ملغى
     */


    public const Statuses = [
        [
            'id' => 0,
            'title' => 'NewRequest',
        ],
        [
            'id' => 1,
            'title' =>  'NewWorkRequest',
        ],
        [
            'id' => 2,
            'title' => 'InEvaluationRequest',
        ],
        [
            'id' => 3,
            'title' => 'CheckedRequest',
        ],
        [
            'id' => 4,
            'title' => 'SuspendedRequest',
        ],
    ];

/**
      * معلقة - تم التواصل -  جاري العمل عليها - المعاينه -مكتمله
      */
    public const TransactionStatuses = [
        [
            'id' => 0,
            'title' => 'NewTransaction',
        ],
        [
            'id' => 5,
            'title' => 'PendingRequest',
        ],
        [
            'id' => 1,
            'title' =>  'InReviewRequest',
        ],
        [
            'id' => 2,
            'title' => 'ContactedRequest',
        ],
        [
            'id' => 3,
            'title' => 'ReviewedRequest',
        ],

        [
            'id' => 4,
            'title' => 'FinishedRequest',
        ],
        [
            'id' => 6,
            'title' => 'Cancelled',
        ],
    ];


    public function getConstant($const_name)
    {
        return constant('self::' . $const_name);
    }
}