## 6.3 EtherChannel

- 6.2.2 **LACP Configuration**

		S1(config)# interface range FastEthernet 0/1 - 2
		S1(config-if-range)# channel-group 1 mode active
		S1(config)# interface port-channel 1
		S1(config)# switchport mode trunk

- 6.3.1 **Verify EtherChannel**

		S1# show interfaces port-channel 1
		S1# show etherchannel summary
		S1# show etherchannel port-channel
		S1# show interfaces f0/1 etherchannel

