<? 
require_once './lib/LocalEnv.php';
LocalEnv::Init();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WebService COMFACA</title>
    <style>
        /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */
        html {
            line-height: 1.15;
            -webkit-text-size-adjust: 100%;
        }

        body {
            margin: 0;
        }

        a {
            background-color: transparent
        }

        [hidden] {
            display: none
        }

        html {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica Neue, Arial, Noto Sans, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji;
            line-height: 1.5
        }

        *,
        :after,
        :before {
            box-sizing: border-box;
            border: 0 solid #e2e8f0
        }

        a {
            color: inherit;
            text-decoration: inherit
        }

        svg,
        video {
            display: block;
            vertical-align: middle
        }

        video {
            max-width: 100%;
            height: auto
        }

        .bg-white {
            --bg-opacity: 1;
            background-color: #fff;
            background-color: rgba(255, 255, 255, var(--bg-opacity))
        }

        .bg-gray-100 {
            --bg-opacity: 1;
            background-color: #f7fafc;
            background-color: rgba(247, 250, 252, var(--bg-opacity))
        }

        .border-gray-200 {
            --border-opacity: 1;
            border-color: #edf2f7;
            border-color: rgba(237, 242, 247, var(--border-opacity))
        }

        .border-t {
            border-top-width: 1px
        }

        .flex {
            display: flex
        }

        .grid {
            display: grid
        }

        .hidden {
            display: none
        }

        .items-center {
            align-items: center
        }

        .justify-center {
            justify-content: center
        }

        .font-semibold {
            font-weight: 600
        }

        .h-5 {
            height: 1.25rem
        }

        .h-8 {
            height: 2rem
        }

        .h-16 {
            height: 4rem
        }

        .text-sm {
            font-size: .875rem
        }

        .text-lg {
            font-size: 1.125rem
        }

        .leading-7 {
            line-height: 1.75rem
        }

        .mx-auto {
            margin-left: auto;
            margin-right: auto
        }

        .ml-1 {
            margin-left: .25rem
        }

        .mt-2 {
            margin-top: .5rem
        }

        .mr-2 {
            margin-right: .5rem
        }

        .ml-2 {
            margin-left: .5rem
        }

        .mt-4 {
            margin-top: 1rem
        }

        .ml-4 {
            margin-left: 1rem
        }

        .mt-8 {
            margin-top: 2rem
        }

        .ml-12 {
            margin-left: 3rem
        }

        .-mt-px {
            margin-top: -1px
        }

        .max-w-6xl {
            max-width: 72rem
        }

        .min-h-screen {
            min-height: 100vh
        }

        .overflow-hidden {
            overflow: hidden
        }

        .p-6 {
            padding: 1.5rem
        }

        .py-4 {
            padding-top: 1rem;
            padding-bottom: 1rem
        }

        .px-6 {
            padding-left: 1.5rem;
            padding-right: 1.5rem
        }

        .pt-8 {
            padding-top: 2rem
        }

        .fixed {
            position: fixed
        }

        .relative {
            position: relative
        }

        .top-0 {
            top: 0
        }

        .right-0 {
            right: 0
        }

        .shadow {
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06)
        }

        .text-center {
            text-align: center
        }

        .text-gray-200 {
            --text-opacity: 1;
            color: #edf2f7;
            color: rgba(237, 242, 247, var(--text-opacity))
        }

        .text-gray-300 {
            --text-opacity: 1;
            color: #e2e8f0;
            color: rgba(226, 232, 240, var(--text-opacity))
        }

        .text-gray-400 {
            --text-opacity: 1;
            color: #cbd5e0;
            color: rgba(203, 213, 224, var(--text-opacity))
        }

        .text-gray-500 {
            --text-opacity: 1;
            color: #a0aec0;
            color: rgba(160, 174, 192, var(--text-opacity))
        }

        .text-gray-600 {
            --text-opacity: 1;
            color: #718096;
            color: rgba(113, 128, 150, var(--text-opacity))
        }

        .text-gray-700 {
            --text-opacity: 1;
            color: #4a5568;
            color: rgba(74, 85, 104, var(--text-opacity))
        }

        .text-gray-900 {
            --text-opacity: 1;
            color: #1a202c;
            color: rgba(26, 32, 44, var(--text-opacity))
        }

        .underline {
            text-decoration: underline
        }

        .antialiased {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale
        }

        .w-5 {
            width: 1.25rem
        }

        .w-8 {
            width: 2rem
        }

        .w-auto {
            width: auto
        }

        .grid-cols-1 {
            grid-template-columns: repeat(1, minmax(0, 1fr))
        }

        @media (min-width:640px) {
            .sm\:rounded-lg {
                border-radius: .5rem
            }

            .sm\:block {
                display: block
            }

            .sm\:items-center {
                align-items: center
            }

            .sm\:justify-start {
                justify-content: flex-start
            }

            .sm\:justify-between {
                justify-content: space-between
            }

            .sm\:h-20 {
                height: 5rem
            }

            .sm\:ml-0 {
                margin-left: 0
            }

            .sm\:px-6 {
                padding-left: 1.5rem;
                padding-right: 1.5rem
            }

            .sm\:pt-0 {
                padding-top: 0
            }

            .sm\:text-left {
                text-align: left
            }

            .sm\:text-right {
                text-align: right
            }
        }

        @media (min-width:768px) {
            .md\:border-t-0 {
                border-top-width: 0
            }

            .md\:border-l {
                border-left-width: 1px
            }

            .md\:grid-cols-2 {
                grid-template-columns: repeat(2, minmax(0, 1fr))
            }
        }

        @media (min-width:1024px) {
            .lg\:px-8 {
                padding-left: 2rem;
                padding-right: 2rem
            }
        }

        @media (prefers-color-scheme:dark) {
            .dark\:bg-gray-800 {
                --bg-opacity: 1;
                background-color: #35383d;
                background-color: rgba(40, 50, 70, var(--bg-opacity))
            }

            .dark\:bg-gray-600 {
                --bg-opacity: 1;
                background-color: rgba(60, 70, 90, var(--bg-opacity))
            }

            .dark\:bg-gray-900 {
                --bg-opacity: 1;
                background-color: #1a202c;
                background-color: rgba(26, 32, 44, var(--bg-opacity))
            }

            .dark\:border-gray-700 {
                --border-opacity: 1;
                border-color: #4a5568;
                border-color: rgba(74, 85, 104, var(--border-opacity))
            }

            .dark\:text-white {
                --text-opacity: 1;
                color: #fff;
                color: rgba(255, 255, 255, var(--text-opacity))
            }

            .dark\:text-gray-400 {
                --text-opacity: 1;
                color: #cbd5e0;
                color: rgba(203, 213, 224, var(--text-opacity))
            }

            .dark\:text-gray-500 {
                --tw-text-opacity: 1;
                color: #6b7280;
                color: rgba(107, 114, 128, var(--tw-text-opacity))
            }
        }

        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>
<body class="antialiased bg-white">
    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-800 sm:items-center py-4 sm:pt-0">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8" style="padding-top: 50px;">
            <div class="mt-5 bg-white dark:bg-gray-600 overflow-hidden shadow sm:rounded-lg">
                <div class="grid">
                    <div class="p-6">
                        <div class="flex">
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-500">
                                <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                            <div class="ml-4 text-lg leading-7 font-semibold">
                                <div class="text-gray-900 dark:text-white">Servicio De Consulta Afiliados, Caja de Compensación Del Caquetá</div>
                            </div>
                        </div>

                        <div class="ml-4">
                            <div class="mt-4 text-gray-600 dark:text-gray-400 text-sm">
                                <div class='text-center'><img src='./comfaca-min.png'  width="180rem;"/></div>
                                <p class='text-center'>Servicio WebService, para consulta de afiliados</p>
                                <h3 class='text-center'>Parametros de consulta:</h3>
                                

                                <table style="width:100%">
                                    <tbody>
                                        <tr>
                                            <td>TipoIdentificacion = </td>
                                            <td>
                                                <table>
                                                    <tr><td style="width: 20%;">CC =</td><td>CEDULA CIUDADANIA</td> </tr>
                                                    <tr><td>TI =</td><td>TARJETA IDENTIDAD </td></tr>
                                                    <tr><td>PT =</td><td>PERMISO PROTECCIóN TEMPORAL</td></tr>
                                                    <tr><td>RC =</td><td>REGISTRO CIVIL </td></tr>
                                                    <tr><td>CE =</td><td>CEDULA EXTRANJERIA </td></tr>
                                                    <tr><td>PEP =</td><td>PERMISO ESPECIAL DE PERMANENCIA </td></tr>
                                                    <tr><td>CD =</td><td>CARNET DIPLOMATICO</td></tr>
                                                    <tr><td>CB =</td><td>CERTIFICADO CABILDO </td></tr>
                                                    <tr><td>PA =</td><td>PASAPORTE </td></tr>
                                                    <tr><td>ISE =</td><td>IDENTIFICACIÓN POR SECRETARIA DE EDICACIÓN</td></tr>
                                                    <tr><td>V =</td><td>VISA </td></tr>
                                                    <tr><td>TMF =</td><td>TARJETA DE MOVILIDAD FRONTERIZA</td></tr>
                                                    <tr><td></td> <td>Máximo 3 caracteres</td> </tr>
                                                </table>
                                                <hr style="border:1px solid #ddd"/>
                                            </td>
                                        </tr>
        
                                        <tr>
                                            <td>TipoAfiliado = </td>
                                            <td>
                                                <table>
                                                    <tr><td style="width: 25%;">T =</td><td>Trabajador Dependiente</td> </tr>
                                                    <tr><td>B =</td><td>Beneficiario </td></tr>
                                                    <tr><td>C =</td><td>Cónyuge</td></tr>
                                                    <tr><td></td><td>Máximo 1 caracter</td> </tr>
                                                </table>
                                                <hr style="border:1px solid #ddd"/>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>CodigoCaja = </td>
                                            <td>
                                                <table>
                                                    <tr><td style="width: 25%;">13 =</td><td>COMFACA</td> </tr>
                                                    <tr><td></td><td>Máximo 2 dígito</td> </tr>
                                                </table>
                                                <hr style="border:1px solid #ddd"/>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>NumeroIdentificacion = </td>
                                            <td>
                                                <table>
                                                    <tr><td colspan="2">Máximo 18 dígitos</td> </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <br/>

                                <h3>Servicio Cliente REST</h3>
                                <p>Ejemplo del Request usando el<br/>
                                    URL = http://<?=LocalEnv::$server_name?>:<?=LocalEnv::$server_port?>/WebServiceNuevo/cliente.php<br/>
                                    METHOD = POST
                                </p>
                                <h3>Request Servicio Cliente REST</h3>
                                <div style="background-color: #333; border-radius:10px; padding:5px 20px">
                                    <code style='color:#ff985deb; font-weight: bold; font-size:1rem;'>
                                        {<br>
                                            &nbsp;&nbsp;&nbsp;"TipoIdentificacion":"CC",<br>
                                            &nbsp;&nbsp;&nbsp;"NumeroIdentificacion": "0000001",<br>
                                            &nbsp;&nbsp;&nbsp;"CodigoCaja":"13",<br>
                                            &nbsp;&nbsp;&nbsp;"TipoAfiliado":"T"<br>
                                        }
                                    </code>
                                </div>
                                <h3>Response Servicio Cliente REST</h3>
                                <div style="background-color: #333; border-radius:10px; padding:5px 20px">
                                    <code style='color:#ff985deb; font-weight: 400; font-size:1rem;'>
                                    {<br>
                                        &nbsp;&nbsp;&nbsp;"message": "Consulta realizada con éxito",<br>
                                        &nbsp;&nbsp;&nbsp;"response": [<br>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{<br>
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"TipoIdentificacion": "CEDULA CIUDADANIA",<br>
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"NumeroIdentificacion": "00000001",<br>
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"PrimerApellido": "Primer apellido",<br>
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"SegundoApellido": "Segundo  apellido",<br>
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"PrimerNombre": "Primer nombre",<br>
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"SegundoNombre": "Segundo nombre",<br>
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"FechaNacimiento": "1989-12-19",<br>
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"Categoria": "B",<br>
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"Estado": "ACTIVO",<br>
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"TipoAfiliado": "T"<br>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<br>
                                        &nbsp;&nbsp;]<br>
                                    }
                                    </code>
                                </div>

                                <br/>
                                <p>Ejemplo uso de CURL Versión 7.68, usando el servicio cliente:</p>
                                <div style="background-color: #333; border-radius:10px; padding:5px 20px">
                                    <code style='color:#fff; font-weight: 400; font-size:.70rem;'>
                                    curl -X POST http://<?=LocalEnv::$server_name?>:<?=LocalEnv::$server_port?>/WebServiceNuevo/cliente.php \<br> 
                                    -H 'Content-Type: application/json' \<br> 
                                    -d '{"TipoIdentificacion":"CC","NumeroIdentificacion":"000000001","CodigoCaja":"13","TipoAfiliado":"T"}'
                                    </code>
                                </div>
                                <br/>
                                <hr style="border:1px solid #ddd"/>
                                <br/>

                                <h3>WebService SOAP XML</h3>
                                <p>
                                El siguiente es un metodo alternativo para consulta de afiliados usando SOAP<br/>
                                URL = http://<?=LocalEnv::$server_name?>:<?=LocalEnv::$server_port?>/WebServiceNuevo/ConsultarAfiliado.php?wsdl<br/>
                                METHOD = POST <br/>
                                HEADER = Content-Type="text/xml"
                            </p>
                                <div style="background-color: #333; border-radius:10px; padding:5px 20px">
                                    <code class='brush: xml;' style='color:#3FCF2C; font-weight: 400; font-size:1rem;'>
                                    &lt;?xml version="1.0" encoding="ISO-8859-1"?&gt;<br>
                                    &nbsp;&lt;SOAP-ENV:Envelope SOAP-ENV:encodingStyle="http://schemas.xmlsoap.org/soap/encoding/"<br>
                                    &nbsp; &nbsp;xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/"<br>
                                    &nbsp; &nbsp;xmlns:xsd="http://www.w3.org/2001/XMLSchema"<br>
                                    &nbsp; &nbsp;xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"<br>
                                    &nbsp; &nbsp;xmlns:SOAP-ENC="http://schemas.xmlsoap.org/soap/encoding/" xmlns:tns="urn:ServicioAfiliado"&gt;<br>
                                    &nbsp; &nbsp; &nbsp;&lt;SOAP-ENV:Body&gt;<br>
                                    &nbsp; &nbsp; &nbsp; &nbsp;&lt;tns:ConsultarAfiliado xmlns:tns="urn:ServicioAfiliado"&gt;<br>
                                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&lt;TipoIdentificacion&gt;CC&lt;/TipoIdentificacion&gt;<br>
                                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&lt;NumeroIdentificacion&gt;000000001&lt;/NumeroIdentificacion&gt;<br>
                                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&lt;TipoAfiliado&gt;T&lt;/TipoAfiliado&gt;<br>
                                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&lt;CodigoCaja&gt;13&lt;/CodigoCaja&gt;<br>
                                    &nbsp; &nbsp; &nbsp; &nbsp;&lt;/tns:ConsultarAfiliado&gt;<br>
                                    &nbsp; &nbsp;&lt;/SOAP-ENV:Body&gt;<br>
                                            &nbsp;&lt;/SOAP-ENV:Envelope&gt;<br>
                                    </code>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>