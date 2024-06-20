<?php
include_once "../conexion.php";
include_once "Grafo.php";
include_once "Consultas.php";
include_once "ActualizarBD.php";
include_once "InsertBD.php";


$grafo = new Grafo($conn);
$grafo2= new Grafo($conn);
$consultar = new Consultas($conn);
$actualizar = new UpdateBD($conn);
$insertar = new InsertarBD($conn);

// // $sql = " SELECT * FROM preagendamiento p WHERE NOT EXISTS (SELECT 1 FROM ccitas_agendadas ct WHERE p.id_preagendamiento = ct.id_preagendamiento ";
$sql = " SELECT * FROM preagendamiento ";
$ejecutar_consulta = mysqli_query($conn,$sql);

if(mysqli_num_rows($ejecutar_consulta)>0){
    while($array_consulta=mysqli_fetch_array($ejecutar_consulta)){
     
        // array_push($arreglo_alojar,array($array_consulta[0],$array_consulta[1],$array_consulta[4],$array_consulta[7]));
        $nodo = new Nodo($array_consulta['id_preagendamiento'],array("idUsuario"=>$array_consulta['id_usuario'], "HoraInicio"=>$array_consulta['hora_inicio'],"HoraFin"=>$array_consulta['hora_fin'],"Valoracion"=>$array_consulta['valoracion'],"Registro"=>$array_consulta['registro'],"FechaSolicitada"=>$array_consulta['fecha'],"IdTipoCita"=>$array_consulta['id_tipo_cita'],"HoraAsignada"=>null,"MedicoAsignado"=>null,"Fecha2"=>$array_consulta['hora_fin']),0);
        $grafo->AgregarNodo($nodo);

    }
}



$NodosProcesados = $grafo->AsignarMedicoNodos();
/*
echo "NODOS QUE IRAN A CITAS AGENDADAS <br>";
foreach ($NodosProcesados[0] as $nodo) {
    echo "Nodo ID: {$nodo->id},\n Peso(Prioridad): {$nodo->peso}\n Fecha Solicitada = {$nodo->datos['FechaSolicitada']}  HoraAsignada = {$nodo->datos['HoraAsignada']}      MedicoAsignadoo = {$nodo->datos['MedicoAsignado']}<br><br>";
}

echo "NODOS QUE IRAN A SUGERENCIA CITAS <br>";
foreach ($NodosProcesados[1] as $nodo) {
    echo "Nodo ID: {$nodo->id},\n Peso(Prioridad): {$nodo->peso}\n Fecha Solicitada = {$nodo->datos['FechaSolicitada']}  HoraAsignada = {$nodo->datos['HoraAsignada']}      MedicoAsignadoo = {$nodo->datos['MedicoAsignado']}<br><br>";
}
*/


// echo "<br>VER<br>";
// $NodosProcesados2 = $grafo->filtro2();
// foreach ($NodosProcesados2 as $nodo) {
//     echo "Nodo ID: {$nodo->id},\n Peso(Prioridad): {$nodo->peso}\n Fecha Solicitada = {$nodo->datos['FechaSolicitada']}  HoraAsignada = {$nodo->datos['HoraAsignada']}      MedicoAsignadoo = {$nodo->datos['MedicoAsignado']}<br><br>";
// }

//INSERTAR O ACTUALIZAR CITAS YA AGENDADAS
foreach ($NodosProcesados[0] as $nodo) {

    if($consultar->ValidarExistenciaCita($nodo->id)) {

        $actualizar->ActualizarCitasAsignadas($nodo);

    }else{

        $insertar->InsertarCitasOrdenadas($nodo);

    }

}


//INSERTAR O ACTUALIZAR CITAS SUGERIDAS
foreach ($NodosProcesados[1] as $nodo) {

    if($consultar->ValidarExistenciaSugerencia($nodo->id)) {

        $actualizar->ActualizarCitasSugerencias($nodo);

    }else
    {

        $insertar->InsertarCitasSugerencias($nodo);

    }

}

?>