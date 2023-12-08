# WebService, Caja de Compensación Del Caquetá

Servicio Publico WebService, para consulta de afiliados, información no confidencial.     

## Parametros de consulta:
    
TipoIdentificacion =
----
+ CC =	CEDULA CIUDADANIA
+ TI =	TARJETA IDENTIDAD
+ PT =	PERMISO PROTECCIóN TEMPORAL
+ RC =	REGISTRO CIVIL
+ CE =	CEDULA EXTRANJERIA
+ PEP =	PERMISO ESPECIAL DE PERMANENCIA
+ CD =	CARNET DIPLOMATICO
+ CB =	CERTIFICADO CABILDO
+ PA =	PASAPORTE
+ ISE =	IDENTIFICACIÓN POR SECRETARIA DE EDICACIÓN
+ V =	VISA
+ TMF =	TARJETA DE MOVILIDAD FRONTERIZA
    +  Máximo 3 caracteres

TipoAfiliado =
---
+ T =	Trabajador Dependiente
+ B =	Beneficiario
+ C =	Cónyuge
    + Máximo 1 caracter

CodigoCaja =
----
+ 13 =	COMFACA
    + Máximo 2 dígito
<br>

## Servicio Cliente REST

Ejemplo del Request usando el

+ URL = http://dominio:port/WebServiceNuevo/cliente.php
+ METHOD = POST
```json
{
   "TipoIdentificacion":"CC",
   "NumeroIdentificacion": "0000001",
   "CodigoCaja":"13",
   "TipoAfiliado":"T"
}
```

Ejemplo uso de CURL usando el servicio cliente:
```bash
curl -X POST -d '{"TipoIdentificacion":"CC","NumeroIdentificacion":"000000001","CodigoCaja":"13","TipoAfiliado":"T"}' \
-H 'Content-Type: application/json' \
http://186.119.116.228:8091/WebServiceNuevo/cliente.php
```

## WebService SOAP XML

+ URL = http://dominio:port/WebServiceNuevo/ConsultarAfiliado.php?wsdl
+ METHOD = POST
+ HEADER = Content-Type="text/xml"

```xml
<?xml version="1.0" encoding="ISO-8859-1"?>
 <SOAP-ENV:Envelope SOAP-ENV:encodingStyle="http://schemas.xmlsoap.org/soap/encoding/"
    xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/"
    xmlns:xsd="http://www.w3.org/2001/XMLSchema"
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xmlns:SOAP-ENC="http://schemas.xmlsoap.org/soap/encoding/" xmlns:tns="urn:ServicioAfiliado">
    <SOAP-ENV:Body>
      <tns:ConsultarAfiliado xmlns:tns="urn:ServicioAfiliado">
          <TipoIdentificacion>CC</TipoIdentificacion>
          <NumeroIdentificacion>000000001</NumeroIdentificacion>
          <TipoAfiliado>T</TipoAfiliado>
          <CodigoCaja>13</CodigoCaja>
      </tns:ConsultarAfiliado>
    </SOAP-ENV:Body>
</SOAP-ENV:Envelope>
```

