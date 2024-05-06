<?php

namespace App\Http\Controllers\lecturas;

use notify;
use GuzzleHttp\Client;
use Barryvdh\DomPDF\PDF;
use App\Models\pacs\series;
use App\Models\pacs\patient;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\lecturas\lecturas;
use App\Models\ris\ris_plantillas;
use App\Events\estudiodeturnoEvent;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Events\estudioenprocesoEvent;
use App\Events\estudioporvalidarEvent;
use Flasher\Toastr\Prime\ToastrFactory;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Http\Requests\lecturas\Storelecturas;
use App\Http\Requests\lecturas\Storelecturas2;
use App\Models\usuariosclientes\Usuariosclientes;

class lecturasController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }



  public function index(string $idestudio)
  {

    $url = env('APP_URL_VISOR');
    $url_adjuntos = env('APP_URL_ADJUNTOS');

    $FechaActual = Carbon::now()->setTimezone('America/Bogota');

    $user = Auth::user();


    $estudio = series::where('study.study_iuid', '=', "$idestudio")
      ->join('study', 'study.pk', '=', 'series.study_fk')
      ->join('patient', 'patient.pk', '=', 'study.patient_fk')
      ->distinct()->count('study.pk');

    /*
    $query1 = series::where('study.study_iuid', '=', "$idestudio")
      ->join('study', 'study.pk', '=', 'series.study_fk')
      ->join('patient', 'patient.pk', '=', 'study.patient_fk')
      ->join('patient_id', 'patient_id.pk', '=', 'patient.patient_id_fk')
      ->join('person_name', 'person_name.pk', '=', 'patient.pat_name_fk')
      ->join('mwl_item', 'mwl_item.study_iuid', '=', 'study.study_iuid')
      ->join('ris_hl7recibidos', 'ris_hl7recibidos.numero_orden', '=', 'mwl_item.accession_no')
      ->selectRaw("replace (alphabetic_name,'^',' ') as nombrepaciente,
      patient_id.pat_id as documento,      concat( SUBSTRING(study.study_date, 7, 2) ,'/',SUBSTRING(study.study_date, 5, 2) ,'/',SUBSTRING(study.study_date, 0, 5)) as fecha,
      case when pat_sex='M' then 'Masculino' when pat_sex='F' then 'Femenimo'  ELSE 'Sin Diligenciar' END  sexo,
      case when pat_birthdate='*' then 0  ELSE date_part('year',age( CAST (pat_birthdate AS date ))) end as edad_a,
      case when pat_birthdate='*' then 0  ELSE date_part('month',age( CAST (pat_birthdate AS date ))) end as edad_m,
      case when pat_birthdate='*' then 0  ELSE date_part('day',age( CAST (pat_birthdate AS date ))) end as edad_d,
      study.study_iuid as studyinstanceuids,ris_hl7recibidos.nombre_cups as estudio,study.conaudio as audio
      ")->distinct();
*/


    $query2 = series::where('study.study_iuid', '=', "$idestudio")
      ->join('study', 'study.pk', '=', 'series.study_fk')
      ->join('patient', 'patient.pk', '=', 'study.patient_fk')
      ->join('patient_id', 'patient_id.pk', '=', 'patient.patient_id_fk')
      ->join('person_name', 'person_name.pk', '=', 'patient.pat_name_fk')
      ->selectRaw("replace (alphabetic_name,'^',' ') as nombrepaciente,
      patient_id.pat_id as documento,concat( SUBSTRING(study.study_date, 7, 2) ,'/',SUBSTRING(study.study_date, 5, 2) ,'/',SUBSTRING(study.study_date, 0, 5)) as fecha,
      case when pat_sex='M' then 'Masculino' when pat_sex='F' then 'Femenimo'  ELSE 'Sin Diligenciar' END  sexo,
      case when pat_birthdate='*' then 0  ELSE date_part('year',age( CAST (pat_birthdate AS date ))) end as edad_a,
      case when pat_birthdate='*' then 0  ELSE date_part('month',age( CAST (pat_birthdate AS date ))) end as edad_m,
      case when pat_birthdate='*' then 0  ELSE date_part('day',age( CAST (pat_birthdate AS date ))) end as edad_d,
      study.study_iuid as studyinstanceuids,study.study_desc ,study.conaudio as audio
      ")->distinct();


    $datospaciente = $query2->first();

    $adjuntos = series::where('study.study_iuid', '=', "$idestudio")
      ->join('study', 'study.pk', '=', 'series.study_fk')
      ->join('ris_agendados', 'ris_agendados.numero_orden', '=', 'study.accession_no')
      ->join('ris_soportes', 'ris_soportes.admision', '=', 'ris_agendados.admision')
      ->selectRaw("ris_soportes.url,ris_soportes.soporte")->distinct()->get();

    $plantillas = ris_plantillas::where('ris_plantillas.idestado', '=', '1')
      ->where('ris_relplantillasradiologos.medico_id', '=', $user->id)
      ->selectRaw("ris_plantillas.id,ris_plantillas.nombre")
      ->join('ris_relplantillasradiologos', 'ris_relplantillasradiologos.plantilla_id', '=', 'ris_plantillas.id')->get();


    $lecturas = lecturas::where('study_id', '=', "$idestudio")->get();

    if ($estudio == 1) {
      return view('lectura.index', compact('FechaActual', 'url', 'idestudio', 'lecturas', 'plantillas', 'datospaciente', 'adjuntos', 'url_adjuntos'));
    } else {
      return redirect()->back();
    }
  }

  public function store(Storelecturas $request)
  {

    $user = Auth::user();
    $validar = 1;
    if ($user->perfile_id == "3") {

      if ($request->validado == 'on') {
        $validar = 0;
      } else {
        $validar = 1;
      }

      lecturas::create([
        'study_id' => $request->idestudio,
        'medico_id' =>  $user->id,
        'estudio' => $request->estudio,
        'informe' => $request->informe,
        'fechaestudio' => $request->fechaestudio,
        'validado' => $validar,
      ]);

      notify()->success('', 'Lectura Guardada');

      estudioenprocesoEvent::dispatch("actualizar");
      estudioporvalidarEvent::dispatch("actualizar");
      estudiodeturnoEvent::dispatch("actualizar");

      return redirect()->back();
    } else {

      notify()->error('', 'Usted No Es Radiologo');
      return redirect()->back();
    }
  }


  public function update(Request $request)
  {


    $validator = Validator::make($request->all(), [
      'estudio2' => 'required',
      'informe2' => 'required',
      'fechaestudio2' => 'required',
    ]);

    if ($validator->fails()) {
      return response()->json(['errors' => $validator->errors()->all()]);
    }

    $lectura = lecturas::find($request->idestudio2);
    $lectura->estudio = $request->estudio2;
    $lectura->informe = $request->informe2;
    $lectura->fechaestudio = $request->fechaestudio2;
    $lectura->save();


    //    Alert::alert('Title', 'Message', 'Type');
    // notify()->success('', 'Lectura Guardada');
    //return redirect()->back();

    //return redirect()->back()->with('actualizo', 'ok');
  }
  public function destroy($idlectura)
  {

    $lectura = lecturas::find($idlectura);
    $lectura->delete();

    //return redirect()->back(); 

  }

  public function imprimirlectura(string $idestudio)
  {
    $URL_VISOR = env('APP_URL_VISOR');;
    $urlcompleta = URL::to('/');
    $urlString = (string) $urlcompleta;
    $urlsinpuerto = preg_replace('/:\d+$/', '', $urlString);
    $url = rtrim($urlsinpuerto, '/');

    $user = Auth::user();


    $cliente = Usuariosclientes::where('user_id', '=', $user->id)
      ->join('clientes', 'clientes.id', '=', 'usuariosclientes.cliente_id')
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


/*
//echo $response->getBody();
dd( $response->getBody());
*/
/*    $identificacion = 'CC';
      $tipoidentificacion = '137247124';
      $Password = 'Pruebas123';
      
      $response = Http::post('http://zafiroapi.sispropreprod.gov.co:8081/api/Login');
*//*

      $client = new Client(); 
      $headers = ['Content-Type' => 'application/json'];  
      
      $body = '{"tipoIdentificacion": "CC","Identificacion": "137247124","Password": "Pruebas123"}';
      
      $request = $client->request('POST', 'http://zafiroapi.sispropreprod.gov.co/api/Login', $headers, $body);
    //  $res = $client->sendAsync($request)->wait();
      echo $request->getBody();
    ]

    */
/*
      $client = new Client();
      $headers = [
  'Content-Type' => 'application/json'
];
$body = '{
  "tipoIdentificacion": "CC",
  "Identificacion": "137247124",
  "Password": "Pruebas123"
}';
*/
//$request = Http::post('http://zafiroapi.sispropreprod.gov.co:8081/api/Login');
//$request = new Request('POST', 'http://zafiroapi.sispropreprod.gov.co/api/Login', $headers, $body);
//$res = $client->sendAsync($request)->wait();
//echo $res->getBody();
/*
$response = Http::withHeaders([
  'Content-Type' => 'application/json'
])->post('http://zafiroapi.sispropreprod.gov.co:8081/api/Login', ['body'=>[
  'tipoIdentificacion'=>'CC',
  'Identificacion'=>'137247124',
  'Password'=>'Pruebas123']
]);


$LoginArray = [];
*/

//   $pdf->loadHTML('<h1> hola</h1>');
/*
      view()->share('lectura.descargarPdfAgrupado',$lecturas);
      $pdf = PDF::loadView('lectura.descargarPdfAgrupado', ['lecturas' => $lecturas]);

     return $pdf->download('lecturas');
*/


/*   $pdf->loadView('lectura.descargarPdfAgrupado', ['lecturas' => $lecturas]);
     $fileName = $lecturas;
     return $pdf->stream($fileName.'.pdf');
*/
//dd($lecturas->id);

/* $lectura->update([
      'estudio'=>$request->estudio2,
      'informe'=>$request->informe2,
      'fechaestudio'=>$request->fechaestudio2,
    ]);

    */




//  $affectedRows = lecturas::where('id', '=', $request->idlectura)->update(array('estudio' => 'Perfecto 22222'));

/*  $query = "update `parametros` set `pesos` = '$kilos[$i]',edad='$edad[$i]',`valor` = '$valor[$i]',`porcentaje` = IFNULL('$porcentaje[$i]',0) where `finca_id` = '$parametrizacion->idfinca' and `estadoProduccion` = '$tipos[$i]';";
      DB::getPdo()->exec($query); 

      lecturas::updated([
        'estudio'=>'perfecto',
        'informe'=>'sin definir',
     //   'fechaestudio'=>'',
      ]);
     */

// dd('HOLA');
//dd($request);



/**
 * 
 *     
       
 */

      //notify()->success('','Lectura Actualizada');        
     // return redirect()->back();
   
  
   /*
     public function destroy(lecturas $lectura){

       $lectura->delete();
   //   return redirect()->back(); 
     
     }
     */

 //,ToastrFactory $msn
     //$builder = $msn->type('error')->title(' ')->message('cliente Eliminado')->positionClass('toast-bottom-right')->preventDuplicates(true)->timeOut(2000);$builder->flash();    
     //return response()->json(['success'=>'Eliminado']);
    // return redirect()->route('clientes.index');
    //return redirect()->back();