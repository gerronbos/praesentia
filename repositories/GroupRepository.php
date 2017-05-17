<?php
use model\Group;
use model\Group_has_users;
class GroupRepository extends Repository{

    public function create($name,$school_year,$period,$education_id){
        $group = new Group();
        $group->name = $name;
        $group->school_year = $school_year;
        $group->period = $period;
        $group->education_id = $education_id;
        $group->save();

        return $group;
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

    public function update($active,$group_id,$user_id){
        $group_has_users= Group_has_users::where('user_id','=',$user_id)->first();
        if(!$group_has_users){
            $group_has_users = new Group_has_users();
        }
        $group_has_users->group_id = $group_has_users->group_id;
        $group_has_users->user_id = $user_id;
        $group_has_users->active = $active;
        $group_has_users->save();
    }

    public function assignToGroup($active,$group_id,$user_id){

        $group_has_users= Group_has_users::where('user_id','=',$user_id)->first();
        if(!$group_has_users){
            $group_has_users = new Group_has_users();
        }
        $group_has_users->group_id = $group_id;
        $group_has_users->user_id = $user_id;
        $group_has_users->active = $active;
    	$group_has_users->save();

    	NotificationRepository::create(Auth::user()->id, $user_id, 'Account aan groep gekoppeld.', 1);
    }
}
?>