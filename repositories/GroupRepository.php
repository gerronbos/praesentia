<?php
use model\Group;
use model\Group_has_users;
class GroupRepository extends Repository{

    public function create($name,$school_year,$period,$education_id){
        $group = new Group();
        $group->name = $name;
        $group->school_year = $school_year;
        $group->period = $period;
        $group->active = 1;
        $group->save();

        return $group;
        }

    public function delete($group){
        foreach(model\Group_has_users::where('group_id','=',$group->id)->get() as $g){
            $g->delete();
        }
        $group->delete();
    }

    public function update($group ,$data = array()){
        if (isset($data['name'])) {
            $group->name = $data['name'];
        }
        if (isset($data['school_year'])) {
            $group->school_year = $data['school_year'];
        }
        if (isset($data['period'])) {
            $group->period = $data['period'];
        }
        if (!isset($data['Status'])){
            $group->active = 0;
        }
        if (isset($data['Status'])){
            $group->active = 1;
        }
        $group->save();
    }

    public function getGroupsArray(){
        $groups = model\Group::get();
        $return= array();
        foreach($groups as $group){
            $return[$group->id] = $group->name;
        }
        return $return;
    }

    public function getGroup($id){
        $group = model\Group::find($id);
    }

    /*public function update($active,$user_id){
        $group_has_users= Group_has_users::where('user_id','=',$user_id)->where('active','=',1)->get();
        foreach($group_has_users as $ghu){
            $ghu->user_id = $user_id;
            $ghu->active = $active;
            $ghu->save();
        }

    }*/

    public function setInactive($user_id){
        $group_has_users= Group_has_users::where('user_id','=',$user_id)->where('active','=',1)->get();
        foreach($group_has_users as $ghu){
            $ghu->user_id = $user_id;
            $ghu->active = 0;
            $ghu->save();
        }
    }

    public function assignToGroup($group_id,$user_id){

        self::setInactive($user_id);
        $group_has_users = new Group_has_users();
        $group_has_users->group_id = $group_id;
        $group_has_users->user_id = $user_id;
        $group_has_users->active = 1;
    	$group_has_users->save();

    	NotificationRepository::create(Auth::user()->id, $user_id, 'Account aan groep gekoppeld.', 1);
    }
}
?>