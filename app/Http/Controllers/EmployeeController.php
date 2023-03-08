<?php

namespace App\Http\Controllers;
use Response;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Models\Assignproject;
use App\Models\Project;
use App\Models\Task;
use App\Models\Time_log;
use App\Models\Monthly_time;
use App\Models\Notice;
use App\Models\Notification;
use Session;
use DateTime;
use DatePeriod;
use DateInterval;
use Carbon;
use Auth;




class EmployeeController extends Controller{
    
    
    public function empDashboard(){
       

        $emp_id=session('status')->id;
     
        $current_date= date('Y-m-d');
        
        $time_log=time_log::where('user_id',$emp_id)->where('end_time',Null)->where('start_date',$current_date)->first();
        $ho=0;
        $mi=0;
        $se=0;
        $current_time = date('H:i:s');
        if($time_log!=null){
            $hoursworked="0 Hours 0 Minutes 0 Sec ";
            $s=0;
            $m=0;
            $h=0;
            $sec=0; 
            $min=0;
            $hou=0;
            
            if($time_log->end_time==null){
                $start_time=DateTime::createFromFormat('H:i:s',$time_log->start_time);
                $current_time=DateTime::createFromFormat('H:i:s',$current_time);
                $s=intval(round(($current_time->format('U') - $start_time->format('U'))));
                if($s>=60){
                    $m=intval($s/60);
                    $s=$s-($m*60);
                }
                if($m>=60){
                    $h=intval($m/60);
                    $m=$m-($h*60);
                }
                $hoursworked=$h." Hours ".$m." Minutes ".$s." Sec ";
            }
            $hours[]=$hoursworked;
            $hou=$hou+$h;
            $min=$min+$m;
            $sec=$sec+$s;            
            //seconds convert into minutes
            $min  =$min+floor($sec/60);
            $sec= $sec % 60;
            //minutes convert into hours
            $hou  =$hou+floor($min/60);
            $min= $min % 60;
            // dd($total);
            $ho=$hou;
            $mi=$min;
            $se=$sec;     
        }
        
        
        $totalab=array();
        $keys=array('hou','min','sec');
        $task= DB::table('tasks')->where('empolyee_id',$emp_id)->get();
        // dd($task);
            foreach ($task as $t) {
                $hours=array();
                $hoursworked="0:0:0";
                $s=0;
                $m=0;
                $h=0;
                $i=0;
                $sec=0; 
                $min=0;
                $hou=0;
                $views=time_log::where('t_id',$t->task_id)->whereMonth('start_date', date('m'))->get();
                // ->where('start_date',Carbon::format('m'))->get();
                if($views!=null){
                    foreach ($views as $view) {
                        $hoursworked="0 Hours 0 Minutes 0 Sec ";
                        $s=0;
                        $m=0;
                        $h=0;
                        if($view->end_time!=null){
                            $start_time=DateTime::createFromFormat('H:i:s',$view->start_time);
                            $end_time=DateTime::createFromFormat('H:i:s',$view->end_time);
                            $s=intval(round(($end_time->format('U') - $start_time->format('U'))));
                            if($s>=60){
                                $m=intval($s/60);
                                $s=$s-($m*60);
                            }
                            if($m>=60){
                                $h=intval($m/60);
                                $m=$m-($h*60);
                            }
                            $hoursworked=$h." Hours ".$m." Minutes ".$s." Sec ";
                        }
                        $hours[]=$hoursworked;
                        $hou=$hou+$h;
                        $min=$min+$m;
                        $sec=$sec+$s;
                        // //seconds convert into minutes
                        // $min  =$min+floor($sec/60);
                        // $sec= $sec % 60;
                        // //minutes convert into hours
                        // $hou  =$hou+floor($min/60);
                        // $min= $min % 60;      
                    }
                }
                array_push($totalab,array_combine($keys,[$hou,$min,$sec]));
            } 
            // dd($totalab);

        // calculate time of rejected tasks 
        $sece=0; 
        $mint=0;
        $hour=0;
        
        $reject=array();
        $keys=array('hour','mint','sece');
        $task= DB::table('tasks')->where('empolyee_id',$emp_id)->where('task_status',3)->get();
        $total="0 Hours 0 Minutes 0 Sec "; 
            foreach ($task as $t) {
                $hours=array();
                $hoursworked="0:0:0";
                $s=0;
                $m=0;
                $h=0;
                $i=0;
                $sece=0; 
                $mint=0;
                $hour=0;
                $views=time_log::where('t_id',$t->task_id)->whereMonth('start_date', date('m'))->get();
                // ->where('start_date',Carbon::format('m'))->get();
                if($views!=null){
                    foreach ($views as $view) {
                        $hoursworked="0 Hours 0 Minutes 0 Sec ";
                        $s=0;
                        $m=0;
                        $h=0;
                        if($view->end_time!=null){
                            $start_time=DateTime::createFromFormat('H:i:s',$view->start_time);
                            $end_time=DateTime::createFromFormat('H:i:s',$view->end_time);
                            $s=intval(round(($end_time->format('U') - $start_time->format('U'))));
                            if($s>=60){
                                $m=intval($s/60);
                                $s=$s-($m*60);
                            }
                            if($m>=60){
                                $h=intval($m/60);
                                $m=$m-($h*60);
                            }
                            $hoursworked=$h." Hours ".$m." Minutes ".$s." Sec ";
                        }
                        $hours[]=$hoursworked;
                        $hour=$hour+$h;
                        $mint=$mint+$m;
                        $sece=$sece+$s;

                        // //seconds convert into minutes
                        // $min  =$min+floor($sec/60);
                        // $sec= $sec % 60;
                        // //minutes convert into hours
                        // $hou  =$hou+floor($min/60);
                        // $min= $min % 60;      
                    }
                }
                array_push($reject,array_combine($keys,[$hour,$mint,$sece]));
            }   
        // dd($reject);  
     
        
        //save the pervious month total time of user 
        $date1=\Carbon\Carbon::now();
        $previmonth=$date1->subMonth()->format('m'); // June
        $save=Monthly_time::where('user_id',$emp_id)->whereMonth('add_date', date('m'))->first();
    
        if($save){
            
        }
        else{
            $task= DB::table('tasks')->where('empolyee_id',$emp_id)->get();
            // for calculate current month total time that spends on tasks  
            foreach ($task as $t) {
                $hours=array();
                $hoursworked="0:0:0";
                $s=0;
                $m=0;
                $h=0;
                $i=0;
                $sec=0; 
                $min=0;
                $hou=0;
                // dd($t->empolyee_id);
                $views=time_log::where('user_id',$t->empolyee_id)->whereMonth('start_date', date($previmonth))->get();
                foreach ($views as $view) {
                    if($views!=null){
                        $hoursworked="0 Hours 0 Minutes 0 Sec ";
                        $s=0;
                        $m=0;
                        $h=0;
                        if($view->end_time!=null){
                            $start_time=DateTime::createFromFormat('H:i:s',$view->start_time);
                            $end_time=DateTime::createFromFormat('H:i:s',$view->end_time);
                            $s=intval(round(($end_time->format('U') - $start_time->format('U'))));
                            if($s>=60){
                                $m=intval($s/60);
                                $s=$s-($m*60);
                            }
                            if($m>=60){
                                $h=intval($m/60);
                                $m=$m-($h*60);
                            }
                            $hoursworked=$h." Hours ".$m." Minutes ".$s." Sec ";
                        }
                        $hours[]=$hoursworked;
                        $hou=$hou+$h;
                        $min=$min+$m;
                        $sec=$sec+$s;            
                        
                    }
                }
            }   

        $task= DB::table('tasks')->where('empolyee_id',$emp_id)->where('task_status',3)->get();
        // dd($task);
        // $total="0 Hours 0 Minutes 0 Sec "; 
        foreach ($task as $t) {
            $hours=array();
            $hoursworked="0:0:0";
            $s=0;
            $m=0;
            $h=0;
            $i=0;
            $sece=0; 
            $mint=0;
            $hour=0;
            $views=time_log::where('t_id',$t->task_id)->whereMonth('start_date', date('m'))->get();
            foreach ($views as $view) {
                if($views!=null){
                    $hoursworked="0 Hours 0 Minutes 0 Sec ";
                    $s=0;
                    $m=0;
                    $h=0;
                    if($view->end_time!=null){
                        $start_time=DateTime::createFromFormat('H:i:s',$view->start_time);
                        $end_time=DateTime::createFromFormat('H:i:s',$view->end_time);
                        $s=intval(round(($end_time->format('U') - $start_time->format('U'))));
                        if($s>=60){
                            $m=intval($s/60);
                            $s=$s-($m*60);
                        }
                        if($m>=60){
                            $h=intval($m/60);
                            $m=$m-($h*60);
                        }
                        $hoursworked=$h." Hours ".$m." Minutes ".$s." Sec ";
                    }
                    $hours[]=$hoursworked;
                    $hour=$hour+$h;
                    $mint=$mint+$m;
                    $sece=$sece+$s;      
                }
            }
        }
        // dd($hour);
        if(isset($hou))
        {
        $t_hou=$hou-$hour;
        // dd($t_hou);
        $t_min=$min-$mint;
        $t_sec=$sec-$sece; 
        $t_min  =$t_min+floor($t_sec/60);
        $t_sec= $t_sec % 60;
        //minutes convert into hours
        $t_hou  =$t_hou+floor($t_min/60);
        $t_min = $t_min % 60; 
        $total1=$t_hou.":".$t_min.":".$t_sec;
        
        // dd($total1);   
        
            
            $Reg = new Monthly_time;
            $Reg->monthly_time=$total1;
            $Reg->user_id=$emp_id;
            $Reg->add_date=date('Y-m-d');
            $Reg->save();
        }
        } 
         
        
        $data1=DB::table('tasks')->where('empolyee_id',$emp_id)->get();
        $assign_p_data=DB::table('assignprojects')->where('emp_id',$emp_id)->get();
        $p_array=array();
        $keys=array('p_id','title','desc','deadline','status');
        foreach ($assign_p_data as $data) {
            
            $project_info=DB::table('projects')->where('p_id',$data->project_id)->first(); 
            array_push($p_array,array_combine($keys,[$project_info->p_id ?? '',$project_info->p_title ?? '',$project_info->p_description ?? '',$project_info->p_deadline ?? '',$data->p_status ?? '']));
        };
        
        $firstdata=Time_log::where('user_id',$emp_id)->where('end_time',NULL)->where('start_date',$current_date)->first();
        
        return view('employee.employeeDashboard',compact('firstdata','p_array','emp_id','data1','totalab','ho','mi','se','reject'));
        
    }
    
    public function employeeTask(Request $request){
        $emp_id=session('status')->id;
        $task_admin = new Task;
        $task_admin->project_id =$request->input('p_id');
        $task_admin->title=$request->input('task_name');
        $task_admin->start_date=$request->input('task_start_date');
        $task_admin->end_date=$request->input('task_end_date');
        $task_admin->empolyee_id =session('status')->id;
        $task_admin->save();
        
        return back()->with('task','Record added successfully !');
    }
    public function createTask(){
        $emp_id=session('status')->id;
        $assign_p_data=DB::table('assignprojects')->where('emp_id',$emp_id)->get();
        $p_array=array();
        $keys=array('p_id','title','desc','deadline','status');
        foreach ($assign_p_data as $data) {
            
            $project_info=DB::table('projects')->where('p_id',$data->project_id)->first(); 
            array_push($p_array,array_combine($keys,[$project_info->p_id ?? '',$project_info->p_title ?? '',$project_info->p_description ?? '',$project_info->p_deadline ?? '',$data->p_status ?? '']));
        };
        
        $project=Project::all();
        $data=Task::where('empolyee_id',session('status')->id)->get();
        
        
        
        return view('employee.createTask', compact('data','p_array'));
    }
    
    public function show_tasks($task_id){
        $edit_task = Task::find($task_id);
        return view('employee.emp_edit_task',compact('edit_task'));
    }
    
    public function UpdateTasks(Request $request){
        $edit_task = Task::find($request->task_id);
        $edit_task->title=$request->up_title;
        $edit_task->start_date=$request->up_start_date;
        $edit_task->end_date=$request->up_end_date;
        $edit_task->save();
        return redirect('createTask')->with('taskupdate','Record Updated successfully!');
    }
    
    
    public function change_status_progres($task_id){
        $edit_task = Task::find($task_id);
            
        // dd($edit_task);
        $edit_task->task_status=-1;
        $edit_task->save();
        return redirect('createTask')->with('taskupdate','Status Updated Successfully!');
        
    }
    
    public function change_status__completed($task_id){
        $edit_task = Task::find($task_id);
        $edit_task->task_status=1;
        $edit_task->save();
        return redirect('createTask')->with('taskupdate','Status Updated Successfully');
        
        
    }
    
    public function change_status_pause($task_id){
        $edit_task =Task::find($task_id);
        $edit_task->task_status=5;
        $edit_task->save();
        return redirect('createTask')->with('taskupdate','Status Updated Successfully');
    }
    
    public function change_status_approval($task_id){
        $edit_task=Task::find($task_id);
        $edit_task->task_status=4 ;
        $edit_task->save();
        return redirect('createTask')->with('Admin Approval','Status Updated Successfully');
    } 
    
    
    
    public function posttask(Request $req)
    {
        
        $data = Task::where('project_id',$req->id)->where('empolyee_id',session('status')->id)->where('task_status','-1')->get();
        
        $dataarray=array();
        $keys=array('title','task_id');
        foreach($data as $p_task){
            //array_push($dataarray,[$p_task->title],[$p_task->task_id]); 
            array_push($dataarray,array_combine($keys,[$p_task->title ,$p_task->task_id]));     
        }
        
        return response()->json([
            'dataarray'=>$dataarray,
        ],200);
        
        // return Response()->json($data);
    }
    
    public function assignProject(){
        
        $emp_id=session('status')->id;
        $assign_p_data=DB::table('assignprojects')->where('emp_id',$emp_id)->get();
        $p_array=array();
        $keys=array('p_id','title','desc','deadline','status');
        foreach ($assign_p_data as $data) {
            
            $project_info=DB::table('projects')->where('p_id',$data->project_id)->first(); 
            array_push($p_array,array_combine($keys,[$project_info->p_id,$project_info->p_title,$project_info->p_description,$project_info->p_deadline,$data->p_status]));
        };
        return view('employee.assignProject',compact('p_array','emp_id'));   
        
    }
    
    
    
    public function addtask(Request $request)
    {
        $emp_id=session('status')->id;
        $p_id=$request->input('p_id');
        $t_id=$request->input('t_id');
        $current_date = date('Y-m-d');
        $current_time = date('H:i:s');
        
        $add=Time_log::create([
            'user_id'=>$emp_id,
            'p_id'=>$p_id,
            't_id'=>$t_id,
            'start_date'=>$current_date,
            'start_time'=>$current_time,
        ]);
        //return back()->with('message','Task started');
        return response()->json([
            'id'=>$add->id,
            'message'=>'Task started',
        ],200);
        
    }
    
    public function completetask(Request $request,$id)
    {  
        
        $end_time = date('H:i:s');
        $data=Time_log::where('id',$id)->where('end_time',Null)->first();
        $data->end_time=$end_time;
        
        $data->save();
        return back()->with('message',"Your task has been successfully completed");
    }
    
    //User profile
    public function Userprofile()
    {
        $emp_id=session('status')->id;
        $data=DB::table('users')->where('id',$emp_id)->first();
        return view('employee.userprofile',compact('data'));
        
    }
    
    public function updateprofile(Request $request)
    {   
        $data= User::find($request->input('id'));
        $data->user_name=$request->input('user_name');
        $data->phone=$request->input('phone');
        if($request->input('password')==NULL){
            $data->password=$data->password;
        }else{
            $data->password=md5($request->input('password'));
        }
        
        if($request->hasfile('image')){
            $destination='public/userprofile/' .$data->image;
            if(File::exists($destination))
            {
                File::delete($destination);
            }
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('public/userprofile/', $filename);
            $data->image= $filename;
        }
        $data->update();
        session()->pull('user');
        return redirect('/')->with('error','Successfully Logout!');
    }

    //function for emp show notice
    public function show_emp_notice(){
        $Notice_emp = Notice::where('desiniation','=','Empolyee')->get();
        return view('employee.Emp_notice_board',compact('Notice_emp'));
    }


    //route for notification
    public function fetch_notice(){
        $get_notification=Notification::where('user_id',session('status')->id)->get();
        //dd($get_notification);
        
        return response()->json([
            'notification'=>$get_notification,
        ]);
       
    }
    
}


?>
