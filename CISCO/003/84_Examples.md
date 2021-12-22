## 8.4 Config DHCPv6 Sever

- 8.4.2 **Stateless Server**

		1. Enable IPv6 routing.
		R1(config)# ipv6 unicast-routing

		2. Configure the DHCPv6 pool.
		R1(config)# ipv6 dhcp pool IPV6-STATELESS
		R1(config-dhcpv6)# dns-server 2001:db8:acad:1::254
		R1(config-dhcpv6)# domain-name example.com

		3. Bind the DHCPv6 pool to an interface.
		R1(config)# interface GigabitEthernet0/0/1
		R1(config-if)# description Link to LAN
		R1(config-if)# ipv6 address fe80::1 link-local
		R1(config-if)# ipv6 address 2001:db8:acad:1::1/64

		4. DHCPv6 mode
		R1(config-if)# ipv6 nd other-config-flag
		R1(config-if)# ipv6 dhcp server IPV6-STATELESS
		R1(config-if)# no shutdown

- 8.4.3 **Stateless Client**

		1. Enable IPv6 routing.
		R3(config)# ipv6 unicast-routing

		2. Configure the client router to create an LLA.
		R3(config)# interface g0/0/1
		R3(config-if)# ipv6 enable

		3. Configure the client router to use SLAAC.
		R3(config-if)# ipv6 address autoconfig
		R3(config-if)# end

- 8.4.4 **Stateful Server**

		1. Enable IPv6 routing.
		2. Configure the DHCPv6 pool.

		3. Bind the DHCPv6 pool to an interface.
		R1(config)# interface GigabitEthernet0/0/1
		R1(config-if)# description Link to LAN
		R1(config-if)# ipv6 address fe80::1 link-local
		R1(config-if)# ipv6 address 2001:db8:acad:1::1/64

		4. DHCPv6 mode
		R1(config-if)# ipv6 nd managed-config-flag
		R1(config-if)# ipv6 nd prefix default no-autoconfig
		R1(config-if)# ipv6 dhcp server IPV6-STATEFUL
		R1(config-if)# no shutdown

- 8.4.5 **Stateful Client**

		1. Enable IPv6 routing.
		2. Configure the client router to create an LLA.

		3. Configure the client router to use DHCPv6.
		R3(config-if)# ipv6 address dhcp
		R3(config-if)# end

- 8.4.6 **Server Verification Commmands**

		R1# show ipv6 dhcp pool
		The command also identifies the number of active clients. 

		R1# show ipv6 dhcp binding
		A stateless DHCPv6 server would not maintain the clients info

- 8.4.7 **Relay Agent**

	In the figure, PC1 requires the services of a stateful DHCPv6 server (R3) to acquire its IPv6 address.
	R1 needs to be configured as the DHCPv6 Relay Agent:

		R1(config)# interface gigabitethernet 0/0/1
		R1(config-if)# ipv6 dhcp relay destination 2001:db8:acad:1::2 G0/0/0
		R1(config-if)# exit

- 8.4.8 **Verify the Relay Agent**

		R1# show ipv6 dhcp interface
		GigabitEthernet0/0/1 is in relay mode

		R3# show ipv6 dhcp binding
		Client: FE80::5C43:EE7C:2959:DA68



