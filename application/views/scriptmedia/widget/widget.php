<div class="widget-bottom menu-bottom-1 col-xs-12 col-sm-4 col-md-2 col-lg-2">
<?php  
     if(empty($fieldmuncul)){
    $fields = $modules->list_fields();
     }else{
        $fields = $fieldmuncul; 
     }
   //print_r ($fields);
    foreach ($modules->result() as $module){
       if (!empty($index)) $id = $module->$index;
       else $id = '';
       if (!empty($fieldshow)) $fielddetail = $fieldshow;
       else $fielddetail='';
        foreach ($fields as $field){
           echo '<li><a href="'.$href.$id.'/'.$fielddetail.'">'.$module->$field.'</a></li>';
          
        }
    
}
?>
</div>