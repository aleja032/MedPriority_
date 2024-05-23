
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
            $to = "alejandra03fajardo@gmail.com";
            $subject = "Prueba de correo electrónico desde PHP";
            $message = "Su cita ha sido asignada para la fecha: " . $FechaAsignada . " Hora: " . $HoraAsignada;
    
            // Cabeceras del correo electrónico
            $headers = "From: alejandra03fajardo@gmail.com\r\n";
            $headers .= "Reply-To: remitente@example.com\r\n";
            $headers .= "X-Mailer: PHP/" . phpversion();
    
            // Envío del correo electrónico
            if (mail($to, $subject, $message, $headers)) {
                echo "El correo electrónico fue enviado correctamente.";
            } else {
                echo "Hubo un error al enviar el correo electrónico.";
            }
            return true;
        }
        return false;
    }

}

?>