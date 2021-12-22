## 4.2 Router on a stick

- 4.2.2 **Switch configuration**

        1. Crear y nombrar los VLANs.
        S2(config)# vlan 10
        S2(config-vlan)# name LAN10
        S2(config)# vlan 20
        S2(config-vlan)# name LAN20
        S2(config)# vlan 99
        S2(config-vlan)# name Management
    
        2. Crear la interfaz de administración.
        S2(config)# interface vlan 99
        S2(config-if)# ip add 192.168.99.3 255.255.255.0
        S2(config-if)# no shutdown
        S2(config)# ip default-gateway 192.168.99.1
    
        3. Configurar puertos de acceso.
        S2(config)# interface fa0/18
        S2(config-if)# switchport mode access
        S2(config-if)# switchport access vlan 20
        S2(config-if)# no shut
    
        4. Configurar puertos de enlace troncal.
        S1(config)# interface fastEthernet 0/1
        S1(config-if)# switchport mode trunk
        S1(config-if)# no shut

- 4.2.4 **R1. Subinterfaces Configuration**

        R1(config)# interface G0/0/1.10
        R1(config-subif)# description Default Gateway for VLAN 10
        R1(config-subif)# encapsulation dot1Q 10
        R1(config-subif)# ip add 192.168.10.1 255.255.255.0
    
        R1(config)# interface G0/0/1.20
        R1(config-subif)# description Default Gateway for VLAN 20
        R1(config-subif)# encapsulation dot1 20   
        R1(config-subif)# ip add 192.168.20.1 255.255.255.0
    
        R1(config)# interface G0/0/1.99
        R1(config-subif)# description Default Gateway for VLAN 99
        R1(config-subif)# encapsulation dot1Q 99
        R1(config-subif)# ip add 192.168.99.1 255.255.255.0
    
        R1(config)# interface G0/0/1
        R1(config-if)# description Trunk link to S1
        R1(config-if)# no shut

- 4.2.6 **Verify Inter-VLAN routing**

        R1# show ip route
        R1# show ip interface brief | include up
        R1# show interfaces g0/0/1.10
        S1# show interfaces trunk