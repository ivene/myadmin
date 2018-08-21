<?php

namespace App\Http\Controllers;

use App\Jobs\BitZJob;
use App\Models\Base\BaseCecBitzAccount;
use App\Models\Base\BaseCecTokenChangeLog;
use App\Models\Base\BaseCecUser;
use App\Models\Base\BaseSysAdminDepartment;
use App\Models\Base\BaseSysAdminPosition;
use App\Models\Base\BaseSysAdminPower;
use App\Models\Cec\CecUser;
use App\Models\Cec\CecUserWithdrawLog;
use App\Models\Postgre\Cecs;
use App\Models\Postgre\Invite;
use App\Models\Postgre\Users;
use App\Models\SysAdminUser;
use App\Services\BitZService;
use App\Services\MessageService;
use App\Services\QrcodeService;
use App\Tools\Result;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Queue\Jobs\Job;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Oplog;
use Symfony\Component\DomCrawler\Crawler;

class MyTestController extends Controller
{
    public function test()
    {

        $list  = BaseSysAdminPosition::all();
        return response()->json($list);
    }
}
