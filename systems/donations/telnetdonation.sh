#!/usr/bin/expect

set arg1 [lindex $argv 0]
set arg2 [lindex $argv 1]

spawn "/bin/bash"
send "telnet yeoldesphere.com 2593\r"
expect "'^]'."
send " \r"
expect "Login?:"
send "remoteadminname\r"
expect "Password?:"
send -- "password\r"
sleep 1
send  ".test,$arg1,$arg2\r"
send "^]\r"
expect eof
