<?php

namespace App\Http\Controllers\HL7;

use Aranyasen\HL7;
use App\Models\User;
use Aranyasen\HL7\Message;
use App\Events\MessageSent;
use Illuminate\Http\Request;
use Aranyasen\HL7\Connection;
use App\Http\Controllers\Controller;
use App\Models\ris\ris_hl7recibidos;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Broadcast;

class HL7Controller extends Controller
{




    public function send_hl7(Request $request)
    {

        $response = ['status' => 0, 'message' => ""];

        $usuario = $request->header('Account');
        $password = $request->header('ApiKey');

        $user = User::where('usuario',  $usuario)->first();

        if ($user) {
            if (Hash::check($password, $user->password)) {

                $data = json_decode($request->getContent());

                $sede = $data->sede;
                $sala = $data->sala;
                $hl7 = $data->hl7Message;


                $respuestaMwl = $this->envioMWL($hl7, $sede, $sala);

                if ($respuestaMwl == 'AA') {
                    $response['status'] = 1;
                    $response['message'] = "hl7 recibido y procesado";
                } else {
                    $response['status'] = 0;
                    $response['message'] = "hl7 recibido pero con errores";
                }
            } else {
                $response['message'] = "credenciales incorrectas";
            }
        } else {
            $response['message'] = "usuario no encotnrado";
        }


        return response()->json($response);
    }



    public function envioMWL($hl7, $sede, $sala)
    {
        // $ip = '192.168.1.33';
        $ip = '192.168.1.23';
        $port = '2575';

        $message = new Message($hl7);
        $message->toString(true);

        if ($message->hasSegment('MSH') == true) {
            $fecha_orden = $message->getFirstSegmentInstance('MSH')->getField(7);
            $numero_examen = $message->getFirstSegmentInstance('MSH')->getField(10);
        }
        if ($message->hasSegment('PID') == true) {
            $identificacion_paciente = $message->getFirstSegmentInstance('PID')->getField(3)[0];
            $tipo_id_paciente = $message->getFirstSegmentInstance('PID')->getField(3)[1];
            $apellidos_paciente = $message->getFirstSegmentInstance('PID')->getField(5)[0];
            $nombres_paciente = $message->getFirstSegmentInstance('PID')->getField(5)[1];
            $fechanacimiento_paciente = $message->getFirstSegmentInstance('PID')->getField(7);
            $sexo_paciente = $message->getFirstSegmentInstance('PID')->getField(8);
            $direccion_paciente = $message->getFirstSegmentInstance('PID')->getField(11)[0];
            $ciudad_paciente = $message->getFirstSegmentInstance('PID')->getField(11)[1];
            $municipio_paciente = $message->getFirstSegmentInstance('PID')->getField(11)[2];
            $departamento_paciente = $message->getFirstSegmentInstance('PID')->getField(11)[3];
            $pais_paciente = $message->getFirstSegmentInstance('PID')->getField(11)[4];
            $telefono_paciente = $message->getFirstSegmentInstance('PID')->getField(13);
            $celular_paciente = $message->getFirstSegmentInstance('PID')->getField(14);
        }
        if ($message->hasSegment('PV1') == true) {
            $unidad_funcional = $message->getFirstSegmentInstance('PV1')->getField(3);
            $fecha_admision = $message->getFirstSegmentInstance('PV1')->getField(44);
        }
        if ($message->hasSegment('ORC') == true) {
            $nit_empresa = $message->getFirstSegmentInstance('ORC')->getField(2)[0];
            $nombre_empresa = $message->getFirstSegmentInstance('ORC')->getField(2)[1];
            $numero_orden = $message->getFirstSegmentInstance('ORC')->getField(4);
            $fecha_inicio = $message->getFirstSegmentInstance('ORC')->getField(7)[0];
            $fecha_finalizacion = $message->getFirstSegmentInstance('ORC')->getField(7)[1];
            $usuario_doctor = $message->getFirstSegmentInstance('ORC')->getField(10);
            $codigo_doctor = $message->getFirstSegmentInstance('ORC')->getField(12)[0];
            $apellido_doctor = $message->getFirstSegmentInstance('ORC')->getField(12)[1];
            $nombre_doctor = $message->getFirstSegmentInstance('ORC')->getField(12)[2];
            $sala = $message->getFirstSegmentInstance('ORC')->getField(13);
            $puesto_atencion = $message->getFirstSegmentInstance('ORC')->getField(17);
            $nit_administradora = $message->getFirstSegmentInstance('ORC')->getField(22)[0];
            $nombre_administradora = $message->getFirstSegmentInstance('ORC')->getField(22)[1];
        }
        if ($message->hasSegment('OBR') == true) {
            $cups = $message->getFirstSegmentInstance('OBR')->getField(4)[0];
            $nombre_cups = $message->getFirstSegmentInstance('OBR')->getField(4)[1];
            $prioridad = $message->getFirstSegmentInstance('OBR')->getField(5);
            $procedencia = $message->getFirstSegmentInstance('OBR')->getField(16);
            $modalidad = $message->getFirstSegmentInstance('OBR')->getField(24);
        }

        $connection = new Connection($ip, $port);
        $response = $connection->send($message);
        $response->toString(true);

        $respuesta = $response->getSegmentByIndex(1)->getField(1);

        if ($respuesta == 'AA') {

            ris_hl7recibidos::create([
                'fecha_orden' => $fecha_orden,
                'numero_examen' => $numero_examen,
                'identificacion_paciente' => $identificacion_paciente,
                'tipo_id_paciente' => $tipo_id_paciente,
                'apellidos_paciente' => $apellidos_paciente,
                'nombres_paciente' => $nombres_paciente,
                'fechanacimiento_paciente' => $fechanacimiento_paciente,
                'sexo_paciente' => $sexo_paciente,
                'direccion_paciente' => $direccion_paciente,
                'ciudad_paciente' => $ciudad_paciente,
                'municipio_paciente' => $municipio_paciente,
                'departamento_paciente' => $departamento_paciente,
                'pais_paciente' => $pais_paciente,
                'telefono_paciente' => $telefono_paciente,
                'celular_paciente' => $celular_paciente,
                'unidad_funcional' => $unidad_funcional,
                'fecha_admision' => $fecha_admision,
                'nit_empresa' => $nit_empresa,
                'nombre_empresa' => $nombre_empresa,
                'numero_orden' => $numero_orden,
                'fecha_inicio' => $fecha_inicio,
                'fecha_finalizacion' => $fecha_finalizacion,
                'usuario_doctor' => $usuario_doctor,
                'codigo_doctor' => $codigo_doctor,
                'apellido_doctor' => $apellido_doctor,
                'nombre_doctor' => $nombre_doctor,
                'sala' => $sala,
                'puesto_atencion' => $puesto_atencion,
                'nit_administradora' => $nit_administradora,
                'nombre_administradora' => $nombre_administradora,
                'cups' => $cups,
                'nombre_cups' => $nombre_cups,
                'prioridad' => $prioridad,
                'procedencia' => $procedencia,
                'modalidad' => $modalidad,
                'message' => $message->toString(true)
            ]);
        }

        return $respuesta;
    }


    public function envioMWL2()
    {
        // $ip = '192.168.1.33';
        $ip = '192.168.1.23';
        $port = '2575';

        $message = new Message("MSH|^~\\&|SIOS|SYSNET|Hunab|Hunab|20230627111100||ORM^O01|459536|P|2.4||||||\rPID|||1068658069^CC||TORRES VIDAL^LUIS GABRIEL||19861212|M|||CERETE^^001^162^23^CO^P||32157|3215794352|||||\rPV1||I|Imágenes Diagnósticas|||||||||||||||||||||||||||||||||||||||||20230627111100|\rORC|NW|806016225^CENTRO MEDICO BUENOS AIRES S.A.S||311234|SC||^^^20230627111100^20230627111100^1|||AVELILLA||94902672^VELILLA PERTUZ^ALVARO|^01||||01|||||9002267153^COOSALUD ENTIDAD PROMOTORA DE SALUD S.A|||\rOBR||130010162601^806016225^CENTRO MEDICO BUENOS AIRES S.A.S||873204^Radiografia de hombro|1|||||||||||||c||||||MR|||||||\r"); // Either \n or \r can be used as segment endings
        $message->toString(true);

        if ($message->hasSegment('MSH') == true) {
            $fecha_orden = $message->getFirstSegmentInstance('MSH')->getField(7);
            $numero_examen = $message->getFirstSegmentInstance('MSH')->getField(10);
        }
        if ($message->hasSegment('PID') == true) {
            $identificacion_paciente = $message->getFirstSegmentInstance('PID')->getField(3)[0];
            $tipo_id_paciente = $message->getFirstSegmentInstance('PID')->getField(3)[1];
            $apellidos_paciente = $message->getFirstSegmentInstance('PID')->getField(5)[0];
            $nombres_paciente = $message->getFirstSegmentInstance('PID')->getField(5)[1];
            $fechanacimiento_paciente = $message->getFirstSegmentInstance('PID')->getField(7);
            $sexo_paciente = $message->getFirstSegmentInstance('PID')->getField(8);
            $direccion_paciente = $message->getFirstSegmentInstance('PID')->getField(11)[0];
            $ciudad_paciente = $message->getFirstSegmentInstance('PID')->getField(11)[1];
            $municipio_paciente = $message->getFirstSegmentInstance('PID')->getField(11)[2];
            $departamento_paciente = $message->getFirstSegmentInstance('PID')->getField(11)[3];
            $pais_paciente = $message->getFirstSegmentInstance('PID')->getField(11)[4];
            $telefono_paciente = $message->getFirstSegmentInstance('PID')->getField(13);
            $celular_paciente = $message->getFirstSegmentInstance('PID')->getField(14);
        }
        if ($message->hasSegment('PV1') == true) {
            $unidad_funcional = $message->getFirstSegmentInstance('PV1')->getField(3);
            $fecha_admision = $message->getFirstSegmentInstance('PV1')->getField(44);
        }
        if ($message->hasSegment('ORC') == true) {
            $nit_empresa = $message->getFirstSegmentInstance('ORC')->getField(2)[0];
            $nombre_empresa = $message->getFirstSegmentInstance('ORC')->getField(2)[1];
            $numero_orden = $message->getFirstSegmentInstance('ORC')->getField(4);
            $fecha_inicio = $message->getFirstSegmentInstance('ORC')->getField(7)[0];
            $fecha_finalizacion = $message->getFirstSegmentInstance('ORC')->getField(7)[1];
            $usuario_doctor = $message->getFirstSegmentInstance('ORC')->getField(10);
            $codigo_doctor = $message->getFirstSegmentInstance('ORC')->getField(12)[0];
            $apellido_doctor = $message->getFirstSegmentInstance('ORC')->getField(12)[1];
            $nombre_doctor = $message->getFirstSegmentInstance('ORC')->getField(12)[2];
            $sala = $message->getFirstSegmentInstance('ORC')->getField(13);
            $puesto_atencion = $message->getFirstSegmentInstance('ORC')->getField(17);
            $nit_administradora = $message->getFirstSegmentInstance('ORC')->getField(22)[0];
            $nombre_administradora = $message->getFirstSegmentInstance('ORC')->getField(22)[1];
        }
        if ($message->hasSegment('OBR') == true) {
            $cups = $message->getFirstSegmentInstance('OBR')->getField(4)[1];
            $nombre_cups = $message->getFirstSegmentInstance('OBR')->getField(4)[1];
            $procedencia = $message->getFirstSegmentInstance('OBR')->getField(16);
            $modalidad = $message->getFirstSegmentInstance('OBR')->getField(24);
        }

        $connection = new Connection($ip, $port);
        $response = $connection->send($message);
        $response->toString(true);


        $respuesta = $response->getSegmentByIndex(1)->getField(1);

        if ($respuesta == 'AA') {

            ris_hl7recibidos::create([
                'fecha_orden' => $fecha_orden,
                'numero_examen' => $numero_examen,
                'identificacion_paciente' => $identificacion_paciente,
                'tipo_id_paciente' => $tipo_id_paciente,
                'apellidos_paciente' => $apellidos_paciente,
                'nombres_paciente' => $nombres_paciente,
                'fechanacimiento_paciente' => $fechanacimiento_paciente,
                'sexo_paciente' => $sexo_paciente,
                'direccion_paciente' => $direccion_paciente,
                'ciudad_paciente' => $ciudad_paciente,
                'municipio_paciente' => $municipio_paciente,
                'departamento_paciente' => $departamento_paciente,
                'pais_paciente' => $pais_paciente,
                'telefono_paciente' => $telefono_paciente,
                'celular_paciente' => $celular_paciente,
                'unidad_funcional' => $unidad_funcional,
                'fecha_admision' => $fecha_admision,
                'nit_empresa' => $nit_empresa,
                'nombre_empresa' => $nombre_empresa,
                'numero_orden' => $numero_orden,
                'fecha_inicio' => $fecha_inicio,
                'fecha_finalizacion' => $fecha_finalizacion,
                'usuario_doctor' => $usuario_doctor,
                'codigo_doctor' => $codigo_doctor,
                'apellido_doctor' => $apellido_doctor,
                'nombre_doctor' => $nombre_doctor,
                'sala' => $sala,
                'puesto_atencion' => $puesto_atencion,
                'nit_administradora' => $nit_administradora,
                'nombre_administradora' => $nombre_administradora,
                'cups' => $cups,
                'nombre_cups' => $nombre_cups,
                'procedencia' => $procedencia,
                'modalidad' => $modalidad,
                'message' => $message->toString(true)
            ]);
        }

        dd($response);
    }
}


        /*
        $message = new Message($hl7);
        $message->toString(true);

       
   

        */
        //return $$hl7;

        /* $hl7String2 = 'MSH|^~\&|SIOS|SYSNET|Hunab|Hunab|20230627111100||ORM^O01|459536|P|2.3.1||||||
        PID|||1068658069^CC||TORRES VIDAL^LUIS GABRIEL||19861212|M|||CERETE^^001^162^23^CO^P|||3215794352|||||
        PV1||I|Imágenes Diagnósticas|||||||||||||||||||||||||||||||||||||||||20230627111100|
        ORC|NW|806016225^CENTRO MEDICO BUENOS AIRES S.A.S||311234|SC||^^^20230627111100^20230627111100^1|||AVELILLA||94902672^VELILLA PERTUZ^ALVARO|^01||||01|||||9002267153^COOSALUD ENTIDAD PROMOTORA DE SALUD S.A|||
        OBR||130010162601^806016225^CENTRO MEDICO BUENOS AIRES S.A.S||873204^Radiografia de hombro||||||||||||1||||||||MR|||||||';
        //IPC|||||||||LTORRES';*/


        //dd($respuesta);

        /*
        $hl7String2 = 'MSH|^~\&|SIOS|SYSNET|Hunab|Hunab|20230627111100||ORM^O01|459536|P|2.3.1||||||
PID|||1068658069^CC||TORRES VIDAL^LUIS GABRIEL||19861212|M|||CERETE^^001^162^23^CO^P|||3215794352|||||
PV1||I|Imágenes Diagnósticas|||||||||||||||||||||||||||||||||||||||||20230627111100|
ORC|NW|806016225^CENTRO MEDICO BUENOS AIRES S.A.S||311234|SC||^^^20230627111100^20230627111100^1|||AVELILLA||94902672^VELILLA PERTUZ^ALVARO|^01||||01|||||9002267153^COOSALUD ENTIDAD PROMOTORA DE SALUD S.A|||
OBR||130010162601^806016225^CENTRO MEDICO BUENOS AIRES S.A.S||873204^Radiografia de hombro||||||||||||1||||||||MR|||||||';


        //$hl72 = "MSH|^~\\&|SIOS|SYSNET|HUNAD|HUNAD|202306111512||ORM^O01|459536|P|2.3.1|||||| PID|||22804862^^^CC||ALVAREZ HERRERA^EDELVI MARLENE||19450804|M||WH|820 JORIE BLVD^^CHICAGO^IL^60523|||||||20-98-4000||||||||||||||||||||| PV1||I|Imágenes Diagnósticas|||||||||||||||||||||||||||||||||||||||||20230627111100| ORC|NW|806016225^CENTRO MEDICO BUENOS AIRES S.A.S||311234|SC||^^^20230627111100^20230627111100^1|||AVELILLA||94902672^VELILLA PERTUZ^ALVARO |^01||||01|||||9002267153^COOSALUD ENTIDAD PROMOTORA DE SALUD S.A||| OBR||130010162601^806016225^CENTRO MEDICO BUENOS AIRES S.A.S||873204^Radiografia de hombro||||||||||||1||||||||||||||| NTE|1|26715|COOSALUD ENTIDAD PROMOTORA DE SALUD S.A";
        $message = new Message($hl7String2);
        //$message->toString(true);

        $connection = new Connection($ip, $port);
        $response = $connection->send($message);
        // $response->toString(true);

        //$respuesta = $response->getSegmentByIndex(1)->getField(1);
        return $response;

        $hl7String12w = 'MSH|^~\&|MESA_OP|XYZ_HOSPITAL|iFW|ABC_RADIOLOGY|||ORM^O01|101104|P|2.3||||||||
PID|1||20891312^^^^EPI||APPLESEED^JOHN^A^^MR.^||19661201|M||AfrAm|505 S. HAMILTON AVE^^MADISON^WI^53505^US^^^DN |DN|(608)123-4567|(608)123-5678||S|| 11480003|123-45-7890||||^^^WI^^
PD1|||FACILITY(EAST)^^12345|1173^MATTHEWS^JAMES^A^^^
PV1|||^^^CARE HEALTH SYSTEMS^^^^^||| |1173^MATTHEWS^JAMES^A^^^||||||||||||610613||||||||||||||||||||||||||||||||V
ORC|NW|987654^EPIC|76543^EPC||Final||^^^20140418170014^^^^||20140418173314|1148^PATTERSON^JAMES^^^^||1173^MATTHEWS^JAMES^A^^^|1133^^^222^^^^^|(618)222-1122||
OBR|1|363463^EPC|1858^EPC|73610^X-RAY ANKLE 3+ VW^^^X-RAY ANKLE ||||||||||||1173^MATTHEWS^JAMES^A^^^|(608)258-
8866||||||||Final||^^^20140418170014^^^^|||||6064^MANSFIELD^JEREMY^^^^||1148010^1A^EAST^X-RAY^^^|^|
DG1||I10|S82^ANKLE FRACTURE^I10|ANKLE FRACTURE||';

        $hl7String34 = 'MSH|^~\&|SIOS|SYSNET|Hunab|Hunab|20230627111100||ORM^O01|459536|P|2.3.1||||||
PID|||1064979627^^^CC||OSORIO ALMAZA^MARIA ELISA||19860307|F||WH|CERETE^^001^162^23^CO^P|||3215794352|||||
PV1||I|Imágenes Diagnósticas||||1234^WEAVER^TIMOTHY^P^^DR|5101^NELL^FREDERICK^P^^DR|0000^Consulting^Doctor^P^^DR|HSR|||||AS||0000^Admitting^Doctor^P^^DR||V100^^^ADT1|||||||||||||||||||||||||200008201100|||||||V|
ORC|NW|A100Z^MESA_ORDPLC|B100Z^MESA_ORDFIL||SC||1^once^^^^S||200008161510|^ROSEWOOD^RANDOLPH||7101^ESTRADA^JAIME^P^^DR|Enterer^^Location^EL^00000|(314)555-1212|200008161510||922229-10^IHE-RAD^IHE-CODE-231||
OBR|1|A100Z^MESA_ORDPLC|B100Z^MESA_ORDFIL|P1^Procedure 1^ERL_MESA^X1_A1^SP Action Item X1_A1^DSS_MESA|||||||||xxx||Radiology^^^^R|7101^ESTRADA^JAIME^P^^DR||$ACCESSION_NUMBER$|$REQUESTED_PROCEDURE_ID$|$SCHEDULED_PROCEDURE_STEP_ID$||||MR|||1^once^^^^S|||WALK|||||||||||A|||$PROCEDURE_CODE$';

        $hl7String13 = 'MSH|^~\&|BROKER|DCM4CHEE|DCM4CHEE|DCM4CHEE|||OMI^O23|STD-0001|P|2.5.1
PID|||DJ-01||DOE^JOHN||20000101|M
PV1|||||||PHY-01^ATTENDING PHYSICIAN|REF-01^REFERRING PHYSICIAN|||||||A0||||VS-01
ORC|NW|STD-0001|STD-0001||SC
TQ1|||||||202305301200||R
OBR||||||||||||||||REF-01^REFERRING PHYSICIAN|||||||||||||||STUDY REASON|||DOE^JANE||||||||||CHEST DX
IPC|STD-0001|CHEST DX|2.25.86071351078261808449043382132058402101|CHEST DX|DX|CHEST DX|NewDXMod||NewDXMod';

$hl7StringSI = 'MSH|^~\&|SIOS|SYSNET|Hiruko|ImExHS|20230518081300||ORM^O01|450075||2.4||||||
PID||22804862^^^CC|||CAICEDO ARDILA^ELKIN ANTONIO||19890827|M|||^^001^13001^13^CO^P||||||||
PV1||I|Imágenes Diagnósticas|||||||||||||||||||||||||||||||||||||||||20230518081300|
ORC|NW|806016225^CENTRO MEDICO BUENOS AIRES S.A.S||304628|SC||^^^20230518081300^20230518081300^1|||YURUETA||92528124^URUETA CHAVEZ^YAMITH ENRIQUE|^01||||02|||||9002267153^COOSALUD ENTIDAD PROMOTORA DE SALUD S.A|||
OBR||130010162601^806016225^CENTRO MEDICO BUENOS AIRES S.A.S||881301^ECOGRAFIA DE TEJIDOS BLANDOS DE PARED ABDOMINAL Y DE PELVIS||||||||||||1|||||||||||||||
NTE|1|26715|COOSALUD ENTIDAD PROMOTORA DE SALUD S.A';

        $hl7StringEJ = 'MSH|^~\&|MESA_OF|XYZ_RADIOLOGY|MESA_IM|XYZ_IMAGE_MANAGER|201605111512||ORM^O01|100112|P|2.3.1|||||| ||
PID|||M4001^^^ADT1||KING^MARTIN||19450804|M||WH|820 JORIE BLVD^^CHICAGO^IL^60523|||||||20-98-4000|||||||||||||||||||||
PV1||E|ED||||1234^WEAVER^TIMOTHY^P^^DR|5101^NELL^FREDERICK^P^^DR|0000^Consulting^Doctor^P^^DR|HSR|||||AS||0000^Admitting^Doctor^P^^DR||V100^^^ADT1|||||||||||||||||||||||||200008201100|||||||V|
ORC|NW|A100Z^MESA_ORDPLC|B100Z^MESA_ORDFIL||SC||1^once^^^^S||200008161510|^ROSEWOOD^RANDOLPH||7101^ESTRADA^JAIME^P^^DR|Enterer^^Location^EL^00000|(314)555-1212|200008161510||922229-10^IHE-RAD^IHE-CODE-231||
OBR|1|A100Z^MESA_ORDPLC|B100Z^MESA_ORDFIL|P1^Procedure 1^ERL_MESA^X1_A1^SP Action Item X1_A1^DSS_MESA|||||||||xxx||Radiology^^^^R|7101^ESTRADA^JAIME^P^^DR||$ACCESSION_NUMBER$|$REQUESTED_PROCEDURE_ID$|$SCHEDULED_PROCEDURE_STEP_ID$||||MR|||1^once^^^^S|||WALK|||||||||||A|||$PROCEDURE_CODE$
ZDS|1.2.4.0.13.1.432252867.1552647.1^100^Application^DICOM
IPC|||||||||LTORRES';

        
        $hl7StringLU = 'MSH|^~\&|SIOS|SYSNET|HUNAD|HUNAD|202306111512||ORM^O01|459536|P|2.3.1||||||
PID|||22804862^^^CC||ALVAREZ HERRERA^EDELVI MARLENE||19450804|M||WH|820 JORIE BLVD^^CHICAGO^IL^60523|||||||20-98-4000|||||||||||||||||||||
PV1||I|Imágenes Diagnósticas|||||||||||||||||||||||||||||||||||||||||20230627111100|  
ORC|NW|806016225^CENTRO MEDICO BUENOS AIRES S.A.S||311234|SC||^^^20230627111100^20230627111100^1|||AVELILLA||94902672^VELILLA PERTUZ^ALVARO |^01||||01|||||9002267153^COOSALUD ENTIDAD PROMOTORA DE SALUD S.A||| 
OBR||130010162601^806016225^CENTRO MEDICO BUENOS AIRES S.A.S||873204^Radiografia de hombro||||||||||||1||||||||||||||| 
NTE|1|26715|COOSALUD ENTIDAD PROMOTORA DE SALUD S.A
IPC|||||||||LTORRES';



        $hl7StringLU = 'MSH|^~\&|SIOS|SYSNET|Hiruko|ImExHS|20230518081300||ORM^O01|450075|0|2.4||||||
PID|||22804862^^^CC||CAICEDO ARDILA^ELKIN ANTONIO||19890827|M|||^^001^13001^13^CO^P||||||||
PV1||I|Imágenes Diagnósticas|||||||||||||||||||||||||||||||||||||||||20230518081300|
ORC|NW|806016225^CENTRO MEDICO BUENOS AIRES S.A.S||304628|SC||^^^20230518081300^20230518081300^1|||YURUETA||92528124^URUETA CHAVEZ^YAMITH ENRIQUE|^01||||02|||||9002267153^COOSALUD ENTIDAD PROMOTORA DE SALUD S.A|||
OBR||130010162601^806016225^CENTRO MEDICO BUENOS AIRES S.A.S||881301^ECOGRAFIA DE TEJIDOS BLANDOS DE PARED ABDOMINAL Y DE PELVIS||||||||||||1|||||||||||||||
NTE|1|26715|COOSALUD ENTIDAD PROMOTORA DE SALUD S.A
IPC|||||||||LTORRES';


        // $response->json() contiene la respuesta del servidor SignalR
        return response()->json(['response' => $response->json()]);
*/









        //   $OBR2 =  $message->getFirstSegmentInstance('OBR');



        // event(new MessageSent($message->toString(true)));
        // dd($OBR2->getField(4)[0]);
        /*
         MSH|^~\&|MESA_OF|XYZ_RADIOLOGY|MESA_IM|XYZ_IMAGE_MANAGER|201605111512||ORM^O01|100112|P|2.3.1|||||| ||
PID|||M4001^^^ADT1||KING^MARTIN||19450804|M||WH|820 JORIE BLVD^^CHICAGO^IL^60523|||||||20-98-4000|||||||||||||||||||||
PV1||E|ED||||1234^WEAVER^TIMOTHY^P^^DR|5101^NELL^FREDERICK^P^^DR|0000^Consulting^Doctor^P^^DR|HSR|||||AS||0000^Admitting^Doctor^P^^DR||V100^^^ADT1|||||||||||||||||||||||||200008201100|||||||V|
ORC|NW|A100Z^MESA_ORDPLC|B100Z^MESA_ORDFIL||SC||1^once^^^^S||200008161510|^ROSEWOOD^RANDOLPH||7101^ESTRADA^JAIME^P^^DR|Enterer^^Location^EL^00000|(314)555-1212|200008161510||922229-10^IHE-RAD^IHE-CODE-231||
OBR|1|A100Z^MESA_ORDPLC|B100Z^MESA_ORDFIL|P1^Procedure 1^ERL_MESA^X1_A1^SP Action Item X1_A1^DSS_MESA|||||||||xxx||Radiology^^^^R|7101^ESTRADA^JAIME^P^^DR||$ACCESSION_NUMBER$|$REQUESTED_PROCEDURE_ID$|$SCHEDULED_PROCEDURE_STEP_ID$||||MR|||1^once^^^^S|||WALK|||||||||||A|||$PROCEDURE_CODE$
ZDS|1.2.4.0.13.1.432252867.1552647.1^100^Application^DICOM
  
        MSH|^~\&|SIOS|SYSNET|Hiruko|ImExHS|20230627111100||ORM^O01|459536||2.4|||||| 
        PID||CC^22804862|||ALVAREZ HERRERA^EDELVI MARLENE||19871203|F|O+||EL POZON^^001^13001^13^CO^P||3208714651|3174767825|||||  
        PV1||I|Imágenes Diagnósticas|||||||||||||||||||||||||||||||||||||||||20230627111100|  
        ORC|NW|806016225^CENTRO MEDICO BUENOS AIRES S.A.S||311234|SC||^^^20230627111100^20230627111100^1|||AVELILLA||94902672^VELILLA PERTUZ^ALVARO |^01||||01|||||9002267153^COOSALUD ENTIDAD PROMOTORA DE SALUD S.A||| 
        OBR||130010162601^806016225^CENTRO MEDICO BUENOS AIRES S.A.S||873204^Radiografia de hombro||||||||||||1||||||||||||||| 
        NTE|1|26715|COOSALUD ENTIDAD PROMOTORA DE SALUD S.A
  
         */
        /* $hl7String = 'MSH|^~\&|SIOS|SYSNET|HUNAD|HUNAD|20230627111100||ORM^O01|459536|P|2.3.1||||||
PID||CC^22804862|M4001^^^ADT1||ALVAREZ HERRERA^EDELVI MARLENE||19871203|F|O+||EL POZON^^001^13001^13^CO^P||3208714651|3174767825|||||
PV1||I|Imágenes Diagnósticas|||||||||||||||||||||||||||||||||||||||||20230627111100|
ORC|NW|806016225^CENTRO MEDICO BUENOS AIRES S.A.S||311234|SC||^^^20230627111100^20230627111100^1|||AVELILLA||94902672^VELILLA PERTUZ^ALVARO |^01||||01|||||9002267153^COOSALUD ENTIDAD PROMOTORA DE SALUD S.A|||
OBR||130010162601^806016225^CENTRO MEDICO BUENOS AIRES S.A.S||873204^Radiografia de hombro||||||||||||1|||||||||||||||
NTE|1|26715|COOSALUD ENTIDAD PROMOTORA DE SALUD S.A';

        ----- Plantilla HL7
        MSH|^~\&|SIOS|@Nombre_EmpresaMensaje|Hiruko|ImExHS|@Fecha_Orden||ORM^O01|@Numero_Examen||2.4||||||  
        PID||@Tipo_Id_Paciente^@Identificacion_Paciente|||@Apellidos_Paciente^@Nombres_Paciente||@Fecha_Nacimiento_Paciente|@Sexo_Paciente|@Grupo_Sanguineo||@Direccion_Paciente^^@Ciudad_Paciente^@Municipio_Paciente^@Departamento_Paciente^@Codigo_Pais_Paciente^P||@Telefono_Paciente|@Celular_Paciente|||||@CorreoPaciente   
        PV1||I|@Unidad_Funcional|||||||||||||||||||||||||||||||||||||||||@Fecha_Admision|   
        ORC|NW|@Nit_Empresa^@Nombre_Empresa||@Numero_Orden|SC||^^^@Fecha_Inicio^@Fecha_Finalizacion^1|||@Usuario_Doctor||@Codigo_Doctor^@Apellido_Doctor^@Nombre_Doctor|@Modalidad^@Codigo_Sala||||@Puesto_Atencion|||||@Nit_Administradora^@Nombre_Administradora|||  
        OBR||@Codigo_Interno^@Nit_Empresa^@Nombre_Empresa||@Cups^@Nombre_Cups||||||||||||@Procedencia|||||||||||||||
        
         ----- Ejemplo de HL7 de Envio
        MSH|^~\&|SIOS|SYSNET|Hiruko|ImExHS|20230627111100||ORM^O01|459536||2.4|||||| 
        PID||CC^22804862|||ALVAREZ HERRERA^EDELVI MARLENE||19871203|F|O+||EL POZON^^001^13001^13^CO^P||3208714651|3174767825|||||  
        PV1||I|Imágenes Diagnósticas|||||||||||||||||||||||||||||||||||||||||20230627111100|  
        ORC|NW|806016225^CENTRO MEDICO BUENOS AIRES S.A.S||311234|SC||^^^20230627111100^20230627111100^1|||AVELILLA||94902672^VELILLA PERTUZ^ALVARO |^01||||01|||||9002267153^COOSALUD ENTIDAD PROMOTORA DE SALUD S.A||| 
        OBR||130010162601^806016225^CENTRO MEDICO BUENOS AIRES S.A.S||873204^Radiografia de hombro||||||||||||1||||||||||||||| 
        NTE|1|26715|COOSALUD ENTIDAD PROMOTORA DE SALUD S.A


        */
