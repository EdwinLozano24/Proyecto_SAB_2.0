<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <title>Historia Clínica Paciente</title>
    <!-- Fony Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    
      <?php
    $cssPath = $_SERVER['DOCUMENT_ROOT'] . '/Assets/css/historial/HistorialVisualizar.css';
    $cssUrl = '/Assets/css/historial/HistorialVisualizar.css';
    if (file_exists($cssPath)) {
        echo '<link rel="stylesheet" href="' . $cssUrl . '">';
    } else {
        echo ' CSS File not fount at: ' . $cssPath . '';
    }
    ?>
  </head>
  <body>
<div class="container">
        <!-- Encabezado -->
        <div class="header">
            <div class="logo">🏥</div>
            <h2>Historia Clínica</h2>
            <p class="subtitle">Formulario de registro médico del paciente</p>
            
            <!-- Botón de Citas Relacionadas -->
            <div style="margin-top: 20px;">
                <button type="button" class="btn-primary-custom">
                    <i class="fa-solid fa-eye"></i>
                    Citas Relacionadas
                </button>
            </div>
        </div>

        <div class="info-card">
            <p><strong>Nota:</strong> Los campos marcados con <span class="required">*</span> son obligatorios.</p>
        </div>

        <form id="historiaClinica">
            <!-- Información del Paciente -->
            <div class="form-section">
                <div class="section-title">
                    <div class="section-icon">👤</div>
                    Información del Paciente
                </div>
                
                <div style="display: grid; grid-template-columns: 150px 1fr; gap: 20px;">
                    <div class="form-group">
                        <label for="id">ID <span class="required">*</span></label>
                        <input type="text" id="id" name="id" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="hist_paciente">Historia del Paciente</label>
                        <input type="text" id="hist_paciente" name="hist_paciente">
                    </div>
                </div>
            </div>

            <!-- Antecedentes -->
            <div class="form-section">
                <div class="section-title">
                    <div class="section-icon">📋</div>
                    Antecedentes Médicos
                </div>
                
                <div class="form-group full-width">
                    <label for="hist_antecedentes_personales">Antecedentes Personales</label>
                    <textarea id="hist_antecedentes_personales" name="hist_antecedentes_personales" rows="4" placeholder="Describa los antecedentes personales del paciente..."></textarea>
                </div>
                
                <div class="form-group full-width">
                    <label for="hist_antecedentes_fam">Antecedentes Familiares</label>
                    <textarea id="hist_antecedentes_fam" name="hist_antecedentes_fam" rows="4" placeholder="Describa los antecedentes familiares..."></textarea>
                </div>
            </div>

            <!-- Exámenes y Diagnósticos -->
            <div class="form-section">
                <div class="section-title">
                    <div class="section-icon">🔍</div>
                    Exámenes y Diagnósticos
                </div>
                
                <div class="form-grid">
                    <div class="form-group">
                        <label for="hist_odontograma">Odontograma</label>
                        <input type="text" id="hist_odontograma" name="hist_odontograma">
                    </div>
                    
                    <div class="form-group">
                        <label for="hist_indice_dmft">Índice DMFT</label>
                        <input type="text" id="hist_indice_dmft" name="hist_indice_dmft">
                    </div>
                    
                    <div class="form-group">
                        <label for="hist_frecuencia">Frecuencia</label>
                        <input type="text" id="hist_frecuencia" name="hist_frecuencia">
                    </div>
                    
                    <div class="form-group">
                        <label for="hist_hilo_dental">Hilo Dental</label>
                        <select id="hist_hilo_dental" name="hist_hilo_dental">
                            <option value="">Seleccionar...</option>
                            <option value="si">Sí</option>
                            <option value="no">No</option>
                            <option value="ocasional">Ocasionalmente</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="hist_enjuague">Enjuague</label>
                        <select id="hist_enjuague" name="hist_enjuague">
                            <option value="">Seleccionar...</option>
                            <option value="si">Sí</option>
                            <option value="no">No</option>
                            <option value="ocasional">Ocasionalmente</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="hist_sensibilidad">Sensibilidad</label>
                        <select id="hist_sensibilidad" name="hist_sensibilidad">
                            <option value="">Seleccionar...</option>
                            <option value="ninguna">Ninguna</option>
                            <option value="leve">Leve</option>
                            <option value="moderada">Moderada</option>
                            <option value="severa">Severa</option>
                        </select>
                    </div>
                </div>
                
                <div style="margin-top: 32px;">
                    <div class="form-group full-width">
                        <label for="hist_alergias">Alergias</label>
                        <textarea id="hist_alergias" name="hist_alergias" rows="3" placeholder="Describa las alergias conocidas del paciente..."></textarea>
                    </div>
                </div>
                
                <div style="margin-top: 32px;">
                    <div class="form-group full-width">
                        <label for="hist_medicamentos">Medicamentos</label>
                        <textarea id="hist_medicamentos" name="hist_medicamentos" rows="3" placeholder="Liste los medicamentos actuales del paciente..."></textarea>
                    </div>
                </div>
            </div>

            <!-- Diagnóstico y Tratamiento -->
            <div class="form-section">
                <div class="section-title">
                    <div class="section-icon">💊</div>
                    Diagnóstico y Tratamiento
                </div>
                
                <div class="form-group full-width">
                    <label for="diag_nombre">Nombre del Diagnóstico</label>
                    <input type="text" id="diag_nombre" name="diag_nombre">
                </div>
                
                <div style="margin-top: 32px;">
                    <div class="form-group full-width">
                        <label for="diag_descripcion">Descripción del Diagnóstico</label>
                        <textarea id="diag_descripcion" name="diag_descripcion" rows="3"></textarea>
                    </div>
                </div>
                
                <div style="margin-top: 32px;">
                    <div class="form-grid">
                    
                    <div class="form-group">
                        <label for="trat_codigo">Código de Tratamiento</label>
                        <input type="text" id="trat_codigo" name="trat_codigo">
                    </div>
                    
                    <div class="form-group">
                        <label for="trat_nombre">Nombre del Tratamiento</label>
                        <input type="text" id="trat_nombre" name="trat_nombre">
                    </div>
                    
                    <div class="form-group full-width">
                        <label for="trat_descripcion">Descripción del Tratamiento</label>
                        <textarea id="trat_descripcion" name="trat_descripcion" rows="3"></textarea>
                    </div>
                </div>
            </div>

            <!-- Información de Registro -->
            <div class="form-section">
                <div class="section-title">
                    <div class="section-icon">📅</div>
                    Información de Registro
                </div>
                
                <div class="form-grid">
                    <div class="form-group">
                        <label for="hist_fecha_registro">Fecha de Registro</label>
                        <input type="date" id="hist_fecha_registro" name="hist_fecha_registro">
                    </div>
                    
                    <div class="form-group">
                        <label for="hist_creada_por">Creada por</label>
                        <input type="text" id="hist_creada_por" name="hist_creada_por">
                    </div>
                    
                    <div class="form-group">
                        <label for="hist_fechos_actualizacion">Fecha de Actualización</label>
                        <input type="date" id="hist_fechos_actualizacion" name="hist_fechos_actualizacion">
                    </div>
                    
                    <div class="form-group">
                        <label for="hist_actualizado_por">Actualizado por</label>
                        <input type="text" id="hist_actualizado_por" name="hist_actualizado_por">
                    </div>
                </div>
            </div>

            <!-- Botones -->
            <div class="button-group">
                <button type="button" class="btn-base btn-secondary" onclick="window.history.back()">
                    <i class="fa-solid fa-times"></i>
                    Cancelar
                </button>
                <button type="submit" class="btn-base btn-primary">
                    <i class="fa-solid fa-save"></i>
                    Actualizar Historia Clínica
                </button>
            </div>
        </form>
    </div>

  </body>
</html>
