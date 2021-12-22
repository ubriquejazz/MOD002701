## 3.4 Trunk Configuration Commands

- 3.4.2 **Trunk Configuration**

        S1(config)# interface fastEthernet 0/1
        S1(config-if)# switchport mode trunk
        S1(config-if)# switchport nonegotiate
        S1(config-if)# switchport trunk native vlan 99
        S1(config-if)# switchport trunk allowed vlan a,b,c, 99

- 3.4.3 **Verify Trunk Configuration**

        S1# show interfaces fa0/1 switchport

- 3.4.4 **Reset to default state**

        S1(config)# interface fa0/1
        S1(config-if)# no switchport trunk allowed vlan
        S1(config-if)# no switchport trunk native vlan
        S1# show interfaces fa0/1 switchport