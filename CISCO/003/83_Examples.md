## 8.3 DHCPv6 Operation

- 8.3.3 **Enable stateless on a iface**

	The stateless DHCPv6 server is only providing configuration parameters for clients, not IPv6 addresses.
	The O=1 flag informs the client that additional config param is available from the DHCPv6 server.

		R1(config)# int g0/0/1
		R1(config-if)# ipv6 nd other-config-flag
		R1(config-if)# end

		R1# show ipv6 interface g0/0/1 | begin ND
		Hosts use stateless autoconfig for addresses.
		Hosts use DHCP to obtain other configuration.

- 8.3.5 **Enable stateful on a iface**

	The DHCPv6 server maintains IPv6 state information. This is similar to a DHCPv4 
	The M=1 flag informs the client that IPv6 addressing information comes from DHCPv6 server.

		R1(config)# int g0/0/1
		R1(config-if)# ipv6 nd managed-config-flag
		R1(config-if)# ipv6 nd prefix default no-autoconfig
		R1(config-if)# end

		R1# show ipv6 interface g0/0/1 | begin ND
		Hosts use DHCP to obtain routable addresses.

