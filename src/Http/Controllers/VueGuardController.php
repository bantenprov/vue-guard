<?php namespace Bantenprov\VueGuard\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Bantenprov\VueGuard\Facades\VueGuard;
use Bantenprov\VueGuard\Models\VueGuardModel;
use Bantenprov\VueWorkflow\Models\Workflow;
use Bantenprov\VueWorkflow\Models\Transition;
use App\Permission;

use Validator;
/**
 * The VueGuardController class.
 *
 * @package Bantenprov\VueGuard
 * @author  bantenprov <developer.bantenprov@gmail.com>
 */
class VueGuardController extends Controller
{
    protected $vueGuard;
    protected $workflow;
    protected $transition;
    protected $permission;
    
    
    //[Function] __construct
    public function __construct(VueGuardModel $vueGuard, Workflow $workflow, Transition $transition, Permission $permission){
        $this->vueGuard     = $vueGuard;
        $this->workflow     = $workflow;
        $this->transition   = $transition;
        $this->permission   = $permission;
    }
    

    public function demo()
    {        
        return VueGuard::welcome();
    }

    //[Function] index
    public function index(Request $request){
        
        if (request()->has('sort')) {
            list($sortCol, $sortDir) = explode('|', request()->sort);

            $query = $this->vueGuard->orderBy($sortCol, $sortDir);
        } else {
            $query = $this->vueGuard->orderBy('id', 'asc');
        }

        if ($request->exists('filter')) {
            $query->where(function($q) use($request) {
                $value = "%{$request->filter}%";
                $q->where('label', 'like', $value)
                    ->orWhere('name', 'like', $value);
            });
        }

        $perPage = request()->has('per_page') ? (int) request()->per_page : null;
        $response = $query->paginate($perPage);
        
        foreach($response as $guard){            
            
            array_set($guard, 'workflow_label', $guard->workflow->label);
            array_set($guard, 'permission_name', $guard->permission->display_name);
            array_set($guard, 'transition_label', $guard->transition->label);
        }

        return response()->json($response);
    }

    //[Function] show
    public function show($id){
        $check = $this->vueGuard->find($id)->count();
        
        if($check > 0){
            $response = $this->vueGuard->findOrFail($id);
            $response['workflow']   = $response->workflow;
            $response['transition'] = $response->transition;
            $response['permission'] = $response->permission;
            $response['status'] = true;
        }else{
            $response['workflow']   = '';
            $response['transition'] = '';
            $response['permission'] = '';
            $response['status'] = true;
        }
        
        return response()->json($response);
    }

    //[Function] create
    public function create(Request $request){
        $workflows   = $this->workflow->all();
        $transitions = $this->transition->all();
        $permissions = $this->permission->all();

        foreach($permissions as $permission){
            array_set($permission, 'label', $permission->display_name);
        }

        $response['workflows'] = $workflows;
        $response['permissions'] = $permissions;
        $response['transitions'] = $transitions;

        return response()->json($response);
    }
    

    //[Function] store
    public function store(Request $request){        

        $validator = Validator::make($request->all(),[
            'workflow_id'   => 'required',
            'permission_id' => 'required',
            'transition_id' => 'required',
            'name'          => 'required',
            'label'         => 'required'
        ]);

        if($validator->fails()){
            $response['message']    = 'add new guard failed';
            $response['status']     = 'false';
        }else{
            $response['message']    = 'add guard success';
            $response['status']     = true;
            
            $save['workflow_id']    = $request->workflow_id;
            $save['permission_id']  = $request->permission_id;
            $save['transition_id']  = $request->transition_id;
            $save['name']           = $this->macineName($request->name);
            $save['label']          = $request->label;

            $this->vueGuard->create($save);
        }  

        return response()->json($response);
    }

    //[Function] destroy
    public function destroy($id, Request $request){
        
        $execute = $this->vueGuard->findOrFail($id);

        $response['status']     = true;
        $response['message']    = "success delete [ " . $execute->label . " ]";
        $execute->delete();

        return response()->json($response);
    }
    
    //[Function] getTransition
    public function getTransition($id){
        
        $transitions = $this->transition->where('workflow_id', $id)->get();

        return response()->json($transitions);
    }
    

    //[Function] macineName
    protected function macineName($val){
        
        $first = strtolower($val);
        $final = str_replace(' ', '-', $first);        

        return $final;
    }
    
    
    
    



}
