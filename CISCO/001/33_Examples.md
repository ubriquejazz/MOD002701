## 3.3 VLAN Configuration

- 3.3.3 **VLAN Creation**

        S1(config)# vlan 20
        S1(config-vlan)# name student
        S1(config)# vlan 150
        S1(config-vlan)# name VOICE

- 3.3.5 **VLAN Port Assignment**

        S1(config)# interface fa0/6
        S1(config-if)# switchport mode access
        S1(config-if)# switchport access vlan 20

- 3.3.7 **Data and Voice** 

        S3(config)# interface fa0/18
        S3(config-if)# switchport mode access
        S1(config-if)# switchport access vlan 20
        S3(config-if)# mls qos trust cos
        S3(config-if)# switchport voice vlan 150

- 3.3.8 Verify **VLAN information**

        S3# show interface fa0/18 switchport

- 3.3.9 Change **VLAN Port Membership**

        S1(config)# interface fa0/18
        S1(config-if)# no switchport access vlan
        S1# show interfaces fa0/18 switchport

