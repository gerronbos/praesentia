<?php
use model\Room;
class RoomRepository extends Repository{

    public function create($data)
    {
        $room = new Room();
        $room->number = $data['number'];
        $room->locatie = $data['locatie'];
        $room->save();
    }

    public function update($room ,$data = array()){
        if (isset($data['locatie'])) {
            $room->locatie = $data['locatie'];
        }
        if (isset($data['number'])) {
            $room->number = $data['number'];
        }
        $room->save();
    
        return $room;
    }

    public function delete($room){
        $room->delete();
    }

}