<?php

namespace App\Http\Controllers\datatable;

use App\Models\pacs\series;
use App\Models\ris\transito;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DatatableController extends Controller
{


  public function atencioninmediata(Request $request)
  {


    $transitos = transito::where('transito.idestado', '=', '0')
      ->whereNotIn('transito.admision', function ($query) {
        $query->select('ris_agendados.admision')->from('ris_agendados');
      })
      ->whereIn('ris_salas.codigo', $request->sala)
      ->join('ris_pacientes', 'ris_pacientes.id', '=', 'transito.paciente_id')
      ->join('estudios', 'estudios.id', '=', 'transito.estudio_id')
      ->join('ris_modalidades', 'ris_modalidades.codigo', '=', 'estudios.modalidad')
      ->join('ris_salas', 'ris_salas.modalidad_id', '=', 'ris_modalidades.id')
      ->selectRaw("transito.id,ris_pacientes.id as idpaciente, concat(ris_pacientes.documento,' - ',ris_pacientes.primernombre,' ',ris_pacientes.segundonombre,' ',ris_pacientes.primerapellido,' ',ris_pacientes.segundoapellido) as nombre,
estudios.nombre as estudio,transito.admision,transito.fecha,ris_pacientes.documento,transito.medico_id as medico,
CAST(transito.procedencia AS INT) as prioridad,transito.procedencia,transito.convenio_id") // Agregar ris_pacientes.documento a la lista SELECT
      ->distinct()
      ->get();




    /*
    $estudios = series::where('ris_agendados.medico_id', '=',  $user->id)
      ->where('study.conaudio', '=', '0')
      ->whereNotIn('study.study_iuid', function ($query) {
        $query->select('lecturas.study_id')->from('lecturas');
      })
      ->whereIn('ris_salas.codigo', $request->sala)
      ->whereIn('series.modality', $request->modalidad)
      ->join('study', 'study.pk', '=', 'series.study_fk')
      ->join('patient', 'patient.pk', '=', 'study.patient_fk')
      ->join('patient_id', 'patient_id.pk', '=', 'patient.patient_id_fk')
      ->join('person_name', 'person_name.pk', '=', 'patient.pat_name_fk')
      ->join('ris_salas', 'ris_salas.aetitle', '=', 'series.sending_aet')
      ->join('ris_agendados', 'ris_agendados.numero_orden', '=', 'study.accession_no')
      ->selectRaw("series.modality as modalidad, concat('''',study.study_iuid,'''') as study_pk,patient.pk ,patient_id.pat_id,
    concat( SUBSTRING(study.study_date, 7, 2) ,'/',SUBSTRING(study.study_date, 5, 2) ,'/',SUBSTRING(study.study_date, 0, 5)) as fecha,
    replace (alphabetic_name,'^',' ') as nombre,
    pat_sex as  sexo, 1 as prioridad")
      ->distinct();
*/
    return datatables()->of($transitos)
      ->addColumn('action', function ($transitos) {
        $acciones = '<div class="text-center">';
        $acciones = '<div class="btn-group">';
        //  $acciones .= '<a title="Lectura" onclick="RealizarLecturas(' . $estudios->study_pk . ')"</a>';
        //$acciones .= '<a title="Lectura" wire:click="$emit(addatencion,{{$transitos->id}})" class="w-30px h-30px bg-gradient-info rounded-circle d-flex align-items-center justify-content-center"><div class=""><i class="fa fa-edit text-white"></i> </div></a>';
        $acciones .= '<a title="Lectura" wire:click="$emit(\'addatencion\',\'' . $transitos->id . '\',\'' . $transitos->fecha . '\',\'' . $transitos->idpaciente . '\',\'' . $transitos->admision . '\',\'' . $transitos->medico . '\',\'' . $transitos->prioridad . '\',\'' . $transitos->procedencia . '\',\'' . $transitos->convenio_id . '\')" class="w-30px h-30px bg-gradient-info rounded-circle d-flex align-items-center justify-content-center"><div class=""><i class="fa fa-edit text-white"></i> </div>  </a>';

        // <a  wire:click="$emit('addatencion','{{$transitos->id}}','{{$transitos->fecha}}','{{$transitos->idpaciente}}','{{$transitos->admision}}','{{$transitos->medico}}','{{$transitos->prioridad}}','{{$transitos->procedencia}}','{{$transitos->convenio_id}}')"
        // data-toggle="tooltip"  title="Procesar"><i class="fa fa-share fa-fw fa-lg"></i></a>
        //  $acciones .= '<a title="Lectura" onclick="RealizarLecturas(' . $estudios->study_pk . ')" class="w-30px h-30px bg-gradient-info rounded-circle d-flex align-items-center justify-content-center"><div class=""><i class="fa fa-edit text-white"></i> </div></a>';
        $acciones .= '</div>';
        $acciones .= '</div>';
        return $acciones;
      })->rawColumns(['action'])->make(true);
  }

  public function estudiosagendados(Request $request)
  {

    $user = Auth::user();


    $estudios = series::where('ris_agendados.medico_id', '=',  $user->id)
      ->where('study.conaudio', '=', '0')
      ->whereNotIn('study.study_iuid', function ($query) {
        $query->select('lecturas.study_id')->from('lecturas');
      })
      ->whereIn('ris_salas.codigo', $request->sala)
      ->whereRaw('1 IN (' . implode(',', $request->prioridad) . ')')
      ->whereIn('series.modality', $request->modalidad)
      ->join('study', 'study.pk', '=', 'series.study_fk')
      ->join('patient', 'patient.pk', '=', 'study.patient_fk')
      ->join('patient_id', 'patient_id.pk', '=', 'patient.patient_id_fk')
      ->join('person_name', 'person_name.pk', '=', 'patient.pat_name_fk')
      ->join('ris_salas', 'ris_salas.aetitle', '=', 'series.sending_aet')
      ->join('ris_agendados', 'ris_agendados.numero_orden', '=', 'study.accession_no')
      ->join('ris_relserviciostransito', 'ris_relserviciostransito.id', '=', 'ris_agendados.serviciotransito_id')
      ->join('estudios', 'estudios.id', '=', 'ris_relserviciostransito.estudio_id')
      ->selectRaw("ris_agendados.administradora,estudios.nombre as estudio,series.modality as modalidad, concat('''',study.study_iuid,'''') as study_pk,patient.pk ,patient_id.pat_id,
    concat( SUBSTRING(study.study_date, 7, 2) ,'/',SUBSTRING(study.study_date, 5, 2) ,'/',SUBSTRING(study.study_date, 0, 5)) as fecha,
    replace (alphabetic_name,'^',' ') as nombre,
    pat_sex as  sexo, 1 as prioridad")
      ->distinct();

    return datatables()->of($estudios)
      ->addColumn('action', function ($estudios) {
        $acciones = '<div class="text-center">';
        $acciones = '<div class="btn-group">';
        $acciones .= '<a title="Lectura" onclick="RealizarLecturas(' . $estudios->study_pk . ')" class="w-30px h-30px bg-gradient-info rounded-circle d-flex align-items-center justify-content-center"><div class=""><i class="fa fa-edit text-white"></i> </div></a>';
        $acciones .= '</div>';
        $acciones .= '</div>';
        return $acciones;
      })->rawColumns(['action'])->make(true);
  }




  public function estudiosportranscribir(Request $request)
  {

    $query1 = series::where('study.conaudio', '=', '0')
      ->whereNotIn('study.study_iuid', function ($query) {
        $query->select('lecturas.study_id')->from('lecturas');
      })
      ->whereIn('ris_hl7recibidos.puesto_atencion', $request->sede)
      ->whereIn('ris_hl7recibidos.sala', $request->sala)
      ->whereIn('ris_hl7recibidos.prioridad', $request->prioridad)
      ->whereIn('series.modality', $request->modalidad)
      ->join('study', 'study.pk', '=', 'series.study_fk')
      ->join('patient', 'patient.pk', '=', 'study.patient_fk')
      ->join('patient_id', 'patient_id.pk', '=', 'patient.patient_id_fk')
      ->join('person_name', 'person_name.pk', '=', 'patient.pat_name_fk')
      ->join('mwl_item', 'mwl_item.study_iuid', '=', 'study.study_iuid')
      ->join('ris_hl7recibidos', 'ris_hl7recibidos.numero_orden', '=', 'mwl_item.accession_no')
      ->selectRaw("series.modality as modalidad, concat('''',study.study_iuid,'''') as study_pk,patient.pk ,patient_id.pat_id,
      concat( SUBSTRING(study.study_date, 7, 2) ,'/',SUBSTRING(study.study_date, 5, 2) ,'/',SUBSTRING(study.study_date, 0, 5)) as fecha,
      replace (alphabetic_name,'^',' ') as nombre,
      pat_sex as  sexo,case when  ris_hl7recibidos.prioridad is null then 1 else ris_hl7recibidos.prioridad end as prioridad")
      ->distinct();

    $query2 = series::where('study.conaudio', '=', '0')
      ->whereNotIn('study.accession_no', function ($query) {
        $query->select('ris_agendados.numero_orden')->from('ris_agendados');
      })
      ->whereNotIn('study.study_iuid', function ($query) {
        $query->select('lecturas.study_id')->from('lecturas');
      })
      ->whereIn('ris_salas.codigo', $request->sala)
      ->whereRaw('1 IN (' . implode(',', $request->prioridad) . ')')
      ->whereIn('series.modality', $request->modalidad)
      ->join('study', 'study.pk', '=', 'series.study_fk')
      ->join('patient', 'patient.pk', '=', 'study.patient_fk')
      ->join('patient_id', 'patient_id.pk', '=', 'patient.patient_id_fk')
      ->join('person_name', 'person_name.pk', '=', 'patient.pat_name_fk')
      ->join('ris_salas', 'ris_salas.aetitle', '=', 'series.sending_aet')
      ->selectRaw("series.modality as modalidad, concat('''',study.study_iuid,'''') as study_pk,patient.pk ,patient_id.pat_id,
      concat( SUBSTRING(study.study_date, 7, 2) ,'/',SUBSTRING(study.study_date, 5, 2) ,'/',SUBSTRING(study.study_date, 0, 5)) as fecha,
      replace (alphabetic_name,'^',' ') as nombre,
      pat_sex as  sexo, 1 as prioridad")
      ->distinct();


    $estudios = $query1->unionAll($query2)->distinct();

    return datatables()->of($estudios)
      ->addColumn('action', function ($estudios) {
        $acciones = '<div class="text-center">';
        $acciones = '<div class="btn-group">';
        $acciones .= '<a title="Lectura" onclick="RealizarLecturas(' . $estudios->study_pk . ')" class="w-30px h-30px bg-gradient-info rounded-circle d-flex align-items-center justify-content-center"><div class=""><i class="fa fa-edit text-white"></i> </div></a>';
        $acciones .= '</div>';
        $acciones .= '</div>';
        return $acciones;
      })->rawColumns(['action'])->make(true);
  }



  public function estudiosenproceso(Request $request)
  {

    $user = Auth::user();

    $query1 = series::where('conaudio', '>', "0")
      ->where('medico_id', '=', $user->id)
      ->whereNotIn('study.study_iuid', function ($query) {
        $query->select('lecturas.study_id')->from('lecturas');
      })
      ->whereIn('ris_hl7recibidos.puesto_atencion', $request->sede)
      ->whereIn('ris_hl7recibidos.sala', $request->sala)
      ->whereIn('ris_hl7recibidos.prioridad', $request->prioridad)
      ->whereIn('series.modality', $request->modalidad)
      ->join('study', 'study.pk', '=', 'series.study_fk')
      ->join('patient', 'patient.pk', '=', 'study.patient_fk')
      ->join('patient_id', 'patient_id.pk', '=', 'patient.patient_id_fk')
      ->join('person_name', 'person_name.pk', '=', 'patient.pat_name_fk')
      ->join('mwl_item', 'mwl_item.study_iuid', '=', 'study.study_iuid')
      ->join('ris_hl7recibidos', 'ris_hl7recibidos.numero_orden', '=', 'mwl_item.accession_no')
      ->selectRaw("series.modality as modalidad,concat('''',study.study_iuid,'''')  as study_pk,patient.pk ,patient_id.pat_id,
    concat( SUBSTRING(study.study_date, 7, 2) ,'/',SUBSTRING(study.study_date, 5, 2) ,'/',SUBSTRING(study.study_date, 0, 5)) as fecha,
    replace (alphabetic_name,'^',' ')  as nombre,
    pat_sex as  sexo,case when  ris_hl7recibidos.prioridad is null then 0 else ris_hl7recibidos.prioridad end as prioridad")
      ->distinct();

    $query2 = series::where('study.conaudio', '>', '0')
      ->whereNotIn('study.study_iuid', function ($query) {
        $query->select('lecturas.study_id')->from('lecturas');
      })
      ->whereIn('ris_salas.codigo', $request->sala)
      ->whereRaw('1 IN (' . implode(',', $request->prioridad) . ')')
      ->whereIn('series.modality', $request->modalidad)
      ->join('study', 'study.pk', '=', 'series.study_fk')
      ->join('patient', 'patient.pk', '=', 'study.patient_fk')
      ->join('patient_id', 'patient_id.pk', '=', 'patient.patient_id_fk')
      ->join('person_name', 'person_name.pk', '=', 'patient.pat_name_fk')
      ->join('ris_salas', 'ris_salas.aetitle', '=', 'series.sending_aet')
      ->selectRaw("series.modality as modalidad, concat('''',study.study_iuid,'''') as study_pk,patient.pk ,patient_id.pat_id,
      concat( SUBSTRING(study.study_date, 7, 2) ,'/',SUBSTRING(study.study_date, 5, 2) ,'/',SUBSTRING(study.study_date, 0, 5)) as fecha,
      replace (alphabetic_name,'^',' ') as nombre,
      pat_sex as  sexo, 1 as prioridad")
      ->distinct();

    $estudios = $query1->unionAll($query2)->distinct();

    return datatables()->of($estudios)->addColumn('action', function ($estudios) {
      $acciones = '<div class="text-center">';
      $acciones = '<div class="btn-group">';
      $acciones .= '<a title="Lectura" onclick="RealizarLecturas(' . $estudios->study_pk . ')" class="w-30px h-30px bg-gradient-info rounded-circle d-flex align-items-center justify-content-center"><div class=""><i class="fa fa-edit text-white"></i> </div></a>';
      $acciones .= '</div>';
      $acciones .= '</div>';
      return $acciones;
    })->rawColumns(['action'])->make(true);
  }


  public function estudiosporvalidar(Request $request)
  {
    $user = Auth::user();
    $query1 = series::where('lecturas.validado', '=', '0')
      ->where('lecturas.medico_id', '=', $user->id)
      ->whereIn('ris_hl7recibidos.puesto_atencion', $request->sede)
      ->whereIn('ris_hl7recibidos.sala', $request->sala)
      ->whereIn('ris_hl7recibidos.prioridad', $request->prioridad)
      ->whereIn('series.modality', $request->modalidad)
      ->join('study', 'study.pk', '=', 'series.study_fk')
      ->join('patient', 'patient.pk', '=', 'study.patient_fk')
      ->join('patient_id', 'patient_id.pk', '=', 'patient.patient_id_fk')
      ->join('person_name', 'person_name.pk', '=', 'patient.pat_name_fk')
      ->join('lecturas', 'lecturas.study_id', '=', 'study.study_iuid')
      ->join('mwl_item', 'mwl_item.study_iuid', '=', 'study.study_iuid')
      ->join('ris_hl7recibidos', 'ris_hl7recibidos.numero_orden', '=', 'mwl_item.accession_no')
      ->selectRaw("series.modality as modalidad,concat('''',study.study_iuid,'''')  as study_pk,patient.pk ,patient_id.pat_id,
    concat( SUBSTRING(study.study_date, 7, 2) ,'/',SUBSTRING(study.study_date, 5, 2) ,'/',SUBSTRING(study.study_date, 0, 5)) as fecha,
    replace (alphabetic_name,'^',' ')  as nombre,
    pat_sex as  sexo,case when  ris_hl7recibidos.prioridad is null then 0 else ris_hl7recibidos.prioridad end as prioridad")
      ->distinct();

    $query2 = series::where('lecturas.validado', '=', '0')
      ->where('lecturas.medico_id', '=', $user->id)
      ->whereIn('ris_salas.codigo', $request->sala)
      ->whereRaw('1 IN (' . implode(',', $request->prioridad) . ')')
      ->whereIn('series.modality', $request->modalidad)
      ->join('study', 'study.pk', '=', 'series.study_fk')
      ->join('patient', 'patient.pk', '=', 'study.patient_fk')
      ->join('patient_id', 'patient_id.pk', '=', 'patient.patient_id_fk')
      ->join('person_name', 'person_name.pk', '=', 'patient.pat_name_fk')
      ->join('lecturas', 'lecturas.study_id', '=', 'study.study_iuid')
      ->join('ris_salas', 'ris_salas.aetitle', '=', 'series.sending_aet')
      ->selectRaw("series.modality as modalidad,concat('''',study.study_iuid,'''')  as study_pk,patient.pk ,patient_id.pat_id,
    concat( SUBSTRING(study.study_date, 7, 2) ,'/',SUBSTRING(study.study_date, 5, 2) ,'/',SUBSTRING(study.study_date, 0, 5)) as fecha,
    replace (alphabetic_name,'^',' ')  as nombre,
    pat_sex as  sexo,1 as prioridad")
      ->distinct();

    $estudios = $query1->unionAll($query2)->distinct();

    return datatables()->of($estudios)->addColumn('action', function ($estudios) {
      $acciones = '<div class="text-center">';
      $acciones = '<div class="btn-group">';
      $acciones .= '<a title="Lectura" onclick="RealizarLecturas(' . $estudios->study_pk . ')" class="w-30px h-30px bg-gradient-info rounded-circle d-flex align-items-center justify-content-center"><div class=""><i class="fa fa-edit text-white"></i> </div></a>';
      $acciones .= '</div>';
      $acciones .= '</div>';
      return $acciones;
    })->rawColumns(['action'])->make(true);
  }

  public function estudioscompetados(Request $request)
  {

    $URL_VISOR = env('APP_URL_VISOR');;


    $user = Auth::user();
    $query1 = series::where('lecturas.validado', '=', '1')
      ->where('lecturas.medico_id', '=', $user->id)
      ->whereRaw("study_date BETWEEN '$request->fechainicial' and '$request->fechafinal'")
      ->whereIn('ris_hl7recibidos.puesto_atencion', $request->sede)
      ->whereIn('ris_hl7recibidos.sala', $request->sala)
      ->whereIn('ris_hl7recibidos.prioridad', $request->prioridad)
      ->whereIn('series.modality', $request->modalidad)
      ->join('study', 'study.pk', '=', 'series.study_fk')
      ->join('patient', 'patient.pk', '=', 'study.patient_fk')
      ->join('patient_id', 'patient_id.pk', '=', 'patient.patient_id_fk')
      ->join('person_name', 'person_name.pk', '=', 'patient.pat_name_fk')
      ->join('lecturas', 'lecturas.study_id', '=', 'study.study_iuid')
      ->join('mwl_item', 'mwl_item.study_iuid', '=', 'study.study_iuid')
      ->join('ris_hl7recibidos', 'ris_hl7recibidos.numero_orden', '=', 'mwl_item.accession_no')
      ->selectRaw("series.modality as modalidad,concat('''',study.study_iuid,'''')  as study_pk,study.study_iuid,patient.pk ,patient_id.pat_id,
      concat( SUBSTRING(study.study_date, 7, 2) ,'/',SUBSTRING(study.study_date, 5, 2) ,'/',SUBSTRING(study.study_date, 0, 5)) as fecha,
      replace (alphabetic_name,'^',' ')  as nombre,
      pat_sex as  sexo,case when  ris_hl7recibidos.prioridad is null then 0 else ris_hl7recibidos.prioridad end as prioridad")
      ->distinct();

    $query2 = series::where('lecturas.validado', '=', '1')
      ->where('lecturas.medico_id', '=', $user->id)
      ->whereRaw("study_date BETWEEN '$request->fechainicial' and '$request->fechafinal'")
      ->whereIn('ris_salas.codigo', $request->sala)
      ->whereRaw('1 IN (' . implode(',', $request->prioridad) . ')')
      ->whereIn('series.modality', $request->modalidad)
      ->join('study', 'study.pk', '=', 'series.study_fk')
      ->join('patient', 'patient.pk', '=', 'study.patient_fk')
      ->join('patient_id', 'patient_id.pk', '=', 'patient.patient_id_fk')
      ->join('person_name', 'person_name.pk', '=', 'patient.pat_name_fk')
      ->join('lecturas', 'lecturas.study_id', '=', 'study.study_iuid')
      ->join('ris_salas', 'ris_salas.aetitle', '=', 'series.sending_aet')
      ->selectRaw("series.modality as modalidad,concat('''',study.study_iuid,'''')  as study_pk,study.study_iuid,patient.pk ,patient_id.pat_id,
      concat( SUBSTRING(study.study_date, 7, 2) ,'/',SUBSTRING(study.study_date, 5, 2) ,'/',SUBSTRING(study.study_date, 0, 5)) as fecha,
      replace (alphabetic_name,'^',' ')  as nombre,
      pat_sex as  sexo,1 as prioridad")
      ->distinct();

    $estudios = $query1->unionAll($query2)->distinct();

    return datatables()->of($estudios)->addColumn('action', function ($estudios) use ($URL_VISOR) {
      $acciones = '<div class="text-center">';
      $acciones = '<div class="btn-group">';
      $acciones .= '<a title="Lectura" onclick="RealizarLecturas(' . $estudios->study_pk . ')" class="w-30px h-30px bg-gradient-info rounded-circle d-flex align-items-center justify-content-center"><div class=""><i class="fa fa-edit text-white"></i> </div></a>';
      $acciones .= '<a title="Imprimir" onclick="ImprimirLecturas(' . $estudios->study_pk . ')" class="w-30px h-30px bg-gradient-warning rounded-circle d-flex align-items-center justify-content-center"><div class=""><i class="fa fa-print text-white"></i> </div></a>';
      $acciones .= '<a href="' . $URL_VISOR . '/viewer?StudyInstanceUIDs=' . $estudios->study_iuid . '" target="_blank"  title="Ver Estudio" class="w-30px h-30px bg-gradient-teal rounded-circle d-flex align-items-center justify-content-center "><div class=""><i class="fa fa-binoculars text-white"></i> </div> </a>';
      $acciones .= '<a title="Decargar Cd" href="descargar_cd" class="w-30px h-30px bg-gradient-purple rounded-circle d-flex align-items-center justify-content-center"><div class=""><i class="fa fa-download text-white"></i> </div></a>';
      $acciones .= '</div>';
      $acciones .= '</div>';
      return $acciones;
    })->rawColumns(['action'])->make(true);
  }




  public function lecturasestudiosclientes(string $idestudio)
  {


    $estudios = series::where('study.study_iuid', '=', "$idestudio")
      ->join('study', 'study.pk', '=', 'series.study_fk')
      ->join('lecturas', 'lecturas.study_id', '=', 'study.study_iuid')
      ->selectRaw("lecturas.id as lecturas_id,lecturas.estudio as estudio,regexp_replace(lecturas.informe, E'<[^>]+>', ' ', 'gi') as informe,lecturas.fechaestudio as fechaestudio,lecturas.informe as informe_html")
      ->distinct()->get();

    return datatables()->of($estudios)->addColumn('action', function ($estudios) {
      $acciones = '<div class="text-center">';
      $acciones = '<div class="btn-group">';
      $acciones .= '<a title="Validar" onclick="ValidarLectura()" class="w-30px h-30px bg-gradient-success rounded-circle d-flex align-items-center justify-content-center"><div class=""><i class="fa fa-check text-white"></i> </div></a>';
      $acciones .= '<a title="Editar" onclick="EditarLectura()" class="w-30px h-30px bg-gradient-info rounded-circle d-flex align-items-center justify-content-center"><div class=""><i class="fa fa-edit text-white"></i> </div></a>';
      $acciones .= '<a title="Imprimir" onclick="ImprimirLectura()" class="w-30px h-30px bg-gradient-warning rounded-circle d-flex align-items-center justify-content-center"><div class=""><i class="fa fa-print text-white"></i> </div></a>';
      $acciones .= '<a title="Eliminar" onclick="EliminarLectura2(\'' . $estudios->lecturas_id . '\')" class="w-30px h-30px bg-gradient-danger rounded-circle d-flex align-items-center justify-content-center"><div class=""><i class="fa fa-trash-alt text-white"></i> </div></a>';
      $acciones .= '</div>';
      $acciones .= '</div>';
      return $acciones;
    })->rawColumns(['action'])->make(true);
  }



  public function estudiospacientes(Request $request)
  {

    $URL_VISOR = env('APP_URL_VISOR');

    $estudios = series::where('lecturas.validado', '=', '1')
      ->where('patient_id.pat_id', '=', $request->paciente)
      ->join('study', 'study.pk', '=', 'series.study_fk')
      ->join('patient', 'patient.pk', '=', 'study.patient_fk')
      ->join('patient_id', 'patient_id.pk', '=', 'patient.patient_id_fk')
      ->join('person_name', 'person_name.pk', '=', 'patient.pat_name_fk')
      ->join('lecturas', 'lecturas.study_id', '=', 'study.study_iuid')
      ->selectRaw("series.modality as modalidad,concat('''',study.study_iuid,'''')  as study_pk,study.study_iuid,patient.pk ,patient_id.pat_id,
      concat( SUBSTRING(study.study_date, 7, 2) ,'/',SUBSTRING(study.study_date, 5, 2) ,'/',SUBSTRING(study.study_date, 0, 5)) as fecha,
      replace (alphabetic_name,'^',' ')  as nombre,lecturas.estudio as estudio,
      pat_sex as  sexo")
      ->distinct();

    return datatables()->of($estudios)->addColumn('action', function ($estudios) use ($URL_VISOR) {
      $acciones = '<div class="text-center">';
      $acciones = '<div class="btn-group">';
      $acciones .= '<a title="Imprimir" onclick="ImprimirLecturaspaciente(' . $estudios->study_pk . ')" class="w-30px h-30px bg-gradient-warning rounded-circle d-flex align-items-center justify-content-center"><div class=""><i class="fa fa-print text-white"></i> </div></a>';
      $acciones .= '<a href="' . $URL_VISOR . '/viewer?StudyInstanceUIDs=' . $estudios->study_iuid . '" target="_blank"  title="Ver Estudio" class="w-30px h-30px bg-gradient-teal rounded-circle d-flex align-items-center justify-content-center "><div class=""><i class="fa fa-binoculars text-white"></i> </div> </a>';
      $acciones .= '</div>';
      $acciones .= '</div>';
      return $acciones;
    })->rawColumns(['action'])->make(true);
  }



  public function estudioscompletadosmedico(Request $request)
  {
    $URL_VISOR = env('APP_URL_VISOR');

    $estudios = series::whereRaw("study_date BETWEEN '$request->fechainicial' and '$request->fechafinal'")
      ->whereIn('ris_salas.codigo', $request->sala)
      ->whereRaw('1 IN (' . implode(',', $request->prioridad) . ')')
      ->whereIn('series.modality', $request->modalidad)
      ->join('study', 'study.pk', '=', 'series.study_fk')
      ->join('patient', 'patient.pk', '=', 'study.patient_fk')
      ->join('patient_id', 'patient_id.pk', '=', 'patient.patient_id_fk')
      ->join('person_name', 'person_name.pk', '=', 'patient.pat_name_fk')
      ->join('ris_salas', 'ris_salas.aetitle', '=', 'series.sending_aet')
      ->leftJoin('lecturas', 'lecturas.study_id', '=', 'study.study_iuid')
      ->selectRaw("series.modality as modalidad,concat('''',study.study_iuid,'''')  as study_pk,study.study_iuid,patient.pk ,patient_id.pat_id,
      concat( SUBSTRING(study.study_date, 7, 2) ,'/',SUBSTRING(study.study_date, 5, 2) ,'/',SUBSTRING(study.study_date, 0, 5)) as fecha,
      replace (alphabetic_name,'^',' ')  as nombre,lecturas.validado as validado,
      pat_sex as  sexo,1 as prioridad")
      ->distinct();

    return datatables()->of($estudios)->addColumn('action', function ($estudios)  use ($URL_VISOR) {
      $acciones = '<div class="text-center">';
      $acciones = '<div class="btn-group">';
      if ($estudios->validado) {
        $acciones .= '<a title="Imprimir" onclick="ImprimirLecturas(' . $estudios->study_pk . ')" class="w-30px h-30px bg-gradient-warning rounded-circle d-flex align-items-center justify-content-center"><div class=""><i class="fa fa-print text-white"></i> </div></a>';
      }
      $acciones .= '<a href="' . $URL_VISOR . '/viewer?StudyInstanceUIDs=' . $estudios->study_iuid . '" target="_blank"  title="Ver Estudio" class="w-30px h-30px bg-gradient-teal rounded-circle d-flex align-items-center justify-content-center "><div class=""><i class="fa fa-binoculars text-white"></i> </div> </a>';
      $acciones .= '</div>';
      $acciones .= '</div>';
      return $acciones;
    })->rawColumns(['action'])->make(true);
  }



  public function buscarpacientes(Request $request)
  {
    $URL_VISOR = env('APP_URL_VISOR');

    $documento = $request->documento;
    $primernombre = $request->primernombre;
    $segundonombre = $request->segundonombre;
    $primerapellido = $request->primerapellido;
    $segundoapellido = $request->segundoapellido;
    $fechainicial = $request->fechainicial;
    $fechafinal = $request->fechafinal;

    if (!empty($documento)) {
      $transitos =  transito::where('transito.idestado', '=', '0')
        ->where('desplegables.ventana', '=', 'tipodocumento')
        ->join('ris_pacientes', 'ris_pacientes.id', '=', 'transito.paciente_id')
        ->join('estudios', 'estudios.id', '=', 'transito.estudio_id')
        ->join('ris_modalidades', 'ris_modalidades.codigo', '=', 'estudios.modalidad')
        ->join('ris_salas', 'ris_salas.modalidad_id', '=', 'ris_modalidades.id')
        ->join('ris_agendados', 'ris_agendados.admision', '=', 'transito.admision')
        ->join('ris_procedencias', 'ris_procedencias.codigo', '=', 'transito.procedencia')
        ->join('desplegables', 'desplegables.id', '=', 'ris_pacientes.idtipoid')
        ->join('study', 'study.accession_no', '=', 'ris_agendados.numero_orden')
        ->selectRaw("transito.id,concat(desplegables.nombre,' - ',ris_pacientes.documento,' ',ris_pacientes.primernombre,' ',ris_pacientes.segundonombre,' ',ris_pacientes.primerapellido,' ',ris_pacientes.segundoapellido) as nombre,
      concat (date_part('year',age( CAST (ris_pacientes.fechanacimiento AS date ))),' Años ',
      date_part('month',age( CAST (ris_pacientes.fechanacimiento AS date ))),' Meses ',
      date_part('day',age( CAST (ris_pacientes.fechanacimiento AS date ))),' Dias ') as edad,
      CAST(transito.procedencia AS INT) as prioridad,study.study_iuid,ris_agendados.admision,
      estudios.nombre as estudio,estudios.modalidad as modalidad,transito.fecha,ris_procedencias.nombre as procedencia")
        ->where(function ($query) use ($documento) {
          if (!empty($documento)) {
            $query->where('ris_pacientes.documento', 'LIKE', '%' . $documento . '%');
          }
        })
        ->where(function ($query) use ($primernombre) {
          if (!empty($primernombre)) {
            $query->where('ris_pacientes.primernombre', 'LIKE', '%' . $primernombre . '%');
          }
        })
        ->where(function ($query) use ($segundonombre) {
          if (!empty($segundonombre)) {
            $query->where('ris_pacientes.segundonombre', 'LIKE', '%' . $segundonombre . '%');
          }
        })
        ->where(function ($query) use ($primerapellido) {
          if (!empty($primerapellido)) {
            $query->where('ris_pacientes.primerapellido', 'LIKE', '%' . $primerapellido . '%');
          }
        })
        ->where(function ($query) use ($segundoapellido) {
          if (!empty($segundoapellido)) {
            $query->where('ris_pacientes.segundoapellido', 'LIKE', '%' . $segundoapellido . '%');
          }
        })
        ->where(function ($query) use ($fechainicial) {
          if (!empty($fechainicial)) {
            $query->whereDate('transito.fecha', '>=', $fechainicial);
          }
        })
        ->where(function ($query) use ($fechafinal) {
          if (!empty($fechafinal)) {
            $query->whereDate('transito.fecha', '<=', $fechafinal);
          }
        })
        ->distinct()
        ->get();


      return datatables()->of($transitos)->addColumn('action', function ($estudios) use ($URL_VISOR) {
        $acciones = '<div class="text-center">';
        $acciones = '<div class="btn-group">';
        $acciones .= '<a  onclick="Versoportes(\'' . $estudios->admision . '\');" title="Ver Soportes" class="w-30px h-30px bg-gradient-warning rounded-circle d-flex align-items-center justify-content-center "><div class=""><i class="fa fa-file-pdf text-white"></i> </div> </a>';
        $acciones .= '<a href="' . $URL_VISOR . '/viewer?StudyInstanceUIDs=' . $estudios->study_iuid . '" target="_blank"  title="Ver Estudio" class="w-30px h-30px bg-gradient-teal rounded-circle d-flex align-items-center justify-content-center "><div class=""><i class="fa fa-binoculars text-white"></i> </div> </a>';
        $acciones .= '</div>';
        $acciones .= '</div>';
        return $acciones;
      })->rawColumns(['action'])->make(true);
    } else {

      $transitos =  transito::where('transito.idestado', '=', '3240')
        ->where('transito.id', '=', '2ce10017-8633-44fb-a59d-470e875045a0')
        ->selectRaw("transito.id,'' as nombre,'' as edad,'' as prioridad,'' estudio,'' modalidad,'' as fecha,'' as procedencia")->distinct()
        ->get();
      return datatables()->of($transitos)->addColumn('action', function ($estudios) {
        $acciones = '';
        return $acciones;
      })->rawColumns(['action'])->make(true);
    }
  }
}



/*
,ris_pacientes.documento,transito.medico_id as medico,
transito.procedencia,transito.convenio_id
*/