<?php
include_once("../../login/check.php");
/*echo "<pre>";
print_r($_POST);
echo "</pre>";*/
$FechaFalta=$_POST['FechaFalta'];
$CodCurso=$_POST['CodCurso'];
$Dia=$_POST['Dia'];
$HoraInicio=$_POST['HoraInicio'];
$HoraAtraso=$_POST['HoraAtraso'];
$HoraActual=date("H:i:s");
$FechaActual=date("Y-m-d");
include_once("../../class/config.php");
include_once("../../class/agenda.php");
include_once("../../class/asistencia.php");
$asistencia=new asistencia;
$config=new config;
$agenda=new agenda;
$FaltaAgenda=$config->mostrarConfig("FaltaAgenda",1);

foreach($_POST['f'] as $CodAlumno=>$v){
    if($HoraInicio!='00:00:00' || $HoraAtraso!="00:00:00"){
        $valores=array("CodAlumno"=>$CodAlumno,
                    "Tipo"=>"'F'",
                    "Dia"=>$Dia,
                    "Fecha"=>"'".$FechaFalta."'",
                    "Hora"=>"'".$HoraActual."'"
                    );
        $asistencia->insertarRegistro($valores);
        if($FaltaAgenda){
            $agendaValues=array(
                'CodCurso'=>$CodCurso,
                'CodAlumno'=>$CodAlumno,
                'CodMateria'=>20,//Secretaria
                'CodObservacion'=>6,//Falta Mañana
                'Fecha'=>"'$FechaFalta'",
                'FechaRegistro'=>"'$FechaActual'",
                'HoraRegistro'=>"'$HoraActual'",
                'Activo'=>1,
                'Detalle'=>"'Reg. de Sistema'",
                'CodUsuario'=>$_SESSION['CodUsuarioLog'],
                'Nivel'=>$_SESSION['Nivel'],
                'Resaltar'=>0,
            );
            $agenda->insertarRegistro($agendaValues);
            /*echo "<pre>";
            print_r($agendaValues);
            echo "</pre>";*/
        }
    }
    /*echo "<pre>";
    print_r($valores);
    echo "</pre>";*/
}
header("Location:./?CodCurso=$CodCurso");
?>