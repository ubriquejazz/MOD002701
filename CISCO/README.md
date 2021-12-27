

## 004 - Seguridad L2 y WLAN

### 10 - Conceptos de Seguridad de LAN

10.1 - Seguridad Endpoint

* ESA, WSA

10.2 - Control de Acceso

- Autenticación con una contraseña local
- Componentes AAA
- 802.1x (port-based access control)

10.3 - Como mitigar amenazas de la Capa 2

* IPSG, DHCP Snooping
* Dynamic ARP Inspection

10.4 - Ataque de Tablas de Direcciones MAC

* MAC Address Table Flooding
* Port Security (Mitigate)

10.5 - Ataques a la LAN

- Video - VLAN y Ataques DHCP
- VLAN: hopping, double-tag
- DHCP: starvation, spoofing
- Video- Ataques ARP, Ataques STP, y Reconocimiento CDP
- ARP Poisoning Attack (MiM)
- Address Spoofing Attack (IPSG)

- Ataques STP
- CDP Reconnaissance

### 11 - Configuraciones de seguridad del Switch

[11.1 - Implementación de Seguridad de Puertos](https://contenthub.netacad.com/srwe-dl/9.1.1#11.1)

- [11.1.1 - Asegurar los puertos sin utilizar](https://contenthub.netacad.com/srwe-dl/9.1.1#11.1.1)  
- [11.1.2 - Mitigación de ataques por saturación de tabla de direcciones MAC](https://contenthub.netacad.com/srwe-dl/9.1.1#11.1.2)  
- [11.1.3 - Habilitar la seguridad del puerto.](https://contenthub.netacad.com/srwe-dl/9.1.1#11.1.3)  
- [11.1.4 - Limitar y Aprender MAC Addresses](https://contenthub.netacad.com/srwe-dl/9.1.1#11.1.4)  
- [11.1.5 - Vencimiento de la seguridad del puerto.](https://contenthub.netacad.com/srwe-dl/9.1.1#11.1.5)  
- [11.1.6 - Seguridad de puertos: modos de violación de seguridad](https://contenthub.netacad.com/srwe-dl/9.1.1#11.1.6)  
- [11.1.7 - Puertos en Estado error-disabled](https://contenthub.netacad.com/srwe-dl/9.1.1#11.1.7)  
- [11.1.8 - Verificar la seguridad del puerto](https://contenthub.netacad.com/srwe-dl/9.1.1#11.1.8)  
- [11.1.9 - Verificador de Sintaxis - Implementar Seguridad de Puerto](https://contenthub.netacad.com/srwe-dl/9.1.1#11.1.9) 
- [11.1.10 - Packet Tracer - Implementar la seguridad portuaria](https://contenthub.netacad.com/srwe-dl/9.1.1#11.1.10) 

[11.2 - Mitigación de ataques de VLAN](https://contenthub.netacad.com/srwe-dl/9.1.1#11.2)

- [11.2.1 - Revisión de ataques a VLAN](https://contenthub.netacad.com/srwe-dl/9.1.1#11.2.1)  
- [11.2.2 - Pasos para mitigar ataques de salto](https://contenthub.netacad.com/srwe-dl/9.1.1#11.2.2)  
- [11.2.3 - Mitigar ataques de brinco de VLAN](https://contenthub.netacad.com/srwe-dl/9.1.1#11.2.3) 

[11.3 - Mitigación de ataques de DHCP](https://contenthub.netacad.com/srwe-dl/9.1.1#11.3)

- [11.3.1 - Revisión de ataques DHCP](https://contenthub.netacad.com/srwe-dl/9.1.1#11.3.1)  
- [11.3.2 - Indagación de DHCP](https://contenthub.netacad.com/srwe-dl/9.1.1#11.3.2)  
- [11.3.3 - Pasos para implementar DHCP Snooping](https://contenthub.netacad.com/srwe-dl/9.1.1#11.3.3)  
- [11.3.4 - Un ejemplo de configuración de detección de DHCP.](https://contenthub.netacad.com/srwe-dl/9.1.1#11.3.4)  
- [11.3.5 - Comprobador de sintaxis: mitigar los ataques DHCP](https://contenthub.netacad.com/srwe-dl/9.1.1#11.3.5) 

[11.4 - Mitigación de ataques de ARP](https://contenthub.netacad.com/srwe-dl/9.1.1#11.4)

- [11.4.1 - Inspección dinámica de ARP](https://contenthub.netacad.com/srwe-dl/9.1.1#11.4.1)  
- [11.4.2 - Pautas de implementación DAI](https://contenthub.netacad.com/srwe-dl/9.1.1#11.4.2)  
- [11.4.3 - Ejemplo de configuración DAI](https://contenthub.netacad.com/srwe-dl/9.1.1#11.4.3)  
- [11.4.4 - Comprobador de sintaxis: mitigar los ataques ARP](https://contenthub.netacad.com/srwe-dl/9.1.1#11.4.4) 

[11.5 - Mitigación de ataques de STP](https://contenthub.netacad.com/srwe-dl/9.1.1#11.5)

- [11.5.1 - PortFast y protección BPDU](https://contenthub.netacad.com/srwe-dl/9.1.1#11.5.1)  
- [11.5.2 - Configure PortFast](https://contenthub.netacad.com/srwe-dl/9.1.1#11.5.2)  
- [11.5.3 - Configurar la protección BPDU](https://contenthub.netacad.com/srwe-dl/9.1.1#11.5.3)  
- [11.5.4 - Comprobador de sintaxis: mitigar los ataques STP](https://contenthub.netacad.com/srwe-dl/9.1.1#11.5.4) 

[11.6 - Práctica del módulo y cuestionario](https://contenthub.netacad.com/srwe-dl/9.1.1#11.6)

- [11.6.1 - Packet Tracer - Configuración de seguridad en el Switch](https://contenthub.netacad.com/srwe-dl/9.1.1#11.6.1) 
- [11.6.2 - Lab - Configuración de Seguridad en el Switch](https://contenthub.netacad.com/srwe-dl/9.1.1#11.6.2) 
- [11.6.3 - ¿Qué aprenderé en este módulo?](https://contenthub.netacad.com/srwe-dl/9.1.1#11.6.3)  

## 12 - Conceptos WLAN

[12.1 - Introducción a la tecnología inalámbrica](https://contenthub.netacad.com/srwe-dl/9.1.1#12.1)

- [12.1.1 - Beneficios de redes inalámbricas](https://contenthub.netacad.com/srwe-dl/9.1.1#12.1.1)  
- [12.1.2 - Tipos de redes inalámbricas](https://contenthub.netacad.com/srwe-dl/9.1.1#12.1.2)  
- [12.1.3 - Tecnologías inalámbricas](https://contenthub.netacad.com/srwe-dl/9.1.1#12.1.3)  
- [12.1.4 - Estándares de Wi-Fi 802.11](https://contenthub.netacad.com/srwe-dl/9.1.1#12.1.4)  
- [12.1.5 - Radiofrecuencia](https://contenthub.netacad.com/srwe-dl/9.1.1#12.1.5)  
- [12.1.6 - Organizaciones de estándares inalámbricos](https://contenthub.netacad.com/srwe-dl/9.1.1#12.1.6)  

[12.2 - Componentes de la WLAN](https://contenthub.netacad.com/srwe-dl/9.1.1#12.2)

- [12.2.1 - Video – Componentes WLAN](https://contenthub.netacad.com/srwe-dl/9.1.1#12.2.1) 
- [12.2.2 - NIC inalámbrica](https://contenthub.netacad.com/srwe-dl/9.1.1#12.2.2)  
- [12.2.3 - Router de hogar inalámbrico](https://contenthub.netacad.com/srwe-dl/9.1.1#12.2.3)  
- [12.2.4 - Puntos de acceso inalámbrico](https://contenthub.netacad.com/srwe-dl/9.1.1#12.2.4)  
- [12.2.5 - Categorías AP](https://contenthub.netacad.com/srwe-dl/9.1.1#12.2.5)  
- [12.2.6 - Antenas inalámbricas](https://contenthub.netacad.com/srwe-dl/9.1.1#12.2.6)  

[12.3 - Funcionamiento de WLAN](https://contenthub.netacad.com/srwe-dl/9.1.1#12.3)

- [12.3.1 - Video – Operación de la WLAN](https://contenthub.netacad.com/srwe-dl/9.1.1#12.3.1) 
- [12.3.2 - Modos de topología inalámbrica](https://contenthub.netacad.com/srwe-dl/9.1.1#12.3.2)  
- [12.3.3 - BSS y ESS](https://contenthub.netacad.com/srwe-dl/9.1.1#12.3.3)  
- [12.3.4 - 802.11 Estructura del Frame](https://contenthub.netacad.com/srwe-dl/9.1.1#12.3.4)  
- [12.3.5 - CSMA/CA](https://contenthub.netacad.com/srwe-dl/9.1.1#12.3.5)  
- [12.3.6 - Asociación de AP de cliente inalámbrico](https://contenthub.netacad.com/srwe-dl/9.1.1#12.3.6)  
- [12.3.7 - Modo de entrega pasiva y activa](https://contenthub.netacad.com/srwe-dl/9.1.1#12.3.7)  

[12.4 - Funcionamiento de CAPWAP](https://contenthub.netacad.com/srwe-dl/9.1.1#12.4)

- [12.4.1 - Video - CAPWAP](https://contenthub.netacad.com/srwe-dl/9.1.1#12.4.1) 
- [12.4.2 - Introducción a la CAPWAP](https://contenthub.netacad.com/srwe-dl/9.1.1#12.4.2)  
- [12.4.3 - Arquitectura MAC dividida](https://contenthub.netacad.com/srwe-dl/9.1.1#12.4.3)  
- [12.4.4 - Encriptación de DTLS](https://contenthub.netacad.com/srwe-dl/9.1.1#12.4.4)  
- [12.4.5 - AP FlexConnect](https://contenthub.netacad.com/srwe-dl/9.1.1#12.4.5)  

[12.5 - Administración de canales](https://contenthub.netacad.com/srwe-dl/9.1.1#12.5)

- [12.5.1 - Canal de frecuencia de saturación](https://contenthub.netacad.com/srwe-dl/9.1.1#12.5.1)  
- [12.5.2 - Selección de canales](https://contenthub.netacad.com/srwe-dl/9.1.1#12.5.2)  
- [12.5.3 - Planifique la implementación de WLAN](https://contenthub.netacad.com/srwe-dl/9.1.1#12.5.3)  

[12.6 - Amenazas a la WLAN](https://contenthub.netacad.com/srwe-dl/9.1.1#12.6)

- [12.6.1 - Video– Amenazas en la WLAN](https://contenthub.netacad.com/srwe-dl/9.1.1#12.6.1) 
- [12.6.2 - Resumen de seguridad inalámbrica](https://contenthub.netacad.com/srwe-dl/9.1.1#12.6.2)  
- [12.6.3 - Ataques de DoS](https://contenthub.netacad.com/srwe-dl/9.1.1#12.6.3)  
- [12.6.4 - Puntos de acceso no autorizados](https://contenthub.netacad.com/srwe-dl/9.1.1#12.6.4)  
- [12.6.5 - Ataque man-in-the-middle](https://contenthub.netacad.com/srwe-dl/9.1.1#12.6.5)  

[12.7 - WLAN seguras](https://contenthub.netacad.com/srwe-dl/9.1.1#12.7)

- [12.7.1 - Video – WLAN seguras](https://contenthub.netacad.com/srwe-dl/9.1.1#12.7.1) 
- [12.7.2 - Encubrimiento SSID y filtrado de direcciones MAC](https://contenthub.netacad.com/srwe-dl/9.1.1#12.7.2)  
- [12.7.3 - 802.11 Métodos de autenticación originales](https://contenthub.netacad.com/srwe-dl/9.1.1#12.7.3)  
- [12.7.4 - Métodos de autenticación de clave compartida](https://contenthub.netacad.com/srwe-dl/9.1.1#12.7.4)  
- [12.7.5 - Autenticando a un usuario doméstico](https://contenthub.netacad.com/srwe-dl/9.1.1#12.7.5)  
- [12.7.6 - Métodos de encriptación](https://contenthub.netacad.com/srwe-dl/9.1.1#12.7.6)  
- [12.7.7 - Autenticación en la empresa](https://contenthub.netacad.com/srwe-dl/9.1.1#12.7.7)  
- [12.7.8 - WPA3](https://contenthub.netacad.com/srwe-dl/9.1.1#12.7.8)  

## 005 - Enrutamiento 

### 13 - Configuraciones de redes inalámbricas WLAN

- [13.1 - Configuración de WLAN del sitio remoto](https://contenthub.netacad.com/srwe-dl/9.1.1#13.1)
  - [13.1.1 - Video - Configuración de una red inalámbrica](https://contenthub.netacad.com/srwe-dl/9.1.1#13.1.1) 
  - [13.1.2 - Router inalámbrico](https://contenthub.netacad.com/srwe-dl/9.1.1#13.1.2)  
  - [13.1.3 - Conéctese al router inalámbrico.](https://contenthub.netacad.com/srwe-dl/9.1.1#13.1.3)  
  - [13.1.4 - Configuración básica de red](https://contenthub.netacad.com/srwe-dl/9.1.1#13.1.4)  
  - [13.1.5 - Configuración inalámbrica](https://contenthub.netacad.com/srwe-dl/9.1.1#13.1.5)  
  - [13.1.6 - Configuración de una red de Malla Inalámbrica](https://contenthub.netacad.com/srwe-dl/9.1.1#13.1.6)  
  - [13.1.7 - NAT para IPv4](https://contenthub.netacad.com/srwe-dl/9.1.1#13.1.7)  
  - [13.1.8 - Calidad de servicio](https://contenthub.netacad.com/srwe-dl/9.1.1#13.1.8)  
  - [13.1.9 - Reenvío de Puerto](https://contenthub.netacad.com/srwe-dl/9.1.1#13.1.9)  
  - [13.1.10 - Packet Tracer - Configurar una red inalámbrica](https://contenthub.netacad.com/srwe-dl/9.1.1#13.1.10) 
  - [13.1.11 - Práctica de laboratorio: Configuración de una red inalámbrica](https://contenthub.netacad.com/srwe-dl/9.1.1#13.1.11) 
- [13.2 - Configure una WLAN básica en el WLC](https://contenthub.netacad.com/srwe-dl/9.1.1#13.2)
  - [13.2.1 - Video - Configure una WLAN básica en el WLC](https://contenthub.netacad.com/srwe-dl/9.1.1#13.2.1) 
  - [13.2.2 - Topología WLC](https://contenthub.netacad.com/srwe-dl/9.1.1#13.2.2)  
  - [13.2.3 - Iniciar sesión en el WLC](https://contenthub.netacad.com/srwe-dl/9.1.1#13.2.3)  
  - [13.2.4 - Ver la información del punto de acceso](https://contenthub.netacad.com/srwe-dl/9.1.1#13.2.4)  
  - [13.2.5 - Configuración Avanzada](https://contenthub.netacad.com/srwe-dl/9.1.1#13.2.5)  
  - [13.2.6 - Configurar una WLAN](https://contenthub.netacad.com/srwe-dl/9.1.1#13.2.6)  
  - [13.2.7 - Configuración Básica de una WLAN en el WLC](https://contenthub.netacad.com/srwe-dl/9.1.1#13.2.7) 
- [13.3 - Configure una red inalámbrica WLAN WPA2 Enterprise en el WLC](https://contenthub.netacad.com/srwe-dl/9.1.1#13.3)
  - [13.3.1 - Video - Defina un servidor RADIUS y SNMP en el WLC.](https://contenthub.netacad.com/srwe-dl/9.1.1#13.3.1) 
  - [13.3.2 - SNMP y RADIUS](https://contenthub.netacad.com/srwe-dl/9.1.1#13.3.2)  
  - [13.3.3 - Configurar Información del Servidor SNMP](https://contenthub.netacad.com/srwe-dl/9.1.1#13.3.3)  
  - [13.3.4 - Configure los servidores RADIUS.](https://contenthub.netacad.com/srwe-dl/9.1.1#13.3.4)  
  - [13.3.5 - Video - Configurar una VLAN para una nueva WLAN](https://contenthub.netacad.com/srwe-dl/9.1.1#13.3.5) 
  - [13.3.6 - Topologia de direcciones en VLAN 5](https://contenthub.netacad.com/srwe-dl/9.1.1#13.3.6)  
  - [13.3.7 - Configurar una nueva interfaz](https://contenthub.netacad.com/srwe-dl/9.1.1#13.3.7)  
  - [13.3.8 - Video - Configurar el Alcance de DHCP](https://contenthub.netacad.com/srwe-dl/9.1.1#13.3.8) 
  - [13.3.9 - Configurar el Alcance DHCP](https://contenthub.netacad.com/srwe-dl/9.1.1#13.3.9)  
  - [13.3.10 - Video - Configure una red inalámbrica WLAN WPA2 Enterprise](https://contenthub.netacad.com/srwe-dl/9.1.1#13.3.10) 
  - [13.3.11 - Configure una red inalámbrica WLAN WPA2 Enterprise](https://contenthub.netacad.com/srwe-dl/9.1.1#13.3.11)  
  - [13.3.12 - Packet Tracer: Configuración de WLAN WPA2 Enterprise en el WLC](https://contenthub.netacad.com/srwe-dl/9.1.1#13.3.12) 
- [13.4 - Solución de problemas de WLAN](https://contenthub.netacad.com/srwe-dl/9.1.1#13.4)
  - [13.4.1 - Enfoques para la Solución de Problemas](https://contenthub.netacad.com/srwe-dl/9.1.1#13.4.1)  
  - [13.4.2 - Cliente Inalámbrico no está conectando](https://contenthub.netacad.com/srwe-dl/9.1.1#13.4.2)  
  - [13.4.3 - Resolución de Problemas cuando la red esta lenta.](https://contenthub.netacad.com/srwe-dl/9.1.1#13.4.3)  
  - [13.4.4 - Actualizar el Firmware](https://contenthub.netacad.com/srwe-dl/9.1.1#13.4.4)  
  - [13.4.5 - Packet Tracer: Solución de problemas WLAN](https://contenthub.netacad.com/srwe-dl/9.1.1#13.4.5) 

### 14 - Conceptos de enrutamiento

- [14.1 - Determinación de trayecto](https://contenthub.netacad.com/srwe-dl/9.1.1#14.1)
  - [14.1.1 - Dos funciones del router](https://contenthub.netacad.com/srwe-dl/9.1.1#14.1.1)  
  - [14.1.2 - Ejemplo de Funciones del router](https://contenthub.netacad.com/srwe-dl/9.1.1#14.1.2) 
  - [14.1.3 - Mejor ruta es igual a la coincidencia más larga](https://contenthub.netacad.com/srwe-dl/9.1.1#14.1.3)  
  - [14.1.4 - Ejemplo de coincidencia más larga de direcciones IPv4](https://contenthub.netacad.com/srwe-dl/9.1.1#14.1.4)  
  - [14.1.5 - Ejemplo de coincidencia más larga de direcciones IPv6](https://contenthub.netacad.com/srwe-dl/9.1.1#14.1.5)  
  - [14.1.6 - Creación de la tabla de enrutamiento](https://contenthub.netacad.com/srwe-dl/9.1.1#14.1.6)  
- [14.2 - Reenvío de paquetes](https://contenthub.netacad.com/srwe-dl/9.1.1#14.2)
  - [14.2.1 - Proceso de decisión de reenvío de paquetes](https://contenthub.netacad.com/srwe-dl/9.1.1#14.2.1)  
  - [14.2.2 - Reenvío de paquetes](https://contenthub.netacad.com/srwe-dl/9.1.1#14.2.2) 
  - [14.2.3 - Mecanismos de reenvío de paquetes](https://contenthub.netacad.com/srwe-dl/9.1.1#14.2.3)  
- [14.3 - Configuración básica de un router](https://contenthub.netacad.com/srwe-dl/9.1.1#14.3)
  - [14.3.1 - Topología](https://contenthub.netacad.com/srwe-dl/9.1.1#14.3.1)  
  - [14.3.2 - Comandos de Configuración](https://contenthub.netacad.com/srwe-dl/9.1.1#14.3.2)  
  - [14.3.3 - Comandos de verificación](https://contenthub.netacad.com/srwe-dl/9.1.1#14.3.3)  
  - [14.3.4 - Salida del comando de filtro](https://contenthub.netacad.com/srwe-dl/9.1.1#14.3.4)  
  - [14.3.5 - Packet Tracer - Revisión básica de la configuración del router](https://contenthub.netacad.com/srwe-dl/9.1.1#14.3.5) 
- [14.4 - Tabla de routing IP](https://contenthub.netacad.com/srwe-dl/9.1.1#14.4)
  - [14.4.1 - Origen de la ruta](https://contenthub.netacad.com/srwe-dl/9.1.1#14.4.1)  
  - [14.4.2 - Principios de la tabla de enrutamiento](https://contenthub.netacad.com/srwe-dl/9.1.1#14.4.2)  
  - [14.4.3 - Entradas de la tabla de routing](https://contenthub.netacad.com/srwe-dl/9.1.1#14.4.3)  
  - [14.4.4 - Redes conectadas directamente](https://contenthub.netacad.com/srwe-dl/9.1.1#14.4.4)  
  - [14.4.5 - Rutas estáticas](https://contenthub.netacad.com/srwe-dl/9.1.1#14.4.5)  
  - [14.4.6 - Rutas estáticas en la tabla de enrutamiento IP](https://contenthub.netacad.com/srwe-dl/9.1.1#14.4.6)  
  - [14.4.7 - Protocolos de routing dinámico](https://contenthub.netacad.com/srwe-dl/9.1.1#14.4.7)  
  - [14.4.8 - Rutas dinámicas en la tabla de enrutamiento IP](https://contenthub.netacad.com/srwe-dl/9.1.1#14.4.8)  
  - [14.4.9 - Ruta predeterminada](https://contenthub.netacad.com/srwe-dl/9.1.1#14.4.9)  
  - [14.4.10 - Estructura de una tabla de enrutamiento IPv4](https://contenthub.netacad.com/srwe-dl/9.1.1#14.4.10)  
  - [14.4.11 - Estructura de una tabla de enrutamiento IPv6](https://contenthub.netacad.com/srwe-dl/9.1.1#14.4.11)  
  - [14.4.12 - Distancia administrativa](https://contenthub.netacad.com/srwe-dl/9.1.1#14.4.12)  
- [14.5 - Enrutamiento estático y dinámico](https://contenthub.netacad.com/srwe-dl/9.1.1#14.5)
  - [14.5.1 - ¿Estático o dinámico?](https://contenthub.netacad.com/srwe-dl/9.1.1#14.5.1)  
  - [14.5.2 - Evolución del protocolo de routing dinámico](https://contenthub.netacad.com/srwe-dl/9.1.1#14.5.2)  
  - [14.5.3 - Conceptos de Protocolos de routing dinámico](https://contenthub.netacad.com/srwe-dl/9.1.1#14.5.3) 
  - [14.5.4 - El mejor camino](https://contenthub.netacad.com/srwe-dl/9.1.1#14.5.4) 
  - [14.5.5 - Balance de carga](https://contenthub.netacad.com/srwe-dl/9.1.1#14.5.5) 
- [14.6 - Práctica del módulo y cuestionario](https://contenthub.netacad.com/srwe-dl/9.1.1#14.6)
  - [14.6.1 - ¿Qué aprenderé en este módulo?](https://contenthub.netacad.com/srwe-dl/9.1.1#14.6.1)  

### 15 - Rutas IP estáticas

- [15.1 - Rutas estáticas](https://contenthub.netacad.com/srwe-dl/9.1.1#15.1)
  - [15.1.1 - Tipos de rutas estáticas](https://contenthub.netacad.com/srwe-dl/9.1.1#15.1.1)  
  - [15.1.2 - Opciones de siguiente salto](https://contenthub.netacad.com/srwe-dl/9.1.1#15.1.2)  
  - [15.1.3 - Comando de ruta estática IPv4](https://contenthub.netacad.com/srwe-dl/9.1.1#15.1.3)  
  - [15.1.4 - Comando de ruta estática IPv6](https://contenthub.netacad.com/srwe-dl/9.1.1#15.1.4)  
  - [15.1.5 - Topología Dual-Stack](https://contenthub.netacad.com/srwe-dl/9.1.1#15.1.5)  
  
- [15.2 - Configuración de rutas estáticas IP](https://contenthub.netacad.com/srwe-dl/9.1.1#15.2)
  - [15.2.1 - Ruta estática IPv4 de siguiente salto](https://contenthub.netacad.com/srwe-dl/9.1.1#15.2.1)  
  - [15.2.2 - Ruta estática IPv6 de siguiente salto](https://contenthub.netacad.com/srwe-dl/9.1.1#15.2.2)  
  - [15.2.3 - Ruta Estática IPv4 Conectada Directamente](https://contenthub.netacad.com/srwe-dl/9.1.1#15.2.3)  
  - [15.2.4 - Ruta Estática IPv6 Conectada Directamente](https://contenthub.netacad.com/srwe-dl/9.1.1#15.2.4)  
  - [15.2.5 - Ruta estática completamente especificada IPv4](https://contenthub.netacad.com/srwe-dl/9.1.1#15.2.5)  
  - [15.2.6 - Ruta estática completamente especificada IPv6](https://contenthub.netacad.com/srwe-dl/9.1.1#15.2.6)  
  - [15.2.7 - Verificación de una ruta estática](https://contenthub.netacad.com/srwe-dl/9.1.1#15.2.7)  
  - [15.2.8 - Verificador de sintaxis- Configurar rutas estáticas](https://contenthub.netacad.com/srwe-dl/9.1.1#15.2.8) 
  
  
  
  ## 001 - Intoduction
  
  ### 1. Configuración básica de dispositivos
  
  1.1 - Configuración de parámetros iniciales de un switch
  
  - [1.1.1 - Secuencia de arranque de un switch](https://contenthub.netacad.com/srwe-dl/9.1.1#1.1.1)  
  - [1.1.2 - El comando boot system](https://contenthub.netacad.com/srwe-dl/9.1.1#1.1.2)  
  - [1.1.3 - Indicadores LED del switch](https://contenthub.netacad.com/srwe-dl/9.1.1#1.1.3)  
  - [1.1.4 - Recuperarse de un bloqueo del sistema](https://contenthub.netacad.com/srwe-dl/9.1.1#1.1.4)  
  - [1.1.5 - Acceso a administración de switches](https://contenthub.netacad.com/srwe-dl/9.1.1#1.1.5)  
  - [1.1.6 - Ejemplo de Configuración de Switch SVI](https://contenthub.netacad.com/srwe-dl/9.1.1#1.1.6)  
  - [1.1.7 - Práctica de laboratorio: configuración básica de un switch](https://contenthub.netacad.com/srwe-dl/9.1.1#1.1.7)   
  
  1.2 - Configuración de puertos de un switch
  
  - [1.2.1 - Comunicación dúplex](https://contenthub.netacad.com/srwe-dl/9.1.1#1.2.1)  
  - [1.2.2 - Configuración de puertos de switch en la capa física](https://contenthub.netacad.com/srwe-dl/9.1.1#1.2.2)  
  - [1.2.3 - Auto-MDIX (MDIX automático)](https://contenthub.netacad.com/srwe-dl/9.1.1#1.2.3)  
  - [1.2.4 - Switch Verification Commands](https://contenthub.netacad.com/srwe-dl/9.1.1#1.2.4)  
  - [1.2.5 - Verificar la configuración de puertos del switch.](https://contenthub.netacad.com/srwe-dl/9.1.1#1.2.5)  
  - [1.2.6 - Problemas de la capa de acceso a la red](https://contenthub.netacad.com/srwe-dl/9.1.1#1.2.6)  
  - [1.2.7 - Errores de entrada y salida de interfaz](https://contenthub.netacad.com/srwe-dl/9.1.1#1.2.7)  
  - [1.2.8 - Resolución de problemas de la capa de acceso a la red](https://contenthub.netacad.com/srwe-dl/9.1.1#1.2.8)  
  - [1.2.9 - Comprobador de sintaxis: configurar puertos de switch](https://contenthub.netacad.com/srwe-dl/9.1.1#1.2.9) 
  
  1.3 - Acceso remoto seguro
  
  - [1.3.1 - Operación Telnet](https://contenthub.netacad.com/srwe-dl/9.1.1#1.3.1)  
  - [1.3.2 - Funcionamiento de SSH](https://contenthub.netacad.com/srwe-dl/9.1.1#1.3.2)  
  - [1.3.3 - Verifique que el switch admita SSH](https://contenthub.netacad.com/srwe-dl/9.1.1#1.3.3)  
  - [1.3.4 - Configuración de SSH](https://contenthub.netacad.com/srwe-dl/9.1.1#1.3.4)  
  - [1.3.5 - Verifique que SSH esté operativo](https://contenthub.netacad.com/srwe-dl/9.1.1#1.3.5)  
  - [1.3.6 - Packet Tracer - Configurar SSH](https://contenthub.netacad.com/srwe-dl/9.1.1#1.3.6) 
  
  1.4 - Configuración básica de un router
  
  - [1.4.1 - Configuración de parámetros básicos del router](https://contenthub.netacad.com/srwe-dl/9.1.1#1.4.1)  
  - [1.4.2 - Comprobador de sintaxis - Configurar los ajustes básicos del router](https://contenthub.netacad.com/srwe-dl/9.1.1#1.4.2) 
  - [1.4.3 - Topología de doble pila](https://contenthub.netacad.com/srwe-dl/9.1.1#1.4.3)  
  - [1.4.4 - Configurar interfaces de routers](https://contenthub.netacad.com/srwe-dl/9.1.1#1.4.4)  
  - [1.4.5 - Comprobador de sintaxis - Configurar interfaces de router](https://contenthub.netacad.com/srwe-dl/9.1.1#1.4.5) 
  - [1.4.6 - Interfaces de bucle invertido IPv4](https://contenthub.netacad.com/srwe-dl/9.1.1#1.4.6)  
  - [1.4.7 - Packet Tracer- Configurar Interfaces de Router](https://contenthub.netacad.com/srwe-dl/9.1.1#1.4.7) 
  
  1.5 - Verificar redes conectadas directamente
  
  - [1.5.1 - Comandos de verificación de interfaz](https://contenthub.netacad.com/srwe-dl/9.1.1#1.5.1)  
  - [1.5.2 - Verificación del estado de una interfaz](https://contenthub.netacad.com/srwe-dl/9.1.1#1.5.2)  
  - [1.5.3 - Verificar direcciones locales y multidifusión de vínculos IPv6](https://contenthub.netacad.com/srwe-dl/9.1.1#1.5.3)  
  - [1.5.4 - Verificar la configuración de la interfaz](https://contenthub.netacad.com/srwe-dl/9.1.1#1.5.4)  
  - [1.5.5 - Verificar rutas](https://contenthub.netacad.com/srwe-dl/9.1.1#1.5.5)  
  - [1.5.6 - Filtrado de los resultados del comando show](https://contenthub.netacad.com/srwe-dl/9.1.1#1.5.6)  
  - [1.5.7 - Comprobador de sintaxis - Salida del comando Mostrar filtro](https://contenthub.netacad.com/srwe-dl/9.1.1#1.5.7) 
  - [1.5.8 - Historial de comandos](https://contenthub.netacad.com/srwe-dl/9.1.1#1.5.8)  
  - [1.5.9 - Comprobador de sintaxis - Características del historial de comandos](https://contenthub.netacad.com/srwe-dl/9.1.1#1.5.9) 
  - [1.5.10 - Packet Tracer: verificar redes conectadas directamente](https://contenthub.netacad.com/srwe-dl/9.1.1#1.5.10) 
  
  ### 2. Conceptos de switching
  
  2.1 - Reenvío de tramas
  
  - [2.1.1 - Switching en la red](https://contenthub.netacad.com/srwe-dl/9.1.1#2.1.1) 
  - [2.1.2 - Tabla de direcciones MAC del switch](https://contenthub.netacad.com/srwe-dl/9.1.1#2.1.2)  
  - [2.1.3 - El método Aprender y Reenviar del Switch](https://contenthub.netacad.com/srwe-dl/9.1.1#2.1.3)  
  - [2.1.4 - Video: Tablas de direcciones MAC en switches conectados](https://contenthub.netacad.com/srwe-dl/9.1.1#2.1.4) 
  - [2.1.5 - Métodos de reenvío del switch](https://contenthub.netacad.com/srwe-dl/9.1.1#2.1.5)  
  - [2.1.6 - Intercambio de almacenamiento y reenvío](https://contenthub.netacad.com/srwe-dl/9.1.1#2.1.6)  
  - [2.1.7 - Switching por método de corte](https://contenthub.netacad.com/srwe-dl/9.1.1#2.1.7)  
  
  2.2 - Dominios de switching
  
  - [2.2.1 - Dominios de colisiones](https://contenthub.netacad.com/srwe-dl/9.1.1#2.2.1)  
  - [2.2.2 - Dominios de difusión](https://contenthub.netacad.com/srwe-dl/9.1.1#2.2.2) 
  - [2.2.3 - Alivio de la congestión en la red](https://contenthub.netacad.com/srwe-dl/9.1.1#2.2.3)  
  
  ### 3. VLANs
  
  3.1 - Descripción general de las VLAN
  
  - [3.1.1 - Definiciones de VLAN](https://contenthub.netacad.com/srwe-dl/9.1.1#3.1.1)  
  - [3.1.2 - Ventajas de un diseño de VLAN](https://contenthub.netacad.com/srwe-dl/9.1.1#3.1.2)  
  - [3.1.3 - Tipos de VLAN](https://contenthub.netacad.com/srwe-dl/9.1.1#3.1.3)  
  - [3.1.4 - Packet Tracer: ¿quién escucha la difusión?](https://contenthub.netacad.com/srwe-dl/9.1.1#3.1.4) 
  
  3.2 - Redes VLAN en un entorno multiswitch
  
  - [3.2.1 - Definición de troncos de VLAN](https://contenthub.netacad.com/srwe-dl/9.1.1#3.2.1)  
  - [3.2.2 - Redes sin VLAN](https://contenthub.netacad.com/srwe-dl/9.1.1#3.2.2) 
  - [3.2.3 - Red con VLAN](https://contenthub.netacad.com/srwe-dl/9.1.1#3.2.3) 
  - [3.2.4 - Identificación de VLAN con etiqueta](https://contenthub.netacad.com/srwe-dl/9.1.1#3.2.4)  
  - [3.2.5 - VLAN nativas y etiquetado de 802.1Q](https://contenthub.netacad.com/srwe-dl/9.1.1#3.2.5)  
  - [3.2.6 - Etiquetado de VLAN de voz](https://contenthub.netacad.com/srwe-dl/9.1.1#3.2.6)  
  - [3.2.7 - Ejemplo de verificación de VLAN de voz](https://contenthub.netacad.com/srwe-dl/9.1.1#3.2.7)  
  - [3.2.8 - Packet Tracer: investigación de la implementación de una VLAN](https://contenthub.netacad.com/srwe-dl/9.1.1#3.2.8) 
  - [3.2.9 - Compruebe su comprensión - VLAN en un entorno de multiswitch](https://contenthub.netacad.com/srwe-dl/9.1.1#3.2.9) 
  
  3.3 - Configuración de VLAN
  
  - [3.3.1 - Rangos de VLAN en los switches Catalyst](https://contenthub.netacad.com/srwe-dl/9.1.1#3.3.1)  
  - [3.3.2 - Comandos de creación de VLAN](https://contenthub.netacad.com/srwe-dl/9.1.1#3.3.2)  
  - [3.3.3 - Ejemplo de creación de VLAN](https://contenthub.netacad.com/srwe-dl/9.1.1#3.3.3)  
  - [3.3.4 - Comandos de asignación de puertos VLAN](https://contenthub.netacad.com/srwe-dl/9.1.1#3.3.4)  
  - [3.3.5 - Ejemplo de asignación de puerto VLAN](https://contenthub.netacad.com/srwe-dl/9.1.1#3.3.5)  
  - [3.3.6 - VLAN de voz, datos](https://contenthub.netacad.com/srwe-dl/9.1.1#3.3.6)  
  - [3.3.7 - Ejemplo de VLAN de voz y datos](https://contenthub.netacad.com/srwe-dl/9.1.1#3.3.7)  
  - [3.3.8 - Verificar la información de la VLAN](https://contenthub.netacad.com/srwe-dl/9.1.1#3.3.8)  
  - [3.3.9 - Cambio de pertenencia de puertos de una VLAN](https://contenthub.netacad.com/srwe-dl/9.1.1#3.3.9)  
  - [3.3.10 - Eliminar las VLAN](https://contenthub.netacad.com/srwe-dl/9.1.1#3.3.10)  
  - [3.3.11 - Comprobador de sintaxis - Configuración de VLAN](https://contenthub.netacad.com/srwe-dl/9.1.1#3.3.11) 
  - [3.3.12 - Packet Tracer: Configuración de redes VLAN](https://contenthub.netacad.com/srwe-dl/9.1.1#3.3.12) 
  
  3.4 - Enlaces troncales de la VLAN
  
  - [3.4.1 - Comandos de configuración troncal](https://contenthub.netacad.com/srwe-dl/9.1.1#3.4.1)  
  - [3.4.2 - Ejemplo de configuración de troncal](https://contenthub.netacad.com/srwe-dl/9.1.1#3.4.2)  
  - [3.4.3 - Verifique la configuración de enlaces troncales.](https://contenthub.netacad.com/srwe-dl/9.1.1#3.4.3)  
  - [3.4.4 - Restablecimiento del enlace troncal al estado predeterminado](https://contenthub.netacad.com/srwe-dl/9.1.1#3.4.4)  
  - [3.4.5 - Packet Tracer: Configuración de enlaces troncales](https://contenthub.netacad.com/srwe-dl/9.1.1#3.4.5) 
  - [3.4.6 - Práctica de laboratorio: Configuración de redes VLAN y enlaces troncales](https://contenthub.netacad.com/srwe-dl/9.1.1#3.4.6)   
  
  3.5 - Dynamic Trunk Protocol (DTP)
  
  - [3.5.1 - Introducción a DTP](https://contenthub.netacad.com/srwe-dl/9.1.1#3.5.1)  
  - [3.5.2 - Modos de interfaz negociados](https://contenthub.netacad.com/srwe-dl/9.1.1#3.5.2)  
  - [3.5.3 - Resultados de una configuración DTP](https://contenthub.netacad.com/srwe-dl/9.1.1#3.5.3)  
  - [3.5.4 - Verificación del modo de DTP](https://contenthub.netacad.com/srwe-dl/9.1.1#3.5.4)  
  - [3.5.5 - Packet Tracer: Configuración de DTP](https://contenthub.netacad.com/srwe-dl/9.1.1#3.5.5) 
  
  ### 4 - Inter-VLAN Routing
  
  4.1 - Funcionamiento de Inter-VLAN Routing
  
  - [4.1.1 - ¿Qué es Inter-VLAN Routing](https://contenthub.netacad.com/srwe-dl/9.1.1#4.1.1)  
  - [4.1.2 - Inter-VLAN Routing heredado](https://contenthub.netacad.com/srwe-dl/9.1.1#4.1.2)  
  - [4.1.3 - Router-on-a-Stick Inter-VLAN Routing](https://contenthub.netacad.com/srwe-dl/9.1.1#4.1.3) 
  - [4.1.4 - Inter-VLAN Routing en un switch de capa 3](https://contenthub.netacad.com/srwe-dl/9.1.1#4.1.4)  
  
  4.2 - Routing entre VLAN con router-on-a-stick
  
  - [4.2.1 - Escenario Router-on-a-Stick](https://contenthub.netacad.com/srwe-dl/9.1.1#4.2.1)  
  - [4.2.2 - S1 VLAN and configuraciones de enlaces troncales](https://contenthub.netacad.com/srwe-dl/9.1.1#4.2.2)  
  - [4.2.3 - S2 VLAN y configuraciones de enlaces troncales](https://contenthub.netacad.com/srwe-dl/9.1.1#4.2.3)  
  - [4.2.4 - Configuración de subinterfaces de R1](https://contenthub.netacad.com/srwe-dl/9.1.1#4.2.4)  
  - [4.2.5 - Verificar la conectividad entre PC1 y PC2](https://contenthub.netacad.com/srwe-dl/9.1.1#4.2.5)  
  - [4.2.6 - Verificación de Router-on-a-Stick Inter-VLAN Routing](https://contenthub.netacad.com/srwe-dl/9.1.1#4.2.6)  
  - [4.2.7 - Packet Tracer - Configure Router-on-a-Stick Inter-VLAN Routing](https://contenthub.netacad.com/srwe-dl/9.1.1#4.2.7) 
  - [4.2.8 - Lab - Configure Router-on-a-Stick Inter-VLAN Routing](https://contenthub.netacad.com/srwe-dl/9.1.1#4.2.8) 
  
  4.3 - Inter-VLAN Routing usando switches de capa 3
  
  - [4.3.1 - Inter-VLAN Routing en Switch de capa 3](https://contenthub.netacad.com/srwe-dl/9.1.1#4.3.1)  
  - [4.3.2 - Escenario de switch de capa 3](https://contenthub.netacad.com/srwe-dl/9.1.1#4.3.2)  
  - [4.3.3 - Configuracion de switch de capa 3](https://contenthub.netacad.com/srwe-dl/9.1.1#4.3.3)  
  - [4.3.4 - Verificación Inter-VLAN Routing del switch de capa 3](https://contenthub.netacad.com/srwe-dl/9.1.1#4.3.4)  
  - [4.3.5 - Enrutamiento en un switch de capa 3](https://contenthub.netacad.com/srwe-dl/9.1.1#4.3.5)  
  - [4.3.6 - Escenario de enrutamiento en un switch de capa 3](https://contenthub.netacad.com/srwe-dl/9.1.1#4.3.6)  
  - [4.3.7 - Configuración de enrutamiento en un switch de capa 3](https://contenthub.netacad.com/srwe-dl/9.1.1#4.3.7)  
  - [4.3.8 - Packet Tracer - Configurar switch de capa 3 e Inter-VLAN Routing](https://contenthub.netacad.com/srwe-dl/9.1.1#4.3.8) 
  
  4.4 - Resolución de problemas de Inter-VLAN routing
  
  - [4.4.1 - Problemas comunes de Inter-VLAN routing](https://contenthub.netacad.com/srwe-dl/9.1.1#4.4.1)  
  - [4.4.2 - Escenario de resolución de problemas de Inter-VLAN Routing](https://contenthub.netacad.com/srwe-dl/9.1.1#4.4.2)  
  - [4.4.3 - VLAN faltantes](https://contenthub.netacad.com/srwe-dl/9.1.1#4.4.3)  
  - [4.4.4 - Problemas con el puerto troncal del switch](https://contenthub.netacad.com/srwe-dl/9.1.1#4.4.4)  
  - [4.4.5 - Problemas en los puertos de acceso de switch](https://contenthub.netacad.com/srwe-dl/9.1.1#4.4.5)  
  - [4.4.6 - Temas de configuración del router](https://contenthub.netacad.com/srwe-dl/9.1.1#4.4.6)  
  - [4.4.8 - Packet Tracer: resolución de problemas de inter-VLAN routing](https://contenthub.netacad.com/srwe-dl/9.1.1#4.4.8) 
  - [4.4.9 - Práctica de laboratorio: resolución de problemas de inter-VLAN routing](https://contenthub.netacad.com/srwe-dl/9.1.1#4.4.9)   
  
  ## 002 - Redes Redundantes
  
  ### 5 - STP Concepts
  
  5.1 - Propósito del STP
  
  - [5.1.1 - Redundancia en redes conmutadas de capa 2](https://contenthub.netacad.com/srwe-dl/9.1.1#5.1.1)  
  - [5.1.2 - Protocolo de árbol de extensión](https://contenthub.netacad.com/srwe-dl/9.1.1#5.1.2) 
  - [5.1.3 - Recalcular STP](https://contenthub.netacad.com/srwe-dl/9.1.1#5.1.3) 
  - [5.1.4 - Problemas con los vínculos de switch redundantes](https://contenthub.netacad.com/srwe-dl/9.1.1#5.1.4)  
  - [5.1.5 - Bucles de la capa 2](https://contenthub.netacad.com/srwe-dl/9.1.1#5.1.5) 
  - [5.1.6 - Tormenta de difusión (Broadcast Storm)](https://contenthub.netacad.com/srwe-dl/9.1.1#5.1.6) 
  - [5.1.7 - El algoritmo de árbol de expansión](https://contenthub.netacad.com/srwe-dl/9.1.1#5.1.7)  
  - [5.1.8 - Vídeo - Observar la operación STP](https://contenthub.netacad.com/srwe-dl/9.1.1#5.1.8) 
  
  5.2 - Funcionamientos del STP
  
  - [5.2.1 - Pasos para una topología sin bucles](https://contenthub.netacad.com/srwe-dl/9.1.1#5.2.1)  
  - [5.2.2 - 1. Elige el root bridge](https://contenthub.netacad.com/srwe-dl/9.1.1#5.2.2)  
  - [5.2.3 - Impacto de las pujas por defecto](https://contenthub.netacad.com/srwe-dl/9.1.1#5.2.3)  
  - [5.2.4 - Determinar el costo de la ruta raíz](https://contenthub.netacad.com/srwe-dl/9.1.1#5.2.4)  
  - [5.2.5 - 2. Elegir los puertos raíz](https://contenthub.netacad.com/srwe-dl/9.1.1#5.2.5)  
  - [5.2.6 - 3. Seleccionar puertos designados](https://contenthub.netacad.com/srwe-dl/9.1.1#5.2.6)  
  - [5.2.7 - 4. Seleccionar puertos alternativos (bloqueados)](https://contenthub.netacad.com/srwe-dl/9.1.1#5.2.7)  
  - [5.2.8 - Seleccione un puerto raíz a partir de varias rutas de igual coste](https://contenthub.netacad.com/srwe-dl/9.1.1#5.2.8)  
  - [5.2.9 - Temporizadores STP y Estados de puerto](https://contenthub.netacad.com/srwe-dl/9.1.1#5.2.9)  
  - [5.2.10 - Detalles Operativos de cada Estado Portuario](https://contenthub.netacad.com/srwe-dl/9.1.1#5.2.10)  
  - [5.2.11 - Per-VLAN Spanning Tree](https://contenthub.netacad.com/srwe-dl/9.1.1#5.2.11)  
  
  5.3 - Evolución del STP
  
  - [5.3.1 - Diferentes versiones de STP](https://contenthub.netacad.com/srwe-dl/9.1.1#5.3.1)  
  - [5.3.2 - Conceptos de RSTP](https://contenthub.netacad.com/srwe-dl/9.1.1#5.3.2)  
  - [5.3.3 - Estados de puerto RSTP y roles de puerto](https://contenthub.netacad.com/srwe-dl/9.1.1#5.3.3)  
  - [5.3.4 - PortFast y protección BPDU](https://contenthub.netacad.com/srwe-dl/9.1.1#5.3.4)  
  - [5.3.5 - Alternativas a STP](https://contenthub.netacad.com/srwe-dl/9.1.1#5.3.5)  
  
  ### 6 - EtherChannel
  
  6.1 - Funcionamiento de EtherChannel
  
  - [6.1.1 - Añadidura de enlaces](https://contenthub.netacad.com/srwe-dl/9.1.1#6.1.1)  
  - [6.1.2 - EtherChannel](https://contenthub.netacad.com/srwe-dl/9.1.1#6.1.2)  
  - [6.1.3 - Ventajas de EtherChannel](https://contenthub.netacad.com/srwe-dl/9.1.1#6.1.3)  
  - [6.1.4 - Restricciones de implementación](https://contenthub.netacad.com/srwe-dl/9.1.1#6.1.4)  
  - [6.1.5 - Protocolos de negociación automática](https://contenthub.netacad.com/srwe-dl/9.1.1#6.1.5)  
  - [6.1.6 - Funcionamiento PAgP](https://contenthub.netacad.com/srwe-dl/9.1.1#6.1.6)  
  - [6.1.7 - Ejemplo de configuración del modo PAgP](https://contenthub.netacad.com/srwe-dl/9.1.1#6.1.7)  
  - [6.1.8 - Operación LACP](https://contenthub.netacad.com/srwe-dl/9.1.1#6.1.8)  
  - [6.1.9 - Ejemplo de configuración del modo LACP](https://contenthub.netacad.com/srwe-dl/9.1.1#6.1.9)  
  
  6.2 - Configuración de EtherChannel
  
  - [6.2.1 - Instrucciones de configuración](https://contenthub.netacad.com/srwe-dl/9.1.1#6.2.1)  
  - [6.2.2 - Ejemplo de Configuración de LACP](https://contenthub.netacad.com/srwe-dl/9.1.1#6.2.2)  
  - [6.2.3 - Verificador de sintaxis - Configuración EtherChannel](https://contenthub.netacad.com/srwe-dl/9.1.1#6.2.3) 
  - [6.2.4 - Packet Tracer - Configuración de EtherChannel](https://contenthub.netacad.com/srwe-dl/9.1.1#6.2.4) 
  
  6.3 - Verificación y solución de problemas de EtherChannel
  
  - [6.3.1 - Verificar EtherChannel](https://contenthub.netacad.com/srwe-dl/9.1.1#6.3.1)  
  - [6.3.2 - Common Issues with EtherChannel Configurations](https://contenthub.netacad.com/srwe-dl/9.1.1#6.3.2)  
  - [6.3.3 - Ejemplo de solucionar problemas de EtherChannel.](https://contenthub.netacad.com/srwe-dl/9.1.1#6.3.3)  
  - [6.3.4 - Packet Tracer: Solución de problemas de EtherChannel](https://contenthub.netacad.com/srwe-dl/9.1.1#6.3.4) 
  
  ## 003 - DHCP y FHRP
  
  ### 7 - DHCPv4
  
  [7.1 - Conceptos DHCPv4](https://contenthub.netacad.com/srwe-dl/9.1.1#7.1)
  
  - [7.1.1 - Servidor y cliente DHCPv4](https://contenthub.netacad.com/srwe-dl/9.1.1#7.1.1)  
  - [7.1.2 - Funcionamiento de DHCPv4](https://contenthub.netacad.com/srwe-dl/9.1.1#7.1.2)  
  - [7.1.3 - Pasos para obtener un arrendamiento](https://contenthub.netacad.com/srwe-dl/9.1.1#7.1.3)  
  - [7.1.4 - Pasos para renovar un contrato de arrendamiento](https://contenthub.netacad.com/srwe-dl/9.1.1#7.1.4)  
  
  [7.2 - Configure un servidor DHCPv4 del IOS de Cisco](https://contenthub.netacad.com/srwe-dl/9.1.1#7.2)
  
  - [7.2.1 - Servidor Cisco IOS DHCPv4](https://contenthub.netacad.com/srwe-dl/9.1.1#7.2.1)  
  - [7.2.2 - Pasos para configurar un servidor DHCPv4 del IOS de Cisco](https://contenthub.netacad.com/srwe-dl/9.1.1#7.2.2)  
  - [7.2.3 - Ejemplo de configuración](https://contenthub.netacad.com/srwe-dl/9.1.1#7.2.3)  
  - [7.2.4 - Comandos de verificación DHCPv4](https://contenthub.netacad.com/srwe-dl/9.1.1#7.2.4)  
  - [7.2.5 - Verifique que DHCPv4 esté operando](https://contenthub.netacad.com/srwe-dl/9.1.1#7.2.5)  
  - [7.2.6 - Verificador de sintaxis - Configuración de DHCPv4](https://contenthub.netacad.com/srwe-dl/9.1.1#7.2.6) 
  - [7.2.7 - Desactive el servidor DHCPv4 del IOS de Cisco](https://contenthub.netacad.com/srwe-dl/9.1.1#7.2.7)  
  - [7.2.8 - Retransmisión DHCPv4](https://contenthub.netacad.com/srwe-dl/9.1.1#7.2.8)  
  - [7.2.9 - Otras transmisiones de servicio retransmitidas](https://contenthub.netacad.com/srwe-dl/9.1.1#7.2.9)  
  - [7.2.10 - Packet Tracer - Configurar DHCPv4](https://contenthub.netacad.com/srwe-dl/9.1.1#7.2.10) 
  
  [7.3 - Configurar un router como cliente DHCPv4](https://contenthub.netacad.com/srwe-dl/9.1.1#7.3)
  
  - [7.3.1 - Cisco Router como cliente DHCPv4](https://contenthub.netacad.com/srwe-dl/9.1.1#7.3.1)  
  - [7.3.2 - Ejemplo de configuración](https://contenthub.netacad.com/srwe-dl/9.1.1#7.3.2)  
  - [7.3.3 - Enrutador doméstico como cliente DHCPv4](https://contenthub.netacad.com/srwe-dl/9.1.1#7.3.3)  
  - [7.3.4 - Verificador de sintaxis: configuración de un router como cliente DHCPv4](https://contenthub.netacad.com/srwe-dl/9.1.1#7.3.4) 
  
  ### 8 - SLAAC y DHCPv6
  
  - [8.1 - IPv6 GUA Assignment](https://contenthub.netacad.com/srwe-dl/9.1.1#8.1)
    - [8.1.1 - Configuración de host con IPv6](https://contenthub.netacad.com/srwe-dl/9.1.1#8.1.1)  
    - [8.1.2 - IPv6 Host Link-Local Address](https://contenthub.netacad.com/srwe-dl/9.1.1#8.1.2)  
    - [8.1.3 - IPv6 GUA Assignment](https://contenthub.netacad.com/srwe-dl/9.1.1#8.1.3)  
    - [8.1.4 - Tres flags de mensaje RA](https://contenthub.netacad.com/srwe-dl/9.1.1#8.1.4)  
  - [8.2 - SLAAC](https://contenthub.netacad.com/srwe-dl/9.1.1#8.2)
    - [8.2.1 - Descripción general de SLAAC](https://contenthub.netacad.com/srwe-dl/9.1.1#8.2.1)  
    - [8.2.2 - Activación de SLAAC](https://contenthub.netacad.com/srwe-dl/9.1.1#8.2.2)  
    - [8.2.3 - Método Sólo SLAAC](https://contenthub.netacad.com/srwe-dl/9.1.1#8.2.3)  
    - [8.2.4 - ICMPv6 RS Messages](https://contenthub.netacad.com/srwe-dl/9.1.1#8.2.4)  
    - [8.2.5 - Proceso de host para generar ID de interfaz](https://contenthub.netacad.com/srwe-dl/9.1.1#8.2.5)  
    - [8.2.6 - Detección de direcciones duplicadas](https://contenthub.netacad.com/srwe-dl/9.1.1#8.2.6)  
  - [8.3 - DHCPv6](https://contenthub.netacad.com/srwe-dl/9.1.1#8.3)
    - [8.3.1 - Pasos de operación DHCPv6](https://contenthub.netacad.com/srwe-dl/9.1.1#8.3.1)  
    - [8.3.2 - Operación DHCPv6 stateless](https://contenthub.netacad.com/srwe-dl/9.1.1#8.3.2)  
    - [8.3.3 - Habilitar DHCPv6 stateless en una interfaz](https://contenthub.netacad.com/srwe-dl/9.1.1#8.3.3)  
    - [8.3.4 - Operaciones de DHCPv6 stateful](https://contenthub.netacad.com/srwe-dl/9.1.1#8.3.4)  
    - [8.3.5 - Habilitar DHCPv6 stateful en una interfaz](https://contenthub.netacad.com/srwe-dl/9.1.1#8.3.5)  
  - [8.4 - Configure DHCPv6 Server](https://contenthub.netacad.com/srwe-dl/9.1.1#8.4)
    - [8.4.1 - Roles de router DHCPv6](https://contenthub.netacad.com/srwe-dl/9.1.1#8.4.1)  
    - [8.4.2 - Configurar un servidor DHCPv6 stateless.](https://contenthub.netacad.com/srwe-dl/9.1.1#8.4.2)  
    - [8.4.3 - Configurar un cliente DHCPv6 stateless.](https://contenthub.netacad.com/srwe-dl/9.1.1#8.4.3)  
    - [8.4.4 - Configurar un servidor DHCPv6 stateful.](https://contenthub.netacad.com/srwe-dl/9.1.1#8.4.4)  
    - [8.4.5 - Configurar un cliente DHCPv6 stateful.](https://contenthub.netacad.com/srwe-dl/9.1.1#8.4.5)  
    - [8.4.6 - Comandos de verificación del server DHCPv6](https://contenthub.netacad.com/srwe-dl/9.1.1#8.4.6)  
    - [8.4.7 - Configuración del agente de retransmisión DHCPv6](https://contenthub.netacad.com/srwe-dl/9.1.1#8.4.7)  
    - [8.4.8 - Verificar el agente de retransmisión de DHCPv6](https://contenthub.netacad.com/srwe-dl/9.1.1#8.4.8)  
  
  ### 9 - Conceptos de FHRP 
  
  9.1 - First Hop Redundacy Protocols
  
  - [9.1.1 - Limitaciones del Gateway Predeterminado](https://contenthub.netacad.com/srwe-dl/9.1.1#9.1.1)  
  - [9.1.2 - Redundancia del Router](https://contenthub.netacad.com/srwe-dl/9.1.1#9.1.2)  
  - [9.1.3 - Pasos para la Conmutación por Falla del Router](https://contenthub.netacad.com/srwe-dl/9.1.1#9.1.3)  
  - [9.1.4 - Opciones de FHRP](https://contenthub.netacad.com/srwe-dl/9.1.1#9.1.4)  
  
  9.2 - Host Standby Router Protocol 
  
  - [9.2.1 - HSRP: Descripción general](https://contenthub.netacad.com/srwe-dl/9.1.1#9.2.1)  
  - [9.2.2 - Prioridad e Intento de Prioridad del HSRP](https://contenthub.netacad.com/srwe-dl/9.1.1#9.2.2)  
  - [9.2.3 - Estados y Temporizadores de HSRP](https://contenthub.netacad.com/srwe-dl/9.1.1#9.2.3)  
  
  