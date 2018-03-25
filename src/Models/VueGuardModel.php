<?php namespace Bantenprov\VueGuard\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Emadadly\LaravelUuid\Uuids;

/**
 * The VueGuardModel class.
 *
 * @package Bantenprov\VueGuard
 * @author  bantenprov <developer.bantenprov@gmail.com>
 */
class VueGuardModel extends Model
{
    use SoftDeletes;
    use Uuids;
    /**
    * Table name.
    *
    * @var string
    */
    protected $table = 'workflow_guards';

    /**
    * The attributes that are mass assignable.
    *
    * @var mixed
    */
    protected $fillable = ['workflow_id', 'transition_id', 'permission_id', 'label', 'name'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    //[Function] workflow
    public function workflow(){
        return $this->belongsTo('Bantenprov\VueWorkflow\Models\Workflow','workflow_id');
    }

    //[Function] transition
    public function transition(){
        return $this->belongsTo('Bantenprov\VueWorkflow\Models\Transition','transition_id');
    }

    //[Function] permission
    public function permission(){
        return $this->belongsTo('App\Permission','permission_id');
    }
    
    
    
}
