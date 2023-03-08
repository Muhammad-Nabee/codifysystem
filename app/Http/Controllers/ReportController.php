<?php

namespace App\Http\Controllers;
use Response;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Assignproject;
use App\Models\Project;
use App\Models\Task;
use App\Models\Time_log;
use App\Models\Salary;
use App\Models\Salary_deduction;
use Session;
use DateTime;
use DatePeriod;
use DateInterval;
use Carbon\Carbon;
use Mail;




class ReportController extends Controller{ 
    
    
    public function report(){
        $user_total_time=array();
        $keys=array('name','id','total');
        $employe=User::where('role_id','2')->get(); 
        foreach ($employe as $user) {
            $task= Task::where('empolyee_id',$user->id)->get();
            $total="0 Hours 0 Minutes 0 Sec ";
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
                $views=time_log::where('user_id',$t->empolyee_id)->whereMonth('start_date', date('m'))->get();
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
                        //seconds convert into minutes
                        $min  =$min+floor($sec/60);
                        $sec= $sec % 60;
                        //minutes convert into hours
                        $hou  =$hou+floor($min/60);
                        $min= $min % 60;
                        // dd($total);
                        $total=$hou." Hours ".$min." Minutes ".$sec." Sec ";
                    }
                }
            }
            array_push($user_total_time,array_combine($keys,[$user->user_name,$user->id,$total]));            
        }
        return view('employee.employeshow',compact('user_total_time'));
    }
      
    
    public function test($id){
        $user_total=array();
        $keys=array('p_title','title','task_id','task_status','total');
       
            $task= DB::table('users')->join('tasks','users.id','=','tasks.empolyee_id')->join('projects','tasks.project_id','=','projects.p_id')
            ->where('empolyee_id',$id)->get();
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
                $total="0 Hours 0 Minutes 0 Sec ";
                $views=time_log::where('t_id',$t->task_id)->get();
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

                        //seconds convert into minutes
                        $min  =$min+floor($sec/60);
                        $sec= $sec % 60;
                        //minutes convert into hours
                        $hou  =$hou+floor($min/60);
                        $min= $min % 60;
                        $total=$hou." Hours ".$min." Minutes ".$sec." Sec ";
                    }
                }
                array_push($user_total,array_combine($keys,[$t->p_title,$t->title,$t->task_id,$t->task_status,$total]));
            }
            // dd($user_total);
        
        return view('employee.Show_assign_task',compact('user_total'));
    }
    
    
    public function time_log($task_id){
        $time= DB::table('tasks')->join('time_log','tasks.task_id','=','t_id')
        ->select('tasks.title as title','time_log.start_date as start_date','time_log.end_date as end_date','time_log.start_time as start_time','time_log.end_time as end_time')
        ->where('t_id',$task_id)->get();
        //calculate starting and ending time difference
        $hours=array();
        $hoursworked="0:0:0";
        $s=0;
        $m=0;
        $h=0;
        $i=0;
        $sec=0;
        $min=0;
        $hou=0;
        $total="0 Hours 0 Minutes 0 Sec ";
        $views=time_log::where('t_id',$task_id)->get();
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
                
                //seconds convert into minutes
                $min  =$min+floor($sec/60);
                $sec= $sec % 60;
                //minutes convert into hours
                $hou  =$hou+floor($min/60);
                $min= $min % 60;
                $total=$hou." Hours ".$min." Minutes ".$sec." Sec ";
            }
            return view('employee.Time_log',compact('time','hours','i'));
        }
    }

    public function Emp_time_log(){ 
        $emp_id=session('status')->id;
        $time= DB::table('tasks')->join('time_log','tasks.task_id','=','t_id')
        ->select('tasks.title as title','time_log.start_date as start_date','time_log.start_time as start_time','time_log.end_time as end_time')
        ->where('user_id',$emp_id)->get();
        //calculate starting and ending time difference
        $hours=array();
        $hoursworked="0:0:0";
        $s=0;
        $m=0;
        $h=0;
        $i=0;
        $sec=0;
        $min=0;
        $hou=0;
        $total="0 Hours 0 Minutes 0 Sec ";
        $views=time_log::where('user_id',$emp_id)->get();
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
                
                //seconds convert into minutes
                $min  =$min+floor($sec/60);
                $sec= $sec % 60;
                //minutes convert into hours
                $hou  =$hou+floor($min/60);
                $min= $min % 60;
                $total=$hou." Hours ".$min." Minutes ".$sec." Sec ";
            }
        }
        return view('employee.Emp_time_log',compact('time','hours','i','total'));
    }
    






    
    public function today_task(){ 
        $current_date= date('Y-m-d');
        $user=array();
        $keys=array('user_name','title','start_date','start_time','end_time','total');
       
            $task= DB::table('users')->join('tasks','users.id','=','tasks.empolyee_id')->join('time_log','tasks.task_id','=','time_log.t_id')
            ->where('time_log.start_date',$current_date)->get();
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
                $total="0 Hours 0 Minutes 0 Sec ";
                $views=time_log::where('user_id',$t->user_id)->where('t_id',$t->task_id)->where('start_date',$current_date)->get();
                // ->where('start_date',Carbon::format('m'))->get();
                // dd($views);
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
                        
                        //seconds convert into minutes
                        $min  =$min+floor($sec/60);
                        $sec= $sec % 60;
                        //minutes convert into hours
                        $hou  =$hou+floor($min/60);
                        $min= $min % 60;
                        $total=$hou." Hours ".$min." Minutes ".$sec." Sec ";
                    }
                }
                
                array_push($user,array_combine($keys,[$t->user_name,$t->title,$t->start_date,$t->start_time,$t->end_time,$total]));
                
            }
            // dd($user);
        
        return view('employee.today_task',compact('user'));

    }










    public function emp_view(Request $request,$id){
        $user=User::where('id',$id)->first(); 
        // dd($ok);
        if($user){
        if($user->id==$id){ 
              $request->session()->put('status',$user);
            return redirect()->action([EmployeeController::class,'empDashboard']);
        }
        else{
            dd("hello");
            // return redirect(employees);
        }}

        // $user=User::where('role_id','2')->get();
        // $stat=session('status')->id;
        // dd($id);
        // $date1=date('y');
        // $date2=date('m');
        // $date3=date('d');   
        // $date4='COD-Emp-'.$date3.'/'.$date2.'/'.$date1;
        // $cd=$user->id+1;
        // $int_no=$date4.$cd; 
        // dd($int_no); 

    }

    public function admin_approval(){
        $user_total=array();
        $keys=array('user_name','title','task_id','task_status','start_date','total');
       
            $task= DB::table('users')->join('tasks','users.id','=','tasks.empolyee_id')
            ->where('task_status',4)->get();
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
                $total="0 Hours 0 Minutes 0 Sec ";
                $views=time_log::where('user_id',$t->empolyee_id)->where('t_id',$t->task_id)->get();
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

                        //seconds convert into minutes
                        $min  =$min+floor($sec/60);
                        $sec= $sec % 60;
                        //minutes convert into hours
                        $hou  =$hou+floor($min/60);
                        $min= $min % 60;
                        $total=$hou." Hours ".$min." Minutes ".$sec." Sec ";
                    }
                }
                array_push($user_total,array_combine($keys,[$t->user_name,$t->title,$t->task_id,$t->task_status,$t->start_date,$total]));
            }
            // dd($user_total);
        
        return view('admin.admin_approval',compact('user_total'));
    }
    public function change__status_completed($task_id){
        
        
        $edit_task = Task::find($task_id);
        $edit_task->task_status=1;
        $edit_task->save();
        return redirect('admin_approval')->with('taskupdate','Status Updated Successfully');
 
    }
    public function change__status_rejected($task_id){
        $edit_task=Task::find($task_id);
        $edit_task->task_status=3;
        $edit_task->save();
        return redirect('admin_approval')->with('status-rejected','Status Rejected Successfully');
    }
    public function Salary(){
        $total_time=array();
        $keys=array('user_name','id','total','sal_status');
        $employe=User::where('role_id','2')->get(); 
        foreach ($employe as $user) {
            $task= Task::where('empolyee_id',$user->id)->get();
            $total="0 Hours 0 Minutes 0 Sec ";
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
                $views=time_log::where('user_id',$t->empolyee_id)->whereMonth('start_date', date('m'))->get();
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
                        //seconds convert into minutes
                        $min  =$min+floor($sec/60);
                        $sec= $sec % 60;
                        //minutes convert into hours
                        $hou  =$hou+floor($min/60);
                        $min= $min % 60;
                        // dd($total);
                        $total=$hou." Hours ".$min." Minutes ".$sec." Sec ";
                    }
                }
            }
            array_push($total_time,array_combine($keys,[$user->user_name,$user->id,$total,$user->sal_status]));            
        }
        return view('admin.Salary',compact('total_time'));   
    }
    public function gen_sal($id){    
        $id=$id;
        // calculate time of rejected tasks 
        $sece=0; 
        $mint=0;
        $hour=0;
        
        $reject=array();
        $keys=array('hour','mint','sece','title','task_status','total');
        $task= DB::table('tasks')->where('empolyee_id',$id)->where('task_status',3)->whereMonth('start_date', date('m'))->get();
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
                        $hour=$hour+$h;
                        $mint=$mint+$m;
                        $sece=$sece+$s;
                        $hou=$hou+$h;
                        $min=$min+$m;
                        $sec=$sec+$s;

                        //seconds convert into minutes
                        $min  =$min+floor($sec/60);
                        $sec= $sec % 60;
                        //minutes convert into hours
                        $hou  =$hou+floor($min/60);
                        $min= $min % 60;  
                        $total=$hou." Hours ".$min." Minutes ".$sec." Sec ";
                    }
                }
                array_push($reject,array_combine($keys,[$hour,$mint,$sece,$t->title,$t->task_status,$total]));
            }
            // dd($reject);
            return view('admin.generate_salary',compact('reject','id')); 
        }
    public function sal_gen($id){ 
         
        $id=$id;
        $user=User::where('id',$id)->first();
        // dd($user);
        $totalab=array();
        $keys=array('hou','min','sec');
        $task= DB::table('tasks')->where('empolyee_id',$id)->get();
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
        $keys=array('hour','mint','sece','title','task_status','total');
        $task= DB::table('tasks')->where('empolyee_id',$id)->where('task_status',3)->get();
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
                        $hour=$hour+$h;
                        $mint=$mint+$m;
                        $sece=$sece+$s;
                        $hou=$hou+$h;
                        $min=$min+$m;
                        $sec=$sec+$s;

                        //seconds convert into minutes
                        $min  =$min+floor($sec/60);
                        $sec= $sec % 60;
                        //minutes convert into hours
                        $hou  =$hou+floor($min/60);
                        $min= $min % 60;  
                        $total=$hou." Hours ".$min." Minutes ".$sec." Sec ";
                    }
                }
                array_push($reject,array_combine($keys,[$hour,$mint,$sece,$t->title,$t->task_status,$total]));
            }
            // dd($reject);
            return view('admin.salary_gen',compact('totalab','reject','id','user')); 
        }   
        
        public function sal_save(Request $request,$id){
            // dd($request->all);
            $save=salary::where('user_id',$id)->whereMonth('date', date('m'))->first();
            if($save){
                
                // dd($save);
                return redirect('Salary')->with('already_generate','Salary Already Generated');
            }
            else{
                $salary=new Salary;
                $salary->user_id=$request->user_id;
                $salary->total_time=$request->total_time;
                $salary->date=date('Y-m-d');   
                
                $salary->save();
                $pay_id=Salary::orderBy('pay_id','DESC')->first();
                // // dd($user);
                if($request->product[0]!=null)
                {
                    $item =count($request->product);
                    // dd($item);
                    for ($i=0; $i <$item ; $i++) { 
                        $sal=new Salary_deduction;
                        $sal->product=$request->product[$i];
                        $sal->price=$request->price[$i];
                        $sal->pay_id=$pay_id->pay_id;
                        $sal->save();
                    }
                }
                $pay=Salary::orderBy('pay_id','DESC')->first();
                $pay->deduct=$request->sumtotal;
                $pay->salary=$request->totalamount;
                $pay->save();
                $users=User::where('id',$id)->first();
                if(isset($request->check))
                {
                    $pay=Salary::where('user_id',$id)->whereMonth('date', date('m'))->get(); 
                    $user=User::where('id',$id)->get();
                    $t_task=Task::where('empolyee_id',$id)->whereMonth('start_date', date('m'))->count();
                    $r_task=Task::where('empolyee_id',$id)->where('task_status','3')->whereMonth('start_date', date('m'))->count();
                    $sal= DB::table('salarys')->join('salary_deductions','salarys.pay_id','=','salary_deductions.pay_id')
                    ->where('user_id',$id)->whereMonth('date', date('m'))->get(); 
                    
                    $salary=[
                        'id'=>$id,
			        	'user'=>$user,
			        	't_task'=>$t_task,
			        	'r_task'=>$r_task,
			        	'sal'=>$sal,
			        	'pay'=>$pay,
			        ];
                    \Mail::to($users->email)->send(new \App\Mail\Salary_mail($salary));
                }
                return redirect('Salary')->with('sal_generate','Salary Generated Successfully');
            }
        }
        public function show_month($id){  
            $id=$id; 
            $pay=Salary::where('user_id',$id)->get();
            return view('admin.Pay_slip',compact('id','pay'));    
        }
        public function pay_slip($id,$date){ 
            $id=$id;
            $date=$date;
            // dd($m);
            $user=User::where('id',$id)->first();
            $t_task=Task::where('empolyee_id',$id)->whereMonth('start_date', date($date))->count();
            $r_task=Task::where('empolyee_id',$id)->where('task_status','3')->whereMonth('start_date', date($date))->count();
            $sal= DB::table('salarys')->join('salary_deductions','salarys.pay_id','=','salary_deductions.pay_id')
            ->where('user_id',$id)->whereMonth('date', date($date))->get(); 
            $pay=Salary::where('user_id',$id)->whereMonth('date', date($date))->first();
            // dd($pay);   
            return view('admin.Pay',compact('user','t_task','r_task','sal','pay','id','date'));    
            
        }   

        public function print_pay($id,$date){
            $user=User::where('id',$id)->first();
            $t_task=Task::where('empolyee_id',$id)->whereMonth('start_date', date($date))->count();
            $r_task=Task::where('empolyee_id',$id)->where('task_status','3')->whereMonth('start_date', date($date))->count();
            $sal= DB::table('salarys')->join('salary_deductions','salarys.pay_id','=','salary_deductions.pay_id')
            ->where('user_id',$id)->whereMonth('date', date($date))->get(); 
            $pay=Salary::where('user_id',$id)->whereMonth('date', date($date))->first();
            return view('admin.print_pay_slip',compact('user','t_task','r_task','sal','pay'));
         }

}    
   
