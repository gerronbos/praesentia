<?php
use Services\SessionHandler;
use model\Users;
use model\Notifications;

class NotificationRepository{

	public function create($from_user,$to_user,$message,$seen){
		$notification = new Notifications();
		$notification->from_user = $from_user;
		$notification->to_user = $to_user;
		$notification->message = $message;
		$notification->seen = 0;

		$notification->save();
	}
	public function delete(Notifications $notification){
		$notification->delete();
	}

	public function get($user,$params=array()){
		$notifications=Notifications::where('to_user','=',$user);

		if(isset($params['onlyUnseen'])){
			$notifications->where('seen','=',0);
		}
		if(isset($params['onlySeen'])){
			$notifications->where('seen','=',1);
		}
		if(isset($params['id'])){
			$notifications->where('id','=',$params['id']);
		}
		return $notifications;
	}

	public function setSeen(Notifications $notification){
		$notification->seen=1;
		$notification->save();
	}
}
?>