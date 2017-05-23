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

}