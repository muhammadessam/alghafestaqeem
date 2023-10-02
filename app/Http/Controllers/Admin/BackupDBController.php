<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Permission\Role;
use App\Http\Requests\AdminRequest;
use App\Http\Controllers\Controller;
use App\Interfaces\AdminRepositoryInterface;
use Alert;
use Artisan;
use Log;
use Storage;

class BackupDBController extends Controller
{
    private AdminRepositoryInterface $adminRepository;
    private $path = 'admins';

    public function __construct(AdminRepositoryInterface $adminRepository)
    {
        $this->middleware('auth');
        
    }
    
     public function our_backup_database(){
         //return "test";
                 Artisan::call('backup:clean');


        Artisan::call('backup:run');
                    $output = Artisan::output();

     $path = storage_path('app/alghafestaqeem/*');
     $latest_ctime = 0;
     $latest_filename = '';
     $files = glob($path);
     foreach($files as $file)
     {
             if (is_file($file) && filectime($file) > $latest_ctime)
             {
                     $latest_ctime = filectime($file);
                     $latest_filename = $file;
                     
             }
     }
     return response()->download($latest_filename);



}

public function backup_database()
{
    return view('admin.backup');
}
}
