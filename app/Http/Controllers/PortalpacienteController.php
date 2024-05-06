<?php

namespace App\Http\Controllers;

use App\Models\clientes\Clientes;
use App\Models\pacs\series;
use App\Models\pacs\patient;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\lecturas\lecturas;
use App\Models\ris\ris_plantillas;
use Illuminate\Support\Facades\URL;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\usuariosclientes\Usuariosclientes;

class PortalpacienteController extends Controller
{

    public function index()
    {
        return view('auth.portalpaciente');
    }

    public function store(Request $request)
    {

        if ($request->usuario === $request->password) {

            $paciente = patient::where('patient_id.pat_id', '=', $request->usuario)
                ->join('patient_id', 'patient_id.pk', '=', 'patient.patient_id_fk')
                ->join('person_name', 'person_name.pk', '=', 'patient.pat_name_fk')
                ->selectRaw("replace (alphabetic_name,'^',' ')  as nombre,patient_id.pat_id as identificacion")
                ->distinct()->first();

            if ($paciente) {
                notify()->success('Hola Sr ' .  $paciente->nombre, 'Bienvenido');
                return view('portalpaciente.estudiospaciente', compact('paciente'));
            } else {
                notify()->error('Usuario no encontrado');
                return back();
            }
        } else {
            notify()->error('Usuario o contreseña invalido');
            return back();
        }
    }

    public function estudiospaciente()
    {
        return view('portalpaciente.estudiospaciente');
    }
    public function portalpacientelogout()
    {
        auth()->Logout();

        return redirect()->route('portalpaciente');
    }

    public function imprimirlecturapaciente(string $idestudio)
    {
        $URL_VISOR = env('APP_URL_VISOR');
        $cliente = Clientes::where('idestado', '=', '1')
            ->select('clientes.*')
            ->first();

        $datospaciente = series::where('study.study_iuid', '=', "$idestudio")
            ->join('study', 'study.pk', '=', 'series.study_fk')
            ->join('patient', 'patient.pk', '=', 'study.patient_fk')
            ->join('patient_id', 'patient_id.pk', '=', 'patient.patient_id_fk')
            ->join('person_name', 'person_name.pk', '=', 'patient.pat_name_fk')
            ->leftJoin('ris_agendados', 'ris_agendados.numero_orden', '=', 'study.accession_no')
            ->selectRaw("replace (alphabetic_name,'^',' ') as nombrepaciente,
            patient_id.pat_id as documento,ris_agendados.administradora,series.institution,
            case when pat_sex='M' then 'Masculino' when pat_sex='F' then 'Femenimo'  ELSE 'Sin Diligenciar' END  sexo,
            case when pat_birthdate='*' then 0  ELSE DATE_PART('year', AGE(CURRENT_DATE, TO_DATE('19810220', 'YYYYMMDD')))  end AS edad,
            case when pat_birthdate='*' then 0  ELSE date_part('year',age( CAST (pat_birthdate AS date ))) end as edad_a,
            case when pat_birthdate='*' then 0  ELSE date_part('month',age( CAST (pat_birthdate AS date ))) end as edad_m,
            case when pat_birthdate='*' then 0  ELSE date_part('day',age( CAST (pat_birthdate AS date ))) end as edad_d,
            concat( SUBSTRING(study.study_date, 7, 2) ,'/',SUBSTRING(study.study_date, 5, 2) ,'/',SUBSTRING(study.study_date, 0, 5))  as fechaestudio,
            study_iuid as studyinstanceuids
            ")->first();
        /*
        $datospaciente = series::where('study.study_iuid', '=', "$idestudio")
            ->join('study', 'study.pk', '=', 'series.study_fk')
            ->join('patient', 'patient.pk', '=', 'study.patient_fk')
            ->join('patient_id', 'patient_id.pk', '=', 'patient.patient_id_fk')
            ->join('person_name', 'person_name.pk', '=', 'patient.pat_name_fk')
            ->selectRaw("replace (alphabetic_name,'^',' ') as nombrepaciente,
        patient_id.pat_id as documento,
        case when pat_sex='M' then 'Masculino' when pat_sex='F' then 'Femenimo'  ELSE 'Sin Diligenciar' END  sexo,
        case when pat_birthdate='*' then 0  ELSE date_part('year',age( CAST (pat_birthdate AS date ))) end as edad_a,
        case when pat_birthdate='*' then 0  ELSE date_part('month',age( CAST (pat_birthdate AS date ))) end as edad_m,
        case when pat_birthdate='*' then 0  ELSE date_part('day',age( CAST (pat_birthdate AS date ))) end as edad_d,
        concat( SUBSTRING(study.study_date, 7, 2) ,'/',SUBSTRING(study.study_date, 5, 2) ,'/',SUBSTRING(study.study_date, 0, 5))  as fechaestudio,
        study_iuid as studyinstanceuids
        ")->first();

*/
        $qrcode = base64_encode(QrCode::format('svg')->size(120)->errorCorrection('H')->generate("$URL_VISOR/viewer?StudyInstanceUIDs=$datospaciente->studyinstanceuids"));



        $lecturas = lecturas::where('study_id', '=', "$idestudio")
            ->join('medicos', 'medicos.id', 'lecturas.medico_id')
            ->selectRaw('lecturas.estudio estudio ,lecturas.informe informe,medicos.nombre radiologo,medicos.firma as firma,medicos.registromedico registro')
            ->first();
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('lectura.imprimir', ['clientes' => $cliente, 'datospaciente' => $datospaciente, 'lecturas' => $lecturas,  'qrcode' => $qrcode]);

        return $pdf->stream();
    }
}
