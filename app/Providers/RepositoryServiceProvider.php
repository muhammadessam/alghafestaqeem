<?php

namespace App\Providers;

use App\Repositories\RoleRepository;
use App\Repositories\AdminRepository;
use App\Repositories\ContentRepository;
use App\Repositories\SettingRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\CategoryRepository;
use App\Interfaces\RoleRepositoryInterface;
use App\Repositories\RateRequestRepository;
use App\Interfaces\AdminRepositoryInterface;
use App\Interfaces\ContentRepositoryInterface;
use App\Interfaces\SettingRepositoryInterface;
use App\Interfaces\CategoryRepositoryInterface;
use App\Interfaces\RateRequestRepositoryInterface;
use App\Repositories\Evaluation\CompanyRepository;
use App\Repositories\Evaluation\EmployeeRepository;
use App\Repositories\Evaluation\TransactionRepository;
use App\Interfaces\Evaluation\CompanyRepositoryInterface;
use App\Interfaces\Evaluation\EmployeeRepositoryInterface;
use App\Interfaces\Evaluation\TransactionRepositoryInterface;


class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind(ContentRepositoryInterface::class, ContentRepository::class);
        $this->app->bind(SettingRepositoryInterface::class, SettingRepository::class);
        $this->app->bind(RateRequestRepositoryInterface::class, RateRequestRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(CompanyRepositoryInterface::class, CompanyRepository::class);
        $this->app->bind(EmployeeRepositoryInterface::class, EmployeeRepository::class);
        $this->app->bind(TransactionRepositoryInterface::class, TransactionRepository::class);
        $this->app->bind(RoleRepositoryInterface::class, RoleRepository::class);
        $this->app->bind(AdminRepositoryInterface::class, AdminRepository::class);


    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
