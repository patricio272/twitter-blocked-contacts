<?php
/**
/* Retorna las areas que seran "clickeables"
/* @param int $id_custom_plant identificador de planta
/* @return array $var Array con la informacion respectiva del Area
*/
function getAreasClickByPlant($id_custom_plant){
    mysql_select_db("lightcontroller", $GLOBALS['connect']);
    
    $sql = "SELECT e.hab_id, e.top, e.`left`, e.height, e.width
            FROM custom_enclosure  e left join recinto r on (r.hab_id = e.hab_id)
            WHERE id_custom_plant = ".$id_custom_plant;
    $plants_query = mysql_query($sql);

    $i = 0;
    $areas = array();
    while($row=mysql_fetch_assoc($plants_query)){
        $areas[$i] = $row;
        $i++;
    }
    return $areas;    
}
?>