            <!--Crear-->
                    <form id="crearForm" action="../../controllers/authController.php" method="POST" class="formulario__crear">
                        <h2>Crear usuario</h2>

                        <!-- Contenedor con scroll -->
                        <div class="form-scroll-inner">
                            <input type="text" placeholder="Nombre Completo" name="usua_nombre" id="nombre" required>

                            <select name="usua_tipo_documento" id="doc_tipo" required>
                                <option value="" disabled selected>Tipo de Documento</option>
                                <option value="1">Cédula</option>
                                <option value="2">Tarjeta de Identidad</option>
                                <option value="3">Pasaporte</option>
                            </select>

                            <input type="int" placeholder="Número de Documento" name="usua_documento" id="num_documento" required>
                            <input type="email" placeholder="Correo Electrónico" name="usua_correo_electronico" id="correo" required>
                            <input type="tel" placeholder="Número de Contacto" name="usua_num_contacto" id="contacto">
                            <input type="tel" placeholder="Número Secundario / Acudiente" name="usua_num_secundario" id="acudiente">
                            <input type="text" placeholder="Dirección" name="usua_direccion" id="direccion">
                            <input type="date" placeholder="Fecha de Nacimiento" name="usua_fecha_nacimiento" id="nacimiento">

                            <select name="usua_sexo" id="sexo" required>
                                <option value=""disabled selected>Sexo</option>
                                <option value="1">Masculino</option>
                                <option value="2">Femenino</option>
                            </select>

                            <select name="usua_rh" id="rh" required>
                                <option value=""disabled selected>Tipo de Sangre (RH)</option>
                                <option value="1">A+</option>
                                <option value="2">A-</option>
                                <option value="3">B+</option>
                                <option value="4">B-</option>
                                <option value="5">AB+</option>
                                <option value="6">AB-</option>
                                <option value="7">O+</option>
                                <option value="8">O-</option>
                            </select>

                            <input type="text" placeholder="EPS" name="usua_eps" id="eps">
                            <input type="password" placeholder="Contraseña" name="usua_password" id="contrasena" required>
                        </div>

                        <button type="submit" name="registrarUsuario">Crear</button>
                    </form>