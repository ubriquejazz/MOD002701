## 8.2 Stateless Address AutoConfig (SLAAC)

- 8.2.2 **Enabling SLAAC**

		1. Verify the IPv6 address
		R1# show ipv6 interface G0/0/1
	
		2. Enable routing
		R1(config)# ipv6 unicast-routing
		R1(config)# exit
	
		3. Verify SLAAC is enabled
		R1# show ipv6 interface G0/0/1 | section Joined
		Joined group address(es):
		FF02::1
		FF02::2

- 8.2.3 **SLAAC only**

  The default gateway address is the source IPv6 address of the RA message, which is the LLA for R1. A DHCPv6 server does not provide this information.

  

- 8.2.4 **RS messages**

  A router send RA messages, and it will also send an RA message if it receives an RS message from a host. When a client is configured to obtain its addressing information automatically, it sends an RS message to the IPv6 all-routers multicast address of ff02::2.

  

- 8.2.5 **Interface ID**

	A host typically acquires its 64-bit IPv6 subnet information from the router RA. However, it must generate the remainder 64-bit interface identifier (ID) using one of two methods:

		1. Random (Windows 10)
	
		2. EUI-64 - The host creates an interface ID using its 48-bit MAC address. The host inserts the hex value of fffe in the middle of the address, and flips the seventh bit of the interface ID. This changes the value of the second hexadecimal digit of the interface ID. 

- 8.2.6 **Duplicate Address Detection**

	The host sends an ICMPv6 Neighbor Solicitation (NS) message with a specially constructed multicast address, called a solicited-node multicast address. This address duplicates the last 24 bits of IPv6 address of the host.

	If no other devices respond with a Neighbor Advertisemente (NA) message, then the address is virtually guaranteed to be unique and can be used by the host. If an NA is received by the host, then the address is not unique, and the operating system has to determine a new interface ID to use.

