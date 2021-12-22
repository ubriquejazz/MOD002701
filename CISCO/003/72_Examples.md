## 7.2 Configure DHCPv4 server

- 7.2.3 **Steps**

		1. Excluir direcciones
		R(config)# ip dhcp excluded-address 192.168.10.1 192.168.10.9

		2. Defina un nombre de grupo
		R(config)# ip dhcp pool LAN-POOL-1
		R(dhcp-config)# 

		3. Configure el grupo DHCPv4
		R(dhcp-config)# network 192.168.10.0/24
		R(dhcp-config)# default-router 192.168.10.1
		R(dhcp-config)# dns-server 192.168.11.5
		R(dhcp-config)# domain-name example.com
		R(dhcp-config)# lease 24 hours

- 7.2.4 **Verify commands**

		R1# show running-config | section dhcp
		R1# show ip dhcp binding
		R1# show ip dhcp server statistics
		R1# show ip interface g0/0/0

- 7.2.7 **Retransmisión DHCPv4**

		C:\Users\Student> ipconfig /release
		Configuración IP de Windows
		Ethernet adapter Ethernet0:

		C:\Users\Student> ipconfig /renew
		Error al renovar la interfaz Ethernet0: no se puede conectar al servidor DHCP. Expiró la solicitud.

		R1(config)# interface g0/0/0
		R1(config-if)# ip helper-address 192.168.11.6

		C:\Users\Student> ipconfig /all
		Ethernet adapter Ethernet0:
		Connection-specific DNS Suffix  . : example.com
		IPv4 Address. . . . . . . . . . . : 192.168.10.10
		Subnet Mask . . . . . . . . . . . : 255.255.255.0
		Default Gateway . . . . . . . . . : 192.168.10.1

## 7.3 Configure DHCPv4 client

- 7.3.2 **Ejemplo**

		SOHO(config)# interface G0/0/1
		SOHO(config-if)# ip address dhcp
		SOHO(config-if)# no shutdown

		SOHO# show ip interface g0/0/1
		GigabitEthernet0/0/1 is up, line protocol is up
		Internet address is 209.165.201.12/27
		Broadcast address is 255.255.255.255
		Address determined by DHCP