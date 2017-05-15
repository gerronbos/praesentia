<?php

class FormRepositorie extends Repository{

    private $title = null;
    private $input = null;
    private $params = array();
    private $type = null;
    private $value = null;
    private $name = null;
    private $id = null;
    private $list = array();

    public function __construct($params = array())
    {
        if(isset($params['type'])){
            $this->type = $params['type'];
        }

        if(isset($params['title'])){
            $this->title = $params['title'];
            $this->name = str_ireplace(' ','_',$params['title']);
            $this->id = str_ireplace(' ','_',$params['title']);
        }
        if(isset($params['value'])){
            if(!is_array($params['value'])) {
                $this->value = strval($params['value']);
            }
            else{
                $this->value = $params['value'];

            }
        }
        if(isset($params['params']['list'])){

            $this->list = $params['params']['list'];
            unset($params['params']['list']);
        }
        if(isset($params['params'])){
            $this->params = $params['params'];
            if(isset($params['params']['name'])){
                $this->name = $params['params']['name'];
                unset($params['params']['name']);
            }
            if(isset($params['params']['id'])){
                $this->id = $params['params']['id'];
                unset($params['params']['id']);
            }
        }


        
        $this->createInput();

    }

    public function openForm($params = array())
    {
        $return = "<form ";
        if(isset($params['method'])) {
            $return .= "method='".$params['method']."'";
        }
        else{
            $return .= "method='GET' ";
        }
        if(isset($params['url'])){
            $return .= "action='".$params['url']."' ";
        }
        if(isset($params['file']) && $params['file']){
            $return .= "enctype='multipart/form-data' ";
        }
        if(isset($params['name'])){
            $return .= "name='".$params['name']."' ";
        }
        if(isset($params['id'])){
            $return .= "id='".$params['id']."' ";
        }
        if(isset($params['class'])){
            $return .= "class='".$params['class']."' ";
        }
        if(isset($params['data-toggle'])){
            $return .= "data-toggle='".$params['data-toggle']."' ";
        }
        $return .= ">";
        if(isset($params['send_type'])){
            $return .= "<input type='hidden' name='".$params['send_type']."' value='1'>";
        }

        return $return;
    }
    public function closeForm($params = array())
    {
        return "</form>";
    }

    public function text($title, $value, $params = array())
    {
        return self::init(['type'=>'text','title'=>$title,'value'=>$value,'params'=>$params])->baseHtml();
    }
    public function password($title, $value, $params = array())
    {
        return self::init(['type'=>'password','title'=>$title,'value'=>$value,'params'=>$params])->baseHtml();
    }
    public function textarea($title, $value, $params = array())
    {
        return self::init(['type'=>'textarea','title'=>$title,'value'=>$value,'params'=>$params])->baseHtml();
    }
    public function checkbox($title,$list = array(), $value = array(), $params = array())
    {
        $params['list'] = $list;
        return self::init(['type'=>'checkbox','title'=>$title,'value'=>$value,'params'=>$params])->baseHtml();
    }
    public function radio($title,$list = array(), $value, $params = array())
    {
        $params['list'] = $list;
        return self::init(['type'=>'radio','title'=>$title,'value'=>array($value),'params'=>$params])->baseHtml();
    }
    public function file($title, $params = array())
    {
        return self::init(['type'=>'file','title'=>$title,'params'=>$params])->baseHtml();

    }
    public function truefalse($title, $value=false, $params = array())
    {
        $params['list'] = [1=>'Ja',0=>'Nee'];
        if(!isset($value)){
            $value = 1;
        }
        return self::init(['type'=>'select','title'=>$title,'value'=>$value,'params'=>$params])->baseHtml();
    }
    private function createInput(){
        $params = '';
        foreach($this->params as $key=>$p){
            $params .= strval("$key='$p'");
        }

        if(in_array($this->type,['text','password','number'])){
            $this->input = "<input type='$this->type' name='$this->name' class='form-control' id='$this->id' value='$this->value' $params >";
        }
        if($this->type == 'textarea'){
            $this->input = "<textarea id='$this->id' name='$this->name' class='form-control' $params >$this->value</textarea>";
        }
        if(in_array($this->type,['radio','checkbox'])){
            $items = '<br>';
            foreach($this->list as $key=>$l){
                $items .= "<input type='$this->type' name='$this->name' id='$key' style='margin-right: 10px;' $params";
                if(in_array($key,$this->value)){
                    $items .= "checked";
                }
                $items .= "><label for='$key'>$key</label><br>";
            }
            $this->input = $items;
        }
        if($this->type == 'select'){

            $itemlist = "";
            foreach($this->list as $key=>$l){
                $itemlist .= "<option value='$key'";
                if(strval($this->value) == strval($key)){
                    $itemlist .= "selected";
                }
                $itemlist .= ">$l</option>";
            }
            $this->input = "<select name='$this->name' id='$this->id' class='form-control' $params >$itemlist</select>";
        }

        if($this->type == 'file'){
            $this->input = "<input type='file' name='$this->name' id='$this->id'";
                if(isset($this->params['multiple']) && $this->params['multiple']){
                    $this->input .= "multiple";
                }
            $this->input .= " $params >";
        }
    }
    private function baseHtml()
    {
        $html = "<div class='form-group'><label class='control-label' for='$this->name'>$this->title</label>$this->input </div>";
        return $html;
    }
//Save buttons
    public function formSaveButton($backurl=null)
    {
        if(!is_null($backurl)){
            $return = "<div class='btn-group' role='group'>";
            $return .= "<a href='$backurl' class='btn btn-default'>Annuleren</a>";
            $return .= "<button class='btn btn-primary'>Opslaan</button>";
            $return .= "</div>";
        }
        else{
            $return = "<button class='btn btn-primary'>Opslaan</button>";
        }

        return $return;
    }
}