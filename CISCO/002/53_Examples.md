## 5.3 Evolution of STP

- 5.3.1 **Versions of STP**

| Name | Description |
| ----------- | ----------- |
| RSTP | Rapid Spanning Tree Protocol or IEEE 802.1w is an evolution of STP that provides faster convergence than STP|
| PVST+ | Per-VLAN Spanning Tree is a Cisco enhancement of STP that provides a separate 802.1D spanning tree instance for each VLAN (default on Cisco Catalyst)|
| Rapid PVST+ | a Cisco enhancement of RSTP that uses PVST+ and provides a separate instance of 802.1w per VLAN|

- 5.3.3 **RSTP Port States and Roles**

        only three port states: discarded, learning, forwarding
        port type: designated, root, block, alternate, backup 

- 5.3.4 **PortFast and BPDU Guards**

        30s delay can present a problem for DHCP clients trying to discover a DHCP server. When a switch port is configured with PortFast, that transitions from blocking to forwarding state immediately.
