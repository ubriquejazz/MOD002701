# SRWE PT Practice Skills Assessment (PTSA) Part 1

## Introduction

In this assessment you are configuring a network that is using EtherChannel and routing between VLANs. For the sake of time, you will not be asked to perform all configurations on all network devices as you may be required to do in a real network or other assessment. Instead, you will use the skills and knowledge that you have learned in the labs in this course to configure the router and switches in the topology. In addition to EtherChannel and inter-VLAN routing, this task involves creating VLANs and trunks, and performing basic router and switch configuration.

You are required to configure host default gateways; however host addresses are preconfigured.

You will practice and be assessed on the following skills:

=   Configuration of initial settings on a router.
=   Configuration of initial settings on a switch, including SVI and SSH.
=   Configuration of VLANs. Troubleshooting
=   Configuration of switchport VLAN membership.
=   EtherChannel configuration.
=   Configuration of static trunking and DTP.
=   Configuration of routing between VLANs on a Layer 3 switch.
=   Configuration of router-on-a-stick inter- VLAN routing on a router.
=   Configure default gateways on hosts.

## Addressing Table

...
 
## Background / Scenario

A corporation is planning to implement EtherChannel and a new VLAN design in order to make the network more efficient. You have been asked to work on a design and prototype of the new network. You have created the logical topology and now need to configure the devices in order to evaluate the design. You will configure VLANs and access port VLAN membership on access layer switches. You will also configure EtherChannel and trunking. Finally, you will configure a router and a Layer 3 switch to route between VLANs. Some addressing had already been configured.

## Instructions

### Part 1: Basic Router Configuration

**Step 1: Configure router R-1 with required settings.**

a.      Open a command window on router R-1 and move to privileged EXEC mode.

b.      Copy and paste the following configuration into the R-1 router CLI.

		ip route 10.0.10.0 255.255.255.0 GigabitEthernet0/0/0
		ip route 10.0.20.0 255.255.255.0 GigabitEthernet0/0/0
		ip route 10.0.30.0 255.255.255.0 GigabitEthernet0/0/0
		ip route 10.0.99.0 255.255.255.240 GigabitEthernet0/0/0
		Be sure to press the <Enter> key after the last line to return to privileged EXEC mode prompt.

c.      Configure the following settings on the router:

		o   The enable secret password.
		o   A console password
		o   Remote access to the VTY lines.
		o   A banner MOTD message.
		o   The device hostname according to the value in the addressing table.
		o   All clear text passwords should be encrypted.
		o   Interface addressing on G0/0/0 and S0/1/0.
		o   Interface descriptions on G0/0/0 and S0/1/0.
		Note: Be sure to make a record of the passwords that you create.


### Part 2: Basic Switch Configuration

**Step 1: Configure Remote Management Addressing**

a.      Configure SVI 99 on switch S-3 with IP addressing according to the Addressing Table.

b.      The S-3 switch SVI should be reachable from other networks.

**Step 2: Configure Secure Remote Access**

		On switch S-3, configure SSH as follows:

		o   Username: admin password: C1sco123!
		o   Modulus bits 1024
		o   All VTY lines should accept SSH connections only
		o   Connections should require the previously configured username and password.
		o   IP domain name: acad.pt


### Part 3: VLAN Configuration

**Step 1: Configure VLANs according to the VLAN table.**

Use the VLAN Table to create and name the VLANs on the appropriate switches.

	VLAN, Name, IP Network, Subnet Mask, Devices
	10	FL1	10.0.10.0 255.255.255.0	MULTI-1, S-1, S-2

** Step 1: Assign switch ports to VLANs **

Assign VLAN membership to static access switchports according to the Port to VLAN Assignment table.

	Device VLAN, VLAN Name Port Assignments
	S-1, 10 FL1, F0/7-10, S-1


### Part 4: EtherChannel and Trunking Configuration

EtherChannel Port Assignments Table

**Step 1: Configure EtherChannels**

Create EtherChannels according to the EtherChannel Port Assignments Table. Use the Cisco LACP protocol. Both sides of the channel should attempt to negotiate the link protocol.

**Step 2: Configure Trunking on the EtherChannels**

a.      Configure the port channel interfaces as static trunks. Disable DTP negotiation on all trunks.

b.      Troubleshoot any issues that prevent the formation of the EtherChannels.

Note: Packet Tracer requires configuration of trunking and DTP mode on both portchannel interfaces and the component physical interfaces.

**Step 3: Configure a static trunk uplink**

a.      On the S-3 switch, configure the port that is connected to R-1 G0/0/0 as a static trunk.

b.      Configure the Management VLAN as the native VLAN.

c.      Disable DTP on the port.


### Part 5: Configure Inter-VLAN Routing

**Step 1: Configure inter-VLAN routing on the Layer 3 switch.**

a.      Configure Inter-VLAN routing on the MULTI-1 Layer 3 switch for all VLANs in the VLAN Table that are configured on MULTI-1.

b.      Configure the switchport on MULTI-1 that is connected to R-1 with an IP address as shown in the Addressing Table.

**Step 2: Configure router-on-a-stick inter-VLAN routing on a router.**

a.      Configure inter-VLAN routing on R-1 for all the VLANs that are configured on the S-3 switch. Use the information in the Addressing Table.

b.      Be sure to configure descriptions of all interfaces.

**Step 3: Configure default gateways on hosts.**

a.      Configure default gateway addresses on all hosts on the LANs.

b.      Verify connectivity between all hosts on both LANs with each other and the Web Server server.

c.      Verify that a host can connect to the SVI of switch S-3 over SSH.

