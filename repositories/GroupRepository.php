<?php
use model\Group_has_users;
class GroupRepository extends Repository{

    public function getGroupsArray(){
        $groups = model\Group::get();
        $return= array();
        foreach($groups as $group){
            $return[$group->id] = $group->name;
        }
        return $return;
    }

    public function assignToGroup($group_id,$user_id){
        $group_has_users= Group_has_users::where('user_id','=',$user_id)->first();
        if(!$group_has_users){
            $group_has_users = new Group_has_users();
        }
        $group_has_users->group_id = $group_id;
        $group_has_users->user_id = $user_id;
    	$group_has_users->update();

    	NotificationRepository::create(Auth::user()->id, $user->id, 'Account aan groep gekoppeld.', 1);
    }

    public function unassignToGroup($group_id,$user_id){
        $group_has_users->delete();

        NotificationRepository::create(Auth::user()->id, $user->id, 'Account ontkoppeld van groep.', 1);
    }
}
?>