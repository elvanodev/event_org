<?php
 function setul($xidCSS,$xIsi){
   return '<ul id= "'.$xidCSS.'">'.$xIsi.'</ul>';
 }

function setli($xhref,$xIsi,$xSub='',$xclass='',$aclass='',$axtras='',$liextras=''){
   return '<li '.$liextras.' class="'.$xclass.'"> <a '.$axtras.' class="'.$aclass.'" href = "'.$xhref.'">'.$xIsi.'</a>'.$xSub.'</li>';
 }


 
function setlionclick($xFunction,$xIsi,$xSub=''){
   return '<li> <a href = "#" onclick="'.$xFunction.'" title = "'.$xIsi.'" >'.$xIsi.'</a>'.$xSub.'</li>';
 } 
  
 function setultree($xidCSS,$xIsi){
   return "\n".'<ul '.$xidCSS.'>'.$xIsi.'</ul>'."\n"."\n";
 }

 function setlitree($xhref,$xIsi,$xSub='',$xid=''){
   //return '<li> <a href ="">'.$xIsi.'</a>'.$xSub.'</li>';
   return '<li class="closed" id="'.$xid.'"> '.$xIsi.''.$xSub.'</li>'."\n";
 }

 function setlitreechk($id,$xIsi,$xSub=''){
  // return '<li> <input type="checkbox" name="mn'.$id.'" value="'.$id.'" id="mn'.$id.'">'.$xIsi.''.$xSub.'</li>  ';
   return '<li> <input type="checkbox" id="mn'.$id.'" name="mn'.$id.'" />'.$xIsi.''.$xSub.'</li>'."\n";
 }
 function setlitreechkwithurut($id,$xIsi,$xurut,$xSub=''){
  // return '<li> <input type="checkbox" name="mn'.$id.'" value="'.$id.'" id="mn'.$id.'">'.$xIsi.''.$xSub.'</li>  ';
   return '<li> <input type="checkbox" id="mn'.$id.'" name="mn'.$id.'"  />'.$xIsi.''.$xSub.'
                 <input type="text" id="urut_'.$id.'" name="urut_'.$id.'" value="'.$xurut.'" style="width:30px;"/></li>'."\n";
 }
?>
