<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once __DIR__ . '/../models/CitaModel.php';
require_once __DIR__ . '/../models/PacienteModel.php';
require_once __DIR__ . '/../models/EspecialistaModel.php';
require_once __DIR__ . '/../models/ConsultorioModel.php';
require_once __DIR__ . '/../models/TratamientoModel.php';
require_once __DIR__ . '/../models/DiagnosticoModel.php';
require_once __DIR__ . '/../models/HistorialModel.php';
require_once __DIR__ . '/../models/UsuarioModel.php';
require_once __DIR__ . '/../app/services/MailService.php';
require_once __DIR__ . '/../vendor/autoload.php';

use app\services\MailService;

$cita = new CitaController();
$accion = $_GET['accion'] ?? 'index';

switch ($accion) {
    case 'view_store':
        $cita->view_store();
        break;
    case 'store':
        $cita->store();
        break;
    case 'view_update':
        $cita->view_update($_GET['id_cita']);
        break;
    case 'update':
        $cita->update();
        break;
    case 'delete':
        $cita->delete($_GET['id_cita']);
        break;
    case 'viewAgendar':
        $cita->viewAgendar($_GET['rol']);
        break;
    case 'agendarHora':
        $cita->agendarHora();
        break;
    case 'agendarCita':
        $cita->agendarCita();
        break;
    case 'especialistaCitaView':
        $cita->especialistaCitaView($_GET['id_usuario']);
        break;
    case 'view_resultado_cita':
        $cita->view_resultado($_GET['id_cita']);
        break;
    case 'store_resultado_cita':
        $cita->store_resultado();
        break;
    case 'pacienteCitas':
        $cita->pacienteCitas($_GET['id_usuario']);
        break;
    default:
        $cita->index();
        break;
}

class CitaController
{
    protected $CitaModel;
    protected $PacienteModel;
    protected $EspecialistaModel;
    protected $ConsultorioModel;
    protected $TratamientoModel;
    protected $HistorialModel;
    protected $DiagnosticoModel;
    protected $UsuarioModel;
    private MailService $mailer;
    private array $config;

    public function __construct()
    {
        $this->CitaModel = new CitaModel();
        $this->PacienteModel = new PacienteModel();
        $this->EspecialistaModel = new EspecialistaModel();
        $this->ConsultorioModel = new ConsultorioModel();
        $this->TratamientoModel = new TratamientoModel();
        $this->HistorialModel = new HistorialModel();
        $this->DiagnosticoModel = new DiagnosticoModel();
        $this->UsuarioModel = new UsuarioModel();
        $this->config = require __DIR__ . '/../config/configmailer.php';
        $this->mailer = new MailService($this->config);
    }

    public function index()
    {
        header('Location: ../views/administrador/cita/citaIndex.php');
        exit;
    }

    public function view_store()
    {
        header('Location: ../views/administrador/cita/citaStore.php');
        exit;
    }

    public function store()
    {
        $cita_paciente = $_POST['cita_paciente'] ?? $_SESSION['paciente_id'] ?? null;
        if (!$cita_paciente) {
            echo "Error: No se encontró sesión activa de paciente.";
            return;
        }

        $cita_hora_inicio = $_POST['cita_hora_inicio'] ?? null;
        $cita_fecha = $_POST['cita_fecha'] ?? null;
        $cita_motivo = $_POST['cita_motivo'] ?? null;
        $cita_observacion = $_POST['cita_observacion'] ?? null;
        $cita_estado = $_POST['cita_estado'] ?? 'Proceso';

        $duraciones = [
            'Consulta general' => 30,
            'Control' => 20,
            'Urgencia' => 45,
            'Seguimiento' => 25,
            'Examen' => 40,
            'Otro' => 30
        ];
        $cita_duracion = $duraciones[$cita_motivo] ?? 30;

        $inicio = strtotime($cita_hora_inicio);
        $fin = $inicio + ($cita_duracion * 60);
        $cita_hora_fin = date('H:i:s', $fin);

        $hora_sola = date('H:i', $inicio);
        if ($hora_sola >= '08:00' && $hora_sola <= '12:00') {
            $cita_turno = 'Mañana';
        } elseif ($hora_sola > '12:00' && $hora_sola <= '18:00') {
            $cita_turno = 'Tarde';
        } else {
            $cita_turno = 'Otro';
        }

        // ATENCION! NO DEJA AGENDAR CITA AL PACIENTE POR LO QUE NO TIENE HISTORIAL CLINICO
        // YO SUGIERO QUE CAMBIEMOS ESO POR QUE NO TENDRÍA SENTIDO QUE NO PUDIERA AGENDAR UNA CITA POR NO TENER HISTORIAL CLINICO
        // att EL JUANOTE MASONOTE
        // No cambie nada aca
        $historial = $this->HistorialModel->findByPaciente($cita_paciente);
        if (!$historial) {
            echo "Este paciente aún no tiene historial clínico registrado.";
            return;
        }
        $cita_historial = $historial['id_historial'];

        $asignarAuto = $_POST['asignacion_automatica'] ?? null;
        if ($asignarAuto == '1') {
            $especialistas = $this->EspecialistaModel->findAll();
            $id_especialista = null;
            foreach ($especialistas as $esp) {
                if ($this->CitaModel->verificarDisponibilidad($esp['id_especialista'], $cita_fecha, $cita_hora_inicio, $cita_hora_fin)) {
                    $id_especialista = $esp['id_especialista'];
                    break;
                }
            }

            $consultorios = $this->ConsultorioModel->findAll();
            $id_consultorio = null;
            foreach ($consultorios as $cons) {
                if ($this->CitaModel->verificarConsultorio($cons['id_consultorio'], $cita_fecha, $cita_hora_inicio, $cita_hora_fin)) {
                    $id_consultorio = $cons['id_consultorio'];
                    break;
                }
            }

            if (!$id_especialista || !$id_consultorio) {
                echo "No hay disponibilidad de especialista o consultorio.";
                return;
            }
        } else {
            $id_especialista = $_POST['cita_especialista'] ?? null;
            $id_consultorio = $_POST['cita_consultorio'] ?? null;
        }

        $data = [
            'cita_paciente' => $cita_paciente,
            'cita_historial' => $cita_historial,
            'cita_especialista' => $id_especialista,
            'cita_fecha' => $cita_fecha,
            'cita_hora_inicio' => $cita_hora_inicio,
            'cita_hora_fin' => $cita_hora_fin,
            'cita_turno' => $cita_turno,
            'cita_duracion' => $cita_duracion,
            'cita_consultorio' => $id_consultorio,
            'cita_motivo' => $cita_motivo,
            'cita_observacion' => $cita_observacion,
            'cita_estado' => $cita_estado,
        ];

        try {
            $this->CitaModel->store($data);
            header('Location: ../views/administrador/cita/citaIndex.php?mensaje=Cita creada exitosamente');
            exit;
        } catch (Exception $e) {
            echo "Error al crear la cita: " . $e->getMessage();
            return;
        }
    }

    public function view_update($id_cita)
    {
        $cita = $this->CitaModel->find($id_cita);
        $paci = $this->PacienteModel->findAll();
        $espe = $this->EspecialistaModel->findAll();
        $cons = $this->ConsultorioModel->findAll();
        $trat = $this->TratamientoModel->findAll();
        include '../views/administrador/cita/citaUpdate.php';
        exit;
    }

    public function update()
    {
        $cita_hora_inicio = $_POST['cita_hora_inicio'] ?? null;
        $cita_hora_fin = $_POST['cita_hora_fin'] ?? null;
        $cita_duracion = null;
        $cita_turno = null;

        if ($cita_hora_inicio && $cita_hora_fin) {
            $cita_duracion = (strtotime($cita_hora_fin) - strtotime($cita_hora_inicio)) / 60;
        }

        $hora_sola = date('H:i', strtotime($cita_hora_inicio));
        if ($hora_sola >= '06:00' && $hora_sola <= '12:00') {
            $cita_turno = 'Mañana';
        } elseif ($hora_sola > '12:00' && $hora_sola <= '18:00') {
            $cita_turno = 'Tarde';
        }

        $data = [
            'id_cita' => $_POST['id_cita'] ?? null,
            'cita_paciente' => $_POST['cita_paciente'] ?? null,
            'cita_especialista' => $_POST['cita_especialista'] ?? null,
            'cita_fecha' => $_POST['cita_fecha'] ?? null,
            'cita_hora_inicio' => $cita_hora_inicio,
            'cita_hora_fin' => $cita_hora_fin,
            'cita_turno' => $cita_turno,
            'cita_duracion' => $cita_duracion,
            'cita_consultorio' => $_POST['cita_consultorio'] ?? null,
            'cita_motivo' => $_POST['cita_motivo'] ?? null,
            'cita_observacion' => $_POST['cita_observacion'] ?? null,
            'cita_estado' => $_POST['cita_estado'] ?? 'Proceso',
        ];

        try {
            $this->CitaModel->update($data);
            header('Location: ../views/administrador/cita/citaIndex.php');
            exit;
        } catch (Exception $e) {
            echo "Error al actualizar la cita: " . $e->getMessage();
            return;
        }
    }

    public function delete($id_cita)
    {
        try {
            $this->CitaModel->delete($id_cita);
            header('Location: ../views/administrador/cita/citaIndex.php');
            exit;
        } catch (Exception $e) {
            echo "Error al eliminar la cita: " . $e->getMessage();
            return;
        }
    }

    
    public function especialistaCitaView($id_usuario)
    {
        $especialista = $this->EspecialistaModel->findEspecialista($id_usuario);
        
        $id_especialista = $especialista['id_especialista'];
        
        $cita = $this->CitaModel->findCita($id_especialista);
        
        include '../views/especialista/cita/citaEspecialista.php';
        exit;
        
        
    }
    
    public function view_resultado($id_cita)
    {
        $cita = $this->CitaModel->findResultado($id_cita);
        $diags = $this->DiagnosticoModel->findAll();
        include '../views/especialista/cita/citaResultado.php';
        exit;
    }
    
    public function store_resultado()
    {
        $dataResultado = [
            'resu_cita' => $_POST['resu_cita'] ?? null,
            'resu_diagnostico' => $_POST['resu_diagnostico'] ?? null,
            'resu_detalle' => $_POST['resu_detalle'] ?? null,
            'resu_recomendacion' => $_POST['resu_recomendacion'] ?? null,
            'resu_fecha' => $_POST['resu_fecha'] ?? date("Y-m-d H:i:s"),
        ];
        
        $dataEstado = [
            'id_cita' => $_POST['id_cita'], 
            'cita_estado' => $_POST['cita_estado']
        ];
        
        try {
            $this->CitaModel->storeResultado($dataResultado);
            $this->CitaModel->cambiarEstado($dataEstado);
            header('Location: ../views/especialista/home/especialista_dashboard.php');
            exit;
        } catch (\Exception $e) {
            error_log("Error al registrar el resultado de la cita: " . $e->getMessage());
            echo "Ocurrió un error al registrar el resultado de la cita. $e";
        }
    }

    public function viewAgendar($rol)
    {
        $especialistas = $this->EspecialistaModel->findAll();
        if($rol === "Administrador")
        {
            include '../views/administrador/cita/citaAgendar.php';
        } elseif ($rol === "Especialista")
            { 
                include '../views/especialista/cita/citaAgendar.php';
              } else
                {
                    include '../views/paciente/cita/citaAgendar1.php';
                }
        exit;
    }

    public function agendarHora()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_especialista = $_POST['id_especialista'];
            $fecha = $_POST['cita_fecha'];
            $motivo = $_POST['cita_motivo'];

            // Horarios base

            $horarios = [
                "08:00:00", "09:00:00", "10:00:00", "11:00:00",
                "12:00:00", "13:00:00", "14:00:00", "15:00:00",
                "16:00:00", "17:00:00"
            ];

            $ocupados = $this->CitaModel->obtenerHorariosOcupados($id_especialista, $fecha);
            $disponibles = array_diff($horarios, $ocupados);

            // Pasamos datos a la vista
            $cita_especialista = $id_especialista;
            $especialista = $this->EspecialistaModel->find($id_especialista);
            $cita_fecha = $fecha;
            $cita_motivo = $motivo;
            include '../views/paciente/cita/citaHora.php';
            exit;
        }
    }

    public function agendarCita()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $id_usuario = $_POST['id_usuario'];
            $cita_paciente = $this->PacienteModel->findIdPaciente($id_usuario);
            $cita_historial = $this->HistorialModel->findIdHistorial($cita_paciente);
        
            $cita_hora_inicio = $_POST['cita_hora_inicio'];
            $cita_hora_fin = date('H:i:s', strtotime($cita_hora_inicio . ' + 60 minutes'));

            $inicio = new DateTime($cita_hora_inicio);
            $fin = new DateTime($cita_hora_fin);
            $cita_duracion = $inicio->diff($fin)->h * 60 + $inicio->diff($fin)->i;

            $horaInt = (int)$inicio->format("H");
            $cita_turno = ($horaInt < 12) ? "Mañana" : "Tarde";

            $cita_fecha = $_POST['cita_fecha'];
            $consultorio = $this->ConsultorioModel->findConsultorioLibre($cita_fecha, $cita_hora_inicio,$cita_hora_fin);


            $data = [
                'cita_paciente' => $cita_paciente,
                'cita_historial' => $cita_historial,
                'cita_especialista' => $_POST['cita_especialista'] ?? null,
                'cita_fecha' => $_POST['cita_fecha'] ?? null,
                'cita_hora_inicio' => $_POST['cita_hora_inicio'] ?? null,
                'cita_hora_fin' => $cita_hora_fin,
                'cita_turno' => $cita_turno,
                'cita_duracion' => $cita_duracion,
                'cita_consultorio' => $consultorio,
                'cita_motivo' => $_POST['cita_motivo'] ?? null,
                'cita_observacion' => $_POST['cita_observacion'] ?? null,
                'cita_estado' => 'Proceso',
            ];

            $origen = $_POST['origen_formulario'] ?? 'Paciente';

            try {
            $this->CitaModel->store($data);
                $usuarioGuardado = $this->UsuarioModel->findCorreoUser($id_usuario);
                    
                if ($usuarioGuardado && isset($usuarioGuardado['usua_correo_electronico'])) {
                    $correoUsuario = $usuarioGuardado['usua_correo_electronico'];
                        $this->mailer->send(
                            $correoUsuario,
                            'Cita Agendada Correctamente',
                            'cita_agendada',
                            ['usuario' => $usuarioGuardado, 'app_url' => $this->config['app_url']]
                            );
                    } if ($origen === 'Especialista') {
                            header('Location: ../views/especialista/home/especialista_dashboard.php');
                        } elseif ($origen === 'Administrador') {
                            header('Location: ../views/administrador/home/admin_dashboard.php'); // 👈 aquí va la vista del admin
                        } else {
                            header('Location: ../views/paciente/home/paciente_dashboard.php');
                        }
                        exit;
                    } catch (\Exception $e) {
                        error_log("Error al registrar la cita: " . $e->getMessage());
                        echo "Ocurrió un error al registrar el usuario. error: $e";
                    }
                }
    }

    public function pacienteCitas($id_usuario)
    {
        $id_paciente = $this->PacienteModel->findIdPaciente($id_usuario);
        $cita = $this->CitaModel->findCitaPaciente($id_paciente);
        include '../views/paciente/cita/citaPaciente.php';
    }
}