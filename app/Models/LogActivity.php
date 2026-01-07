<?php

namespace App\Models\LogActivity;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\LogActivity as LogActivityModel;



class LogActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject', 'url', 'method', 'ip', 'agent', 'user_id'
    ];

    public static function addToLog($subject)
    {
        $log = [];
        $log['subject'] = $subject;
        $log['url'] = Request::fullUrl();
        $log['method'] = Request::method();
        $log['ip'] = Request::ip();
        $log['agent'] = Request::header('user-agent');
        $log['user_id'] = auth()->check() ? auth()->user()->id : 1;
        LogActivityModel::create($log);
    }


    public static function logActivityLists()
    {
        return LogActivityModel::latest()->get();
    }
}