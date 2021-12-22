## 4.3 L3 Switch

- 4.3.6 **Routing scenerio**

    R1 and D1 same domain for Open Shortest Path First (OSPF). OSPF to publish 10.10.10.0/24 and 10.20.20.0/24 networks. Se crea una SVI por cada VLAN (internal routing)

        1. Configure la interfaz con R1.
        D1(config)# interface GigabitEthernet1/0/1
        D1(config-if)# description routed Port Link to R1
        D1(config-if)# no switchport
        D1(config-if)# ip address 10.10.10.2 255.255.255.0`
        D1(config-if)# no shut
        D1(config)# ip routing
    
        2. Publicar redes con OSPF
        D1(config)# router ospf 10`
        D1(config-router)# network 192.168.10.0 0.0.0.255 area 0`
        D1(config-router)# network 192.168.20.0 0.0.0.255 area 0`
        D1(config-router)# network 10.10.10.0 0.0.0.3 area 0`
    
        3. Verificar enrutamiento
        D1# show ip route`

- 4.3.3 **Switch configuration**

        1. Crear y nombrar los VLANs.
        D1(config)# vlan 10
        D1(config-vlan)# name LAN10
        D1(config)# vlan 20
        D1(config-vlan)# name LAN20
        
        2. Crear la interfaz SVI.
        D1(config)# interface vlan 10
        D1(config-if)# description Default Gateway SVI for 192.168.10.0/24
        D1(config-if)# ip add 192.168.10.1 255.255.255.0
        D1(config-if)# no shut
        D1(config)# int vlan 20
        D1(config-if)# description Default Gateway SVI for 192.168.20.0/24
        D1(config-if)# ip add 192.168.20.1 255.255.255.0
        D1(config-if)# no shut
        
        3. Configurar puertos de acceso.
        D1(config)# interface GigabitEthernet1/0/6
        D1(config-if)# description Access port to PC1
        D1(config-if)# switchport mode access
        D1(config-if)# switchport access vlan 10
        D1(config)# interface GigabitEthernet1/0/18
        D1(config-if)# description Access port to PC2
        D1(config-if)# switchport mode access
        D1(config-if)# switchport access vlan 20
        D1(config)# ip routing
