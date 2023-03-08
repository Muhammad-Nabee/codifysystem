<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Role;
use App\Models\Assignproject;
use App\Models\Task;
use App\Models\Bank;
use App\Models\Transiction;
use App\Models\Notification;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Notice;
use Carbon\Carbon;
use Mail;
use Session;
use Auth;
use Illuminate\Support\Str;
use Illuminate\Foundation\Validation\ValidatesRequests;

class UserAuthController extends Controller
{
    //User Log In Check
    public function index(Request $request)
    {
        
        $email = $request->input('login-email');
        $password = $request->input('login-password');
        $res = User::where('email',$email)->where('password',md5($password))->first();
        if($res){
            if($res->role_id==1){
                $request->session()->put('status',$res);
                return redirect()->action([UserAuthController::class,'Dashboard']);
                
            }else if($res->role_id==2){
            $request->session()->put('status',$res);
            return redirect()->action([EmployeeController::class,'empDashboard']);
        }
        else{
            return back()->with('error','Email / Password Wrong');
        }
    }else{
        return back()->with('error','Email / Password Wrong');
    }
}

public function Dashboard(){
    $total_project =Project::all()->count();
    $total_empolyee = User::where('role_id','=','2')->count();
    $total_clients=User::where('role_id','=','3')->count();
    $total_task=Task::all()->count();
    $task_pending=Task::where('task_status','=',0)->count();
    $task_progress=Task::where('task_status','=',-1)->count();
    $task_completed=Task::where('task_status','=',1)->count();
    $task_rejected=Task::where('task_status','=',3)->count(); 
    $Admin_Approval=Task::where('task_status','=',4)->count();
    $task_Pause=Task::where('task_status','=',5)->count(); 
    return view('admin.dashboard',compact('total_project','total_empolyee','total_clients','total_task','task_pending','task_progress','task_completed','task_rejected','Admin_Approval','task_Pause'));
    
}

//ww registration form
public function show_registration_form(){
    $Role =Role::all();
    return view('Registration_user',compact('Role'));
} 

public function add_registration_form(Request $request){
    if($request->id){
        $this->validate($request, [
            'email'     => 'required|unique:users,email,'.$request->id
        ]);
    }
    $Register_user = new User;
    $Register_user->user_name=$request->user_name;
    $Register_user->email =$request->email;
    $Register_user->phone = $request->phone;
    $Register_user->password = $request->password;
    $Register_user->role_id=$request->role_id;
    //$Register_user->created_at=date('Y-m-d H:i:s');
    
    
    if($request->hasfile('image'))
    {
        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension();
        $filename=time(). '.' .$extension;
        $file->move('public/image/',$filename);
        $Register_user->image =$filename;
    }
    $Register_user->save();
    return back()->with('user_added','Record added successfully !');
    
}

public function employees(){
    /*$employees = DB::table('roles')
    ->join('users', function ($join) {
            $join->on('users.role_id', '=', 'roles.role_id')
            ->where('roles.role_id','=',2);
        })
        ->get();*/   
        //same query as above
        $employees = DB::table('roles')
        ->join('users','users.role_id','=','roles.role_id')->where('roles.role_id','=',2)->get();
        
        return view('admin.employees',compact('employees'));
    }
    
    //store employees
    public function add_employees(Request $request){
   
    	$check_email=User::where('email',$request->input('email'))->first();
			if($check_email->role_id ??''==2){
				return back()->with('check_email','Email Already Exists');

			}
			else{
				$user=User::orderBY('id','Desc')->first();
                $date1=date('y');
                $date2=date('m');
                $date3=date('d');   
                $date4='COD-Emp-'.$date3.'/'.$date2.'/'.$date1;
                $cd=$user->id+1;
                $int_no=$date4.$cd;

				$pass=str::random(6);
        	$Reg_empolyee = new User;
        	$Reg_empolyee->gen_id=$int_no;
        	$Reg_empolyee->user_name=$request->input('username');
        	$Reg_empolyee->email=$request->input('email');
        	$Reg_empolyee->phone=$request->input('contact');
        	$Reg_empolyee->salary=$request->input('salary');
        	$Reg_empolyee->sal_status=$request->input('fix');
        	$Reg_empolyee->password=md5($pass);
        	$Reg_empolyee->role_id=2;
        	$Reg_empolyee->image=null;
        	$Reg_empolyee->save();
        	$empolyee=[
                'user_name'=> $request->input('username'),
                'email'=>$request->input('email'),
                'password'=>$pass,
                
             ];
             //dd($empolyee);
             
             \Mail::to($request->input('email'))->send(new \App\Mail\Empolyee_Mail($empolyee));
             return back();
			}
            
             
            }

    public function clients(){
        $clients= DB::table('roles')
        ->join('users','users.role_id','=','roles.role_id')->where('roles.role_id','=',3)->get();
        return view('admin.clients',compact('clients'));
        
    }
    public function add_clients(Request $request){
        $Reg_clients = new User;
        $Reg_clients->user_name=$request->input('username');
        $Reg_clients->email=$request->input('email');
        $Reg_clients->phone=$request->input('contact');
        $Reg_clients->password=$request->input('password');
        $Reg_clients->role_id=3;
        $Reg_clients->image=null;
        $Reg_clients->save();
        return back();
    }
    
    
    
    
    
    
    public function session_destroy(){
        session()->pull('user');
        return redirect('/')->with('error','Successfully Logout!');
    }
    
    
    public function delete_user($id){
        $res = User::find($id)->delete();
        if($res){
            return back()->with('msg','Record Deleted');
        }else{
            return back()->with('msg','Record not Deleted');
        }
    }
    public function edit_user(Request $request){
        $id         = $request->input('id');
        $user_name  = $request->input('edit_username');
        $email      = $request->input('edit_email');
        $contact    = $request->input('edit_contact');
        $password   = $request->input('edit_password');
        $role       = $request->input('edit_role');
        $data       = User::where('id',$id)->first();
        $data->user_name    = $user_name;
        $data->email        = $email;
        $data->phone        = $contact;
        $data->password     = $password;
        $data->role_id      = $role;
        $data->save();
        if($data){
            return back()->with('msg','User Edited');
        }else{
            return back()->with('msg','User Not Edited');
        }
        
        
    }
    
    public function register_user(Request $request)
    {
        //dd($request->input());
        if(session()->get('user')){
            $user_name  = $request->input('username');
            $email      = $request->input('email');
            $contact    = $request->input('contact');
            $password   = $request->input('password');
            $role       = $request->input('role');
            $add = new user_auth();
            $add->user_name = $user_name;
            $add->email     = $email;
            $add->phone     = $contact;
            $add->password  = $password;
            $add->role_id   = $role;
            $add->save();
            
            if($add->id){
                $details = [
                    'name'=> $user_name,    
                    'email' => $email,
                    'pass' => $password
                ];
                \Mail::to($email)->send(new \App\Mail\my_mail($details));
                return back()->with('msg','Account Created');
            }else{
                return back()->with('msg','Account Not Created');
            }
        }else{
            return back()->with('error','Log in First');
        }
    }
    
    //project show to admin
    public function add_project(Request $request){
        //$assign_user=array();
        //$keys=array('user_name','id','p_title');    
        $projects = DB::table('projects')->join('assignprojects','projects.p_id','=','assignprojects.project_id')->get();
        $role_id = User::where($request->role_id)->first();
        if($role_id->role_id==1){
            $request->session()->put('status',$role_id);
        }
        $projects =Project::all();
        
        $emp = User::all();
        $emp_show =Assignproject::all();
        
        return view('admin.projects',compact('projects','emp','emp_show'));
    }
    
    
   
    
    public function projects(Request $request){
        //return $request->input();
        $student = new Project;
        $student->p_title=$request->p_title;
        $student->p_deadline=$request->p_deadline;
        $student->p_description=$request->p_description;

        $student->p_status_id =2;
        $student->save();
        return back()->with('statuss','Record added successfully !');
        
    }
    
    

    //function for show employees from table
    public function emp_store(Request $request){
        
        //dd($request->all());
        //return $request->input();
        $add_emp = new Assignproject; 
        $add_emp->emp_name=$request->emp_name;
        $add_emp->emp_deadline=$request->emp_deadline;
        $add_emp->project_id=$request->project_id;
        $add_emp->save();
        return redirect('add_project')->with('statuss','Record added successfully !');   
    }
    
    

    //add empolyee from admin side
    
    public function assigprojectnempolyee($p_id){
        //dd("good");
        $empolyee = User::where('role_id','2')->get();
        //dd($empolyee);
        $id=$p_id;
        $emp_name = array();
        $keys=array('name','image','assign_id');
        $assign_p_e= Assignproject::where('project_id',$id)->get();
        foreach($assign_p_e as $e)
        {
            
            $name=User::where('id',$e->emp_id)->first();
            array_push($emp_name,array_combine($keys,[$name->user_name ?? '',$name->image ?? '',$e->assign_id ?? '']));
            
        }
                return view('admin.assignempolyee',compact('empolyee','id','emp_name'));
    }

    public function assign_empolyee_delete($assign_id){
    	$id=$assign_id;
    	DB::delete('delete from assignprojects where assign_id = ?',[$id]);
        return back()->with('ass_emp_delete','Record Deleted successfully ');
    }
    
    //Assign Project to Employee
    public function project_assign_employee(Request $request){
        //dd("we are now going to assign project");
 
        
        $p_id=$request->project_id;
        $emp_id=$request->emp_name;
        $assign_date=$request->assign_date;
        $deadline_date=$request->deadline_date;
        $project_data=Project::where('p_id',$p_id)->first();
        
        $data=Assignproject::all()->where('emp_id',$request->emp_name);
        
        foreach($data as $check){
            if($check->project_id== $p_id){
                return back()->with('pro_assign','Project Already Assign To This Empolyee!');
        	}
        	
        }
                $assign_project = new Assignproject; 
		        $assign_project->emp_id=$emp_id;
		        $assign_project->project_id=$p_id;
		        $assign_project->assign_date=$assign_date;
		        $assign_project->assign_p_deadline=$deadline_date;
		        $assign_project->p_status=0;
		        $assign_project->save();

                //data insert into notification table
                $notification_assign =new Notification;
                $notification_assign->user_id=$emp_id;
                $notification_assign->project_id=$p_id;
                $notification_assign->status=0;
                $notification_assign->message="task assign to Empolyee";
                $notification_assign->save();

        
                return redirect('add_project')->with('statuss','Record added successfully !');
            }
            
            
            //delete project
            
            public function destroy_projects($p_id){
                DB::delete('delete from projects where p_id = ?',[$p_id]);
        		return back()->with('statusdelete','Record Deleted successfully ');
    }
    
    public function edit($p_id){
        $users = Project::find($p_id);
        return view('admin.update_project',['users'=>$users]);
        
    }
    
    public function update(Request $request){
        $users = Project::find($request->p_id);
        $users->p_title=$request->up_title;
        $users->p_description=$request->up_description;
        $users->p_deadline=$request->up_deadline;
        $users->save();
        return redirect('add_project')->with('statusupdate','Record Updated successfully!');
        
    }
    
    
    
    //show admin Tak
    public function ShowTask(Request $request){
        $projects = Project::all('p_title','p_id');
        $empolyees =User::where('role_id',2)->get();
        $pro_array=array();
        $keys=array('p_id','title');
        $created_task = DB::table('users')->join('tasks','users.id','=','tasks.empolyee_id')->orderBY('tasks.task_id','DESC')->get();
        return view('admin.ShowTask',compact('projects','empolyees','created_task'));
        
        
    }
    
    public function CreateTask(Request $request){
        //$project_id =$request->project_id;
        dd($request->all());
        $emp_id = $request->empolyee_id;
        $pro_id =$request->project_id;
        $task_admin = new Task;
        $task_admin->project_id =$request->input('project_id');
        $task_admin->title=$request->input('title');
        //   dd($task_admin->title);
        $task_admin->start_date=$request->input('start_date');
         $task_admin->end_date=$request->input('end_date');
         $task_admin->empolyee_id =$request->input('empolyee_id');
         $task_admin->task_status=0;
         $task_admin->save();
         //insert data into notification
        $Notification=new Notification;
        $Notification->user_id=$emp_id;
        $Notification->status=0;
        $Notification->message="Task Created!";
        $Notification->project_id=$pro_id;
        $Notification->save();
         return redirect('ShowTask')->with('task','Record added successfully !');
        }
        
        //method for show existing record for updation from task table
        
    public function show_task($task_id){
        $edit_task = Task::find($task_id);
        return view('admin.edit_task',compact('edit_task'));
    }
    
    public function UpdateTask(Request $request){
        $edit_task = Task::find($request->task_id);
        $edit_task->title=$request->up_title;
        $edit_task->start_date=$request->up_start_date;
        $edit_task->end_date=$request->up_end_date;
        $edit_task->save();
        return redirect('ShowTask')->with('taskupdate','Record Updated successfully!');
    }
    
    //method for delete task
    public function delete_task($task_id){
        DB::delete('delete from tasks where task_id = ?',[$task_id]);
        return back()->with('taskdeleted','Task Deleted successfully !');
    }
    
    
    
    public function TaskTitle($p_id){
        $task_id=$p_id;
        $project_task = DB::table('tasks')->where('project_id',$task_id)->get();    
        
        return view('admin.TaskTitle',compact('project_task'));
    }

    public function show_status_task(){
        return view('admin.ShowTask');
    }
    
    public function change_status_progress($task_id){
        $edit_task = Task::find($task_id);
        
        // dd($edit_task);
        $edit_task->task_status=-1;
        $edit_task->save();
        return redirect('ShowTask')->with('taskupdate','Status Updated Successfully!');
        
    }
    
    public function change_status_completed($task_id){
        $edit_task = Task::find($task_id);
        $edit_task->task_status=1;
        $edit_task->save();
        return redirect('ShowTask')->with('taskupdate','Status Updated Successfully');
        
        
    }
    
    public function change_status_pending($task_id){
        $edit_task =Task::find($task_id);
        $edit_task->task_status=0;
        $edit_task->save();
        return redirect('ShowTask')->with('taskupdate','Status Updated Successfully');
    }
    
    public function change_status_rejected($task_id,$empolyee_id,$project_id){
        $pro_id=$project_id;
        $emp_id=$empolyee_id;
        $edit_task=Task::find($task_id);
        $edit_task->task_status=3;
        $edit_task->save();
        //insert data into Notification
        $Notification=new Notification;
        $Notification->user_id=$emp_id;
        $Notification->status=0;
        $Notification->message="Task Rejected!";
        $Notification->project_id=$pro_id;
        $Notification->save();
        return redirect('ShowTask')->with('status-rejected','Status Rejected Successfully');
    }
   
    
    //function for bank transiction
    /*public function bank(){
    	return view('admin.Add_Bank');
    }
    */
    
    
    public function show_bank(){
        $Add_bank = Bank::all();
        $data =array();
        $keys = array('id','bank_name','balance');
        foreach ($Add_bank as $bank) {
            $totaladd=Transiction::where('trans_operator','+')->where('bank_id',$bank->bank_id)->sum('amount');
            $totalexpense=Transiction::where('trans_operator','-')->where('bank_id',$bank->bank_id)->sum('amount');
            $profit=$totaladd-$totalexpense;
            array_push($data,array_combine($keys,[$bank->bank_id,$bank->bank_name,$profit]));
            
        }
        
    	return view('admin.Add_Bank',compact('data'));
    }
    
    
    public function Add_bank(Request $request ){
        $Add_bank = new Bank;
    	$Add_bank->bank_name=$request->bank_name;
    	$Add_bank->status=1;
        $Add_bank->bank_balance=0;
    	$Add_bank->save();
        
        return back()->with('Added_Bank','Bank Added Successfully');
        
    }
    
    //method for transiction
    public function Show_Transiction_Form(){
        return view('admin.Add_Bank');
    }
    
    
    public function Add_Transiction(Request $request){
        
        $Add_Transiction =new Transiction;
        $Add_Transiction->bank_id = $request->bank_id;
        $Add_Transiction->trans_operator=$request->trans_operator;
        $Add_Transiction->amount=$request->amount;
        $Add_Transiction->trans_date= $request->trans_date;
        $Add_Transiction->trans_description= $request->trans_description;
        $Add_Transiction->save();
        
        return back()->with('Add_Transiction','Transiction Done Successfully');
        
    }
    //method for Balance_Sheet
    public function Balance_Sheet(Request $request,$bank_id){
        if($request->has('search'))
        {
            $from=$request->input('fdate');
            $to=$request->input('tdate'); 
            $showtranfilter=Transiction::where('bank_id',$bank_id)->whereBetween('trans_date', [$from, $to])->get();
            $totalcreditfilter=Transiction::where('bank_id',$bank_id)->where('trans_operator','+')->whereBetween('trans_date', [$from, $to])->sum('amount');
            $totaldebitfilter=Transiction::where('bank_id',$bank_id)->where('trans_operator','-')->whereBetween('trans_date', [$from, $to])->sum('amount');
            $totalbalfilter=$totalcreditfilter-$totaldebitfilter;
            return view('admin.Balance_Sheet',compact('totalcreditfilter','totaldebitfilter','totalbalfilter','showtranfilter','bank_id'));
        }
        $showtran=Transiction::where('bank_id',$bank_id)->get();
        $totalcredit=Transiction::where('bank_id',$bank_id)->where('trans_operator','+')->sum('amount');
        $totaldebit=Transiction::where('bank_id',$bank_id)->where('trans_operator','-')->sum('amount');
        $totalbal=$totalcredit-$totaldebit;
        
        return view('admin.Balance_Sheet',compact('showtran','totalcredit','totaldebit','totalbal','bank_id'));
    }

    //method for Invoice
    public function Invoice(Request $request)
    {
        $clients= DB::table('invoices')->join('users','invoices.client_id','=','users.id')->join('projects','invoices.project_id','=','projects.p_id')->
        select('invoices.project_id as p_title','projects.p_title as p_title','users.user_name as user','invoices.invoice_id as invoice_id','invoices.totalamount as totalamount','invoices.amount as amount','invoices.status as status')
        ->get();
       
       return view('admin.Invoice',compact('clients'));
    }
    
    public function show_Invoice(){
        $Get_AllProject = Project::all();
        $clients =User::where('role_id',3)->get();
        return view('admin.Create_Invoice',compact('Get_AllProject','clients'));
    }
    
    public function Store_Invoice(Request $request){

        $Invoice=new Invoice;
        $Invoice->project_id=$request->project_id;
        $Invoice->client_id=$request->client_id;
        $Invoice->description=$request->invoice_desc;
        $Invoice->discount=$request->discount;
        $Invoice->totalamount=$request->totalamount;
        $Invoice->created_at=date('Y-m-d H:i:s');
        $Invoice->save();
        $invoices_id=Invoice::orderBy('invoice_id','DESC')->first();

        $item =count($request->price);
        for ($i=0; $i <$item ; $i++) { 
            /*$request->validate([
                'item[]'=>'required',
                'quantity[]'=>'required',
                'price[]'=>'required'
            ]);*/
            $Product=new Product;
            $Product->item=$request->item[$i];
            $Product->price=$request->price[$i];
            $Product->quantity=$request->quantity[$i];
            $Product->invoices_id=$invoices_id->invoice_id;
            $Product->save();

        }

        $clients=User::where('id',$request->client_id)->first();
        //$pro_title=Project::where('p_id',$request->project_id)->first();
        //$invoices_id=Invoice::where('invoice_id',$invoices_id->invoice_id)->first();
       // dd($invoices_id);
        //dd($pro_title);
         $id =$invoices_id->invoice_id;

        $client_info=DB::table('users')->join('invoices','users.id','=','invoices.client_id')->join('projects','invoices.project_id','=','projects.p_id')->where('invoice_id','=',$id)->select('users.user_name as user_name','users.email as email','users.phone as phone','projects.p_title','invoices.created_at as created_at')->get();
        //dd($client_info);
        $show_Invoice=DB::table('invoices')->join('products','invoices.invoice_id','=','products.invoices_id')->where('invoice_id',$id)->select('products.item as item','products.price as price','products.quantity as quantity','products.invoices_id as invoices_id','products.product_id as product_id',"invoices.discount as discount")->get();
        //dd($show_Invoice);


        if(isset($request->check))
    	{
			$client=[
			        	'id'=>$id,
			        	'client_info'=>$client_info,
			        	'show_Invoice'=>$show_Invoice,
			        ];
        	\Mail::to($clients->email)->send(new \App\Mail\Client_Invoice($client));
    	}
    	
  

        


        return redirect('Invoice')->with('Store_Invoice','Added Successfully!');
       
       
    }
    
    
     public function Add_invoice($invoice_id){
        $id =$invoice_id;
        $client_info=DB::table('users')->join('invoices','users.id','=','invoices.client_id')->join('projects','invoices.project_id','=','projects.p_id')->where('invoice_id','=',$id)->select('users.user_name as user_name','users.email as email','users.phone as phone','projects.p_title','invoices.created_at as created_at')->get();
        //dd($client_info);
        $show_Invoice=DB::table('invoices')->join('products','invoices.invoice_id','=','products.invoices_id')->where('invoice_id',$id)->select('products.item as item','products.price as price','products.quantity as quantity','products.invoices_id as invoices_id','products.product_id as product_id',"invoices.discount as discount")->get();
        //dd($show_Invoice);

        
        return view('admin.invoice_pay',compact('show_Invoice','id','client_info'));
    }
    //method for print invoice
    public function invoice_print($invoice_id){
    	
    	$id =$invoice_id;
    	
        $client_info=DB::table('users')->join('invoices','users.id','=','invoices.client_id')->join('projects','invoices.project_id','=','projects.p_id')->where('invoice_id','=',$id)->select('users.user_name as user_name','users.email as email','users.phone as phone','projects.p_title','invoices.created_at as created_at')->get();
        //dd($client_info);
        $show_Invoice=DB::table('invoices')->join('products','invoices.invoice_id','=','products.invoices_id')->where('invoice_id',$id)->select('products.item as item','products.price as price','products.quantity as quantity','products.invoices_id as invoices_id','products.product_id as product_id',"invoices.discount as discount")->get();
    	return view('admin.invoice_print',compact('show_Invoice','id','client_info'));
    }

    //add and show notification
    public function Notice_Board(){
    	$Notice_show=Notice::all();
    	return view('admin.Notice_Board',compact('Notice_show'));
    }
    
    public function add_new_notice(Request $request){

    	//dd($request->input());
    	//$test= Notification::all();
    	//dd($test);
    	$Notice=new Notice;
    	$Notice->notice=$request->notice;
    	$Notice->desiniation=$request->desiniation;
    	$Notice->created_at= date('Y-m-d H:i:s');
        $Notice->updated_at= date('Y-m-d H:i:s');
    	$Notice->description=$request->description;
    	$Notice->save();

        
             //dd($empolyee);
             if($request->desiniation=='Empolyee')
             {
             	$employees=User::where('role_id','2')->get();
             }else
             {
             	$employees=User::where('role_id','3')->get();
             }
             

             foreach ($employees as $employe) {

             	$Emp_notice_mail=[
                'notice'=> $request->notice,
                'description'=>$request->description,
                'user_name'=>$employe->user_name,
                
             ];
          
             	\Mail::to($employe->email)->send(new \App\Mail\Emp_notice_mail($Emp_notice_mail));
                $employe->id;
                $Notification=new Notification;
                $Notification->user_id=$employe->id;
                $Notification->status=0;
                $Notification->message="Note Published";
                $Notification->save(); 
             }
             return back()->with('add_notice','Notice Added');
             
            



    	/*return redirect('Notice_Board')->with('add_notice','Notice Added!');*/
    	
    }

    

    public function edit_notice($notifi_id){
    	$Edit_Notice = Notice::find($notifi_id);
    	return view('admin.Edit_Notice',compact('Edit_Notice'));
    	
    }

    public function update_notice(Request $request){
    	$Up_Notice =Notice::find($request->notifi_id);
    	$Up_Notice->notice=$request->up_notice;
    	$Up_Notice->desiniation=$request->up_desiniation;
    	$Up_Notice->description=$request->up_description;
    	$Up_Notice->updated_at=date('Y-m-d H:i:s');
    	$Up_Notice->save();
    	return redirect('Notice_Board')->with('Up_Notice','Updated!');
    }

    public function delete_notice($notifi_id){
    	DB::delete('delete from notices where notifi_id = ?',[$notifi_id]);
        return back()->with('dele_notice','Notice Deleted successfully ');
    }

     public function payment($invoice_id)
    {
        $id=$id =$invoice_id;
        $data1=Invoice::find($id);
        $data=Invoice::where('invoice_id',$id)->join('users','users.id','=','invoices.client_id')->join('projects','projects.p_id','=','invoices.project_id')->get();
        $show_Invoice=DB::table('invoices')->join('products','invoices.invoice_id','=','products.invoices_id')->where('invoice_id',$id)->select('products.item as item','products.price as price','products.quantity as quantity','products.invoices_id as invoices_id','products.product_id as product_id',"invoices.discount as discount")->get();

        $bank = Bank::all();
        return view('admin.payment',compact('data','bank','data1','show_Invoice'));
    }

    public function addpayment(Request $request)
    {
        $paid_on = date('Y-m-d');
        $data=Invoice::find($request->input('invoice_id'));
        if($data->amount==null)
        {
            $amount=$request->input('amount');
        }else
        {
            $amount=$data->amount+$request->input('amount');
        }
        $data->amount=$amount;
        $data->bank_id=$request->input('bank_id');
        $data->paid_on=$request->$paid_on;
        if($data->amount==$data->totalamount){
            $data->status=1;
        }else{
            $data->status=0;
        }
        $data->update();
        return back();
    }
    
    public function taskstatus(Request $request)
    {
        
        $projects = Project::all('p_title','p_id');
        $empolyees =User::where('role_id',2)->get();
        $pro_array=array();
        $keys=array('p_id','title');
        $created_task = DB::table('users')->join('tasks','users.id','=','tasks.empolyee_id')->where('task_status',$request->status)->orderBY('tasks.task_id','DESC')->get();
           return response()->json([
            'created_task'=>$created_task,
        ],200);

    }
    
}
