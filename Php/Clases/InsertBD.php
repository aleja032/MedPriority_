
<?php

class InsertarBD{

    public $Conexion;


    public function __construct($Conection) {
        $this->Conexion = $Conection;
    }

    public function InsertarCitasOrdenadas($Nodo){

        $id_preagendamiento =$Nodo->id;
        $FechaAsignada =$Nodo->datos["FechaSolicitada"];
        $HoraAsignada =$Nodo->datos["HoraAsignada"];
        $id_DoctorAsignado =$Nodo->datos["MedicoAsignado"];
        $Prioridad = $Nodo->peso;

        $SQL = mysqli_query($this->Conexion,"INSERT INTO citas_agendadas (id_preagendamiento,FechaAsignada,HoraAsignado,id_DoctorAsignado,Prioridad) VALUES ('$id_preagendamiento','$FechaAsignada' , '$HoraAsignada' ,'$id_DoctorAsignado','$Prioridad')");

        if($SQL){
           
            // $to="maria.al3jandradelgado@gmail.com";
            // $subject="Prueba correo";
            // $message="este es mi primer correo de prueba";
            // $headers='From: alejandra03fajardo@gmail.com'."\r\n".'Reply-To: fajardo@gmail.com';
            // if(mail($to,$subject,$message,$headers)){
            //     echo"Se ha mandado el correo exitosamente $to";
            // }else{
            //     echo"Algo paso :(";
            // }
            return true;
        }
        return false;
    }

}

?>